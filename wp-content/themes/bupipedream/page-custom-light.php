<?php
/*
	Template Name: Minimalist Page
*/
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title><?wp_title(''); ?></title>
	<meta name="viewport" content="width=device-width">
	<meta property="og:title" content="<?php the_title(); ?>" />

	<!-- Used by WP Plugins -->
	<?php wp_head(); ?>

	<!-- Open Graph Meta  -->
	<? get_template_part("open-graph"); ?>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<style type="text/css">
		body {
			font-family: 'Open Sans', sans-serif;
		}

		a {
			color: #666;
			font-size: 0.875em;
			text-decoration: none;
		}

		a:hover {
			text-decoration: underline;
		}
	
		.container {
			margin: 0 auto;
			max-width: 750px;
		}

		.logo {
			border-bottom: 1px solid #E9E9E9;
			margin-bottom: 30px;
			padding-bottom: 30px;
		}

		.center {
			text-align: center;
		}
	</style>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-29084495-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>

<body>
	<a href="http://www.bupipedream.com/" title="Binghamton University news, sports and entertainment">
		&larr; Back to Pipe Dream
	</a>
	<div class="container">
		<h1 class="logo center">
			<a href="<? bloginfo( 'url' ); ?>/" title="<? bloginfo('name'); ?>">
				<img src="<? bloginfo( 'template_url' ); ?>/img/bupipedream.png" alt="<? bloginfo( 'name' ); ?> - <? bloginfo( 'description' ); ?>" />
			</a>
		</h1>
		<div>
			<?php if (have_posts()) : the_post(); ?>
				<?php the_content(); ?>
			<?php endif; ?>
		</div>
	</div>

	<!-- Used by WP plugins -->
	<?php wp_footer(); ?>
</body>
</html>