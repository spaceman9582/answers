<?php

$comment_post_ID = isset( $_POST['comment_post_ID'] ) ? (int) $_POST['comment_post_ID'] : 0;

$post = get_post( $comment_post_ID );

if ( empty( $post->comment_status ) ) {
	do_action( 'comment_id_not_found', $comment_post_ID );
	exit;
}

// get_post_status() will get the parent status for attachments.
$status = get_post_status( $post );

$status_obj = get_post_status_object( $status );

if ( ! comments_open( $comment_post_ID ) ) {
	do_action( 'comment_closed', $comment_post_ID );
	wp_die( __( 'Sorry, comments are closed for this item.' ) );
} elseif ( 'trash' == $status ) {
	do_action( 'comment_on_trash', $comment_post_ID );
	exit;
} elseif ( ! $status_obj->public && ! $status_obj->private ) {
	do_action( 'comment_on_draft', $comment_post_ID );
	exit;
} elseif ( post_password_required( $comment_post_ID ) ) {
	do_action( 'comment_on_password_protected', $comment_post_ID );
	exit;
} else {
	do_action( 'pre_comment_on_post', $comment_post_ID );
}

$comment_author       = ( isset( $_POST['author'] ) )  ? sanitize_text_field( $_POST['author'] ) : null;
$comment_author_email = ( isset( $_POST['email'] ) )   ? $_POST['email'] : null;
$comment_author_url   = ( isset( $_POST['url'] ) )     ? sanitize_text_field( $_POST['url'] ) : null;
$comment_content      = ( isset( $_POST['comment'] ) ) ? sanitize_text_field( $_POST['comment'] ) : null;
$comment1             = ( isset( $_POST['comment1'] ) ) ? sanitize_text_field( $_POST['comment1'] ) : null;
$comment2             = ( isset( $_POST['comment2'] ) ) ? sanitize_text_field( $_POST['comment2'] ) : null;


// If the user is logged in
$user = wp_get_current_user();
if ( $user->ID ) {
	if ( empty( $user->display_name ) ) {
		$user->display_name = $user->user_login;
	}
	$comment_author       = $wpdb->escape( $user->display_name );
	$comment_author_email = $wpdb->escape( $user->user_email );
	$comment_author_url   = $wpdb->escape( $user->user_url );
	if ( current_user_can( 'unfiltered_html' ) ) {
		if ( esc_attr( wp_create_nonce( 'unfiltered-html-comment_' . $comment_post_ID ) ) != $_POST['_wp_unfiltered_html_comment'] ) {
			kses_remove_filters(); // start with a clean slate
			kses_init_filters(); // set up the filters
		}
	}
} else {
	if ( get_option( 'comment_registration' ) || 'private' == $status ) {
		wp_die( __( 'Sorry, you must be logged in to post a comment.' ) );
	}
}

$comment_type = '';

if ( get_option( 'require_name_email' ) && ! $user->ID ) {
	if ( 6 > strlen( $comment_author_email ) || '' == $comment_author ) {
		wp_die( __( 'Error: please fill the required fields (name, email).' ) );
	} elseif ( ! is_email( $comment_author_email ) ) {
		wp_die( __( 'Error: please enter a valid email address.' ) );
	}
}

if ( '' == $comment_content ) {
	wp_die( __( 'Error: please type a comment.' ) );
}

$comment_parent = isset( $_POST['comment_parent'] ) ? absint( $_POST['comment_parent'] ) : 0;
global $current_user,$user;
$user_id = $current_user->data->ID;
$user  = $current_user;

$commentdata = compact( 'comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_id' );

$comment_id = wp_new_comment( $commentdata );


//====01.27 saijiro=============================
if($comment1 != null){
    add_comment_meta($comment_id, 'comment1', $comment1);
}

if($comment2 != null){
    add_comment_meta($comment_id, 'comment2', $comment2);
}
//====01.27 saijiro=============================


$comment = get_comment( $comment_id );
if ( ! $user->ID ) {
	$comment_cookie_lifetime = apply_filters( 'comment_cookie_lifetime', 30000000 );
	setcookie( 'comment_author_' . COOKIEHASH, $comment->comment_author, time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN );
	setcookie( 'comment_author_email_' . COOKIEHASH, $comment->comment_author_email, time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN );
	setcookie( 'comment_author_url_' . COOKIEHASH, esc_url( $comment->comment_author_url ), time() + $comment_cookie_lifetime, COOKIEPATH, COOKIE_DOMAIN );
}

$location = empty( $_POST['redirect_to'] ) ? get_comment_link( $comment_id ) : $_POST['redirect_to'] . '#comment-' . $comment_id;
$location = apply_filters( 'comment_post_redirect', $location, $comment );
$wpdb->query( "update $wpdb->comments set user_id=\"$user_ID\" where comment_ID=\"$comment_id\"" );
wp_redirect( $location );

