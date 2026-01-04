<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('debug-session', function () {
    echo 'ok';
     
});
//auth
$routes->get('account/user-login', 'account\Auth::index');
$routes->post('account/verify-login', 'account\Auth::verifyLogin');
$routes->post('account/update-user-password', 'account\Auth::updateUserPassword');




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






