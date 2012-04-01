<?php get_header(); ?>
	<div class="row" id="content">
		<div class="span17" itemscope itemtype="http://schema.org/Person">

			<!-- Get information about the current author -->
			<?php 
				$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); 				
				global $wpdb;
				$post_count = $wpdb->get_var( "SELECT COUNT(*) FROM `pd_posts` WHERE `post_author` = $curauth->ID AND `post_status` = 'publish' AND `post_type` = 'post'" );
			?>
			
			<h2 id="name" itemprop="name"><?php echo $curauth->display_name; ?></h2>
			<section id="profile" class="clearfix doublehrule">

				<figure><img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim("$curauth->user_email"))); ?>?s=75&d=mm" itemprop="image" /></figure>

				<ul id="info">
					<li id="title" itemprop="jobTitle"><?php echo $curauth->position; ?></li>
					<li id="major"><?php if($curauth->year && $curauth->major) echo $curauth->year.", ".$curauth->major; ?></li>
					<li id="phone">
						<!-- display office number -->
						<a href="tel:<?php echo $curauth->phone_office; ?>" title="Call <?php echo $curauth->display_name; ?>" itemprop="telephone"><?php echo $curauth->phone_office; ?></a>
					</li>
					<li id="email">
						<a href="mailto:<?php echo $curauth->user_email; ?>" title="Email <?php echo $curauth->display_name; ?>" itemprop="email"><?php echo $curauth->user_email; ?></a>
					</li>
				</ul>
			</section>
			
			<div class="alert">
				<p><span class="heading">Notice:</span> Author pages are a work in progress. If articles are missing, please email <a href="mailto:developer@bupipedream.com">developer@bupipedream.com</a></p>
			</div>
						
			<section id="posts">
				<h2 class="section-label"><?php echo $post_count.' Article'.($post_count != 1 ? 's' : ''); ?></h2>
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
														
					<article class="clearfix">

						<!-- Grab all of the photos associated with article. -->
						<?php $photo = get_photos(get_the_ID(), '1', array('thumbnail')); ?>
						
						<?php if($photo): ?>
							<figure><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php echo $photo['src']['thumbnail']; ?>" /></a></figure>
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