<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


/*include individual routes*/

include 'route_parts/_AdminLoginRoute.php';
include 'route_parts/_AdminMemberRoute.php';
include 'route_parts/_AdminMediaCategoryRoute.php';
include 'route_parts/_AdminMediaGenreRoute.php';
include 'route_parts/_AdminMediaContentRoute.php';
include 'route_parts/_AdminPackageRoute.php';
include 'route_parts/_AdminPromoCodesRoute.php';
include 'route_parts/_AdminPaymentGatewayRoute.php';
include 'route_parts/_AdminHomePageSetupRoute.php';
include 'route_parts/_AdminTransactionRoute.php';



$routes->group('admin', ['filter' => ['auth']], function($routes) {//#Start admin group

/*=========================================
=            Dashboard Section            =
==========================================*/

$routes->get('dashboard', 'admin\Dashboard::index');

/*=====  End of Dashboard Section  ======*/

});//#End admin group



$routes->get('debug-session', function () {
    return 'ok';
     
});

//$routes->get('/', 'Home::index');


