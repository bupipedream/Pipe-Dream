<?php 

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

function debug($var) {
	echo "<pre>";
		print_r($var);
	echo "</pre>";
}


/*  written by Cezar Cocu - cezar@cezarcocu.com
	Twitter Api call, looking for "#BREAKING" since today's date from user: bupipedream
	returns the string of the most recent twitter post, if it is set
	-tested on cnnbrk (CNN Breaking)-
	
*/
// function twitterApiCall()
// {
// 	//date_default_timezone_set('UTC'); //api call needs UTC time
// 	$sixHoursAgo = time()-(6*60*60);
// 	$today_formatted = date('Y-m-d:H', $sixHoursAgo);
// 	$search = "Paterno since:".$today_formatted." from:cnnbrk";
// 	$url = "http://search.twitter.com/search.json?q=" . urlencode($search);
// 	
// 	$curl = curl_init();
// 	curl_setopt( $curl, CURLOPT_URL, $url );
// 	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
// 	$JSON_result = curl_exec( $curl );
// 	curl_close( $curl );
// 	$decoded  = json_decode( $JSON_result, true );
// 	$text =$decoded['results']['0']['text'];
// 	debug($decoded);
// 	if (isset($text))
// 	{
// 		echo $text;
// 	}	
// }

# Support RSS Feeds
add_theme_support('automatic-feed-links');


require_once('functions/image-sizes.php'); // set custom image sizes
require_once('functions/user-fields.php'); // set custom user profile fields
require_once('functions/attachment-fields.php'); // add custom meta-fields to file uploads
require_once('functions/options.php'); // add custom meta-fields to file uploads
require_once('functions/get-photos.php'); // retreive photos for a post
// require_once('functions/performance.php'); // display site performance
require_once('functions/is-archived.php'); // get custom fields
require_once('functions/time-since.php'); // display the time since something
require_once('functions/get-sections.php'); // arrange the home page
require_once('functions/get-category-posts.php'); // get the top posts for category pages
require_once('functions/extend-search.php'); // extend the search bar
require_once('functions/custom-excerpt.php'); // get excerpt of custom length