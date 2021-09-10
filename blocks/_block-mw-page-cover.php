<?php
//
$page_title = get_the_title();
$parent_title = get_the_title( $post->post_parent );

// Change class according to background brightness
if ( block_field('background-brightness', false) === true ) {
    $cover_class = 'dark';
} else {
    $cover_class = 'light';
}
?>
<header class="block cover <?php echo $cover_class ?> <?php block_field('className'); ?>">
    <?php
    // Make part from page child order
    if ( is_page() && $post->post_parent ) { //Check if is a child page
        $page_order = $post->menu_order;
        $part = 'Part ' . ($page_order + 1);
    }
    ?>

    <div class="cover-title">
        <!-- <h1><span><?php print $part; ?> </span> <?php print $page_title; ?></h1> -->
        <h3><?php block_field( 'page-description' ); ?></h3>
        <div class="time">
            <time datetime="<?php echo get_the_date('l jS \of F Y h:i:s A'); ?>" pubdate="pubdate" class="date"><?php print get_the_date('F j, Y'); ?></time>
            <span class="readtime" id="readtime"></span> min read
        </div>
    </div>

    <figure class="cover-image">
        <div class="cover-title-meta">
            <h1><span class="sub-title"><?php print $part; ?></span> <?php print $page_title; ?></h1>
            <h2 class="series-title"><?php print $parent_title; ?></h2>
        </div>
        <img src="<?php block_field( 'cover-image' ); ?>" alt="">
    </figure>

</header>
