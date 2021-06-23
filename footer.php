    <footer class="main-footer">
		<div class="identity">
            <a class="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" alt="Logo">
                <img src="<?php echo get_template_directory_uri(); ?>/img/logo-white.svg" alt="<?php bloginfo('name'); ?>" />
            </a>
		</div>
        <h2>Giving changemakers the power to understand how the human mind works.</h2>
        <h3>Mindworks translates insights from cognitive and social sciences into practical tools for audience research, campaign strategy and engagement design.</h3>
        <div class="subscription-form">
            <img src="<?php echo get_template_directory_uri(); ?>/img/icon-mail.svg" alt="Mail" />
            <h4>Our new website is coming soon!</h4>
            <p>Leave your contacts to be the first to know when.</p>
            <div class="mailchimp-form">
                <!-- Begin Mailchimp Signup Form -->
                <div id="mc_embed_signup">
                    <form action="https://mailchi.us20.list-manage.com/subscribe/post?u=ca3248c21dbaac156fd95fe92&amp;id=2314269c11" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                            <input type="name" value="" name="NAME" class="name" id="mce-NAME" placeholder="Name">
                            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="E-mail" required>
                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ca3248c21dbaac156fd95fe92_2314269c11" tabindex="-1" value=""></div>
                            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                        </div>
                    </form>
                </div>
                <!--End mc_embed_signup-->
            </div>
        </div>
        <div class="so-me">
            <a href="https://twitter.com/mindworkslab" class="twitter" target="_blank" alt="Mindworks Twitter">
                <span class="icon-twitter"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-twitter.svg" alt="Twitter" /></span>
                Mindworks<br>
                @mindworkslab
            </a>
        </div>
    </footer>
    
<?php wp_footer(); ?>

</body>

</html>
