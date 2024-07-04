<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModulModel;
use App\Models\BukuRequestModel;

class Dashboard extends BaseController
{


    public function index()
    {
        $modul = new ModulModel();
        $buku = new BukuRequestModel();

        // modul
        $totalModul = $modul->countAll();
        $totalModulPending = $modul->where('status', 'pending')->countAllResults();
        $totalModulTerima = $modul->where('status', 'diterima')->countAllResults();
        $totalModulTolak = $modul->where('status', 'ditolak')->countAllResults();
        $totalModulProses = $modul->where('status', 'proses eksekusi')->countAllResults();
        $totalModulSelesai = $modul->where('status', 'sudah dieksekusi')->countAllResults();

        // buku
        $totalBuku = $buku->countAll();
        $totalBukuPending = $buku->where('status', 'pending')->countAllResults();
        $totalBukuTerima = $buku->where('status', 'diterima')->countAllResults();
        $totalBukuTolak = $buku->where('status', 'ditolak')->countAllResults();
        $totalBukuProses = $buku->where('status', 'proses eksekusi')->countAllResults();
        $totalBukuSelesai = $buku->where('status', 'sudah dieksekusi')->countAllResults();

        $data = [
            // modul
            'totalModul' => $totalModul,
            'totalModulPending' => $totalModulPending,
            'totalModulTerima' => $totalModulTerima,
            'totalModulTolak' => $totalModulTolak,
            'totalModulProses' => $totalModulProses,
            'totalModulSelesai' => $totalModulSelesai,
            // buku
            'totalBuku' => $totalBuku,
            'totalBukuPending' => $totalBukuPending,
            'totalBukuTerima' => $totalBukuTerima,
            'totalBukuTolak' => $totalBukuTolak,
            'totalBukuProses' => $totalBukuProses,
            'totalBukuSelesai' => $totalBukuSelesai,
        ];

        return view('pages/staff/home', $data);
    }

    // modul
    public function pendingModul()
    {
        $modulModel = new ModulModel();
        $pendingModul = $modulModel->where('status', 'pending')->findAll();
        $data = ['pendingModul' => $pendingModul];
        return view('pages/staff/modul/pending', $data);
    }

    public function proses()
    {
        $modulModel = new ModulModel();
        $prosesModul = $modulModel->where('status', 'proses eksekusi')->findAll();
        $data = ['prosesModul' => $prosesModul];
        return view('pages/staff/modul/proses', $data);
    }

    public function editStatus($modul_id)
    {
        $modulModel = new ModulModel();
        $newStatus = $this->request->getPost('new_status');
        $modulModel->update($modul_id, ['status' => $newStatus]);
        return redirect()->to('/dashboard/pending');
    }
    public function CekPdf($modul_id)
    {
        $data = ['modul_id' => $modul_id];
        return view('pages/staff/Cekpdf', $data);
    }
}
