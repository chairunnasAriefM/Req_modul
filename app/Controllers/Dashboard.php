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
        $modulModel = new ModulModel();
        $pendingModul = $modulModel->where('status', 'pending')->findAll();
        $data = ['pendingModul' => $pendingModul];

        // return $this->response->setJSON($data);
        return view('pages/staff/dashboard', $data);

        // return view('layouts/LayoutDashboard');
    }

    public function pending()
    {
        $modulModel = new ModulModel();
        $pendingModul = $modulModel->where('status', 'pending')->findAll();
        $data = ['pendingModul' => $pendingModul];
        return view('pages/staff/pending', $data);
    }

    public function proses()
    {
        $modulModel = new ModulModel();
        $prosesModul = $modulModel->where('status', 'proses eksekusi')->findAll();
        $data = ['prosesModul' => $prosesModul];
        return view('pages/staff/proses', $data);
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

    public function indexx()
    {
        $BukuRequestModel = new BukuRequestModel();
        $pendingBuku = $BukuRequestModel->where('status', 'pending')->findAll();
        $data = ['pendingBuku' => $pendingBuku];
        return view('pages/staff/dashboard', $data);
    }

    public function pendingBuku()
    {
        $BukuRequestModel = new BukuRequestModel();
        $pendingBuku = $BukuRequestModel->where('status', 'pending')->findAll();
        $data = ['pendingBuku' => $pendingBuku];
        return view('pages/staff/pendingBuku', $data);
    }

    public function prosesBuku()
    {
        $BukuRequestModel = new BukuRequestModel();
        $prosesBuku = $BukuRequestModel->where('status', 'proses eksekusi')->findAll();
        $data = ['prosesBuku' => $prosesBuku];
        return view('pages/staff/prosesBuku', $data);
    }

    public function editStatusBuku($buku_id)
    {
        $BukuRequestModel = new BukuRequestModel();
        $newStatusBuku = $this->request->getPost('new_status');
        $BukuRequestModel->update($buku_id, ['status' => $newStatusBuku]);
        return redirect()->to('/dashboard/pendingBuku');
    }
}
