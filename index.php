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
	<p>We co-create with <mark>organisations</mark>, <mark>teams</mark> and <mark>changemakers</mark> working to shift the hearts and minds of people in order to create mindset, power or structural change in complex social and environmental issues such as the climate crisis, polarisation, social unrest or crises.</p>
	<a class="button go-to" href="#contacts">Talk with us</a>
</aside>

<section class="team">
	<header>
		<h2>Our team</h2>
		<p>Our team combines researchers, campaign strategists, innovators and trainers working together to provide research and evidence-based perspectives on how to shift mindset about climate change.</p>
	</header>

	<article class="member">
		<figure>
			<img src="<?php echo get_template_directory_uri(); ?>/img/stefan-300x300.jpeg" alt="Stefan Flothmann photo">
		</figure>
		<header>
			<h3>Stefan Flothmann</h3>
			<p>Direction, Campaign Strategy, Partnerships</p>
		</header>
		<a class="button small connect" href="#">Connect</a>
	</article>
	<article class="member">
		<figure>
			<img src="<?php echo get_template_directory_uri(); ?>/img/diya-300x300.jpeg" alt="Diya Deb photo">
		</figure>
		<header>
			<h3>Diya Deb</h3>
			<p>Direction, Campaign Strategy, Org Dev, Partnerships</p>
		</header>
		<a class="button small connect" href="#">Connect</a>
	</article>
	<article class="member">
		<figure>
			<img src="<?php echo get_template_directory_uri(); ?>/img/ieva-300x300.jpeg" alt="Ieva Rozentale photo">
		</figure>
		<header>
			<h3>Ieva Rozentale</h3>
			<p>Research, Data, Prototyping, Workshops</p>
		</header>
		<a class="button small connect" href="#">Connect</a>
	</article>
	<article class="member">
		<figure>
			<img src="<?php echo get_template_directory_uri(); ?>/img/sam-300x300.jpeg" alt="Samatha Balachandran photo">
		</figure>
		<header>
			<h3>Samatha Balachandran</h3>
			<p>Communications, Engagement, Growth</p>
		</header>
		<a class="button small connect" href="#">Connect</a>
	</article>
	<article class="member">
		<figure>
			<img src="<?php echo get_template_directory_uri(); ?>/img/robin-300x300.jpeg" alt="Robin Perkins photo">
		</figure>
		<header>
			<h3>Robin Perkins</h3>
			<p>Communications, Engagement</p>
		</header>
		<a class="button small connect" href="#">Connect</a>
	</article>
	<article class="member">
		<figure>
			<img src="<?php echo get_template_directory_uri(); ?>/img/sophia-300x300.jpeg" alt="Sophia Hsiang  photo">
		</figure>
		<header>
			<h3>Sophia Hsiang</h3>
			<p>Operations and coordinations</p>
		</header>
		<a class="button small connect" href="#">Connect</a>
	</article>
</section>

<?php get_footer(); ?>
