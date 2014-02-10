<?php
/**
 * Class to handle all of the functions for the site frontend
 *
 * @author Ollie Armstrong
 * @package CST
 * @copyright All rights reserved 2012
 * @license GNU GPLv2
 */
class Cst_Site {
	public function __construct() {
		self::_addHooks();
	}

	private function _addHooks() {
		add_action('wp_loaded', array($this, 'startOb'));
		add_action('wp_footer', array($this, 'stopOb'), 1000);
	}

	public function startOb() {
		ob_start(array($this, 'changeBuffer'));
	}

	public function stopOb() {
		ob_end_flush();
		return true;
	}

	public function changeBuffer($buffer) {
		if (get_option('cst-css-combine') == 'yes') {
			$buffer = $this->combineFiles($buffer, 'css');
		}
		if (get_option('cst-js-combine') == 'yes') {
			$buffer = $this->combineFiles($buffer, 'js');
		}
		return $buffer;
	}

	public function combineFiles($buffer, $filetype) {
		require_once CST_DIR.'lib/Cst.php';
		$core = new Cst;

		$stylesheetCombined = '';
		$stylesheets = array();
		$exclude = get_option('cst-'.$filetype.'-exclude');

		if ($filetype == 'css') {
			// Find all stylesheet links
			preg_match_all('$<link.*rel=[\'"]stylesheet[\'"].*?>$', $buffer, $stylesheets);
		} else {
			preg_match_all('$<script.*((text/javascript|src=[\'"].*[\'"]).*){2}$', $buffer, $stylesheets);
		}

		foreach ($stylesheets[0] as $stylesheet) {

			// Exclude external files
			if (!preg_match('$'.site_url().'$', $stylesheet)) {
				if (get_option('cst-'.$filetype.'-exclude-external') == 'yes') {
					$external = false;
					continue;
				} else {
					$external = true;
				}
			}

			// Get the filepath
			$regex = '$';
			if ($filetype == 'css') {
				$regex .= 'href';
			} else {
				$regex .= 'src';
			}

			if ($external == false) {
				$regex .= '=[\'"]'.get_bloginfo('wpurl').'(.*?)\??[\'"]$';
				preg_match($regex, $stylesheet, $href);
				$path = $href[1];
				$path = preg_replace('$\.'.$filetype.'(\?.*)$', '.'.$filetype, $path);
				$path = ltrim($path, '/');
			} else {
				$regex .= '=[\'"](.*)?[\'"]$';
				preg_match($regex, $stylesheet, $href);
				$path = $href[1];
			}

			// Check if exclude
			if (strpos($exclude, $path) !== false) {
				// File is excluded so skip
				continue;
			}
			
			// Remove the link from $buffer
			$buffer = str_replace($stylesheet, '', $buffer);

			if ($external == false) {
				$file = file_get_contents(ABSPATH.$path);
			} else {
				$file = file_get_contents($path);
			}

			if ($filetype == 'css') {
				// Replace relative urls with absolute urls to cdn
				$directory = str_replace(ABSPATH, '', dirname($path));
				$urls = array();
				preg_match_all('$url\((.*?)\)$', $file, $urls);
				$i = 0;
				foreach ($urls[1] as $url) {
					if (preg_match('$https?://|data:$', $url))
						continue;
					$newurl = get_option('ossdl_off_cdn_url').'/'.$directory.'/'.$url;
					$file = str_replace($urls[0][$i], 'url('.$newurl.')', $file);
					$i++;
				}
			}

			$stylesheetCombined .= PHP_EOL.$file;
		}

		// Create unique filename based on the md5 of the content
		$hash = md5($stylesheetCombined);
		$combinedFilename = ABSPATH.get_option('cst-'.$filetype.'-savepath').'/'.$hash.'.'.$filetype;

		if (!is_readable($combinedFilename)) {
			if ($filetype == 'js' && get_option('cst-js-minify') == 'yes') {
				// Do minification
				switch (get_option('cst-js-optlevel')) {
				case 'simple':
					$complevel = 'SIMPLE_OPTIMIZATIONS';
				case 'advanced':
					$complevel = 'ADVANCED_OPTIMIZATIONS';
				default:
					$complevel = 'WHITESPACE_ONLY';
				}
				$ch = curl_init('http://closure-compiler.appspot.com/compile');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, 'output_info=compiled_code&output_format=text&compilation_level='.$complevel.'&js_code='.urlencode($stylesheetCombined));
				$output = curl_exec($ch);
				$stylesheetCombined = $output;
			}
			// File needs saving and syncing
			file_put_contents($combinedFilename, $stylesheetCombined);
			$core->createConnection();
			$core->pushFile($combinedFilename, get_option('cst-'.$filetype.'-savepath').'/'.$hash.'.'.$filetype);
		}
		
		// File can be loaded
		$fileUrl = get_option('ossdl_off_cdn_url').'/'.get_option('cst-'.$filetype.'-savepath').'/'.$hash.'.'.$filetype;
		if ($filetype == 'css') {
			$linkTag = '<link rel="stylesheet" type="text/css" href="'.$fileUrl.'" />';
			$buffer = preg_replace('$<head[^er]*>$', '<head>'.$linkTag, $buffer);
		} else {
			$linkTag = '<script type="text/javascript" src="'.$fileUrl.'"></script>';
			if (get_option('cst-js-placement') == 'body') {
				if (preg_match('$</body*>$', $buffer)) {
					$buffer = preg_replace('$</body*>$', $linkTag.'</body>', $buffer);
				} else {
					$buffer .= $linkTag;
				}
			} else {
				$buffer = preg_replace('$<head[^er]*>$', '<head>'.$linkTag, $buffer);
			}
		}

		return $buffer;
	}
}
