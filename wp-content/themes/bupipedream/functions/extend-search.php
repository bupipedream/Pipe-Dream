<?php

function pd_search_topics($query) {
	global $wpdb;
	$author = $wpdb->get_row("SELECT *  FROM $wpdb->users WHERE display_name LIKE '%$query%'");
	if( isset($author) ) {
		$text = 'Are you searching for articles by <a href="' . get_author_posts_url( $author->ID ) . '">' . $author->display_name . '</a>?';
		return $text;
	}

	return false;
}