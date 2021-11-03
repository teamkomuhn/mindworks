<?php /* Template Name: Page handbook */ ?>
<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php //the_content(); ?>
    <?php endwhile; endif; ?>

    <header>
        <h1>The crisis handbook</h1>
        <h2>A toolkit for changemakers</h2>
    </header>

    <section class="category">
        <header>
            <h2>The early phases of a crisis</h2>
        </header>

        <article class="card">
            <header>
                <h3>Sense, Orient, Decide</h3>
                <figure>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon-sense.svg" alt="">
                </figure>
                <button class="open" type="button" name="button">Open card</button>
            </header>
            <p>Use your team’s capacity to observe the crisis and speak to different stakeholders as early as possible...</p>
        </article>

        <article class="card">
            <header>
                <h3>Normalise new experiences and thoughts</h3>
                <figure>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon-sense.svg" alt="">
                </figure>
                <button class="open" type="button" name="button">Open card</button>

            </header>
            <p>Use your team’s capacity to observe the crisis and speak to different stakeholders as early as possible...</p>
        </article>

        <article class="card">
            <header>
                <h3>Card 3</h3>
                <figure>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon-sense.svg" alt="">
                </figure>
                <button class="open" type="button" name="button">Open card</button>

            </header>
            <p>Use your team’s capacity to observe the crisis and speak to different stakeholders as early as possible...</p>
        </article>


    </section>

<?php get_footer(); ?>
