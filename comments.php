<?php


	$args = array(
		'fields' => apply_filters( 'comment_form_default_fields', array(
	
						'author' =>
						'<input id="author" name="author" type="text" placeholder="Name" value="' . esc_attr( $commenter['comment_author'] ) .
						'" size="30"' . $aria_req . ' />',
					
						'email' =>
						'<input id="email" name="email" type="text" placeholder="E-mail" value="' . esc_attr(  $commenter['comment_author_email'] ) .
						'" size="30"' . $aria_req . ' /></p>',
				
		) ),
		'comment_field' => '<textarea id="comment" name="comment" aria-required="true" placeholder="Message"></textarea>',
        //'id_form'              => 'commentform',
        //'id_submit'            => 'submit',
        //'class_container'      => 'comment-respond',
        //'class_form'           => 'comment-form',
        //'class_submit'         => 'submit',
        //'name_submit'          => 'submit',
        'title_reply'          => __( 'Leave us a message' ),
        /* translators: %s: Author of the comment being replied to. */
        //'title_reply_to'       => __( 'Leave a Reply to %s' ),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
        //'cancel_reply_before'  => ' <small>',
        //'cancel_reply_after'   => '</small>',
        //'cancel_reply_link'    => __( 'Cancel reply' ),
        'label_submit'         => __( 'Send' ),
        //'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        //'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
        //'format'               => 'xhtml',
	
	);
	comment_form( $args );

$comment_send = 'Send';
$comment_reply = 'Leave a Message';
$comment_reply_to = 'Reply';
 
$comment_author = 'Name';
$comment_email = 'E-Mail';
$comment_body = 'Comment';
$comment_url = 'Website';
$comment_cookies_1 = ' By commenting you accept the';
$comment_cookies_2 = ' Privacy Policy';
 
$comment_before = 'Registration isn\'t required.';
 
$comment_cancel = 'Cancel Reply';


?>
