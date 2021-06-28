<?php
define("THEME_DIR", get_template_directory_uri());

/*--- REMOVE GENERATOR META TAG ---*/
remove_action('wp_head', 'wp_generator');

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

//Remove Gutenberg Block Library CSS from loading on the frontend
// function smartwp_remove_wp_block_library_css(){
//     wp_dequeue_style( 'wp-block-library' );
//     wp_dequeue_style( 'wp-block-library-theme' );
// }
// add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css' );

// Disable REST API link tag
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// Disable oEmbed Discovery Links
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

// Disable REST API link in HTTP headers
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

// Remove the links to xmlrpc.php and wlwmanifest.xml
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
//Remove blocks library css
function wpassist_remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css' );

//
function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

//This code will limit WordPress to only save your last 4 revisions of each post or page, and discard older revisions automatically.
define( 'WP_POST_REVISIONS', 4 );

function theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'theme_slug_setup' );

//Add custom menu functionality
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

//
// Add custom CSS and JS
//

function my_load_scripts($hook) {

     // create my own version codes
     //$my_js_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'js/custom.js' ));
     //$my_css_ver = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'style.css' ));

     wp_enqueue_script( 'script_min', get_template_directory_uri() . '/js/script-min.js', array(), '1.0.0', true );
     //wp_enqueue_script( 'custom_js', plugins_url( 'js/custom.js', __FILE__ ), array(), $my_js_ver );

}
add_action('wp_enqueue_scripts', 'my_load_scripts');

// SHORTCODES

//
//Enable thumbnails for CPT - featured image
//

add_theme_support( 'post-thumbnails' );

// 
// Reusable Blocks accessible in backend
// link https://www.billerickson.net/reusable-blocks-accessible-in-wordpress-admin-area
// 

function be_reusable_blocks_admin_menu() {
    add_menu_page( 'Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
}
add_action( 'admin_menu', 'be_reusable_blocks_admin_menu' );

//
// Adding the Open Graph in the Language Attributes
// link https://www.wpbeginner.com/wp-themes/how-to-add-facebook-open-graph-meta-data-in-wordpress-themes/
//

function add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
        //echo '<meta property="fb:app_id" content="Your Facebook App ID" />';
        echo '<meta property="og:title" content="Mindworks • ' . strip_tags(get_the_title()) . '"/>';
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
    if(!empty(has_post_thumbnail( $post->ID ))) {
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
    }
    echo "";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );


//Add menu page
/*add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  add_menu_page( 
        'Footer',
        'Footer',
        'manage_options',
        'Footer',
        'footer_menu_page',
        'dashicons-welcome-widgets-menus', 
        26
    );
}*/

//
// CPT MW Tools
//

add_action( 'init', 'mw_tools_post_type' );
function mw_tools_post_type() {
    register_post_type( 'mw-tools',
        array(
            'labels' => array(
                'name' => __( 'MW Tools' ),
                'singular_name' => __( 'Tool' ),
                'add_new_item' => __( 'Add New Tool' )
            ),
            'public' => true,
            'show_in_rest' => true,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
            'menu_position' => 5,
            'menu_icon' => 'dashicons-image-filter',
            'rewrite' => array('slug' => '/')
        )
    );
}

//
//REMOVE CPT slug /mw-tools/ - https://wordpress.stackexchange.com/questions/125886/remove-slug-from-custom-post-type
//

add_action( 'pre_get_posts', 'wpse_include_my_post_type_in_query' );
function wpse_include_my_post_type_in_query( $query ) {

     // Only noop the main query
     if ( ! $query->is_main_query() )
         return;

     // Only noop our very specific rewrite rule match
     if ( 2 != count( $query->query )
     || ! isset( $query->query['page'] ) )
          return;

      // Include my post type in the query
     if ( ! empty( $query->query['name'] ) )
          $query->set( 'post_type', array( 'post', 'page', 'mw-tools' ) );
 }

 add_action( 'parse_query', 'wpse_parse_query' );
 function wpse_parse_query( $wp_query ) {
 
     if( get_page_by_path($wp_query->query_vars['name']) ) {
         $wp_query->is_single = false;
         $wp_query->is_page = true;
     }
 
 }

//
// CUSTOM FIELDS
//

add_action("admin_init", "admin_init");

function admin_init(){
    //MW Tools
    add_meta_box("cover_meta", "Cover text", "cover_meta", "mw-tools", "side", "high");
    //Footer
    /*function footer_menu_page(){
        //add_meta_box("title_meta", "Cover text", "title_meta", "", "", "high");
        $title_meta = $custom["footer_title_meta"][0];
        ?>
            <label for="footer_title_meta">Title</label>
            <textarea name="footer_title_meta" rows="3" style="width:100%;"><?php echo $footer_title_meta; ?></textarea>
        <?php
    }*/
    
}

function cover_meta(){
    global $post;
    $custom = get_post_custom($post->ID);
    $cover_meta = $custom["cover_meta"][0];
    ?>
		<label for="cover_meta">Text that will appear on the page cover.</label>
		<textarea name="cover_meta" rows="4" style="width:100%;"><?php echo $cover_meta; ?></textarea>
    <?php
}

add_action('save_post', 'save_details');
function save_details(){
    global $post;
    update_post_meta($post->ID, "cover_meta", $_POST["cover_meta"]);
}

?>