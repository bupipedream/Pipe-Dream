</div>
	<footer id="footer">
		<section id="stabilizing-destabilizing">
			<div class="row">
				<?php
					$options = get_option( 'pd_theme_options' );
					$stabilizing = $options['stabilizing'];
					$destabilizing = $options['destabilizing'];
				?>
				<span id="stabilizing" class="pad-left">
					<?= $stabilizing ? '#stabilizing: ' . $stabilizing : ''; ?>
				</span>
				<span id="destabilizing" class="pad-right">
					<?= $destabilizing ? '#destabilizing: ' . $destabilizing : ''; ?>
				</span>
			</div>
		</section>
		<nav id="footer-navigation" class="row">
			<div id="footer-logo">
				<a href="<? bloginfo( 'url' ); ?>/" title="<? bloginfo('name'); ?>">
					<img src="<? bloginfo('template_url'); ?>/img/bupipedream.png" alt="<? bloginfo( 'name' ); ?> - <? bloginfo( 'description' ); ?>" />
				</a>
			</div>
			<ul>
				<li><a href="<? bloginfo( 'wpurl' ); ?>/news/" title="News Articles">News</a></li>
				<li><a href="<? bloginfo( 'wpurl' ); ?>/sports/" title="Sports Articles">Sports</a></li>
				<li><a href="<? bloginfo( 'wpurl' ); ?>/opinion/" title="Opinion Columns">Opinion</a></li>
				<li><a href="<? bloginfo( 'wpurl' ); ?>/release/" title="Release Articles">Release</a></li>
				<li class="footer-navigation-light"><a href="<? bloginfo('wpurl'); ?>/about/" title="About Pipe Dream">About</a></li>
				<li class="footer-navigation-light"><a href="<? bloginfo('wpurl'); ?>/advertise/" title="Advertise in Pipe Dream">Advertise</a></li>
				<li class="footer-navigation-light"><a href="<? bloginfo('wpurl'); ?>/join/" title="Join Pipe Dream">Join</a></li>
				<li class="footer-navigation-light"><a href="<? bloginfo('wpurl'); ?>/contact/" title="Contact Pipe Dream">Contact</a></li>
			</ul>
		</nav>
	</footer>

	<!-- JavaScript at the bottom for fast page loading -->

	<!-- scripts concatenated and minified via build script -->
	<script src="<?php bloginfo('template_url'); ?>/js/plugins.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>
	<!-- end scripts -->
  
	<!-- Used by WP plugins -->
	<?php wp_footer(); ?>
		
</body>
</html>