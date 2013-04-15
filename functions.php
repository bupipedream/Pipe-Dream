<?php 

/* 
	Return the full URL of the current page.
*/
function curPageURL() {
	$pageURL = 'http';
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

/* 
	Converts an object into an array in PHP.
	@todo: There really shouldn't be a need to do this.
*/
function objectToArray($d) {
	if (is_object($d)) {
		// Gets the properties of the given object
		// with get_object_vars function
		$d = get_object_vars($d);
	}

	if (is_array($d)) {
		/*
		* Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return array_map(__FUNCTION__, $d);
	}
	else {
		// Return array
		return $d;
	}
}

/* 
	Display post categories in the as classes in <body>.
	http://codex.wordpress.org/Function_Reference/body_class#Add_Classes_By_Filters
*/
function category_id_class($classes) {
	global $post;
	if( is_single() ) {
		foreach((get_the_category($post->ID)) as $category) {
			$classes[] = $category->category_nicename;
		}
	}
	return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');

/* 
	Very useful function for debugging.
*/
function debug($var = null) {
	echo "<pre>";
		print_r($var);
	echo "</pre>";
}

/* 
	Place RSS feed links in <head>.
*/
add_theme_support('automatic-feed-links');

/* 
	Remove WordPress version from head.
*/
remove_action ('wp_head', 'wp_generator');


/* 
	Update slug when saving a post. This is
	needed because slugs generated from Pipe Line
	are long since they contain the title and deck.

	Prevents posts that are published from automatically
	having their slugs changed since it's bad practice
	to modify existing URLs.

	http://wordpress.stackexchange.com/a/52897
*/
function pd_update_slug( $data, $postarr ) {
    if ( !in_array( $data['post_status'], array( 'publish' ) ) ) {
        $data['post_name'] = sanitize_title( $data['post_title'] );
    }
    return $data;
}
add_filter( 'wp_insert_post_data', 'pd_update_slug', 99, 2 );


/* 
	Load jQuery from the Google servers.
	@todo: There really shouldn't be a need to do this.
*/
$url = 'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'; // the URL to check against
$test_url = @fopen($url,'r'); // test parameters
if($test_url !== false) { // test if the URL exists
	function load_external_jQuery() { // load external file
		wp_deregister_script('jquery'); // deregisters the default WordPress jQuery
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'); // register the external file
		wp_enqueue_script('jquery'); // enqueue the external file
	}
	add_action('wp_enqueue_scripts', 'load_external_jQuery'); // initiate the function
}

require_once('functions/archive-redirect.php'); // set custom image sizes
require_once('functions/image-sizes.php'); // set custom image sizes
require_once('functions/get-photos.php'); // retreive photos for a post
require_once('functions/performance.php'); // display site performance
require_once('functions/is-archived.php'); // get custom fields
require_once('functions/time-since.php'); // display the time since something
require_once('functions/get-homepage.php'); // arrange the home page
require_once('functions/get-category-posts.php'); // get the top posts for category pages
require_once('functions/custom-excerpt.php'); // get excerpt of custom length
require_once('functions/extend-search.php'); // extend the search bar

if( is_admin() ) {
	require_once('functions/add-deck.php'); // support article decks
	require_once('functions/theme-options.php'); // support article decks
	require_once('functions/user-fields.php'); // set custom user profile fields
	require_once('functions/attachment-fields.php'); // add custom meta-fields to file uploads
}