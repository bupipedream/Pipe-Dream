=== WP Most Popular ===
Contributors: MattGeri
Tags: popular, most viewed, popular posts, most viewed posts, popular posts widget, popular custom type posts, most view widget, most view posts widget
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: 0.2

WP Most Popular is a simple plugin which tracks your most popular blog posts based on views and lets you display them in your theme or blog sidebar.

== Description ==

WP Most Popular was born out of frustration in finding a decent plugin which performs one simple task and that is to rank your most popular blog posts.

The plugin keeps a log of your most popular posts based on views and lets you display them in your blog theme with custom styling. You can display popular posts from the last day, 7 days, 30 days or all time.

It also comes with a sidebar widget to let you display your popular posts on your blogs sidebar.

If you are a developer and integrate the plugin in to a theme, you will get a lot more flexibility out of the plugin including the ability to show the most popular custom post types etc.

[Plugin homepage](http://mattgeri.com/projects/wordpress/wp-most-popular/).

== Installation ==

Setting up WP Most Popular is very simple. Follow these easy steps

1.	Upload the plugin to your `/wp-content/plugins/` directory
2.	Activate the plugin in your WordPress admin
3.	Add sidebar widget or integrate functions in to your theme

== Usage ==

There are two ways in which you can use this plugin.

1.	As a sidebar widget
2.	Custom function in your theme files

Using the widget is the easiest way and recommended for most users. If you are a developer and want to integrate the plugin in to your existing theme, then read the information below.

Firstly, the main function which you will need to include in your theme to fetch the popular posts is called `wmp_get_popular()`.

You can pass that function the following parameters in array form:

*	**limit** (integer)
	*	The number of posts you would like to display i.e. 5
	*	Default: 5
*	**post_type** (string) / (array)
	*	The post type you would like to display
	*	Example: post
	*	Default: All post types
*	**range** (string)
	*	In what date range would you like to display popular posts in
	*	Accepted: all_time, monthly, weekly, daily
	*	Default: all_time

Those are the current parameters that the plugin supports. Let's look at an example of how to display the most recent popular posts in a unordered list.

	<?php
	echo '<ul>';
	$posts = wmp_get_popular( array( 'limit' => 10, 'post_type' => 'post', 'range' => 'all_time' ) );
	global $post;
	if ( count( $posts ) > 0 ): foreach ( $posts as $post ):
		setup_postdata( $post );
		?>
		<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
		<?php
	endforeach; endif;
	echo '</ul>';
	?>

== Frequently Asked Questions ==

= Why are no posts displaying when I use the widget or call the function in my theme? =

99% of the time this is because no posts have been visited yet to receive a ranking. Simply click on a blog post to read it on your blog and it will receive a ranking and display in the list of most popular posts.

= What are the minimum requirements for the plugin? =

You will need a web server or shared host that supports PHP version 5 or newer. Javascript is also required to log post views.

= Why does the plugin use Javascript to track the post views? =

The original version of the plugin that I wrote used PHP to track the post views and the reason why I switched to Javascript was because if a caching plugin is enabled on your blog, the page will be loaded statically to your visitor and the PHP code to log a view on a post will not be run.

= Can I request a feature? =

Yes, please do so on the WordPress support forum for the plugin. I will consider it and if I feel it is worth adding, I will schedule it for a future release.

= Can I contribute code to the plugin? =

Yes! The plugin is open source and I host it on [Github](https://github.com/MattGeri/WP-Most-Popular). Feel free to send me pull requests.

== Changelog ==

= 0.2 =
* Added the ability to query multiple different post types (thanks [inc2734](https://github.com/inc2734))
* You can now also choose a specific post type from the widget

= 0.1 =
*	First version of the plugin released