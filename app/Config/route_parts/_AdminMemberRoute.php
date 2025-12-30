<?php

	$routes->group('admin', ['filter' => ['auth']], function($routes) {//#Start admin group
		
		$routes->get('members/(:num)', 'admin\Member::index/$1');
		$routes->post('save-member', 'admin\Member::create');
		$routes->get('edit-member', 'admin\Member::edit');
		$routes->post('update-member', 'admin\Member::update');
		$routes->get('delete-member/(:num)', 'admin\Member::delete/$1');
		$routes->post('save-membership', 'admin\Member::saveMembership');
		$routes->get('member/membership-list', 'admin\Member::membershipList');

	});//#End admin group

?>