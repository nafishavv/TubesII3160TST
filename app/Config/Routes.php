<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('user/register', 'UserController::register');
$routes->post('user/login', 'UserController::login');
$routes->post('user/logout', 'UserController::logout');
$routes->put('user/updateProfile', 'UserController::updateProfile');
$routes->get('user/show', 'UserController::show');
$routes->delete('user/deleteAccount', 'UserController::deleteAccount');

// tambahan buat admin, tapi belum di set
// $routes->get('user', 'UserController::index');