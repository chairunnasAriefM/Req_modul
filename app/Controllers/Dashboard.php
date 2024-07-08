<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModulModel;
use App\Models\BukuRequestModel;

class Dashboard extends BaseController
{
    protected $modulModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->modulModel = new ModulModel();
        $this->bukuModel = new BukuRequestModel();
    }

    public function index()
    {
        // Modul
        $totalModul = $this->modulModel->countAll();
        $statusCountsModul = $this->getStatusCounts($this->modulModel);

        // Buku
        $totalBuku = $this->bukuModel->countAll();
        $statusCountsBuku = $this->getStatusCounts($this->bukuModel);

        $data = [
            'totalModulPending' => $statusCountsModul['totalPending'],
            'totalModulProses' => $statusCountsModul['totalProses'],
            'totalBukuPending' => $statusCountsBuku['totalPending'],
            'totalBukuProses' => $statusCountsBuku['totalProses'],
        ];

        return view('pages/staff/home', $data);
    }

    protected function getStatusCounts($model)
    {
        return [
            'totalPending' => $model->where('status', 'pending')->countAllResults(),
            'totalTerima' => $model->where('status', 'diterima')->countAllResults(),
            'totalTolak' => $model->where('status', 'ditolak')->countAllResults(),
            'totalProses' => $model->where('status', 'proses eksekusi')->countAllResults(),
            'totalSelesai' => $model->where('status', 'sudah dieksekusi')->countAllResults(),
        ];
    }

    public function pendingModul()
    {
        $pendingModul = $this->modulModel->where('status', 'pending')->findAll();
        return view('pages/staff/modul/pending', ['pendingModul' => $pendingModul]);
    }

    public function disetujuiModul()
    {
        $disetujuiModul = $this->modulModel->where('status', 'diterima')->findAll();
        return view('pages/staff/modul/disetujui', ['disetujuiModul' => $disetujuiModul]);
    }

    public function prosesModul()
    {
        $prosesModul = $this->modulModel->where('status', 'proses eksekusi')->findAll();
        return view('pages/staff/modul/proses', ['prosesModul' => $prosesModul]);
    }

    public function editStatus($modul_id, $status)
    {
        $this->modulModel->update($modul_id, ['status' => $status]);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function cekPdf($modul_id)
    {
        return view('pages/staff/Cekpdf', ['modul_id' => $modul_id]);
    }

    // buku
    public function pendingBuku()
    {
        $pendingBuku = $this->bukuModel->where('status', 'pending')->findAll();
        return view('pages/staff/buku/pending', ['pendingBuku' => $pendingBuku]);
    }

    public function disetujuiBuku()
    {
        $disetujuiBuku = $this->bukuModel->where('status', 'diterima')->findAll();
        return view('pages/staff/buku/disetujui', ['disetujuiBuku' => $disetujuiBuku]);
    }

    public function prosesBuku()
    {
        $pendingBuku = $this->bukuModel->where('status', 'proses eksekusi')->findAll();
        return view('pages/staff/buku/proses', ['prosesBuku' => $pendingBuku]);
    }

    public function editStatusBuku($id_buku, $status)
    {
        try {
            $this->bukuModel->update($id_buku, ['status' => $status]);
            return $this->response->setJSON(['status' => 'success']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
