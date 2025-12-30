<?php

	/*===========================================
	=            Admin Login Section             =
	============================================*/

	 
	//auth
	$routes->get('account/user-login', 'account\Auth::index');
	$routes->post('account/verify-login', 'account\Auth::verifyLogin');
	$routes->post('account/update-user-password', 'account\Auth::updateUserPassword');

	 

	/*=========  Admin Login Section   ==========*/



	//After login actions
	$routes->group('admin', ['filter' => ['auth']], function($routes) {

		//logout
	    $routes->get('account/logout-user', 'account\Auth::logoutUser');

	});

?>