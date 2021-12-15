<?php /* Template Name: Page Index */ ?>

<?php
    get_header();

    if ( have_posts() ) : while ( have_posts() ) : the_post();

?>

            <section class="page-index">

                 <?php

                    $args = array(
                        'post_type'      => 'page',
                        'posts_per_page' => -1,
                        'post_parent'    => $post->ID,
                        'order'          => 'ASC',
                        'orderby'        => 'menu_order',
                        'post_status'    => array('publish', 'pending')
                    );


                    $parent = new WP_Query( $args );
                ?>

                <header class="cover">
                    <div class="cover-content">
                        <h1>
                            <span><?php echo get_the_excerpt(); ?></span>
                            <?php the_title(); ?>
                        </h1>
                        <?php the_content(); ?>
                    </div>
                </header>

                <div class="content" id="content">

                    <?php if ( $parent->have_posts() ) : ?>

                        <?php
                            while ( $parent->have_posts() ) : $parent->the_post();

                            // Make part from page child order
                                $page_order = $post->menu_order;
                                $part = 'Part ' . ($page_order + 1);
                                //$post_label = get_post_meta( $post->ID, 'label_meta', 1);
                                $post_cover_text = get_the_excerpt();
                                $post_image_url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large');
                                $post_image = get_the_post_thumbnail( $post , 'thumbnail');
                                if (get_post_status() == 'pending') {
                                    $post_pending = 'pending';
                                } else {
                                    $post_pending = '';
                                }
                        ?>

                            <article class="featured-post <?php echo $post_pending; ?>">

                                <header>

                                    <label><?php echo $part; ?></label>
                                    <h1><?php echo get_the_title(); ?></h1>
                                    <span class="date"><?php echo get_the_date( 'F d, Y' ); ?></span>
                                    <!--<span class="readtime" id="time"></span> min read-->
                                    <?php if ($post_cover_text != '') { echo '<p>'.$post_cover_text.'</p>'; } ?>
                                    <a href="<?php the_permalink(); ?>" class="button black" title="<?php the_title(); ?>">Read</a>
                                </header>

                                <figure style="background-image:url(<?php echo esc_url( $post_image_url ); ?>);"><?php echo $post_image; ?></figure>

                            </article>

                        <?php endwhile; ?>

                    <?php endif; wp_reset_postdata(); ?>

                </div>

            </section>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>
