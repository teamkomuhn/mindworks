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

        <link rel='shortcut icon' href='<?php echo get_template_directory_uri(); ?>/img/favicon.ico' type='image/x-icon' />
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

        <main <?php echo $maxWidth; ?> id="main">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <section class="cards-slider">

                    <nav class="cards-nav">
                        <a href="<?php echo get_permalink($post->post_parent); ?>" title="All cards"><span>All cards</span></a>
                        <?php
                            $args = array(
                                'post_type'      => 'page',
                                'posts_per_page' => -1,
                                'post_parent'    => $post->post_parent
                            );

                            // The Query
                            $cards = new WP_Query( $args );

                            if ( $cards->have_posts() ) :

                                $i = 1;
                                while ( $cards->have_posts() ) : $cards->the_post();

                        ?>

                            <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo $i++; ?></a>

                        <?php endwhile; endif; wp_reset_postdata(); ?>
                    </nav>

                    <article class="card full">
                        <?php
                            $card_color = get_field('card_color');
                            $card_style = 'style="background-color:'.$card_color.'"';
                        ?>
                        <header <?php echo $card_style; ?>>
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

                            <?php // IF COMPANION IMAGE ?>
                            <figure class="companion-image">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/timeline-phases-nav.svg" alt="">
                            </figure>

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

                                <?php endwhile; endif; ?>

								<button class="button-expandable" type="button"><span>Read more &darr;</span></button>

							</header>

                            <div class="content expandable">
                                <?php the_content(); ?>
                            </div>
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
                                ?>

                                <article class="step container-expandable">
                                    <h3><?php echo $title; ?></h3>
                                    <button class="button-expandable"><span>&darr;</span></button>

                                    <div class="expandable">
                                        <?php echo $content; ?>
                                    </div>
                                </article>


                                <?php endwhile; endif; ?>

                            </section>

                            <section class="tools tab">
                                <header class="tab-button">
                                    <h2>Tools</h2>
                                </header>

                                <?php
                                if( have_rows('repeater_card_tools') ):
                                while( have_rows('repeater_card_tools') ) : the_row();

                                $title       = get_sub_field('card_tool_title');
                                $description = get_sub_field('card_tool_description');
                                $link        = get_sub_field('card_tool_link');
                                ?>

                                <article class="tool">
                                    <h3><?php echo $title; ?></h3>
                                    <?php echo $description; ?>
                                    <a href="<?php echo esc_url($link); ?>">Learn more -></a>
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
                                            $title      = get_sub_field('card_example_title');
                                            $image      = get_sub_field('card_example_image');
                                            $content    = get_sub_field('card_example_content');
                                            $link       = get_sub_field('card_example_link');

                                    ?>

                                    <article class="example swiper-slide">
                                        <h3><?php echo $title; ?></h3>

                                        <?php if($image != '') : ?>
                                        <figure>
                                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                                        </figure>
                                        <?php endif; ?>

                                        <?php echo $content; ?>

                                        <a href="<?php echo $link['url']; ?>">Learn more -></a>
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
