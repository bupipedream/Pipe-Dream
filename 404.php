<?php get_header(); ?>
	<div class="content row">
		<article class="pad-left pad-right">
			<h2 class="headline">Whoops! Page not found...</h2>
			<figure id="four-oh-four-art">
				<img src="<? bloginfo('template_url'); ?>/img/404art.png">
			</figure>
			<p>Here are some popular articles you may wish to check out:</p>
			<ol>
				<?php
					$posts = wmp_get_popular( array( 'limit' => 5, 'post_type' => 'post', 'range' => 'weekly' ) );
					if ( count( $posts ) > 0 ): foreach ( $posts as $post ):
						setup_postdata( $post );
				?>
					<li>
						<article>
							<h2 class="headline">
								<a href="<? the_permalink() ?>" title="<?= esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
									<?php if ( get_the_title() ) the_title(); else the_ID(); ?>
								</a>
							</h2>
							<? the_excerpt() ?>
						</article>
					</li>
				<?php endforeach; endif; ?>
			</ol>
		</article>
	</div>
	<?php get_footer(); ?>