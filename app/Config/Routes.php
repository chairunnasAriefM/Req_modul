<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('tes', 'Home::tes');

$routes->get('/', 'Home::index');

// auth
$routes->get('/login', 'Login::index');
$routes->get('/login/proses', 'Login::proses');
$routes->post('/login', 'Login::loginBiasa');
$routes->get('logout', 'Login::logout');
$routes->get('/registrasi', 'Login::registrasi');
$routes->post('/registrasi', 'Login::registrasiProses');


// buku_request
$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('buku_request', 'BukuRequest::index');
    $routes->post('buku_request', 'BukuRequest::store');
    // $routes->post('/buku_request/store', 'BukuRequest::store');
});

// dosen
$routes->group('', ['filter' => 'dosen'], function ($routes) {
    $routes->get('/modul_request', 'ModulRequest::index');
    $routes->post('/modul_request', 'ModulRequest::store');
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
    // Menambahkan rute untuk modul
    $routes->get('dashboard/modul', 'Dashboard::index');
    
    // Rute tambahan untuk fungsionalitas modul
    $routes->get('/dashboard/modul/pending', 'Dashboard::pending');
    $routes->get('/dashboard/modul/proses', 'Dashboard::proses');
    $routes->post('/dashboard/modul/editStatus/(:num)', 'Dashboard::editStatus/$1');
    
    // Rute untuk halaman preview modul
    $routes->get('/dashboard/modul/preview/(:num)', 'Dashboard::preview/$1');
    $routes->get('/dashboard/modul/checkPdfContent/(:num)', 'Dashboard::CekPdf/$1');
});



     

   

