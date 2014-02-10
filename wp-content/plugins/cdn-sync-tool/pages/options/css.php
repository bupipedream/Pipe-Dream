<div class="cst-css">
	<form action="" method="post">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label>Combine CSS files</label></th>
					<td>
						<input type="radio" value="yes" name="options[cst-css-combine]" id="cst-css-combine-yes" <?php if (get_option('cst-css-combine') == 'yes') { echo 'checked="checked"'; }?> /><label for="cst-css-combine-yes" class="cst-inline-label">Yes</label>
						<input type="radio" value="no" name="options[cst-css-combine]" id="cst-css-combine-no" <?php if (get_option('cst-css-combine') == 'no') { echo 'checked="checked"'; } ?> /><label for="cst-css-combine-no" class="cst-inline-label">No</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="cst-css-savepath">Save path</label></th>
					<td>
						<input type="text" id="cst-css-savepath" name="options[cst-css-savepath]" value="<?php echo get_option('cst-css-savepath'); ?>" />
					</td>
					<td><strong>Relative to WordPress root directory (no leading or trailing '/')</strong></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>Exclude external files from combination/minification</label></th>
					<td>
						<input type="radio" value="yes" id="cst-css-exclude-external-yes" name="options[cst-css-exclude-external]" <?php if (get_option('cst-css-exclude-external') == 'yes') { echo 'checked="checked"'; }?> /><label for="cst-css-exclude-external-yes" class="cst-inline-label">Yes</label>
						<input type="radio" value="no" id="cst-css-exclude-external-no" name="options[cst-css-exclude-external]" <?php if (get_option('cst-css-exclude-external') == 'no') { echo 'checked="checked"'; }?> /><label for="cst-css-exclude-external-no" class="cst-inline-label">No</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>Exclude CSS files from combination/minification</label></th>
					<td>
						<textarea id="cst-css-exclude" name="options[cst-css-exclude]" rows="5" cols="50"><?php $fileslist = get_option('cst-css-exclude'); $fileslist = str_replace(',', "\n", $fileslist); echo $fileslist; ?></textarea>
					</td>
					<td><strong>Each file on new line. Exact path relative to site root <em>(e.g. wp-content/css/style.css)</em></strong></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="form" value="cst-css" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save" /></p>
	</form>
</div>
