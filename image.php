<?php get_header(); ?>
	<!-- Image Attachment -->
	<div class="content row">
		<div class="span17">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/NewsArticle">
			
				<p class="published">
					<time datetime="<?php the_time('Y-m-j\Th:i'); ?>" itemprop="datePublished"><?php the_time('F j, Y'); ?></time>
					<meta itemprop="dateModified" content="<?php the_modified_time('Y-m-j\Th:i'); ?>" />
				</p>
				
				<h2 itemprop="headline"><?php the_title(); ?><small>(from <a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a>)</small></h2>
			
				<div id="meta">
					<div id="social">
						<fb:like href="https://www.facebook.com/BUPipeDream" send="false" layout="button_count" width="100" show_faces="false" action="recommend" font="arial"></fb:like>
					</div>
					<p class="byline" itemprop="author" itemscope itemtype="http://schema.org/Person">
						<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" itemprop="url">More photos by <span itemprop="name"><?php the_author(); ?></span></a>
					</p>
				</div>
				<section itemprop="articleBody">
				
					<?php // grab all of the photos to display in the right place.
						$photos = get_photos(get_the_ID(), 1);
					?>
					
					<?php 
						$width = wp_get_attachment_image_src( $post->ID, 'medium' ); 
						$width = $width[1];
					?>
					
					<figure id="attachment" style="width: <?php echo $width; ?>px;">
						<a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a>
						<figcaption>
							<p class="credit"><?php echo get_post_meta($post->ID, '_credit', 'single'); ?></p>
							<p><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></p>
						</figcaption>
					</figure>
					
				
					
					<!-- <figure id="lead">
						<a href="http://i.imgur.com/UDULd.jpg" title="BU President C. Peter Magrath speaks at a press conference on Oct. 20, 2011 about a $1 million grant the Academy for Korean Studies gave to BU. (Daniel O'Connor/Photo Editor)"><img src="http://i.imgur.com/UDULd.jpg" /></a>
						<figcaption>
							<p class="credit">Daniel O'Connor/Photo Editor</p>
							<p>BU President C. Peter Magrath speaks at a press conference on Oct. 20, 2011 about a $1 million grant the Academy for Korean Studies gave to BU.</p>
						</figcaption>
					</figure> -->
					
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
			    	<p>Sorry, but the requested resource was not found on this site.</p>
			    </section>
			    <footer>
			    </footer>
			</article>
			
			<?php endif; ?>

		</div>
		<div id="rightcol" class="span7 last">
			<!-- Right Column -->
			<section class="ad">
				<img src="http://i.imgur.com/Jb9oR.png" />
			</section>
			<section id="latest-news">
				<h2 class="section-label"><a href="#">Latest News &raquo;</a></h2>
				<ol>
					<li>
						<h3><a href="#">Magrath to retire after century career in higher education</a></h3>
						<p>&mdash; C. Peter Magrath will retire from Binghamton University on Dec. 31 this year at the age of 78, capping a 50-year career in higher education that he began as a political science instructor at Brown University in 1961.</p>
					</li>
					<li>
						<h3><a href="#">Long-awaited East Gym to reopen in January</a></h3>
						<p>&mdash; After a $13.5 million renovation, the East Gym is set to reopen by the start of next semester. The East Gym will be open and available for students and faculty starting at 9 a.m. on Saturday, Jan. 28.</p>
					</li>
					<li>
						<h3><a href="#">Snack foods sustain students while studying</a></h3>
						<p>&mdash; Few students give much thought to things like food or sleep, other than what is minimally needed to sustain them through several days of cramming.</p>
					</li>
					<li>
						<h3><a href="#">University confirms plan to cull campus deer</a></h3>
						<p>&mdash; A large percentage of the Nature Preserve's deer population will be selectively killed over winter break, from Dec. 20 to Jan. 20.</p>
					</li>
					<li>
						<h3><a href="#">Facebook group cuts middleman out of BU textbook sales</a></h3>
						<p>&mdash; Binghamton University students have designed an alternative to posting flyers on campus or visiting the University Bookstore to sell back their old textbooks.</p>
					</li>
				</ol>
			</section>
		</div>
	</div>
	<?php get_footer(); ?>