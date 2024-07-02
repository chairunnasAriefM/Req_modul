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
        // Determine if the file should be required
        $rules = [
            'judul_modul' => 'required',
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

    // staff
    
    public function indexStaff()
    {
        $modulModel = new ModulModel();
        $data['moduls'] = $modulModel->where('status', 'proses eksekusi')->findAll();

        $data['title'] = 'Pengajuan Menunggu Persetujuan';
        return view('modul/index', $data);
    }

    public function preview($id)
    {
        $modulModel = new ModulModel();
        $data['modul'] = $modulModel->find($id);

        $data['title'] = 'Preview Pengajuan Modul';
        return view('modul/preview', $data);

        // $modulModel = new ModulModel();
        // $data['moduls'] = $modulModel->findAll();

        $db      = \Config\Database::connect();
        $builder = $db->table('buku');
        $query   = $builder->get();



        return $this->response->setJSON($query);
        // return view('dashboard', $data);

    }

    public function show()
    {
        $modulModel = new ModulModel();
        $data['moduls'] = $modulModel->findAll();
    
        $data['title'] = 'Dashboard';
        return view('dashboard', $data);
    }  
}