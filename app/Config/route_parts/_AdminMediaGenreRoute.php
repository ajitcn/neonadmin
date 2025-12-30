<?php

	$routes->group('admin', ['filter' => ['auth']], function($routes) {//#Start admin group
		
		$routes->get('media-genre', 'admin\MediaGenre::index');
		$routes->post('save-media-genre', 'admin\MediaGenre::create');
		$routes->get('edit-media-genre', 'admin\MediaGenre::edit');
		$routes->post('update-media-genre', 'admin\MediaGenre::update');
		$routes->get('delete-media-genre/(:num)', 'admin\MediaGenre::delete/$1');

	});//#End admin group

?>