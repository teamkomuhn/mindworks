<?php

add_action('admin_init', 'admin_init');

function admin_init(){

    add_meta_box( 'gpminvoice-group', 'How to', 'how_to_steps', 'page', 'normal', 'default');

	add_meta_box('opengraph_meta', 'Preview image', 'opengraph_meta', array('post', 'page'), 'side', 'high');

    //MW Tools
    //add_meta_box('label_meta', 'Label', 'label_meta', array('post', 'page'), 'side', 'high');
    //add_meta_box('cover_meta', 'Cover', 'cover_meta', array('post', 'page'), 'side', 'high');
	//add_meta_box('infographic_meta', 'Infographic', 'infographic_meta', array('post', 'page'), 'side', 'high');

}

function how_to_steps() {
    global $post;
    $gpminvoice_group = get_post_meta($post->ID, 'customdata_group', true);
     wp_nonce_field( 'gpm_repeatable_meta_box_nonce', 'gpm_repeatable_meta_box_nonce' );
    ?>

    <script type="text/javascript">
        jQuery(document).ready(function( $ ){
            $( '#add-row' ).on('click', function() {
                var row = $( '.empty-row.screen-reader-text' ).clone(true);
                row.removeClass( 'empty-row screen-reader-text' );
                row.insertBefore( '#repeatable-fieldset-one tbody>tr:last' );
                return false;
            });

            $( '.remove-row' ).on('click', function() {
                $(this).parents('tr').remove();
                return false;
            });
        });
    </script>

    <table id="repeatable-fieldset-one" width="100%">

        <tbody>

            <?php
                if ( $gpminvoice_group ) :
                    foreach ( $gpminvoice_group as $field ) {
            ?>

            <!-- <td width="15%">
                    <input type="text"  placeholder="Title" name="TitleItem[]" value="<?php if($field['TitleItem'] != '') echo esc_attr( $field['TitleItem'] ); ?>" /></td> 
                <td width="70%">
                    <?php 
                     $meta_content = wpautop( get_post_meta($post_id, 'TitleDescription', true),true);
                     wp_editor($meta_content, 'meta_content_editor', array(
                             'wpautop'       =>  true,
                             'media_buttons' =>  false,
                             'textarea_name' =>  'TitleDescription[]',
                             'textarea_rows' =>  10,
                             'teeny'         =>  true
                     ));
                     ?>
                </td>
                <td width="15%"><a class="button remove-row" href="#1">Remove</a></td>
            -->
            <tr>
                <td width="15%">
                    <input type="text"  placeholder="Title" name="TitleItem[]" value="<?php if($field['TitleItem'] != '') echo esc_attr( $field['TitleItem'] ); ?>" /></td> 
                <td width="70%">
                    <textarea placeholder="Description" cols="55" rows="5" name="TitleDescription[]"> <?php if ($field['TitleDescription'] != '') echo esc_attr( $field['TitleDescription'] ); ?> </textarea>
                </td>
                <td width="15%"><a class="button remove-row" href="#1">Remove</a></td>
            </tr>

            <?php
                }
                else :
                // show a blank one
            ?>

            <tr>
                <td> 
                    <input type="text" placeholder="Title" title="Title" name="TitleItem[]" /></td>
                <td> 
                    <textarea  placeholder="Description" name="TitleDescription[]" cols="55" rows="5">  </textarea>
                </td>
                <td><a class="button  cmb-remove-row-button button-disabled" href="#">Remove</a></td>
            </tr>

            <?php endif; ?>

            <!-- empty hidden one for jQuery -->
            <tr class="empty-row screen-reader-text">
                <td>
                    <input type="text" placeholder="Title" name="TitleItem[]"/></td>
                <td>
                    <textarea placeholder="Description" cols="55" rows="5" name="TitleDescription[]"></textarea>
                </td>
                <td><a class="button remove-row" href="#">Remove</a></td>
            </tr>

        </tbody>

    </table>

    <p><a id="add-row" class="button" href="#">Add another</a></p>

    <?php
}

add_action('save_post', 'how_to_steps_save');

function how_to_steps_save($post_id) {
    if ( ! isset( $_POST['gpm_repeatable_meta_box_nonce'] ) ||
    ! wp_verify_nonce( $_POST['gpm_repeatable_meta_box_nonce'], 'gpm_repeatable_meta_box_nonce' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'customdata_group', true);
    $new = array();
    $invoiceItems = $_POST['TitleItem'];
    $prices = $_POST['TitleDescription'];
    $count = count( $invoiceItems );

    for ( $i = 0; $i < $count; $i++ ) {
        if ( $invoiceItems[$i] != '' ) :
            $new[$i]['TitleItem'] = stripslashes( strip_tags( $invoiceItems[$i] ) );
            $new[$i]['TitleDescription'] = stripslashes( $prices[$i] ); // and however you want to sanitize
        endif;
    }

    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'customdata_group', $new );
    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'customdata_group', $old );

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