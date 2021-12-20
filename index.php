<?php get_header(); ?>

<section class="about">
	<header>
	<div class="container">
		<h1 class="logo">
			<span><?php bloginfo('name') ?></span>
			<img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.svg" alt="<?php bloginfo('name'); ?>" />
		</h1>
		<h2><span>Giving changemakers</span>
			<span>the power to understand </span>
			<span>how the human mind works.</span>
		</h2>
		<h3>Mindworks is an innovation lab currently based in Greenpeace East Asia that researches cognitive and social sciences and translates insights into practical tools built for changemakers. We focus on audience research, campaign strategy and engagement design.</h3>
	</div>
	</header>
</section>

<section class="latest-work">
	<header>
		<h1>Check our <strong>latest work</strong></h1>
	</header>

	<div class="row column">
		<h2>The <br>Disrupted <br>Mind</h2>
		<figure>
			<img src="<?php echo get_template_directory_uri(); ?>/img/cover-masked-man.jpg" alt="Masked man alone looking outside">
		</figure>
	</div>

	<div class="row column">
		<h3>How the mind works during and after a crisis and what we can learn to create change.</h3>
		<a class="button" href="<?php echo home_url( '/thedisruptedmind/' ); ?>">Learn more -></a>
	</div>

</section>

<aside class="cta">
	<p>Mindworks co-creates with <mark>organisations</mark>, <mark>teams</mark> and <mark>changemakers</mark> working to shift the hearts and minds of people in order to create mindset, power or structural change in complex social and environmental issues such as the climate crisis, polarisation, social unrest or crises.</p>
	<a class="button go-to" href="#contacts">Talk with us</a>
</aside>

<section class="team">
	<h2>Our mission</h2>
	<p>We support changemakers working with communities, societies and decision makers to catalyse cultural change by shifting people’s hearts and minds. We leverage our team’s expertise and passion for the human mind to help changemakers develop innovative strategies, tactics and tools to understand and engage their audience in order to change the way they feel, think and act. </p>
</section>

<?php get_footer(); ?>
