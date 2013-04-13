<?php get_header(); ?>
			
	<div id="page-about" class="content row">
		<nav id="page-navigation">
			<ul>
				<li class="active"><a href="<? bloginfo('wpurl'); ?>/about/" title="About Pipe Dream">About</a></li>
				<li><a href="<? bloginfo('wpurl'); ?>/advertise/" title="Advertise in Pipe Dream">Advertise</a></li>
				<!-- <li><a href="<? bloginfo('wpurl'); ?>/donate/" title="Donate to Pipe Dream">Donate</a></li> -->
				<li><a href="<? bloginfo('wpurl'); ?>/join/" title="Join Pipe Dream">Join</a></li>
				<!-- <li><a href="<? bloginfo('wpurl'); ?>/staff/" title="Faces behind Pipe Dream">Staff</a></li> -->
				<li><a href="<? bloginfo('wpurl'); ?>/contact/" title="Contact Pipe Dream">Contact</a></li>
			</ul>
		</nav>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<section class="row post">
			<div data-column="left-column" class="span16">
				<?php the_content(); ?>
			</div>

			<div class="sidebar span8 last">
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
								<li>Kimberly Bower '13, <em>Business Manager</em></li>
							</ul>
						</li>
						<li>
							<span class="board">News</span>
							<ul>
								<li>James Galloway '13, <em>News Editor</em></li>
								<li>Geoff Wilson '14, <em>Assistant News Editor</em></li>
								<li>Christina Pullano '14, <em>Assistant News Editor</em></li>
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
								<li>Kendall Loh '14, <em>Assistant Photo Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Opinion</span>
							<ul>
								<li>Kaitlin Busser '13, <em>Opinion Editor</em></li>
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
								<li>Rebecca Forney '14, <em>Design Assistant</em></li>
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
							<span class="board">Editorial Artist</span>
							<ul>
								<li>Miriam Geiger '13, <em>Editorial Artist</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Web</span>
							<ul>
								<li>Daniel O'Connor '14, <em>Lead Web Developer</em></li>
								<li>Willie Demaniow '16, <em>Asst. Web Developer</em></li>
								<li>Melissa Edelblum '15, <em>Social Media Manager</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Technology</span>
							<ul>
								<li>Derek Parry '13, <em>Newsroom Tech Manager</em></li>
							</ul>
							<ul>
								<li>Will Sanders '16, <em>Assistant Newsroom Tech</em></li>
							</ul>
						</li>
					</ul>
				</section>
			</div>
		</section>
	</div>
	<?php get_footer(); ?>