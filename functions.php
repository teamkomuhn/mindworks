<?php

    define('THEME_DIR', get_template_directory_uri());

    // REMOVE GENERATOR META TAG
    remove_action('wp_head', 'wp_generator');

    // Prevent TITLE-TAG from being generated automatically
    function theme_slug_setup() {
        add_theme_support( 'title-tag' );
    }
    add_action( 'after_setup_theme', 'theme_slug_setup' );


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

        if ( !is_singular() ) //if it is not a post or a page
            return;
            //echo '<meta property="fb:app_id" content="Your Facebook App ID" />';
            echo '<meta property="og:title" content="' . strip_tags(get_the_title()) . ' - Mindworks"/>';
            echo '<meta property="og:type" content="website"/>';
            echo '<meta property="og:url" content="' . get_permalink() . '"/>';
            echo '<meta property="og:site_name" content="Mindworks"/>';
            echo '<meta property="og:description" content="' . get_the_excerpt() . '"/>';
        /*if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
            $default_image="http://example.com/image.jpg"; //replace this with a default image on your server or an image in your media library
            echo '<meta property="og:image" content="' . $default_image . '"/>';
        }
        else {
            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
        }*/
        if( $opengraph_meta ) {
            echo '<meta property="og:image" content="' . $opengraph_meta . '"/>';
        } else {
            $default_image= "https://mindworkslab.org/wp-content/uploads/cover-og.png"; //replace this with a default image on your server or an image in your media library
            echo '<meta property="og:image" content="' . $default_image . '"/>';
        }
        echo '';
    }
    add_action( 'wp_head', 'insert_fb_in_head', 5 );


    // ENQUEUE SCRIPTS and STYLES - Add custom CSS and JS
    function enqueue_scripts_styles() {

        // REGISTER
            /// CSS
            wp_register_style( 'style', get_template_directory_uri() . '/style.css' );

            /// JS
            wp_register_script( 'script_min', get_template_directory_uri() . '/js/main-min.js', array(), '1.0.0', true );

        // ENQUEUE
            /// CSS
            wp_enqueue_style( 'style');

            /// JS
            wp_enqueue_script( 'jquery' );
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

	// Add support for responsive embeds. - https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/
	//add_theme_support( 'responsive-embeds' );

?>
