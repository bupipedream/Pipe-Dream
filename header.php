<!DOCTYPE html>
<html>

<?php if( is_single() ): ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<?php elseif( is_author() ): ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# profile: http://ogp.me/ns/profile#">
<?php else: ?>
<head>
<?php endif; ?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?wp_title(''); ?></title>

	<!-- Mobile viewport optimized: h5bp.com/viewport -->
	<meta name="viewport" content="width=device-width">

	<!-- Begin LESS -->
	<link rel="stylesheet/less" type="text/css" href="<? bloginfo('template_url'); ?>/less/style.less">
	<script src="<? bloginfo('template_url'); ?>/js/vendor/less-1.1.5.min.js" type="text/javascript"></script>
	<!-- End LESS -->

	<link rel="stylesheet" href="<? bloginfo('template_url'); ?>/style.css" type="text/css" media="screen" />

	<link rel="pingback" href="<? bloginfo('pingback_url'); ?>">
	
	<!-- Open Graph Meta  -->
	<? get_template_part("open-graph"); ?>

	<!-- Used by WP Plugins -->
	<?php wp_head(); ?>

	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-29084495-1']);
	  _gaq.push(['_setDomainName', 'bupipedream.com']);
	  _gaq.push(['_trackPageview']);
	
	  if (document.location.href.search("fb_action_types=news.reads") != -1) {
		// Track traffic from Facebook Like & Send as Campaign traffic 
		_gaq.push(['_trackEvent', 'Open Graph', 'Read', '<?= get_the_title(); ?>']);
	  }

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>

