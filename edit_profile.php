<?php
session_start();
ob_start();
if ( ! $current_user->data->ID ) {
	wp_redirect( get_settings( 'home' ) . '/index.php?page=login' );
	exit;
}
global $wpdb;

if ( $_POST ) {
	if ( $_REQUEST['chagepw'] ) {
		$new_passwd = $_POST['new_passwd'];
		if ( $new_passwd ) {
			$user_id = $current_user->data->ID;
			wp_set_password( $new_passwd, $user_id );
			$message1 = PW_CHANGE_SUCCESS_MSG;
		}
	} else {
		$user_id = $current_user->data->ID;
		$user_add1 = sanitize_text_field( $_POST['user_add1'] );
		$user_add2 = sanitize_text_field( $_POST['user_add2'] );
		$user_city = sanitize_text_field( $_POST['user_city'] );
		$user_state = sanitize_text_field( $_POST['user_state'] );
		$user_country = sanitize_text_field( $_POST['user_country'] );
		$user_postalcode = sanitize_text_field( $_POST['user_postalcode'] );
		$user_web = sanitize_text_field( $_POST['user_web'] );

		$user_address_info = array(
							'user_add1'		=> $user_add1,
							'user_add2'		=> $user_add2,
							'user_city'		=> $user_city,
							'user_state'	=> $user_state,
							'user_country'	=> $user_country,
							'user_postalcode' => $user_postalcode,
							'user_phone' 	=> $_POST['user_phone'],
							);

		update_usermeta( $user_id, 'user_address_info', serialize( $user_address_info ) ); // User Address Information Here
		$userName = $_POST['user_fname'] . ' ' . $_POST['user_lname'];
		$updateUsersql = "update $wpdb->users set user_url=\"$user_web\",user_nicename=\"$userName\", display_name=\"$userName\"  where ID=\"$user_id\"";
		$wpdb->query( $updateUsersql );
		$_SESSION['session_message'] = INFO_UPDATED_SUCCESS_MSG;
		wp_redirect( get_option( 'siteurl' ) . '/?page=profile' );
		exit;
	}// End if().
}// End if().

$user_address_info = unserialize( $current_user->data->user_address_info );
$user_add1 = $user_address_info['user_add1'];
$user_add2 = $user_address_info['user_add2'];
$user_city = $user_address_info['user_city'];
$user_state = $user_address_info['user_state'];
$user_country = $user_address_info['user_country'];
$user_postalcode = $user_address_info['user_postalcode'];
$user_phone = $user_address_info['user_phone'];
$display_name = $current_user->data->display_name;
$user_web = $current_user->data->user_url;
$display_name_arr = explode( ' ',$display_name );
$user_fname = $display_name_arr[0];
$user_lname = $display_name_arr[2];
?>
<?php get_header(); ?>

<div id="page">
<div id="content-wrap" class="clear" >
 
<h1><?php _e( EDIT_PROFILE_PAGE_TITLE );?></h1>
 <div class="edit_profile_form">
<div class="edit_profile_col alignleft spacer_border">
 <form name="registerform" id="registerform" action="<?php echo get_option( 'siteurl' ) . '/?page=profile'; ?>" method="post">
	<?php
	if ( $_SESSION['session_message'] ) {
		echo '<p>' . $_SESSION['session_message'] . '</p>';
		$_SESSION['session_message'] = '';
	}
	?>
 

		  <h5><?php _e( PERSONAL_INFO_TEXT );?></h5>
	  <div class="edit_profile_row ">
		<label><?php _e( FIRST_NAME_TEXT ) ?> <span class="indicates">*</span></label>
		<input type="text" name="user_fname" id="user_fname" class="textfield" value="<?php echo esc_attr( stripslashes( $user_fname ) ); ?>" size="25" tabindex="20" />
		<span class="message_error2" id="user_fname_span"></span>
	  </div>
	  <div class="edit_profile_row ">
		<label><?php _e( LAST_NAME_TEXT ) ?></label>
		<input type="text" name="user_lname" id="user_lname" class="textfield" value="<?php echo esc_attr( stripslashes( $user_lname ) ); ?>" size="25" tabindex="20" />
	  </div>
	  <div class="edit_profile_row ">
		<label><?php _e( ADDRESS1_TEXT ) ?></label>
		<input type="text" name="user_add1" id="user_add1" class="textfield" value="<?php echo esc_attr( stripslashes( $user_add1 ) ); ?>" size="25" tabindex="20" />
	  </div>
	  <div class="edit_profile_row ">
		<label><?php _e( ADDRESS2_TEXT ) ?></label>
		<input type="text" name="user_add2" id="user_add2" class="textfield" value="<?php echo esc_attr( stripslashes( $user_add2 ) ); ?>" size="25" tabindex="20" />
	  </div>
	  <div class="edit_profile_row ">
		<label><?php _e( CITY_TEXT ) ?></label>
		<input type="text" name="user_city" id="user_city" class="textfield" value="<?php echo esc_attr( stripslashes( $user_city ) ); ?>" size="25" tabindex="20" />
	  </div>
	  <div class="edit_profile_row ">
		<label><?php _e( STATE_TEXT ) ?></label>
		<input type="text" name="user_state" id="user_state" class="textfield" value="<?php echo esc_attr( stripslashes( $user_state ) ); ?>" size="25" tabindex="20" />
	  </div>
	  <div class="edit_profile_row ">
		<label><?php _e( COUNTRY_TEXT ) ?></label>
		<input type="text" name="user_country" id="user_country" class="textfield" value="<?php echo esc_attr( stripslashes( $user_country ) ); ?>" size="25" tabindex="20" />
	  </div>
	  <div class="edit_profile_row ">
		<label><?php _e( POSTAL_CODE_TEXT ) ?></label>
		<input type="text" name="user_postalcode" id="user_postalcode" class="textfield" value="<?php echo esc_attr( stripslashes( $user_postalcode ) ); ?>" size="25" tabindex="20" />
	  </div>
	  <div class="edit_profile_row ">
		<label><?php _e( YR_WEBSITE_TEXT ) ?></label>
		<input type="text" name="user_web" id="user_web" class="textfield" value="<?php echo esc_attr( stripslashes( $user_web ) ); ?>" size="25" tabindex="20" />
	  </div>
	  <div class="edit_profile_row ">
		<label>
		<?php _e( PHONE_NUMBER_TEXT ) ?>
		</label>
		<input type="text" name="user_phone" id="user_phone" class="textfield" value="<?php echo esc_attr( stripslashes( $user_phone ) ); ?>" size="25" tabindex="20" />
	  </div>
   <input type="submit" name="Update" value="<?php _e( EDIT_PROFILE_UPDATE_BUTTON );?>" class="normal_button " onclick="return chk_edit_profile();" />
   
   <input type="button" name="Cancel" value="Cancel" class="normal_button " onclick="window.location.href='<?php echo get_option( 'siteurl' );?>/?page=dashboard'" />
   
