<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */





$routes->get('/login', 'Login::index');
$routes->get('/login/proses', 'Login::proses');
$routes->get('login/keluar', 'Login::logout');

$routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Home::index', ['filter' => 'auth']);
    
});
