<?php get_header(); ?>
	<div class="row" id="content">
		<div class="span17">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
			<article id="post-<?php the_ID(); ?>">
				
				<!-- <p class="published">
					<time datetime="<?php the_time('Y-m-j\TH:i:sT'); ?>" title="Published on <?php the_time('F j, Y \a\t g:i A T'); ?>">
						<?php the_time('F j, Y'); ?>
					</time>
				</p> -->
				
				<h2><?php the_title(); ?></h2>
				
				<!-- <div id="meta">					
				</div> -->
				
				<section> <!-- article text and images -->
					<?php the_content(); ?>
				</section>
			</article>
						
			<?php endwhile; ?>
						
			<?php else : ?>

			<article id="post-not-found">
			    <header>
			    	<h1>Not Found</h1>
			    </header>
			    <section class="post_content">
			    	<p>Sorry, but the requested page was not found on this site.</p>
			    </section>
			    <footer>
			    </footer>
			</article>
			
			<?php endif; ?>

		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>