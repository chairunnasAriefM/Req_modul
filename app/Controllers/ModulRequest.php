<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModulModel;
use App\Models\ModulRequestModel;

class ModulRequest extends BaseController
{
    protected $modulReq;

    public function __construct()
    {
        $this->modulReq = new ModulRequestModel();
    }

    public function index()
    {
        return view('pages/dosen/request_modul');
    }

    public function store()
    {
        // Determine if the file should be required
        $rules = [
            'judul_modul' => 'required',
            'asal_prodi' => 'required',
            'jumlah_cetak' => 'required|integer'
        ];

        if ($this->request->getPost('jenis_modul') === 'modul_baru') {
            $rules['soft_file'] = 'uploaded[soft_file]|mime_in[soft_file,application/pdf]|max_size[soft_file,2048]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Simpan data ke database
        $modul = new ModulModel();
        $file = $this->request->getFile('soft_file');

        $data = [
            'asal_prodi' => $this->request->getPost('asal_prodi'),
            'judul_modul' => $this->request->getPost('judul_modul'),
            'jumlah_cetak' => $this->request->getPost('jumlah_cetak'),
            'tanggal_request' => date("Y-m-d"),
        ];
        $data['id_anggota_request'] = session()->get('id_anggota');

        if ($file && $file->isValid()) {
            // Pindahkan file yang diupload ke direktori yang diinginkan
            $file->move(WRITEPATH . 'uploads');
            $data['soft_file'] = $file->getName();
        }

        // Simpan data 
        $modul->save($data);

        // Redirect dengan pesan sukses
        return redirect()->to('/modul_request')->with('success', 'Berhasil Mengisi Form');
    }

    // History
    public function HistoryModul()
    {
        $id_session = session()->get('id_anggota');

        // Buat instance model BukuRequestModel
        $modul = new ModulModel();

        // Query untuk mengambil data buku request berdasarkan id session
        $modul = $modul->where('id_anggota_request', $id_session)->findAll();

        // Kirim data ke view
        return view('pages/dosen/historyModul', ['modul_history' => $modul]);
    }

    // staff dashboard area

    public function pendingModul()
    {
        $pendingModul = $this->modulReq->where('status', 'pending')->findAll();
        return view('pages/staff/modul_request/pending', ['pendingModul' => $pendingModul]);
    }

    public function disetujuiModul()
    {
        $disetujuiModul = $this->modulReq->where('status', 'diterima')->findAll();
        return view('pages/staff/modul_request/disetujui', ['disetujuiModul' => $disetujuiModul]);
    }

    public function prosesModul()
    {
        $prosesModul = $this->modulReq->where('status', 'proses eksekusi')->findAll();
        return view('pages/staff/modul_request/proses', ['prosesModul' => $prosesModul]);
    }

    public function editStatus($modul_id, $status)
    {
        $this->modulReq->update($modul_id, ['status' => $status]);
        return $this->response->setJSON(['status' => 'success']);
    }
}
