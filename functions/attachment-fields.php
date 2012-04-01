<?php

// Add custom meta-fields to file uploads. 
// http://wordpress.org/support/topic/addcustomize-meta-fields-to-edit-media-attachment-screen#post-2304586

function add_image_attachment_fields_to_edit($form_fields, $post) {
	// $form_fields is a an array of fields to include in the attachment form
	// $post is nothing but attachment record in the database
	//     $post->post_type == 'attachment'
	// attachments are considered as posts in WordPress. So value of post_type in wp_posts table will be attachment
	// now add our custom field to the $form_fields array
	// input type="text" name/id="attachments[$attachment->ID][custom1]"
	$form_fields["credit"] = array(
	  "label" => __("Credit"),
	  "input" => "text", // this is default if "input" is omitted
	  "value" => get_post_meta($post->ID, "_credit", true),
	              "helps" => __("Name/Position"),
	);
	unset($form_fields['post_content']);
	$form_fields['post_excerpt']['input'] = 'textarea';

   return $form_fields;
}

// now attach our function to the hook
add_filter("attachment_fields_to_edit", "add_image_attachment_fields_to_edit", null, 2);

function add_image_attachment_fields_to_save($post, $attachment) {
  // $attachment part of the form $_POST ($_POST[attachments][postID])
        // $post['post_type'] == 'attachment'
  if( isset($attachment['credit']) ){
    // update_post_meta(postID, meta_key, meta_value);
    update_post_meta($post['ID'], '_credit', $attachment['credit']);
  }
  return $post;
}
// now attach our function to the hook.
add_filter("attachment_fields_to_save", "add_image_attachment_fields_to_save", null , 2);