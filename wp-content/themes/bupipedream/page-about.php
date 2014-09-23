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
			<div data-column="left-column" class="span15">
				<?php the_content(); ?>
			</div>

			<div class="sidebar span9 last">
				<section id="masthead">
					<ul>
						<li>
							<span class="board">Editor-in-Chief</span>
							<ul>
								<li>Rachel Bluth, '15</li>
							</ul>
						</li>
						<li>
							<span class="board">Managing Editor</span>
							<ul>
								<li>Zachary Feldman, '15</li>
							</ul>
						</li>
						<li>
							<span class="board">Business</span>
							<ul>
								<li>Erin Stolz, '16, <em>Business Manager</em></li>
							</ul>
						</li>
						<li>
							<span class="board">News</span>
							<ul>
								<li>Nicolas Vega, '16, <em>News Editor</em></li>
								<li>Joseph Hawthorne, '16, <em>Assistant News Editor</em></li>
								<li>Carla Sinclair, '16, <em>Assistant News Editor</em></li>
								<li>Alex Mackof, '17, <em>Assistant News Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Sports</span>
							<ul>
								<li>Ashley Purdy, '15, <em>Sports Editor</em></li>
								<li>Jeff Twitty, '17, <em>Assistant Sports Editor</em></li>
								<li>E. Jay Zarett, '16, <em>Assistant Sports Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Photo</span>
							<ul>
								<li>Franz Lino, '16, <em>Photo Editor</em></li>
								<li>Tycho McManus, '15, <em>Assistant Photo Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Opinion</span>
							<ul>
								<li>Molly McGrath, '15, <em>Opinion Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Release</span>
							<ul>
								<li>Jacob Shamsian, '15, <em>Release Editor</em></li>
								<li>Odeya Pinkus, '17, <em>Assistant Release Editor</em><li>
							</ul>
						</li>
						<li>
							<span class="board">Design</span>
							<ul>
								<li>Emma Siegel, '17, <em>Design Manager</em></li>
								<li>Corey Futterman, '15, <em>Design Assistant</em></li>
								<li>John Linitz, '15, <em>Design Assistant</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Copy Desk</span>
							<ul>
								<li>Emily Howard, '15, <em>Copy Desk Chief</em></li>
								<li>Paul Palumbo, '15, <em>Assistant Copy Desk Chief</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Fun Page</span>
							<ul>
								<li>Ben Moosher, '16, <em>Fun Page Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Editorial Artist</span>
							<ul>
								<li>Miriam Geiger, '15, <em>Editorial Artist</em></li>
								<li>Paige Gittelman, '16, <em>Editorial Artist</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Web</span>
							<ul>
								<li>William Sanders, '16, <em>Lead Web Developer</em></li>
								<li>Zachary Feuerstein, '15, <em>Web Developer</em></li>
								<li>Katie Shafsky, '16, <em>Social Media Manager</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Technology</span>
							<ul>
								<li>William Sanders, '16, <em>Newsroom Tech Manager</em></li>
							</ul>
						</li>
					</ul>
				</section>
			</div>
		</section>
	</div>
	<?php get_footer(); ?>
