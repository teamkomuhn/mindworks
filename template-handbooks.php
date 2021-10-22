<?php /* Template Name: Page Handbooks */ ?>

<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php the_excerpt(); ?>
        <?php the_content(); ?>

        <?php
            $postcat = get_the_category( $post->ID );

            foreach( $postcat as $cat ) {
                if ($cat->parent != 0) {
                    $imageID = get_term_meta ( $cat->cat_ID, 'category-image-id', true );
        ?>

                    <article>
                        <header>
                            <h1><?php echo $cat->name; ?></h1>
                            <p><?php echo $cat->description; ?></p>
                            <figure>
                                <img src="<?php echo wp_get_attachment_image($imageID, 'medium'); ?>"/>
                            </figure>
                        </header> 
                        
                    </article>

        <?php
                }
            } 
        ?>


    <?php endwhile; endif; ?>

<?php get_footer(); ?>
