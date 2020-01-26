<?php
ob_start();
if ( ! $current_user->ID ) {
	wp_redirect( get_settings( 'home' ) . '/index.php?ptype=login&page1=sign_in' );
	exit;
}
global $wpdb;

if ( $_POST ) {
	if ( $_REQUEST['chagepw'] ) {
		$new_passwd = $_POST['new_passwd'];
		if ( $new_passwd ) {
			$user_id = $current_user->ID;
			wp_set_password( $new_passwd, $user_id );
			$message1 = PW_CHANGE_SUCCESS_MSG;
		}
	} else {
		if ( $_POST['user_fname'] == '' ) {
			$_SESSION['session_message'] = 'Please enter Full Name';
			wp_redirect( get_option( 'siteurl' ) . '/?ptype=profile' );
			exit;
		}
		$user_id = $current_user->ID;
		$user_web = sanitize_text_field( $_POST['user_web'] );
		$user_twitter = sanitize_text_field( $_POST['user_twitter'] );
		$user_facebook = sanitize_text_field( $_POST['user_facebook'] );
		$description = $_POST['description'];
		 $user_photo = sanitize_text_field( $_POST['user_photo'] );

		//code to upload file

		$user_address_info = array(
							'user_phone' 	=> $_POST['user_phone'],
							'user_twitter'	=> $user_twitter,
							'user_facebook'	=> $user_facebook,
							'description'	=> addslashes( $description ),
							);

		if ( $_FILES['user_photo']['name'] && $_FILES['user_photo']['error'] == 0 && $_FILES['user_photo']['size'] > 0 ) {
			$src = $_FILES['user_photo']['tmp_name'];
			$dest_path = get_image_phy_destination_path_user() . date( 'Ymdhis' ) . '_' . $_FILES['user_photo']['name'];
			$user_photo = image_resize_custom( $src,$dest_path,150,150 );
			$photo_path = get_image_rel_destination_path_user() . $user_photo['file'];
			if ( $user_photo['file'] ) {
				$user_address_info['user_photo'] = $photo_path;
			}
			if ( ! $user_photo['file'] ) {
				$userphoto_err = __( '<br/>Image not uploaded, There is something wrong.' );
			}
		}
		foreach ( $user_address_info as $key => $val ) {
			update_usermeta( $user_id, $key, $val ); // User Address Information Here
		}
		$userName = sanitize_text_field( $_POST['user_fname'] );
		$updateUsersql = "update $wpdb->users set user_url=\"$user_web\", display_name=%s where ID=%d";
		$wpdb->query( $wpdb->prepare( $updateUsersql,$userName,$user_id ) );
		$_SESSION['session_message'] = INFO_UPDATED_SUCCESS_MSG . $userphoto_err;
		wp_redirect( get_option( 'siteurl' ) . '/?ptype=profile' );
		exit;
	}// End if().
}// End if().

$user_address_info = $current_user;
$user_phone = $user_address_info->user_phone;
$user_twitter = $user_address_info->user_twitter;
$user_facebook = $user_address_info->user_facebook;
$description = $user_address_info->description;
$user_photo = $user_address_info->user_photo;
$display_name = $current_user->display_name;
$user_web = $current_user->user_url;
//$display_name_arr = explode(' ',$display_name);
$user_fname = $display_name;
//$user_lname = $display_name_arr[1];
?>

<?php get_header(); ?>

<div id="content">
 
		<h1 class="page_head"><?php _e( 'Edit Profile' );?>   <span class="fr"> <b class="indicates">* </b> <?php _e( 'Indicates mandatory field' );?>s</span></h1>

				
						<?php
						if ( @$_SESSION['session_message'] ) {
							echo '<div class="sucess_msg">' . $_SESSION['session_message'] . '</div>';
							$_SESSION['session_message'] = '';
						}
