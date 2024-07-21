<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModulModel;
use App\Models\ModulRequestModel;

class ModulRequest extends BaseController
{
    protected $modulReq;
    protected $modul;

    public function __construct()
    {
        $this->modulReq = new ModulRequestModel();
        $this->modul = new ModulModel();
    }

    public function index()
    {
        $data['jurusans'] = [
            'Teknologi Industri' => [
                'Teknik Elektronika Telekomunikasi',
                'Teknik Listrik',
                'Teknik Mesin',
                'Teknologi Rekayasa Jaringan Telekomunikasi',
                'Teknologi Rekayasa Sistem Elektronika',
                'Teknologi Rekayasa Mekatronika'
            ],
            'Teknologi Informasi' => [
                'Teknik Informatika',
                'Sistem Informasi',
                'Teknologi Rekayasa Komputer',
                'Magister Terapan Teknik Komputer'
            ],
            'Bisnis dan Komunikasi' => [
                'Akuntansi Perpajakan',
                'Hubungan Masyarakat dan Komunikasi Digital',
                'Bisnis Digital'
            ]
        ];
        return view('pages/dosen/request_modul', $data);
    }

    public function getJudulModulByJurusanProdi()
    {
        if ($this->request->isAJAX()) {
            $jurusan = $this->request->getVar('jurusan');
            $prodi = $this->request->getVar('prodi');

            // Log debug
            log_message('debug', 'Jurusan: ' . $jurusan);
            log_message('debug', 'Prodi: ' . $prodi);

            $moduls = $this->modul->where('jurusan', $jurusan)->orWhere('jurusan', 'Umum')->findAll();

            // Log hasil query
            log_message('debug', 'Moduls: ' . json_encode($moduls));

            return $this->response->setJSON($moduls);
        } else {
            // Log jika bukan AJAX request
            log_message('error', 'Not an AJAX request');
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid request']);
        }
    }

    public function store()
    {
        $rules = [
            'id_modul' => 'required',
            'prodi' => 'required',
            'jumlah_cetak' => 'required|integer'
        ];

        if ($this->request->getPost('jenis_modul') === 'modul_baru') {
            $rules['soft_file'] = 'uploaded[soft_file]|mime_in[soft_file,application/pdf]|max_size[soft_file,2048]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $modul = new ModulRequestModel();
        $file = $this->request->getFile('soft_file');

        $data = [
            'prodi' => $this->request->getPost('prodi'),
            'id_modul' => $this->request->getPost('id_modul'),
            'jumlah_cetak' => $this->request->getPost('jumlah_cetak'),
            'tanggal_request' => date("Y-m-d"),
            'id_anggota' => session()->get('id_anggota')
        ];

        if ($file && $file->isValid()) {
            $file->move(WRITEPATH . 'uploads/modul');
            $data['soft_file'] = $file->getName();
        }

        $modul->save($data);

        return redirect()->to('/modul_request')->with('success', 'Berhasil Mengisi Form');
    }

    // History
    public function historyModul()
    {
        $id_session = session()->get('id_anggota');
        $modul = new ModulModel();
        $modul = $modul->where('id_anggota', $id_session)->findAll();
        return view('pages/dosen/historyModul', ['modul_history' => $modul]);
    }

    // Staff dashboard area
    private function getModulRequestsByStatus($status)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('request_cetak_modul');
        $builder->select('request_cetak_modul.id_request_modul, modul.judul_modul, request_cetak_modul.jumlah_cetak, request_cetak_modul.status,request_cetak_modul.soft_file, request_cetak_modul.tanggal_request, civitas.nama as nama_pemohon');
        $builder->join('modul', 'request_cetak_modul.id_modul = modul.id_modul', 'left');
        $builder->join('civitas', 'request_cetak_modul.id_anggota = civitas.id_anggota', 'left');
        $builder->where('request_cetak_modul.status', $status);
        return $builder->get()->getResult();
    }

    public function pendingModul()
    {
        $pendingModul = $this->getModulRequestsByStatus('pending');
        return view('pages/staff/modul_request/pending', ['pendingModul' => $pendingModul]);
    }

    public function disetujuiModul()
    {
        $disetujuiModul = $this->getModulRequestsByStatus('diterima');
        return view('pages/staff/modul_request/disetujui', ['disetujuiModul' => $disetujuiModul]);
    }

    public function prosesModul()
    {
        $prosesModul = $this->getModulRequestsByStatus('proses eksekusi');
        return view('pages/staff/modul_request/proses', ['prosesModul' => $prosesModul]);
    }

    public function editStatus($modul_id, $status)
    {
        try {
            // Update status modul
            $this->modulReq->update($modul_id, ['status' => $status]);
            log_message('info', "Status modul dengan ID: $modul_id telah diperbarui menjadi $status");

            // Dapatkan data modul request berdasarkan ID
            $modul_request = $this->modulReq->find($modul_id);

            if ($modul_request) {
                // Jika status diterima dan memiliki soft_file, perbarui soft_file di tabel modul
                if ($status == 'diterima' && !empty($modul_request->soft_file)) {
                    // Perbarui soft_file di tabel modul
                    $this->modul->update($modul_id, ['soft_file' => $modul_request->soft_file]);
                    log_message('info', "Soft file modul dengan ID: $modul_id telah diperbarui");
                }

                // Jika status sudah dieksekusi atau ditolak, pindahkan data ke tabel arsip
                if ($status == 'sudah dieksekusi' || $status == 'ditolak') {
                    $result = $this->moveToArchive($modul_request);
                    if (!$result) {
                        throw new \Exception('Gagal memindahkan data ke tabel arsip');
                    }
                    log_message('info', "Data modul dengan ID: $modul_id telah dipindahkan ke tabel arsip");
                }

                return $this->response->setJSON(['status' => 'success']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Modul tidak ditemukan']);
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setJSON(['status' => 'error', 'message' => 'Terjadi kesalahan dalam memperbarui status.']);
        }
    }


    protected function moveToArchive($modul_request)
    {
        // Dapatkan nama perequest
        $db = \Config\Database::connect();
        $civitasTable = $db->table('civitas');
        $civitas = $civitasTable->select('nama')->where('id_anggota', $modul_request->id_anggota)->get()->getRow();

        // Pindahkan data ke tabel arsip
        $builder = $db->table('arsip_modul_request');
        $data = [
            'id_request_modul' => $modul_request->id_request_modul,
            'id_modul' => $modul_request->id_modul,
            'judul_modul' => $modul_request->judul_modul,
            'prodi' => $modul_request->prodi,
            'jumlah_cetak' => $modul_request->jumlah_cetak,
            'tanggal_request' => $modul_request->tanggal_request,
            'status' => $modul_request->status,
            'id_anggota' => $modul_request->id_anggota,
            'soft_file' => $modul_request->soft_file,
            'nama_perequest' => $civitas ? $civitas->nama : null // Tambahkan nama perequest
        ];
        if ($builder->insert($data)) {
            // Hapus data dari tabel request_modul
            return $this->modulReq->delete($modul_request->id_request_modul);
        }
        return false;
    }

    protected function updateSoftFileInModul($modul_request)
    {
        // Perbarui soft_file di tabel modul
        $modul = new ModulModel();
        $data = [
            'soft_file' => $modul_request->soft_file
        ];
        return $modul->update($modul_request->id_modul, $data);
    }
}