<body <? body_class(); ?>>
	<!--[if lt IE 7]>
		<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	<![endif]-->

	<div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '<?= FB_APP_ID; ?>', // App ID
				channelUrl : '//www.bupipedream.com/channel.html', // Channel File
				status     : true, // check login status
				cookie     : true, // enable cookies to allow the server to access the session
				xfbml      : true  // parse XFBML
			});
			
			/*!
			 * jQuery Cookie Plugin
			 * https://github.com/carhartl/jquery-cookie
			 *
			 * Copyright 2011, Klaus Hartl
			 * Dual licensed under the MIT or GPL Version 2 licenses.
			 * http://www.opensource.org/licenses/mit-license.php
			 * http://www.opensource.org/licenses/GPL-2.0
			 */
			(function(a){a.cookie=function(b,c,d){if(arguments.length>1&&(!/Object/.test(Object.prototype.toString.call(c))||c===null||c===undefined)){d=a.extend({},d);if(c===null||c===undefined){d.expires=-1}if(typeof d.expires==="number"){var e=d.expires,f=d.expires=new Date;f.setDate(f.getDate()+e)}c=String(c);return document.cookie=[encodeURIComponent(b),"=",d.raw?c:encodeURIComponent(c),d.expires?"; expires="+d.expires.toUTCString():"",d.path?"; path="+d.path:"",d.domain?"; domain="+d.domain:"",d.secure?"; secure":""].join("")}d=c||{};var g=d.raw?function(a){return a}:decodeURIComponent;var h=document.cookie.split("; ");for(var i=0,j;j=h[i]&&h[i].split("=");i++){if(g(j[0])===b)return g(j[1]||"")}return null}})(jQuery)
			
			// check if user has turned facebook sharing off
			var sharing = $.cookie('fb-share');
			
			// turn on sharing when session does not exist
			if(!sharing) {
				setSharing('on');
			}

			// listen for and handle auth.statusChange events
			FB.Event.subscribe('auth.statusChange', function(response) {
				<?php if(is_single()): ?>
				if (response.authResponse) {
					// user has auth'd your app and is logged into Facebook
					FB.api('/me', function(me) {
						if (me.name) {
							
							// show facebook info, hide and show other divs
							showLogin(false);
							showProfile(true, me);
							
							FB.api('/me/permissions', 'get', function(response) {
								var canPublish = response.data[0].publish_actions;
								if(!canPublish) {
									showLogin(true);
									showProfile(false);
								}
							});
							
							// show sharing status
							if(sharing == 'on') $('#fb-state span').html("ON");
							else $('#fb-state span').html("OFF");
							
							// share when enabled
							if(sharing == 'on') {
								setTimeout(function(){
									FB.api( '/me/news.reads', 'post', { article : '<?php echo get_permalink(); ?>' }, function(response) {
										log('Facebook API:', response);
										if(response.id) {
											$('#fb-recent-activity ul').prepend('<li id="'+response.id+'"><?php the_title(); ?><a href="#" class="fb-remove" title="Remove this article"><img src="<?php bloginfo('template_url'); ?>/img/close.png" /></a></li>');
											$('#'+response.id).effect("highlight", {}, 5000); 
											$('#fb-show-activity a').effect("highlight", {}, 3000); 
										}
									});
							    }, 10000);
							}
							
							// change sharing status
							$('#fb-state').bind('click', function(e){
								if($('#fb-state span').html() == "ON") { // turn off sharing
									$('#fb-state span').html("OFF");
									setSharing('off');
								} else { // turn on sharing
									$('#fb-state span').html("ON");
									setSharing('on');
								}
								e.preventDefault();
							});
							
							// show recent activity
							$('#fb-show-activity').bind('click', function(e){
								$('#fb-recent-activity').slideToggle();
								e.preventDefault();
							});
							
							// show the facebook settings
							$('#fb-show-settings').bind('click', function(e){
								$('#fb-settings-list').slideToggle();
								e.preventDefault();
							});

							// get the read stories
							FB.api('/me/news.reads', function(response) {
								
								// display read articles
								for(var x in response.data) {
									var article = response.data[x].data.article;
									$('#fb-recent-activity ul').append('<li id="'+response.data[x].id+'">'+article.title+'<a href="#" class="fb-remove" title="Remove this article"><img src="<?php bloginfo('template_url'); ?>/img/close.png" /></a></li>');
									log('Article:', article);
								}
								
								// delete an article from your activity
								$('.fb-remove').live('click', function(e){
									var li = $(this).parent();
									var postId = li.attr('id');
									FB.api(postId, 'delete', function(response) {
										log('Delete Response:', response);
										if (response) {
											li.fadeOut();
											_gaq.push(['_trackEvent', 'Open Graph', 'Account', 'Remove Article']);
										}
									});
									e.preventDefault();
								});
							});
						}
					});
				} else {
					// user has not auth'd your app, or is not logged into Facebook
					showLogin(true);
					showProfile(false);
				}
				<?php endif; ?>
			});
			
			// respond to clicks on the login and logout links
			document.getElementById('fb-login-link').addEventListener('click', function(){
				FB.login(function(response) {
					if(response.authResponse && $.cookie('fb-share') == null) {
						setSharing('on');
					}
				}, {scope: 'publish_actions'});
			});

			document.getElementById('fb-logout-link').addEventListener('click', function(e){
				FB.logout();
				e.preventDefault();
			});

			FB.Event.subscribe('edge.create', function(targetUrl) {
				_gaq.push(['_trackSocial', 'facebook', 'like', targetUrl]);
			});

			FB.Event.subscribe('edge.remove', function(targetUrl) {
				_gaq.push(['_trackSocial', 'facebook', 'unlike', targetUrl]);
			});

			FB.Event.subscribe('message.send', function(targetUrl) {
				_gaq.push(['_trackSocial', 'facebook', 'send', targetUrl]);
			});
			
			document.getElementById('fb-message-developer').addEventListener('click', function(e){
				FB.ui({
					method: 'send',
					display: 'popup',
					title: '<? the_title(); ?>',
					link: '<?= get_permalink(); ?>',
					to: 'itsdanieloconnor'
				});
				e.preventDefault();
			});
		};

		// user is removing publish_streams permission
		function revokePermission() {
			var val = confirm("Are you sure you wish to permanently disable social sharing?");
			if(val) {
				FB.api('/me/permissions/publish_actions', 'delete', function(response) {
					if (response) {
						// alert("You have permanently disabled social sharing.")
						showLogin(true);
						showProfile(false);
					}
				});
			}
			return false;
		}
		
		function setSharing(state) {
			$.cookie('fb-share', state, { expires: 30, path: '/', domain: '<?= substr( site_url(), '7' ); ?>' });
		}

		function showLogin(val) {
			if(val) {
				document.getElementById('fb-signup').style.display = 'block';
			} else {
				document.getElementById('fb-signup').style.display = 'none';
			}
		}
		
		function showProfile(val, data) {
			if(val) {
				document.getElementById('fb-profile-img').setAttribute('src', 'http://graph.facebook.com/'+data.id+'/picture');
				document.getElementById('fb-name').innerHTML = data.name;
				document.getElementById('fb-settings').style.display = 'block';
			} else {
				document.getElementById('fb-settings').style.display = 'none';
			}
		}
		
		// Load the SDK Asynchronously
		(function(d){
			var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
			js = d.createElement('script'); js.id = id; js.async = true;
			js.src = "//connect.facebook.net/en_US/all.js";
			d.getElementsByTagName('head')[0].appendChild(js);
		}(document));

