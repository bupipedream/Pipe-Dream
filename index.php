<?php get_header(); ?>
	
	<!-- Get all of content on the homepage -->
	<?php $sections = get_sections(); ?>
		
	<div class="row" id="content">
		<div class="span17">

			<!-- Left and Middle Columns -->
			<div class="row">
				<h1 class="section-heading visuallyhidden">Top Stories</h1>
				
				<!-- Left Column -->
				<div class="left-column span9">
					<section class="pad-left">
						
						<!-- Two Articles -->
						
						<?php foreach( $sections['news']['secondary'] as $key => $article ): ?>
						
						<article class="clearfix">
							
							<header>
								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>
								<div class="meta">By <span class="author"><?= $article['post_author']['name']; ?></span> - <time datetime="<?= date( 'Y-m-j\TH:i:sT', strtotime( $article['post_date'] ) ); ?>" title="<?= date( 'F j, Y \a\t g:i A T', strtotime( $article['post_date'] ) ); ?>"><?= get_time_since( $article['post_date'] ); ?></time></div>
							</header>

							<? if( $article['photo'] ): ?>
								<figure class="figure-left figure-border">
									<a href="<?= get_permalink( $article['ID'] ); ?>">
										<img src="<?= $article['photo']['src']['custom-75x75-crop']; ?>" />
									</a>
								</figure>
							<?php endif; ?>
							
							<p><?= $article['post_excerpt']; ?></p>
						
						</article>

						<?php endforeach; ?>
					
					</section>
				</div>

				<!-- Middle Column -->
				<div class="middle-column span15 last">
					<section>
						<!-- Above-the-Fold Article -->
						<?php foreach( $sections['news']['feature'] as $article ): ?>
							<article>
								
								<figure class="clearfix">
									<a href="<?= get_permalink( $article['ID'] ) ?>">
										<img src="<?= $article['photo']['src']['custom-495']; ?>" />
									</a>
									<figcaption class="meta"><span class="photo-credit"><?= $article['photo']['credit']; ?></span></figcaption>
								</figure>
								
								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>

								<div class="meta">
									<span class="author"><?= $article['post_author']['name']; ?></span> - <time datetime="<?= date( 'Y-m-j\TH:i:sT', strtotime( $article['post_date'] ) ); ?>" title="<?= date( 'F j, Y \a\t g:i A T', strtotime( $article['post_date'] ) ); ?>"><?= get_time_since( $article['post_date'] ); ?></time>
								</div>
								
								<p><?= $article['post_excerpt']; ?></p>
								
								<footer class="article-links">
									<a href="<?= get_permalink( $article['ID'] ); ?>#comments" class="icon icon-comment"><img src="<? bloginfo( 'template_url' ); ?>/img/comment.png" alt="Conversation" /> Comments</a>
								</footer>
								
							</article>
							
						<?php endforeach; ?>
					</section>
				</div>

			</div>
			<div class="row">
				<div class="left-column span9">
					<section id="daily-photo" class="pad-left">

						<h1 class="section-heading"><a href="">Daily Photo</a></h1>
						<article>
							<figure>
								<img src="https://sphotos-a.xx.fbcdn.net/hphotos-ash4/485851_10150795823137420_908715566_n.jpg">
								<figcaption class="meta">
									<time>Jan. 20, 2012</time>
									<span class="photo-credit">Daniel O'Connor</span>
								</figcaption>
							</figure>
						</article>

					</section>

				</div>
				<div class="middle-column span15 last">
					<section>
						
						<!-- Four News Articles -->
						<h1 class="section-heading"><a href="<?= home_url(); ?>/news/">News</a></h1>
						
						<?php foreach( $sections['news']['article-list'] as $index => $article ): ?>
							
							<article>

									<?php if( $index === 0 && isset( $article['photo'] ) ): ?>

										<figure class="figure-right figure-border">
											<a href="<?= get_permalink( $article['ID'] ); ?>">
												<img src="<?= $article['photo']['src']['custom-75x75-crop']; ?>" />
											</a>
										</figure>
									
									<?php endif; ?>

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
			</div>
			<div class="row">
				<section>
					<!-- Two column row of sports -->
					<h1 class="section-heading pad-left"><a href="<?= home_url(); ?>/sports/">Sports</a></h2>
					
					<div class="left-column span9">
						
						<?php foreach( $sections['sports']['feature'] as $article ): ?>
							
							<!-- Featured sports article -->
							<article class="pad-left">
								
								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>

								<p><?= $article['post_excerpt']; ?></p>

							</article>
							
						<?php endforeach; ?>

					</div>
					
					<div class="middle-column span15 last">

						<!-- List of sports articles -->
						<?php foreach( $sections['sports']['article-list'] as $index => $article ): ?>
							
							<article class="clearfix">

									<?php if( $index === 0 && isset( $article['photo'] ) ): ?>

										<figure class="figure-right figure-border">
											<a href="<?= get_permalink( $article['ID'] ); ?>">
												<img src="<?= $article['photo']['src']['custom-75x75-crop']; ?>" />
											</a>
										</figure>
									
									<?php endif; ?>
									
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
				<h1 class="visuallyhidden"><a href="<?= home_url(); ?>/opinion/">Opinion</a></h1>
					
				<!-- Editorial -->
				<section class="left-column span9">
				
					<h2 class="section-heading pad-left"><a href="<?= home_url(); ?>/opinion/editorial/">Editorial</a></h2>

					<?php foreach( $sections['editorial']['feature'] as $article ): ?>
					
						<article class="pad-left">
							
							<?php if( $article['photo'] ): ?>
								<figure>
									<a href="<?= get_permalink( $article['ID'] ); ?>">
										<img src="<?= $article['photo']['src']['single-inline']; ?>" />
									</a>
									<figcaption class="meta"><span class="photo-credit"><?= $article['photo']['credit']; ?></span></figcaption>
								</figure>
							<?php endif; ?>
							
							<h2 class="headline">
								<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
							</h2>

							<p><?= $article['post_excerpt']; ?></p>

							<footer class="article-links">
								<a href="<?= get_permalink( $article['ID'] ); ?>#comments"><img src="<? bloginfo( 'template_url' ); ?>/img/comment.png" alt="Conversation" /> Comments</a>
							</footer>
							 	
						</article>
						
					<?php endforeach; ?>
				</section>

				<!-- Columns -->
				<section class="middle-column span15 last">
					<h2 class="section-heading"><a href="<?= home_url(); ?>/opinion/">Columns</a></h2>
					
					<?php foreach( $sections['opinion']['article-list'] as $article ): ?>
						
						<article class="clearfix">
						
							<?php if( isset( $article['photo']['src'] ) ): ?>
								<figure class="figure-left  figure-border">
									<a href="<?= get_permalink( $article['ID'] ); ?>">
										<img src="<?= $article['photo']['src']['custom-75x75-crop']; ?>" title="<?= $article['post_author']['name']; ?>" />
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
							
							<footer class="article-links">
								<a href="<?= get_permalink( $article['ID'] ); ?>#comments"><img src="<? bloginfo( 'template_url' ); ?>/img/comment.png" alt="Conversation" /> Comments</a>
							</footer>

						</article>
						
					<?php endforeach; ?>
				</section>
			</div>

			<div class="row">
				<section>
					<!-- Two column row of release -->
					<h1 class="section-heading pad-left"><a href="<?= home_url(); ?>/release/">Release</a></h2>
					
					<div class="left-column span9">
						
						<?php foreach( $sections['release']['feature'] as $article ): ?>

							<!-- Featured release article -->
							<article class="pad-left">
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
					
					<div class="middle-column span15 last">

						<!-- List of release articles -->
						<?php foreach( $sections['release']['article-list'] as $index => $article ): ?>
							
							<?php if( $index === 0 && isset( $article['photo'] ) ): ?>

								<figure class="figure-right">
									<a href="<?= get_permalink( $article['ID'] ); ?>">
										<img src="<?= $article['photo']['src']['custom-75x75-crop']; ?>" />
									</a>
								</figure>
							
							<?php endif; ?>

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