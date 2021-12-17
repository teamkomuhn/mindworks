        </main>

        <aside class="sidebar">
            <!-- Sidenote elements  -->
        </aside>

        <footer class="main-footer">

            <div class="identity">
                <h1 class="logo">
                    <a class="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" alt="Logo">
                        <span><?php bloginfo('name') ?></span>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo-white.svg" alt="<?php bloginfo('name'); ?>" />
                    </a>
                </h1>
                <h2>Giving changemakers<br> the power to understand<br> how the human mind works.</h2>
                <h3>Mindworks translates insights from cognitive and social sciences into practical tools for audience research, campaign strategy and engagement design.</h3>
            </div>

            <div class="form mailchimp" id="contacts">
                <h4>Join our mailing list!</h4>
                <p>Sign up for news, insights, tips and tools from the Mindworks Lab.</p>

                <!-- Begin Mailchimp Signup Form -->
                <div id="mc_embed_signup">
                    <form action="https://mailchi.us20.list-manage.com/subscribe/post?u=ca3248c21dbaac156fd95fe92&amp;id=2314269c11" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                            <input type="text" value="" name="FNAME" class="name" id="mce-FNAME" placeholder="Name">
                            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="E-mail" required>
                            <div id="mce-responses" class="clear">
                                <div class="response" id="mce-error-response" style="display:none"></div>
                                <div class="response" id="mce-success-response" style="display:none"></div>
                            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ca3248c21dbaac156fd95fe92_2314269c11" tabindex="-1" value=""></div>
                            <div class="clear"><input type="submit" value="Send" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                        </div>
                    </form>
                </div>
                <!--End mc_embed_signup-->

                <p class="email-link icon-email">
                    <a href="mailto:hello@mindworkslab.org" alt="hello@mindworkslab.org"><strong>Email</strong> hello@mindworkslab.org</a>
                </p>

            </div>

            <div class="so-me">
                <a href="https://www.linkedin.com/company/mindworks-lab/" class="icon icon-linkedin" alt="Mindworks Linkedin"></a>
                <a href="https://twitter.com/mindworkslab" class="icon icon-twitter" alt="Mindworks Twitter"></a>
                <a class="text-small privacy" href="https://docs.google.com/document/d/1SBKEhdD9D9nTdGMZbxMUaOvrSW1ZWH3LjeNQ-uGDrZg/edit?usp=sharing" alt="Mindworks Privacy Policy">Privacy Policy</a>
            </div>

        </footer>



    <?php wp_footer(); ?>

    </body>

</html>
