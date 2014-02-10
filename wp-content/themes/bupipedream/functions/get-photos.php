<?php

/*
	Plugin Name: Pipe Dream Photos
	Contributors: Daniel O'Connor
	Tags: images, image, media, photos
	Requires at least: 3.3.1
	Tested up to: 3.5.1
	Version: 0.2
*/

/*-----------------------*/
/*---- Get Functions ----*/
/*-----------------------*/

function get_id($image) {
	return $image->ID;
}

function get_caption($image) {
	return $image->post_excerpt;
}

function get_credit($image) {
	return get_post_meta($image->ID, '_credit', true);
}

function get_priority($image) {
	// we used to rank images based on a user-defined priority. images
	// with priority '1' were featured under the headline in a large
	// display. the others were shown inline with the article and
	// in order of priority. in a recent update wordpress (3.5?), wordpress
	// changed how they prioritize photos. photos are now prioritized
	// based on their order in the menu. therefore it is not possible to
	// assign priorities and have no images with a priority of 1. the
	// conditional below will ensure that old photos display as intended. 
	if(strtotime($image->post_date) < strtotime('2013-03-30 00:00:00')) {		
		return $image->menu_order;
	}

	// check to see if image position was set to 'feature'. if 
	// so it will display large and under the headline. 
	if(get_post_meta($image->ID, '_position', true) === 'feature') {
		return 1;	
	}
	
	// if the image is not featured we don't want it to have a 
	// priority of 1 so we will add 1 to it. the default
	// priority for all images is 0, so we only do this
	// for images that already have a custom priority.
	if($image->menu_order !== 0) return $image->menu_order + 1;

	// images that were published after the March 30, 2013,
	// don't have a _position meta value set to 'feature',
	// and weren't assigned a custom menu order.
	return 0;
}

function get_width($image) {
	if( is_array( $image ) ) return $image['width'];
	return $image->attachment_metadata['width'];
}

function get_height($image) {
	if( is_array( $image ) ) return $image['height'];
	return $image->attachment_metadata['height'];
}

function get_src($image, $size) {
	$upload_url = wp_upload_dir();
	$upload_url = $upload_url['baseurl'];
	$src = wp_get_attachment_image_src($image->ID, $size);	
	return $src[0];
}

// TEMPORARY HACK
function get_image($str) {
	return get_archive_image($str);
}

function get_archive_image($str, $sizes = NULL, $ret = NULL) {
	$str = $str[0];
	$str = explode(':', $str);

	// a temporary fix for a dumb college publisher issue - FEB 6, 2012
	if($str[1] == "1050472890.jpg") {
		$file_name = 'legacy/'.$str[2];	
	} elseif(empty($str[0])) {
		$file_name = 'legacy/'.$str[1];	
	} else { $file_name = $str[1]; }

	// replicates the array in get-photos
	$image['caption'] = trim($str[0]); // CAUSING ISSUES BECAUSE CAPTION IS BEING SET TO CP_ID
	
	$upload_url = wp_upload_dir();
	$upload_url = $upload_url['baseurl'];
	
	if($sizes) {		
		foreach($sizes as $size) {
			$image['src'][$size] = $upload_url."/archive/".trim($file_name);
		} 
	} else {
		$image['src']['single-inline'] = $upload_url."/archive/".trim($file_name);
		$image['src']['large'] = $upload_url."/archive/".trim($file_name);
		$image['src']['medium'] = $upload_url."/archive/".trim($file_name);		
		$image['src']['thumbnail'] = $upload_url."/archive/".trim($file_name);		
		$image['src']['alt-thumbnail'] = $upload_url."/archive/".trim($file_name);
	}
	
	$image['slug'] = trim($str[2]);
	$image['caption'] = trim($str[3]);
	$image['credit'] = trim($str[4]);
	
	return $image;
}

/*-----------------------*/
/*-- Boolean Functions --*/
/*-----------------------*/

function is_landscape($image) {
	if(get_width($image) > get_height($image)) return true;
	return false;
}

/*-----------------------*/
/*---- Main Function ----*/
/*-----------------------*/

/*
	Returns photos for articles. Supports 
	archived posts as well.

	Photos can be stored in two ways:

	- Attached to post: The current WordPress
	implementation.
	- Custom Field: A custom field attached to a
	post that contains a filename, caption, credit,
	etc. These photos were from the pre-WordPress
	versions of the Pipe Dream website.

	In the current layout, photos are assigned a
	menu-order that determines the order they appear
	in. The menu-order depends on the order of the
	photos in the post edit page. 

	Photos with a custom field set to "feature" will
	display under the headline as a larger image.
	The image that isn't featured and has the lowest
	menu-order (higher priority) will display inline
	with the article. The remaining photos, if any,
	will be displayed as a slideshow.

	Before WordPress 3.5 there was no "_position" custom
	field and menu-order could be custom specified for
	each image. The new media interface changed that,
	so the get_priority() function was beefed up a bit.

	If, for some reason, this code is still around 20
	years from now, make sure the archives are still
	working. And good luck.

	- Dan

	@param int $post_id: Post ID (REQUIRED)
	@param int $num: Number of photos to return.
		Defaults to all photos.
	@param array $sizes: Photo sizes to return.
		Sizes include thumbnai, alt-thumbnail,
		single-inline, medium, and large.
	@param array $ret: Photo attributes to return.
		Attributes include src, width, height, credit,
		amd caption. Returns all by default.
	@param array $landscape: Ensure that image with
		highest priority is landscape.
*/

