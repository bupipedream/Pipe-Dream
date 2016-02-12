<div id="sidebar" class="span7 last">
	<!-- Right Column -->	
<div class="ad" id="top_rectangle">
    <!-- /106249879/top_rectangle -->
    <div id='div-gpt-ad-1453841674269-0' style='height:388px; width:300px;'>
        <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1453841674269-0'); });
        </script>
    </div>   
</div> 
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
<div class="ad" id="rectangle_one">
	<!-- /106249879/rectangle_one -->
	<div id='div-gpt-ad-1455314561803-2' style='height:250px; width:300px;'>
	<script type='text/javascript'>
	googletag.cmd.push(function() { googletag.display('div-gpt-ad-1455314561803-2'); });
	</script>
	</div>
</div>

<div class="ad" id="skyscraper">
	<!-- /106249879/skyscraper -->
	<div id='div-gpt-ad-1455314561803-4'>
	<script type='text/javascript'>
	googletag.cmd.push(function() { googletag.display('div-gpt-ad-1455314561803-4'); });
	</script>
	</div>
</div>

<?php if (is_home()): ?>

<div class="ad" id="rectangle_two">
	<!-- /106249879/rectangle_two -->
	<div id='div-gpt-ad-1455314561803-3' style='height:250px; width:300px;'>
	<script type='text/javascript'>
	googletag.cmd.push(function() { googletag.display('div-gpt-ad-1455314561803-3'); });
	</script>
	</div>
</div>
<?php endif ?>

</div>
