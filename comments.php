<section class="comments">
    <header>
        <h3>Leave us a message</h3>
        <p>If you’d be interested in collaborating, learning more or sharing your feedback and comments please use the form below.</p>
    </header>
    
<?php
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

    //Add select field to comments form for subjects
    // add_filter( 'comment_form_field_comment', function( $field ) {
    //
    //     $subjects = ['I’d like to keep updated about Mindworks’ work',
    //                 'I’d like to share some feedback on this paper or on The Disrupted Mind',
    //                 'I’d love to collaborate',
    //                 'Other'];
    //
    //     $select = '<p><label for="subject_select">Subject:</label>
    //     <select name="subject_select" id="subjectSelect">
    //     <option value="">Select a subject</option>';
    //
    //     foreach ( $subjects as $key => $subject )
    //         $select .= sprintf(
    //             '<option value="%1$s" %2$s>%3$s</option>',
    //             esc_attr( $key ),
    //             ( in_array( $key, $subject) ? 'selected' : '' ), //this is not working properly yet
    //             esc_html( $subject )
    //         );
    //
    //     $select .= '</select></p>';
    //
    //     return $select . $field;
    // });

	$args = array(
        'title_reply'               => '',
        'title_reply_before'        => '',
        'title_reply_after'         => '',
        /* translators: %s: Author of the comment being replied to. */
        //'title_reply_to'          => __( 'Leave a Reply to %s' ),
        //'cancel_reply_link'       => __( 'Cancel reply' ),
        'cancel_reply_before'       => '',
        'cancel_reply_after'        => '',
        'comment_notes_before'      => '',

		'fields' => apply_filters( 'comment_form_default_fields', array(

						'author'    => '<input id="author" name="author" type="text" placeholder="Name" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30"' . $aria_req . ' />',

						'email'     => '<input id="email" name="email" type="email" placeholder="E-mail" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' /></p>',

                        'cookies'   => '',

		) ),
		'comment_field'             => '<textarea id="comment" name="comment" aria-required="true" placeholder="Write here your message or feedback"></textarea>',
        // 'comment_notes_after'    => '<p class="comment-notes">Thanks for leaving us your message/feedback! We\'ll get back to you soon.</p>',
        //'id_form'                 => 'commentform',
        //'id_submit'               => 'submit',
        //'class_container'         => 'comment-respond',
        //'class_form'              => 'comment-form',
        //'class_submit'            => 'submit',
        //'name_submit'             => 'submit',

        'submit_button'             => '<input name="%1$s" type="submit" id="%2$s" class="%3$s button" value="%4$s" />',
        'label_submit'              => 'Send',
        //'submit_field'            => '<p class="form-submit">%1$s %2$s</p>',
        //'format'                  => 'xhtml',
	);
	comment_form( $args );

?>

</section>
