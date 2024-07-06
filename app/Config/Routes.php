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

    $routes->get('/dashboard', function () {
        return view('pages/staff/home.php');
    });
    $routes->get('/', 'Dashboard::dashboard'); // Rute untuk halaman dashboard
    $routes->get('dashboard/index', 'Dashboard::index'); //rute untuk modul
    $routes->get('dashboard/indexx', 'Dashboard::indexx'); //rute untuk buku

    //-----------------------------------------------------------------------------------------------//

    // Rute tambahan untuk fungsionalitas modul
    $routes->get('dashboard/index/pending', 'Dashboard::pending');
    $routes->get('dashboard/index/proses', 'Dashboard::index');
    $routes->post('dashboard/index/editStatus/(:num)', 'Dashboard::editStatus/$1');
    $routes->get('dashboard/index/checkPdfContent/(:num)', 'Dashboard::checkPdfContent/$1');

    //-----------------------------------------------------------------------------------------------//

    // Rute tambahan untuk fungsionalitas Buku
    $routes->get('dashboard/indexx/pendingBuku', 'Dashboard::pendingBuku');
    $routes->get('dashboard/indexx/prosesBuku', 'Dashboard::indexx');
    $routes->post('dashboard/indexx/editStatusBuku/(:num)', 'Dashboard::editStatusBuku/$1');
});
