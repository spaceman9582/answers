<?php
/*
Template Name: Ask Question Form Page
*/
?> 
<?php
if ( isset( $_REQUEST['backandedit'] ) && $_REQUEST['backandedit'] ) {
} else {
	$_SESSION['question_info'] = array();
}
if ( isset( $_REQUEST['qid'] ) && $_REQUEST['qid'] ) {
	if ( ! $current_user->data->ID ) {
		wp_redirect( get_settings( 'home' ) . '/index.php?ptype=login' );
		exit;
	}
	$post_info = get_post_info( $_REQUEST['qid'] );
	$post_title = stripslashes( $post_info['post_title'] );
	$post_content = stripslashes( $post_info['post_content'] );
	$queston_cat = wp_get_post_categories( $_REQUEST['qid'] );
	$tags_arr = wp_get_post_tags( $_REQUEST['qid'] );
	$tagarr = array();
	for ( $i = 0;$i < count( $tags_arr );$i++ ) {
		$tagarr[] = $tags_arr[ $i ]->name;
	}
	if ( $tagarr ) {
		$post_tags = implode( ',',$tagarr );
	}
	$post_meta = get_post_meta( $_REQUEST['qid'], '',false );

} elseif ( $_SESSION['question_info'] ) {
	$post_title = stripslashes( $_SESSION['question_info']['post_title'] );
	$post_content = stripslashes( $_SESSION['question_info']['post_desc'] );
	$post_tags = stripslashes( $_SESSION['question_info']['post_tags'] );
	$user_login = stripslashes( $_SESSION['question_info']['user_login'] );
	$user_fname = stripslashes( $_SESSION['question_info']['user_fname'] );
	$user_city = stripslashes( $_SESSION['question_info']['user_city'] );
	$user_state = stripslashes( $_SESSION['question_info']['user_state'] );
	$user_phone = stripslashes( $_SESSION['question_info']['user_phone'] );
	$user_email = stripslashes( $_SESSION['question_info']['user_email'] );
	$user_web = stripslashes( $_SESSION['question_info']['user_web'] );
	$user_twitter = stripslashes( $_SESSION['question_info']['user_twitter'] );
	$user_photo = stripslashes( $_SESSION['question_info']['user_photo'] );
	$description = stripslashes( $_SESSION['question_info']['description'] );
	$user_login_or_not = stripslashes( $_SESSION['question_info']['user_login_or_not'] );
} else {
	$post_title = '';
	$post_content = '';
	$post_tags = '';
	$user_login = '';
	$user_fname = '';
	$user_city = '';
	$user_state = '';
	$user_phone = '';
	$user_email = '';
	$user_web = '';
	$user_twitter = '';
	$user_photo = '';
	$description = '';
	$user_login_or_not = '';
}// End if().
?>
<?php get_header(); ?>


<?php
if ( isset( $_REQUEST['qid'] ) && $_REQUEST['qid'] ) {
	if ( $_REQUEST['renew'] ) {
		$page_title = RENEW_QUESTION_TEXT;
	} else {
		$page_title = EDIT_QUESTION_TEXT;
	}
} else {
	$page_title = ASK_QUESTION_TEXT;
}
?>
<div id="content">
 
		<h1 class="page_head"><?php _e( $page_title );?><span class="fr"> <b class="indicates">* </b> <?php _e( 'Indicates mandatory fields' );?></span></h1>
		<div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '',' &raquo; ' . __( $page_title ) ); } ?></p>
	 </div>

			<div class="entry"> 
	   <div class="info"> <p><?php _e( stripslashes( get_option( 'ptthemes_askque_page_content' ) ) ); ?></p></div>
	</div>
		<?php

		if ( isset( $_REQUEST['qid'] ) ) :
			$temp_qid = intval( $_REQUEST['qid'] );
			else :
				$temp_qid = '';
			endif;
		?>
		
		<form name="questionform" id="questionform" action="<?php echo get_ssl_normal_url( get_option( 'siteurl' ) . '/?ptype=preview',$temp_qid ); ?>" method="post" enctype="multipart/form-data">
		<?php
		if ( $_GET['msg'] == 'log_err' ) { ?>
				<p class="que_error_msg"><?php _e( 'Invalid User Login or Password' );?></p>
				<?php
		}

			wp_nonce_field( 'ask_a_question_action','ask_question_field' );
		?>
		<input type="hidden" name="renew" value="<?php if ( isset( $_REQUEST['renew'] ) ) {echo $_REQUEST['renew'];}?>" />
		<input type="hidden" name="qid" value="<?php if ( isset( $_REQUEST['qid'] ) ) {echo $_REQUEST['qid'];}?>" />
		<?php if ( isset( $_REQUEST['emsg'] ) && $_REQUEST['emsg'] == 'captch' ) {echo '<div class="ask_row"><span class="message_error2" id="category_span">' . __( 'Please enter valid text as you see in captcha.' ) . '</span></div>';}?>
		<div class="ask_row">
			<label> <?php _e( 'Title' );?> : <span class="indicates">*</span></label>
			<input name="post_title" id="post_title" type="text" class="textfield" value="<?php echo $post_title;?>" />
				<?php  if ( isset( $_REQUEST['msg'] ) && $_GET['msg'] == 'empty_title' ) {?><p class="error_msg que_error_msg"><?php _e( 'Please Enter Question  Title' );?></p><?php }?>
			<span class="message_error" id="post_title_span"></span>
			<span class="notice"> <?php _e( 'please enter a descriptive title for your question' );?> </span>
		</div>
		<?php
		if ( get_question_categories() ) {
			?>
		   <div class="ask_row">
			<label> <?php _e( 'Select Category' );?> : </label>
					
			<ul class="question_cat">
			<?php echo 	get_question_categories( $queston_cat );?>
			</ul>
				   
			<span class="notice"> <?php _e( 'please select at least one category, your question will inserted in to <b>' . get_option( 'ptthemes_questionscategory' ) . '</b> category if you never select any category.' );?> </span>
			</div>
			<?php }?>

			   <div class="ask_row">
			<label> <?php _e( 'Image' );?> : </label>
                   <input type="file" name="my_file_upload[]" multiple="multiple" accept="image/*">
			<?php
