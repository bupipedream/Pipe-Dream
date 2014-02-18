<?php get_header(); ?>
	<div id="content" class="row">
		<div data-column="left-column" class="<?= !in_category( 'multimedia' ) ? 'span17' : 'span24' ?>">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!-- Check if the article is part of the archives -->
			<?php $archive = pd_is_archived( get_the_ID(), null ); ?>

			<article id="post-<?php the_ID(); ?>" class="pad-left clearfix" itemscope itemtype="http://schema.org/Article">
				
				<div class="single-label single-date">
					<time itemprop="dateCreated" datetime="<?php the_time('Y-m-j\TH:i:sT'); ?>" title="Published on <?php the_time('F j, Y \a\t g:i A T'); ?>">
						<?php the_time('F j, Y'); ?>
					</time>
				</div>
				
				<?if(in_category('opinion') && !in_category('editorial')):?>
					<span class="opinion-label" title="Views expressed in this column represent the opinion of the columnist.">Opinion</span>
				<?endif?>
				<h2 class="headline" itemprop="headline"><?php the_title(); ?></h2>
				
				<p class="deck"><?= get_post_meta( get_the_ID(), '_pd_article_deck_text', true ); ?></p>
				
				<!-- Schema.org markup -->
				<meta itemprop="wordCount" content="<?= str_word_count( get_the_content() ); ?>" />
				<meta itemprop="discussionUrl" content="<?= get_permalink(); ?>#comments" />
				<meta itemprop="copyrightYear" content="<?php the_time( 'Y' ); ?>" />
				<meta itemprop="inLanguage" content="en-US" />
				<?php
					// Display the post's category
		     		$category = get_the_category(); 
					$category = $category[0]->cat_name;
					if($category != 'Archives') {
						echo '<meta itemprop="articleSection" content="' . $category . '" />';
					}
		     	?>
				
				<div class="single-meta single-meta-above">
					<div class="social-fb fb-like" data-href="<?= get_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-action="recommend"></div>
					<?php if( function_exists( 'coauthors_posts_links' ) ): ?>
						<? if( coauthors( null, null, null, null, false ) === "Staff Reports" ): ?>
							<span class="author" itemprop="author">Staff Reports</span>
						<? elseif( coauthors( null, null, null, null, false ) === "The Editorial Board" ): ?>
							<a href="<? bloginfo( 'wpurl' ); ?>/opinion/editorial/" title="More Pipe Dream editorials">
								<span class="author" itemprop="author">The Editorial Board</span>
							</a>
						<?php elseif( coauthors( null, null, null, null, false ) === "archives" ): ?>
							<span class="author" itemprop="author">
								<?php 
									if( isset( $archive['_author'] ) ) {
										echo $archive['_author'];
									} else if( strpos( get_the_title() , 'to the editor' ) !== 0 ) {
										// new posts are often misattributed to "archives"
										// causing all sorts of issues.
										echo "Guest Author";
									}
								?>
							</span>
						<?php else: ?>
							<span class="author" itemprop="author"><?php coauthors_posts_links(); ?></span>
						<?php endif;?>
					<?php endif;?>
				</div>
				
				<section class="post-body"> <!-- article text and images -->
				
					<!-- Grab all of the photos associated with article. -->
					<?php $attachments = get_photos( get_the_ID() ); ?>
					
					<?php if( isset( $attachments['photos'][0]['src']['medium'] ) ): ?>
					<meta itemprop="thumbnailUrl" content="<?= $attachments['photos'][0]['src']['medium']; ?>" />
					<?php endif; ?>
					
					<!--
					// Check if a feature photo exists. If there is a feature photo,
					// display it and set $paragraphAfter to display any inline photo
					// after the third paragraph. This ensures that there is enough 
					// vertical-space between both images. We also make ensure that
					// this post is not a photo gallery.
					-->
					<?php if( isset( $attachments['display']['feature'] ) && !in_category( 'multimedia' ) ): ?>
						
						<?php $photo = $attachments['photos'][$attachments['display']['feature']]; ?>
						
						<figure class="single-image single-image-feature">
							<a href="<?= $photo['src']['large']; ?>" title="<?= $photo['caption']; ?> (<?= $photo['credit']; ?>)" class="gallery" rel="gallery">
								<img src="<?= $photo['src']['medium']; ?>" />
							</a>
							<figcaption>
								<span class="clearfix photo-credit"><?= $photo['credit']; ?></span>
								<span class="clearfix photo-caption"><?= $photo['caption']; ?></span>
							</figcaption>
						</figure>
						
						<!-- 
						// When there is are feature and inline photos,
						// display the inline photo a little further down.
						-->
						<?php $paragraphAfter = 3; ?>
						
					<?php endif; ?>
					
					
					<!-- 
					// Check if an inline photo exists and ensure
					// the post is not a photo gallery.
					-->
					<?php if( ( isset( $attachments['display']['inline'] ) || isset( $archive['_image1'] ) ) && $attachments['photos'][$attachments['display']['inline']]['priority'] !== -1  && !in_category( 'multimedia' )): ?>
						<?php
							if( isset( $attachments['display']['inline'] ) ) {
								$photo = $attachments['photos'][$attachments['display']['inline']];
							} else {
								$photo = $archive['_image1'];
							}
						?>
						
						<div itemprop="articleBody">
						<?php
							if( !isset( $paragraphAfter ) ) $paragraphAfter = 1; 
							$content = apply_filters( 'the_content', get_the_content() );
							$content = explode( "</p>", $content );
							for ( $i = 0; $i < count( $content ); $i++ ) {
							if ( $i == $paragraphAfter ) { ?>
								
								<?php // ensures that vertical photos 
									$subject = $photo['src']['single-inline'];
									$pattern = '/\d{3}x\d{3}/';
									preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE);
									if(isset($matches[0][0]) && $matches[0][0]) $max_width = substr($matches[0][0], 0, 3)."px";
									else $max_width = "425px";
								?>
								
								<!-- Display the inline photo -->
								<figure class="single-image single-image-inline" style="max-width: <?= ( $max_width ) ? $max_width : '' ?>;">
									<?php if( in_category( 'opinion' ) ): ?>
										<img src="<?= $photo['src']['single-inline']; ?>" class="single-image-headshot" />
									<?php else: ?>
										<a href="<?= $photo['src']['large']; ?>" <?php if($photo['credit']): ?>title="<?= $photo['caption']; ?> <?= "(".$photo['credit'].")"; ?>" <?php endif; ?> class="gallery" rel="gallery">
											<img src="<?= $photo['src']['single-inline']; ?>" />
											<?php if( isset( $attachments['photos'] ) && count( $attachments['photos'] ) > 2): ?>
												<span class="more-photos"><img src="<?= get_template_directory_uri(); ?>/img/slideshow.png">Slide Show</span>
											<?php endif; ?>
										</a>
									<?php endif; ?>
									
									<figcaption>
										<span class="clearfix photo-credit"><?= $photo['credit']; ?></span>
										<span class="clearfix photo-caption"><?= $photo['caption']; ?></span>
									</figcaption>
								</figure>
								
							<?php }
							echo $content[$i] . "</p>";
						} ?>
						</div>
						
						<!-- Display the extra images in a slideshow  -->
						<?php if( isset( $attachments['display']['gallery'] ) && !in_category( 'multimedia' ) ): ?>
							<?php foreach( $attachments['display']['gallery'] as $image ): ?>
								<a href="<?= $attachments['photos'][$image]['src']['large']; ?>" title="<?= $attachments['photos'][$image]['caption']; ?> (<?= $attachments['photos'][$image]['credit']; ?>)" class="gallery" rel="gallery">
									<img src="<?= $attachments['photos'][$image]['src']['single-inline']; ?>" style="display: none;" />
								</a>
							<?php endforeach; ?>
						<?php endif; ?>
						
					<?php else: ?> <!-- There is a feature photo, but no inline photo -->
						
						<div itemprop="articleBody">

							<?php if( in_category( 'photo' ) ): ?>
								<?php the_content(); ?>

								<?php foreach ( $attachments['photos'] as $index => $photo ): ?>
									<figure id="photo-<?= $photo['id'] ?>">
										<img src="<?= $photo['src']['large'] ?>">
										<figcaption>
											<span class="clearfix photo-credit"><?= $photo['credit']; ?> (<a href="<?= the_permalink(); ?>#photo-<?= $photo['id'] ?>" title="Permanant link to photo">#</a>)</span>
											<span class="clearfix photo-caption"><?= $photo['caption']; ?></span>
										</figcaption>
									</figure>
								<?php endforeach; ?>

							<?php elseif( in_category( 'graphic' ) ): ?>
	
								<figure id="graphic-<?= $attachments['photos'][0]['id'] ?>">
									<img src="<?= $attachments['photos'][0]['src']['full'] ?>">
									<figcaption>
										<span class="clearfix photo-credit"><?= $attachments['photos'][0]['credit']; ?></span>
									</figcaption>
								</figure>
								<?php the_content(); ?>

							<?php else : ?>
								<?php the_content(); ?>
							<?php endif; ?>
						</div>
						
					<?php endif; ?>
				</section>
			</article>

			<? if(in_category('opinion') && !in_category('editorial')):?>
				<p style="font-style: italic; font-size: 0.90em; border-bottom: 1px solid #eee; border-top: 1px solid #eee; padding: 1em;">Views expressed in the opinion pages represent the opinions of the columnists.</p>
			<? endif; ?>

			<section class="single-meta single-meta-below social-bar">
				<div class="social-twitter">				
					<a href="https://twitter.com/share" class="twitter-share-button" data-via="bupipedream" data-related="bupipedream">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
				<div class="fb-like" data-href="<?= get_permalink(); ?>" data-send="true" data-width="600" data-show-faces="true" data-action="recommend"></div>
			</section>
			
			
 			<section id="comments">
				<div id="disqus_thread"></div>
				<script type="text/javascript">
				    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
				    var disqus_shortname = 'pipedream'; // required: replace example with your forum shortname

				    /* * * DON'T EDIT BELOW THIS LINE * * */
				    (function() {
				        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
				        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
				    })();
				</script>
				<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
			</section>
			
			<?php endwhile; ?>
			
			
			<?php else : ?>
			
			<article id="post-not-found">
				<header>
					<h1>Not Found</h1>
				</header>
				<section class="post_content">
					<p>Sorry, but the requested resource was not found on this site.</p>
				</section>
				<footer>
				</footer>
			</article>
			
			<?php endif; ?>
			
		</div>
		<?php if( !in_category( 'multimedia' ) ) get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>
