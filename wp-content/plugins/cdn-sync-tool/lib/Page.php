<?php
/**
 * Page class
 *
 * Class to contain methods required to display pages
 *
 * @author Ollie Armstrong
 * @package CST
 * @copyright All rights reserved 2011
 * @license GNU GPLv2
 */
class CST_Page {
	protected static $options = array();
	public static $messages = array();
	/**
	 * Takes the page type and requires the correct file
	 * 
	 * @param $page 
	 */
	function displayPage($page) {
		if (!empty(self::$messages)) {
			foreach (self::$messages as $message) {
				echo '<div class="error">CDN Sync Tool - '.$message.'</div>';
			}
		}
		require_once CST_DIR.'pages/'.$page.'.php';
	}
}
