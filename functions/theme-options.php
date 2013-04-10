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

$radio_options = array(
	'on' => array(
		'value' => 'on',
		'label' => __( 'Enabled', 'pdtheme' )
	),
	'off' => array(
		'value' => 0,
		'label' => __( 'Disabled', 'pdtheme' )
	)
);


/**
 * Create the options page
 */
function theme_options_do_page() {
	global $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>
		
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . wp_get_theme() . __( ' Theme Options', 'pdtheme' ) . "</h2>"; ?>

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
				<h3>Stabalizing/Destabalizing</h3>
				<label class="description" for="pd_theme_options[stabilizing]"><?php _e( 'Stabilizing:&nbsp;&nbsp;&nbsp;&nbsp;', 'pdtheme' ); ?></label>
				<input id="pd_theme_options[stabilizing]" class="regular-text" type="text" name="pd_theme_options[stabilizing]" value="<?php esc_attr_e( $options['stabilizing'] ); ?>" /><br />
				
				<label class="description" for="pd_theme_options[destabilizing]"><?php _e( 'Destabilizing:', 'pdtheme' ); ?></label>
				<input id="pd_theme_options[destabilizing]" class="regular-text" type="text" name="pd_theme_options[destabilizing]" value="<?php esc_attr_e( $options['destabilizing'] ); ?>" /><br /><br />
				
				<h3>Issuu Embed</h3>
				<label class="description" for="pd_theme_options[issuu_link]"><?php _e( 'Issuu Link:&nbsp;&nbsp;&nbsp;&nbsp;', 'pdtheme' ); ?></label>
				<input id="pd_theme_options[issuu_link]" class="regular-text" type="text" name="pd_theme_options[issuu_link]" value="<?php esc_attr_e( $options['issuu_link'] ); ?>" /><br /><br />
				
				<label class="description" for="pd_theme_options[issuu_id]"><?php _e( 'Issuu ID:', 'pdtheme' ); ?></label><br />
				<textarea id="pd_theme_options[issuu_id]" class="regular-text" type="text" style="width: 300px;" name="pd_theme_options[issuu_id]"><?php esc_attr_e( $options['issuu_id'] ); ?></textarea><br />
				
				<h3>Notice</h3>
				<label class="description" for="pd_theme_options[notice-status]"><?php _e( 'Display: &nbsp;&nbsp;', 'pdtheme' ); ?></label><br />
				<fieldset>
					<?php
						if ( ! isset( $checked ) )
							$checked = '';
						foreach ( $radio_options as $option ) {
							$radio_setting = $options['radioinput'];

							if ( '' != $radio_setting ) {
								if ( $options['radioinput'] === $option['value'] ) {
									$checked = "checked=\"checked\"";
								} else {
									$checked = '';
								}
							} else {
								$checked = "checked=\"checked\"";
							}
							?>
							<label class="description"><input type="radio" name="pd_theme_options[radioinput]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?></label><br />
							<?php
						}
					?>
				</fieldset>
				<br />
				
				<label class="description" for="pd_theme_options[theme]"><?php _e( 'Theme (Breaking, Message): &nbsp;&nbsp;', 'pdtheme' ); ?></label><br />
				
				<input id="pd_theme_options[theme]" class="regular-text" type="text" name="pd_theme_options[theme]" value="<?php esc_attr_e( $options['theme'] ); ?>" /><br /><br />

				<label class="description" for="pd_theme_options[label]"><?php _e( 'Label: &nbsp;&nbsp;', 'pdtheme' ); ?></label><br />
				<input id="pd_theme_options[label]" class="regular-text" type="text" name="pd_theme_options[label]" value="<?php esc_attr_e( $options['label'] ); ?>" /><br /><br />
				
				<label class="description" for="pd_theme_options[time]"><?php _e( 'Time: &nbsp;&nbsp;', 'pdtheme' ); ?></label><br />
				<input id="pd_theme_options[time]" class="regular-text" type="text" name="pd_theme_options[time]" value="<?php esc_attr_e( $options['time'] ); ?>" /><br /><br />

				<label class="description" for="pd_theme_options[message]"><?php _e( 'Message: &nbsp;&nbsp;', 'pdtheme' ); ?></label><br />
				<textarea id="pd_theme_options[message]" class="regular-text" type="text" style="width: 300px;" name="pd_theme_options[message]"><?php esc_attr_e( $options['message'] ); ?></textarea><br />

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
	global $radio_options;

	// Say our text option must be safe text with no HTML tags
	$input['stabilizing'] = wp_filter_nohtml_kses( $input['stabilizing'] );
	$input['destabilizing'] = wp_filter_nohtml_kses( $input['destabilizing'] );
	$input['time'] = wp_filter_nohtml_kses( $input['time'] );
	$input['theme'] = wp_filter_nohtml_kses( $input['theme'] );

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) ) {
		$input['radioinput'] = null;
	}
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) ) {
		$input['radioinput'] = null;
	}

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/