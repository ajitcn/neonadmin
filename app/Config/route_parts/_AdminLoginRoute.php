<?php

	/*===========================================
	=            Admin Login Section             =
	============================================*/

  

	/*=========  Admin Login Section   ==========*/



	//After login actions
	$routes->group('admin', ['filter' => ['auth']], function($routes) {

		//logout
	    $routes->get('account/logout-user', 'account\Auth::logoutUser');

	});

?>