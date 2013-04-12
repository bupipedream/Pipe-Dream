<?php get_header(); ?>
	<div class="content row">
		<div data-column="left-column" class="span17" itemscope itemtype="http://schema.org/Person">

			<!-- Get information about the current author -->
			<?php 
				$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
				global $wpdb;
				$post_count = $wpdb->get_var( "SELECT COUNT(*) FROM `pd_posts` WHERE `post_author` = $curauth->ID AND `post_status` = 'publish' AND `post_type` = 'post'" );
			?>
			
			<h1 class="page-title" itemprop="name"><?= $curauth->display_name; ?></h2>
			<section class="author-card clearfix">

				<figure class="author-card-photo">
					<img src="http://www.gravatar.com/avatar/<?= md5(strtolower(trim("$curauth->user_email"))); ?>?s=75&d=mm" itemprop="image" />
				</figure>

				<ul class="author-card-info">
					<li class="author-card-info-prominent" itemprop="jobTitle"><?= $curauth->position; ?></li>
					<li><?= ($curauth->year && $curauth->major) ? $curauth->year . ", " . $curauth->major : '' ?></li>
					<li><a href="mailto:<?= $curauth->user_email; ?>" title="Email <?= $curauth->display_name; ?>" itemprop="email"><?= $curauth->user_email; ?></a></li>
				</ul>
			</section>
						
			<section class="archive-list">
				<h2 class="archive-list-heading"><?= $post_count . ' Article' . ( $post_count !== 1 ? 's' : '' ); ?></h2>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<article class="clearfix">
						<?php
							$photos = get_photos( get_the_ID(), 1, array( 'alt-thumbnail' ));
							if($photos):
						?>
						
							<figure class="figure-right figure-border">
								<a href="<?php the_permalink() ?>">
									<img src="<?= ($photos['src']['alt-thumbnail']) ? $photos['src']['alt-thumbnail'] : $photos['src']['single-inline']; ?>" />
								</a>
							</figure>

						<? endif; ?>

						<h2 class="headline">
							<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
						</h2>

						<div class="meta">By 
							<?php if( function_exists( 'coauthors_posts_links' ) ): ?>
								<?php if( is_coauthor_for_post('Staff Reports' ) ): ?>
									<span class="author">Staff Reports</span>
								<?php elseif( is_coauthor_for_post( 'archives' ) ): ?>
									<span class="author"><?= pd_is_archived( get_the_ID(), '_author' ) ?></span>
								<?php else: ?>
									<span class="author"><?php coauthors(); ?></span>
								<?php endif;?>
							<?php endif;?>
							- 
							<time datetime="<?php the_time('Y-m-j\TH:i:sT'); ?>" title="<?php the_time('F j, Y \a\t g:i A T'); ?>"><?php the_time('F j, Y'); ?></time>
						</div>
						
						<p class="excerpt"><?= get_the_excerpt(); ?></p>

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


				<?php else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
								</section>


		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>