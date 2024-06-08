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
            'harga_buku' => 'required|numeric',
        ];

     
        if (!session()->has('id_anggota')) {
            $validationRules['nim'] = 'required|numeric';
        }

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
            'harga_buku' => $this->request->getPost('harga_buku'),
            'tanggal_request' => date("Y-m-d")
        ];

        if (session()->has('id_anggota')) {
            $data['id_anggota_request'] = session()->get('id_anggota');
        } else {
            $data['nim_request'] = $this->request->getPost('nim');
        }

        $buku_request->save($data);
        return redirect()->to('/buku_request');
    }
}
