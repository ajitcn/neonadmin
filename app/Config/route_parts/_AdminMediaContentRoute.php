<?php

	$routes->group('admin', ['filter' => ['auth']], function($routes) {//#Start admin group
		

		//media content
		$routes->get('media-content/(:num)', 'admin\MediaContent::index/$1');
		$routes->get('media-content-details/(:num)', 'admin\MediaContent::mediaContentDetails/$1');
		$routes->post('save-media-content', 'admin\MediaContent::create');
		$routes->get('edit-media-content', 'admin\MediaContent::edit');
		$routes->post('update-media-content', 'admin\MediaContent::update');
		$routes->get('delete-media-content/(:num)', 'admin\MediaContent::delete/$1');
		$routes->get('search-media-content', 'admin\MediaContent::searchMediaContent');


		//media segment
		$routes->post('save-media-content-segment', 'admin\MediaContentSegment::create');
		$routes->get('edit-media-content-segment', 'admin\MediaContentSegment::edit');
		$routes->post('update-media-content-segment', 'admin\MediaContentSegment::update');
		$routes->get('delete-media-content-segment/(:num)', 'admin\MediaContentSegment::delete/$1');

	});//#End admin group

?>