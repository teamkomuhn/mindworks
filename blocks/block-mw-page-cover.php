<header class="cover block <?php block_field('className'); ?>">
    <h1><?php block_field( 'page-title' ); ?></h1>
    <h2><?php block_field( 'page-heading' ); ?></h2>
    <h3><?php block_field( 'page-description' ); ?></h3>
    <figure>
        <img src="<?php block_field( 'cover-image' ); ?>" alt="">
    </figure>
    <div class="time">
        <time datetime="<?php echo get_the_date('l jS \of F Y h:i:s A'); ?>" pubdate="pubdate" class="date"><?php print get_the_date('F j, Y'); ?></time>
        <span class="readtime">[20 min read]</span>
    </div>
</header>
