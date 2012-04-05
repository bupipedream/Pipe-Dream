	<footer class="row">
		<div id="footer-logo" class="span6">
			<!-- Pipe Dream -->
			<a href="<?php bloginfo('wpurl'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/footerlogo.png" alt="<?php bloginfo('name'); ?>" /></a>
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
		<div id="stabalizing" class="span4">&nbsp;<!-- <p>#stabilizing: <?php echo $stabalizing; ?><br />#destabilizing: <?php echo $destabilizing; ?></p> --></div>
		<div id="wordpress" class="span2 last">
			<!-- Powered by WordPress -->
			<a href="http://wordpress.org/">
				<img src="<?php bloginfo('template_url'); ?>/img/wordpress.png" alt="WordPress" title="Proudly Powered by WordPress" />
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

	<script type="text/javascript" charset="utf-8">
	  var is_ssl = ("https:" == document.location.protocol);
	  var asset_host = is_ssl ? "https://s3.amazonaws.com/getsatisfaction.com/" : "http://s3.amazonaws.com/getsatisfaction.com/";
	  document.write(unescape("%3Cscript src='" + asset_host + "javascripts/feedback-v2.js' type='text/javascript'%3E%3C/script%3E"));
	</script>

	<script type="text/javascript">
	  var uvOptions = {};
	  (function() {
	    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
	    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/iSDTPAOAnF0OSUjtrpDiA.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
	  })();
	</script>
		
</body>
</html>