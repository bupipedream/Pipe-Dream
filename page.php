<?php get_header(); ?>
	<div class="row" id="content">
		<div class="span17">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<article class="pad-left pad-right" id="post-<?php the_ID(); ?>">
					
					<h2 class="page-title"><?php the_title(); ?></h2>
					
					<section class="pad-left pad-right"> <!-- article text and images -->
						<?php the_content(); ?>
					</section>
				</article>
			
			<?php endwhile; ?>
			
			<?php else : ?>
				<p>Page not found.</p>			
			<?php endif; ?>

		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>