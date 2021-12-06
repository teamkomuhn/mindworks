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
    $cat_specialcard = get_cat_ID('Special card');
    $cat_global = get_cat_ID('Global');
    $cat_card = get_cat_ID('Card');

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
            <p><?php print $cat->description; ?></p>
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

    <?php // GET SPECIAL CARDS
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'category__and'  => array($cat_specialcard, $cat_card)
    );

    $cards_global = new WP_Query( $args );

    if ( $cards_global->have_posts() ) :
    ?>

    <section class="category special">
        <header>
            <h2>Special Cards</h2>
        </header>

        <?php while ( $cards_global->have_posts() ) : $cards_global->the_post();?>

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

        <?php endwhile; ?>

    </section>

<?php endif; ?>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>
