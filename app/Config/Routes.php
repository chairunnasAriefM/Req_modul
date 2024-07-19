<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('forbidden',  function () {
    return view('errors/html/403');
});

$routes->get('/',   function () {
    return view('pages/index');
});
// auth
$routes->get('/login', 'Auth::index');
$routes->get('/login/proses', 'Auth::proses');
$routes->post('/login', 'Auth::loginBiasa');
$routes->get('logout', 'Auth::logout');
$routes->get('/registrasi', 'Auth::registrasi');
$routes->post('/registrasi', 'Auth::registrasiProses');
$routes->get('/registrasiStaff', 'Auth::registrasiStaff');
$routes->post('/registrasiStaff', 'Auth::registrasiProsesStaff');



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

    $routes->get('dashboard/pendingModul', 'ModulRequest::pendingModul');
    $routes->get('dashboard/disetujuiModul', 'ModulRequest::disetujuiModul');
    $routes->get('dashboard/prosesModul', 'ModulRequest::prosesModul');

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
    $routes->get('dashboard/pendingBuku', 'BukuRequest::pendingBuku');
    $routes->get('dashboard/disetujuiBuku', 'BukuRequest::disetujuiBuku');
    $routes->get('dashboard/prosesBuku', 'BukuRequest::prosesBuku');

    // ubah status
    $routes->post('/dashboard/editStatusBuku/(:num)/(:segment)', 'BukuRequest::editStatusBuku/$1/$2');

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
