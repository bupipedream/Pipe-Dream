<?php get_header(); ?>
			
	<div id="page-contact" class="content row">
		<nav id="page-navigation">
			<ul>
				<li><a href="<? bloginfo('wpurl'); ?>/about/" title="About Pipe Dream">About</a></li>
				<li><a href="<? bloginfo('wpurl'); ?>/advertise/" title="Advertise in Pipe Dream">Advertise</a></li>
				<!-- <li><a href="<? bloginfo('wpurl'); ?>/donate/" title="Donate to Pipe Dream">Donate</a></li> -->
				<li><a href="<? bloginfo('wpurl'); ?>/join/" title="Join Pipe Dream">Join</a></li>
				<!-- <li><a href="<? bloginfo('wpurl'); ?>/staff/" title="Faces behind Pipe Dream">Staff</a></li> -->
				<li class="active"><a href="<? bloginfo('wpurl'); ?>/contact/" title="Contact Pipe Dream">Contact</a></li>
			</ul>
		</nav>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<section class="row post">
			<div class="span16">
				<?php the_content(); ?>
			</div>
			<div class="span8 last">
				<dl id="contact-list">
					<dt>Advertising:</dt>
						<dl><a href="mailto:business@bupipedream.com">business@bupipedream.com</a></dl>
					<dt>Corrections:</dt>
						<dl><a href="mailto:editor@bupipedream.com" title="Submit a correction">editor@bupipedream.com</a></dl>
					<dt>Letter to the editor:</dt>
						<dl><a href="mailto:editor@bupipedream.com">editor@bupipedream.com</a></dl>
					<dt>News tips:</dt>
						<dl><a href="mailto:news@bupipedream.com">news@bupipedream.com</a></dl>
				</dl>
			</div>
		</section>
	</div>
	<?php get_footer(); ?>