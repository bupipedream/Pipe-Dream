<?php

/*
	Plugin Name: Pipe Dream Archive
	Contributors: Daniel O'Connor
	Tags: images, image, media, photos
	Requires at least: 3.3.1
	Tested up to: 3.3.1
	Version: 0.1
*/

/*-----------------------*/
/*---- Get Functions ----*/
/*-----------------------*/

function get_author($str) {	
	$author = $str[0];
	return $author;
}

function get_author_position($str) {	
	$position = $str[0];
	return $position;
}

function get_cp_id($str) {	
	$id = $str[0];
	return $id;
}

function get_legacy_id($str) {	
	$id = $str[0];
	return $id;
}

/*-----------------------*/
/*-- Boolean Functions --*/
/*-----------------------*/


/*-----------------------*/
/*---- Main Function ----*/
/*-----------------------*/

function pd_is_archived($post_id, $fields = NULL) {
	
	// check if there are any custom fields
	$meta = get_post_custom($post_id);
	if($meta) {
		if(isset($meta['_cp_id'])) $meta['_cp_id'] = get_cp_id($meta['_cp_id']);
		if(isset($meta['_author'])) $meta['_author'] = get_author($meta['_author']);
		if(isset($meta['_author_position'])) $meta['_author_position'] = get_author_position($meta['_author_position']);
		if(isset($meta['_image1'])) $meta['_image1'] = get_image($meta['_image1']);
		if(isset($meta['_legacy_id'])) $meta['_legacy_id'] = get_legacy_id($meta['_legacy_id']);
		
		if($fields == '_image1') return $meta['_image1'];
		if($fields == '_author') return $meta['_author'];
		
		return $meta;
	}

	// the article is not from the archives
	return false;
}