<?php
/*
Plugin Name: CDN Sync Tool
Plugin URI: http://www.olliearmstrong.co.uk
Description: Allows wordpress owners to sync their static files to CDN
Author: Fubra Limited
Author URI: http://www.catn.com
Version: 2.2.1
*/

global $wpdb;

define('CST_DIR', dirname(__FILE__).'/');
define('CST_VERSION', '2.2.1');
define('CST_URL', admin_url('options-general.php'));
define('CST_FILE', __FILE__);
define('CST_TABLE_FILES', $wpdb->get_blog_prefix().'cst_new_files');
define('CST_CONTACT_EMAIL', 'support@catn.com');


if (is_admin()) {
	require_once CST_DIR.'lib/Cst.php';
	$core = new Cst();
} else {
	require_once CST_DIR.'lib/Site.php';
	new Cst_Site;
}

function cst_install() {
	global $wpdb;

	if (get_option('cst_cdn')) {
		$cdnOptions = get_option('cst_cdn');
		if ($cdnOptions['provider'] == 'aws') {
			update_option('cst-cdn', 'S3');
			if (isset($cdnOptions['access']))
				update_option('cst-s3-accesskey', $cdnOptions['access']);
			if (isset($cdnOptions['secret']))
				update_option('cst-s3-secretkey', $cdnOptions['secret']);
			if (isset($cdnOptions['bucket_name']))
				update_option('cst-s3-bucket', $cdnOptions['bucket_name']);
		} else if ($cdnOptions['provider'] == 'ftp') {
			update_option('cst-cdn', 'FTP');
			if (isset($cdnOptions['username']))
				update_option('cst-ftp-username', $cdnOptions['username']);
			if (isset($cdnOptions['password']))
				update_option('cst-ftp-password', $cdnOptions['password']);
			if (isset($cdnOptions['server']))
				update_option('cst-ftp-server', $cdnOptions['server']);
			if (isset($cdnOptions['port']))
				update_option('cst-ftp-port', $cdnOptions['port']);
			if (isset($cdnOptions['directory']))
				update_option('cst-ftp-dir', $cdnOptions['directory']);
		} else if ($cdnOptions['provider'] == 'cf') {
			update_option('cst-cdn', 'Cloudfiles');
			if (isset($cdnOptions['username']))
				update_option('cst-cf-username', $cdnOptions['username']);
			if (isset($cdnOptions['apikey']))
				update_option('cst-cf-api', $cdnOptions['apikey']);
			if (isset($cdnOptions['container']))
				update_option('cst-cf-container', $cdnOptions['container']);
		}
		delete_option('cst_cdn');
	}

	$wpdb->query("
		CREATE TABLE IF NOT EXISTS ".CST_TABLE_FILES." (
		  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `file_dir` text NOT NULL,
		  `remote_path` text NOT NULL,
		  `changedate` int(11) DEFAULT NULL,
		  `synced` tinyint(1) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	");

	update_option('cst-js-savepath', 'wp-content/uploads');
	wp_schedule_event(time(), 'hourly', 'cron_cst_sync');
}

function cst_deactivate() {
	wp_clear_scheduled_hook('cron_cst_sync');
}

function hourlySync() {
	$GLOBALS['core']->syncFiles();
}

function superCacheError() {
	echo '<div class="error"><p>CDN Sync Tool requires <a href="http://wordpress.org/extend/plugins/wp-super-cache/" target="_blank">WP Super Cache</a>.</p></div>';
}

register_activation_hook(__FILE__, "cst_install");
register_deactivation_hook(__FILE__, 'cst_deactivate');
//add_action('cron_cst_sync', 'hourlySync');

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (!is_plugin_active('wp-super-cache/wp-cache.php')) {
	add_action('admin_notices', 'superCacheError');
}