?>
		 
	   <form name="registerform" id="registerform" action="<?php echo get_option( 'siteurl' ) . '/?ptype=profile'; ?>" method="post" enctype="multipart/form-data" >

			 <div class="form_row clearfix ">
		<label><?php _e( 'Full Name' ) ?> <span class="indicates">*</span></label>
		<input type="text" name="user_fname" id="user_fname" class="textfield" value="<?php echo esc_attr( stripslashes( $user_fname ) ); ?>" size="25" />
		<span class="message_error2" id="user_fname_span"></span>
	  </div>
	  <div class="form_row clearfix ">
		<label><?php _e( YR_WEBSITE_TEXT ) ?></label>
		<input type="text" name="user_web" id="user_web" class="textfield" value="<?php echo esc_attr( stripslashes( $user_web ) ); ?>" size="25" />
	  </div>
	  <div class="form_row clearfix ">
		<label><?php _e( YR_TWITTER_TEXT ) ?></label>
		<input type="text" name="user_twitter" id="user_twitter" class="textfield" value="<?php echo esc_attr( stripslashes( $user_twitter ) ); ?>" size="25" />
	  </div>

			 <div class="form_row clearfix ">
		<label><?php _e( 'Your Facebook URL' ) ?></label>
		<input type="text" name="user_facebook" id="user_facebook" class="textfield" value="<?php echo esc_attr( stripslashes( $user_facebook ) ); ?>" size="25" />
	  </div>
	  <div class="form_row clearfix ">
		<label><?php _e( YR_DESCRIPTION_TEXT ) ?></label>
		<textarea name="description" id="description" class="textarea"><?php echo esc_attr( stripslashes( $description ) ); ?></textarea>
	  </div>
	  <div class="form_row clearfix ">
		<label><?php _e( YR_PICTURE_TEXT ) ?></label>
		<input type="file" name="user_photo" id="user_photo"  class="textfield"	/>
		<span class="message_note"><?php _e( IMAGE_TYPE_MSG );?></span>
		 <div style="margin-top:10px; clear:both; padding:10px 0; "> <?php get_user_profile_pic( $current_user->ID,100,100 ); ?> </div>
	   </div>
	  
	  
	  <div class="form_row clearfix ">
		<label>
		<?php _e( PHONE_NUMBER_TEXT ) ?>
		</label>
		<input type="text" name="user_phone" id="user_phone" class="textfield" value="<?php echo esc_attr( stripslashes( $user_phone ) ); ?>" size="25" />
	  </div>
   <input type="submit" name="Update" value="<?php _e( EDIT_PROFILE_UPDATE_BUTTON );?>" class="btn_input_highlight btn_spacer" onclick="return chk_edit_profile();" />
   
   <input type="button" name="Cancel" value="Cancel" class="btn_input_normal" onclick="window.location.href='<?php echo get_author_posts_url( $current_user->ID );?>'" />
   
</form>
<div id="change_pw">		 
<h5><?php _e( CHANGE_PW_TEXT ); ?>    </h5>

<div class="clearfix"></div>
<form name="changepw_frm" id="changepw_frm" action="<?php echo get_option( 'siteurl' ) . '/?ptype=profile&chagepw=1'; ?>" method="post">
<?php if ( @$message1 ) { ?>
  <div class="sucess_msg"> <?php _e( PW_CHANGE_SUCCESS_MSG ); ?> </div>
  </td>
	<?php } ?>
 
		<div class="form_row clearfix">
		<label>
		<?php _e( NEW_PW_TEXT ); ?> <span class="indicates">*</span></label>   
		<input type="password" name="new_passwd" id="new_passwd"  class="textfield" />
		 <span id="new_passwdInfo"></span>
		</div>
		<div class="form_row clearfix ">
		<label>
		<?php _e( CONFIRM_NEW_PW_TEXT ); ?> <span class="indicates">*</span></label>
		<input type="password" name="cnew_passwd" id="cnew_passwd"  class="textfield" />
		<span id="cnew_passwdInfo"></span>
		</div>
		 <input type="submit" name="Update" value="<?php _e( EDIT_PROFILE_UPDATE_BUTTON ) ?>" class="btn_input_highlight btn_spacer" />
		 <input type="button" name="Cancel" value="Cancel" class="btn_input_normal" onclick="window.location.href='<?php echo get_author_posts_url( $current_user->ID );?>'" />
</form>
</div>
			 

				
				</div> <!-- content #end -->
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/library/js/jquery-1.6.2.min.js" ></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/library/js/edit_profile.js"></script>         
		<?php get_sidebar(); ?>  

			<?php get_footer(); ?>
