<div id="sidebar" class="span7 last">
	<!-- Right Column -->	

	<!--/* OpenX Javascript Tag v2.8.10 */-->
	<script type='text/javascript'><!--//<![CDATA[
		var m3_u = (location.protocol=='https:'?'https://www.bupipedream.com/openx/www/delivery/ajs.php':'http://www.bupipedream.com/openx/www/delivery/ajs.php');
		var m3_r = Math.floor(Math.random()*99999999999);
		if (!document.MAX_used) document.MAX_used = ',';
		document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
		document.write ("?zoneid=1");
		document.write ('&amp;cb=' + m3_r);
		if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
		document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
		document.write ("&amp;loc=" + escape(window.location));
		if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
		if (document.context) document.write ("&context=" + escape(document.context));
		if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
		document.write ("'><\/scr"+"ipt>");
	//]]>--></script><noscript><a href='http://www.bupipedream.com/openx/www/delivery/ck.php?n=a5e11ab5&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://www.bupipedream.com/openx/www/delivery/avw.php?zoneid=1&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a5e11ab5' border='0' alt='' /></a></noscript>

	<?php if( is_single() ): ?>
		<section id="fb-settings" class="sidebar-block">
			<img id="fb-profile-img" />
			<div id="fb-profile-details" class="clearfix">
				<p id="fb-name"></p>
				<p id="fb-login-status">Logged into Pipe Dream and Facebook</p>
				<ul>
					<li id="fb-show-activity"><a href="#">Activity</a></li>
					<li id="fb-state"><a href="#">Sharing <span></span></a></li>
					<li id="fb-show-settings"><a href="#">Settings</a></li>
				</ul>
			</div>
			<div id="fb-recent-activity">
				<h2 class="section-label">Recently Read</h2>
				<ul>
				</ul>
			</div>
			<div id="fb-settings-list">
				<h2 class="section-label">Social Settings</h2>
				<ul>
					<li><a href="#" id="fb-message-developer" onClick="_gaq.push(['_trackEvent', 'Open Graph', 'Account', 'Message Developer']);">Send feedback to developer</li>
					<li><a href="#" id="fb-logout-link" onClick="_gaq.push(['_trackEvent', 'Open Graph', 'Account', 'Facebook Logout']);">Sign out of Facebook</a></li>
					<li><a href="#" onclick="revokePermission(); onClick="_gaq.push(['_trackEvent', 'Open Graph', 'Account', 'Revoke Permission']);"; return false;">Remove social sharing</a></li>
				</ul>
			</div>
		</section>
	<?php endif; ?>
		
	<?php if( is_home() || is_category() ): ?>
 		
		<section class="sidebar-block sidebar-block-center">
			<div class="fb-like-box" data-href="http://www.facebook.com/bupipedream" data-width="292" data-height="185" data-show-faces="true" data-border-color="#cccccc" data-stream="false" data-header="false"></div>
		</section>

		<section id="sidebar-twitter" class="sidebar-block sidebar-block-center">
			<a href="https://twitter.com/bupipedream" class="twitter-follow-button" data-show-count="true">Follow @bupipedream</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</section>
		
 		<section id="sidebar-most-read" class="sidebar-block sidebar-article-list sidebar-article-list-small">
			<h1 class="section-heading">Most Read</h1>
			<ol>
				<?php
					$posts = wmp_get_popular( array( 'limit' => 5, 'post_type' => 'post', 'range' => 'weekly' ) );
					global $post;
					if ( count( $posts ) > 0 ): foreach ( $posts as $post ):
						setup_postdata( $post );
				?>
					<li>
						<article>
							<h2 class="headline">
								<a href="<? the_permalink() ?>" title="<?= esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
									<?php if ( get_the_title() ) the_title(); else the_ID(); ?>
								</a>
							</h2>
						</article>
					</li>
				<?php endforeach; endif; ?>
			</ol>
		</section>
		
	<?php endif; ?>

	<?php if( is_single() ): ?>
		
		<section class="sidebar-block sidebar-article-list sidebar-article-list-large">
			<h1 class="section-heading"><a href="<?= home_url(); ?>/news/">Latest News</a></h1>
			
			<ol>
				<?php
					global $post; // prob not safe?
					$args = array( 'numberposts' => 5, 'category' => 1 ); // news
					$myposts = get_posts( $args );
					foreach( $myposts as $post ) : setup_postdata( $post );
				?>
					<li>
						<h2 class="headline">
							<a href="<? the_permalink(); ?>"><? the_title(); ?></a>
						</h2>
						<p><?= get_the_excerpt(); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</section>
	
	<?php endif; ?>
	
	<?php if( is_home() ): ?>
		
		<?
			$issuu = get_option( 'pd_theme_options' );
			$issuu_link = $issuu['issuu_link'];
			$issuu_id = $issuu['issuu_id'];
		?>
		<? if( $issuu_id ): ?>
			<section id="sidebar-issuu" class="sidebar-block">
				<h1 class="section-heading">
					<a href="<?= $issuu_link; ?>">Current Issue</a>
				</h1>
				<div data-configid="<?= $issuu['issuu_id']; ?>" style="width: 100%; height: 271px;" class="issuuembed"></div>
				<script type="text/javascript" src="//e.issuu.com/embed.js" async="true"></script>
			</section>
		<? endif; ?>
		
	<?php endif; ?>

	<!--/* OpenX Javascript Tag v2.8.11 */-->

	<!--/*
	  * The backup image section of this tag has been generated for use on a
	  * non-SSL page. If this tag is to be placed on an SSL page, change the
	  *   'http://www.bupipedream.com/openx/www/delivery/...'
	  * to
	  *   'https://www.bupipedream.com/openx/www/delivery/...'
	  *
	  * This noscript section of this tag only shows image banners. There
	  * is no width or height in these banners, so if you want these tags to
	  * allocate space for the ad before it shows, you will need to add this
	  * information to the <img> tag.
	  *
	  * If you do not want to deal with the intricities of the noscript
	  * section, delete the tag (from <noscript>... to </noscript>). On
	  * average, the noscript tag is called from less than 1% of internet
	  * users.
	  */-->

	<script type='text/javascript'><!--//<![CDATA[
	   var m3_u = (location.protocol=='https:'?'https://www.bupipedream.com/openx/www/delivery/ajs.php':'http://www.bupipedream.com/openx/www/delivery/ajs.php');
	   var m3_r = Math.floor(Math.random()*99999999999);
	   if (!document.MAX_used) document.MAX_used = ',';
	   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
	   document.write ("?zoneid=5");
	   document.write ('&amp;cb=' + m3_r);
	   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
	   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
	   document.write ("&amp;loc=" + escape(window.location));
	   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
	   if (document.context) document.write ("&context=" + escape(document.context));
	   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
	   document.write ("'><\/scr"+"ipt>");
	//]]>--></script><noscript><a href='http://www.bupipedream.com/openx/www/delivery/ck.php?n=aae0889b&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://www.bupipedream.com/openx/www/delivery/avw.php?zoneid=5&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=aae0889b' border='0' alt='' /></a></noscript>


	<!-- Innvocation code for 120x600 ad banner -->
	<!--/* OpenX Javascript Tag v2.8.11 */-->

	<!--/*
	  * The backup image section of this tag has been generated for use on a
	  * non-SSL page. If this tag is to be placed on an SSL page, change the
	  *   'http://www.bupipedream.com/openx/www/delivery/...'
	  * to
	  *   'https://www.bupipedream.com/openx/www/delivery/...'
	  *
	  * This noscript section of this tag only shows image banners. There
	  * is no width or height in these banners, so if you want these tags to
	  * allocate space for the ad before it shows, you will need to add this
	  * information to the <img> tag.
	  *
	  * If you do not want to deal with the intricities of the noscript
	  * section, delete the tag (from <noscript>... to </noscript>). On
	  * average, the noscript tag is called from less than 1% of internet
	  * users.
	  */-->

	<script type='text/javascript'><!--//<![CDATA[
	   var m3_u = (location.protocol=='https:'?'https://www.bupipedream.com/openx/www/delivery/ajs.php':'http://www.bupipedream.com/openx/www/delivery/ajs.php');
	   var m3_r = Math.floor(Math.random()*99999999999);
	   if (!document.MAX_used) document.MAX_used = ',';
	   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
	   document.write ("?zoneid=4");
	   document.write ('&amp;cb=' + m3_r);
	   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
	   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
	   document.write ("&amp;loc=" + escape(window.location));
	   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
	   if (document.context) document.write ("&context=" + escape(document.context));
	   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
	   document.write ("'><\/scr"+"ipt>");
	//]]>--></script><noscript><a href='http://www.bupipedream.com/openx/www/delivery/ck.php?n=ac82518f&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://www.bupipedream.com/openx/www/delivery/avw.php?zoneid=4&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=ac82518f' border='0' alt='' /></a></noscript>

	<!-- Innvocation code for 120x600 ad banner -->



