<!doctype html>
<html class="no-js" lang="en">

<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-063HXFCJKX"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-063HXFCJKX');
	</script>

	<meta charset="utf-8">

	<?php wp_head(); ?>

	<link rel='shortcut icon' href='/img/favicon.ico' type='image/x-icon' />

	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta name="author" content="Komuhn">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/main.css">
	<link rel="stylesheet" media="screen and (min-width: 768px)" href="<?php echo get_stylesheet_directory_uri(); ?>/css/full.css">

</head>

<body>
	<!--[if IE]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->
	<?php
		if (is_home() ) {
			$logoColor = "white";
			$bgColor = "bgBlack";
		} else {
			$logoColor = "black";
			$bgColor = "bgWhite";
		}
	?>
	<header class="main-header <?php echo $bgColor; ?>">
		<div class="identity">
			<h1 class="logo">
				<a class="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" alt="Logo">
					<span><?php bloginfo('name'); ?></span>
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo-<?php echo $logoColor; ?>.svg" alt="<?php bloginfo('name'); ?>" />
				</a>
			</h1>
		</div>

		<!--<nav class="main-nav" id="main-nav">
			<?php /*
				wp_nav_menu( array(
					'menu'            => 'top-menu',
					'container'       => ''
				));
			*/?>
		-->
		</nav>
	</header>
    <main>
