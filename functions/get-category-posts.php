<?php

/*
	Plugin Name: Pipe Dream Zones
	Contributors: Daniel O'Connor
	Tags: section, query, zone
	Requires at least: 3.3.1
	Tested up to: 3.3.1
	Version: 0.1
*/

function pd_get_featured_post_ids($category_id) {
	if(get_category_by_slug('news')->term_id === $category_id) { // news
		$featured = objectToArray(z_get_posts_in_zone('zone-news-feature'));
		$secondary = objectToArray(z_get_posts_in_zone('zone-news-secondary'));
		$list = objectToArray(z_get_posts_in_zone('zone-news-list'));
	}

	if(get_category_by_slug('sports')->term_id === $category_id) { // sports
		$featured = objectToArray(z_get_posts_in_zone('zone-sports-feature'));
		$secondary = objectToArray(z_get_posts_in_zone('zone-sports-list'));

		unset($secondary[2]);
	}

	if(get_category_by_slug('opinion')->term_id === $category_id) { // opinion
		$featured = wp_get_recent_posts(array('numberposts' => 1, 'category' => 10));
		$secondary = objectToArray(z_get_posts_in_zone('zone-opinion-list'));
		unset($secondary[2]);
	}

	if(get_category_by_slug('release')->term_id === $category_id) { // opinion
		$featured = objectToArray(z_get_posts_in_zone('zone-release-feature'));
		$secondary = objectToArray(z_get_posts_in_zone('zone-release-list'));
		// unset($secondary[2]);
		// unset($secondary[3]);
	}
		
	$posts['feature'] = $featured[0]['ID']; // main post
	if(isset($posts['exclude'])) $i = count($posts['exclude']);
	else $i = '0';
	
	$posts['exclude'][$i] = $posts['feature']; // used to exclude posts from category page query
	
	foreach($secondary as $article) { // sidebar posts

		if(isset($posts['secondary'])) $i = count($posts['secondary']);
		else $i = '0';

		$posts['secondary'][$i] = $article['ID'];
		$posts['exclude'][count($posts['exclude'])] = $article['ID'];
	}

	return $posts;
}

function pd_get_category_posts($category_id) {
	$posts = pd_get_featured_post_ids($category_id);
	return $posts;
}
