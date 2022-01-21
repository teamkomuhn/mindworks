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
	<?php enqueue_template_files(); // TODO: Is this neede here? ?>
	<!--[if IE]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->
	<?php // TODO: Find a permanent solution for this
	$old_page_TDMindex = get_page_by_path('thedisruptedmind');
	$old_page_TDM1 = get_page_by_path('thedisruptedmind/scientific-insights/');

	if ( is_page( $old_page_TDMindex->ID ) || is_page( $old_page_TDM1->ID ) ) {
		$maxWidth = "class='max-width-pad margin-auto'";
	} else if ( !is_home() ) {
		$maxWidth = "class='max-width margin-auto'";
	}
	?>

	<?php // Make header full or compact depending on page

	$compactHeader = '';

	if ( is_page_template( 'page-handbook-card.php' ) ) {
		$compactHeader = 'compact';
	}

	?>

	<header class="main-header <?php echo $compactHeader; ?>">
		<a class="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name') ?>">
			<span><?php bloginfo('name') ?></span>
		</a>

		<button class="button nav open" type="button"><span>Open</span></button>

		<nav class="main-nav">
			<!-- <?php //global $post; if ( is_page() && $post->post_parent ) : ?>
				<a class="button back-to-index" href="<?php //echo get_permalink( $post->post_parent ); ?>" title="<?php echo get_the_title( $post->post_parent ); ?>">← <?php //print get_post_field( 'post_title', $post_id, 'raw' ); ?></a>
			<?php //endif; ?> -->

			<a class="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name') ?>">
				<span><?php bloginfo('name') ?></span>
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo-white.svg" alt="<?php bloginfo('name'); ?>" />
			</a>

			<ul>
				<li><a href="<?php echo home_url(); ?>">Home</a></li>
				<li>
					<a href="<?php echo home_url('/thedisruptedmind/'); ?>">The Disrupted Mind</a>
					<ul>
						<li><a href="<?php echo home_url('/thedisruptedmind/scientific-insights'); ?>">Scientific Insights</a></li>
						<li><a href="<?php echo home_url('/thedisruptedmind/the-crisis-timeline'); ?>">The Crisis Timeline</a></li>
						<li><a href="<?php echo home_url('/thedisruptedmind/the-crisis-handbook'); ?>">The Crisis Handbook</a></li>
					</ul>
				</li>
				<!-- <li><a href="#">About</a></li> -->
				<li><a href="#contacts">Contacts</a></li>
			</ul>

			<div class="so-me">
                <a href="https://www.linkedin.com/company/mindworks-lab/" class="icon icon-linkedin" alt="Mindworks Linkedin"></a>
                <a href="https://twitter.com/mindworkslab" class="icon icon-twitter" alt="Mindworks Twitter"></a>
            </div>

			<button class="button nav close" type="button"><span>Close</span></button>
		</nav>

	</header>

	<main <?php echo $maxWidth; ?> id="main">
