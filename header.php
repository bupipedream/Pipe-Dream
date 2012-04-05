<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<!-- Special head tags for open graph data -->
<?php if(is_single()): ?>
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<?php elseif(is_author()): ?>
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# profile: http://ogp.me/ns/profile#">
<?php else: ?>
	<head>
<?php endif; ?>

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

	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css " type="text/css" media="screen" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<!-- Facebook Open Graph -->
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	<!-- <meta property="fb:app_id" content="225391740871493" /> -->
	<meta property="fb:app_id" content="<?php echo FB_APP_ID; ?>" />	
	<meta property="fb:admins" content="1352160452" />
	
	<?php if(is_single()): ?>
		<meta property="og:url" content="<?php echo get_permalink(); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="<?php single_post_title(''); ?>" />

		<?php
			$description = strip_tags(get_the_excerpt());
			if(!$description) $description = get_custom_excerpt($post->post_content, '25');
		?>
		
		<meta property="og:description" content="<?php echo $description; ?>" />

		<?php $photos = get_photos(get_the_ID(), '1'); if($photos): ?>
			<meta property="og:image" content="<?php echo $photos['src']['medium']; ?>" />
		<?php else: ?>
			<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/og-image.png" />
		<?php endif; ?>
		
		<!-- List the post authors -->		
		<?php
			$authors = get_coauthors();
			foreach($authors as $author) {
				echo "<meta property=\"article:author\" content=\"".get_author_posts_url($author->ID)."\">\n";
			}
		?>
		
		<!-- Article publish and expiration dates -->
		<meta property="article:published_time" content="<?php echo get_the_time("Y-m-d"); ?>"> 
		<meta property="article:expiration_time" content="<?php echo  date('Y-m-d', strtotime(date("Y-m-d", strtotime(get_the_time("Y-m-d"))) . " +4 day")); ?>">
     	
		<?php
			// Display the post's category
     		$category = get_the_category(); 
			$category = $category[0]->cat_name;
			if($category != 'Archives')
				echo "<meta property=\"article:section\" content=\"$category\">"
     	?>
	<?php elseif(is_author()): ?>
		<meta property="og:type" content="profile">
		<meta property="og:title" content="<?php the_author_meta('display_name', $author); ?> | <?php bloginfo('name'); ?>">
		<meta property="og:description" content="Profile page for <?php the_author_meta('display_name', $author); ?>, <?php the_author_meta('position', $author); ?> at <?php bloginfo('name'); ?>.">
		<meta property="og:url" content="<?php echo get_author_posts_url($author); ?>">

		<?php
			// Get the author's Gravatar
			$headers = get_headers('http://www.gravatar.com/avatar/'.md5(strtolower(trim(get_the_author_meta('user_email', $author)))).'?s=200&d=404');
			if(strpos($headers[0], '200') !== false) {
				echo "<meta property=\"og:image\" content=\"http://www.gravatar.com/avatar/".md5(strtolower(trim(get_the_author_meta('user_email', $author))))."?s=200&d=404\">";
			}
		?>

		<meta property="profile:first_name" content="<?php the_author_meta('first_name', $author); ?>">
		<meta property="profile:last_name" content="<?php the_author_meta('last_name', $author); ?>">
		<meta property="profile:username" content="<?php the_author_meta('user_nicename', $author); ?>">

	<?php else: ?>
		<meta property="og:type" content="website" />
		<meta property="og:description" content="Pipe Dream is the student-run newspaper serving the Binghamton University community since 1946." />  
		<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/og-image.png" />
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
				appId      : '<?php echo FB_APP_ID; ?>', // App ID
				channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
				status     : true, // check login status
				cookie     : true, // enable cookies to allow the server to access the session
				xfbml      : true  // parse XFBML
			});

			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					// the user is logged in and has authenticated your
					// app, and response.authResponse supplies
					// the user's ID, a valid access token, a signed
					// request, and the time the access token 
					// and signed request each expire
					var uid = response.authResponse.userID;
					var accessToken = response.authResponse.accessToken;

					// FB.api('/me', function(response) {
					//   alert('Your name is ' + response.name);
					// });

					<?php if(is_single()): ?>

						FB.api(
							'/me/news.reads', 
							'post', 
						{ 
							article : '<?php echo get_permalink(); ?>'
						},
						function(response) {
							log('Facebook API:', response);
						});

					<?php endif; ?>

				} else if (response.status === 'not_authorized') {
					// the user is logged in to Facebook, 
					// but has not authenticated your app
				} else {
					// the user isn't logged in to Facebook.
				}
				log('Facebook API:', response);
			});
		};

		FB.Event.subscribe('edge.create', function(targetUrl) {
			_gaq.push(['_trackSocial', 'facebook', 'like', targetUrl]);
		});
		
		FB.Event.subscribe('edge.remove', function(targetUrl) {
		  _gaq.push(['_trackSocial', 'facebook', 'unlike', targetUrl]);
		});
		
		FB.Event.subscribe('message.send', function(targetUrl) {
		  _gaq.push(['_trackSocial', 'facebook', 'send', targetUrl]);
		});

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
			<h1><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/bupipedream.png" alt="<?php bloginfo('name'); ?>" /></a></h1>
		</div>
		<div id="search-form">
			<!-- Search Form -->
			<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>" >
				<input type="search" autocomplete="on" value="<?php get_search_query(); ?>" name="s" id="s" placeholder="Search the Site..." />
				<input type="submit" id="searchsubmit" value="<?php echo esc_attr('Search') ?>" />
			</form>			
		</div>
	</header>
	<nav id="nav-container" class="row">
		<div id="nav-links" class="span19">
			<!-- Navigation Links -->
			<ul>
				<li><a href="<?php echo home_url(); ?>/news/" <?php if(is_category('1')) echo 'class="active"'; ?>>News</a></li>
				<li><a href="<?php echo home_url(); ?>/sports/" <?php if(is_category('3')) echo 'class="active"'; ?>>Sports</a></li>
				<li><a href="<?php echo home_url(); ?>/opinion/" <?php if(is_category('4')) echo 'class="active"'; ?>>Opinion</a></li>
				<li><a href="<?php echo home_url(); ?>/release/" <?php if(is_category('5')) echo 'class="active"'; ?>>Release</a></li>
				<li class="first light"><a href="<?php echo home_url(); ?>/advertise/" title="Advertise in Pipe Dream">Advertise</a></li>
				<li class="light"><a href="<?php echo home_url(); ?>/about/" title="Learn more about Pipe Dream">About</a></li>
				<!-- <li class="light"><a href="<?php echo home_url(); ?>/contribute/" title="Join Pipe Dream">Contribute</a></li> -->
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