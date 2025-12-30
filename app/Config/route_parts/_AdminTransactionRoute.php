<?php

$routes->group('admin', ['filter' => ['auth']], function($routes) { //# Start admin group

    // Payment Transation Routes
    $routes->get('payment-transaction/(:num)', 'admin\PaymentTransaction::index/$1'); 

}); //# End admin group