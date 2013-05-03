<?php

/*
	Plugin Name: Pipe Dream Zones
	Contributors: Daniel O'Connor
	Tags: section, query, zone
	Requires at least: 3.3.1
	Tested up to: 3.5.1
	Version: 0.2
*/

function pd_get_author_name($article) {
	// get author info from wp authors
	$name = get_the_author_meta( 'display_name' , $article['post_author'] );
	return array( 'name' => $name, );
}

function pd_set_sections() {
	
	// grab all of the articles
	// requires the WP Zoninator Plugin.
	$sections['feature']['feature'] = objectToArray(z_get_posts_in_zone('feature-feature'));
	$sections['feature']['article-list'] = objectToArray(z_get_posts_in_zone('feature-list'));

	$sections['news']['article-list'] = objectToArray(z_get_posts_in_zone('zone-news-list'));
	
	$sections['sports']['feature'] = objectToArray(z_get_posts_in_zone('zone-sports-feature'));
	$sections['sports']['article-list'] = objectToArray(z_get_posts_in_zone('zone-sports-list'));
	
	$sections['release']['feature'] = objectToArray(z_get_posts_in_zone('zone-release-feature'));
	$sections['release']['article-list'] = objectToArray(z_get_posts_in_zone('zone-release-list'));
	
	$sections['editorial']['feature'] = wp_get_recent_posts(array('numberposts' => 1, 'category' => get_category_by_slug('editorial')->cat_ID));
	$sections['opinion']['article-list'] = objectToArray(z_get_posts_in_zone('zone-opinion-list'));
	$sections['multimedia']['feature'] = wp_get_recent_posts(array('numberposts' => 1, 'category' => get_category_by_slug('multimedia')->cat_ID));
	
	// used for concert announcements
	// $sections['feature']['concert'] = objectToArray(z_get_posts_in_zone('zone-feature-concert'));
	return $sections;
}

/*
	This function gets all of the content
	on the homepage. No pressure.
*/

function pd_get_homepage() {
	$sections = pd_set_sections(); // organize all the sections
	
	foreach($sections as $category_key => $category) { // get author info for articles
		foreach($category as $section_key => $section) {
			foreach($section as $article_key => $article) {
				$sections[$category_key][$section_key][$article_key]['post_author'] = pd_get_author_name($article);
				$sections[$category_key][$section_key][$article_key]['photo'] = get_photos($sections[$category_key][$section_key][$article_key]['ID'], 1);
			}
		}
	}
	return $sections;
}
