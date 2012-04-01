<?php get_header(); ?>
	<div class="row about" id="content">
			
			<div class="span16">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
				<article id="post-<?php the_ID(); ?>">
								
					<h2><?php the_title(); ?></h2>
								
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
			<div class="span8 last">
			
				<section id="masthead">
					<ul>
						<li>
							<span class="board">Editor-in-Chief</span>
							<ul>
								<li>Nate Fleming '12</li>
							</ul>
						</li>
						<li>
							<span class="board">Managing Editor</span>
							<ul>
								<li>Diana Glogau '12</li>
							</ul>
						</li>
						<li>
							<span class="board">Business</span>
							<ul>
								<li>Henry James '12</li>
							</ul>
						</li>
						<li>
							<span class="board">News</span>
							<ul>
								<li>Emily Melas '13, <em>News Editor</em></li>
								<li>Anthony Fiore '12, <em>Assistant News Editor</em></li>
								<li>Sophia Rosenbaum '12, <em>Assistant News Editor</em></li>
								<li>Meghan Perri '13, <em>Assistant News Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Sports</span>
							<ul>
								<li>Adam Rosenbloom '12, <em>Sports Editor</em></li>
								<li>Aaron Gottlieb '12, <em>Assistant Sports Editor</em></li>
								<li>Megan Brockett '13, <em>Assistant Sports Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Photo</span>
							<ul>
								<li>Jules Forrest '14, <em>Photo Editor</em></li>
								<li>Janel FitzSimmonds '13, <em>Assistant Photo Editor</em></li>
								<li>Eric King '13, <em>Assistant Photo Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Opinion</span>
							<ul>
								<li>Jordan Rabinowitz '12, <em>Opinion Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Release</span>
							<ul>
								<li>Kathleen Rubino '13, <em>Release Editor</em></li>
								<li>Darian Lusk '14, <em>Assistant Release Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Design</span>
							<ul>
								<li>Paige Nazinitsky '14, <em>Design Manager</em></li>
								<li>Zack Feldman '15, <em>Assistant Design Manager</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Copy Desk</span>
							<ul>
								<li>Kristin Lee '12, <em>Copy Desk Chief</em></li>
								<li>Kaitlin Busser '13, <em>Assistant Copy Desk Chief</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Fun Page</span>
							<ul>
								<li>Mike Manzi '13, <em>Fun Page Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Web</span>
							<ul>
								<li>Daniel O'Connor '14, <em>Lead Web Developer</em></li>
								<li>Daniel Weintraub '13, <em>Social Media Manager</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Technology</span>
							<ul>
								<li>Phil Schaffer '12, <em>Newsroom Tech Manager</em></li>
							</ul>
						</li>
					</ul>
				</section>
				
			</div>

	</div>
	<?php get_footer(); ?>