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
    echo "";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

//
// CUSTOM FIELDS
//

add_action('admin_init', 'admin_init');

function admin_init(){
	add_meta_box('opengraph_meta', 'Preview image', 'opengraph_meta', array('post', 'page'), 'side', 'high');
    //MW Tools
    add_meta_box('label_meta', 'Label', 'label_meta', array('post', 'page'), 'side', 'high');
    add_meta_box('cover_meta', 'Cover', 'cover_meta', array('post', 'page'), 'side', 'high');
	add_meta_box('infographic_meta', 'Infographic', 'infographic_meta', array('post', 'page'), 'side', 'high');

    //Footer
    /*function footer_menu_page(){
        //add_meta_box('title_meta', 'Cover text', 'title_meta', '', '', 'high');
        $title_meta = $custom['footer_title_meta'][0];
        ?>
            <label for="footer_title_meta">Title</label>
            <textarea name="footer_title_meta" rows="3" style="width:100%;"><?php echo $footer_title_meta; ?></textarea>
        <?php
    }*/

}

//OPEN GRAPH META
function opengraph_meta(){
    global $post;
    $custom = get_post_custom($post->ID);
    $opengraph_meta = $custom['opengraph_meta'][0];
    ?>
		<label for="opengraph_meta">Add preview image url</label>
		<input type="text" name="opengraph_meta" value="<?php echo $opengraph_meta; ?>">
    <?php
}

//COVER META
function cover_meta(){
    global $post;
    $custom = get_post_custom($post->ID);
    $cover_meta_context_tag = $custom['cover_meta_context_tag'][0];
    $cover_meta_text = $custom['cover_meta_text'][0];
    ?>
        <label for="cover_meta_context_tag">Text that will appear over the title.</label>
        <textarea name="cover_meta_context_tag" rows="4" style="width:100%;"><?php echo $cover_meta_context_tag; ?></textarea>
        <br>
		<label for="cover_meta_text">Text that will appear on the page cover.</label>
		<textarea name="cover_meta_text" rows="4" style="width:100%;"><?php echo $cover_meta_text; ?></textarea>
    <?php
}

//LABEL META
function label_meta(){
    global $post;
    $custom = get_post_custom($post->ID);
    $label_meta = $custom['label_meta'][0];
    ?>
        <label for="label_meta">Label, ie: Part 1</label>
		<input type="text" name="label_meta" value="<?php echo $label_meta; ?>">
    <?php
}


//INFOGRAPHIC META
function infographic_meta(){
    global $post;
    $custom = get_post_custom($post->ID);
    $infographic_meta = $custom['infographic_meta'][0];
    ?>
		<label for="infographic_meta">Add infographic image url</label>
		<input type="text" name="infographic_meta" value="<?php echo $infographic_meta; ?>">
    <?php
}

add_action('save_post', 'save_details');
function save_details(){
    global $post;
    update_post_meta($post->ID, 'label_meta', $_POST['label_meta']);
    update_post_meta($post->ID, 'cover_meta_context_tag', $_POST['cover_meta_context_tag']);
    update_post_meta($post->ID, 'cover_meta_text', $_POST['cover_meta_text']);
	update_post_meta($post->ID, 'infographic_meta', $_POST['infographic_meta']);
	update_post_meta($post->ID, 'opengraph_meta', $_POST['opengraph_meta']);
}

?>
