<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModulModel;

class Dashboard extends BaseController
{
    protected $modulModel;

    public function __construct()
    {
        $this->modulModel = new ModulModel();
    }

    public function index()
    {
        // Modul
        $totalModul = $this->modulModel->countAll();
        $statusCountsModul = $this->getStatusCounts($this->modulModel);

        $data = [
            'totalModul' => $totalModul,
            'totalModulPending' => $statusCountsModul['totalPending'],
            'totalModulTerima' => $statusCountsModul['totalTerima'],
            'totalModulTolak' => $statusCountsModul['totalTolak'],
            'totalModulProses' => $statusCountsModul['totalProses'],
            'totalModulSelesai' => $statusCountsModul['totalSelesai'],
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

    public function proses()
    {
        $prosesModul = $this->modulModel->where('status', 'proses eksekusi')->findAll();
        return view('pages/staff/modul/proses', ['prosesModul' => $prosesModul]);
    }

    public function editStatus($modul_id, $status)
    {
        $this->modulModel->update($modul_id, ['status' => $status]);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function CekPdf($modul_id)
    {
        return view('pages/staff/Cekpdf', ['modul_id' => $modul_id]);
    }
}

    