//                        $name = 'post_desc';
//						$settings = array(
//						'wpautop' => false, // use wpautop?
//						'media_buttons' => false, // show insert/upload button(s)
//						'textarea_name' => $name, // set the textarea name to something different, square brackets [] can be used here
//						'textarea_rows' => '10', // rows="..."
//						'tabindex' => '',
//						'editor_css' => '<style>.wp-editor-wrap{width:88%;margin-left:0px; border:1px solid #e5e5e5;}</style>', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
//						'editor_class' => '', // add extra class(es) to the editor textarea
//						'teeny' => false, // output the minimal editor config used in Press This
//						'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
//						'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
//						'quicktags' => true,// load Quicktags, can be used to pass settings directly to Quicktags using an array()
//						);
//						if ( isset( $post_content ) && $post_content != '' ) {  $post_content = $post_content;
//						} else { $post_content = $post_content; }
//						wp_editor( $post_content, $name, $settings );
//            MIU_GET_IMAGES();
			?>
		
		 </div>
				  <div class="ask_row">
			<label> <?php _e( 'Tags' );?> : </label>
		   <input name="post_tags" id="post_tags" type="text" class="textfield textfield_tags" value="<?php echo $post_tags;?>" />
		  <span class="notice">  <?php _e( 'Tags are short keywords, with no space within. Up to five tags can be used. More than five tags will removed automatically.' );?> </span>
		 </div>
		<?php if ( get_question_fees() > 0 ) {?>
		 <div class="ask_row">
			<label> <?php _e( 'Payable Fees' );
			echo ' : ' . get_currency_sym() . get_question_fees();?>  </label>
			<p><?php echo __( 'You will be charged ' ) . get_currency_sym() . get_question_fees() . __( ' at PayPal for this question. ' );?></p>
			<input type="hidden" name="payable_amount" value="<?php echo get_question_fees();?>" />
		 </div>
			<?php }?>

						<?php
						if ( $current_user->ID == '' ) {
							?>
							 <div class="ask_row" >
						   <label class="login_s"><?php _e( "I'm" );?> </label>
						<input name="user_login_or_not" type="radio" value="existing_user" <?php if ( $user_login_or_not == 'existing_user' ) { echo 'checked="checked"';}?> checked onClick="set_login_registration_frm(this.value);" <?php if ( $_REQUEST['msg'] == 'log_err' ) { echo 'checked="checked"';}?> class="radio"  /> <span class="user_login"> <?php _e( 'Existing User' );?> </span>
						<?php
						if ( get_option( 'users_can_register' ) ) {
						?>
					 <input name="user_login_or_not" type="radio" value="new_user" <?php if ( $user_login_or_not == 'new_user' ) { echo 'checked="checked"';}?> onClick="set_login_registration_frm(this.value);" <?php if ( $_REQUEST['msg'] == 'reg_err' ) { echo 'checked="checked"';}?> /><span class="user_login"><?php _e( NEW_USER_TEXT );?> </span>
				<?php } ?>
				 </div>              

					   <div class="ask_row" id="login_user_frm_id">
				<label class="login_s" > <?php _e( 'UserName','templatic' );?> <span class="indicates">*</span>
				<input type="text" name="log" id="user_log" class="textfield textfield_login" value="<?php echo $comment_author; ?>" size="22"  />
				</label>

						<label class="login_s" ><?php _e( 'Password' );?> <span class="indicates">*</span>
				<input type="password"  class="textfield textfield_login" id="user_pass" name="pwd" />
				</label>

			
							<?php	$login_redirect_link = get_settings( 'home' ) . '/?ptype=ask-a-question';?>
				 <input type="hidden" name="redirect_to" value="<?php echo $login_redirect_link; ?>" />
				 <input type="hidden" name="testcookie" value="1" />
				 <input type="hidden" name="pagetype" value="<?php echo $login_redirect_link; ?>" />
				 </div>

						<div id="contact_detail_id" style="display:none;"> 

				 <div class="form_row clearfix">
					  <label><?php _e( 'UserName' ); ?> <span class="indicates">*</span></label>
					   <input name="user_fname" id="user_fname" value="<?php echo $user_login;?>" type="text" class="textfield" />
						<?php
						if ( $_GET['msg'] == 'reg_err' ) {
								?>
							 <p class="error_msg que_error_msg2">
								<?php
								if ( $_GET['msg1'] == 'name_empty' ) {
									  _e( 'Please Enter your name','templatic' );
								}?>
								<?php
								if ( $_GET['msg1'] == 'name_space' ) {
									  _e( 'User name should not contain space','templatic' );
								}?>
							 </p>
								<?php
						}
					?>    
					</div>
  
					<div class="form_row clearfix">
				   <label><?php _e( 'E-mail' ); ?> <span class="indicates">*</span></label>
			<input name="user_email" id="user_email" value="<?php echo $user_email;?>" type="text" class="textfield" />
				<?php
				if ( $_GET['msg'] == 'reg_err' ) {
						?>
					 <p class="error_msg que_error_msg2">
						<?php
						if ( $_GET['msg1'] == 'em_empty' ) {
							  _e( 'Please Enter E-mail','templatic' );
						} elseif ( $_GET['msg1'] == 'em_exist' ) {
							  _e( 'E-mail already exist or wrong E-mail, please select different one','templatic' );
						}


							?></p>
						<?php
				}
				?> 
				</div>
				 <div class="form_row clearfix">
				   <label><?php _e( 'Password' ); ?> <span class="indicates">*</span></label>
			<input name="user_pwd" id="user_pwd" value="<?php echo $user_pwd;?>" type="password" class="textfield" />
				<?php
				if ( $_GET['msg'] == 'reg_err' ) {
						?>
					 <script type="text/javascript">
					 scroll_to_element('user_pwd');
					 </script>
					 <p class="error_msg que_error_msg2">
						<?php
						if ( $_GET['msg1'] == 'pw_empty' ) {
							  _e( 'Please Enter Password' );
						} elseif ( $_GET['msg1'] == 'pw_min' ) {
							  _e( 'Password should be minimum of 5 characters' );
						}?></p>
						<?php
				}
				?> 
				</div>
  
				<?php

					?>

				  </div>
					<?php }// End if().
