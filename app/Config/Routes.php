<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// $routes->get('/',  function () {
//     return view('pages/index');
// });

$routes->get('/',  'Home::index');

// auth
$routes->get('/login', 'Login::index');
$routes->get('/login/proses', 'Login::proses');
$routes->post('/login', 'Login::loginBiasa');
$routes->get('logout', 'Login::logout');
$routes->get('/registrasi', 'Login::registrasi');
$routes->post('/registrasi', 'Login::registrasiProses');


// buku_request
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('buku_request', 'BukuRequest::index');
    $routes->post('buku_request', 'BukuRequest::store');
});
$routes->get('daftar_buku', 'BukuRequest::showNew');
$routes->get('daftar_req', 'BukuRequest::showAll');

// dosen
$routes->group('', ['filter' => 'dosen'], function ($routes) {
    $routes->get('/modul_request', 'ModulRequest::index');
    $routes->post('/request_modul', 'ModulRequest::store');
});

//staff

// Default route
// $routes->get('/', 'Dashboard::index');

// Jika rute tidak ditemukan
// $routes->set404Override(function(){
//     return view('errors/html/error_404');
// });

$routes->group('', ['filter' => 'staff'], function ($routes) {

    $routes->get('dashboard', 'Dashboard::index');

    // modul
    $routes->get('dashboard/pendingModul', 'Dashboard::pendingModul');
    $routes->get('dashboard/prosesModul', 'Dashboard::proses');

    // ubah status
    $routes->post('/dashboard/editStatus/(:num)/(:segment)', 'Dashboard::editStatus/$1/$2');

    // Routes membaca file dari writable/uploads 
    $routes->get('uploads/(:any)', 'UploadsController::index/$1');

    // Rute tambahan untuk fungsionalitas modul
    $routes->get('dashboard/index/pending', 'Dashboard::pending');
    $routes->get('dashboard/index/proses', 'Dashboard::proses');
    $routes->post('dashboard/index/editStatus/(:num)', 'Dashboard::editStatus/$1');

    // Buku
    $routes->get('dashboard/pendingBuku', 'Dashboard::pendingBuku');
    $routes->get('dashboard/prosesBuku', 'Dashboard::prosesBuku');

    // ubah status
    $routes->post('/dashboard/editStatusBuku/(:num)/(:segment)', 'Dashboard::editStatusBuku/$1/$2');
});
