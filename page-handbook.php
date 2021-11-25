<?php /* Template Name: Page handbook */ ?>
<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php
        $postcat = get_the_category( $post->ID );

        foreach( $postcat as $cat ) {
            if ($cat->category_parent == 0) {
                $cat_color = get_field('category_color', $cat);
                $cat_color = 'style = "--cat-color:'.$cat_color.'"';
            }
        }
    ?>

            <header <?php echo $cat_color; ?>>
                <h1 class="max-width"><?php the_title(); ?></h1>
                <h2 class="max-width"><?php print get_the_excerpt(); ?></h2>
                <figure>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon-book-black.svg" alt="">
                </figure>
                <button type="button go-to">Go to cards &darr;</button>
                <!-- <a class="button" href="#">Go to cards &darr;</a> -->
            </header>

            <div class="content max-width">
                <?php the_content(); ?>
            </div>

            <?php
            // Get handbook sections, organized by categories
            // Get handbook cards, organized by categories

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

                $subcat_color = get_field('category_color', $cat);

                if (!empty($cat->parent) && !empty($cat_color) && $cards->have_posts() ) {
                    $imageID = get_term_meta ( $cat->cat_ID, 'category-image-id', true );

                    $subcat_color = 'style = "--subcat-color:'.$subcat_color.'"';
            ?>

            <section class="category" id="<?php echo $cat->slug; ?>" <?php echo $subcat_color; ?>>
                <header>
                    <h2><?php print $cat->name; ?></h2>
                    <p><?php print $cat->description; ?></p>
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

                <?php endwhile; wp_reset_postdata(); ?>

            </section>

            <?php // Closing if + foreach
                    }
                }
            ?>

            <section class="category special">
                <header>
                    <h2>Special cards</h2>
                    <p></p>
                </header>

                <article class="card">
                    <header>
                        <h3>Special card 1</h3>
                        <figure>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/icon-sense.svg" alt="">
                        </figure>
                        <a class="button open" href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>">Open card</a>
                    </header>
                    <p>Orienting yourself quickly is crucial in any crisis - observe the crisis unfolding, speak to different audiences and do quick ...</p>
                </article>
                <article class="card">
                    <header>
                        <h3>Special card 2</h3>
                        <figure>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/icon-sense.svg" alt="">
                        </figure>
                        <a class="button open" href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>">Open card</a>
                    </header>
                    <p>Orienting yourself quickly is crucial in any crisis - observe the crisis unfolding, speak to different audiences and do quick ...</p>
                </article>
            </section>

        <?php endwhile; endif; ?>

<?php get_footer(); ?>
