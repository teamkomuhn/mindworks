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
						<a href="#" title="All cards"><span>All cards</span></a>
						<a class="previous" href="#" title="Previous card"><-</a>
                        <a class="active" href="#" title="Card 1">1</a>
						<a href="#" title="Card 2">2</a>
						<a href="#" title="Card 2">3</a>
						<a class="between" href="#" title="Card 3">...</a>
						<a href="#" title="Card 4">14</a>
						<a class="next" href="#" title="Next card">-></a>
                    </nav>

                    <article class="card full">
                        <header>
                            <h1><?php the_title(); ?></h1>

                            <?php
                            if ( has_post_thumbnail( $post->ID ) ) :
								$thumbnail_id = get_post_thumbnail_id( $post->ID );
                                $card_image = wp_get_attachment_image_src( $thumbnail_id );
								$card_image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                            ?>
                            <figure>
                                <img src="<?php echo $card_image[0]; ?>" alt="<?php echo $card_image_alt; ?>">
                            </figure>
							<?php endif; ?>

                            <?php the_excerpt(); ?>

                        </header>

                        <section class="intro">


                            <?php the_content(); ?>
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

                                <article class="step">
                                    <h3><?php echo $title; ?></h3>
                                    <?php echo $content; ?>
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


                        <?php  if( have_rows('repeater_card_examples') ): ?>

                            <section class="examples">
                                <header>
                                    <h2>Examples</h2>
                                </header>

								<ol class="examples-nav" aria-hidden="true">
									<li><span>1</span></li>
									<li class="active"><span>2</span></li>
									<li><span>3</span></li>
									<li><span>4</span></li>
									<li><span>5</span></li>
								</ol>

                                <?php
                                while( have_rows('repeater_card_examples') ) : the_row();

                                    $title      = get_sub_field('card_example_title');
                                    $image      = get_sub_field('card_example_image');
                                    $content    = get_sub_field('card_example_content');
                                    $link       = get_sub_field('card_example_link');
                                ?>

                                <article class="example">
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
                            </section>

                        <?php endif; ?>
                        <footer>
                            <header>
                                <h2>Participate</h2>
                            </header>

                            <ul>
                                <li><img src="<?php echo get_template_directory_uri(); ?>/img/icon-slack.svg" alt=""> <p>You want to get advice or exchange with fellow changemakers. <a href="#">Join the conversation on Slack -></a></p></li>
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
