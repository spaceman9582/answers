<?php
if ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'phpinfo' ) {
	echo phpinfo();
	exit;
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'author_answers' ) {
	include( TEMPLATEPATH . '/library/includes/author.php' );
	exit;
} elseif ( isset( $_REQUEST['ptype'] ) && (isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'register' && ( isset( $_POST['register_nonce_field'] ) || wp_verify_nonce( $_POST['register_nonce_field'], 'register_action' ) )) || isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'login' ) {
	include( TEMPLATEPATH . '/library/includes/registration.php' );
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'crating' ) {
	include( TEMPLATEPATH . '/library/includes/comment_rating_todb.php' );
	exit;
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'add_comments' ) {
	include( TEMPLATEPATH . '/library/functions/add_comments.php' );
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'dashboard' ) {
	include( TEMPLATEPATH . '/library/includes/dashboard.php' );
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'profile' ) {
	include( TEMPLATEPATH . '/library/includes/edit_profile.php' );
	exit;
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'property_submit' ) {
	if ( is_user_can_add_property() ) {
		include( TEMPLATEPATH . '/library/includes/property_frm_with_reg.php' );
	} else {
		wp_redirect( get_option( 'siteurl' ) );
	}
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'ask-a-question' ) {
	if ( is_user_add_question() ) {
		include( TEMPLATEPATH . '/library/includes/ask_question_frm.php' );
	} else {
		wp_redirect( get_option( 'siteurl' ) );
	}
} elseif ( (isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'preview') && (isset( $_POST['ask_question_field'] ) ||  wp_verify_nonce( $_POST['ask_question_field'], 'ask_a_question_action' )) ) {
	include( TEMPLATEPATH . '/library/includes/question_preview.php' );
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'paynow' ) {
	include( TEMPLATEPATH . '/library/includes/paynow.php' );
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'cancel_return' ) {
	include( TEMPLATEPATH . '/library/includes/cancel.php' );
	set_question_status( $_REQUEST['pid'],'draft' );
	exit;
} elseif ( isset( $_REQUEST['ptype'] ) && ($_GET['ptype'] == 'return' || $_GET['ptype'] == 'payment_success') ) {  // PAYMENT GATEWAY RETURN
	set_question_status( $_REQUEST['pid'],'publish' );
	include( TEMPLATEPATH . '/library/includes/return.php' );
	exit;
} elseif ( isset( $_REQUEST['ptype'] ) && $_GET['ptype'] == 'success' ) {  // PAYMENT GATEWAY RETURN
	include( TEMPLATEPATH . '/library/includes/success.php' );
	exit;
} elseif ( isset( $_REQUEST['ptype'] ) && $_GET['ptype'] == 'notifyurl' ) {  // PAYMENT GATEWAY NOTIFY URL
	if ( $_GET['pmethod'] == 'paypal' ) {
		include( TEMPLATEPATH . '/library/includes/ipn_process.php' );
	}
	exit;
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'sort_image' ) {
	global $wpdb;
	$arr_pid = explode( ',',$_REQUEST['pid'] );
	for ( $j = 0;$j < count( $arr_pid );$j++ ) {
		$media_id = $arr_pid[ $j ];
		if ( strstr( $media_id,'div_' ) ) {
			$media_id = str_replace( 'div_','',$arr_pid[ $j ] );
		}
		$wpdb->query( 'update wp_posts set  menu_order = "' . $j . '" where ID = "' . $media_id . '" ' );
	}
	echo 'Image order saved successfully';
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'delete' ) {
	global $current_user;
	if ( $_REQUEST['qid'] ) {
		wp_delete_post( $_REQUEST['qid'] );
		wp_redirect( get_author_posts_url( $current_user->data->ID ) );
	}
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'att_delete' ) {
	if ( $_REQUEST['remove'] == 'temp' ) {

		if ( $_SESSION['file_info'] ) {
			$tmp_file_info = array();
			foreach ( $_SESSION['file_info'] as $image_id => $val ) {
				if ( $image_id == $_REQUEST['pid'] ) {
					@unlink( ABSPATH . '/' . $upload_folder_path . 'tmp/' . intval( $_REQUEST['pid'] ) . '.jpg' );
				} else {
					$tmp_file_info[ $image_id ] = $val;
				}
			}
			$_SESSION['file_info'] = $tmp_file_info;
		}
	} else {
			wp_delete_attachment( $_REQUEST['pid'] );
	}
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'send_inqury' ) {
	include( TEMPLATEPATH . '/library/includes/send_inquiry_frm.php' );
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'email_frnd' ) {
	include( TEMPLATEPATH . '/library/includes/email_friend_frm.php' );
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'users' ) {
	include( TEMPLATEPATH . '/library/includes/users.php' );
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'experts' ) {
	include( TEMPLATEPATH . '/library/includes/experts.php' );
} elseif ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'csvdl' ) {

	include( TEMPLATEPATH . '/library/includes/csvdl.php' );
} else {
	get_header(); ?>

<div id="content">
 
		<h1 class="page_head"><?php the_title(); ?></h1>
		<div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '','' ); } ?></p>
	 </div>

				
						<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post() ?>
				<?php $pagedesc = get_post_meta( $post->ID, 'pagedesc', $single = true ); ?>

			
							<div id="post-<?php the_ID(); ?>" >
						<div class="entry"> 
							<?php the_content(); ?>
						</div>
					</div><!--/post-->

							<?php endwhile; else : ?>

							<div class="posts">
						<div class="entry-head"><h2><?php echo get_option( 'ptthemes_404error_name' ); ?></h2></div>
						<div class="entry-content"><p><?php echo get_option( 'ptthemes_404solution_name' ); ?></p></div>
					</div>

				<?php endif; ?>

				 </div> <!-- content #end -->

				<?php get_sidebar(); ?>  

			<?php get_footer();

}// End if().
?>
