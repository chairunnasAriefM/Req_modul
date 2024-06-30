<?php

namespace App\Controllers;

use App\Models\BukuRequestModel;

class Home extends BaseController
{
    public function index()
    {
        $bukuModel = new BukuRequestModel();
        $data['moduls'] = $bukuModel->findAll();
        // return $this->response->setJSON($data);

        return view('pages/index', $data);
    }

}
