<?php get_header(); ?>
	
	<!-- Get all of content on the homepage -->
	<?php $sections = get_sections(); ?>
	<?php
		$options = get_option('pd_theme_options');
		$stabilizing = $options['stabilizing'];
		$destabilizing = $options['destabilizing'];
		$message = $options['message'];
		$time = $options['time'];
		$theme = $options['theme'];
		$label = $options['label'];
		$notice_status = $options['radioinput'];
	?>
	
	<?php if($notice_status): ?>
		<div class="row <?php echo $theme; ?>">
			<?php // twitterApiCall(); ?>
			<?php if($theme === 'message'): ?>
				<div class="fb-like" data-href="http://facebook.com/bupipedream" data-send="false" data-layout="button_count" data-width="50" data-show-faces="false"></div>
			<?php endif; ?>
			<p><span><?php echo $label; ?> <?php if($time): ?><time><?php echo $time; ?></time><?php endif; ?></span> <?php echo $message; ?></p>
		</div>
	<?php endif; ?>
	
	<div class="row" id="content">
		<div class="span17">
			
			<?if(isset($sections['feature']['concert'][0])):?>
				
				<?$article = $sections['feature']['concert'][0];?>
				<div id="feature-concert" class="doublehrule">
					<div id="concert-like" class="fb-like" data-href="<?=get_permalink($article['ID']) ?>" data-send="false" data-layout="box_count" data-width="200" data-show-faces="true"></div>
					<h2><a href="<?=get_permalink($article['ID']) ?>"><?=$article['post_title']?></a></h2>
					<p class="deck"><?=get_post_meta($article['ID'], '_pd_article_deck_text', true);?></p>
					<figure class="right">
						<a href="<?=get_permalink($article['ID']) ?>">
							<img src="<?=$article['photo']['src']['medium']?>" />
						</a>
						<figcaption><p><?=$article['photo']['credit']?></p></figcaption>
					</figure>
					<p>
				</div>
			
			<?endif?>
			
			<!-- Left and Middle Columns -->
			<div class="row thickhrule">
				<!-- Left Column / News & Editorial -->
				<div id="leftcol" class="span9">
					<!-- Two News Articles -->
					<section id="news-secondary" class="news">
						<h2 class="section-label"><a href="<?php echo home_url(); ?>/news/">News &raquo;</a></h2>
						
						<?php foreach($sections['news']['secondary'] as $key => $article): ?>
						
						<article class="<?php if($key === 1) echo 'doublehrule' ?> clearfix">
							
							<h2><a href="<?php echo get_permalink($article['ID']) ?>"><?php echo $article['post_title']; ?></a></h2>
							<p class="byline below">By <span><?php echo $article['post_author']['name']; ?></span> - <time datetime="<?php echo date('Y-m-j\TH:i:sT', strtotime($article['post_date'])); ?>" title="<?php echo date('F j, Y \a\t g:i A T', strtotime($article['post_date'])); ?>"><?php echo get_time_since($article['post_date']); ?></time></p>
							
							<?php if($article['photo']): ?>
								<figure class="float-left">
									<a href="<?php echo get_permalink($article['ID']) ?>">
										<img src="<?php echo $article['photo']['src']['custom-75x75-crop']; ?>" />
									</a>
								</figure>
							<?php endif; ?>
							<p><?php echo $article['post_excerpt']; ?></p>
							
						</article>
						
						<?php endforeach; ?>
					</section>
					<!-- Staff Editorial -->
					<section id="editorial" class="editorial">
						<h2 class="section-label"><a href="<?php echo home_url(); ?>/opinion/">Editorial &raquo;<br /><span class="sub-label">Staff Editorial</span></a></h2>
						
						<?php foreach($sections['editorial']['feature'] as $article): ?>
						
						<article>
							
							<?php if($article['photo']): ?>
								<figure class="center">
									<a href="<?php echo get_permalink($article['ID']) ?>">
										<img src="<?php echo $article['photo']['src']['single-inline']; ?>" />
									</a>
									<figcaption><p><?php echo $article['photo']['credit']; ?></p></figcaption>
								</figure>
							<?php endif; ?>
							
							<h2><a href="<?php echo get_permalink($article['ID']) ?>"><?php echo $article['post_title']; ?></a></h2>
							<p><?php echo $article['post_excerpt']; ?></p>
							<p class="byline"><time datetime="<?php echo date('Y-m-j\TH:i:sT', strtotime($article['post_date'])); ?>" title="<?php echo date('F j, Y \a\t g:i A T', strtotime($article['post_date'])); ?>"><?php echo get_time_since($article['post_date']); ?></time></p>
							
							<ul class="article-links clearfix">
								<li><a href="<?php echo get_permalink($article['ID']) ?>#comments" class="comments-label" title="Responses to &quot;<?php echo esc_attr($article['post_title']); ?>&quot;">Comments</a></li>
							</ul>
							
						</article>
						
						<?php endforeach; ?>
						
					</section>
				</div>
				<div id="middlecol" class="span15 last">
					<!-- Middle Column -->
					<section id="news-feature" class="news">
						<!-- Above-the-Fold Article -->
						
						<?php foreach($sections['news']['feature'] as $article): ?>
							<article class="feature clearfix">
								
								<figure class="center">
									<a href="<?php echo get_permalink($article['ID']) ?>">
										<img src="<?php echo $article['photo']['src']['custom-495']; ?>" />
									</a>
									<figcaption><p><?php echo $article['photo']['credit']; ?></p></figcaption>
								</figure>
								
								<h2><a href="<?php echo get_permalink($article['ID']) ?>"><?php echo $article['post_title']; ?></a></h2>
								<p class="byline below"><p class="byline below"><span><?php echo $article['post_author']['name']; ?></span> - <time datetime="<?php echo date('Y-m-j\TH:i:sT', strtotime($article['post_date'])); ?>" title="<?php echo date('F j, Y \a\t g:i A T', strtotime($article['post_date'])); ?>"><?php echo get_time_since($article['post_date']); ?></time></p>
								<p><?php echo $article['post_excerpt']; ?></p>
								
								<ul class="article-links">
									<li><a href="<?php echo get_permalink($article['ID']) ?>/#comments" class="comments-label" title="Responses to &quot;<?php echo esc_attr($article['post_title']); ?>&quot;">Comments</a></li>
								</ul>
								
							</article>
							
						<?php endforeach; ?>
					</section>
					<section id="news-list" class="news">
						<!-- Three News Articles -->
						
						<?php foreach($sections['news']['article-list'] as $article): ?>
							
							<article>
								
								<p class="byline above"><span><?php echo $article['post_author']['name']; ?></span></p>
								<h2><a href="<?php echo get_permalink($article['ID']) ?>"><?php echo $article['post_title']; ?></a></h2>
								<p><?php echo $article['post_excerpt']; ?></p>
								
							</article>
							
						<?php endforeach; ?>
						
					</section>
				</div>
			</div>
			<div class="row">
				<section class="sports clearfix">
					<!-- Two column row of sports -->
					<h2 class="section-label"><a href="<?php echo home_url(); ?>/sports/">Sports &raquo;</a></h2>
					<div class="span13">
						
						<?php foreach($sections['sports']['feature'] as $article): ?>
							
							<!-- Featured sports article -->
							<article id="sports-feature" class="feature">
								<?php if(isset($article['photo']['src']['custom-165'])):?>
									<figure class="float-left">
										<a href="<?php echo get_permalink($article['ID']) ?>">
											<img src="<?php echo $article['photo']['src']['custom-165']; ?>" />
										</a>
									</figure>
								<? endif; ?>
								<!-- TODO: Use custom fields to display the score -->
								
								<!-- <span class="score"></span> -->
								<h2><a href="<?php echo get_permalink($article['ID']) ?>"><?php echo $article['post_title']; ?></a></h2>
								<p><?php echo $article['post_excerpt']; ?> &mdash; <time datetime="<?php echo date('Y-m-j\TH:i:sT', strtotime($article['post_date'])); ?>" title="<?php echo date('F j, Y \a\t g:i A T', strtotime($article['post_date'])); ?>"><?php echo get_time_since($article['post_date']); ?></time></p>
								
								<ul class="article-links">
									<li><a href="<?php echo get_permalink($article['ID']) ?>/#comments" class="comments-label" title="Responses to &quot;<?php echo esc_attr($article['post_title']); ?>&quot;">Comments</a></li>
								</ul>
								
							</article>
							
						<?php endforeach; ?>

						
					</div>
					<div class="span11 last">
						
						<!-- List of sports articles -->
						<ul id="sports-list" class="article-list">
							<?php foreach($sections['sports']['article-list'] as $article): ?>
							
								<li><h2><a href="<?php echo get_permalink($article['ID']) ?>"><?php echo $article['post_title']; ?></a></h2></li>
							
							<?php endforeach; ?>
						</ul>
					</div>
				</section>
			</div>
			<div class="row">
				
				<!-- Row of Release and Opinion columns -->
				<div id="release-container" class="span9">
					
					<!-- Release -->
					<section class="release">
						<h2 class="section-label"><a href="<?php echo home_url(); ?>/release/">Release &raquo;</a></h2>
						
						<?php foreach($sections['release']['feature'] as $article): ?>
							
							<article id="release-feature" class="feature clearfix">
								
								<h2><a href="<?php echo get_permalink($article['ID']) ?>"><?php echo $article['post_title']; ?></a></h2>
								
								<p class="byline below">By <?php echo $article['post_author']['name']; ?> - <time datetime="<?php echo date('Y-m-j\TH:i:sT', strtotime($article['post_date'])); ?>" title="<?php echo date('F j, Y \a\t g:i A T', strtotime($article['post_date'])); ?>"><?php echo get_time_since($article['post_date']); ?></time></p>
																
								<figure class="center">
									<a href="<?php echo get_permalink($article['ID']) ?>">
										<img src="<?php echo $article['photo']['src']['custom-260']; ?>" />
									</a>
									<figcaption><p><?php echo $article['photo']['credit']; ?></p></figcaption>
								</figure>
								
								<p><?php echo $article['post_excerpt']; ?></p>
								
								<ul class="article-links">
									<li><a href="<?php echo get_permalink($article['ID']) ?>/#comments" class="comments-label" title="Responses to &quot;<?php echo esc_attr($article['post_title']); ?>&quot;">Comments</a></li>
								</ul>
								
							</article>
							
						<?php endforeach; ?>
						
						<ul id="release-list" class="article-list">
							
							<?php foreach($sections['release']['article-list'] as $article): ?>
							
							<li><h2><a href="<?php echo get_permalink($article['ID']) ?>"><?php echo $article['post_title']; ?></a><time datetime="<?php echo date('Y-m-j\TH:i:sT', strtotime($article['post_date'])); ?>" title="<?php echo date('F j, Y \a\t g:i A T', strtotime($article['post_date'])); ?>"><?php echo get_time_since($article['post_date']); ?></time></h2></li>
							
							<?php endforeach; ?>
							
						</ul>
					</section>
				</div>
				<div id="opinion-container" class="span15 last">
					
					<!-- Opinion -->
					<section id="opinion-list" class="opinion">
						
						<h2 class="section-label"><a href="<?php echo home_url(); ?>/opinion/">Opinion &raquo;</a></h2>
						
						<?php foreach($sections['opinion']['article-list'] as $article): ?>
							
							<article class="clearfix">
							
							<?php if(isset($article['photo']['src'])): ?>
								<figure class="float-right thin-border">
									<a href="<?php echo get_permalink($article['ID']) ?>">
										<img src="<?php echo $article['photo']['src']['thumbnail']; ?>" title="<?php echo $article['post_author']['name']; ?>"width="75px" />
									</a>
								</figure>
								<?php endif; ?>
								
								<h2><a href="<?php echo get_permalink($article['ID']) ?>"><?php echo $article['post_title']; ?></a></h2>
								
								<p><?php if($article['post_excerpt']) echo $article['post_excerpt']; else echo get_custom_excerpt($article['post_content'], '50'); ?></p>
								
								<ul class="article-links">
									<li><a href="<?php echo get_permalink($article['ID']) ?>/#comments" class="comments-label" title="Responses to &quot;<?php echo esc_attr($article['post_title']); ?>&quot;">Comments</a></li>
								</ul>
							
							</article>
							
						<?php endforeach; ?>
						
					</section>
				</div>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>