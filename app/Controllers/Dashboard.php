<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModulModel;

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
        return view('dashboard/pending', $data);
    }

    public function proses()
    {
        $modulModel = new ModulModel();
        $prosesModul = $modulModel->where('status', 'proses eksekusi')->findAll();
        $data = ['prosesModul' => $prosesModul];
        return view('dashboard/proses', $data);
    }

    public function editStatus($modul_id)
    {
        $modulModel = new ModulModel();
        $newStatus = $this->request->getPost('new_status');
        $modulModel->update($modul_id, ['status' => $newStatus]);
        return redirect()->to('/dashboard/modul');
    }

    public function preview($modul_id)
    {
        $modulModel = new ModulModel();
        $modul = $modulModel->find($modul_id);
        $data = ['modul' => $modul];
        return view('dashboard/preview', $data);
    }

    public function CekPdf($modul_id)
    {
        $data = ['modul_id' => $modul_id];
        return view('dashboard/check_pdf_content', $data);
    }
}
