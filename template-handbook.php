<?php /* Template Name: Page Handbook @andrea */ ?>

<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <!-- // TEST: Section to print fetched cards content -->
        <section class="pop-up"></section>

        <?php
            // Page cover - introducing the handbook
            the_title();
            the_excerpt();
            the_content();
        ?>

        <?php
            // Get handbook sections, organized by categories
            // Get handbook cards, organized by categories

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
                                'post_type'      => 'page',
                                'posts_per_page' => -1,
                                'post_parent'    => $post->ID,
                                'cat'            => $cat->cat_ID,
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
                                                <li><a href="#" class="card" data-cat="<?php echo $cat->cat_ID; ?>" id="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?><?php echo get_the_content(); ?></a></li>
                                    <?php
                                        endwhile; 
                                    ?>
                                </ul>
                        <?php endif; wp_reset_postdata(); ?>
                        
                    </article>

        <?php
                }
            } 
        ?>


    <?php endwhile; endif; ?>

<?php get_footer(); ?>
