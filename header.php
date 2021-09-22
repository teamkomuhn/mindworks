<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<?php global $post;
		if ( is_page() && $post->post_parent ) {
			echo '<title>' . strip_tags(get_the_title( $post )) . ' | ' . strip_tags(get_the_title( $post->post_parent )) . ' - Mindworks</title>';
		} elseif ( is_home() ) {
			echo '<title>Mindworks | ' . strip_tags(get_bloginfo( 'description' )) . '</title>';
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

		$old_page_TDMindex = get_page_by_path('thedisruptedmind');
		$old_page_TDM1 = get_page_by_path('thedisruptedmind/scientific-insights/');

		if ( is_page( $old_page_TDMindex->ID ) || is_page( $old_page_TDM1->ID ) ) {
			$maxWidth = "style='max-width:calc(60rem + (var(--spacing-x)*2));'";
		} else {
			$maxWidth = "";
		}

	?>

	<header class="main-header">

		<?php if ( is_home() ) : ?>
			<h1 class="logo">
				<span><?php bloginfo('name') ?></span>
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.svg" alt="<?php bloginfo('name'); ?>" />
			</h1>
		<?php else : ?>
			<a class="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name') ?>">
				<span><?php bloginfo('name') ?></span>
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.svg" alt="<?php bloginfo('name'); ?>" />
			</a>
		<?php endif; ?>

		<nav class="main-nav">
			<?php global $post; if ( is_page() && $post->post_parent ) : ?>
				<a class="button back-to-index" href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php echo get_the_title( $post->post_parent ); ?>">← <?php //print get_post_field( 'post_title', $post_id, 'raw' ); ?></a>
			<?php endif; ?>
		</nav>

	</header>

    <main <?php echo $maxWidth; ?> id="main">
