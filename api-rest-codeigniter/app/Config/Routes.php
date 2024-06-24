<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', ['namespace' => 'App\Controllers\API'], function($routes){

    $routes->get('clientes', 'CustomersController::index');
    $routes->get('clientes/(:num)', 'CustomersController::show/$1');
    $routes->post('clientes', 'CustomersController::create');
    $routes->put('clientes/(:num)', 'CustomersController::update/$1');
    $routes->delete('clientes/(:num)', 'CustomersController::delete/$1');

});