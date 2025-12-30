<?php

$routes->group('admin', ['filter' => ['auth']], function($routes) { //#Start admin group

    // Package Routes
    $routes->get('package', 'admin\Package::index');
    $routes->post('create-package', 'admin\Package::create');
    $routes->get('edit-package', 'admin\Package::edit');
    $routes->post('update-package', 'admin\Package::update');
    $routes->get('delete-package/(:num)', 'admin\Package::delete/$1');

}); //#End admin group

?>
