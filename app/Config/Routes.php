<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('/', 'CustomerController::showRegisterView');
// $routes->get('/customer/register', 'CustomerController::showRegisterView');
// $routes->get('/customer/login', 'CustomerController::showLoginView');
$routes->get('/customer/home', 'CustomerController::home', ['filter' => 'customer']);

$routes->group('customer', function($routes) {
    $routes->get('register', 'CustomerController::showRegisterView');
    $routes->get('login', 'CustomerController::showLoginView');
    $routes->post('register', 'CustomerController::register');
    $routes->post('login', 'CustomerController::login');

    // Protect routes for logged-in users only
    $routes->group('', ['filter' => 'customer'], function($routes) {
        $routes->post('updateProfile', 'CustomerController::updateProfile');
        $routes->get('showProfile/(:num)', 'CustomerController::showProfile/$1');
        $routes->delete('deleteAccount/(:num)', 'CustomerController::deleteAccount/$1');
        $routes->get('getTotalPoints/(:num)', 'CustomerController::getTotalPoints/$1');
        $routes->post('addPoints', 'CustomerController::addPoints');
        $routes->post('redeemPoints', 'CustomerController::redeemPoints');
        $routes->post('logout', 'CustomerController::logout');
    });
});


// $routes->post('user/register', 'UserController::register');
// $routes->post('user/login', 'UserController::login');
// $routes->post('user/logout', 'UserController::logout');
// $routes->put('user/updateProfile', 'UserController::updateProfile');
// $routes->get('user/show', 'UserController::show');
// $routes->delete('user/deleteAccount', 'UserController::deleteAccount');

// // tambahan buat admin, tapi belum di set
// // $routes->get('user', 'UserController::index');


// // Routes for Room Management
// $routes->get('room', 'RoomController::getAllRooms');
// $routes->get('room/available', 'RoomController::getAvailableRooms');
// $routes->post('room/addRoom', 'RoomController::addRoom');
// $routes->put('room/availability/(:num)', 'RoomController::updateAvailability/$1');
// $routes->put('room/price/(:num)', 'RoomController::updatePrice/$1');
// $routes->get('room/(:num)', 'RoomController::getRoomInfo/$1');


// $routes->group('room', ['filter' => 'admin'], function($routes) {
//     $routes->get('/', 'RoomController::index'); // List all rooms
//     $routes->post('add', 'RoomController::addRoom'); // Add new room
//     $routes->post('availability/(:num)', 'RoomController::updateAvailability/$1'); // Update availability
//     $routes->post('price/(:num)', 'RoomController::updatePrice/$1'); // Update price
// });