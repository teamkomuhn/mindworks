<?php

    $comment_send = 'Send';
    $comment_reply = 'Leave us a Message';
    
    $comment_author = 'Name';
    $comment_email = 'E-Mail';
    $comment_body = 'Write here your message or feedback.';
    $comment_cookies = 'Save my name and email in this browser for the next time I comment.<br>We respect your privacy and will not publish your personal details. Read our';
    $comment_privacy_policy_link = 'https://docs.google.com/document/d/1SBKEhdD9D9nTdGMZbxMUaOvrSW1ZWH3LjeNQ-uGDrZg/edit?usp=sharing';
    $comment_privacy_policy = 'Privacy Policy';
    

    $comment_before = 'copy here';
    $comment_after = 'Thanks for leaving us your message/feedback! We\'ll get back to you soon.';


	$args = array(
		'fields' => apply_filters( 'comment_form_default_fields', array(
	
						'author'    => '<input id="author" name="author" type="text" placeholder="'. $comment_author .'" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30"' . $aria_req . ' />',
					
						'email'     => '<input id="email" name="email" type="text" placeholder="'. $comment_email .'" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' /></p>',
                        'cookies'   => '<p class="comment-form-cookies-consent">
                                            <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />
                                            ' . $comment_cookies . '
                                            <a href="'. $comment_privacy_policy_link .'" title="' . $comment_privacy_policy . '">' . $comment_privacy_policy . '</a></p>',
				
		) ),
		'comment_field'         => '<textarea id="comment" name="comment" aria-required="true" placeholder="'. $comment_body .'"></textarea>',
        'comment_notes_before'  => '<p class="comment-notes">'. $comment_before .'</p>',
        'comment_notes_after'   => '<p class="comment-notes">'. $comment_after .'</p>',
        //'id_form'              => 'commentform',
        //'id_submit'            => 'submit',
        //'class_container'      => 'comment-respond',
        //'class_form'           => 'comment-form',
        //'class_submit'         => 'submit',
        //'name_submit'          => 'submit',
        'title_reply'          => $comment_reply,
        /* translators: %s: Author of the comment being replied to. */
        //'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
        //'cancel_reply_before'  => ' <small>',
        //'cancel_reply_after'   => '</small>',
        //'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => $comment_send,
        //'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        //'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
        //'format'               => 'xhtml',
	
	);
	comment_form( $args );



?>
