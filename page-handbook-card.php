<?php /* Template Name: Page handbook card */ ?>
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

    <main <?php echo $maxWidth; ?> id="main">

        <section class="cards-slider">

            <nav class="cards-nav">
                cards nav
            </nav>

            <article class="card full">
                <header>
                    <h1>Sense, Orient, Decide</h1>
                    <figure>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/icon-sense.svg" alt="">
                    </figure>
                    <p>Use your team’s capacity to observe the crisis and speak to different stakeholders as early as possible. Do quick and creative research to map out possible crisis trajectories, and how these might create both opportunities and obstacles for your work. You can also use these to define your mindset objective.</p>
                </header>

                <section class="intro">
                    <p>Orienting yourself as early as possible is essential for identifying the right entry points to create mindset change during a crisis. John Boyle's OODA Loop (Observe- Orient- Decide- Act) is a useful guide for this. The more efficiently this process can be repeated, the faster your organisation can improve its impact. Furthermore, orienting yourself quickly after the crisis will give you an advantage over those with opposing or detrimental agendas also vying for the new mindset space. The early days of a crisis or an aftershock offer unique opportunities to create new stories and use collective experiences (see Recommendation 2 and 3); yet, only the well prepared and most agile will be able to harness them. </p>
                </section>

                <div class="tabs">

                    <section class="steps tab active">
                        <header class="tab-button">
                            <h2>How to</h2>
                        </header>

                        <article class="step">
                            <h3>Sense and observe</h3>
                            <p>We recommend starting with a short period of sensing and observing. This will give you a personal impression of the impact of the crisis on the mindsets of you and your audience and allow you to imagine possible futures emerging from the crisis.</p>
                            <p>Sensing is best done with the whole team. Each team member should start by observing their own reactions: how has the crisis impacted you? What emotions or thoughts are you feeling yourself? Which narratives or common behaviors seem to be breaking down? This will help you finetune the questions you want to ask the community and help sharpen your own awareness.</p>
                            <p>You can then start to focus on the impacted community. Begin by having as many conversations as possible, especially with your key audiences. Be careful to avoid mixing what you hear with your own experience of the crisis. You can also spend some time just observing what is happening around you and how people behave differently. Don’t shy away from using sensing work done by others, but try to focus on reliable research and avoid isolated opinions. This can also be complemented with audience research, or social media monitoring.</p>
                        </article>

						<article class="step">
                            <h3>Synthesise and imagine possible scenarios</h3>
                            <p>We recommend starting with a short period of sensing and observing. This will give you a personal impression of the impact of the crisis on the mindsets of you and your audience and allow you to imagine possible futures emerging from the crisis.</p>
                            <p>Sensing is best done with the whole team. Each team member should start by observing their own reactions: how has the crisis impacted you? What emotions or thoughts are you feeling yourself? Which narratives or common behaviors seem to be breaking down? This will help you finetune the questions you want to ask the community and help sharpen your own awareness.</p>
                            <p>You can then start to focus on the impacted community. Begin by having as many conversations as possible, especially with your key audiences. Be careful to avoid mixing what you hear with your own experience of the crisis. You can also spend some time just observing what is happening around you and how people behave differently. Don’t shy away from using sensing work done by others, but try to focus on reliable research and avoid isolated opinions. This can also be complemented with audience research, or social media monitoring.</p>
                        </article>

						<article class="step">
                            <h3>Assess regularly</h3>
                        </article>

						<article class="step">
                            <h3>Beware of aftershocks</h3>
                        </article>

                    </section>

                    <section class="tools tab">
                        <header class="tab-button">
                            <h2>Tools</h2>
                        </header>

                        <article class="tool">
                            <h3>John Boyle's OODA Loop</h3>
                            <p>The OODA loop is the cycle observe–orient–decide–act, developed by military strategist and United States Air Force Colonel John Boyd.</p>
							<a href="#">Learn more -></a>
							<!-- <figure>
								<img src="<?php echo get_template_directory_uri(); ?>/img/cover-masked-man.jpg" alt="">
							</figure> -->
                        </article>

                    </section>

                </div>

                <section class="examples">
					<header>
						<h2>Examples</h2>
					</header>

					<article class="example">
						<h3>Scenario planning during COVID-19</h3>
						<figure>
							<img src="<?php echo get_template_directory_uri(); ?>/img/cover-masked-man.jpg" alt="">
						</figure>
						<p>In 2020, several scenario models for Covid-19 emerged yet most focused on vaccine development, supply chains, economy or working habits and only a few included societal aspects like conspiracy theories, antitrust sentiment, fear or denial. However, as the crisis advanced, these “mindset factors” began to play an ever-important role in the long haul.</p>
						<a href="#">Learn more -></a>
					</article>

                </section>

                <footer>
					<header>
						<h2>Participate</h2>
					</header>

					<ul>
						<li><img src="<?php echo get_template_directory_uri(); ?>/img/icon-slack.svg" alt=""> <p>You want to get advice or exchange with fellow changemakers. <a href="#">Join the conversation on Slack -></a></p></li>
					</ul>


                </footer>

            </article>



        </section>

    </main>

    <aside class="sidebar">
        <!-- Sidenote elements  -->
    </aside>

    <?php wp_footer(); ?>

</body>
</html>
