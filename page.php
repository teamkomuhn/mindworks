<?php get_header(); ?>

<body>

    <main>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
    </main>

<?php get_footer(); ?>
