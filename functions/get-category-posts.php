<?php

/*
	Plugin Name: Pipe Dream Zones
	Contributors: Daniel O'Connor
	Tags: section, query, zone
	Requires at least: 3.3.1
	Tested up to: 3.5.1
	Version: 1.0
*/

/*
 *	Grab the most importants posts in each
 *  category to display in a nice layout.
 *
 *  The function also checks to see if any
 *  of the posts in the feature-feature or
 *  feature-list since those take precidence.
*/

function pd_get_category_posts($category_id) {
	// num posts allowed to show up alongside
	// featured. depends on the current category.
	$max_secondary = 0;
	// initialize arrays
	$featured = $secondary = array();

	// if featured post on homepage is in the current category,
	// then set that one as featured.
	foreach( get_the_category( z_get_posts_in_zone( 'feature-feature' )[0]->ID ) as $category ) {
		if( $category->term_id === $category_id ) {
			$featured = objectToArray( z_get_posts_in_zone( 'feature-feature' ) );
		}
	}

	// loop through the featured secondary posts and see if
	// any match the current category. if they do, set them as
	// the in the secondary part of the category page.
	foreach( z_get_posts_in_zone( 'feature-list' ) as $article ) {
		foreach( get_the_category( $article->ID ) as $category ) {
			if( $category->term_id === $category_id ) {
				$secondary[] = objectToArray( $article );
			}
		}
	}

	// whitelisted categories that support the zoninator layout
	$whitelist = array('news', 'sports', 'opinion', 'release');
	if(!in_array(get_category($category_id)->slug, $whitelist)) {
		return false;
	}

	// if category page is news
	if(get_category_by_slug('news')->term_id === $category_id) { // news
		if( !$featured ) {
			// if featured on homepage is not from category
			// the use the category's featured image.
			$featured = objectToArray( z_get_posts_in_zone( 'zone-news-feature' ) );
		}
		$secondary = array_merge( $secondary, objectToArray( z_get_posts_in_zone( 'zone-news-secondary' ) ), objectToArray( z_get_posts_in_zone( 'zone-news-list' ) ) );
		$max_secondary = 2;
	}

	// if category page is sports
	if( get_category_by_slug( 'sports' )->term_id === $category_id ) { // sports
		if( !$featured ) {
			// if featured on homepage is not from category
			// the use the category's featured image.
			$featured = objectToArray( z_get_posts_in_zone( 'zone-sports-feature' ) );
		}
		$secondary = array_merge( $secondary, objectToArray( z_get_posts_in_zone( 'zone-sports-list' ) ));
		$max_secondary = 2;
	}

	// if category page is opinion
	if( get_category_by_slug( 'opinion' )->term_id === $category_id ) { // opinion
		$featured = wp_get_recent_posts( array( 'numberposts' => 1, 'category' => 10 ) );
		$secondary = objectToArray( z_get_posts_in_zone( 'zone-opinion-list' ) );
		$max_secondary = 3;
	}

	// if category page is release
	if( get_category_by_slug( 'release' )->term_id === $category_id ) { // opinion
		if( !$featured ) {
			// if featured on homepage is not from category
			// the use the category's featured image.
			$featured = objectToArray( z_get_posts_in_zone( 'zone-release-feature' ) );
		}
		$secondary = array_merge( $secondary, objectToArray( z_get_posts_in_zone( 'zone-release-list' ) ) );
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
		}
	}
	return $posts;
}
