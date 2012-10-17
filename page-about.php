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
							<li>Daniel Weintraub '13</li>
						</ul>
					</li>
					<li>
						<span class="board">Managing Editor</span>
						<ul>
							<li>Jules Forrest '14</li>
						</ul>
					</li>
					<li>
						<span class="board">Business</span>
						<ul>
							<li>Zachary Kirschner '13, <em>Business Manager</em></li>
							<li>Zachary Hindin '14, <em>Advertising Manager</em></li>
							<li>Kimberly Bower '13, <em>Advertising Assistant</em></li>
						</ul>
					</li>
					<li>
						<span class="board">News</span>
						<ul>
							<li>James Galloway '13, <em>News Editor</em></li>
							<li>Suzie Lamb '13, <em>Assistant News Editor</em></li>
							<li>Geoff Wilson '14, <em>Assistant News Editor</em></li>
							<li>Christina Pullano '14, <em>News Assistant</em></li>
						</ul>
					</li>
					<li>
						<span class="board">Sports</span>
						<ul>
							<li>Megan Brockett '13, <em>Sports Editor</em></li>
							<li>Ari Kramer '14, <em>Assistant Sports Editor</em></li>
							<li>Erik Bacharach '14, <em>Assistant Sports Editor</em></li>
						</ul>
					</li>
					<li>
						<span class="board">Photo</span>
						<ul>
							<li>Jonathan Heisler '13, <em>Photo Editor</em></li>
							<li>Eric King '13, <em>Assistant Photo Editor</em></li>
							<li>Nia Pellone '14, <em>Assistant Photo Editor</em></li>
						</ul>
					</li>
					<li>
						<span class="board">Opinion</span>
						<ul>
							<li>Ezra Shapiro '14, <em>Opinion Editor</em></li>
						</ul>
					</li>
					<li>
						<span class="board">Release</span>
						<ul>
							<li>Darian Lusk '14, <em>Release Editor</em></li>
							<li>Jacob Shamsian '15 <em>Assistant Release Editor</em><li>
						</ul>
					</li>
					<li>
						<span class="board">Design</span>
						<ul>
							<li>Paige Nazinitsky '14, <em>Design Manager</em></li>
							<li>Zack Feldman '15, <em>Design Assistant</em></li>
							<li>Rebecca Forney '15, <em>Design Assistant</em></li>
						</ul>
					</li>
					<li>
						<span class="board">Copy Desk</span>
						<ul>
							<li>Kaitlin Busser '13, <em>Copy Desk Chief</em></li>
							<li>Tina Ritter '13, <em>Assistant Copy Desk Chief</em></li>
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
							<li>Daniel O'Connor '14, <em>Web Editor &amp; Developer</em></li>
						</ul>
					</li>
					<li>
						<span class="board">Technology</span>
						<ul>
							<li>Derek Parry '13, <em>Newsroom Tech Manager</em></li>
						</ul>
					</li>
				</ul>
			</section>
			
		</div>
	</div>
	<?php get_footer(); ?>