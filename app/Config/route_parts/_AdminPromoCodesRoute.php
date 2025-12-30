<?php

$routes->group('admin', ['filter' => ['auth']], function($routes) { //# Start admin group

    // Promo Codes Routes
    $routes->get('promo-codes', 'admin\PromoCodes::index');             
    $routes->post('create-promo-code', 'admin\PromoCodes::create');    
    $routes->get('edit-promo-code', 'admin\PromoCodes::edit');         
    $routes->post('update-promo-code', 'admin\PromoCodes::update');    
    $routes->get('delete-promo-code/(:num)', 'admin\PromoCodes::delete/$1');

}); //# End admin group
