<?php
global $my_post,$last_postid;

$user_email = $user_data->user_email;
$user_name = $user_data->user_nicename;
$fromEmail = $current_user->data->user_email;
$fromEmailName = $current_user->data->display_name;
$toEmail = get_site_emailId();
$toEmailName = get_site_emailName();
$subject = __( 'New Question Added of ID:#' ) . $last_postid;

$message  = __( '<p><b>Dear Admin</b></p>' );
$message  .= __( "<p>New Question submitted by $fromEmailName(" . $fromEmail . '). </p>' );
$message .= __( '<p>Question Title : ' . $my_post['post_title'] . '</p>' );
$message .= __( "<p>Question ID: $last_postid</p>" );
$message .= __( '<p>Date: ' . date( 'Y-m-d' ) . '</p>' );
$message .= __( '<p>Thank You.</p>' );

sendEmail( $fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$message,$extra = '' );///forgot password email

