<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuRequestModel;
use CodeIgniter\HTTP\ResponseInterface;

class BukuRequest extends BaseController
{
    public function index()
    {
        return view('pages/regular/request_buku');
    }

    public function store()
    {
        $validationRules = [
            'judul_buku' => 'required|min_length[3]',
            'jenis_buku' => 'required',
            'edisi_tahun' => 'required|numeric',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'link_beli' => 'valid_url',
            'perkiraan_harga' => 'required|numeric',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }

        $buku_request = new BukuRequestModel();
        $data = [
            'judul_buku' => $this->request->getPost('judul_buku'),
            'jenis_buku' => $this->request->getPost('jenis_buku'),
            'edisi_tahun' => $this->request->getPost('edisi_tahun'),
            'pengarang' => $this->request->getPost('pengarang'),
            'penerbit' => $this->request->getPost('penerbit'),
            'link_beli' => $this->request->getPost('link_beli'),
            'perkiraan_harga' => $this->request->getPost('perkiraan_harga'),
            'tanggal_request' => date("Y-m-d")
        ];

        $data['id_anggota_request'] = session()->get('id_anggota');

        $buku_request->save($data);
        return redirect()->to('/buku_request')->with('success', 'Berhasil Mengisi Form');
    }

    public function showNew()
    {
        $bukuModel = new BukuRequestModel();
        $data['moduls'] = $bukuModel->findAll();
        // return $this->response->setJSON($data);

        return view('pages/regular/daftarBukuReq', $data);
    }

    // staff

}
