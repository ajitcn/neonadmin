<?php

	$routes->group('admin', ['filter' => ['auth']], function($routes) {//#Start admin group
		
		$routes->get('media-category', 'admin\MediaCategory::index');
		$routes->post('save-media-category', 'admin\MediaCategory::create');
		$routes->get('edit-media-category', 'admin\MediaCategory::edit');
		$routes->post('update-media-category', 'admin\MediaCategory::update');
		$routes->get('delete-media-category/(:num)', 'admin\MediaCategory::delete/$1');

	});//#End admin group

?>