<?php if (is_home()): ?>

		<!-- code for 250 x 300 ad -->

		<!--/* OpenX Javascript Tag v2.8.11 */-->

		<!--/*
		  * The backup image section of this tag has been generated for use on a
		  * non-SSL page. If this tag is to be placed on an SSL page, change the
		  *   'http://www.bupipedream.com/openx/www/delivery/...'
		  * to
		  *   'https://www.bupipedream.com/openx/www/delivery/...'
		  *
		  * This noscript section of this tag only shows image banners. There
		  * is no width or height in these banners, so if you want these tags to
		  * allocate space for the ad before it shows, you will need to add this
		  * information to the <img> tag.
		  *
		  * If you do not want to deal with the intricities of the noscript
		  * section, delete the tag (from <noscript>... to </noscript>). On
		  * average, the noscript tag is called from less than 1% of internet
		  * users.
		  */-->

		<script type='text/javascript'><!--//<![CDATA[
		   var m3_u = (location.protocol=='https:'?'https://www.bupipedream.com/openx/www/delivery/ajs.php':'http://www.bupipedream.com/openx/www/delivery/ajs.php');
		   var m3_r = Math.floor(Math.random()*99999999999);
		   if (!document.MAX_used) document.MAX_used = ',';
		   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
		   document.write ("?zoneid=6");
		   document.write ('&amp;cb=' + m3_r);
		   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
		   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
		   document.write ("&amp;loc=" + escape(window.location));
		   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
		   if (document.context) document.write ("&context=" + escape(document.context));
		   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
		   document.write ("'><\/scr"+"ipt>");
		//]]>--></script><noscript><a href='http://www.bupipedream.com/openx/www/delivery/ck.php?n=a9f30dc1&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://www.bupipedream.com/openx/www/delivery/avw.php?zoneid=6&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a9f30dc1' border='0' alt='' /></a></noscript>

		<!-- end code for 250 x 300 ad -->

<?php endif ?>

</div>
