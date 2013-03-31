<?php

/*
	Plugin Name: Pipe Dream Zones
	Contributors: Daniel O'Connor
	Tags: section, query, zone
	Requires at least: 3.3.1
	Tested up to: 3.5.1
	Version: 0.2
*/

/*
 *	Grab the most importants posts in each
 *  category to display in a nice layout.
*/

function pd_get_category_posts($category_id) {
	// num posts allowed to show up alongside
	// featured. depends on the current category.
	$max_secondary = 0;

	// if category page is news
	if(get_category_by_slug('news')->term_id === $category_id) { // news
		$featured = objectToArray(z_get_posts_in_zone('zone-news-feature'));
		$secondary = array_merge(objectToArray(z_get_posts_in_zone('zone-news-secondary')), objectToArray(z_get_posts_in_zone('zone-news-list')));
		$max_secondary = 2;
	}

	// if category page is sports
	if(get_category_by_slug('sports')->term_id === $category_id) { // sports
		$featured = objectToArray(z_get_posts_in_zone('zone-sports-feature'));
		$secondary = objectToArray(z_get_posts_in_zone('zone-sports-list'));
		$max_secondary = 2;
	}

	// if category page is opinion
	if(get_category_by_slug('opinion')->term_id === $category_id) { // opinion
		$featured = wp_get_recent_posts(array('numberposts' => 1, 'category' => 10));
		$secondary = objectToArray(z_get_posts_in_zone('zone-opinion-list'));
		$max_secondary = 3;
	}

	// if category page is release
	if(get_category_by_slug('release')->term_id === $category_id) { // opinion
		$featured = objectToArray(z_get_posts_in_zone('zone-release-feature'));
		$secondary = objectToArray(z_get_posts_in_zone('zone-release-list'));
		$max_secondary = 2;
	}
	
	// determine the featured post in category and
	// exclude it from article list
	$posts['feature'] = $featured[0]['ID'];
	$posts['exclude'][0] = $posts['feature'];
	
	$posts['secondary'] = array();

	foreach($secondary as $article) { // sidebar posts
		if(count($posts['secondary']) < $max_secondary) {
			$posts['secondary'][] = $article['ID'];
			$posts['exclude'][] = $article['ID'];
		}
	}

	return $posts;
}
