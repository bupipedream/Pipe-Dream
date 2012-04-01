<?php

function pd_is_author($query) {
	global $wpdb;
	$author = $wpdb->get_row("SELECT *  FROM $wpdb->users WHERE display_name LIKE '%$query%'");
	return $author;
}