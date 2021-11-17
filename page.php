<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
        <?php the_content(); ?>

        <section class="comments">
            <header>
                <h3>Leave us a message</h3>
                <p>If you’d be interested in collaborating, learning more or sharing your feedback and comments please use the form below.</p>
            </header>
            <?php
                //Add custom message placeholder and button text
                $comment_field_placeholder  = "Write here your message or feedback";
                $submit_button_text         = "Send";

                include('inc/comments.php');
            ?>
        </section>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>
