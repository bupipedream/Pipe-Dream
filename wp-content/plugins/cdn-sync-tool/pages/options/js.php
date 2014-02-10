<div class="cst-js">
	<form action="" method="post">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label>Combine JS files</label></th>
					<td>
						<input type="radio" value="yes" name="options[cst-js-combine]" id="cst-js-combine-yes" <?php if (get_option('cst-js-combine') == 'yes') { echo 'checked="checked"'; }?> /><label for="cst-js-combine-yes" class="cst-inline-label">Yes</label>
						<input type="radio" value="no" name="options[cst-js-combine]" id="cst-js-combine-no" <?php if (get_option('cst-js-combine') == 'no') { echo 'checked="checked"'; } ?> /><label for="cst-js-combine-no" class="cst-inline-label">No</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>JS script tag placement</label></th>
					<td>
						<input type="radio" value="head" name="options[cst-js-placement]" id="cst-js-placement-head" <?php if (get_option('cst-js-placement') == 'head') { echo 'checked="checked"'; }?> /><label for="cst-js-placement-head" class="cst-inline-label">Head</label>
						<input type="radio" value="body" name="options[cst-js-placement]" id="cst-js-placement-body" <?php if (get_option('cst-js-placement') == 'body') { echo 'checked="checked"'; } ?> /><label for="cst-js-placement-body" class="cst-inline-label">Body</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="cst-js-savepath">Save path</label></th>
					<td>
						<input type="text" id="cst-js-savepath" name="options[cst-js-savepath]" value="<?php echo get_option('cst-js-savepath'); ?>" />
					</td>
					<td><strong>Relative to WordPress root directory (no leading or trailing '/')</strong></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>Minify using Google Closure Library</label></th>
					<td>
						<input type="radio" value="yes" id="cst-js-minify-yes" name="options[cst-js-minify]" <?php if (get_option('cst-js-minify') == 'yes') { echo 'checked="checked"'; }?> /><label for="cst-js-minify-yes" class="cst-inline-label">Yes</label>
						<input type="radio" value="no" id="cst-js-minify-no" name="options[cst-js-minify]" <?php if (get_option('cst-js-minify') == 'no') { echo 'checked="checked"'; }?> /><label for="cst-js-minify-no" class="cst-inline-label">No</label>
					</td>
				</tr>
				<tr valign="top" class="js-opt-level" style="display: none;">
					<th scope="row"><label>Optimisation level</label></th>
					<td>
						<select name="options[cst-js-optlevel]">
						<option value="whitespace" <?php if (get_option('cst-js-optlevel') == 'whitespace') { echo 'selected="selected"'; } ?>>Whitespace Only</option>
							<option value="simple" <?php if (get_option('cst-js-optlevel') == 'simple') { echo 'selected="selected"'; } ?>>Simple Optimisation</option>
							<option value="advanced" <?php if (get_option('cst-js-optlevel') == 'advanced') { echo 'selected="selected"'; } ?>>Advanced Optimisation</option>
						</select>
					</td>
					<td><strong>If you have issues with advanced/simple then try whitespace only.</strong></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>Exclude external files from combination/minification</label></th>
					<td>
						<input type="radio" value="yes" id="cst-js-exclude-external-yes" name="options[cst-js-exclude-external]" <?php if (get_option('cst-js-exclude-external') == 'yes') { echo 'checked="checked"'; }?> /><label for="cst-js-exclude-external-yes" class="cst-inline-label">Yes</label>
						<input type="radio" value="no" id="cst-js-exclude-external-no" name="options[cst-js-exclude-external]" <?php if (get_option('cst-js-exclude-external') == 'no') { echo 'checked="checked"'; }?> /><label for="cst-js-exclude-external-no" class="cst-inline-label">No</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>Exclude JS files from combination/minification</label></th>
					<td>
						<textarea id="cst-js-exclude" name="options[cst-js-exclude]" rows="5" cols="50"><?php $fileslist = get_option('cst-js-exclude'); $fileslist = str_replace(',', "\n", $fileslist); echo $fileslist; ?></textarea>
					</td>
					<td><strong>Each file on new line. Exact path relative to site root <em>(e.g. wp-content/js/main.js)</em></strong></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="form" value="cst-js" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save" /></p>
	</form>
</div>
