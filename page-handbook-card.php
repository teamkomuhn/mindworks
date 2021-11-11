<?php /* Template Name: Page handbook card */ ?>

<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <section class="cards-slider">

            <nav class="cards-nav">
                cards nav
            </nav>

            <article class="card full">
                <header>
                    <h1><?php the_title(); ?></h1>
                    <?php
                        if (has_post_thumbnail( $post->ID ) ){
                            $card_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
                        } else {
                            $card_image = get_template_directory_uri() . "/img/icon-sense.svg";
                        }
                    ?>
                    <div id="custom-bg" style="background-image: url('<?php echo $image[0]; ?>')">

                    </div>
                    <figure>
                        <img src="<?php echo $card_image; ?>" alt="">
                    </figure>
                    <p><?php the_excerpt(); ?></p>
                </header>

                <section class="intro">
                    <p><?php the_content(); ?></p>
                </section>

                <div class="tabs">

                    <section class="steps tab active">
                        <header class="tab-button">
                            <h2>How to</h2>
                        </header>

                        <?php 
                            if( have_rows('repeater_card_steps') ):
                                while( have_rows('repeater_card_steps') ) : the_row();

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
                                        <!-- <figure>
                                            <img src="<?php //echo get_template_directory_uri(); ?>/img/cover-masked-man.jpg" alt="">
                                        </figure> -->
                                    </article>

                        <?php endwhile; endif; ?>

                    </section>

                </div>

                <section class="examples">
                    <header>
                        <h2>Examples</h2>
                    </header>

                    <article class="example">
                        <h3>Scenario planning during COVID-19</h3>
                        <figure>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/cover-masked-man.jpg" alt="">
                        </figure>
                        <p>In 2020, several scenario models for Covid-19 emerged yet most focused on vaccine development, supply chains, economy or working habits and only a few included societal aspects like conspiracy theories, antitrust sentiment, fear or denial. However, as the crisis advanced, these “mindset factors” began to play an ever-important role in the long haul.</p>
                        <a href="#">Learn more -></a>
                    </article>

                </section>

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
    
<?php get_footer(); ?>
