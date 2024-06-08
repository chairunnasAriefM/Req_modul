<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



$routes->get('/', 'Home::index');

$routes->get('/login', 'Login::index');
$routes->get('/login/proses', 'Login::proses');
$routes->get('login/keluar', 'Login::logout');

$routes->get('buku_request', 'BukuRequest::index');
$routes->post('buku_request', 'BukuRequest::store');

$routes->group('/', ['filter' => 'auth'], function ($routes) {
    $routes->get('req', 'Home::index');

    // $routes->post('/buku_request/store', 'BukuRequest::store');
});

$routes->group('', ['filter' => 'dosen'], function ($routes) {
    $routes->get('/request_modul', 'ModulRequest::index');
    // Tambahkan routes lain yang memerlukan akses dosen di sini
});
