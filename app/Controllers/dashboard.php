<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\BukuRequest;
use App\Models\ModulRequestModel;
use App\Models\BukuRequestModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use CodeIgniter\I18n\Time;

class Dashboard extends BaseController
{
    protected $bukuRequestController;
    protected $ModulRequestModel;
    protected $bukuRequestModel;
    protected $db;

    public function __construct()
    {
        $this->ModulRequestModel = new ModulRequestModel();
        $this->bukuRequestModel = new BukuRequestModel();
        $this->bukuRequestController = new BukuRequest();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Modul
        $totalModul = $this->ModulRequestModel->countAll();
        $statusCountsModul = $this->getStatusCounts($this->ModulRequestModel);

        // Buku
        $totalBuku = $this->bukuRequestModel->countAll();
        $statusCountsBuku = $this->getStatusCounts($this->bukuRequestModel);

        $data = [
            'totalModul' => $totalModul,
            'totalBuku' => $totalBuku,
            'totalModulPending' => $statusCountsModul['totalPending'],
            'totalModulTerima' => $statusCountsModul['totalTerima'],
            'totalModulTolak' => $statusCountsModul['totalTolak'],
            'totalModulProses' => $statusCountsModul['totalProses'],
            'totalModulSelesai' => $statusCountsModul['totalSelesai'],
            'totalBukuPending' => $statusCountsBuku['totalPending'],
            'totalBukuTerima' => $statusCountsBuku['totalTerima'],
            'totalBukuTolak' => $statusCountsBuku['totalTolak'],
            'totalBukuProses' => $statusCountsBuku['totalProses'],
            'totalBukuSelesai' => $statusCountsBuku['totalSelesai'],
        ];

        return view('pages/staff/home', $data);
    }

    protected function getStatusCounts($model)
    {
        return [
            'totalPending' => $model->where('status', 'pending')->countAllResults(),
            'totalTerima' => $model->where('status', 'diterima')->countAllResults(),
            'totalTolak' => $model->where('status', 'ditolak')->countAllResults(),
            'totalProses' => $model->where('status', 'proses eksekusi')->countAllResults(),
            'totalSelesai' => $model->where('status', 'sudah dieksekusi')->countAllResults(),
        ];
    }

    private function getPeriodStartEnd()
    {
        $currentMonth = date('n');
        $currentYear = date('Y');

        if ($currentMonth <= 6) {
            // Periode Januari - Juni
            $startDate = Time::createFromDate($currentYear, 1, 1);
            $endDate = Time::createFromDate($currentYear, 6, 30);
        } else {
            // Periode Juli - Desember
            $startDate = Time::createFromDate($currentYear, 7, 1);
            $endDate = Time::createFromDate($currentYear, 12, 31);
        }

        return [$startDate->toDateString(), $endDate->toDateString()];
    }

    public function exportModulToExcel()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $db = \Config\Database::connect();
        $builder = $db->table('arsip_modul_request AS rcm')
            ->select('rcm.id_request_modul, m.judul_modul, rcm.jumlah_cetak, rcm.status, rcm.tanggal_request, c.nama as nama_pemohon')
            ->join('modul AS m', 'rcm.id_modul = m.id_modul', 'left')
            ->join('civitas AS c', 'rcm.id_anggota = c.id_anggota', 'left')
            ->where('rcm.tanggal_request >=', $startDate)
            ->where('rcm.tanggal_request <=', $endDate);

        $query = $builder->get();
        $moduls = $query->getResult();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $title = 'Modul request ' . $startDate . ' sampai ' . $endDate;
        if (strlen($title) > 31) {
            $title = substr($title, 0, 28) . '...';
        }
        $sheet->setTitle($title);

