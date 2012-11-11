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
			<div class="row">
				
				<div class="blog-description">
					<h2 class="blog-title"><?=get_the_category_by_ID($cat);?></h2>
					<?=category_description($cat);?>
				</div>
				
				<section id="article-list">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
						<article class="clearfix">
							
							<!-- Grab all of the photos associated with article. -->
							<?php $photos = get_photos(get_the_ID(), '1'); ?>
							
							<?php if($photos): ?>
								<figure>
									<a href="<?php the_permalink() ?>">
										<img src="<?php if($photos['src']['custom-165']) echo $photos['src']['custom-165']; else echo $photos['src']['single-inline']; ?>" />
									</a>
								</figure>
							<?php endif; ?>
							
							<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							
							<p class="byline below">By 
								<?php if(function_exists('coauthors_posts_links')): ?>
									<?php if(is_coauthor_for_post('Staff Reports')): ?>
										<span>Staff Reports</a></span>
									<?php elseif(is_coauthor_for_post('archives')): ?>
										<span><?php echo pd_is_archived(get_the_ID(), '_author') ?></a></span>
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