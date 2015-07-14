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
								<li>Nicolas Vega, '16</li>
							</ul>
						</li>
						<li>
							<span class="board">Managing Editor</span>
							<ul>
								<li>Emma C Siegel, '17</li>
							</ul>
						</li>
						<li>
							<span class="board">Business</span>
							<ul>
								<li>Michael Contegni, '16, <em>Business Manager</em></li>
							</ul>
						</li>
						<li>
							<span class="board">News</span>
							<ul>
								<li>Alexandra K. Mackof, '17, <em>News Editor</em></li>
								<li>Carla Sinclair, '16, <em>Assistant News Editor</em></li>
								<li>Pelle Waldron, '17, <em>Assistant News Editor</em></li>
								<li>Gabriella Weick, '18, <em>Assistant News Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Sports</span>
							<ul>
								<li>E. Jay Zarett, '16, <em>Sports Editor</em></li>
								<li>Jeffrey Twitty, '17, <em>Assistant Sports Editor</em></li>
								<li>Orlaith McCaffrey, '18, <em>Assistant Sports Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Photo</span>
							<ul>
								<li>Franz K. Lino, '16, <em>Photography Editor</em></li>
								<li>Emily Earl, '17, <em>Assistant Photography Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Opinion</span>
							<ul>
								<li>Esmeralda Murray, '17, <em>Opinion Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Release</span>
							<ul>
								<li>Odeya Pinkus, '17, <em>Release Editor</em></li>
								<li>Kathryn Shafsky, '16, <em>Assistant Release Editor</em><li>
							</ul>
						</li>
						<li>
							<span class="board">Design</span>
							<ul>
								<li>Samantha Webb, '16, <em>Design Manager</em></li>
								<li>Aleza Leinwand, '16, <em>Design Assistant</em></li>
								<li>Sihang Li, '16, <em>Design Assistant</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Copy Desk</span>
							<ul>
								<li>Katherine H. Dowd, '16, <em>Copy Desk Chief</em></li>
								<li>Rachel Greenspan, '18, <em>Assistant Copy Desk Chief</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Fun Page</span>
							<ul>
								<li>Ben Moosher, '16, <em>Fun Page Editor</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Editorial Artists</span>
							<ul>
								<li>Miriam Geiger, '15, <em>Editorial Artist</em></li>
								<li>Paige Gittelman, '16, <em>Editorial Artist</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Web</span>
							<ul>
								<li>William Sanders, '16, <em>Lead Web Developer</em></li>
								<li>Katie Shafsky, '16, <em>Social Media Manager</em></li>
							</ul>
						</li>
						<li>
							<span class="board">Technology</span>
							<ul>
								<li>Rohit Kapur, '17, <em>Newsroom Technology Manager</em></li>
							</ul>
						</li>
					</ul>
				</section>
			</div>
		</section>
	</div>
	<?php get_footer(); ?>
