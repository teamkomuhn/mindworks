<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_title(); ?>
        <?php the_excerpt(); ?>
        <?php

            $args = array(
                'post_type'      => 'reusable_content',
                'posts_per_page' => -1,
                'post_parent'    => $post->ID,
                'order'          => 'ASC',
                'orderby'        => 'menu_order'
            );


            $parent = new WP_Query( $args );

            if ( $parent->have_posts() ) : while ( $parent->have_posts() ) : $parent->the_post();

                // Make part from page child order
                    $page_order = $post->menu_order;
                    $part = 'Phase ' . ($page_order + 1);
                    //$post_image_url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large');
                    //$post_image = get_the_post_thumbnail( $post , 'thumbnail');
            
        ?>
                <article class="featured-post">

                    <header>

                        <label><?php echo $part; ?></label>
                        <h1><?php the_title(); ?></h1>
                        <h2><?php the_excerpt(); ?></h2>

                    </header>

                    <!--<figure style="background-image:url(<?php //echo esc_url( $post_image_url ); ?>);"><?php //echo $post_image; ?></figure>-->

                </article>

        <?php endwhile; endif; ?>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>