<?php
if (get_option('cst-custom-directories')) {
	$dirs = unserialize(get_option('cst-custom-directories'));
	$directoryText = '';
	foreach ($dirs as $dir) {
		$directoryText .= $dir."\n";
	}
	$directoryText = trim($directoryText);
}
?>
<div class="cst-main">
	<form action="" method="post">
		<input type="hidden" name="form" value="cst-sync" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<div class="cst-sync-options">
			<h3>Sync To CDN</h3>
			<div class="cst-sync-options-input"><input type="checkbox" checked="checked" name="cst-options[syncfiles][theme]" id="cst-sync-theme"><label for="cst-sync-theme">Theme Files</label></div>
			<div class="cst-sync-options-input"><input type="checkbox" checked="checked" name="cst-options[syncfiles][media]" id="cst-sync-media"><label for="cst-sync-media">Media Files</label></div>
			<div class="cst-sync-options-input"><input type="checkbox" checked="checked" name="cst-options[syncfiles][wp]" id="cst-sync-wp"><label for="cst-sync-wp">WP Files</label></div>
			<div class="cst-sync-options-input"><input type="checkbox" checked="checked" name="cst-options[syncfiles][plugin]" id="cst-sync-plugin"><label for="cst-sync-plugin">Plugin Files</label></div>
			<div class="cst-sync-options-input"><input type="checkbox" checked="checked" name="cst-options[syncfiles][cssjs]" id="cst-sync-cssjs"><label for="cst-sync-cssjs">CSS/JS Files</label></div>
			<div class="cst-sync-options-input"><input type="checkbox" name="cst-options[syncall]" id="cst-sync-all"><label for="cst-sync-all">Sync all files (even if they are up to date)</label></div>
		<p class="submit"><input type="submit" name="submit" class="button-primary" value="Sync" /></p>
		</div>
	</form>
	<form action="" method="post">
		<input type="hidden" name="form" value="cst-sync-custom" />
		<?php wp_nonce_field('cst-nonce'); ?>
		<div class="cst-sync-options">
			<h3>Sync Custom Directory To CDN</h3>
			<div class="cst-sync-options-input">
				<textarea name="cst-custom-options[files]" id="cst-sync-custom-files" cols="30" rows="5"><?=$directoryText?></textarea>
				<p>One directory per line, relative to site root.</p>
			</div>
			<p class="submit"><input type="submit" name="submit" class="button-primary" value="Sync" /></p>
		</div>
	</form>
</div>
