<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModulModel;

class ModulRequest extends BaseController
{
    public function index()
    {
        return view('pages/dosen/request_modul');
    }

    public function store()
    {
        // Validasi input
        $validation = $this->validate([
            'judul_modul' => 'required',
            'soft_file' => 'uploaded[soft_file]|mime_in[soft_file,application/pdf]|max_size[soft_file,2048]',
            'jumlah_cetak' => 'required|integer'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }

        // Simpan data ke database
        $modul = new ModulModel();
        $file = $this->request->getFile('soft_file');

        $data = [
            'judul_modul' => $this->request->getPost('judul_modul'),
            'soft_file' => $file->getName(),
            'jumlah_cetak' => $this->request->getPost('jumlah_cetak'),
            'tanggal_request' => date("Y-m-d"),
        ];
        $data['id_anggota_request'] = session()->get('id_anggota');

        // Pindahkan file yang diupload ke direktori yang diinginkan
        $file->move(WRITEPATH . 'uploads');

        // Simpan data 
        $modul->save($data);

        // Redirect dengan pesan sukses
        return redirect()->to('/request_modul')->with('success', 'Berhasil Mengisi Form');
    }

    // staff
    public function show()
    {
        // $modulModel = new ModulModel();
        // $data['moduls'] = $modulModel->findAll();

        $db      = \Config\Database::connect();
        $builder = $db->table('buku');
        $query   = $builder->get();



        return $this->response->setJSON($query);
        // return view('dashboard', $data);
    }
}
