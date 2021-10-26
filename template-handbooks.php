<?php /* Template Name: Page Handbooks */ ?>

<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php
            the_title();
            the_excerpt();
            the_content();
        ?>

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
                                <?php echo wp_get_attachment_image($imageID, 'medium'); ?>
                            </figure>
                        </header> 

                        <?php
			                // WP_Query arguments
                            $args = array(
                                'post_type'      => 'cards',
                                'posts_per_page' => -1,
                                'cat'            =>  $cat->cat_ID,
                            );

                            // The Query
                            $cards = new WP_Query( $args );
                
                            // The Loop
                            if ( $cards->have_posts() ) :
                        ?>
                                <ul>
                                    <?php
                                        while ( $cards->have_posts() ) : $cards->the_post(); 
                                    ?>
                                                <li><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                                    <?php
                                        endwhile; 
                                    ?>
                                </ul>
                        <?php endif; ?>
                        
                    </article>

        <?php
                }
            } 
        ?>


    <?php endwhile; endif; ?>

<?php get_footer(); ?>