        $headers = [
            'A1' => 'ID Request Modul',
            'B1' => 'Judul Modul',
            'C1' => 'Jumlah Cetak',
            'D1' => 'Status',
            'E1' => 'Tanggal Request',
            'F1' => 'Tanggal Request',
        ];
        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ];
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        $row = 2;
        foreach ($moduls as $modul) {
            $sheet->setCellValue('A' . $row, $modul->id_request_modul);
            $sheet->setCellValue('B' . $row, $modul->judul_modul);
            $sheet->setCellValue('C' . $row, $modul->jumlah_cetak);
            $sheet->setCellValue('D' . $row, $modul->status);
            $sheet->setCellValue('E' . $row, $modul->tanggal_request);
            $sheet->setCellValue('F' . $row, $modul->nama_pemohon);
            $row++;
        }

        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ];
        $sheet->getStyle('A1:G' . ($row - 1))->applyFromArray($dataStyle);

        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="modul.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


    public function exportBukuToExcel()
    {
        $startDate = '2024-01-01';
        $endDate = '2024-07-21';

        // Menggunakan Query Builder untuk menghindari SQL Injection
        $builder = $this->db->table('arsip_request_buku AS arb')
            ->select('arb.id_request_buku, c.id_anggota, arb.jenis_buku, arb.judul_buku, arb.edisi_tahun, arb.penerbit, arb.pengarang, arb.link_beli, arb.perkiraan_harga, arb.status, arb.tanggal_request, c.nama, c.asal_prodi')
            ->join('civitas AS c', 'c.id_anggota = arb.id_anggota', 'left')
            ->where('arb.tanggal_request >=', $startDate)
            ->where('arb.tanggal_request <=', $endDate);

        $query = $builder->get();
        $bukus = $query->getResult();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menentukan judul sheet
        $title = 'Buku request ' . $startDate . ' sampai ' . $endDate;
        if (strlen($title) > 31) {
            $title = substr($title, 0, 28) . '...'; // Memotong judul jika melebihi 31 karakter
        }
        $sheet->setTitle($title);

        // Set header
        $headers = [
            'A1' => 'ID Buku',
            'B1' => 'ID Anggota ',
            'C1' => 'Jenis Buku',
            'D1' => 'Judul Buku',
            'E1' => 'Edisi Tahun',
            'F1' => 'Penerbit',
            'G1' => 'Pengarang',
            'H1' => 'Link Pembelian',
            'I1' => 'Perkiraan Harga',
            'J1' => 'Status',
            'K1' => 'Tanggal Request',
            'L1' => 'Nama',
            'M1' => 'Asal Prodi'
        ];
        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        // Apply styling to headers
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ];
        $sheet->getStyle('A1:M1')->applyFromArray($headerStyle);

        // Populate data
        $row = 2;
        foreach ($bukus as $buku) {
            $sheet->setCellValue('A' . $row, $buku->id_request_buku);
            $sheet->setCellValue('B' . $row, $buku->id_anggota);
            $sheet->setCellValue('C' . $row, $buku->jenis_buku);
            $sheet->setCellValue('D' . $row, $buku->judul_buku);
            $sheet->setCellValue('E' . $row, $buku->edisi_tahun);
            $sheet->setCellValue('F' . $row, $buku->penerbit);
            $sheet->setCellValue('G' . $row, $buku->pengarang);
            $sheet->setCellValue('H' . $row, $buku->link_beli);
            $sheet->setCellValue('I' . $row, $buku->perkiraan_harga);
            $sheet->setCellValue('J' . $row, $buku->status);
            $sheet->setCellValue('K' . $row, $buku->tanggal_request);
            $sheet->setCellValue('L' . $row, $buku->nama);
            $sheet->setCellValue('M' . $row, $buku->asal_prodi);
            $row++;
        }

        // Apply border to all data cells
        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ];
        $sheet->getStyle('A1:M' . ($row - 1))->applyFromArray($dataStyle);

        // Auto size columns
        foreach (range('A', 'M') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Send file to browser for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="buku.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }





    // Buku Request controller 
    public function disetujuiBuku()
    {
        return $this->bukuRequestController->disetujuiBuku();
    }
    public function pendingBuku()
    {
        return $this->bukuRequestController->pendingBuku();
    }
    public function prosesBuku()
    {
        return $this->bukuRequestController->prosesBuku();
    }
}
