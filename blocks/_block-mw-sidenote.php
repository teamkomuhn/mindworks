<aside class="block side-note">
    <span class="sup"></span>
    <?php block_field('content'); ?>
    <button type="button" class="close">Close</button>
    <?php
    $blocks = parse_blocks( $post->post_content );
    // print $blocks[0]['blockName'];

    print "<pre>".print_r($blocks,true)."</pre>";

    for ($i=0; $i <= count($blocks); $i++) {
        print "<pre>" . $blocks[$i]['blockName'] . "</pre>";

        if ( $blocks[$i]['blockName'] == 'genesis-custom-blocks/mw-sidenote' ) {
            print 'Achei';
        }
    }
    ?>
</aside>
