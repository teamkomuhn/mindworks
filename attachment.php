<section class="single-attachment">
    <?php 
        $prev_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        $image_size = apply_filters( 'wporg_attachment_size', 'full' ); 
        echo wp_get_attachment_image( get_the_ID(), $image_size ); ?>

        <?php if ( has_excerpt() ) : ?>
            <div class="caption">
                    <?php the_excerpt(); ?>
            </div>

    <?php endif; ?>
    <a href="<?php echo $prev_url;?>">close</a>
</section>