<?php
    get_header();
    

    // WP_Query arguments
    $args = array(
        'post_type'              => 'mw-tools'
    );
    $mwtools = new WP_Query( $args );
?>
        <section class="single-mw-tools">

            <?php if ( $mwtools -> have_posts() ) : while ( $mwtools -> have_posts() ) : $mwtools -> the_post(); 
                $post_cover_text = get_post_meta( $post->ID, 'cover_meta', 1);
                if ( empty($post_cover_text) ) {
                    $post_cover_text = get_the_excerpt();
                };
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
                            <a class="button download" href="<?php echo wp_get_upload_dir()['baseurl']; ?>/tdm-infographic.pdf" download>D</a>
                            <button type="button" class="close">x</button>
                        </nav>
                    </header>
                    <figure>
                        <img src="<?php echo $post_infographic; ?>" alt="">
                    </figure>
                </section>

            <?php endif; ?>

            <?php endwhile; endif; ?>
                

        </section>
        <div class="modal-infographic">
            <img src="" alt="" />
        </div>

<?php get_footer(); ?>