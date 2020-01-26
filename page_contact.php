<?php session_start();
/*
Template Name: Contact Us
*/
?>
<?php
if ( $_POST ) {
	$_SESSION['data_post'] = $_POST;
	$pcd = explode( ',',get_option( 'ptthemes_recaptcha_reg_flag' ) );

	if ( in_array( 'Contact Us',$pcd ) || in_array( 'All of them',$pcd ) ) {
		/*fetch captcha private key*/
		$privatekey = get_option( 'ptthemes_recaptcha_secret' );
		/*get the response from captcha that the entered captcha is valid or not*/
		$response = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $privatekey . '&response=' . $_REQUEST['g-recaptcha-response'] . '&remoteip=' . getenv( 'REMOTE_ADDR' ) );
		/*decode the captcha response*/
		$responde_encode = json_decode( $response['body'] );
		/*check the response is valid or not*/
		if ( ! $responde_encode->success ) {
			wp_redirect( $_REQUEST['request_url'] . '&invalid=1' );
			exit;
		}
	}
	if ( $_POST['your-email'] ) {
		$toEmailName = get_option( 'blogname' );
		$toEmail = get_site_emailId();

		$subject = $_POST['your-subject'];
		$message = '';
		$message .= '<p>Dear ' . $toEmailName . ',</p>';
		$message .= '<p>Name : ' . sanitize_text_field( $_POST['your-name'] ) . ',</p>';
		$message .= '<p>Email : ' . $_POST['your-email'] . ',</p>';
		$message .= '<p>Message : ' . nl2br( $_POST['your-message'] ) . '</p>';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		// Additional headers
		$headers .= 'To: ' . $toEmailName . ' <' . $toEmail . '>' . "\r\n";
		$headers .= 'From: ' . sanitize_text_field( $_POST['your-name'] ) . ' <' . $_POST['your-email'] . '>' . "\r\n";

		// Mail it
		//@mail($toEmail, $subject, $message, $headers);
		wp_mail( $toEmail, $subject, $message, $headers );
		if ( strstr( $_REQUEST['request_url'],'?' ) ) {
			$url = $_REQUEST['request_url'] . '&msg=success'	;
		} else {
			$url = $_REQUEST['request_url'] . '?msg=success'	;
		}
		wp_redirect( $url );
		exit;
	}
}// End if().
?>
<?php get_header();?>
<div id="content">
 
		<h1 class="page_head"><?php the_title(); ?></h1>
		<div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '','' ); } ?></p>
	 </div>

				<?php
				global $post;
				echo $post->post_content;
			?>
		
					  <div class="registration_form_box">

				<?php
				if ( $_REQUEST['msg'] == 'success' ) {
					$_SESSION['data_post'] = '';
					?>
					<p class="success_msg"><?php _e( CONTACT_PAGE_SUCCESS_MSG );?></p>
				<?php
				}
				if ( $_REQUEST['invalid'] == 1 ) { ?>
					<p class="success_msg"><?php echo 'Invalid Captcha. Please try again.';?></p>
					<?php }
			?>
			 
			<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" id="contact_frm" name="contact_frm" class="wpcf7-form">
			<input type="hidden" name="request_url" value="<?php echo $_SERVER['REQUEST_URI'];?>" />

			<div class="form_row clearfix"> <label> <?php _e( NAME_CONTACT_TEXT );?>  <span class="indicates">*</span></label>
				   <input type="text" name="your-name" id="your-name" value="<?php if ( isset( $_SESSION['data_post']['your-name'] ) && $_SESSION['data_post']['your-name'] != '' ) { echo $_SESSION['data_post']['your-name']; } ?>" class="textfield" size="40" />
				<span id="your_name_Info" class="error_msg"></span>
		   </div>

					   <div class="form_row clearfix"><label><?php _e( EMAIL_CONTACT_TEXT );?> <span class="indicates">*</span></label>
				  <input type="text" name="your-email" id="your-email" value="<?php if ( isset( $_SESSION['data_post']['your-email'] ) && $_SESSION['data_post']['your-email'] != '' ) { echo $_SESSION['data_post']['your-email']; } ?>" class="textfield" size="40" /> 
				<span id="your_emailInfo" class="error_msg"></span>
				  </div>

								 <div class="form_row clearfix"><label><?php _e( SUBJECT_CONTACT_TEXT );?>  <span class="indicates">*</span></label>
				<input type="text" name="your-subject" id="your-subject" value="<?php if ( isset( $_SESSION['data_post']['your-subject'] ) && $_SESSION['data_post']['your-subject'] != '' ) { echo $_SESSION['data_post']['your-subject']; } ?>" size="40" class="textfield" />
				<span id="your_subjectInfo" class="error_msg"></span>
				 </div>     

				  
					   <div class="form_row clearfix"><label><?php _e( MESSAGE_CONTACT_TEXT );?> <span class="indicates">*</span></label>
			 <textarea name="your-message" id="your-message" cols="40" class="textarea textarea2" rows="10"><?php if ( isset( $_SESSION['data_post']['your-message'] ) && $_SESSION['data_post']['your-message'] != '' ) {  echo $_SESSION['data_post']['your-message']; } ?></textarea> 
			<span id="your_messageInfo"  class="error_msg"></span>
			</div>
			<?php $pcd = explode( ',',get_option( 'ptthemes_recaptcha_reg_flag' ) );

			if ( (in_array( 'Contact Us',$pcd ) || in_array( 'All of them',$pcd )) ) {
						echo '<div class="form_row clearfix">';
						echo '<div id="contact_us" style="margin-left:194px;"></div>';
						echo '</div>';
			} ?>
				<input type="submit" value="<?php _e( SEND_CONTACT_BUTTON );?>" class="btn_input_highlight  btn_spacer" />  
		  </form>  </div>

					
					</div> <!-- content #end -->
	<?php get_sidebar(); ?>	 

<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/library/js/contact_us_validation.js"></script> 
<?php get_footer(); ?>