?>
		 
		  <div class="ask_row captcha-from">
			<?php if ( function_exists( 'pt_get_captch' ) && isset( $_REQUEST['qid'] ) && $_REQUEST['qid'] == '' ) {pt_get_captch(); }
			$pcd = explode( ',',get_option( 'ptthemes_recaptcha_reg_flag' ) );

			if ( (in_array( 'Ask a Question page',$pcd ) || in_array( 'All of them',$pcd )) ) {
						echo '<div class="form_row clearfix">';
						echo '<div id="captcha_div"></div>';
						echo '</div>';
			} ?>
		  </div>
		 
			<?php
			//if($current_user->ID!='')
			{
			?>
		 <input name="submit" type="submit" id="submit" class="b_spacer3"  value="Submit" /> 
			<?php }?>
		  </form>
		 </div> <!-- content #end -->

				  <div id="sidebar" >
			
						<?php include( TEMPLATEPATH . '/library/includes/ask_question_button.php' );?>

								<?php dynamic_sidebar( 4 );  ?> 

				
					   </div> <!-- sidebar #end --> 
	
			<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/library/js/question_validation.js"></script>
			<script language="javascript" type="text/javascript">
			<?php
			if ( $_REQUEST['msg'] == 'log_err' || $_REQUEST['msg'] == '' ) {
			?>
			set_login_registration_frm('existing_user');
			<?php
			} else {
			?>
			set_login_registration_frm('new_user');
			<?php
			}
			if ( $user_login_or_not == 'new_user' ) {
			?>
			set_login_registration_frm('new_user');
			<?php
			}
			?>
</script>
	<?php get_footer(); ?>
