<div id="sign_up">
 <?php if ( $_REQUEST['page1'] == '' ) {?>
<h4><?php
if ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'login' && $_REQUEST['page1'] == 'sign_up' ) {
	_e( REGISTRATION_NOW_TEXT );
} else {
	_e( REGISTRATION_NOW_TEXT );
}
	?></h4>
 
<?php }?>
	<?php
	if ( $_REQUEST['emsg'] == 1 ) {
		if ( isset( $_SESSION['error']['username_exists'][0] ) ) {
			echo '<p class="error_msg_fix"> ' . $_SESSION['error']['username_exists'][0] . ' </p>';
		}
		if ( isset( $_SESSION['error']['email_exists'][0] ) ) {
			echo '<p class="error_msg_fix"> ' . $_SESSION['error']['email_exists'][0] . ' </p>';
		}
		if ( isset( $_SESSION['error']['fullname_exists'][0] ) ) {
			echo '<p class="error_msg_fix"> ' . $_SESSION['error']['fullname_exists'][0] . ' </p>';
		}
	} elseif ( $_REQUEST['emsg'] == 'captch' ) {
		echo '<p class="error_msg_fix"> ' . __( 'Please enter correct Verification Code.' ) . ' </p>';
	}
?> 

<div class="login_content">
<?php echo stripslashes( get_option( 'ptthemes_reg_page_content' ) );?>
</div>


<div class="registration_form_box">
   
 <form name="registerform" id="registerform" action="<?php echo get_option( 'siteurl' ) . '/?ptype=login&amp;action=register'; ?>" method="post">
	<?php wp_nonce_field( 'register_action','register_nonce_field' ); ?>
 <input type="hidden" name="reg_redirect_link" value="<?php echo $_SERVER['HTTP_REFERER'];?>" />	 
  <h5 class="rfh"><?php _e( PERSONAL_INFO_TEXT );?> </h5> 

<div class="form_row clearfix">
  <label><?php _e( 'Username','templatic' ) ?> <span class="indicates">*</span></label>
  <input type="text" name="user_login1reg" id="user_login1reg" class="textfield" value="" size="25" />
	<div id="reg_passmail">
		<?php _e( 'Username must be unique and without any spaces.','templatic' ) ?>
	</div>
	<span id="user_login1regInfo"></span>
</div>

<div class="form_row clearfix">
  <label><?php _e( EMAIL_TEXT ) ?> <span class="indicates">*</span></label>
  <input type="text" name="user_email" id="user_email" class="textfield" value="<?php echo esc_attr( stripslashes( $user_email ) ); ?>" size="25" />
	<div id="reg_passmail">
		<?php _e( REGISTRATION_MESSAGE ) ?>
	</div>
	<span id="user_emailInfo"></span>
</div>
	
	<div class="form_row clearfix">
  <label><?php _e( 'Password' ) ?> <span class="indicates">*</span></label>
  <input type="password" name="user_pwd" id="user_pwd" class="textfield" value="<?php echo esc_attr( stripslashes( $user_pwd ) ); ?>" size="25" />
	<div id="reg_passmail">
		<?php _e( '(note: password should be minimum of 5 characters long.) ' ) ?>
	</div>
	<span id="user_pwdInfo"></span>
</div>

	
	<div class="row_spacer_registration clearfix" >
	<div class="form_row clearfix">
	  <label>
		<?php _e( 'Full Name' ) ?>
	   <span class="indicates">*</span></label>
	  <input type="text" name="user_fname" id="user_fname" class="textfield" value="<?php echo esc_attr( stripslashes( $user_fname ) ); ?>" size="25"  />
	   <span id="user_fnameInfo"></span>
	</div>
	
	
	</div> 
				
	
	<?php do_action( 'register_form' ); ?>
	
	<div class="fix"></div>
	<h5><?php _e( OTHER_INFO_TEXT ) ?></h5>
	<div class="form_row clearfix">
	  <label>
		<?php _e( YR_WEBSITE_TEXT ) ?>
	  </label>
	  <input type="text" name="user_web" id="user_web" class="textfield" value="<?php echo esc_attr( stripslashes( $user_web ) ); ?>" size="25" />
	</div>
	 <div class="form_row clearfix">
	  <label>
		<?php _e( PHONE_NUMBER_TEXT ) ?>
	  </label>
	  <input type="text" name="user_phone" id="user_phone" class="textfield" value="<?php echo esc_attr( stripslashes( $user_phone ) ); ?>" size="25" />
	</div>
	<div class="form_row clearfix">
	  <label>
		<?php _e( TWITTER_TEXT ) ?>
	  </label>
	  <input type="text" name="user_twitter" id="user_twitter" class="textfield" value="<?php echo esc_attr( stripslashes( $user_twitter ) ); ?>" size="25" />
	</div>
	<div class="form_row clearfix">
	  <label>
		<?php _e( 'Facebook URL' ) ?>
	  </label>
	  <input type="text" name="user_facebook" id="user_facebook" class="textfield" value="<?php echo esc_attr( stripslashes( $user_facebook ) ); ?>" size="25" />
	</div>
		<?php if ( function_exists( 'pt_get_captch' ) ) {pt_get_captch(); }
		$pcd = explode( ',',get_option( 'ptthemes_recaptcha_reg_flag' ) );
		  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( (in_array( 'User Registration Page',$pcd ) || in_array( 'All of them',$pcd )) ) {
					echo '<div class="form_row clearfix">';
					echo '<div id="userform_register_cap" style="margin-left:194px;"></div>';
					echo '</div>';
		} ?>

		  <input type="submit" name="registernow" value="<?php _e( REGISTER_NOW_TEXT );?>" class="btn_input_highlight btn_spacer" />


   </form>
   
   </div>
</div>
