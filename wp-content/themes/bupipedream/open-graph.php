<!-- Facebook Open Graph -->
<meta property="og:site_name" content="<?= bloginfo('name'); ?>" />

<meta property="fb:admins" content="1352160452" />

<?php if( is_single() ): ?>
	<meta property="og:url" content="<?= get_permalink() ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<? single_post_title(''); ?>" />

	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@bupipedream">

	<?php
		$description = htmlspecialchars( strip_tags( get_the_excerpt() ) );
		if( !$description ) $description = htmlspecialchars( get_custom_excerpt( $post->post_content, '25' ) );
	?>

	<meta property="og:description" content="<?= $description; ?>" />

	<?php $photos = get_photos( get_the_ID() ); if( $photos ): ?>
		<?foreach( $photos['photos'] as $photo ): ?>
			<meta property="og:image" content="<?= $photo['src']['large']; ?>" />
		<?endforeach;?>
	<?php else: ?>
		<meta property="og:image" content="<? bloginfo('template_url'); ?>/img/og-image.png" />
	<?php endif; ?>

	<!-- List the post authors -->
	<?php
		$authors = get_coauthors();
		foreach( $authors as $author ) {
			echo "<meta property=\"article:author\" content=\"" . get_author_posts_url($author->ID) . "\">\n";
		}
	?>

	<!-- Article publish and expiration dates -->
	<meta property="article:published_time" content="<?= get_the_time( "Y-m-d\TH:i:sT" ); ?>">
	<meta property="article:expiration_time" content="<?= date('Y-m-d', strtotime(date('Y-m-d', strtotime(get_the_time('Y-m-d'))) . '+4 day')); ?>">

	<?php
		// Display the post's category
		$category = get_the_category();
		$category = $category[0]->cat_name;
		if($category != 'Archives')
			echo "<meta property=\"article:section\" content=\"$category\">";
 	?>
<?php elseif(is_author()): ?>
	<meta property="og:type" content="profile">
	<meta property="og:title" content="<? the_author_meta('display_name', $author); ?>">
	<meta property="og:description" content="Profile page for <? the_author_meta( 'display_name', $author ); ?>, <? the_author_meta( 'position', $author ); ?> at <? bloginfo( 'name' ); ?>.">
	<meta property="og:url" content="<?= get_author_posts_url( $author ); ?>">

	<?php
		// Get the author's Gravatar profile
		$headers = get_headers( 'http://www.gravatar.com/avatar/' . md5(strtolower(trim(get_the_author_meta('user_email', $author)))) . '?s=200&d=404' );
		if( strpos($headers[0], '200' ) !== false) {
			echo "<meta property=\"og:image\" content=\"http://www.gravatar.com/avatar/".md5(strtolower(trim(get_the_author_meta('user_email', $author))))."?s=200&d=404\">";
		}
	?>

	<meta property="profile:first_name" content="<? the_author_meta('first_name', $author); ?>">
	<meta property="profile:last_name" content="<? the_author_meta('last_name', $author); ?>">
	<meta property="profile:username" content="<? the_author_meta('user_nicename', $author); ?>">
<?php elseif(is_home()): ?>
	<meta property="og:url" content="http://www.bupipedream.com/" />
	<meta property="og:description" content="Pipe Dream is Binghamton University's oldest and largest student-run newspaper." />
	<meta property="og:image" content="<? bloginfo('template_url'); ?>/img/og-image.png" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?= bloginfo('name'); ?> - <?= bloginfo('description'); ?>" />
<?php elseif(is_page()): ?>
	<meta property="og:url" content="<?= get_permalink() ?>" />
	<meta property="og:type" content="article" />
	<?php
		$description = htmlspecialchars( strip_tags( get_the_excerpt() ) );
		if( !$description ) $description = htmlspecialchars( get_custom_excerpt( $post->post_content, '25' ) );
	?>
	<?php $photos = get_photos( get_the_ID() ); if( $photos ): ?>
		<?foreach( $photos['photos'] as $photo ): ?>
			<meta property="og:image" content="<?= $photo['src']['large']; ?>" />
		<?endforeach;?>
	<?php else: ?>
		<meta property="og:image" content="<? bloginfo('template_url'); ?>/img/og-image.png" />
	<?php endif; ?>
<?php else: ?>
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<? bloginfo('template_url'); ?>/img/og-image.png" />
<?php endif; ?>
