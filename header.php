<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">

	<!-- Use the .htaccess and remove these lines to avoid edge case issues.
	     More info: h5bp.com/i/378 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php wp_title(''); ?></title>

	<!-- Mobile viewport optimized: h5bp.com/viewport -->
	<meta name="viewport" content="width=device-width">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

	<!-- Begin LESS -->
	<link rel="stylesheet/less" type="text/css" href="<?php bloginfo('template_url'); ?>/less/style.less">
	<script src="http://lesscss.googlecode.com/files/less-1.3.0.min.js" type="text/javascript"></script>
	<!-- End LESS -->

	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" media="screen" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<!-- Facebook Open Graph -->
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	<meta property="fb:page_id" content="56173492419" />
	<meta property="fb:app_id" content="225391740871493" />
	<meta property="fb:admins" content="1352160452" />
	
	<?php if(is_single()): ?>
		<meta property="og:url" content="<?php echo get_permalink(); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="<?php single_post_title(''); ?>" />

		<?php
			$description = strip_tags(get_the_excerpt());
			if(!$description) $description = get_custom_excerpt($post->post_content, '25');
		?>
		
		<meta property="og:description" content="<?php echo $description;  ?>" />

		<?php $photos = get_photos(get_the_ID(), '1'); if($photos): ?>
			<meta property="og:image" content="<?php echo $photos['src']['thumbnail']; ?>" />
		<?php else: ?>
			<meta property="og:image" content="<?php bloginfo('template_url'); ?>/img/og-image.png" />
		<?php endif; ?>

	<?php else: ?>
		<meta property="og:type" content="website" />
		<meta property="og:description" content="<?php bloginfo('description'); ?>" />  
		<meta property="og:image" content="<?php bloginfo('template_url'); ?>/img/og-image.png" />
	<?php endif; ?>

	
	<!-- Used by WP Plugins -->
	<?php wp_head(); ?>

	<!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
	
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-29084495-1']);
	  _gaq.push(['_setDomainName', 'bupipedream.com']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>

<body <?php body_class(); ?>>
	
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

	<div id="fb-root"></div>
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '225391740871493', // App ID
	      channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
	      status     : true, // check login status
	      cookie     : true, // enable cookies to allow the server to access the session
	      xfbml      : true  // parse XFBML
	    });

	    // Additional initialization code here
	  };

	  // Load the SDK Asynchronously
	  (function(d){
	     var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
	     js = d.createElement('script'); js.id = id; js.async = true;
	     js.src = "//connect.facebook.net/en_US/all.js";
	     d.getElementsByTagName('head')[0].appendChild(js);
	   }(document));
	</script>
			
<div id="container">
	<header class="row">
		<div id="date-weather">
			<!-- Date and Weather -->
			<span class="date"><?php echo date('l, M j, Y'); ?></span>
			<span class="weather">
				<?php
					$weather = simplexml_load_file('http://www.google.com/ig/api?weather=13902');
					$city = $weather->weather->forecast_information->city['data'];
					$degrees = $weather->weather->current_conditions->temp_f['data'];
					if($degrees) echo $degrees."&deg; - ".$city;
					else echo "Binghamton, NY"
				?>
			</span>
		</div>
		<div id="logo">
			<!-- Pipe Dream Logo -->
			<h1><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_url'); ?>/img/bupipedream.png" alt="<?php bloginfo('name'); ?>" /></a></h1>
		</div>
		<div id="search-form">
			<!-- Search Form -->
			<form role="search" method="get" id="searchform" action="<?php bloginfo('wpurl'); ?>/" >
				<input type="search" autocomplete="on" value="<?php get_search_query(); ?>" name="s" id="s" placeholder="Search the Site..." />
				<input type="submit" id="searchsubmit" value="<?php echo esc_attr('Search') ?>" />
			</form>			
		</div>
	</header>
	<nav id="nav-container" class="row">
		<div id="nav-links" class="span19">
			<!-- Navigation Links -->
			<ul>
				<li><a href="<?php bloginfo('wpurl'); ?>/news/" <?php if(is_category('1')) echo 'class="active"'; ?>>News</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/sports/" <?php if(is_category('3')) echo 'class="active"'; ?>>Sports</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/opinion/" <?php if(is_category('4')) echo 'class="active"'; ?>>Opinion</a></li>
				<li><a href="<?php bloginfo('wpurl'); ?>/release/" <?php if(is_category('5')) echo 'class="active"'; ?>>Release</a></li>
				<li class="first light"><a href="<?php bloginfo('wpurl'); ?>/advertise/" title="Advertise in Pipe Dream">Advertise</a></li>
				<li class="light"><a href="<?php bloginfo('wpurl'); ?>/about/" title="Learn more about Pipe Dream">About</a></li>
				<!-- <li class="light"><a href="<?php bloginfo('wpurl'); ?>/contribute/" title="Join Pipe Dream">Contribute</a></li> -->
			</ul>
		</div>
		<div id="last-site-update" class="span5 last">
			<!-- Last Updated Timestamp -->
			<p>Last Update:
				<?php 
					$args = array(
						'numberposts' => 1,
						'orderby' => 'post_date',
						'order' => 'DESC',
						'post_type' => 'post',
						'post_status' => 'publish',
					);
					$post = wp_get_recent_posts($args);
					$time = get_time_since($post['0']['post_modified_gmt']);
				?>
				
				<?php date_default_timezone_set('EST'); ?>
				
				<time title="<?php echo date('F j, Y \a\t g:i A T', strtotime($post['0']['post_modified'])); ?>">
					<?php echo $time; ?>
				</time>
			</p>
		</div>
	</nav>