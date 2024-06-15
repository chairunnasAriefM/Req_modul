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
$routes->get('/login/keluar', 'Login::logout');
$routes->get('/registrasi', 'Login::registrasi');
$routes->post('/registrasi', 'Login::registrasiProses');



$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('buku_request', 'BukuRequest::index');
    $routes->post('buku_request', 'BukuRequest::store');
    // $routes->post('/buku_request/store', 'BukuRequest::store');
});

$routes->group('', ['filter' => 'dosen'], function ($routes) {
    $routes->get('/request_modul', 'ModulRequest::index');
    // Tambahkan routes lain yang memerlukan akses dosen di sini
});
