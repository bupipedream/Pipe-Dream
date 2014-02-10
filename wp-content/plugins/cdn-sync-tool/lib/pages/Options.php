<?php
require_once CST_DIR.'lib/Page.php';
/**
 * Options page
 *
 * Class to call the display for options page
 *
 * @author Ollie Armstrong
 * @package CST
 * @copyright All rights reserved 2011
 * @license GNU GPLv2
 */
class CST_Page_Options extends CST_Page {
	/**
	 * Displays the page
	 *
	 */
	function page() {
		// If this page's form is submitted, run the function before displaying page
		if (isset($_POST['form'])) {
			if ($_POST['form'] == 'cst-main') {
				self::formSubmitted('main');
			} else if ($_POST['form'] == 'cst-js') {
				self::formSubmitted('js');
			} else if ($_POST['form'] == 'cst-css') {
				self::formSubmitted('css');
			}

		}
		if (isset($_POST['email']) && is_array($_POST['email'])) {
			if (self::_submitEmail()) {
				$GLOBALS['emailSent'] = true;
			} else {
				parent::$messages[] = 'Email sending failed. Try again?';
			}

		}
		if (isset($_POST['form']) && $_POST['form'] == 'cst-sync') {
			$GLOBALS['core']->syncFiles();
		} else if (isset($_POST['form']) && $_POST['form'] == 'cst-sync-custom') {
			$dirs = explode("\n", $_POST['cst-custom-options']['files']);
			foreach ($dirs as &$dir) {
				$dir = trim($dir);
			}
			$GLOBALS['core']->syncCustomDirectory($dirs);
		} else {
			self::loadOptions();
			self::displayPage('options');
		}
	}

	/**
	 * Gets the options from the database and populates an array
	 *
	 */
	function loadOptions() {
		parent::$options['cst-cdn'] = get_option('cst-cdn');
		parent::$options['cst-s3-accesskey'] = get_option('cst-s3-accesskey');
		parent::$options['cst-s3-secretkey'] = get_option('cst-s3-secretkey');
		parent::$options['cst-s3-bucket'] = get_option('cst-s3-bucket');
		parent::$options['cst-ftp-server'] = get_option('cst-ftp-server');
		parent::$options['cst-ftp-port'] = get_option('cst-ftp-port');
		parent::$options['cst-ftp-username'] = get_option('cst-ftp-username');
		parent::$options['cst-ftp-password'] = get_option('cst-ftp-password');
		parent::$options['cst-ftp-dir'] = get_option('cst-ftp-dir');
		parent::$options['cst-cf-username'] = get_option('cst-cf-username');
		parent::$options['cst-cf-api'] = get_option('cst-cf-api');
		parent::$options['cst-cf-container'] = get_option('cst-cf-container');
		parent::$options['cst-webdav-username'] = get_option('cst-webdav-username');
		parent::$options['cst-webdav-password'] = get_option('cst-webdav-password');
		parent::$options['cst-webdav-host'] = get_option('cst-webdav-host');
		parent::$options['cst-webdav-basedir'] = get_option('cst-webdav-basedir');
	}

	/**
	 * Function to be run once the form is submitted
	 *
	 * @param $form whether it is the main/js/css form
	 */
	function formSubmitted($form) {
		if (wp_verify_nonce($GLOBALS['nonce'], 'cst-nonce')) {
			if ($form == 'main') {
				foreach($_POST['options'] as $key => $value) {
					update_option($key, $value);
				}
				require_once CST_DIR.'lib/Cst.php';
				$obj = new Cst();
				$obj->testConnection();
			} else if ($form == 'js') {
				foreach($_POST['options'] as $key => $value) {
					if ($key == 'cst-js-exclude' && !empty($value)) {
						// Change new lines to csv list
						$value = explode("\n", $value);
						$fileslist = '';
						foreach($value as $file) {
							$filename = trim($file);
							if (!empty($filename)) {
								$fileslist .= $filename . ',';
							}
						}
						$value = rtrim($fileslist, ','); // Drop last comma
					}
					update_option($key, $value);
				}
			} else if ($form == 'css') {
				foreach($_POST['options'] as $key => $value) {
					if ($key == 'cst-css-exclude' && !empty($value)) {
						// Change new lines to csv list
						$value = explode("\n", $value);
						$fileslist = '';
						foreach($value as $file) {
							$filename = trim($file);
							if (!empty($filename)) {
								$fileslist .= $filename . ',';
							}
						}
						$value = rtrim($fileslist, ','); // Drop last comma
					}
					update_option($key, $value);
				}
			}
		} else {
			_e('Security error');
			die;
		}
	}

	/**
	 * Sends the email to the support team
	 * 
	 * @return boolean if the email was sent successfully
	 */
	private function _submitEmail() {
		$fromEmail = get_option('admin_email');

		$headers = 'From: CST Contact Form <'.$fromEmail.'>' . "\r\n";
		$headers .= 'Reply-To: '.trim($_POST['email']['name']).' <'.$_POST['email']['email'].">\r\n";

		$message = 'From: '.trim($_POST['email']['name']).' <'.$fromEmail.'>'.PHP_EOL;
		$message .= 'CST Version: '.CST_VERSION.PHP_EOL;
		$message .= 'PHP Version: '.PHP_VERSION.PHP_EOL;
		$message .= 'WordPress Version: '.get_bloginfo('version').PHP_EOL;
		$message .= 'Site URL: '.get_bloginfo('url').PHP_EOL;
		$message .= 'Message: '.htmlentities($_POST['email']['message']).PHP_EOL;

		if (wp_mail(CST_CONTACT_EMAIL,$_POST['email']['reason'], $message, $headers)){
			return true;
		} else {
			return false;
		}
	}
}
