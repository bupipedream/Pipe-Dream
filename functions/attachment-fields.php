<?php

/**
 * Adding our custom fields to the $form_fields array
 * 
 * @param array $form_fields
 * @param object $post
 * @return array
 */
function my_image_attachment_fields_to_edit($form_fields, $post) {
	// $form_fields is a special array of fields to include in the attachment form
	// $post is the attachment record in the database
	//     $post->post_type == 'attachment'
	// (attachments are treated as posts in WordPress)
	
	// add our custom field to the $form_fields array
	$form_fields["credit"]["label"] = __("Credit");
	$form_fields["credit"]["input"] = "text";
	$form_fields["credit"]["value"] = get_post_meta($post->ID, "_credit", true);
	$form_fields["credit"]["helps"] = _("Name/Position");

	$form_fields["position"]["label"] = __("Position");  
	$form_fields["position"]["input"] = "html";  
	$form_fields["position"]["value"] = get_post_meta($post->ID, "_position", true);
	if($form_fields["position"]["value"] === "feature") {
		// photo display is feature
		$form_fields["position"]["html"] = "<select name='attachments[{$post->ID}][position]' id='attachments[{$post->ID}][position]'> 
												<option value='inline'>Inline</option>
												<option value='feature' selected>Feature</option>
											</select>";
	} else {
		// photo display is inline by default
		$form_fields["position"]["html"] = "<select name='attachments[{$post->ID}][position]' id='attachments[{$post->ID}][position]'> 
												<option value='inline' selected>Inline</option>
												<option value='feature'>Feature</option>
											</select>";
	}
	return $form_fields;
}
// attach our function to the correct hook
add_filter("attachment_fields_to_edit", "my_image_attachment_fields_to_edit", null, 2);


/** 
 * @param array $post 
 * @param array $attachment 
 * @return array 
 */  
function add_image_attachment_fields_to_save($post, $attachment) {  
	// $attachment part of the form $_POST ($_POST[attachments][postID])  
	// $post attachments wp post array - will be saved after returned  
	//     $post['post_type'] == 'attachment'
	if( isset($attachment['position']) ){  
		update_post_meta($post['ID'], '_position', $attachment['position']);  
	}
	if( isset($attachment['credit']) ){  
		update_post_meta($post['ID'], '_credit', $attachment['credit']);  
	}
	return $post;
}
add_filter("attachment_fields_to_save", "add_image_attachment_fields_to_save", null , 2);