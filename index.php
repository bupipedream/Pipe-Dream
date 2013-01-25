<?php get_header(); ?>
	
	<!-- Get all of content on the homepage -->
	<?php $sections = get_sections(); ?>
		
	<div class="row" id="content">
		<div class="span17">

			<!-- Left and Middle Columns -->
			<div class="row">
				<h1 class="section-heading visuallyhidden">Top Stories</h1>
				
				<!-- Left Column / News & Editorial -->
				<div class="span9">
					
					<!-- Two News Articles -->
					<section>
						
						<?php foreach( $sections['news']['secondary'] as $key => $article ): ?>
						
						<article>
							<header>
								<h2 class="headline">
									<a href="<?= get_permalink($article['ID']) ?>"><?php echo $article['post_title']; ?></a>
								</h2>
								<div class="meta">By <span class="author"><?= $article['post_author']['name']; ?></span> - <time datetime="<?= date( 'Y-m-j\TH:i:sT', strtotime( $article['post_date'] ) ); ?>" title="<?= date( 'F j, Y \a\t g:i A T', strtotime( $article['post_date'] ) ); ?>"><?= get_time_since( $article['post_date'] ); ?></time></div>
							</header>
							<? if( $article['photo'] ): ?>
								<figure>
									<a href="<?= get_permalink( $article['ID'] ); ?>">
										<img src="<?= $article['photo']['src']['custom-75x75-crop']; ?>" />
									</a>
								</figure>
							<?php endif; ?>
							<p><?= $article['post_excerpt']; ?></p>

							<footer>
								<a href="<?= get_permalink( $article['ID'] ); ?>#comments"><img src="<? bloginfo( 'template_url' ); ?>/img/comment.png" alt="Conversation" /> Comments</a>
							</footer>
						</article>

						<?php endforeach; ?>
					
					</section>
					
				</div>
				<div class="span15 last">
					
					<!-- Middle Column -->
					<section>
						<!-- Above-the-Fold Article -->
						<?php foreach( $sections['news']['feature'] as $article ): ?>
							<article>
								
								<figure>
									<a href="<?= get_permalink( $article['ID'] ) ?>">
										<img src="<?= $article['photo']['src']['custom-495']; ?>" />
									</a>
									<figcaption><?= $article['photo']['credit']; ?></figcaption>
								</figure>
								
								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>

								<div class="meta"><span class="author"><?= $article['post_author']['name']; ?></span> - <time datetime="<?= date( 'Y-m-j\TH:i:sT', strtotime( $article['post_date'] ) ); ?>" title="<?= date( 'F j, Y \a\t g:i A T', strtotime( $article['post_date'] ) ); ?>"><?= get_time_since( $article['post_date'] ); ?></time></p>
								
								<p><?= $article['post_excerpt']; ?></p>
								
								<footer>
									<a href="<?= get_permalink( $article['ID'] ); ?>#comments"><img src="<? bloginfo( 'template_url' ); ?>/img/comment.png" alt="Conversation" /> Comments</a>
								</footer>
								
							</article>
							
						<?php endforeach; ?>
					</section>
				</div>
			</div>
			<div class="row">
				<section class="span9">

					<h1 class="section-heading"><a href="">Daily Photo</a></h1>
					<figure>
						<img src="https://sphotos-a.xx.fbcdn.net/hphotos-ash4/485851_10150795823137420_908715566_n.jpg">
						<time>Jan. 20, 2012</time>
						<figcredit>Daniel O'Connor</figcredit>
					</figure>

				</section>
				<section class="span15 last">
					
					<!-- Four News Articles -->
					<h1 class="section-heading"><a href="<?= home_url(); ?>/news/">News</a></h1>
					
					<?php foreach( $sections['news']['article-list'] as $index => $article ): ?>
						
						<article>

								<h2 class="headline <?= ($index === 0) ? 'faded' : '' ?>">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>
								<? if($index === 0): ?>
									<p><?= $article['post_excerpt']; ?></p>
								<? endif; ?>
							
						</article>
						
					<?php endforeach; ?>
					
				</section>

			</div>
			<div class="row">
				<section>
					<!-- Two column row of sports -->
					<h1 class="section-heading"><a href="<?= home_url(); ?>/sports/">Sports</a></h2>
					
					<div class="span9">
						
						<?php foreach( $sections['sports']['feature'] as $article ): ?>
							
							<!-- Featured sports article -->
							<article>
								
								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>

								<p><?= $article['post_excerpt']; ?></p>

							</article>
							
						<?php endforeach; ?>
					</div>
					
					<div class="span15 last">

						<!-- List of sports articles -->
						<?php foreach( $sections['sports']['article-list'] as $index => $article ): ?>
							
							<article>

									<h2 class="headline <?= ($index === 0) ? 'faded' : '' ?>">
										<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
									</h2>
									<? if($index === 0): ?>
										<p><?= $article['post_excerpt']; ?></p>
									<? endif; ?>
								
							</article>
							
						<?php endforeach; ?>

					</div>
				</section>
			</div>

			<div class="row">
				<!-- Opinion -->
				<h1 class="section-heading"><a href="<?= home_url(); ?>/opinion/">Opinion</a></h1>
					
					<!-- Editorial -->
					<section class="span9">
					
						<h2 class="section-heading"><a href="<?= home_url(); ?>/opinion/editorial/">Editorial</a></h2>

						<?php foreach($sections['editorial']['feature'] as $article): ?>
						
							<article>
								
								<?php if( $article['photo'] ): ?>
									<figure>
										<a href="<?= get_permalink( $article['ID'] ); ?>">
											<img src="<?= $article['photo']['src']['single-inline']; ?>" />
										</a>
										<figcaption><?= $article['photo']['credit']; ?></figcaption>
									</figure>
								<?php endif; ?>
								
								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>

								<p><?= $article['post_excerpt']; ?></p>

								<footer>
									<a href="<?= get_permalink( $article['ID'] ); ?>#comments"><img src="<? bloginfo( 'template_url' ); ?>/img/comment.png" alt="Conversation" /> Comments</a>
								</footer>
								 	
							</article>
							
						<?php endforeach; ?>
					</section>

					<!-- Columns -->
					<section class="span15 last">
						<h2 class="section-heading"><a href="<?= home_url(); ?>/opinion/">Columns</a></h2>
						
						<?php foreach( $sections['opinion']['article-list'] as $article ): ?>
							
							<article>
							
								<?php if( isset( $article['photo']['src'] ) ): ?>
									<figure>
										<a href="<?= get_permalink( $article['ID'] ); ?>">
											<img src="<?= $article['photo']['src']['thumbnail']; ?>" title="<?= $article['post_author']['name']; ?>" />
										</a>
									</figure>
								<?php endif; ?>
								
								<h2 class="headline">
									<a href="<?= get_permalink($article['ID']); ?>">
										<?= $article['post_title']; ?>
									</a>
								</h2>
								
								<p>
									<?= $article['post_excerpt'] ? $article['post_excerpt'] : get_custom_excerpt( $article['post_content'], '50' ); ?>
								</p>
								
								<footer>
									<a href="<?= get_permalink( $article['ID'] ); ?>#comments"><img src="<? bloginfo( 'template_url' ); ?>/img/comment.png" alt="Conversation" /> Comments</a>
								</footer>

							</article>
							
						<?php endforeach; ?>
					</section>
			</div>

			<div class="row">
				<section>
					<!-- Two column row of release -->
					<h1 class="section-heading"><a href="<?= home_url(); ?>/release/">Release</a></h2>
					
					<div class="span9">
						
						<?php foreach( $sections['release']['feature'] as $article ): ?>

							<!-- Featured release article -->
							<article>
								<?php if( isset( $article['photo']['src'] ) ): ?>
									<figure>
										<a href="<?= get_permalink( $article['ID'] ); ?>">
											<img src="<?= $article['photo']['src']['single-inline']; ?>" title="<?= $article['post_author']['name']; ?>" />
										</a>
									</figure>
								<?php endif; ?>
								
								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>

								<p><?= $article['post_excerpt']; ?></p>

							</article>
							
						<?php endforeach; ?>
					</div>
					
					<div class="span15 last">

						<!-- List of release articles -->
						<?php foreach( $sections['release']['article-list'] as $index => $article ): ?>
							
							<article>

								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>
								<p><?= $article['post_excerpt']; ?></p>
								
							</article>
							
						<?php endforeach; ?>

					</div>
				</section>
			</div>

		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>