<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuRequestModel;
use CodeIgniter\HTTP\ResponseInterface;

class BukuRequest extends BaseController
{

    protected $buku;

    function __construct()
    {
        $this->buku = new BukuRequestModel();
    }

    public function index()
    {
        return view('pages/regular/request_buku');
    }

    public function store()
    {
        $validationRules = [
            // 'asal_prodi' => 'required|min_length[3]',
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
            'asal_prodi' => $this->request->getPost('asal_prodi'),
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

    public function HistoryBuku()
    {
        $id_session = session()->get('id_anggota');

        $buku_request = new BukuRequestModel();

        $buku_history = $buku_request->where('id_anggota_request', $id_session)->findAll();

        return view('pages/regular/historyBuku', ['buku_history' => $buku_history]);
    }

    // staff dashboard buku
    public function pendingBuku()
    {
        $pendingBuku = $this->buku->where('status', 'pending')->findAll();
        return view('pages/staff/buku_request/pending', ['pendingBuku' => $pendingBuku]);
    }

    public function disetujuiBuku()
    {
        $disetujuiBuku = $this->buku->where('status', 'diterima')->findAll();
        return view('pages/staff/buku_request/disetujui', ['disetujuiBuku' => $disetujuiBuku]);
    }

    public function prosesBuku()
    {
        $pendingBuku = $this->buku->where('status', 'proses eksekusi')->findAll();
        return view('pages/staff/buku_request/proses', ['prosesBuku' => $pendingBuku]);
    }

    public function editStatusBuku($id_buku, $status)
    {
        try {
            $this->buku->update($id_buku, ['status' => $status]);
            return $this->response->setJSON(['status' => 'success']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
