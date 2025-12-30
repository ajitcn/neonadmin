<?php

$routes->group('admin', ['filter' => ['auth']], function($routes) { //#Start admin group

    // Homepage Setup Routes
    $routes->get('home-page-setup/(:any)', 'admin\HomePageSetup::index/$1');
    $routes->post('create-home-page-setup', 'admin\HomePageSetup::create');
    $routes->get('edit-home-page-setup', 'admin\HomePageSetup::edit');
    $routes->post('update-home-page-setup', 'admin\HomePageSetup::update');
    $routes->get('delete-home-page-setup/(:num)', 'admin\HomePageSetup::delete/$1');


    // Section Management Routes
    $routes->post('save-section', 'admin\HomePageSetup::createSection'); 
    $routes->post('update-section', 'admin\HomePageSetup::updateSection');
    $routes->get('delete-section/(:num)', 'admin\HomePageSetup::deleteSection/$1');
    // $routes->get('sections', 'admin\HomePageSetup::listSectionsPage');

    //homepage banner
    $routes->get('home-page-banner/(:any)', 'admin\HomePageBanner::index/$1');
    $routes->post('create-home-page-banner', 'admin\HomePageBanner::create');
    $routes->get('edit-home-page-banner', 'admin\HomePageBanner::edit');
    $routes->post('update-home-page-banner', 'admin\HomePageBanner::update');
    $routes->get('delete-home-page-banner/(:num)', 'admin\HomePageBanner::delete/$1');


}); //#End admin group

?>
