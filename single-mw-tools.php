<?php
    get_header();
    
    // WP_Query arguments
    $args = array(
        'post_type'              => 'mw-tools'
    );
    $mwtools = new WP_Query( $args );
?>
    <main>
        <section class="single-mw-tool">

            <?php if ( $mwtools -> have_posts() ) : while ( $mwtools -> have_posts() ) : $mwtools -> the_post(); 
                $post_cover_text = get_post_meta( $post->ID, 'cover_meta', 1);
                if ( empty($post_cover_text) ) {
                    $post_cover_text = get_the_excerpt();
                };
                $post_style = 'style="background-image:url(' . get_the_post_thumbnail_url($post->ID) . ')"';
            ?>

            <header <?php print $post_style; ?>>
                <div class="cover-content">
                    <h1><?php the_title(); ?></h1>
                    <h2><?php print $post_cover_text; ?></h2>
                    <span class="date"><?php the_date( 'F d, Y' ); ?></span>
                    <span class="readtime" id="time"></span> min read
                    <?php 
                        $author_ID = get_the_author_meta('ID'); 
                        $author_name = get_the_author_meta('display_name'); 
                        if ($author_ID != 0 && $author_ID != 1) {
                            echo '<span class="author">';
                            echo '<img src="'. get_avatar_url($author_ID).'" alt="'.$author_name.'"/>';
                            echo $author_name;
                            echo '</span>';
                    } ?>
                </div>
            </header>
            <div class="content" id="content">
                <?php the_content(); ?>
            </div>
            <?php endwhile; endif; ?>
                
        </section>
        <div class="modal-infographic">
            <img src="" alt="" />
        </div>
	</main>

<?php get_footer(); ?>
