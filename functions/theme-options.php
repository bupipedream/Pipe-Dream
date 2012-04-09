<?php

// Options page for the Pipe Dream theme.

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'pd_options', 'pd_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'pdtheme' ), __( 'Theme Options', 'pdtheme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
		
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'pdtheme' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'pdtheme' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'pd_options' ); ?>
			<?php $options = get_option( 'pd_theme_options' ); ?>

				<?php
				/**
				 * A pd text input option
				 */
				?>
				<label class="description" for="pd_theme_options[stabilizing]"><?php _e( 'Stabilizing:', 'pdtheme' ); ?></label>
				<input id="pd_theme_options[stabilizing]" class="regular-text" type="text" name="pd_theme_options[stabilizing]" value="<?php esc_attr_e( $options['stabilizing'] ); ?>" /><br />
				
				<label class="description" for="pd_theme_options[destabilizing]"><?php _e( 'Destabilizing:', 'pdtheme' ); ?></label>
				<input id="pd_theme_options[destabilizing]" class="regular-text" type="text" name="pd_theme_options[destabilizing]" value="<?php esc_attr_e( $options['destabilizing'] ); ?>" />

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'pdtheme' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// Say our text option must be safe text with no HTML tags
	$input['stabilizing'] = wp_filter_nohtml_kses( $input['stabilizing'] );
	$input['destabilizing'] = wp_filter_nohtml_kses( $input['destabilizing'] );

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/