</script>
<div id="container">
		
	<header class="row" role="banner">
		<section id="date-weather" class="span6">
			<div class="date">
				<?
					date_default_timezone_set( 'America/New_York' );
					echo date( 'l, M. j, Y' );
				?>
			</div>
			<div class="weather">
				<img src="<? bloginfo('template_url'); ?>/img/weather/partly-sunny.png" alt="Party Sunny" />
				32&deg;
			</div>
		</section>
		<h1 class="span12">
			<a href="<? bloginfo( 'url' ); ?>/" title="<? bloginfo('name'); ?>">
				<img src="<? bloginfo('template_url'); ?>/img/bupipedream.png" alt="<? bloginfo( 'name' ); ?> - <? bloginfo( 'description' ); ?>" />
			</a>
		</h1>
		<section id="search-social" class="span6 last">
			<div class="social">
				<a href="https://www.facebook.com/BUPipeDream" title="Follow Pipe Dream on Facebook"><img src="<? bloginfo( 'template_url' ); ?>/img/social/facebook.png" alt="Facebook Page" /> Facebook</a>
				<a href="https://twitter.com/bupipedream" title="Follow Pipe Dream on Twitter"><img src="<? bloginfo( 'template_url' ); ?>/img/social/twitter.png" alt="Twitter Account" /> Twitter</a>
			</div>
			<form id="search" role="search" method="get" id="searchform" action="<? bloginfo( 'wpurl' ); ?>/">
				<input type="search" autocomplete="on" placeholder="Search..." value="<? get_search_query(); ?>" />
				<input type="submit" value="Search" />
			</form>
		</section>
	</header>

	<nav id="nav-container" class="row">
		<div id="nav-links" class="span19">
			<!-- Navigation Links -->
			<ul>
				<li><a href="<? bloginfo('wpurl'); ?>/news/" <? if(is_category('1')) echo 'class="active"'; ?>>News</a></li>
				<li><a href="<? bloginfo('wpurl'); ?>/sports/" <? if(is_category('3')) echo 'class="active"'; ?>>Sports</a></li>
				<li><a href="<? bloginfo('wpurl'); ?>/opinion/" <? if(is_category('4')) echo 'class="active"'; ?>>Opinion</a></li>
				<li><a href="<? bloginfo('wpurl'); ?>/release/" <? if(is_category('5')) echo 'class="active"'; ?>>Release</a></li>
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
					$time = get_time_since($post['0']['post_date']);
				?>
				
				<time title="<?= date('F j, Y \a\t g:i A T', strtotime($post['0']['post_modified'])); ?>">
					<?= $time; ?>
				</time>
			</p>
		</div>
	</nav>