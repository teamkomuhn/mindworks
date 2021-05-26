<?php
    /* Template Name: Tool page */
    get_header();
?>
    <main>
        <section class="tool">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php the_content(); endwhile; endif; ?>
        </section>
	</main>

<?php get_footer(); ?>
