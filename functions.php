<?php

    include_once __DIR__ . '/inc/custom-post-types.php';
    include_once __DIR__ . '/inc/custom-fields.php';


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

        //
		// $old_page_TDM1 = get_page_by_path('thedisruptedmind/scientific-insights/');
		// $old_page_TDM2 = get_page_by_path('thedisruptedmind/the-crisis-timeline/');
        //
		// if ( is_page( array( get_the_ID($old_page_TDM1), get_the_ID($old_page_TDM2) ) ) ) {
        //     wp_register_style( 'block-mw-page-cover', get_template_directory_uri() . '/blocks/block-mw-page-cover.css' );
        //     wp_enqueue_style( 'block-mw-page-cover' );
		// }
        // if ( is_page( get_the_ID($old_page_TDM2) ) ) {
        //     wp_register_style( 'block-mw-format-menu', get_template_directory_uri() . '/blocks/block-mw-format-menu.css' );
        //     wp_register_style( 'block-mw-intro-content', get_template_directory_uri() . '/blocks/block-mw-intro-content.css' );
        //     wp_register_style( 'block-mw-infographic', get_template_directory_uri() . '/blocks/block-mw-infographic.css' );
        //     wp_register_style( 'block-mw-expanding-content', get_template_directory_uri() . '/blocks/block-mw-expanding-content.css' );
        //
        //     wp_enqueue_style( 'block-mw-format-menu' );
        //     wp_enqueue_style( 'block-mw-intro-content' );
        //     wp_enqueue_style( 'block-mw-infographic' );
        //     wp_enqueue_style( 'block-mw-expanding-content' );
        // }

    }

    // REMOVE WP EMOJI
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // Disable REST API link tag
    //remove_action('wp_head', 'rest_output_link_wp_head', 10);

    // Disable REST API link in HTTP headers
    //remove_action('template_redirect', 'rest_output_link_header', 11, 0);

    // Disable Embed Discovery Links - https://kinsta.com/knowledgebase/disable-embeds-wordpress/#disable-embeds-code
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

    //ADD TEMAPLATE NAME TO BODY CLASS
    add_filter('body_class', 'acme_add_body_class');
    /**
     * If the current page has a template, apply it's name to the list of classes. This is
     * necessary if there are multiple pages with the same template and you want to apply the
     * name of the template to the class of the body.
     * https://tommcfarlin.com/body-class-based-on-a-template/
     * @param array $classes The current array of attributes to be applied to the
     */
    function acme_add_body_class($classes) {
        if (!empty(get_post_meta(get_the_ID(), '_wp_page_template', true))) {
            // Remove the `template-` prefix and get the name of the template without the file extension.
            $templateName = basename(get_page_template_slug(get_the_ID()));
            $templateName = str_ireplace('template-', '', basename(get_page_template_slug(get_the_ID()), '.php'));

            $classes[] = $templateName;
        }

        return array_filter($classes);
    }

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
    // Enable svg support
    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
    add_filter('upload_mimes', 'cc_mime_types');

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

    //Add category and tag metaboxes to pages
    function page_cattag_settings() {
        register_taxonomy_for_object_type('category', 'page');
        register_taxonomy_for_object_type('post_tag', 'page');
    }
    // Add to the admin_init hook of your theme functions.php file
    add_action( 'init', 'page_cattag_settings' );


	// Add support for responsive embeds. - https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/
	//add_theme_support( 'responsive-embeds' );

    /**
        * @snippet  Duplicate posts and pages without plugins
        * @author   Misha Rudrastyh
        * @url      https://rudrastyh.com/wordpress/duplicate-post.html
    */

    // Add the duplicate link to action list for post_row_actions
    // for "post" and custom post types
    add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
    // for "page" post type
    add_filter( 'page_row_actions', 'rd_duplicate_post_link', 10, 2 );


    function rd_duplicate_post_link( $actions, $post ) {

        if( ! current_user_can( 'edit_posts' ) ) {
            return $actions;
        }

        $url = wp_nonce_url(
            add_query_arg(
                array(
                    'action' => 'rd_duplicate_post_as_draft',
                    'post' => $post->ID,
                ),
                'admin.php'
            ),
            basename(__FILE__),
            'duplicate_nonce'
        );

        $actions[ 'duplicate' ] = '<a href="' . $url . '" title="Duplicate this item" rel="permalink">Duplicate</a>';

        return $actions;
    }

    /*
    * Function creates post duplicate as a draft and redirects then to the edit post screen
    */
    add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );

    function rd_duplicate_post_as_draft(){

        // check if post ID has been provided and action
        if ( empty( $_GET[ 'post' ] ) ) {
            wp_die( 'No post to duplicate has been provided!' );
        }

        // Nonce verification
        if ( ! isset( $_GET[ 'duplicate_nonce' ] ) || ! wp_verify_nonce( $_GET[ 'duplicate_nonce' ], basename( __FILE__ ) ) ) {
            return;
        }

        // Get the original post id
        $post_id = absint( $_GET[ 'post' ] );

        // And all the original post data then
        $post = get_post( $post_id );

        /*
        * if you don't want current user to be the new post author,
        * then change next couple of lines to this: $new_post_author = $post->post_author;
        */
        $current_user = wp_get_current_user();
        $new_post_author = $current_user->ID;

        // if post data exists (I am sure it is, but just in a case), create the post duplicate
        if ( $post ) {

            // new post data array
            $args = array(
                'comment_status' => $post->comment_status,
                'ping_status'    => $post->ping_status,
                'post_author'    => $new_post_author,
                'post_content'   => $post->post_content,
                'post_excerpt'   => $post->post_excerpt,
                'post_name'      => $post->post_name,
                'post_parent'    => $post->post_parent,
                'post_password'  => $post->post_password,
                'post_status'    => 'draft',
                'post_title'     => $post->post_title,
                'post_type'      => $post->post_type,
                'to_ping'        => $post->to_ping,
                'menu_order'     => $post->menu_order
            );

            // insert the post by wp_insert_post() function
            $new_post_id = wp_insert_post( $args );

            /*
            * get all current post terms ad set them to the new post draft
            */
            $taxonomies = get_object_taxonomies( get_post_type( $post ) ); // returns array of taxonomy names for post type, ex array("category", "post_tag");
            if( $taxonomies ) {
                foreach ( $taxonomies as $taxonomy ) {
                    $post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
                    wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
                }
            }

            // duplicate all post meta
            $post_meta = get_post_meta( $post_id );
            if( $post_meta ) {

                foreach ( $post_meta as $meta_key => $meta_values ) {

                    if( '_wp_old_slug' == $meta_key ) { // do nothing for this meta key
                        continue;
                    }

                    foreach ( $meta_values as $meta_value ) {
                        add_post_meta( $new_post_id, $meta_key, $meta_value );
                    }
                }
            }

            // finally, redirect to the edit post screen for the new draft
            wp_safe_redirect(
            	add_query_arg(
            		array(
            			'action' => 'edit',
            			'post' => $new_post_id
            		),
            		admin_url( 'post.php' )
            	)
            );
            exit;
            // or we can redirect to all posts with a message
            //wp_safe_redirect(
            //    add_query_arg(
            //        array(
            //            'post_type' => ( 'post' !== get_post_type( $post ) ? get_post_type( $post ) : false ),
            //            'saved' => 'post_duplication_created' // just a custom slug here
            //        ),
            //        admin_url( 'edit.php' )
            //    )
            //);
           // exit;

        } else {
            wp_die( 'Post creation failed, could not find original post.' );
        }

    }

    /*
    * In case we decided to add admin notices
    */
    add_action( 'admin_notices', 'rudr_duplication_admin_notice' );

    function rudr_duplication_admin_notice() {

        // Get the current screen
        $screen = get_current_screen();

        if ( 'edit' !== $screen->base ) {
            return;
        }

        //Checks if settings updated
        if ( isset( $_GET[ 'saved' ] ) && 'post_duplication_created' == $_GET[ 'saved' ] ) {

            echo '<div class="notice notice-success is-dismissible"><p>Post copy created.</p></div>';

        }
    }

    //TRIM TEXT - limit words

    function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

?>
