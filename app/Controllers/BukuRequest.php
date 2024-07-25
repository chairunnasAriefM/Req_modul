<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuRequestModel;
use App\Models\ViewRequestBuku;
use App\Models\BukuModel; // Tambahkan model Buku
use CodeIgniter\HTTP\ResponseInterface;

class BukuRequest extends BaseController
{
    protected $bukuRequest;
    protected $viewBuku;
    protected $buku;

    function __construct()
    {
        $this->bukuRequest = new BukuRequestModel();
        $this->viewBuku = new ViewRequestBuku();
        $this->buku = new BukuModel(); // Inisialisasi model Buku
    }

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

        $judul_buku = $this->request->getPost('judul_buku');
        $id_anggota = session()->get('id_anggota');

        // Cek apakah judul buku sudah ada di tabel buku
        $existingBook = $this->buku->where('judul_buku', $judul_buku)->first();
        if ($existingBook) {
            return redirect()->back()->withInput()->with('error', 'Buku sudah terdapat di perpustakaan.');
        }

        // Cek apakah buku sudah pernah diminta oleh user yang sama
        $existingRequest = $this->bukuRequest->where('id_anggota', $id_anggota)
            ->where('judul_buku', $judul_buku)
            ->first();

        if ($existingRequest) {
            return redirect()->back()->withInput()->with('error', 'Anda sudah pernah meminta buku ini.');
        }

        $data = [
            'judul_buku' => $this->request->getPost('judul_buku'),
            'jenis_buku' => $this->request->getPost('jenis_buku'),
            'edisi_tahun' => $this->request->getPost('edisi_tahun'),
            'pengarang' => $this->request->getPost('pengarang'),
            'penerbit' => $this->request->getPost('penerbit'),
            'link_beli' => $this->request->getPost('link_beli'),
            'perkiraan_harga' => $this->request->getPost('perkiraan_harga'),
            'tanggal_request' => date("Y-m-d"),
            'id_anggota' => $id_anggota
        ];

        $this->bukuRequest->save($data);
        return redirect()->to('/buku_request')->with('success', 'Berhasil Mengisi Form');
    }

    public function HistoryBuku()
    {
        $id_session = session()->get('id_anggota');

        $buku_request = new BukuRequestModel();

        $buku_history = $buku_request->where('id_anggota', $id_session)->findAll();

        return view('pages/regular/historyBuku', ['buku_history' => $buku_history]);
    }

    // staff dashboard buku
    public function pendingBuku()
    {
        $pendingBuku = $this->viewBuku->where('status', 'pending')->findAll();
        return view('pages/staff/buku_request/pending', ['pendingBuku' => $pendingBuku]);
    }

    public function disetujuiBuku()
    {
        $disetujuiBuku = $this->viewBuku->where('status', 'diterima')->findAll();
        return view('pages/staff/buku_request/disetujui', ['disetujuiBuku' => $disetujuiBuku]);
    }

    public function prosesBuku()
    {
        $prosesBuku = $this->viewBuku->where('status', 'proses eksekusi')->findAll();
        return view('pages/staff/buku_request/proses', ['prosesBuku' => $prosesBuku]);
    }

    public function editStatusBuku($judul_buku, $status)
    {
        try {
            // Decode the book title from URL encoding
            $judul_buku = urldecode($judul_buku);
            log_message('info', "Mengubah status untuk buku: $judul_buku menjadi $status");

            // Cari semua buku yang memiliki judul yang sama
            $buku_list = $this->bukuRequest->where('judul_buku', $judul_buku)->findAll();

            // Jika buku ditemukan, perbarui status semua buku yang memiliki judul tersebut
            if ($buku_list) {
                $addedToBuku = false;

                foreach ($buku_list as $b) {
                    $this->bukuRequest->update($b->id_request_buku, ['status' => $status]);
                    log_message('info', "Status buku dengan ID: {$b->id_request_buku} telah diperbarui menjadi $status");

                    // Tambahkan data ke tabel buku jika statusnya 'sudah dieksekusi' dan belum ditambahkan
                    if ($status == 'sudah dieksekusi' && !$addedToBuku) {
                        if (!$this->addToBuku($b)) {
                            throw new \Exception('Gagal menambahkan data ke tabel buku');
                        }
                        log_message('info', "Data buku dengan ID: {$b->id_request_buku} telah ditambahkan ke tabel buku");
                        $addedToBuku = true;
                    }

                    // Pindahkan data ke tabel arsip jika statusnya 'sudah dieksekusi' atau 'ditolak'
                    if ($status == 'sudah dieksekusi' || $status == 'ditolak') {
                        if (!$this->moveToArchive($b->id_request_buku)) {
                            throw new \Exception('Gagal memindahkan data ke tabel arsip');
                        }
                        log_message('info', "Data buku dengan ID: {$b->id_request_buku} telah dipindahkan ke tabel arsip");
                    }
                }
                return $this->response->setJSON(['status' => 'success']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Buku tidak ditemukan']);
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setJSON(['status' => 'error', 'message' => 'Terjadi kesalahan dalam memperbarui status.']);
        }
    }

    protected function moveToArchive($id_request_buku)
    {
        // Dapatkan data request buku
        $buku_request = $this->bukuRequest->find($id_request_buku);

        if ($buku_request) {
            // Pindahkan data ke tabel arsip
            $db = \Config\Database::connect();
            $builder = $db->table('arsip_request_buku');
            if ($builder->insert((array)$buku_request)) {
                // Hapus data dari tabel request_buku
                return $this->bukuRequest->delete($id_request_buku);
            }
        }
        return false;
    }

    protected function addToBuku($buku_request)
    {
        // Tambahkan data ke tabel buku
        $db = \Config\Database::connect();
        $builder = $db->table('buku');
        $data = [
            'judul_buku' => $buku_request->judul_buku,
            'cover' => '', // Jika ada field cover, bisa diisi dengan data yang sesuai
            'edisi_tahun' => $buku_request->edisi_tahun,
            'penerbit' => $buku_request->penerbit,
            'jenis_buku' => $buku_request->jenis_buku,
            'pengarang' => $buku_request->pengarang
        ];
        return $builder->insert($data);
    }
}
