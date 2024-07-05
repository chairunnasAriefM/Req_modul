<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StaffPerpustakaanModel;
use App\Models\CountStaffModel;
use App\Models\ModulModel;
use App\Models\BukuRequestModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $homeModel = new StaffPerpustakaanModel();
        $data['home'] = $homeModel->findAll();

        $modulModel = new ModulModel();
        $data['count_pending_modul'] = $modulModel->get_count_pending_modul();
        $data['count_proses_modul'] = $modulModel->get_count_proses_modul();

        $BukuRequestModel = new BukuRequestModel();
        $data['count_pending_buku'] = $BukuRequestModel->get_count_pending_buku();
        $data['count_proses_buku'] = $BukuRequestModel->get_count_proses_buku();

        return view('pages/staff/home', $data);
    }
    
    //public function index()
    //{
    //    $homeModel = new StaffPerpustakaanModel();
    //    $data['home'] = $homeModel->findAll();
    //
    //  $countModel = new CountStaffModel();
    //  $data['count_pending_modul'] = $countModel->get_count_pending_modul();
    //  $data['count_proses_modul'] = $countModel->get_count_proses_modul();
    //  $data['count_pending_buku'] = $countModel->get_count_pending_buku();
    //  $data['count_proses_buku'] = $countModel->get_count_proses_buku();
        
    //  return view('pages/staff/home', $data);
    //}

    public function pendingModul()
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
}
