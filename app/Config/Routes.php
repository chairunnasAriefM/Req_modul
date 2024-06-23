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
    $routes->post('/request_modul', 'ModulRequest::store');
});

//staff
$routes->group('', ['filter' => 'staff'], function ($routes) {
    $routes->get('/dashboard', function () {
        return view('pages/staff/home.php');
    });
    $routes->get('/dashboard/modul', 'ModulRequest::show');
});
