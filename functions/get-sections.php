<?php

/*
	Plugin Name: Pipe Dream Zones
	Contributors: Daniel O'Connor
	Tags: section, query, zone
	Requires at least: 3.3.1
	Tested up to: 3.3.1
	Version: 0.1
*/

function get_latest_posts() {
	
	$news_args = array('numberposts' => 10, 'category' => 1);
	$sports_args = array('numberposts' => 10, 'category' => 3);
	$opinion_args = array('numberposts' => 10, 'category' => 4);
	$release_args = array('numberposts' => 10, 'category' => 5);
	$editorial_args = array('numberposts' => 10, 'category' => 10);
		
	$posts['news'] = wp_get_recent_posts($news_args);
	$posts['sports'] = wp_get_recent_posts($sports_args);
	$posts['opinion'] = wp_get_recent_posts($opinion_args);
	$posts['release'] = wp_get_recent_posts($release_args);
	$posts['editorial'] = wp_get_recent_posts($editorial_args);
	
	return $posts;

}

function is_from_archive($article) {
	if(get_post_meta($article['ID'], '_cp_id', true)) {
		return true;
	}
	else return false;
}

function get_authors($article) {
	
	// Get the author name, position, and profile.
	if($article['post_author'] === "2") {
		
		// get author info from post meta
		$name = get_post_meta($article['ID'], '_author', true);
		$position = get_post_meta($article['ID'], '_author_position', true);
		return array( 'name' => $name, 'position' => $position, 'profile' => false );

	} else {

		// get author info from WordPress authors
		$name = get_the_author_meta( 'display_name' , $article['post_author'] );
		// $position = get_the_author_meta( 'user_nicename' , $article['post_author'] );
		$position = null; // temp until position is 
		return array( 'name' => $name, 'position' => $position, 'profile' => false );

	}
	
	return false; // just in case
}

function set_sections() {
	
	// grab all of the articles
	$sections['news']['feature'] = objectToArray(z_get_posts_in_zone('zone-news-feature'));
	$sections['news']['secondary'] = objectToArray(z_get_posts_in_zone('zone-news-secondary'));
	$sections['news']['article-list'] = objectToArray(z_get_posts_in_zone('zone-news-list'));
	
	$sections['sports']['feature'] = objectToArray(z_get_posts_in_zone('zone-sports-feature'));
	$sections['sports']['article-list'] = objectToArray(z_get_posts_in_zone('zone-sports-list'));
	
	$sections['release']['feature'] = objectToArray(z_get_posts_in_zone('zone-release-feature'));
	$sections['release']['article-list'] = objectToArray(z_get_posts_in_zone('release-list'));
	
	$sections['editorial']['feature'] = wp_get_recent_posts(array('numberposts' => 1, 'category' => 10));
	$sections['opinion']['article-list'] = objectToArray(z_get_posts_in_zone('zone-opinion-list'));
	
	$sections['feature']['concert'] = objectToArray(z_get_posts_in_zone('zone-feature-concert'));
	
	return $sections;
}


function get_sections() {
	$sections = set_sections(); // organize all the sections
	
	foreach($sections as $category_key => $category) { // get author info for articles
		foreach($category as $section_key => $section) {
			foreach($section as $article_key => $article) {
				$sections[$category_key][$section_key][$article_key]['archive'] = is_from_archive($article);
				$sections[$category_key][$section_key][$article_key]['post_author'] = get_authors($article);
								
				$sections[$category_key][$section_key][$article_key]['photo'] = get_photos($sections[$category_key][$section_key][$article_key]['ID'], '1');
			}
		}
	}
		
	return $sections;
}
