<?php get_header(); ?>
	<div class="content row">
		<?php
			// get all of the featured posts, then load
			// everything else.
			$featured = pd_get_category_posts( $cat ); // $cat is a WordPress variable
			$args = array(
				'post__not_in' => $featured['exclude'],
				'cat' => $cat,
				'paged' => get_query_var( 'paged' ),
			);
			query_posts($args);
		?>
		
		<div data-column="left-two-columns" class="span17">
			<?php if( $featured && !get_query_var( 'paged' ) || get_query_var( 'paged' ) === 1 ): ?>
			<div class="archive-grid row grid-row">
				<div data-column="left-column" class="span16">
					<section class="pad-left pad-right">
						
						<!-- Featured article -->
						<article>
							
							<?php 
								$article = $featured['feature'];
								$photos = $article['photos'];
							?>
							
							<figure>
								<a href="<?= get_permalink( $article['ID'] ); ?>">
									<img src="<?= $photos['src']['custom-495']; ?>" />
								</a>
								<figcaption>
									<span class="photo-credit"><?= $photos['credit']; ?></span>
								</figcaption>
							</figure>
							
							<h2 class="headline">
								<a href="<?= get_permalink( $article['ID'] ); ?>">
									<?= $article['post_title']; ?>
								</a>
							</h2>
														
							<div class="meta">By <span class="author"><?= get_userdata($article['post_author'])->display_name; ?></span> - <time datetime="<?= date( 'Y-m-j\TH:i:sT', strtotime( $article['post_date'] ) ); ?>" title="<?= date( 'F j, Y \a\t g:i A T', strtotime( $article['post_date'] ) ); ?>"><?= get_time_since( $article['post_date'] ); ?></time></div>

							<p class="excerpt">
								<?= $article['post_excerpt'] ? $article['post_excerpt'] : get_custom_excerpt( $article['post_content'], 25 ); ?>
							</p>

						</article>
					</section>
				</div>
				
				<!-- Secondary featured articles -->
				<div data-column="middle-column" class="span8 last">
					<section id="category-secondary">
						<?php foreach( $featured['secondary'] as $index => $post_id ): ?>
							
							<?php 
								// Some of the zones on the homepage display
								// more than two posts so this will make sure
								// that the post isn't posted twice.
								if( $post_id ):
							?>
							
								<?php
									$article = $featured['secondary'][$index];
									$photos = $article['photos'];
								?>
								
								<article class="clearfix">
									
									<h2 class="headline">
										<a href="<?= get_permalink( $article['ID'] ); ?>">
											<?= $article['post_title']; ?>
										</a>
									</h2>
									
									<div class="meta">By <span class="author"><?= get_userdata($article['post_author'])->display_name; ?></span> - <time datetime="<?= date( 'Y-m-j\TH:i:sT', strtotime( $article['post_date'] ) ); ?>" title="<?= date( 'F j, Y \a\t g:i A T', strtotime( $article['post_date'] ) ); ?>"><?= get_time_since( $article['post_date'] ); ?></time></div>

									<?php if( $photos ): ?>
										
										<figure class="figure-right figure-border">
											<a href="<?= get_permalink( $article['ID'] ) ?>">
												<img src="<?= $photos['src']['custom-75x75-crop']; ?>" width="75px" height="75px" />
											</a>
										</figure>
									
									<?php endif; ?>
									
									<p class="excerpt">
										<?= $article['post_excerpt'] ? $article['post_excerpt'] : get_custom_excerpt( $article['post_content'], 18 ); ?>
									</p>
								</article>
							
							<?php endif; ?>
						
						<?php endforeach; ?>
						
					</section>
				</div>
			</div>
			
			<?php endif; ?>
			
			<div class="row">
				
				<?php if( get_query_var( 'paged' ) > 1 ): ?>
					<!-- show section label when browsing through pages-->
					<h1 class="page-title">
						<?= get_the_category_by_ID( $cat ); ?>
						<small>(Page <?= get_query_var( 'paged' ) ?>)</small>
					</h1>
				<?php elseif( !$featured ) : ?>
					<!-- viewing a subcategory -->
					<h1 class="page-title">
						<?= get_the_category_by_ID( $cat ); ?>
					</h1>
				<?php endif; ?>

				<section class="archive-list">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
						<article class="clearfix">
							
							<!-- Grab all of the photos associated with article. -->
							<?php $photos = get_photos( get_the_ID(), 1, array( 'alt-thumbnail' )); ?>
							
							<?php if( $photos ): ?>
								<figure class="figure-right figure-border">
									<a href="<?php the_permalink() ?>">
										<img src="<?= ($photos['src']['alt-thumbnail']) ? $photos['src']['alt-thumbnail'] : $photos['src']['single-inline']; ?>" />
									</a>
								</figure>
							<?php endif; ?>
							
							<h2 class="headline">
								<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
							</h2>
							
							<div class="meta"> 
								<?php if( function_exists( 'coauthors_posts_links' ) ): ?>
									<?php if( is_coauthor_for_post('Staff Reports' ) ): ?>
										<span class="author">Staff Reports</span> - 
									<?php elseif( is_coauthor_for_post( 'archives' ) || is_coauthor_for_post( 'guestauthor' ) ): ?>
										<span class="author">
											<?= pd_is_archived( get_the_ID(), '_author' ) ? 'By ' . pd_is_archived( get_the_ID(), '_author' ) . ' - ' : '' ?>
										</span>
									<?php else: ?>
										By <span class="author"><?php coauthors(); ?></span> - 
									<?php endif;?>
								<?php endif;?>
								<time datetime="<?php the_time('Y-m-j\TH:i:sT'); ?>" title="<?php the_time('F j, Y \a\t g:i A T'); ?>"><?php the_time('F j, Y'); ?></time>
							</div>
							

							<p class="excerpt"><?= get_custom_excerpt( get_the_excerpt(), 40 ); ?></p>
							
						</article>

					<?php endwhile; ?>	

					<div id="pagination">
						<?php
							global $wp_query;

							$big = 999999999; // need an unlikely integer
							$url = str_replace( $big, '%#%', get_pagenum_link( $big ));
							$pos = strlen( site_url() );

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
						<p>No articles found.</p>					
					<?php endif; ?>
				</section>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>