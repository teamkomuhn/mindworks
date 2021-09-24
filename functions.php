<?php

    define('THEME_DIR', get_template_directory_uri());

    // REMOVE GENERATOR META TAG
    remove_action('wp_head', 'wp_generator');

    // Prevent TITLE-TAG from being generated automatically
    /*function theme_slug_setup() {
        add_theme_support( 'title-tag' );
    }
    add_action( 'after_setup_theme', 'theme_slug_setup' );*/


    // Adding the OPEN GRAPH in the Language Attributes - link https://www.wpbeginner.com/wp-themes/how-to-add-facebook-open-graph-meta-data-in-wordpress-themes/
    function add_opengraph_doctype( $output ) {
        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
    }
    add_filter('language_attributes', 'add_opengraph_doctype');

    //Lets add Open Graph Meta Info
    function insert_fb_in_head() {

        global $post;
        $custom = get_post_custom($post->ID);
        $opengraph_meta = $custom['opengraph_meta'][0];

        if ( !is_singular() ) {//if it is not a post or a page
            //return;
            //echo '<meta property="fb:app_id" content="Your Facebook App ID" />';
            echo '<meta property="og:title" content="' . strip_tags(get_the_title()) . ' - Mindworks"/>';
            echo '<meta property="og:type" content="website"/>';
            echo '<meta property="og:url" content="' . get_permalink() . '"/>';
            echo '<meta property="og:site_name" content="Mindworks"/>';
            echo '<meta property="og:description" content="' . get_the_excerpt() . '"/>';
        }
        /*if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
            $default_image="http://example.com/image.jpg"; //replace this with a default image on your server or an image in your media library
            echo '<meta property="og:image" content="' . $default_image . '"/>';
        }
        else {
            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
        }*/
        if ( is_page() && $post->post_parent ) {
            echo '<meta property="og:title" content="' . strip_tags(get_the_title( $post )) . ' | ' . strip_tags(get_the_title( $post->post_parent )) . ' - Mindworks"/>';
        }
        if( $opengraph_meta ) {
            echo '<meta property="og:image" content="' . $opengraph_meta . '"/>';
        } else {
            $default_image = get_template_directory_uri() . "/uploads/cover-og.png"; //replace this with a default image on your server or an image in your media library
            echo '<meta property="og:image" content="' . $default_image . '"/>';
        }
        echo '';
    }
    add_action( 'wp_head', 'insert_fb_in_head', 5 );


    // ENQUEUE SCRIPTS and STYLES - Add custom CSS and JS
    function enqueue_scripts_styles() {

        // REGISTER
            /// CSS
            wp_register_style( 'style', get_stylesheet_directory_uri() . '/style.css' );
            //wp_register_style( 'style-sidenote', get_stylesheet_directory_uri() . '/blocks/block-mw-sidenote.css' );

            /// JS
            wp_register_script( 'script_min', get_template_directory_uri() . '/js/main-min.js', array(), '1.0.0', true );
            // wp_register_script( 'jquery_mobile', 'https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js', array( ' jquery' ), '1.4.5', true );

        // ENQUEUE
            /// CSS
            wp_enqueue_style( 'style');
            //wp_enqueue_style( 'style-sidenote');

            /// JS
            wp_enqueue_script( 'jquery' );
            // wp_enqueue_script( 'jquery_mobile' );
            wp_enqueue_script( 'script_min' );


    }
    add_action( 'wp_enqueue_scripts', 'enqueue_scripts_styles' );
    //
    function move_jquery_into_footer( $wp_scripts ) {

        if( is_admin() ) {
            return;
        }

        $wp_scripts->add_data( 'jquery', 'group', 1 );
        $wp_scripts->add_data( 'jquery-core', 'group', 1 );
        $wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
    }
    add_action( 'wp_default_scripts', 'move_jquery_into_footer' );



    //Load CSS and JS based on template name
    function enqueue_template_files() {
        //Get template name
        global $template;
        $template_name = basename( $template, '.php' );
        //Get files path + uri
        $css_file_dir = get_stylesheet_directory() . '/css/' . $template_name . '.css';
        $css_file_uri = get_stylesheet_directory_uri() . '/css/' . $template_name . '.css';
        $js_file_dir = get_stylesheet_directory() . '/js/' . $template_name . '-min.js';
        $js_file_uri = get_stylesheet_directory_uri() . '/js/' . $template_name . '-min.js';

        //Check if files exist and if then enqueue
        if ( file_exists( $css_file_dir ) ) {
            wp_register_style( $template_name, $css_file_uri, false, false, 'screen' );
            wp_enqueue_style( $template_name );
        }
        if ( file_exists( $js_file_dir ) ) {
            wp_register_script( $template_name, $js_file_uri, array ('jquery'), false, true );
            wp_enqueue_script( $template_name );
        }


		$old_page_TDM1 = get_page_by_path('thedisruptedmind/scientific-insights/');
		$old_page_TDM2 = get_page_by_path('thedisruptedmind/the-crisis-timeline/');

		if ( is_page( array( get_the_ID($old_page_TDM1), get_the_ID($old_page_TDM2) ) ) ) {
            wp_register_style( 'block-mw-page-cover', get_template_directory_uri() . '/blocks/block-mw-page-cover.css' );
            wp_enqueue_style( 'block-mw-page-cover' );
		}
        if ( is_page( get_the_ID($old_page_TDM2) ) ) {
            wp_register_style( 'block-mw-format-menu', get_template_directory_uri() . '/blocks/block-mw-format-menu.css' );
            wp_register_style( 'block-mw-intro-content', get_template_directory_uri() . '/blocks/block-mw-intro-content.css' );
            wp_register_style( 'block-mw-infographic', get_template_directory_uri() . '/blocks/block-mw-infographic.css' );
            wp_register_style( 'block-mw-expanding-content', get_template_directory_uri() . '/blocks/block-mw-expanding-content.css' );

            wp_enqueue_style( 'block-mw-format-menu' );
            wp_enqueue_style( 'block-mw-intro-content' );
            wp_enqueue_style( 'block-mw-infographic' );
            wp_enqueue_style( 'block-mw-expanding-content' );
        }

    }

    // REMOVE WP EMOJI
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );


    // Disable REST API link tag
    remove_action('wp_head', 'rest_output_link_wp_head', 10);

    // Disable REST API link in HTTP headers
    remove_action('template_redirect', 'rest_output_link_header', 11, 0);

    // Disable oEmbed Discovery Links - https://kinsta.com/knowledgebase/disable-embeds-wordpress/#disable-embeds-code
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

    // Disable Embeds
    function my_deregister_scripts(){
        wp_dequeue_script( 'wp-embed' );
    }
    add_action( 'wp_footer', 'my_deregister_scripts' );

    // Remove the links to xmlrpc.php and wlwmanifest.xml
    function removeHeadLinks() {
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');

    //Remove Gutenberg Block Library CSS from loading on the frontend
    function smartwp_remove_wp_block_library_css(){
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
    }
    add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );


    //This code will limit WordPress to only save your last 4 revisions of each post or page, and discard older revisions automatically.
    define( 'WP_POST_REVISIONS', 4 );


    //Add CUSTOM MENU functionality
    function new_custom_menu() {
        register_nav_menu('my-custom-menu',__( 'My Custom Menu' ));
    }
    add_action( 'init', 'new_custom_menu' );

    function add_additional_class_on_li($classes, $item, $args) {
        if(isset($args->add_li_class)) {
            $classes[] = $args->add_li_class;
        }
        return $classes;
    }
    add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);


    // Add theme support for FEATURED IMAGES - POST THUMBNAILS
    add_theme_support('post-thumbnails', array(
        'post',
        'page',
        //'custom-post-type-name',
    ));

    // Add theme support for EXCERPTS
    add_post_type_support( 'page', 'excerpt' );

	//Switch default core markup for search form, comment form, and comments to output valid HTML5. - https://haizdesign.com/wordpress/use-html5-input-types-in-wordpress-forms/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

    //Comment Field Order
    add_filter( 'comment_form_fields', 'mo_comment_fields_custom_order' );
    function mo_comment_fields_custom_order( $fields ) {
        $comment_field = $fields['comment'];
        $author_field = $fields['author'];
        $email_field = $fields['email'];
        $url_field = $fields['url'];
        $cookies_field = $fields['cookies'];
        unset( $fields['comment'] );
        unset( $fields['author'] );
        unset( $fields['email'] );
        unset( $fields['url'] );
        unset( $fields['cookies'] );
        // the order of fields is the order below, change it as needed:
        $fields['author'] = $author_field;
        $fields['email'] = $email_field;
        $fields['url'] = $url_field;
        $fields['comment'] = $comment_field;
        $fields['cookies'] = $cookies_field;
        // done ordering, now return the fields:
        return $fields;
    }

    //Add select field to comments form for subjects
    add_filter( 'comment_form_field_comment', function( $field ) {

        $subjects = ['I’d like to keep updated about Mindworks’ work',
                    'I’d like to share some feedback on this paper or on The Disrupted Mind',
                    'I’d love to collaborate',
                    'Other'];
    
        $select = '<p><label for="subject_select">Subject:</label>
        <select name="subject_select" id="subjectSelect">
        <option value="">Select a subject</option>';
    
        foreach ( $subjects as $key => $subject )
            $select .= sprintf(
                '<option value="%1$s" %2$s>%3$s</option>',
                esc_attr( $key ),
                ( in_array( $key, $subject) ? 'selected' : '' ), //this is not working properly yet
                esc_html( $subject )
            );
    
        $select .= '</select></p>';
    
        return $select . $field;
    });

	// Add support for responsive embeds. - https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/
	//add_theme_support( 'responsive-embeds' );

    //Register CPT - reusable content
    function cpt_reusable_content() {
        register_post_type('reusable_content',
            array(
                'labels'        => array(
                    'name'          => 'Reusable content',
                ),
                'description'   => 'Reusable content blocks to call whenever/wherever needed.',
                'public'        => true,
                'hierarchical'  => true,
                'show_in_rest'  => true,
                'supports'      => array('title', 'editor', 'revisions', 'trackbacks', 'excerpt', 'page-attributes', 'thumbnails', 'post-formats'),
            )
        );
    }
    add_action('init', 'cpt_reusable_content');


    // SHORTCODE: The Reusable content post
    function show_reusable_content( $atts ) {

        $post = $atts[slug];
        $post = get_page_by_path( $post, OBJECT, 'reusable_content' ); //slug
        if ( $post ) {
            $page_order = $post->menu_order;
            $part = 'Phase ' . ($page_order + 1);

            $post_title     = $post->post_title;
            $post_excerpt   = $post->post_excerpt;
            $post_content   = $post->post_content;
            //$post_image     = get_the_post_thumbnail( $post );
            
            $return_string = 	'<section class="block expanding-content">';
            $return_string .= 	    '<article class="expandable companion">';
            $return_string .=           '<div class="main">';
            $return_string .=	            '<header>';
            $return_string .= 			        '<h1>' . $post_title . '</h1>';
            $return_string .= 			        '<p>' . $post_excerpt . '</p>';
            $return_string .=                   '<div class="meta">';
            $return_string .=                       '<span class="part-index">Phase' . $part .'</span>';
            $return_string .=                       '<span class="tag">A few days</span>';
            $return_string .=                       '<button class="open companion" type="button"><span>Infographic</span></button>';
            $return_string .=                   '</div>';
            $return_string .=		        '</header>';
            $return_string .=           '</div>';
            $return_string .=           '<section class="recommendations dark">';
            $return_string .=	            $post_content;
            $return_string .=           '</section>';
            $return_string .=           '<div class="buttons expand">';
            $return_string .=               '<button class="expand" type="button"><span>Read more ↓</span></button>';
            $return_string .=               '<button class="expand go-to" type="button">Recommendations</button>';
            $return_string .=           '</div>';
            $return_string .=           '<aside class="companion right">';
            $return_string .=               '<img src="' . get_stylesheet_directory_uri() . '/img/timeline-dotted-line-red.svg" alt="">';
            $return_string .=           '</aside>';
            $return_string .= 	    '</article>';
            $return_string .= 	'</section>';
            

            wp_reset_query();
            return $return_string;
        }
    }
    add_shortcode('reusable_content','show_reusable_content');

?>
