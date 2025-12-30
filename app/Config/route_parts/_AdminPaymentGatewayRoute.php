<?php

$routes->group('admin', ['filter' => ['auth']], function($routes) { //#Start admin group

    // payment gateway routes
    $routes->get('payment-gateway', 'admin\PaymentGateway::index');
    $routes->post('create-payment-gateway', 'admin\PaymentGateway::create');
    $routes->get('edit-payment-gateway', 'admin\PaymentGateway::edit');
    $routes->post('update-payment-gateway', 'admin\PaymentGateway::update');
    $routes->get('delete-payment-gateway/(:num)', 'admin\PaymentGateway::delete/$1');

}); //#End admin group

?>
