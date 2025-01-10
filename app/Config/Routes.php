<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'CustomerController::showRegisterView');

// Customer routes
$routes->group('customer', function($routes) {
    $routes->get('register', 'CustomerController::showRegisterView');
    $routes->get('login', 'CustomerController::showLoginView');
    $routes->post('register', 'CustomerController::register');
    $routes->post('login', 'CustomerController::login');

    $routes->group('', ['filter' => 'customer'], function($routes) {
        $routes->get('home', 'CustomerController::home');
        $routes->get('updateProfile', 'CustomerController::updateProfileView');
        $routes->post('updateProfile', 'CustomerController::updateProfile');
        $routes->get('showProfile', 'CustomerController::showProfile');
        $routes->get('deleteAccount', 'CustomerController::deleteAccount');
        $routes->get('logout', 'CustomerController::logout');
        $routes->get('reservationPage', 'ReservationController::reservationPage');
        $routes->get('checkout', 'ReservationController::checkoutPage');
        $routes->get('makeReservation', 'ReservationController::makeReservation');
        $routes->post('makeReservation', 'ReservationController::makeReservation');
        $routes->post('confirmCheckout', 'ReservationController::confirmCheckout');
        $routes->get('feedbackPage', 'FeedbackController::feedbackPage');
        $routes->get('feedbackForm', 'FeedbackController::feedbackForm');
        $routes->post('submitFeedback', 'FeedbackController::submitFeedback');
    



    });
});

// Admin routes
$routes->group('admin', function($routes) {
    $routes->get('register', 'AdminController::showRegisterView');
    $routes->get('login', 'AdminController::showLoginView');
    $routes->post('register', 'AdminController::register');
    $routes->post('login', 'AdminController::login');
    $routes->get('home', 'AdminController::showHomeView');
    $routes->get('/', 'AdminController::showRegisterView');


    $routes->group('', ['filter' => 'admin'], function($routes) {
        $routes->post('updateProfile', 'AdminController::updateProfile');
        $routes->get('data', 'AdminController::showProfile');
        $routes->get('logout', 'AdminController::logout');
        $routes->get('customers', 'AdminController::getAllCustomer');
        $routes->get('customer_details', 'AdminController::getAllCustomer');
        $routes->get('customer/(:num)', 'AdminController::getCustomerByID/$1');
        $routes->get('manageRooms', 'AdminController::manageRooms');
        $routes->post('addRoom', 'AdminController::addRoom');
        $routes->get('addRoom', 'AdminController::addRoom');
        $routes->post('updateRoom/(:num)', 'AdminController::updateRoom/$1');
        $routes->post('deleteRoom/(:num)', 'AdminController::deleteRoom/$1');
        $routes->get('editRoom/(:num)', 'AdminController::editRoom/$1');
        $routes->get('addRoomPage', 'AdminController::addRoomPage');
        $routes->post('addRoomPage', 'AdminController::addRoomPage');
        $routes->get('viewReservations', 'ReservationController::viewReservations');
        $routes->get('manageAvailability/(:num)', 'ReservationController::manageAvailability/$1');
        $routes->post('manageAvailability/(:num)', 'ReservationController::manageAvailability/$1');
        $routes->get('updateAvailability/(:num)', 'ReservationController::manageAvailability/$1');
        $routes->post('updateAvailability/(:num)', 'ReservationController::manageAvailability/$1');
        $routes->get('viewCustomer/(:num)', 'ReservationController::viewCustomer/$1');
        $routes->get('viewFeedback', 'FeedbackController::viewFeedback');






    });
});

// RoomType routes
$routes->group('roomType', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'RoomTypeController::index');
    $routes->get('add', 'RoomTypeController::addView');
    $routes->post('add', 'RoomTypeController::add');
    $routes->get('edit/(:num)', 'RoomTypeController::editView/$1');
    $routes->post('update/(:num)', 'RoomTypeController::update/$1');
    $routes->get('delete/(:num)', 'RoomTypeController::delete/$1');
    });