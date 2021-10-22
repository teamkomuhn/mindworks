<?php

    //Register CPT - Handbooks
    function cpt_handbooks() {
        register_post_type('handbooks',
            array(
                'labels'        => array(
                    'name'          => 'Handbooks',
                ),
                'description'   => 'Handbooks pages to share good practices and recommendations.',
                'menu_icon'     => 'dashicons-book',
                'menu_position' => 20,
                'public'        => true,
                'hierarchical'  => true,
                'show_in_rest'  => true,
                'taxonomies'    => array( 'category', 'post_tag'),
                'supports'      => array('title', 'editor', 'revisions', 'trackbacks', 'excerpt', 'page-attributes', 'thumbnails', 'post-formats'),
            )
        );
    }
    add_action('init', 'cpt_handbooks');

    //Register CPT - Cards
    function cpt_cards() {
        register_post_type('cards',
            array(
                'labels'        => array(
                    'name'          => 'Cards',
                ),
                'description'   => 'Cards with recommendations.',
                'menu_icon'     => 'dashicons-screenoptions',
                'menu_position' => 20,
                'public'        => true,
                'hierarchical'  => true,
                'show_in_rest'  => true,
                'taxonomies'    => array( 'category', 'post_tag'),
                'supports'      => array('title', 'editor', 'revisions', 'trackbacks', 'excerpt', 'page-attributes', 'thumbnails', 'post-formats'),
            )
        );
    }
    add_action('init', 'cpt_cards');

    //Register CPT - expandable content
    function cpt_expandable_content() {
        register_post_type('expandable_content',
            array(
                'labels'        => array(
                    'name'          => 'Expandable content',
                ),
                'description'   => 'Expandable content blocks.',
                'menu_icon'     => 'dashicons-editor-expand',
                'menu_position' => 20,
                'public'        => true,
                'hierarchical'  => true,
                'show_in_rest'  => true,
                'supports'      => array('title', 'editor', 'revisions', 'trackbacks', 'excerpt', 'page-attributes', 'thumbnails', 'post-formats'),
            )
        );
    }
    add_action('init', 'cpt_expandable_content');
?>