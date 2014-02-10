<?
/*
Plugin Name: CP Redirect
Plugin URI: http://www.copress.org/wiki/CP_Redirect_plugin
Description: Redirects old College Publisher URLs to the new ones in WordPress, based on the article ID stored in the custom field.
Version: 0.1.1
Author: Daniel Bachhuber
Author URI: http://www.danielbachhuber.com/
*/

/**
 * 
 * Warning: version 0.1.1 is a beta release and has only been tested on a few production sites
 *
 **/

/**
 * KNOWN ERRORS:
 * Blogs/N.Y.-Times-publishes-another-adverse-Binghamton-athletics-piece-/42
 * display_printable.php?id=1459
**/

function cp_redirect () {
	
	global $wpdb;
	
	// If it's a 404 page and CP Redirect is on, then attempt a redirect
	if (is_404()) {
		
		$requested_uri = $_SERVER['REQUEST_URI'];

		$article_name = basename($requested_uri);
		$article_name = explode('.', $article_name);
		$article_id = end($article_name);

		$custom_field = '_cp_id'; // default to College Publisher

		if(strlen($article_id) === 7) { // College Publisher
			$article_id = $article_id;
		} else {
			$article_id = $article_id;
			$custom_field = '_legacy_id';
		}

		$wp_id = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='$custom_field' AND meta_value='$article_id'", 'ARRAY_N');
		$wp_id = $wp_id[0][0]; // Catch if there are duplicate results in the database

		// If we have a WordPress ID to work with and it's legit, then make the redirect
		if ($wp_id != null && get_post($wp_id) != null && is_numeric($article_id)) {
			$website = get_bloginfo('url');
			$new_url = rtrim($website, '/');
			$new_url .= '/?p=' . $wp_id;
			wp_redirect($new_url, 301);
		} else {
			return;
		}

	}
	
}

// WordPress hooks and actions
add_action('template_redirect', 'cp_redirect');

?>