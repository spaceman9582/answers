<?php
function pt_get_captch() {
	global $captchaimagepath;
	$captchaimagepath = get_bloginfo( 'template_url' ) . '/library/captcha/';
?>
<h5 class="rfh"><?php _e( 'Verification Code' );?></h5> 
<div class="form_row clearfix">
<label><?php _e( 'Enter Verification Code' );?></label>
<input type="text" name="captcha" size="6" maxlength="6" style="width:80px; margin-right:10px;" class="textfield textfield_m"  /> 
<img src="<?php bloginfo( 'template_url' );?>/library/captcha/captcha.php" alt="captcha image" /></div>

<span class="message_note"><?php _e( 'Enter the text as you see in the image.' );?></span>
<?php
}
function pt_check_captch_cond() {
	if ( $_SESSION['captcha'] == $_POST['captcha'] ) {
		return true;
	} else {
		return false;
	}
}
?>
