<?php

    global $comment_field_placeholder, $submit_button_text;

    if($comment_field_placeholder == ''){ 
        $comment_field_placeholder = 'Write here your message'; 
    }
    if($submit_button_text == ''){ 
        $submit_button_text = 'Send'; 
    }
    // START WP COMMENTS TEMPLATE

    //Comment Field Order
    function mw_comment_fields_custom_order( $fields ) {
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
    add_filter( 'comment_form_fields', 'mw_comment_fields_custom_order' );

    //Remove cancel reply link
    add_filter( 'cancel_comment_reply_link', '__return_false' );

	$commentsArgs = array(
        'title_reply'               => '',
        'title_reply_before'        => '',
        'title_reply_after'         => '',
        'cancel_reply_before'       => '',
        'cancel_reply_after'        => '',
        'comment_notes_before'      => '',

		'fields' => apply_filters( 'comment_form_default_fields', array(

						'author'    => '<input id="author" name="author" type="text" placeholder="Name" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30"' . $aria_req . ' />',

						'email'     => '<input id="email" name="email" type="email" placeholder="E-mail" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' /></p>',

                        'cookies'   => '',

		) ),
		'comment_field'             => '<textarea id="comment" name="comment" aria-required="true" placeholder="'. $comment_field_placeholder.'"></textarea>',
        // 'comment_notes_after'    => '<p class="comment-notes">Thanks for leaving us your message/feedback! We\'ll get back to you soon.</p>',
        //'id_form'                 => 'commentform',
        //'id_submit'               => 'submit',
        //'class_container'         => 'comment-respond',
        //'class_form'              => 'comment-form',
        //'class_submit'            => 'submit',
        //'name_submit'             => 'submit',

        'submit_button'             => '<input name="%1$s" type="submit" id="%2$s" class="%3$s button" value="%4$s" />',
        'label_submit'              => $submit_button_text
	);

	comment_form( $commentsArgs );

?>