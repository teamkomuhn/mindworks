<?php /* Template Name: Page handbook card */ ?>
<!doctype html>
<?php get_header(); ?>

            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();

            $postcat = get_the_category( $post->ID );
            foreach( $postcat as $cat ) {
                $cat_color = get_field('category_color', $cat);
                if (!empty($cat->parent)) {
                    $cat_color = 'style = "--cat-color:'.$cat_color.'"';
                }
            }
            ?>

            <section class="cards-slider" <?php echo $cat_color; ?>>

                <?php
                    $current_cardID = get_the_ID();

                    $cat_card = get_cat_ID('Card');
                    $cat_getting_prepared_card = get_cat_ID('Getting prepared');

                    $cards_handbook = get_posts(array(
                        'fields'         => 'ids',
                        'post_type'      => 'page',
                        'posts_per_page' => -1,
                        'child_of'       => $post->post_parent,
                        'category__in'   => $cat_card
                    ));

                    $cards_getting_prepared   = get_posts(array(
                        'fields'         => 'ids',
                        'post_type'      => 'page',
                        'posts_per_page' => -1,
                        'cat'            => array($cat_getting_prepared_card)
                    ));

                    $cardslist = array_merge($cards_handbook, $cards_getting_prepared);

                    $firstID   = $cardslist[0];
                    $lastID    = end($cardslist);
                    $total     = count($cardslist);

                    $current   = array_search(get_the_ID(), $cardslist);
                    $prevID    = $cardslist[$current-1];
                    $nextID    = $cardslist[$current+1];

                    if( $current == get_the_ID($post) ){
                        $active_class = 'class="active"';
                    } else {
                        $active_class = '';
                    }

                    if( $cardslist > 1 ) {

                        if( $post->post_parent ) {
                            $post_parent_link   = get_permalink($post->post_parent);
                        } else {
                            //TODO: Change the way we're getting this post parent page when we're in a getting prepared card
                            $post_parent_link   = get_permalink( get_page_by_title( 'The Crisis Handbook' ) );
                        }
                ?>

                <nav class="cards-nav">
                    <a href="<?php echo $post_parent_link; ?>" title="All cards"><span>All cards</span></a>

                    <?php if (!empty($prevID)) {
                    ?>
                            <a class="previous" href="<?php echo get_permalink($prevID); ?>" title="Previous card">&larr;</a>
                    <?php } else { ?>
                            <a class="previous" href="<?php echo get_permalink($lastID); ?>" title="Previous card">&larr;</a>
                    <?php } ?>

                    <?php
                        // the main query
                        $query_cardslist = new WP_Query(array(
                            'post__in'          => $cardslist,
                            'post_type'         => 'page',
                            'posts_per_page'    => -1,
                            'orderby'           => 'menu_order',
                            'order'             => 'ASC'
                        ));

                        if ( $query_cardslist->have_posts() ) :

                            $i = 1;
                            while ( $query_cardslist->have_posts() ) : $query_cardslist->the_post();
                                if($current_cardID == get_the_ID()){ $active_class = 'class="active"'; } else { $active_class = '';  }
                    ?>

                    <a <?php echo $active_class; ?> href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo $i++; ?></a>

                    <?php endwhile; wp_reset_postdata(); endif; ?>

                    <?php if ($lastID == $current_cardID) { ?>
                            <a class="next" href="<?php echo get_permalink($firstID); ?>" title="Next card">&rarr;</a>
                    <?php } else if (!empty($nextID)) { ?>
                            <a class="next" href="<?php echo get_permalink($nextID); ?>" title="Next card">&rarr;</a>
                    <?php } else { ?>
                            <a class="next" href="<?php echo get_permalink($firstID); ?>" title="Next card">&rarr;</a>
                    <?php } ?>
                </nav>

                <?php } ?>

                <article class="card full">
                    <header>
                        <h1><?php the_title(); ?></h1>

                        <?php
                            $card_image = get_field('icon');
                            $card_image = $card_image['url'];
                            $card_image_alt = $card_image['alt'];

                            if(!empty($card_image)) :
                        ?>

                        <figure class="icon">
                            <img src="<?php echo $card_image; ?>" alt="<?php echo $card_image_alt; ?>">
                        </figure>

						<?php endif; ?>

                        <?php the_excerpt(); ?>

                        <?php
                            $companion_image = get_field('companion_image');
                            $companion_url = get_field('companion_url');
                            $companion_overlay = get_field('companion_overlay');

                            if($companion_overlay == 1) {
                                $companion_button = '<button class="open companion" type="button"><span>Open</span></button>';
                            } else {
                                $companion_button = '<a class="button open" href="'.$companion_url.'">Open</a>';
                            }

                            if(!empty($companion_image)) {
                                $companion_image_alt = $companion_image['alt'];

                                if(!empty($companion_image_alt)) {
                                    $companion_image_alt = 'alt="'.$companion_image_alt.'"';
                                }
                        ?>

                        <div class="companion-content">
                            <figure class="companion-image">
                                <img src="<?php echo esc_url($companion_image['url']); ?>" <?php echo $companion_image_alt; ?>>
                            </figure>
                            <?php print $companion_button; ?>
                        </div>

                        <aside class="slide companion" aria-hidden="true">
                            <div class="buttons">
                                <!-- <a class="button download" href="" download>Download</a> -->
                                <button class="close open companion" type="button">Close</button>
                            </div>
                            <figure>
                                <img src="<?php echo $companion_url ?>">
                            </figure>
                        </aside>

						<?php } ?>

                    </header>

                    <?php
                        $content = get_the_content();
                        if(!empty($content)) {
                            $expandable_class   = 'container-expandable';
                        } else {
                            $expandable_class   = '';
                        }
                    ?>
                    <section class="intro">
						<header class="card-meta">

                            <?php
                            if( have_rows('repeater_card_meta') ):
                            while( have_rows('repeater_card_meta') ) : the_row();

                            $label       = get_sub_field('card_meta_label');
                            $description = get_sub_field('card_meta_description');
                            ?>

							<p><strong><?php echo $label; ?>:</strong> <?php echo $description; ?></p>

                            <?php
                                    endwhile;
                                endif;

                                $content_size = count_content_words($content);

                                if( !empty($content) && $content_size > 100 ){
                            ?>

							<button class="button-expandable" type="button"><span>Read more &darr;</span></button>

                            <?php } ?>
						</header>

                        <?php $content_size = count_content_words($content);

                        if( !empty($content) && $content_size > 100 ){
                        ?>
                        <div class="container-expandable">
                            <button class="button-expandable" type="button"><span>Read more &darr;</span></button>

                            <div class="content expandable">
                                <?php echo $content; ?>
                            </div>
                        </div>

                        <?php } else { ?>
                            <div class="content">
                                <?php echo $content; ?>
                            </div>
                        <?php } ?>
                    </section>

                    <?php
                    $card_steps = get_field('repeater_card_steps');
                    $card_tools = get_field('repeater_card_steps');
                    if ($card_steps > 0 || $card_tools > 0) :
                    ?>

                    <div class="tabs">
                        <?php if ( have_rows('repeater_card_steps') ) : ?>

                        <section class="steps tab active">
                            <header class="tab-button">
                                <h2>How to</h2>
                            </header>

                            <div class="container">
                                <?php
                                while ( have_rows('repeater_card_steps') ) : the_row();

                                $title      = get_sub_field('card_step_title');
                                $content    = get_sub_field('card_step_content');
                                $tools      = get_sub_field('card_step_tools');
                                ?>

                                <article class="step container-expandable">
                                    <h3 class="title-expandable"><?php print $title; ?></h3>

                                    <?php if( !empty($content) ): ?>
                                        <button class="button-expandable"><span>&darr;</span></button>

                                        <div class="content expandable">
                                            <?php print $content; ?>

                                            <?php // GET RELATED TOOLS
                                            if ( have_rows('repeater_card_step_tools') ):
                                            ?>
                                            <aside class="related tools">
                                                <h4>Related tools</h4>
                                                <ul>

                                                    <?php
                                                    while ( have_rows('repeater_card_step_tools') ) : the_row();
                                                    $post_object = get_sub_field('card_step_tool');

                                                    if( $posts ):
                                                    $post = $post_object;
                                                    setup_postdata( $post );

                                                    $title          = get_the_title( $post->ID );
                                                    $slug           = sanitize_title( $title );
                                                    $excerpt        = get_the_excerpt( $post->ID );
                                                    ?>

                                                    <li class="related tool">
                                                        <h5><?php print $title; ?></h5>

                                                        <!-- <p><?php //print $excerpt; ?></p> -->

                                                        <a href="?tool=<?php echo $slug; ?>">Go to tool &rarr;</a>
                                                    </li>

                                                <?php  wp_reset_postdata(); endif; endwhile; ?>
                                                </ul>
                                            </aside>

                                            <?php endif; ?>
                                        </div>

                                    <?php endif; ?>

                                </article>

                                <?php endwhile; ?>
                            </div>
                        </section>

                        <?php endif;
                        if( have_rows('repeater_card_tools') ): ?>

                        <section class="tools tab" id="tools">
                            <header class="tab-button">
                                <h2>Tools</h2>
                            </header>

                            <div class="container">
                                <?php
                                while( have_rows('repeater_card_tools') ) : the_row();
                                $post_object = get_sub_field('card_tool');

                                if( $posts ):
                                $post = $post_object;
                                setup_postdata( $post );

                                $title          = get_the_title( $post->ID );
                                $slug           = sanitize_title( $title );
                                $excerpt        = get_the_excerpt( $post->ID );
                                $link           = get_sub_field('card_tool_link');
                                ?>

                            <article class="tool" id="tool-<?php echo $slug; ?>">
                                <h3><?php print $title; ?></h3>
                                <p><?php print $excerpt; ?></p>

                                <?php if( !empty($link) ) : ?>
                                <a href="<?php echo esc_url($link); ?>">Learn more &rarr;</a>
                                <?php endif; ?>

                            </article>

                            <?php wp_reset_postdata(); endif; endwhile;  ?>
                            </div>
                        </section>

                        <?php endif; ?>

                    </div>
                    <?php endif; if( have_rows('repeater_card_examples') ): ?>

                        <section class="examples swiper">
                            <header>
                                <h2>Examples</h2>
                            </header>

							<ol class="examples-nav swiper-pagination"></ol>

                            <div class="container swiper-wrapper">

                                <?php
                                while( have_rows('repeater_card_examples') ) : the_row();
                                $post_object = get_sub_field('card_example');

                                if( $posts ):
                                $post = $post_object;
                                setup_postdata( $post );

                                $title       = get_the_title( $post->ID );
                                $content     = apply_filters('the_content', $post->post_content);
                                $image       = get_post_thumbnail_id( $post->ID );
                                $image_url   = wp_get_attachment_image_url( $image, 'medium' );
                                $image_alt   = get_post_meta($image, '_wp_attachment_image_alt', true);
                                $link        = get_sub_field('card_example_link');

                                if(!empty($image)) {

                                    if(!empty($image_alt)) {
                                        $image_alt = 'alt="'.$image_alt.'"';
                                    }
                                }
                                if(!empty($link)) {
                                    if(!empty($link_alt)) {
                                        $link_alt = $link['alt'];
                                        $link_alt = 'alt="'.$link_alt.'"';
                                    }
                                    $link = '<a href="'.esc_url($link['url']).'" '.$link_alt.'>Learn more -></a>';
                                }
                                ?>

                                <article class="example swiper-slide">
                                    <h3><?php echo $title; ?></h3>

                                    <?php if(!empty($image_url)) { ?>

                                    <figure>
                                        <img src="<?php echo esc_url($image_url); ?>" <?php echo $image_alt; ?>>
                                    </figure>

                                    <?php }
                                    echo $content;
                                    echo $link;
                                    ?>
                                </article>

                                <?php wp_reset_postdata(); endif; endwhile; ?>

                            </div>
                        </section>

                    <?php endif; ?>

                    <footer>
                        <header>
                            <h2>Participate</h2>
                        </header>

                        <ul>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/img/icon-slack.svg" alt="Icon slack"> <p>Want to learn and exchange with fellow changemakers? <a href="#">Join the conversation on Slack &rarr;</a></p></li>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/img/icon-email-black.svg" alt="Icon email"> <p>Looking for some advice or would like to collaborate with Mindworks? <a href="#">Ask us anything &rarr;</a></p></li>
                        </ul>

                    </footer>

                </article>

            </section>

            <aside class="sidebar">
                <!-- Sidenote elements  -->
            </aside>

            <?php endwhile; endif; ?>

        </main>
        <?php wp_footer(); ?>
    </body>
</html>
