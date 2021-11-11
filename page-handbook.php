<?php /* Template Name: Page handbook */ ?>
<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
            <header>
                <h1><?php the_title(); ?></h1>
                <h2><?php echo get_the_excerpt(); ?></h2>
            </header>


            <?php
                // Get handbook sections, organized by categories
                // Get handbook cards, organized by categories

                $postcat = get_the_category( $post->ID );

                foreach( $postcat as $cat ) {
                    // WP_Query arguments
                    $args = array(
                        'post_type'      => 'page',
                        'posts_per_page' => -1,
                        'post_parent'    => $post->ID,
                        'cat'            => $cat->cat_ID,
                    );

                    // The Query
                    $cards = new WP_Query( $args );

                    if ($cat->parent != 0 && $cards->have_posts() ) {
                        $imageID = get_term_meta ( $cat->cat_ID, 'category-image-id', true );
            ?>

                        <section class="category">
                            <header>
                                <h2><?php echo $cat->name; ?></h2>
                                <p><?php echo $cat->description; ?></p>
                                <?php /* CAT IMAGE
                                    if($imageID != ''){ ?>
                                    <figure>
                                        <?php echo wp_get_attachment_image($imageID, 'medium'); ?>
                                    </figure>
                                <?php }*/ ?>
                            </header> 

                            <?php
                    
                                // The Loop
                                while ( $cards->have_posts() ) : $cards->the_post();
                            ?>
                                    <article class="card">
                                        <header>
                                            <h3><?php echo get_the_title(); ?></h3>
                                            <figure>
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/icon-sense.svg" alt="">
                                            </figure>
                                            <a class="button open" href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>">Open card</a>
                                        </header>
                                        <p><?php echo limit_text(get_the_excerpt(), 20) ?></p>
                                    </article>

                            <?php endwhile; wp_reset_postdata();  ?>
                            
                        </section>

            <?php
                    }
                } 
            ?>

        <?php endwhile; endif; ?>

<?php get_footer(); ?>
