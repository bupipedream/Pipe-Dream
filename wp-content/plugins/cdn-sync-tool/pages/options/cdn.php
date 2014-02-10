<div class="cst-main">
	<form action="" method="post">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="cdn">Content Delivery Network</label></th>
					<td>
						<select id="cdn" name="options[cst-cdn]">
							<option value="S3" <?php if (isset(self::$options['cst-cdn']) && self::$options['cst-cdn'] == 'S3') { echo 'selected="selected"'; } ?>>Amazon S3</option>
							<option value="FTP" <?php if (isset(self::$options['cst-cdn']) && self::$options['cst-cdn'] == 'FTP') { echo 'selected="selected"'; } ?>>(S)FTP</option>
							<option value="Cloudfiles" <?php if (isset(self::$options['cst-cdn']) && self::$options['cst-cdn'] == 'Cloudfiles') { echo 'selected="selected"'; } ?>>Cloudfiles</option>
							<option value="WebDAV" <?php if (isset(self::$options['cst-cdn']) && self::$options['cst-cdn'] == 'WebDAV') { echo 'selected="selected"'; } ?>>WebDAV</option>
							<option value="Origin" <?php if (isset(self::$options['cst-cdn']) && self::$options['cst-cdn'] == 'Origin') { echo 'selected="selected"'; } ?>>NetDNA/MaxCDN/Origin Pull</option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="cdn-hostname">Hostname of CDN</label></th>
					<td><input type="text" name="options[ossdl_off_cdn_url]" id="cdn-hostname" <?php if (get_option('ossdl_off_cdn_url')) {echo 'value="'.esc_attr(get_option('ossdl_off_cdn_url')).'"'; } ?> /></td>
				</tr>
			</tbody>
		</table>

		<div class="cst-specific-options">

			<table class="form-table S3">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="accesskey">Access Key</label></th>
						<td><input type="text" name="options[cst-s3-accesskey]" id="accesskey" <?php if (isset(self::$options['cst-s3-accesskey'])) {echo 'value="'.esc_attr(self::$options['cst-s3-accesskey']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="secretkey">Secret Key</label></th>
						<td><input type="text" name="options[cst-s3-secretkey]" id="secretkey" <?php if (isset(self::$options['cst-s3-secretkey'])) {echo 'value="'.esc_attr(self::$options['cst-s3-secretkey']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="s3-bucket">Bucket</label></th>
						<td><input type="text" name="options[cst-s3-bucket]" id="s3-bucket" <?php if (isset(self::$options['cst-s3-bucket'])) {echo 'value="'.esc_attr(self::$options['cst-s3-bucket']).'"'; } ?> /></td>
						<td><strong>If the bucket does not exist it will be created</strong></td>
					</tr>
				</tbody>
			</table>

			<table class="form-table FTP">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="cf-stfp">SFTP</label></th>
						<td>
							<input type="radio" value="yes" name="options[cst-ftp-sftp]" id="cst-ftp-sftp-yes" <?php if (get_option('cst-ftp-sftp') == 'yes') { echo 'checked="checked"'; }?> /><label for="cst-ftp-sftp-yes" class="cst-inline-label">Yes</label>
							<input type="radio" value="no" name="options[cst-ftp-sftp]" id="cst-ftp-sftp-no" <?php if (get_option('cst-ftp-sftp') == 'no') { echo 'checked="checked"'; }?> /><label for="cst-ftp-sftp-no" class="cst-inline-label">No</label>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="ftp-server">Server</label></th>
						<td><input type="text" name="options[cst-ftp-server]" id="ftp-server" <?php if (isset(self::$options['cst-ftp-server'])) {echo 'value="'.esc_attr(self::$options['cst-ftp-server']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="ftp-port">Port</label></th>
						<td><input type="text" name="options[cst-ftp-port]" id="ftp-port" <?php if (isset(self::$options['cst-ftp-port'])) {echo 'value="'.esc_attr(self::$options['cst-ftp-port']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="ftp-username">Username</label></th>
						<td><input type="text" name="options[cst-ftp-username]" id="ftp-username" <?php if (isset(self::$options['cst-ftp-username'])) {echo 'value="'.esc_attr(self::$options['cst-ftp-username']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="ftp-password">Password</label></th>
						<td><input type="password" name="options[cst-ftp-password]" id="ftp-password" <?php if (isset(self::$options['cst-ftp-password'])) {echo 'value="'.esc_attr(self::$options['cst-ftp-password']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="ftp-dir">Directory</label?</th>
						<td><input type="text" name="options[cst-ftp-dir]" id="ftp-dir" <?php if (isset(self::$options['cst-ftp-dir'])) {echo 'value="'.esc_attr(self::$options['cst-ftp-dir']).'"'; } ?> /></td>
						<td><strong>Relative to the path that you are logged in to. Ensure this exists and is writable.</strong></td>
					</tr>
				</tbody>
			</table>

			<table class="form-table Cloudfiles">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="cf-username">Username</label></th>
						<td><input type="text" name="options[cst-cf-username]" id="cf-username" <?php if (isset(self::$options['cst-cf-username'])) {echo 'value="'.esc_attr(self::$options['cst-cf-username']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="cf-region">Region</label></th>
						<td>
							<input type="radio" value="uk" name="options[cst-cf-region]" id="cst-cf-region-uk" <?php if (get_option('cst-cf-region') == 'uk') { echo 'checked="checked"'; }?> /><label for="cst-cf-region-uk" class="cst-inline-label">UK</label>
							<input type="radio" value="us" name="options[cst-cf-region]" id="cst-cf-region-us" <?php if (get_option('cst-cf-region') == 'us') { echo 'checked="checked"'; }?> /><label for="cst-cf-region-us" class="cst-inline-label">US</label>
						</td>
						<td><strong>If you are unsure, you are likely US</strong></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="cf-api">API Key</label></th>
						<td><input type="text" name="options[cst-cf-api]" id="cf-api" <?php if (isset(self::$options['cst-cf-api'])) {echo 'value="'.esc_attr(self::$options['cst-cf-api']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="cf-container">Container</label></th>
						<td><input type="text" name="options[cst-cf-container]" id="cf-container" <?php if (isset(self::$options['cst-cf-container'])) {echo 'value="'.esc_attr(self::$options['cst-cf-container']).'"'; } ?> /></td>
						<td><strong>If the container does not exist it will be created</strong></td>
				</tbody>
			</table>

			<table class="form-table WebDAV">
				<tbody>
					<tr valign="top">
						<th scope="row"><label for="webdav-username">Username</label></th>
						<td><input type="text" name="options[cst-webdav-username]" id="webdav-username" <?php if (isset(self::$options['cst-webdav-username'])) {echo 'value="'.esc_attr(self::$options['cst-webdav-username']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="webdav-password">Password</label></th>
						<td><input type="password" name="options[cst-webdav-password]" id="webdav-password" <?php if (isset(self::$options['cst-webdav-password'])) {echo 'value="'.esc_attr(self::$options['cst-webdav-password']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="webdav-host">Host</label></th>
						<td><input type="text" name="options[cst-webdav-host]" id="webdav-host" <?php if (isset(self::$options['cst-webdav-host'])) {echo 'value="'.esc_attr(self::$options['cst-webdav-host']).'"'; } ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="webdav-basedir">Base directory</label></th>
						<td><input type="text" name="options[cst-webdav-basedir]" id="webdav-basedir" <?php if (isset(self::$options['cst-webdav-basedir'])) {echo 'value="'.esc_attr(self::$options['cst-webdav-basedir']).'"'; } ?> /></td>
						<td><strong>No trailing slash (/). Must already exist</strong></td>
					</tr>
				</tbody>
			</table>
		</div>

		<input type="hidden" name="form" value="cst-main" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save and Test Changes" /></p>
	</form>
</div>
