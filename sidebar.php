<div id="rightcol" class="span7 last">
	<!-- Right Column -->
	
	<?php if(is_single()): ?>
		<section id="fb-settings" class="doublehrule">
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
	
	<!-- <section class="ad"> -->
		<!--/* OpenX Javascript Tag v2.8.8 */-->

		<script type='text/javascript'><!--//<![CDATA[
		   // var m3_u = (location.protocol=='https:'?'https://www.bupipedream.com/openx/www/delivery/ajs.php':'http://www.bupipedream.com/openx/www/delivery/ajs.php');
		   // var m3_r = Math.floor(Math.random()*99999999999);
		   // if (!document.MAX_used) document.MAX_used = ',';
		   // document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
		   // document.write ("?zoneid=1&amp;block=1");
		   // document.write ('&amp;cb=' + m3_r);
		   // if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
		   // document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
		   // document.write ("&amp;loc=" + escape(window.location));
		   // if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
		   // if (document.context) document.write ("&context=" + escape(document.context));
		   // if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
		   // document.write ("'><\/scr"+"ipt>");
		//]]>--></script><noscript><a href='http://www.bupipedream.com/openx/www/delivery/ck.php?n=ad9e85cc&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://www.bupipedream.com/openx/www/delivery/avw.php?zoneid=1&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=ad9e85cc' border='0' alt='' /></a></noscript>

	<!-- </section> -->
	
	<?php if(is_home() || is_category()): ?>
		
		<section id="fb-like-box">
			<div class="fb-like-box" data-href="http://www.facebook.com/bupipedream" data-width="292" data-height="185" data-show-faces="true" data-border-color="#cccccc" data-stream="false" data-header="false"></div>
		</section>
		
		<section id="twitter-follow">
			<a href="https://twitter.com/bupipedream" class="twitter-follow-button" data-show-count="true">Follow @bupipedream</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</section>
		<!-- <section class="ad" style="margin-top: 13px;"> -->
			<!--/* OpenX Javascript Tag v2.8.8 */-->

			<script type='text/javascript'><!--//<![CDATA[
			   // var m3_u = (location.protocol=='https:'?'https://www.bupipedream.com/openx/www/delivery/ajs.php':'http://www.bupipedream.com/openx/www/delivery/ajs.php');
			   // var m3_r = Math.floor(Math.random()*99999999999);
			   // if (!document.MAX_used) document.MAX_used = ',';
			   // document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
			   // document.write ("?zoneid=2&amp;block=1");
			   // document.write ('&amp;cb=' + m3_r);
			   // if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
			   // document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
			   // document.write ("&amp;loc=" + escape(window.location));
			   // if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
			   // if (document.context) document.write ("&context=" + escape(document.context));
			   // if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
			   // document.write ("'><\/scr"+"ipt>");
			//]]>--></script><noscript><a href='http://www.bupipedream.com/openx/www/delivery/ck.php?n=a0bcea6a&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://www.bupipedream.com/openx/www/delivery/avw.php?zoneid=2&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a0bcea6a' border='0' alt='' /></a></noscript>
		<!-- </section> -->

		<section id="most-read">
			<h2 class="section-label">Most Read</h2>
			<?php
				echo '<ol>';
				$posts = wmp_get_popular( array( 'limit' => 5, 'post_type' => 'post', 'range' => 'weekly' ) );
				global $post;
				if ( count( $posts ) > 0 ): foreach ( $posts as $post ):
				    setup_postdata( $post );
		    ?>
			    <li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
		    <?php
				endforeach; endif;
				echo '</ol>';
			?>
		</section>
		
	<?php endif; ?>

	<?php if(is_single()): ?>
		
		<section id="latest-news">
			<h2 class="section-label"><a href="<?php echo home_url(); ?>/news/">Latest News &raquo;</a></h2>
				
			<ol>
				<?php
					global $post;
					$args = array( 'numberposts' => 5, 'category' => 1 ); // news
					$myposts = get_posts( $args );
					foreach( $myposts as $post ) : setup_postdata($post);
				?>
					<li>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p>&mdash; <?php echo get_the_excerpt(); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</section>
	
	<?php endif; ?>
	
</div>
