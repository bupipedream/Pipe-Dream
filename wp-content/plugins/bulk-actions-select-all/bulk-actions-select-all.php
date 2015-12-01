<?php
/*
Plugin Name: Bulk Actions Select All
Version: 1.0
Description: Adds an option to the admin posts overview page to select all posts (instead of just the ones on the current page) to bulk trash, restore and delete posts
Author: Jesper van Engelen
Author URI: http://jespervanengelen.com
Text Domain: basa
License: GPLv2

Copyright 2014	Jesper van Engelen	contact@jepps.nl

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License version 2 as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if access directly

define( 'BASA_VERSION', 1.0 );
define( 'BASA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BASA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

class BASA {

	/**
	 * Holds the only instance of this plugin
	 *
	 * @static
	 * @var BASA
	 * @access private
	 * @since 1.0
	 */
	private static $_instance = NULL;
	
	/**
	 * Plugin version
	 *
	 * @var string
	 * @access protected
	 * @since 1.0
	 */
	protected $version = '1.0';

	/**
	 * Admin class instance
	 *
	 * @var BASA_Admin
	 * @access private
	 * @since 1.0
	 */
	private $_admin;

	/**
	 * Get the admin class instance, instantiating it if it doesn't exist yet
	 *
	 * @since 1.0
	 *
	 * @return BASA_Admin Admin class instance
	 */
	public function admin() {
		if ( ! $this->_admin ) {
			$this->_admin = new BASA_Admin( $this );
		}

		return $this->_admin;
	}
	
	/**
	 * Constructor
	 *
	 * @access private
	 * @since 1.0
	 */
	private function __construct() {}
	
	/**
	 * Initialize
	 *
	 * @since 1.0
	 */
	private function init() {
		// Hooks
		add_action( 'plugins_loaded', array( $this, 'finish_setup' ) );
		add_action( 'init', array( $this, 'localize' ), 3 );
		
		// Library
		require_once BASA_PLUGIN_DIR . 'library/admin.php';
		
		if ( is_admin() ) {
			$this->admin();
		}
		
		// Plugin upgrade
		add_action( 'plugins_loaded', array( $this, 'plugin_check_upgrade' ) );
	}
	
	/**
	 * Get the instance of this class, insantiating it if it doesn't exist yet
	 *
	 * @since 1.0
	 *
	 * @return Righteous_Plugin Class instance
	 */
	public static function get_instance() {
		if ( ! is_object( self::$_instance ) ) {
			self::$_instance = new BASA();
			self::$_instance->init();
		}
		
		return self::$_instance;
	}
	
	/**
	 * Handle localization, loading the plugin textdomain
	 *
	 * @since 1.0
	 */
	public function localize() {
		load_plugin_textdomain( 'basa', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
	
	/**
	 * Handle final aspects of plugin setup, such as adding action hooks
	 *
	 * @since 1.0
	 */
	public function finish_setup() {
		/**
		 * Fires after the plugin was fully set up.
		 *
		 * @since 1.0
		 *
		 * @param BASA $plugin_instance Main plugin class instance
		 */
		do_action( 'basa/after_setup', $this );
	}
	
	/**
	 * Handle inital installation and upgrading of the plugin
	 *
	 * @since 1.0
	 */
	public function plugin_check_upgrade() {
		$version = $this->get_version();
		$db_version = get_option( 'basa_version' );
		
		$difference = version_compare( $db_version, $version );
		
		if ( $difference != 0 ) {
			// Upgrade plugin
			
			// Save new version
			update_option( 'basa_version', $version );

			/**
			 * Fires after the plugin is upgraded to a newer version.
			 *
			 * @since 1.0
			 *
			 * @param string $old_version Plugin version before the upgrade
			 * @param string $new_version Plugin version after the upgrade
			 */
			do_action( 'basa/after_upgrade', $db_version, $version );
		}
	}
	
	/**
	 * Get the plugin version
	 *
	 * @since 1.0
	 *
	 * @return string Plugin version
	 */
	public function get_version() {
		return $this->version;
	}

}

BASA::get_instance();
