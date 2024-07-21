<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModulModel;
use CodeIgniter\HTTP\ResponseInterface;

class ModulController extends BaseController
{
    protected $modul;

    public function __construct()
    {
        $this->modul = new ModulModel();
    }

    public function index()
    {
        $modul = $this->modul->findAll();
        return view('pages\staff\modul\tampil.php', ['BanyakModul' => $modul]);
    }

    public function tambah()
    {
        return view('pages\staff\modul\tambah.php');
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'judul_modul' => 'required|min_length[3]|max_length[255]',
            'tahun_rilis' => 'required|integer|exact_length[4]',
            'soft_file' => 'uploaded[soft_file]|mime_in[soft_file,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[soft_file,2048]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $file = $this->request->getFile('soft_file');
        $data = [
            'judul_modul' => $this->request->getPost('judul_modul'),
            'tahun_rilis' => $this->request->getPost('tahun_rilis'),
        ];

        if ($file && $file->isValid()) {
            // Pindahkan file yang diupload ke direktori yang diinginkan
            $file->move(WRITEPATH . 'uploads/modul');
            $data['soft_file'] = $file->getName();
        }

        if ($this->modul->insert($data)) {
            return redirect()->to('/dashboard/tambah-modul')->with('success', 'Modul berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->modul->errors());
        }
    }


    public function update($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'judul_modul' => 'required|min_length[3]|max_length[255]',
            'tahun_rilis' => 'required|integer|exact_length[4]',
            'soft_file' => 'mime_in[soft_file,application/pdf]|max_size[soft_file,2048]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $validation->getErrors()
            ]);
        }

        $file = $this->request->getFile('soft_file');
        $data = [
            'judul_modul' => $this->request->getPost('judul_modul'),
            'tahun_rilis' => $this->request->getPost('tahun_rilis'),
        ];

        $modul = $this->modul->find($id);

        if ($file && $file->isValid()) {
            // Pindahkan file yang diupload ke direktori yang diinginkan
            $file->move(WRITEPATH . 'uploads/modul');
            $data['soft_file'] = $file->getName();

            // Hapus file lama
            if ($modul && file_exists(WRITEPATH . 'uploads/' . $modul->soft_file)) {
                unlink(WRITEPATH . 'uploads/' . $modul->soft_file);
            }
        }

        if ($this->modul->update($id, $data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data modul berhasil diupdate.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->modul->errors()
            ]);
        }
    }


    public function destroy($id_modul)
    {
        // Cari data modul berdasarkan ID
        $modul = $this->modul->find($id_modul);

        if ($modul) {
            // Hapus file soft_file jika ada
            if (file_exists(WRITEPATH . 'uploads/' . $modul->soft_file)) {
                unlink(WRITEPATH . 'uploads/' . $modul->soft_file);
            }

            // Hapus data modul dari database
            if ($this->modul->delete($id_modul)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data modul berhasil dihapus']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus modul']);
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data modul tidak ditemukan']);
        }
    }
}
