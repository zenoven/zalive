<?php
/**
 * reply template
 */
  $commenter = wp_get_current_commenter();
  $user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
  $req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

  $args = array(
    'title_reply'       => __( 'Leave a Reply' , 'zAlive' ),
    'title_reply_to'    => __( 'Leave a Reply to %s' , 'zAlive' ),
    'cancel_reply_link' => __( 'Cancle Reply' , 'zAlive' ),
    'label_submit'      => _x( 'Post Comment' , 'submit comment' , 'zAlive' ),

    'comment_field' =>  '<p class="comment-form-comment row-fluid"><label for="comment" class="span2">' . _x( 'Comment', 'noun' , 'zAlive' ) .
      '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="span9">' .
      '</textarea></p>',

    'must_log_in' => '<p class="must-log-in">' .
      sprintf(
        __( 'You must be <a href="%s">logged in</a> to post a comment.','zAlive' ),
        wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
      ) . '</p>',

    'logged_in_as' => '<p class="logged-in-as">' .
      sprintf(
      __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','zAlive' ),
        admin_url( 'profile.php' ),
        $user_identity,
        wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
      ) . '</p>',

    'comment_notes_before' => '',

    'comment_notes_after' => '',

    'fields' => apply_filters( 'comment_form_default_fields', array(

      'author' =>
        '<p class="comment-form-author row-fluid">' .
        '<label for="author" class="span2">' . __( 'Name', 'zAlive' ) . ( $req ? '<span class="required">('. __( 'required', 'zAlive' ) .')</span>' : '' ) . '</label>' .
        '<input  class="span4" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . ' /></p>',

      'email' =>
        '<p class="comment-form-email row-fluid"><label for="email" class="span2">' . __( 'Email', 'zAlive' ) . ( $req ? '<span class="required">('. __( 'required', 'zAlive' ) .')</span>' : '' ) . '</label>' .
        '<input class="span4" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . $aria_req . ' /></p>',

      'url' =>
        '<p class="comment-form-url row-fluid"><label for="url" class="span2">' .
        __( 'Website', 'zAlive' ) . '</label>' .
        '<input  class="span4" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" /></p>'
      )
    ),
  );

  comment_form($args); 

?>