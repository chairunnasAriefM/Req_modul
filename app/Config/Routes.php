<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('forbidden',  function () {
    return view('errors/html/403');
});

$routes->get('/', 'Home::index');
$routes->get('/daftar-buku', 'BukuController::show');
// auth
$routes->get('/login', 'Auth::index');
$routes->get('/login/proses', 'Auth::proses');
$routes->post('/login', 'Auth::loginBiasa');
$routes->get('logout', 'Auth::logout');
$routes->get('/registrasi', 'Auth::registrasi');
$routes->post('/registrasi', 'Auth::registrasiProses');
$routes->get('/registrasiStaff', 'Auth::registrasiStaff');
$routes->post('/registrasiStaff', 'Auth::registrasiProsesStaff');

// hash pass
$routes->get('hash', 'Auth::rehashPasswords');


// buku_request
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('buku_request', 'BukuRequest::index');
    $routes->post('buku_request', 'BukuRequest::store');
    $routes->get('historyBuku', 'BukuRequest::HistoryBuku');
});


// dosen
$routes->group('', ['filter' => 'dosen'], function ($routes) {
    $routes->get('/modul_request', 'ModulRequest::index');
    $routes->post('/request_modul', 'ModulRequest::store');
    $routes->post('modul-request/judul-modul', 'ModulRequest::getJudulModulByJurusanProdi');
    $routes->get('historyModul', 'ModulRequest::historyModul');
});

//staff

$routes->group('', ['filter' => 'staff'], function ($routes) {

    $routes->get('dashboard', 'Dashboard::index');

    /* start routes untuk modul*/

    $routes->get('dashboard/tampil-modul', 'ModulController::index');
    $routes->get('dashboard/tambah-modul', 'ModulController::tambah');
    $routes->post('dashboard/tambah-modul', 'ModulController::store');
    $routes->post('dashboard/update-modul/(:num)', 'ModulController::update/$1');
    $routes->delete('dashboard/hapus-modul/(:num)', 'ModulController::destroy/$1');


    /* end routes untuk request modul */

    /* start routes untuk request modul */

    $routes->get('dashboard/request/modul-pending', 'ModulRequest::pendingModul');
    $routes->get('dashboard/request/modul-setuju', 'ModulRequest::disetujuiModul');
    $routes->get('dashboard/request/modul-proses', 'ModulRequest::prosesModul');

    // ubah status
    $routes->post('/dashboard/editStatus/(:num)/(:segment)', 'ModulRequest::editStatus/$1/$2');

    // Routes membaca file dari writable/uploads 
    $routes->get('uploads/modul/(:any)', 'UploadsController::index/$1');

    // export to excel
    $routes->get('dashboard/export-modul', 'Dashboard::exportModulToExcel');

    /* end routes untuk request modul */

    /* start routes untuk Buku*/

    $routes->get('dashboard/tampil-buku', 'BukuController::index');
    $routes->get('dashboard/tambah-buku', 'BukuController::tambah');
    $routes->post('dashboard/tambah-buku', 'BukuController::store');
    $routes->post('dashboard/update-buku/(:num)', 'BukuController::update/$1');
    $routes->delete('dashboard/hapus-buku/(:num)', 'BukuController::destroy/$1');



    /* end routes untuk request modul */

    // routes untuk request Buku
    $routes->get('dashboard/request/buku-pending', 'Dashboard::pendingBuku');
    $routes->get('dashboard/request/buku-setuju', 'Dashboard::disetujuiBuku');
    $routes->get('dashboard/request/buku-proses', 'Dashboard::prosesBuku');

    // ubah status
    $routes->post('/dashboard/editStatusBuku/(:segment)/(:segment)', 'BukuRequest::editStatusBuku/$1/$2');

    // export to excel
    $routes->get('dashboard/export-buku', 'Dashboard::exportBukuToExcel');

    // routes pengaturan dosen 

    // tampil dosen
    $routes->get('/dashboard/tampilDosen', 'Auth::tampilDosen');

    // tambah dosen
    $routes->get('/dashboard/tambahDosen',   function () {
        return view('pages/staff/dosen/tambahDosen.php');
    });
    $routes->post('/dashboard/tambahDosen', 'Auth::tambahDosen');

    // update dosen 
    $routes->post('/dashboard/dosen/update', 'Auth::updateDosen');

    // delete dosen 
    $routes->get('/dashboard/dosen/delete/(:segment)', 'Auth::deleteDosen/$1');
});
