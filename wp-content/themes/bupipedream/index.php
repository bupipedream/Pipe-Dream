<?php get_header(); ?>
	
	<!-- Get all of content on the homepage -->
	<?php $sections = pd_get_homepage(); ?>
		
	<div class="content row">
		<div data-column="left-two-columns" class="span17">

			<!-- Left and Middle Columns -->
			<div class="row grid-row">
				<h1 class="section-heading visuallyhidden">Top Stories</h1>
				
				<!-- Left Column -->
				<div data-column="left-column" class="span9">
					<section id="atf-list" class="pad-left pad-right">
						
						<!-- Two Articles -->
						
						<?php foreach( $sections['feature']['article-list'] as $key => $article ): ?>
						
						<article class="clearfix">
							
							<header>
								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>
								<div class="meta">By <span class="author"><?= $article['post_author']['name']; ?></span> - <time datetime="<?= date( 'Y-m-j\TH:i:sT', strtotime( $article['post_date'] ) ); ?>" title="<?= date( 'F j, Y \a\t g:i A T', strtotime( $article['post_date'] ) ); ?>"><?= get_time_since( $article['post_date'] ); ?></time></div>
							</header>

							<? if( isset( $article['photo']['src'] ) ): ?>
								<figure class="figure-left figure-border">
									<a href="<?= get_permalink( $article['ID'] ); ?>">
										<img src="<?= $article['photo']['src']['custom-75x75-crop']; ?>" />
									</a>
								</figure>
							<?php endif; ?>
							
							<p class="excerpt"><?= $article['post_excerpt'] ? $article['post_excerpt'] : get_custom_excerpt( $article['post_content'], 16 ); ?></p>
						
						</article>

						<?php endforeach; ?>
					
					</section>
				</div>

				<!-- Middle Column -->
				<div data-column="middle-column" class="span15 last">
					<section id="atf-feature">
						<!-- Above-the-Fold Article -->
						<?php foreach( $sections['feature']['feature'] as $article ): ?>
							<article class="home-feature">
								
								<figure class="clearfix">
									<a href="<?= get_permalink( $article['ID'] ) ?>">
										<img src="<?= $article['photo']['src']['custom-495']; ?>" />
									</a>
									<figcaption>
										<span class="photo-credit"><?= $article['photo']['credit']; ?></span>
									</figcaption>
								</figure>
								
								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>

								<div class="meta">
									<span class="author"><?= $article['post_author']['name']; ?></span> - <time datetime="<?= date( 'Y-m-j\TH:i:sT', strtotime( $article['post_date'] ) ); ?>" title="<?= date( 'F j, Y \a\t g:i A T', strtotime( $article['post_date'] ) ); ?>"><?= get_time_since( $article['post_date'] ); ?></time>
								</div>
								
								<p class="excerpt"><?= $article['post_excerpt'] ? $article['post_excerpt'] : get_custom_excerpt( $article['post_content'], 20 ); ?></p>
								
								<footer class="article-links">
									<a href="<?= get_permalink( $article['ID'] ); ?>#comments" class="icon icon-comment"><img src="<? bloginfo( 'template_url' ); ?>/img/comment.png" alt="Conversation" /> Comments</a>
								</footer>
								
							</article>
							
						<?php endforeach; ?>
					</section>
				</div>

			</div>
<div class="ad" id="news-banner">
	<!-- /106249879/news_banner -->
	<div id='div-gpt-ad-1455314561803-0'>
	<script type='text/javascript'>
	googletag.cmd.push(function() { googletag.display('div-gpt-ad-1455314561803-0'); });
	</script>
	</div>
