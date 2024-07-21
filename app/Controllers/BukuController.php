<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use CodeIgniter\HTTP\ResponseInterface;

class BukuController extends BaseController
{
    protected $buku;

    public function __construct()
    {
        $this->buku = new BukuModel();
    }

    public function index()
    {
        $tampil = $this->buku->findAll();
        return view('pages\staff\buku\tampil.php', ['BanyakBuku' => $tampil]);
    }

    public function tambah()
    {
        return view('pages\staff\buku\tambah.php');
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'judul_buku' => 'required|min_length[3]|max_length[255]',
            'edisi_tahun' => 'required|integer',
            'penerbit' => 'required|min_length[3]|max_length[255]',
            'jenis_buku' => 'required|min_length[3]|max_length[255]',
            'pengarang' => 'required|min_length[3]|max_length[255]',
            'cover' => 'uploaded[cover]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]|max_size[cover,2048]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $file = $this->request->getFile('cover');
        $data = [
            'judul_buku' => $this->request->getPost('judul_buku'),
            'edisi_tahun' => $this->request->getPost('edisi_tahun'),
            'penerbit' => $this->request->getPost('penerbit'),
            'jenis_buku' => $this->request->getPost('jenis_buku'),
            'pengarang' => $this->request->getPost('pengarang')
        ];

        if ($file && $file->isValid()) {
            try {
                // Pindahkan file yang diupload ke direktori public/uploads/cover_buku
                $file->move(WRITEPATH . '../public/uploads/cover_buku');
                $data['cover'] = $file->getName();
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('errors', ['cover' => 'Failed to move the uploaded file.']);
            }
        }

        if ($this->buku->insert($data)) {
            return redirect()->to('/dashboard/tambah-buku')->with('success', 'Buku berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->buku->errors());
        }
    }


    public function edit($id)
    {
        $buku = $this->buku->find($id);

        if (!$buku) {
            return redirect()->to('/dashboard/tampil-buku')->with('errors', 'Data buku tidak ditemukan.');
        }

        return view('pages\staff\buku\edit.php', ['buku' => $buku]);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'judul_buku' => 'required|min_length[3]|max_length[255]',
            'edisi_tahun' => 'required|integer',
            'penerbit' => 'required|min_length[3]|max_length[255]',
            'jenis_buku' => 'required|min_length[3]|max_length[255]',
            'pengarang' => 'required|min_length[3]|max_length[255]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $validation->getErrors()
            ]);
        }

        $buku = $this->buku->find($id);
        if (!$buku) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data buku tidak ditemukan.'
            ]);
        }

        $data = [
            'judul_buku' => $this->request->getPost('judul_buku'),
            'edisi_tahun' => $this->request->getPost('edisi_tahun'),
            'penerbit' => $this->request->getPost('penerbit'),
            'jenis_buku' => $this->request->getPost('jenis_buku'),
            'pengarang' => $this->request->getPost('pengarang')
        ];

        $file = $this->request->getFile('cover');
        if ($file && $file->isValid()) {
            try {
                $uploadPath = WRITEPATH . '../public/uploads/cover_buku';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                // Hapus file lama jika ada
                if (!empty($buku->cover)) {
                    $oldFile = $uploadPath . '/' . $buku->cover;
                    if (is_file($oldFile)) {
                        unlink($oldFile);
                    }
                }
                // Pindahkan file yang diupload ke direktori yang diinginkan
                $file->move($uploadPath);
                $data['cover'] = $file->getName();
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to move the uploaded file.'
                ]);
            }
        }

        if ($this->buku->update($id, $data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data buku berhasil diupdate.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->buku->errors()
            ]);
        }
    }

    public function destroy($id_buku)
    {
        $buku = $this->buku->find($id_buku);
        if (!$buku) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data buku tidak ditemukan.'
            ]);
        }

        // Hapus file cover jika ada
        $uploadPath = WRITEPATH . '../public/uploads/cover_buku';
        if (!empty($buku->cover)) {
            $fileToDelete = $uploadPath . '/' . $buku->cover;
            if (is_file($fileToDelete)) {
                unlink($fileToDelete);
            }
        }

        if ($this->buku->delete($id_buku)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data buku berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus buku'
            ]);
        }
    }
}
