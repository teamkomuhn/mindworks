<?php get_header(); ?>

    <section class="page-scientific-insights">
        
        <?php

            $post_label = get_post_meta( $post->ID, 'label_meta', 1);
            $post_cover_text = get_post_meta( $post->ID, 'cover_meta', 1);
            $post_style = 'style="background-image:url(' . get_the_post_thumbnail_url($post->ID) . ')"';
        ?>
            <!--<header class="cover" <?php //print $post_style; ?>>
                <div class="cover-content">
                    <h1><?php// echo get_the_title($post->post_parent); ?></h1>
                    <span class="date"><?php //the_date( 'F d, Y' ); ?></span>
                    <span class="readtime" id="time"></span> min read
                </div>
            </header>-->

            <div class="content" id="content">
                <!--<label><?php echo $post_label; ?></label>-->
                 <!--<h2 class="title"><?php //the_title(); ?></h2>-->
                <!--<h3 class="excerpt"><?php // print $post_cover_text; ?></h3>-->
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

<?php get_footer(); ?>