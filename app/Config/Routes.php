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

    // routes untuk modul 
    $routes->get('dashboard/pendingModul', 'Dashboard::pendingModul');
    $routes->get('dashboard/disetujuiModul', 'Dashboard::disetujuiModul');
    $routes->get('dashboard/prosesModul', 'Dashboard::prosesModul');

    // ubah status
    $routes->post('/dashboard/editStatus/(:num)/(:segment)', 'Dashboard::editStatus/$1/$2');

    // Routes membaca file dari writable/uploads 
    $routes->get('uploads/(:any)', 'UploadsController::index/$1');

    // export to excel
    $routes->get('dashboard/export-modul', 'Dashboard::exportModulToExcel');


    // routes untuk Buku
    $routes->get('dashboard/pendingBuku', 'Dashboard::pendingBuku');
    $routes->get('dashboard/disetujuiBuku', 'Dashboard::disetujuiBuku');
    $routes->get('dashboard/prosesBuku', 'Dashboard::prosesBuku');

    // ubah status
    $routes->post('/dashboard/editStatusBuku/(:num)/(:segment)', 'Dashboard::editStatusBuku/$1/$2');

    // export to excel
    $routes->get('dashboard/export-buku', 'Dashboard::exportBukuToExcel');
});
