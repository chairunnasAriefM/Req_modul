<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModulModel;
use App\Models\BukuRequestModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use CodeIgniter\I18n\Time;

class Dashboard extends BaseController
{
    protected $modulModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->modulModel = new ModulModel();
        $this->bukuModel = new BukuRequestModel();
    }

    public function index()
    {
        // Modul
        $totalModul = $this->modulModel->countAll();
        $statusCountsModul = $this->getStatusCounts($this->modulModel);

        // Buku
        $totalBuku = $this->bukuModel->countAll();
        $statusCountsBuku = $this->getStatusCounts($this->bukuModel);

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

    public function pendingModul()
    {
        $pendingModul = $this->modulModel->where('status', 'pending')->findAll();
        return view('pages/staff/modul/pending', ['pendingModul' => $pendingModul]);
    }

    public function disetujuiModul()
    {
        $disetujuiModul = $this->modulModel->where('status', 'diterima')->findAll();
        return view('pages/staff/modul/disetujui', ['disetujuiModul' => $disetujuiModul]);
    }

    public function prosesModul()
    {
        $prosesModul = $this->modulModel->where('status', 'proses eksekusi')->findAll();
        return view('pages/staff/modul/proses', ['prosesModul' => $prosesModul]);
    }

    public function editStatus($modul_id, $status)
    {
        $this->modulModel->update($modul_id, ['status' => $status]);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function cekPdf($modul_id)
    {
        return view('pages/staff/Cekpdf', ['modul_id' => $modul_id]);
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
        list($startDate, $endDate) = $this->getPeriodStartEnd();

        $modulModel = new ModulModel();
        $moduls = $modulModel->where('tanggal_request >=', $startDate)
            ->where('tanggal_request <=', $endDate)
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Modul');

        // Set header
        $headers = [
            'A1' => 'Modul ID',
            'B1' => 'ID Anggota Request',
            'C1' => 'Judul Modul',
            'D1' => 'Soft File',
            'E1' => 'Jumlah Cetak',
            'F1' => 'Status',
            'G1' => 'Tanggal Request',
            'H1' => 'Asal Prodi'
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
        $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

        // Populate data
        $row = 2;
        foreach ($moduls as $modul) {
            $sheet->setCellValue('A' . $row, $modul->modul_id);
            $sheet->setCellValue('B' . $row, $modul->id_anggota_request);
            $sheet->setCellValue('C' . $row, $modul->judul_modul);
            $sheet->setCellValue('D' . $row, $modul->soft_file);
            $sheet->setCellValue('E' . $row, $modul->jumlah_cetak);
            $sheet->setCellValue('F' . $row, $modul->status);
            $sheet->setCellValue('G' . $row, $modul->tanggal_request);
            $sheet->setCellValue('H' . $row, $modul->asal_prodi);
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
        $sheet->getStyle('A1:H' . ($row - 1))->applyFromArray($dataStyle);

        // Auto size columns
        foreach (range('A', 'H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Send file to browser for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="modul.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    // buku
    public function pendingBuku()
    {
        $pendingBuku = $this->bukuModel->where('status', 'pending')->findAll();
        return view('pages/staff/buku/pending', ['pendingBuku' => $pendingBuku]);
    }

    public function disetujuiBuku()
    {
        $disetujuiBuku = $this->bukuModel->where('status', 'diterima')->findAll();
        return view('pages/staff/buku/disetujui', ['disetujuiBuku' => $disetujuiBuku]);
    }

    public function prosesBuku()
    {
        $pendingBuku = $this->bukuModel->where('status', 'proses eksekusi')->findAll();
        return view('pages/staff/buku/proses', ['prosesBuku' => $pendingBuku]);
    }

    public function editStatusBuku($id_buku, $status)
    {
        try {
            $this->bukuModel->update($id_buku, ['status' => $status]);
            return $this->response->setJSON(['status' => 'success']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function exportBukuToExcel()
    {
        list($startDate, $endDate) = $this->getPeriodStartEnd();

        $bukuModel = new BukuRequestModel();
        $bukus = $bukuModel->where('tanggal_request >=', $startDate)
            ->where('tanggal_request <=', $endDate)
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Modul');

        // Set header
        $headers = [
            'A1' => 'ID Buku',
            'B1' => 'ID Anggota Request',
            'C1' => 'Judul Buku',
            'D1' => 'Edisi Tahun',
            'E1' => 'Penerbit',
            'F1' => 'Pengarang',
            'G1' => 'Jenis Buku',
            'H1' => 'Link Pembelian',
            'I1' => 'Perkiraan Harga',
            'J1' => 'Tanggal Request',
            'K1' => 'Asal Prodi'
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
        $sheet->getStyle('A1:K1')->applyFromArray($headerStyle);

        // Populate data
        $row = 2;
        foreach ($bukus as $buku) {
            $sheet->setCellValue('A' . $row, $buku->id_buku);
            $sheet->setCellValue('B' . $row, $buku->id_anggota_request);
            $sheet->setCellValue('C' . $row, $buku->judul_buku);
            $sheet->setCellValue('D' . $row, $buku->edisi_tahun);
            $sheet->setCellValue('E' . $row, $buku->penerbit);
            $sheet->setCellValue('F' . $row, $buku->pengarang);
            $sheet->setCellValue('G' . $row, $buku->jenis_buku);
            $sheet->setCellValue('H' . $row, $buku->link_beli);
            $sheet->setCellValue('I' . $row, $buku->perkiraan_harga);
            $sheet->setCellValue('J' . $row, $buku->tanggal_request);
            $sheet->setCellValue('K' . $row, $buku->asal_prodi);
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
        $sheet->getStyle('A1:K' . ($row - 1))->applyFromArray($dataStyle);

        // Auto size columns
        foreach (range('A', 'K') as $columnID) {
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
}
