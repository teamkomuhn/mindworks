<?php /* Template Name: Page handbook card */ ?>

<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <?php global $post;
            if ( is_page() && $post->post_parent ) {
                echo '<title>' . strip_tags(get_the_title( $post )) . ' | ' . strip_tags(get_the_title( $post->post_parent )) . ' - Mindworks</title>';
            } elseif ( is_home() ) {
                echo '<title>Mindworks | ' . strip_tags(get_bloginfo( 'description' )) . '</title>';
            } else {
                echo '<title>' . strip_tags(get_the_title( $post )) . ' - Mindworks</title>';
            }
        ?>

        <?php wp_head(); ?>

        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/x-icon" />
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <meta name="author" content="Komuhn">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link
            rel="stylesheet"
            href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
        />
    </head>

    <body <?php body_class(); ?>>

        <?php enqueue_template_files(); ?>
        <!--[if IE]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <main id="main">

            <?php 
                if ( have_posts() ) : while ( have_posts() ) : the_post(); 

                    $postcat = get_the_category( $post->ID );
                    foreach( $postcat as $cat ) {
                        $cat_color = get_field('category_color', $cat);
                    }
                    if (!empty($cat->parent) && !empty($cat_color)) {
                        $data_color = 'data-color = "'.$cat_color.'"';
                    }
                
            ?>

                <section class="cards-slider" <?php echo $data_color; ?>>

                    <?php
                        $current_cardID = get_the_ID();

                        $cardslist = get_pages(array(
                            'child_of'    => $post->post_parent,
                            'sort_column' => 'menu_order',
                            //'sort_order'  => 'ASC',
                        ));
                        $cards = array();

                        foreach ($cardslist as $card) {
                            $cards[] += $card->ID;
                        }

                        $firstID    = $cards[0];
                        $lastID     = end($cards);
                        $total      = count($cards);

                        $current = array_search(get_the_ID(), $cards);
                        $prevID = $cards[$current-1];
                        $nextID = $cards[$current+1];
                        
                        if($current == get_the_ID($post)){ 
                            $active = 'class="active"'; 
                        } else { 
                            $active = '';  
                        }

                        if($pages > 1) {
                    ?>
                   
                    <nav class="cards-nav">
                        <a href="<?php echo get_permalink($post->post_parent); ?>" title="All cards"><span>All cards</span></a>
                        
                        <?php if (!empty($prevID)) { ?>
                                <a class="previous" href="<?php echo get_permalink($prevID); ?>" title="Previous card"><-</a>
                        <?php } else { ?>
                                <a class="previous" href="<?php echo get_permalink($lastID); ?>" title="Previous card"><-</a>
                        <?php } ?>

                        <?php 
                            $args = array(
                                'post_type'      => 'page',
                                'posts_per_page' => -1,
                                //'post__not_in'   => array($firstID, $lastID),
                                'post_parent'    => $post->post_parent
                            );
                            
                            // The Query
                            $cards = new WP_Query( $args );
                            if ( $cards->have_posts() ) :
                                
                                $i = 1;
                                while ( $cards->have_posts() ) : $cards->the_post();
                                if($current_cardID == get_the_ID()){ $active = 'class="active"'; } else { $active = '';  }
                        ?>

                        <a <?php echo $active; ?> href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo $i++; ?></a>

                        <?php endwhile; endif; wp_reset_postdata(); ?>

                        <?php if (!empty($nextID)) { ?>
                                <a class="next" href="<?php echo get_permalink($nextID); ?>" title="Next card">-></a>
                        <?php } else { ?>
                                <a class="next" href="<?php echo get_permalink($firstID); ?>" title="Next card">-></a>
                        <?php }?>
                    </nav>

                    <?php } ?>

                    <article class="card full">
                        <header>
                            <h1><?php the_title(); ?></h1>

                            <?php
                                if ( has_post_thumbnail( $post->ID ) ) :
                                    $thumbnail_id = get_post_thumbnail_id( $post->ID );
                                    $card_image = wp_get_attachment_image_src( $thumbnail_id );
                                    $card_image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                            ?>

                            <figure class="icon">
                                <img src="<?php echo $card_image[0]; ?>" alt="<?php echo $card_image_alt; ?>">
                            </figure>

							<?php endif; ?>

                            <?php the_excerpt(); ?>

                            <?php 
                                $companion_image = get_field('companion_image');
                                $companion_url = get_field('companion_url');
                                $companion_overlay = get_field('companion_overlay');

                                if($companion_overlay == 1) {
                                    $companion_button = '<button class="open companion" type="button"></button>';
                                } else {
                                    $companion_button = '<a class="button open" href="'.$companion_url.'"></a>';
                                }

                                if(!empty($companion_image)) {
                                    $companion_image_alt = $companion_image['alt'];

                                    if(!empty($companion_image_alt)) {
                                        $companion_image_alt = 'alt="'.$companion_image_alt.'"';
                                    }
                            ?>
                            
                            <div class="companion-content">
                                <figure class="companion-image">
                                    <img src="<?php echo $companion_image['url']; ?>" <?php echo $companion_image_alt; ?>>
                                </figure>
                                <?php // echo $companion_button; ?>
                            </div>

							<?php } ?>

                        </header>

                        <section class="intro container-expandable">
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

                                    $content = get_the_content();

                                    if(!empty($content)){
                                ?>

								<button class="button-expandable" type="button"><span>Read more &darr;</span></button>

                                <?php } ?>
							</header>

                            <?php if(!empty($content)){ ?>
                                <div class="content expandable">
                                    <?php echo $content; ?>
                                </div>
                            <?php } ?>
                        </section>

                        <div class="tabs">

                            <section class="steps tab active">
                                <header class="tab-button">
                                    <h2>How to</h2>
                                </header>

                                <?php
                                if ( have_rows('repeater_card_steps') ):
                                while ( have_rows('repeater_card_steps') ) : the_row();

                                $title      = get_sub_field('card_step_title');
                                $content    = get_sub_field('card_step_content');
                                $tools      = get_sub_field('card_step_tools');
                                ?>

                                <article class="step container-expandable">
                                    <h3><?php echo $title; ?></h3>

                                    <?php if(!empty($content)) { ?>
                                        <button class="button-expandable"><span>&darr;</span></button>

                                        <div class="expandable">
                                            <?php 
                                            echo $content; 

                                            if ( have_rows('repeater_card_step_tools') ):
                                            while ( have_rows('repeater_card_step_tools') ) : the_row();
                                            $tool           = get_sub_field('card_step_tool');

                                            $title          = get_the_title( $tool->ID );
                                            $slug           = sanitize_title( $title );
                                            $excerpt        = get_the_excerpt( $tool->ID );
                                            ?>
                                            <article class="tools">
                                                <h3><?php echo $title; ?></h3>
                                                <?php if(!empty($excerpt)) { echo '<p>'.$excerpt.'</p>'; } ?>
                                                <a href="#tools?tool=<?php echo $slug; ?>">Learn more -></a>
                                            </article>
                                            <?php endwhile; endif; ?>
                                        </div>
                                    <?php } ?>

                                </article>


                                <?php endwhile; endif; ?>

                            </section>

                            <section class="tools tab" id="tools">
                                <header class="tab-button">
                                    <h2>Tools</h2>
                                </header>

                                <?php
                                if( have_rows('repeater_card_tools') ):
                                while( have_rows('repeater_card_tools') ) : the_row();
                                $tool           = get_sub_field('card_tool');

                                $title          = get_the_title( $tool->ID );
                                $slug           = sanitize_title( $title );
                                $excerpt        = get_the_excerpt( $tool->ID );
                                $link           = get_sub_field('card_tool_link');
                                ?>

                                <article class="tool" id="tool=<?php echo $slug; ?>">
                                    <h3><?php echo $title; ?></h3>
                                    <?php if(!empty($excerpt)) { echo '<p>'.$excerpt.'</p>'; } ?>

                                    <?php if(!empty($link)) { ?>
                                    <a href="<?php echo esc_url($link); ?>">Learn more -></a>
                                    <?php } ?>                              
                                          
                                </article>

                                <?php endwhile; endif; ?>

                            </section>

                        </div>


                        <?php if( have_rows('repeater_card_examples') ): ?>

                            <section class="examples swiper">
                                <header>
                                    <h2>Examples</h2>
                                </header>

								<ol class="swiper-pagination"></ol>

                                <div class="swiper-wrapper">

                                    <?php
                                    while( have_rows('repeater_card_examples') ) : the_row();
                                    $example      = get_sub_field('card_example');

                                    $title       = get_the_title( $example->ID );
                                    $content     = apply_filters('the_content', $example->post_content);
                                    $image       = get_post_thumbnail_id( $example->ID );
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
                                        $link = '<a href="'.$link['url'].'" '.$link_alt.'>Learn more -></a>';
                                    }
                                    ?>

                                    <article class="example swiper-slide">
                                        <h3><?php echo $title; ?></h3>

                                        <?php if(!empty($image_url)) { ?>

                                        <figure>
                                            <img src="<?php echo $image_url; ?>" <?php echo $image_alt; ?>>
                                        </figure>

                                        <?php } 
                                    
                                        echo $content;
                                        echo $link;
                                    
                                        ?>
                                </article>

                                    <?php endwhile; ?>
                                </div>
                            </section>

                        <?php endif; ?>

                        <footer>
                            <header>
                                <h2>Participate</h2>
                            </header>

                            <ul>
                                <li><img src="<?php echo get_template_directory_uri(); ?>/img/icon-slack.svg" alt="Icon slack"> <p>Want to learn and exchange with fellow changemakers? <a href="#">Join the conversation on Slack -></a></p></li>
                                <li><img src="<?php echo get_template_directory_uri(); ?>/img/icon-email-black.svg" alt="Icon email"> <p>Looking for some advice or would like to collaborate with Mindworks? <a href="#">Ask us anything -></a></p></li>
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