</div>
			<div class="row grid-row">
				<div data-column="left-column" class="span9">
					<section id="daily-photo" class="pad-left pad-right">

						<h1 class="section-heading">
							<a href="<?= home_url(); ?>/multimedia/">Multimedia</a>
						</h1>

						<?php foreach( $sections['multimedia']['feature'] as $index => $article ): ?>
							<article>
								<figure>
									<a href="<?= get_permalink( $article['ID'] ); ?>"><img src="<?= $article['photo']['src']['single-inline'] ?>"></a>
									<figcaption>
										<time class="photo-date" datetime="<?= date( 'Y-m-j\TH:i:sT', strtotime( $article['post_date'] ) ); ?>" title="<?= date( 'F j, Y \a\t g:i A T', strtotime( $article['post_date'] ) ); ?>">
											<?= date( 'M. m, Y', strtotime( $article['post_date'] ) ); ?>
										</time>
										<span class="photo-credit"><?= $article['post_author']['name']; ?></span>
									</figcaption>
								</figure>
							</article>
						<?php endforeach; ?>


					</section>

				</div>
				<div data-column="middle-column" class="span15 last">
					<section id="news-list" class="article-list pad-right">
						
						<!-- Four News Articles -->
						<h1 class="section-heading"><a href="<?= home_url(); ?>/news/">News</a></h1>
						
						<?php foreach( $sections['news']['article-list'] as $index => $article ): ?>
							
							<article class="<?= ($index !== 0) ? 'faded' : '' ?>">

									<?php if( $index === 0 && isset( $article['photo']['src'] ) ): ?>

										<figure class="figure-right figure-border">
											<a href="<?= get_permalink( $article['ID'] ); ?>">
												<img src="<?= $article['photo']['src']['custom-75x75-crop']; ?>" />
											</a>
										</figure>
									
									<?php endif; ?>

									<h2 class="headline">
										<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
									</h2>

									<? if($index === 0): ?>
										<p class="excerpt"><?= $article['post_excerpt']; ?></p>
									<? endif; ?>
								
							</article>
							
						<?php endforeach; ?>
						
					</section>
				</div>
			</div>
			<div class="row grid-row">
				<section>
					<!-- Two column row of sports -->
					<h1 class="section-heading pad-left pad-right"><a href="<?= home_url(); ?>/sports/">Sports</a></h2>

					<div id="sports-feature" data-column="left-column" class="span9">
						<?php foreach( $sections['sports']['feature'] as $article ): ?>

							<!-- Featured sports article -->
							<article class="pad-left pad-right text-teaser">
								
								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>

								<p class="excerpt"><?= $article['post_excerpt'] ? $article['post_excerpt'] : get_custom_excerpt( $article['post_content'], 16 ); ?></p>

							</article>
							
						<?php endforeach; ?>
						
					</div>
					
					<div data-column="middle-column" class="span15 last">
						<div id="sports-list" class="article-list pad-right">

							<!-- List of sports articles -->
							<?php foreach( $sections['sports']['article-list'] as $index => $article ): ?>
								
								<article class="clearfix <?= ($index !== 0) ? 'faded' : '' ?>">

										<?php if( $index === 0 && isset( $article['photo']['src'] ) ): ?>

											<figure class="figure-right figure-border">
												<a href="<?= get_permalink( $article['ID'] ); ?>">
													<img src="<?= $article['photo']['src']['custom-75x75-crop']; ?>" />
												</a>
											</figure>
										
										<?php endif; ?>
										
										<h2 class="headline">
											<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
										</h2>

										<? if($index === 0): ?>
											<p class="excerpt"><?= $article['post_excerpt'] ? $article['post_excerpt'] : get_custom_excerpt( $article['post_content'], 16 ); ?></p>
										<? endif; ?>
									
								</article>
								
							<?php endforeach; ?>

						</div>
					</div>
				</section>
			</div>

			<div class="row grid-row">
				<!-- Opinion -->
				<h1 class="visuallyhidden"><a href="<?= home_url(); ?>/opinion/">Opinion</a></h1>
					
				<!-- Editorial -->
				<section id="editorial" data-column="left-column" class="span9">
				
					<h2 class="section-heading pad-left pad-right"><a href="<?= home_url(); ?>/opinion/editorial/">Editorial</a></h2>

					<?php foreach( $sections['editorial']['feature'] as $article ): ?>
					
						<article class="home-feature pad-left pad-right <?= ( !isset( $article['photo']['src'] ) ) ? 'text-teaser' :''?>">
							
							<?php if( $article['photo'] ): ?>
								<figure class="clearfix">
									<a href="<?= get_permalink( $article['ID'] ); ?>">
										<img src="<?= $article['photo']['src']['single-inline']; ?>" />
									</a>
									<figcaption>
										<span class="photo-credit"><?= $article['photo']['credit']; ?></span>
									</figcaption>
								</figure>
							<?php endif; ?>
							
							<h2 class="headline">
								<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
							</h2>

							<p class="excerpt"><?= $article['post_excerpt']; ?></p>

							<footer class="article-links">
								<a href="<?= get_permalink( $article['ID'] ); ?>#comments"><img src="<? bloginfo( 'template_url' ); ?>/img/comment.png" alt="Conversation" /> Comments</a>
							</footer>
							 	
						</article>
						
					<?php endforeach; ?>
				</section>

				<!-- Columns -->
				<section data-column="middle-column" class="span15 last">
					<div id="opinion-list" class="article-list pad-right">
						<h2 class="section-heading"><a href="<?= home_url(); ?>/opinion/">Columns</a></h2>
						
						<?php foreach( $sections['opinion']['article-list'] as $article ): ?>
							
							<article class="clearfix">
							
								<?php if( isset( $article['photo']['src'] ) ): ?>
									<figure class="figure-right figure-border">
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
								
								<p class="excerpt">
									<?= $article['post_excerpt'] ? $article['post_excerpt'] : get_custom_excerpt( $article['post_content'], 20 ); ?>
								</p>
								
								<footer class="article-links">
									<a href="<?= get_permalink( $article['ID'] ); ?>#comments"><img src="<? bloginfo( 'template_url' ); ?>/img/comment.png" alt="Conversation" /> Comments</a>
								</footer>

							</article>
							
						<?php endforeach; ?>
					</div>
				</section>
			</div>

			<div id="row-release" class="row">
				<section>
					<!-- Two column row of release -->
					<h1 class="section-heading pad-left"><a href="<?= home_url(); ?>/release/">Release</a></h2>
					
					<div id="release-feature" data-column="left-column" class="span9">
						
						<?php foreach( $sections['release']['feature'] as $article ): ?>

							<!-- Featured release article -->
							<article class="pad-left pad-right text-teaser">

								<h2 class="headline">
									<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
								</h2>

								<p class="excerpt"><?= $article['post_excerpt'] ? $article['post_excerpt'] : get_custom_excerpt( $article['post_content'], 16 ); ?></p>

							</article>
							
						<?php endforeach; ?>
					</div>
					
					<div data-column="middle-column" class="span15 last">
						<div id="release-list" class="article-list pad-right">
							<!-- List of release articles -->
							<?php foreach( $sections['release']['article-list'] as $index => $article ): ?>
								
								<article class="clearfix <?= ($index !== 0) ? 'faded' : '' ?>">

										<?php if( $index === 0 && isset( $article['photo']['src'] ) ): ?>

											<figure class="figure-right figure-border">
												<a href="<?= get_permalink( $article['ID'] ); ?>">
													<img src="<?= $article['photo']['src']['custom-75x75-crop']; ?>">
												</a>
											</figure>
										
										<?php endif; ?>
										
										<h2 class="headline">
											<a href="<?= get_permalink( $article['ID'] ) ?>"><?= $article['post_title']; ?></a>
										</h2>

										<? if($index === 0): ?>
											<p class="excerpt"><?= $article['post_excerpt'] ? $article['post_excerpt'] : get_custom_excerpt( $article['post_content'], 16 ); ?></p>
										<? endif; ?>
									
								</article>
								
							<?php endforeach; ?>
						</div>
					</div>
				</section>
			</div>

		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>
