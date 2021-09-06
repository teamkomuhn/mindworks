<a href="#" title="<?php block_field('infographic-title'); ?>" class="block zoom infographic">
    <img src="<?php block_field('image-url'); ?>" alt="<?php block_field('infographic-title'); ?>">
</a>

<section class="block infographic popup closed">
    <header>
        <h1>Infographic</h1>
        <nav>
            <a class="button download" href="<?php echo block_field('pdf-url'); ?>" download>Download</a>
            <button type="button" class="close">Close</button>
        </nav>
    </header>
    <figure>
        <img src="<?php block_field('image-url'); ?>" alt="<?php block_field('infographic-title'); ?>">
    </figure>
</section>
