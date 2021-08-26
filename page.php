<?php
    get_header();

    if ( have_posts() ) : while ( have_posts() ) : the_post();


        if ( is_page() && $post->post_parent ) { //subpage

?>
            <section class="single-mw-tools">
                
                <?php
                    $post_cover_text = get_post_meta( $post->ID, 'cover_meta', 1);
                    $post_style = 'style="background-image:url(' . get_the_post_thumbnail_url($post->ID) . ')"';
                ?>
                    <header class="cover" <?php print $post_style; ?>>
                        <div class="cover-content">
                            <h1><?php the_title(); ?></h1>
                            <h2><?php print $post_cover_text; ?></h2>
                            <span class="date"><?php the_date( 'F d, Y' ); ?></span>
                            <span class="readtime" id="time"></span> min read
                        </div>
                    </header>

                    <div class="content" id="content">
                        <?php the_content(); ?>
                    </div>

                    <?php
                        $post_infographic = get_post_meta( $post->ID, 'infographic_meta', 1);
                        if ($post_infographic) : ?>

                        <section class="infographic popup">
                            <header>
                                <h1>Infographic</h1>
                                <nav>
                                    <a class="button download" href="<?php echo wp_get_upload_dir()['baseurl']; ?>/tdm-infographic.pdf" download>Download</a>
                                    <button type="button" class="close">Close</button>
                                </nav>
                            </header>
                            <figure>
                                <img src="<?php echo $post_infographic; ?>" alt="">
                            </figure>
                        </section>

                <?php endif; ?>

            </section>

        <?php } else { //index page ?> 

            <section class="page-index">

                 <?php
                    $post_cover_context = get_post_meta( $post->ID, 'cover_meta_context_tag', 1);
                    $post_cover_text = get_post_meta( $post->ID, 'cover_meta_text', 1);

                    $args = array(
                        'post_type'      => 'page',
                        'posts_per_page' => -1,
                        'post_parent'    => $post->ID,
                        'order'          => 'ASC',
                        'orderby'        => 'menu_order',
                        'post_status'    => array('publish', 'pending', 'draft')
                    );


                    $parent = new WP_Query( $args );
                ?>

                <header class="cover">
                    <div class="cover-content">
                        <h1>
                            <span><?php print $post_cover_context; ?></span>
                            <?php the_title(); ?>
                        </h1>
                        <h2><?php print $post_cover_text; ?></h2>
                    </div>
                </header>

                <div class="content" id="content">

                    <?php if ( $parent->have_posts() ) : ?>

                        <?php
                            while ( $parent->have_posts() ) : $parent->the_post(); 
                        
                                $post_label = get_post_meta( $post->ID, 'label_meta', 1);
                                $post_cover_text = get_post_meta( $post->ID, 'cover_meta_text', 1);
                                $post_image_url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large');
                                $post_image = get_the_post_thumbnail( $post , 'thumbnail');

                        ?>

                            <article class="featured-post">

                                <header>

                                    <label><?php echo $post_label; ?></label>
                                    <h1><?php echo get_the_title($post->post_parent) . ': ' . get_the_title(); ?></h1>
                                    <span class="date"><?php the_date( 'F d, Y' ); ?></span>
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

    <?php } endwhile; endif; ?>

<?php get_footer(); ?>
