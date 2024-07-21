<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Home extends BaseController
{
    public function index()
    {
        $buku = new BukuModel();
        $oneYearAgo = date('Y-m-d H:i:s', strtotime('-1 year'));

        // $perPage = 5; // Jumlah item per halaman
        // $currentPage = $this->request->getVar('page') ?? 1; // Ambil halaman saat ini
        // $offset = ($currentPage - 1) * $perPage; // Hitung offset

        $totalBooks = $buku->where('created_at >=', $oneYearAgo)->countAllResults(); // Total buku
        // $totalPages = ceil($totalBooks / $perPage); // Total halaman

        $data = $buku->where('created_at >=', $oneYearAgo)
            // ->limit($perPage, $offset)
            ->findAll();

        return view('pages/index', [
            'data' => $data
        ]);
    }
}
