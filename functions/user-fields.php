<?php

// Custom user fields
// http://wordpress.stackexchange.com/a/4125
function my_custom_userfields($contactmethods) {

	// Add these custom fields
	$contactmethods['position']			= 'Position';
	$contactmethods['major']				= 'Major';
	$contactmethods['year']					= 'Year (Freshman, Sophomore, etc.)';
	$contactmethods['phone_office']		= 'Office Phone';
	$contactmethods['phone_mobile']		= 'Mobile Phone';

	// Remove these custom fields
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);

	return $contactmethods;
}

add_filter('user_contactmethods','my_custom_userfields',10,1);