<!doctype html>
<html class="no-js" lang="en">

<head>
	<!-- Global site tag (gtag.js) - Google Analytics
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-063HXFCJKX"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-063HXFCJKX');
	</script> -->

	<meta charset="utf-8">
	<?php global $post;
		if ( is_page() && $post->post_parent ) {
			echo '<title>' . strip_tags(get_the_title( $post )) . ' | ' . strip_tags(get_the_title( $post->post_parent )) . ' - Mindworks</title>';
		} else {
			echo '<title>' . strip_tags(get_the_title( $post )) . ' - Mindworks</title>';
		}
	?>

	<?php wp_head(); ?>

	<link rel='shortcut icon' href='<?php echo get_template_directory_uri(); ?>/img/favicon.ico' type='image/x-icon' />

	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta name="author" content="Komuhn">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body <?php body_class(); ?>>
	<?php enqueue_template_files(); ?>
	<!--[if IE]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->
	<?php

		if ( home_url() == "https://komuhn.co/dev/mindworks") {
			$oldPagesID = is_page( array(8,10) );
		} else if (home_url() == "https://testing.mindworkslab.org") {
			$oldPagesID = is_page( array(13,11) );
		} else if (home_url() == "https://mindworkslab.org") {
			$oldPagesID = is_page( array(188,193) );
		} else {
			$oldPagesID = is_page( array(125,2) ); //@andrea local
		}

		if ( is_home() ) {
			$logoColor = "white";
			$bgColor = "bgBlack";
			// $maxWidth = "class="."maxWidth"."";
		//} else if ( is_page( array(8,10) ) ) {
		} else if ( $oldPagesID ) {
			$logoColor = "black";
			$bgColor = "bgWhite";
			$maxWidth = "style='max-width:calc(60rem + (var(--spacing-x)*2));'";
		} else {
			$logoColor = "black";
			$bgColor = "bgWhite";
			$maxWidth = "";
		}
	?>

	<header class="main-header <?php echo $bgColor; ?>">
		<div class="identity">
			<?php if(is_home()) { echo '<h1 class="logo">'; } else { echo '<a class="logo" href="' . home_url() . '" title="' . get_bloginfo('name') . '" alt="' . get_bloginfo('name') . ' Logo">'; } ?>
					<span><?php bloginfo('name'); ?></span>
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo-<?php echo $logoColor; ?>.svg" alt="<?php bloginfo('name'); ?>" />
			<?php if(is_home()) { echo '</h1>'; } else { echo '</a>'; } ?>
		</div>

		<!--<nav class="main-nav" id="main-nav">
			<?php /*
				wp_nav_menu( array(
					'menu'            => 'top-menu',
					'container'       => ''
				));
			*/?>
		</nav>-->

		<nav class="main-nav">
			<?php global $post; if ( is_page() && $post->post_parent ) : ?>
				<a class="button back-to-index" href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php echo get_the_title( $post->post_parent ); ?>">← <?php //print get_post_field( 'post_title', $post_id, 'raw' ); ?></a>
			<?php endif; ?>
		</nav>

	</header>

    <main <?php echo $maxWidth; ?> id="main">
