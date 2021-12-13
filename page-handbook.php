<?php /* Template Name: Page handbook */ ?>
<?php get_header(); ?>

    <?php
    if ( have_posts() ) : while ( have_posts() ) : the_post();
        $postcat = get_the_category( $post->ID );

        foreach( $postcat as $cat ) {
            if ($cat->category_parent == 0) {
                $cat_color = get_field('category_color', $cat);
                if(!empty($cat_color)) {
                    $cat_color = 'style = "--cat-color:'.$cat_color.'"';
                }
            }
        }
    ?>

    <header <?php echo $cat_color; ?>>
        <h1 class="max-width"><?php the_title(); ?></h1>
        <h2 class="max-width"><?php print get_the_excerpt(); ?></h2>
        <figure>
            <img src="<?php echo get_template_directory_uri(); ?>/img/icon-book-black.svg" alt="">
        </figure>
        <button class="button go-to">Go to cards &darr;</button>
    </header>

    <div class="content max-width">
        <?php the_content(); ?>
    </div>

    <?php
    $cat_card = get_cat_ID('Card');
    $cat_getting_prepared_card = get_cat_ID('Getting prepared');

    // Get handbook sections, organized by categories
    // Get handbook cards, organized by categories

    foreach( $postcat as $cat ) {
        // WP_Query arguments
        $args = array(
            'post_type'      => array('page', 'post'),
            'posts_per_page' => -1,
            'post_parent'    => $post->ID,
            'cat'            => $cat->cat_ID,
            'orderby'        => 'menu_order',
            'order'          => 'ASC'
        );

        // The Query
        $cards = new WP_Query( $args );

        $subcat_color = get_field('category_color', $cat);

        if (!empty($cat->parent) && $cards->have_posts() ) {
            $imageID = get_term_meta ( $cat->cat_ID, 'category-image-id', true );
            if (!empty($subcat_color)) {
                $subcat_color = 'style = "--subcat-color:'.$subcat_color.'"';
            }
    ?>

    <section class="category" id="<?php echo $cat->slug; ?>" <?php echo $subcat_color; ?>>
        <header>
            <h2><?php print $cat->name; ?></h2>
            <?php print $cat->description; ?>
        </header>

        <?php
        // The Loop
        while ( $cards->have_posts() ) : $cards->the_post();
            $thumbnail_id   = get_post_thumbnail_id( $post->ID );
            $card_image     = wp_get_attachment_image_src( $thumbnail_id );
            $card_image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        ?>

        <article class="card">
            <header>
                <h3><?php echo get_the_title(); ?></h3>
                <?php if ( !empty( $thumbnail_id ) ) : ?>
                    <figure>
                        <img src="<?php echo $card_image[0]; ?>" alt="<?php echo $card_image_alt; ?>">
                    </figure>
                <?php endif; ?>
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

    <?php // GET GETTING PREPARED CARDS
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'category__in'   => $cat_getting_prepared_card
    );

    $cards_getting_prepared = new WP_Query( $args );

    if ( $cards_getting_prepared->have_posts() ) :
    ?>

    <section class="category special">
        <header>
            <h2><?php print get_cat_name($cat_getting_prepared_card); ?></h2>
            <?php print category_description($cat_getting_prepared_card); ?>
        </header>

        <?php
        while ( $cards_getting_prepared->have_posts() ) : $cards_getting_prepared->the_post();
            $thumbnail_id = get_post_thumbnail_id( $post->ID );
            $card_image = wp_get_attachment_image_src( $thumbnail_id );
            $card_image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        ?>

        <article class="card">
            <header>
                <h3><?php echo get_the_title(); ?></h3>
                <?php if ( !empty( $thumbnail_id ) ) : ?>
                    <figure>
                        <img src="<?php echo $card_image[0]; ?>" alt="<?php echo $card_image_alt; ?>">
                    </figure>
                <?php endif; ?>
                <a class="button open" href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>">Open card</a>
            </header>
            <p><?php echo limit_text(get_the_excerpt(), 20) ?></p>
        </article>

        <?php endwhile; ?>

    </section>

    <?php endif; ?>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>