</form>
<script language="javascript">
function chk_edit_profile()
{
	document.getElementById('user_fname').className = 'textfield';		
	document.getElementById('user_fname_span').innerHTML = '';
	if(document.getElementById('user_fname').value == '')
	{
		//alert("<?php _e( 'Please enter ' . FIRST_NAME_TEXT ) ?>");
		document.getElementById('user_fname').className = 'textfield error';		
		document.getElementById('user_fname_span').innerHTML = '<?php _e( 'Please enter ' . FIRST_NAME_TEXT );?>';
		document.getElementById('user_fname').focus();
		return false;
	}
	return true;
}
</script>
</div>
<div class="edit_profile_col alignright">
	<h5><?php _e( CHANGE_PW_TEXT ); ?></h5>
<form name="registerform" id="registerform" action="<?php echo get_option( 'siteurl' ) . '/?page=profile&chagepw=1'; ?>" method="post">
<?php if ( $message1 ) { ?>
  <div class="sucess_msg"> <?php _e( PW_CHANGE_SUCCESS_MSG ); ?> </div>
  </td>
	<?php } ?>
 
		<div class="edit_profile_row ">
		<label>
		<?php _e( NEW_PW_TEXT ); ?> <span class="indicates">*</span></label>   
		<input type="password" name="new_passwd" id="new_passwd"  class="textfield" />

					 </div>
		<div class="edit_profile_row ">
		<label>
		<?php _e( CONFIRM_NEW_PW_TEXT ); ?> <span class="indicates">*</span></label>
		<input type="password" name="cnew_passwd" id="cnew_passwd"  class="textfield" />
		</div>

		
				 <input type="submit" name="Update" value="<?php _e( EDIT_PROFILE_UPDATE_BUTTON ) ?>" class="normal_button " onclick="return chk_form_pw();" />

		 
	   
	 </form>

</div>

<script language="javascript">
function chk_form_pw()
{
	if(document.getElementById('new_passwd').value == '')
	{
		alert("<?php _e( 'Please enter ' . NEW_PW_TEXT ) ?>");
		document.getElementById('new_passwd').focus();
		return false;
	}
	if(document.getElementById('new_passwd').value.length < 4 )
	{
		alert("<?php _e( 'Please enter ' . NEW_PW_TEXT . ' minimum 5 chars' ) ?>");
		document.getElementById('new_passwd').focus();
		return false;
	}
	if(document.getElementById('cnew_passwd').value == '')
	{
		alert("<?php _e( 'Please enter ' . CONFIRM_NEW_PW_TEXT ) ?>");
		document.getElementById('cnew_passwd').focus();
		return false;
	}
	if(document.getElementById('cnew_passwd').value.length < 4 )
	{
		alert("<?php _e( 'Please enter ' . CONFIRM_NEW_PW_TEXT . ' minimum 5 chars' ) ?>");
		document.getElementById('cnew_passwd').focus();
		return false;
	}
	if(document.getElementById('new_passwd').value != document.getElementById('cnew_passwd').value)
	{
		alert("<?php _e( NEW_PW_TEXT . ' and ' . CONFIRM_NEW_PW_TEXT . ' should be same' ) ?>");
		document.getElementById('cnew_passwd').focus();
		return false;
	}
}
</script>
	</div>
</div>

<?php get_footer(); ?>
