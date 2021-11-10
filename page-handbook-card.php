<?php /* Template Name: Page handbook card */ ?>

<?php get_header(); ?>

    <section class="cards-slider">

        <nav class="cards-nav">
            cards nav
        </nav>

        <article class="card full">
            <header>
                <h1><?php the_title(); ?></h1>
                <figure>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon-sense.svg" alt="">
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

                    <article class="step">
                        <h3>Sense and observe</h3>
                        <p>We recommend starting with a short period of sensing and observing. This will give you a personal impression of the impact of the crisis on the mindsets of you and your audience and allow you to imagine possible futures emerging from the crisis.</p>
                        <p>Sensing is best done with the whole team. Each team member should start by observing their own reactions: how has the crisis impacted you? What emotions or thoughts are you feeling yourself? Which narratives or common behaviors seem to be breaking down? This will help you finetune the questions you want to ask the community and help sharpen your own awareness.</p>
                        <p>You can then start to focus on the impacted community. Begin by having as many conversations as possible, especially with your key audiences. Be careful to avoid mixing what you hear with your own experience of the crisis. You can also spend some time just observing what is happening around you and how people behave differently. Don’t shy away from using sensing work done by others, but try to focus on reliable research and avoid isolated opinions. This can also be complemented with audience research, or social media monitoring.</p>
                    </article>

                    <article class="step">
                        <h3>Synthesise and imagine possible scenarios</h3>
                        <p>We recommend starting with a short period of sensing and observing. This will give you a personal impression of the impact of the crisis on the mindsets of you and your audience and allow you to imagine possible futures emerging from the crisis.</p>
                        <p>Sensing is best done with the whole team. Each team member should start by observing their own reactions: how has the crisis impacted you? What emotions or thoughts are you feeling yourself? Which narratives or common behaviors seem to be breaking down? This will help you finetune the questions you want to ask the community and help sharpen your own awareness.</p>
                        <p>You can then start to focus on the impacted community. Begin by having as many conversations as possible, especially with your key audiences. Be careful to avoid mixing what you hear with your own experience of the crisis. You can also spend some time just observing what is happening around you and how people behave differently. Don’t shy away from using sensing work done by others, but try to focus on reliable research and avoid isolated opinions. This can also be complemented with audience research, or social media monitoring.</p>
                    </article>

                    <article class="step">
                        <h3>Assess regularly</h3>
                    </article>

                    <article class="step">
                        <h3>Beware of aftershocks</h3>
                    </article>

                </section>

                <section class="tools tab">
                    <header class="tab-button">
                        <h2>Tools</h2>
                    </header>

                    <article class="tool">
                        <h3>John Boyle's OODA Loop</h3>
                        <p>The OODA loop is the cycle observe–orient–decide–act, developed by military strategist and United States Air Force Colonel John Boyd.</p>
                        <a href="#">Learn more -></a>
                        <!-- <figure>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/cover-masked-man.jpg" alt="">
                        </figure> -->
                    </article>

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

<?php get_footer(); ?>
