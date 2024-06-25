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

    $routes->get('produtos', 'ProductsController::index');
    $routes->get('produtos/(:num)', 'ProductsController::show/$1');
    $routes->post('produtos', 'ProductsController::create');
    $routes->put('produtos/(:num)', 'ProductsController::update/$1');
    $routes->delete('produtos/(:num)', 'ProductsController::delete/$1');

    $routes->get('pedidos', 'PurchaseRequestsController::index');
    $routes->get('pedidos/(:num)', 'PurchaseRequestsController::show/$1');
    $routes->post('pedidos/', 'PurchaseRequestsController::create');
    $routes->put('pedidos/(:num)', 'PurchaseRequestsController::update/$1');
    $routes->delete('pedidos/(:num)', 'PurchaseRequestsController::delete/$1');
});