<?php

add_action('admin_init', 'admin_init');

function admin_init(){

	add_meta_box('opengraph_meta', 'Preview image', 'opengraph_meta', array('post', 'page'), 'side', 'high');

    //MW Tools
    //add_meta_box('label_meta', 'Label', 'label_meta', array('post', 'page'), 'side', 'high');
    //add_meta_box('cover_meta', 'Cover', 'cover_meta', array('post', 'page'), 'side', 'high');
	//add_meta_box('infographic_meta', 'Infographic', 'infographic_meta', array('post', 'page'), 'side', 'high');

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


/**
    ** CATEGORY - Upload image field

    ** Plugin class
    ** https://pluginrepublic.com/adding-an-image-upload-field-to-categories/
**/

    if ( ! class_exists( 'CT_TAX_META' ) ) {

        class CT_TAX_META {

            public function __construct() {
                //
            }
        
            /*
            * Initialize the class and start calling our hooks and filters
            * @since 1.0.0
            */
            public function init() {
                add_action( 'category_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
                add_action( 'created_category', array ( $this, 'save_category_image' ), 10, 2 );
                add_action( 'category_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
                add_action( 'edited_category', array ( $this, 'updated_category_image' ), 10, 2 );
                add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
                add_action( 'admin_footer', array ( $this, 'add_script' ) );
            }

            public function load_media() {
                wp_enqueue_media();
            }
        
            /*
            * Add a form field in the new category page
            * @since 1.0.0
            */
            public function add_category_image ( $taxonomy ) {
?>
                <div class="form-field term-group">
                    <label for="category-image-id"><?php _e('Image', 'hero-theme'); ?></label>
                    <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
                    <div id="category-image-wrapper"></div>
                    <p>
                    <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
                    <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
                    </p>
                </div>
<?php
            }
    
            /*
            * Save the form field
            * @since 1.0.0
            */
            public function save_category_image ( $term_id, $tt_id ) {
                if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
                    $image = $_POST['category-image-id'];
                    add_term_meta( $term_id, 'category-image-id', $image, true );
                }
            }
        
            /*
            * Edit the form field
            * @since 1.0.0
            */
            public function update_category_image ( $term, $taxonomy ) {
?>
                <tr class="form-field term-group-wrap">
                    <th scope="row">
                    <label for="category-image-id"><?php _e( 'Image', 'hero-theme' ); ?></label>
                    </th>
                    <td>
                    <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
                    <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
                    <div id="category-image-wrapper">
                        <?php if ( $image_id ) { ?>
                        <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
                        <?php } ?>
                    </div>
                    <p>
                        <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
                        <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
                    </p>
                    </td>
                </tr>
<?php
            }

            /*
            * Update the form field value
            * @since 1.0.0
            */
            public function updated_category_image ( $term_id, $tt_id ) {
                if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
                    $image = $_POST['category-image-id'];
                    update_term_meta ( $term_id, 'category-image-id', $image );
                } else {
                    update_term_meta ( $term_id, 'category-image-id', '' );
                }
            }

            /*
            * Add script
            * @since 1.0.0
            */
            public function add_script() {
?>
                <script>
                    jQuery(document).ready( function($) {
                        function ct_media_upload(button_class) {
                            var _custom_media = true,
                            _orig_send_attachment = wp.media.editor.send.attachment;
                            $('body').on('click', button_class, function(e) {
                                var button_id = '#'+$(this).attr('id');
                                var send_attachment_bkp = wp.media.editor.send.attachment;
                                var button = $(button_id);
                                _custom_media = true;
                                wp.media.editor.send.attachment = function(props, attachment){
                                    if ( _custom_media ) {
                                        $('#category-image-id').val(attachment.id);
                                        $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                                        $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
                                    } else {
                                        return _orig_send_attachment.apply( button_id, [props, attachment] );
                                    }
                                }
                                wp.media.editor.open(button);
                                return false;
                            });
                        }
                        ct_media_upload('.ct_tax_media_button.button'); 
                        $('body').on('click','.ct_tax_media_remove',function(){
                            $('#category-image-id').val('');
                            $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                        });
                        // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
                        $(document).ajaxComplete(function(event, xhr, settings) {
                            var queryStringArr = settings.data.split('&');
                            if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
                                var xml = xhr.responseXML;
                                $response = $(xml).find('term_id').text();
                                if($response!=""){
                                    // Clear the thumb image
                                    $('#category-image-wrapper').html('');
                                }
                        }
                    });
                });
            </script>
<?php
            }

        }
    
        $CT_TAX_META = new CT_TAX_META();
        $CT_TAX_META -> init();
 
    }
?>