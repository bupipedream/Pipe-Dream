<?php get_header(); ?>
	
	<!-- Get all of content on the homepage -->
	<?php $sections = get_sections(); ?>
		
	<div class="row" id="content">
		<h1 class="page-title">Join Pipe Dream</h1>
		<section class="hero clearfix">
			<figure class="hero-image">
				<img src="<? bloginfo( 'template_url' ); ?>/img/pages/gim.png">
			</figure>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In neque odio, semper vitae sagittis vitae, vestibulum nec ligula. In pretium venenatis purus, congue fermentum quam adipiscing vitae. Quisque malesuada felis id nisi egestas blandit.</p>
			<a href="#" class="button">View Openings</a>
		</section>
		<section class="page-section">
			<h2 class="page-section-title">Sections<small>Click on a section to learn more</small></h2>
			<div data-section="news" class="section-description" style="display: block;">
				<h3 class="section-title">News</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed diam vulputate est gravida tempor ac a erat. Maecenas et urna dui. Etiam elementum hendrerit nisl, vel gravida massa mattis el. Sed euismod commodo ipsum, id mollis mi dignissim in.</p>
				<a href="mailto:news@bupipedream.com" class="section-email">news@bupipedream.com</a>
			</div>
			<div data-section="sports" class="section-description">
				<h3>Sports</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed diam vulputate est gravida tempor ac a erat. Maecenas et urna dui. Etiam elementum hendrerit nisl, vel gravida massa mattis el. Sed euismod commodo ipsum, id mollis mi dignissim in.</p>
				<span>sports@bupipedream.com</span>
			</div>
			<div data-section="opinion" class="section-description">
				<h3>Opinion</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed diam vulputate est gravida tempor ac a erat. Maecenas et urna dui. Etiam elementum hendrerit nisl, vel gravida massa mattis el. Sed euismod commodo ipsum, id mollis mi dignissim in.</p>
				<span>opinion@bupipedream.com</span>
			</div>

			<ul id="section-writing" class="section-category">
				<li class="active"><a href="">News</a></li>
				<li><a href="">Sports</a></li>
				<li><a href="">Opinion</a></li>
				<li><a href="">Release</a></li>
				<li><a href="">Copy</a></li>
			</ul>
			<ul id="section-tech" class="section-category">
				<li><a href="">Web</a></li>
				<li><a href="">Social Media</a></li>
				<li><a href="">Newsroom Tech</a></li>
			</ul>
			<ul id="section-creative" class="section-category">
				<li><a href="">Design</a></li>
				<li><a href="">Photo</a></li>
				<li><a href="">Fun</a></li>
				<li><a href="">Editorial Cartoonist</a></li>
			</ul>
			<ul id="section-business" class="section-category">
				<li><a href="">Business</a></li>
				<li><a href="">Advertising</a></li>
			</ul>
		</section>
		<section class="page-section photo-grid">
			<h2 class="page-section-title">Life at Pipe Dream</h2>
			<img src="<? bloginfo( 'template_url' ); ?>/img/pages/join/paige.jpg">
			<img src="<? bloginfo( 'template_url' ); ?>/img/pages/join/paige.jpg">
			<img src="<? bloginfo( 'template_url' ); ?>/img/pages/join/paige.jpg">
			<img src="<? bloginfo( 'template_url' ); ?>/img/pages/join/paige.jpg">
			<img src="<? bloginfo( 'template_url' ); ?>/img/pages/join/paige.jpg">
			<img src="<? bloginfo( 'template_url' ); ?>/img/pages/join/paige.jpg">
			<img src="<? bloginfo( 'template_url' ); ?>/img/pages/join/paige.jpg">
			<img src="<? bloginfo( 'template_url' ); ?>/img/pages/join/paige.jpg">
		</section>
	</div>
	<?php get_footer(); ?>