<?php get_header(); ?>

	<div class="content row">
		<h1 class="page-title"><?php the_title(); ?></h1>
		<section class="post">
			<?php the_content(); ?>
		</section>
	</div>
	<?php get_footer(); ?>