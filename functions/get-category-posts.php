<?php

/*
	Plugin Name: Pipe Dream Zones
	Contributors: Daniel O'Connor
	Tags: section, query, zone
	Requires at least: 3.3.1
	Tested up to: 3.5.1
	Version: 0.3
*/

/*
 *	Grab the most importants posts in each
 *  category to display in a nice layout.
*/

function pd_get_category_posts($category_id) {
	// num posts allowed to show up alongside
	// featured. depends on the current category.
	$max_secondary = 0;

	// subcategories don't have featured posts
	// so just return.
	if(get_category($category_id)->parent) return false;

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

	// determine the featured post in category
	$posts['feature'] = get_post( $featured[0]['ID'], 'ARRAY_A' );
	$posts['feature']['photos'] = get_photos( $posts['feature']['ID'], 1 );
	
	// if the featured article doesn't have a photo,
	// return false so category.php will display the
	// simple article-list layout.
	if(!$posts['feature']['photos']) return false;

	// since there is a photo, we'll display the featured
	// post in the dominant position. therefore, we should
	// exclude it from the article list.
	$posts['exclude'][0] = $posts['feature']['ID'];
	
	$posts['secondary'] = array();

	foreach($secondary as $article) { // sidebar posts
		if(count($posts['secondary']) < $max_secondary) {
			$posts['secondary'][] = get_post( $article['ID'], 'ARRAY_A' );
			$posts['secondary'][count($posts['secondary']) - 1]['photos'] = get_photos( $article['ID'], 1 );
			$posts['exclude'][] = $article['ID'];
			// debug($posts['secondary'][count($posts['secondary'])]['photos']);
		}
	}
	// debug($posts);
	return $posts;
}
