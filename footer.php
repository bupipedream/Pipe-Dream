	<footer class="row" role="contentinfo">
		<div id="footer-logo" class="span6">
			<!-- Pipe Dream -->
			<a href="<? bloginfo( 'wpurl' ); ?>" title="<?php bloginfo( 'name' ); ?>">
				<img src="<? bloginfo( 'template_url' ); ?>/img/footerlogo.png" alt="<?php bloginfo( 'name' ); ?>" />
			</a>
		</div>

		<nav id="footer-links" class="span12">
			<ul>
				<li><a href="<?php bloginfo('wpurl'); ?>/news/">News</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/sports/">Sports</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/opinion/">Opinion</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/release/">Release</a></li>
			</ul>
			<ul>
				<li>Established 1946</li>
				<!-- <li><a href="<?php bloginfo('wpurl'); ?>/about/">About</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/contact/">Contact</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/contribute/">Contribute</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/staff/">Staff</a></li> -->
			</ul>
		</nav>
		<div id="stabalizing" class="span4">
			<!-- with love -->
			<?php
				$options = get_option( 'pd_theme_options' );
				$stabilizing = $options['stabilizing'];
				$destabilizing = $options['destabilizing'];
			?>
			<p>#stabilizing: <?= $stabilizing; ?><br />#destabilizing: <?= $destabilizing; ?></p>
		</div>
		<div id="wordpress" class="span2 last">
			<!-- Powered by WordPress -->
			<a href="http://wordpress.org/">
				<img src="<?php bloginfo( 'template_url' ); ?>/img/wordpress.png" alt="WordPress" title="Proudly Powered by WordPress" />
			</a>
		</div>
	</footer>
</div>

	<!-- JavaScript at the bottom for fast page loading -->

	<!-- scripts concatenated and minified via build script -->
	<script src="<?php bloginfo('template_url'); ?>/js/plugins.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/script.js"></script>
	<!-- end scripts -->
  
	<!-- Used by WP plugins -->
	<?php wp_footer(); ?>
		
</body>
</html>