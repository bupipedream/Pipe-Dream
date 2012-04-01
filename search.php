<?php get_header(); ?>
	<div class="row" id="content">
		<div class="span17">
			
			<section id="results">
				
				<!-- count the number of posts -->
				<?php global $wp_query; $posts_count = $wp_query->found_posts; ?>
				
				<h2>Search Results for: <span class="highlight"><?php echo esc_attr(get_search_query()); ?></span><small>(<?php echo $posts_count.' result'.($posts_count == 1 ? '' : 's').' found' ?>)</small></h2>
								
				<?php 
					$is_author = pd_is_author(get_search_query()); 
					if(isset($is_author)):
				?>
				
				<div class="alert">
					<p>Are you searching for articles by <a href="<?php echo get_author_posts_url($is_author->ID); ?>"><?php echo $is_author->display_name; ?></a>?</p>
				</div>
				
				<?php endif; ?>
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<!-- Check if the article is part of the archives -->
					<?php $archive = pd_is_archived(get_the_ID()); ?>

					<?php // highlight the search results 
						$title = get_the_title();
						$excerpt = get_the_excerpt();
	
						$keys= explode(" ",$s); 
							
						$title = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="highlight">\0</span>', $title); 
						$excerpt = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="highlight">\0</span>', $excerpt); 
					?>
					
					<article class="clearfix">

						<!-- Grab all of the photos associated with article. -->
						<?php 
							$photos = get_photos(get_the_ID(), '1'); 
							//if(!$photos) $photos = $archive['_image1'];
						?>
						
						<?php if($photos): ?>
							<figure>
								<a href="<?php the_permalink() ?>">
									<img src="<?php echo $photos['src']['thumbnail']; ?>" />
								</a>
							</figure>
						<?php endif; ?>

						<h3><a href="<?php the_permalink() ?>"><?php echo $title; ?></a></h3>
						<p><?php echo $excerpt; ?></p>
						<time datetime="<?php the_time('Y-m-j\Th:i'); ?>" title="<?php the_time('F j, Y \a\t g:i A T'); ?>"><?php the_time('F j, Y'); ?></time>
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
					<p>Sorry, your search for "<?php echo esc_attr(get_search_query()); ?>" did not match any articles.</p>
				</article>
				
				<?php endif; ?>

			</section>
		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>