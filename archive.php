<?php get_header(); ?>
	<div class="row" id="content">
		<div id="leftcol" class="span17">

			<section id="posts">

				<ul id="archive-list" class="clearfix">
					<?php // wp_get_archives('type=yearly'); ?>
					<?php wp_get_archives('type=monthly'); ?>
					<?php // wp_get_archives('type=daily'); ?>
				</ul>

	 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

				<?php /* If this is a category archive */ if (is_category()) { ?>
					<h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>

				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>

				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h2>Archive for <?php the_time('F jS, Y'); ?></h2>

				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h2>Archive for <?php the_time('F, Y'); ?></h2>

				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>

				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h2 class="pagetitle">Author Archive</h2>

				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h2 class="pagetitle">Blog Archives</h2>

				<?php } ?>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
														
					<article class="clearfix">

						<!-- Grab all of the photos associated with article. -->
						<?php $photos = get_photos(get_the_ID(), 1, 'thumbnail'); ?>
						
						<?php if($photos): ?>
							<figure><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php echo $photos['src']['thumbnail']; ?>" /></a></figure>
						<?php endif; ?>

						<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>
						<time datetime="<?php the_time('Y-m-j\Th:i'); ?>" itemprop="datePublished"><?php the_time('F j, Y'); ?></time>
					</article>

				<?php endwhile; ?>	

				<div id="pagination">
					<?php
				
						global $wp_query;

						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
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
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>