function get_photos($post_id, $num = 0, $sizes = null, $ret = null, $landscape = null) {
	// save the image with the highest priority
	// to use when returing only one image
	$top_priority['priority'] = 9999;
	
	// check if there are attachments
	if ( $images = get_children(array(
		'post_parent' => $post_id,
		'post_type' => 'attachment',
		'order' => 'ASC',
		'orderby' => 'menu_order',
		'post_mime_type' => 'image')))
	{
		// loop through each image
		foreach($images as $image) {
			$image->attachment_metadata = wp_get_attachment_metadata($image->ID);
			if(isset($photo['photos'])) $i = count($photo['photos']); // counter
			else $i = 0;

			// store image information
			$photo['photos'][$i]['id'] = get_id($image);
			$photo['photos'][$i]['caption'] = get_caption($image);
			$photo['photos'][$i]['credit'] = get_credit($image);
			$photo['photos'][$i]['priority'] = get_priority($image);
			$photo['photos'][$i]['width'] = get_width($image);
			$photo['photos'][$i]['height'] = get_height($image);
			
			// return requested sizes
			if($sizes) {
				foreach($sizes as $size) {
					$photo['photos'][$i]['src'][$size] = get_src($image, $size);
				}
			} else { // return all sizes when none are specified
				$photo['photos'][$i]['src']['full'] = get_src($image, 'full');
				$photo['photos'][$i]['src']['large'] = get_src($image, 'large');
				$photo['photos'][$i]['src']['thumbnail'] = get_src($image, 'thumbnail');
				$photo['photos'][$i]['src']['medium'] = get_src($image, 'medium');
				$photo['photos'][$i]['src']['single-inline'] = get_src($image, 'single-inline');
				$photo['photos'][$i]['src']['alt-thumbnail'] = get_src($image, 'alt-thumbnail');
				$photo['photos'][$i]['src']['custom-495'] = get_src($image, 'custom-495');
				$photo['photos'][$i]['src']['custom-165'] = get_src($image, 'custom-165');
				$photo['photos'][$i]['src']['custom-260'] = get_src($image, 'custom-260');
				$photo['photos'][$i]['src']['custom-75x75-crop'] = get_src($image, 'custom-75x75-crop');
			}
			
			// store the photo with the highest priority in wordpress.
			// photos with high priorities are given low numbers.
			// photos with priority of -1 are ignored.
			if( $num === 1 && $photo['photos'][$i]['priority'] < $top_priority['priority'] && $photo['photos'][$i]['priority'] >= 0 ) {
				// if user wants a landscape photo, check
				// to make sure it is landscape
				if( $landscape && !is_landscape( $image ) ) {
					continue;
				}
				$top_priority = $photo['photos'][$i];
			}
			
			// determine image position based on priority
			if( !isset($photo['display']['feature']) && get_priority($image) === 1 ) {
			
				// feature photo - below headline
				$photo['display']['feature'] = $i;
				$photo['photos'][$i]['src']['single-feature'] = get_src($image, 'single-feature');
			
			} elseif(!isset($photo['display']['inline']) && get_priority($image) === 2) {
			
				// inline photo - thumbnail w/in post
				$photo['display']['inline'] = $i;
				$photo['photos'][$i]['src']['single-inline'] = get_src($image, 'single-inline');
			
			} else {
				if(!isset($photo['display']['inline'])) { // inline photo has not been set
			
					$photo['display']['inline'] = $i;
					$photo['photos'][$i]['src']['single-inline'] = get_src($image, 'single-inline');
			
				} else {
			
					// gallery photo - appears in post photo gallery
					if(isset($photo['display']['gallery']))
						$photo['display']['gallery'][count($photo['display']['gallery'])] = $i;
					else
						$photo['display']['gallery'][0] = $i;
			
				}
			}
			
			// return first photo when one is requested and there is only one
			if($num === 1 && count($images) == 1) return $photo['photos'][$i];
		}
		// returns top photo when one is requested.
		// if user only wants one landscape photo,
		// but the top_priority is not landscape, don't
		// return anything.
		if( $num === 1 ) {
			if( $landscape && !is_landscape( $image ) ) {
				return false;
			}
			return $top_priority;
		}
		
		// return all of the requested photos
		return $photo;
	} else {
		// check if the image is from the archives. images on our old 
		// websites (custom CMS for some time then College Publisher)
		// were not saved as attachments, but were stored as custom
		// fields.
		$meta = get_post_custom($post_id);
		if($meta && isset($meta['_image1'])) {
			$meta['_image1'] = get_image($meta['_image1']);
			
			// needed to make legacy photo output look like current photos
			$photo['photos'][0] = $meta['_image1'];
			$photo['photos'][0]['priority'] = 0;
			$photo['display']['inline'] = 0;
			
			if($num === 1) return $photo['photos'][0];
			return $photo;
		}
	}
	
	// no images were found
	return false;
}