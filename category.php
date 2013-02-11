<?php get_header(); ?>
	<div class="row" id="content">
		<?php
			$featured = pd_get_category_posts($cat);
			$args = array(
				'post__not_in' => $featured['exclude'],
				'cat' => $cat,
				'paged' => get_query_var('paged'),
			);
			query_posts($args);
		?>
		
		<div class="span17">
			<?php if(!get_query_var('paged') || get_query_var('paged') == '1'): ?>
			<div class="row">
				<div id="leftcol" class="span16">
					<section>
						
						<!-- Featured article -->
						<article class="feature clearfix thinhrule">
							
							<?php 
								$article = get_post($featured['feature'], 'ARRAY_A');
								$photos = get_photos($article['ID'], 1);
							?>
							
							<figure class="center">
								<a href="<?php echo get_permalink( $article['ID'] ); ?>">
									<img src="<?php echo $photos['src']['custom-495']; ?>" />
								</a>
								<figcaption><p><?php echo $photos['credit']; ?></p></figcaption>
							</figure>
							
							<h2><a href="<?php echo get_permalink( $article['ID'] ); ?>"><?php echo $article['post_title']; ?></a></h2>
							
							<p class="byline below"><p class="byline below">
								<?php if($article['post_author'] === '2'): ?>
									<span><?php echo pd_is_archived($article['ID'], '_author') ?></span>
								<?php else: ?>
									<span><?php $author = get_userdata($article['post_author']); echo $author->display_name; ?></span>
								<?php endif;?>
								
								 - <time datetime="<?php echo date('Y-m-j\TH:i:sT', strtotime($article['post_date'])); ?>" title="<?php echo date('F j, Y \a\t g:i A T', strtotime($article['post_date'])); ?>"><?php echo get_time_since($article['post_date']); ?></time></p>
							
							<p>
								<?php 
									if($article['post_excerpt']) echo $article['post_excerpt']; 
									else echo get_custom_excerpt($article['post_content'], '25'); 
								?>
							</p>
							
							<ul class="article-links">
								<li><a href="<?php echo get_permalink($article['ID']) ?>#comments" class="comments-label" title="Responses to &quot;<?php echo esc_attr($article['post_title']); ?>&quot;">Comments</a></li>
							</ul>
							
						</article>
					</section>
				</div>
				
				<!-- Secondary featured articles -->
				<div id="middlecol" class="span8 last">
					<section>
						<?php foreach($featured['secondary'] as $post_id): ?>
							
							<?php 
								// Some of the zones on the homepage display
								// more than two posts so this will make sure
								// that the post isn't posted twice.
								if($post_id):
							?>
							
								<?php
									$article = get_post( $post_id, 'ARRAY_A' );
									$photos = get_photos($article['ID'], 1);
								?>
								
								<article class="clearfix">
									
									<h2><a href="<?php echo get_permalink( $article['ID'] ); ?>"><?php echo $article['post_title']; ?></a></h2>
									
									<?php if($photos): ?>
										<figure class="float-right">
											<a href="<?php echo get_permalink($article['ID']) ?>">
												<img src="<?php echo $photos['src']['custom-75x75-crop']; ?>" width="75px" height="75px" />
											</a>
										</figure>
									
									<?php endif; ?>
									
									<p class="byline below"><p class="byline below">
										<?php if($article['post_author'] === '2'): ?>
											<!-- If user is Archives -->
											<span><?php echo pd_is_archived($article['ID'], '_author') ?></span>
										<?php else: ?>
											<span><?php $author = get_userdata($article['post_author']); echo $author->display_name; ?></span>
										<?php endif;?>
									
										<?php if($photos) echo "<br />"; else echo " - " ?>  <time datetime="<?php echo date('Y-m-j\TH:i:sT', strtotime($article['post_date'])); ?>" title="<?php echo date('F j, Y \a\t g:i A T', strtotime($article['post_date'])); ?>"><?php echo get_time_since($article['post_date']); ?></time></p>
	
									<p>
										<?php 
											if($article['post_excerpt']) echo $article['post_excerpt']; 
											else echo get_custom_excerpt($article['post_content'], '25'); 
										?>
									</p>
								</article>
							
							<?php endif; ?>
						
						<?php endforeach; ?>
						
					</section>
				</div>
			</div>
			
			<?php endif; ?>
			
			<div class="row">
				
				<!-- Show section label when browsing through pages -->
				<?php if(get_query_var('paged') > '1'): ?>
					<h2 class="section-label"><?php echo get_the_category_by_ID($cat); ?> &raquo;</h2>
				<?php endif; ?>
				
				<section id="article-list">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
						<article class="clearfix">
							
							<!-- Grab all of the photos associated with article. -->
							<?php $photos = get_photos(get_the_ID(), 1, array('alt-thumbnail')); ?>
							
							<?php if($photos): ?>
								<figure>
									<a href="<?php the_permalink() ?>">
										<img src="<?php if($photos['src']['alt-thumbnail']) echo $photos['src']['alt-thumbnail']; else echo $photos['src']['single-inline']; ?>" />
									</a>
								</figure>
							<?php endif; ?>
							
							<?php if(has_tag('blog')): ?><span class="label blog">Blog</span><?php endif; ?>
							<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							
							<p class="byline below">By 
								<?php if(function_exists('coauthors_posts_links')): ?>
									<?php if(is_coauthor_for_post('Staff Reports')): ?>
										<span>Staff Reports</a></span>
									<?php elseif(is_coauthor_for_post('archives')): ?>
										<span><?php echo pd_pd_is_archived(get_the_ID(), '_author') ?></a></span>
									<?php else: ?>
										<span><?php coauthors(); ?></span>
									<?php endif;?>
								<?php endif;?>
								
								 - <time datetime="<?php the_time('Y-m-j\TH:i:sT'); ?>" title="<?php the_time('F j, Y \a\t g:i A T'); ?>"><?php the_time('F j, Y'); ?></time></p>
							
							<p><?php the_excerpt(); ?></p>
							
							<ul class="article-links">
								<li><a href="<?php echo get_permalink($article['ID']) ?>#comments" class="comments-label" title="Responses to &quot;<?php echo esc_attr($article['post_title']); ?>&quot;">Comments</a></li>
							</ul>
							
						</article>

					<?php endwhile; ?>	

					<div id="pagination">
						<?php
							global $wp_query;

							$big = 999999999; // need an unlikely integer
							$url = str_replace( $big, '%#%', get_pagenum_link( $big ));
							$pos = strlen(site_url());

							if(strpos(curPageURL(), 'browse') === false) {
								$params = '/browse'.substr($url, $pos);			
							} else {
								$params = substr($url, $pos);
							}

							$url = substr($url, '0', $pos).$params;
										
							echo paginate_links( array(
								'base' => $url,
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages
							) );
						?>
					</div>
					
					<?php else : ?>
					
					<article id="post-not-found">
						<header>
							<h1><?php _e("No Posts Yet", "bonestheme"); ?></h1>
						</header>
						<section class="post_content">
							<p><?php _e("Sorry, What you were looking for is not here.", "bonestheme"); ?></p>
						</section>
						<footer>
						</footer>
					</article>
					
					<?php endif; ?>
				</section>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>