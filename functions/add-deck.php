<?php
/*
Plugin Name: Article Deck
Plugin URI: http://www.bupipedream.com/
Description: Add a deck to an article published in WordPress. Code modified from a Tuts+ tutorial: http://bit.ly/oHVeaT.
Version: 1.0
Author: Modified by Daniel O'Connor, original by Christopher Davis of wp.tutsplus.com.
License: Public Domain
*/

add_action( 'add_meta_boxes', 'pd_article_deck_add' );
function pd_article_deck_add()
{
	add_meta_box( 'my-meta-box-id', 'Article Deck', 'pd_article_deck', 'post', 'normal', 'high' );
}

function pd_article_deck( $post )
{
	$values = get_post_custom( $post->ID );
	$text = isset( $values['pd_article_deck_text'] ) ? esc_attr( $values['pd_article_deck_text'][0] ) : '';

	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );

	?>
	<p>
		<textarea rows="3" cols="40" name="pd_article_deck_text" id="pd_article_deck_text" tabindex="12" style="width: 100% !important;"><?php echo $text; ?></textarea>
	</p>
	<!-- Description from Wikipedia -->
	<p>A deck is a phrase, sentence or several sentences near the title of an article or story, a quick blurb or article teaser.</p>
	<?php	
}


add_action( 'save_post', 'pd_article_deck_save' );
function pd_article_deck_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);
	
	// Probably a good idea to make sure your data is set
	if( isset( $_POST['pd_article_deck_text'] ) )
		update_post_meta( $post_id, '_pd_article_deck_text', wp_kses( $_POST['pd_article_deck_text'], $allowed ) );
}
?>