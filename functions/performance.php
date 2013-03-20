<?php

// show a performance status in the footer when user is an admin
// http://wordpress.stackexchange.com/a/1866
function performance() {
	$visible = false;
	if( current_user_can( 'manage_options' ) ) $visible = true;
	$stat = sprintf(  '%d queries in %.3f seconds, using %.2fMB memory',
		get_num_queries(),
		timer_stop( 0, 3 ),
		memory_get_peak_usage() / 1024 / 1024
	);
	echo $visible ? '<div id="performance">'.$stat.'</div>' : "<!-- {$stat} -->" ;
}
add_action( 'wp_footer', 'performance', 20 );