<?php
/*
Template Name: Ask Question Form Page
*/
?>
<?php
if ( $_REQUEST['backandedit'] ) {
} else {
	$_SESSION['question_info'] = array();
}
if ( $_REQUEST['qid'] ) {
	if ( ! $current_user->data->ID ) {
		wp_redirect( get_settings( 'home' ) . '/index.php?ptype=login' );
		exit;
	}
	$post_info = get_post_info( $_REQUEST['qid'] );
	$post_title = $post_info['post_title'];
	$post_content = $post_info['post_content'];
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
	$post_title = $_SESSION['question_info']['post_title'];
	$post_content = $_SESSION['question_info']['post_desc'];
	$post_tags = $_SESSION['question_info']['post_tags'];
	$user_fname = $_SESSION['question_info']['user_login'];
	$user_city = $_SESSION['question_info']['user_city'];
	$user_state = $_SESSION['question_info']['user_state'];
	$user_phone = $_SESSION['question_info']['user_phone'];
	$user_email = $_SESSION['question_info']['user_email'];
	$user_web = $_SESSION['question_info']['user_web'];
	$user_twitter = $_SESSION['question_info']['user_twitter'];
	$user_photo = $_SESSION['question_info']['user_photo'];
	$description = $_SESSION['question_info']['description'];
	$user_login_or_not = $_SESSION['question_info']['user_login_or_not'];
}// End if().
?>
<?php get_header(); ?>

<?php
if ( $_REQUEST['qid'] ) {
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
		<form name="questionform" id="questionform" action="<?php echo get_ssl_normal_url( get_option( 'siteurl' ) . '/?ptype=preview',intval( $_REQUEST['qid'] ) ); ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="renew" value="<?php echo sanitize_text_field( $_REQUEST['renew'] );?>" />
		<input type="hidden" name="qid" value="<?php echo intval( $_REQUEST['qid'] );?>" />
		<div class="ask_row">
			<label> <?php _e( 'Title' );?> : <span class="indicates">*</span></label>
			<input name="post_title" id="post_title" type="text" class="textfield" value="<?php echo $post_title;?>" />
				<?php  if ( $_GET['msg'] == 'empty_title' ) {?><p class="error_msg que_error_msg"><?php _e( 'Please Enter Question  Title' );?></p><?php }?>
			<span class="message_error" id="post_title_span"></span>
			<span class="notice"> <?php _e( 'please enter a descriptive title for your question' );?> </span>
		</div>
	   <div class="ask_row">
			<label> <?php _e( 'Select Category' );?> : </label>
			<?php
			if ( get_question_categories() ) {
			?>
			<ul class="question_cat">
			<?php echo 	get_question_categories( $queston_cat );?>
			</ul>
			<?php }?>
			<span class="notice"> <?php _e( 'please select at least one category, your question will inserted in to <b>' . get_option( 'ptthemes_questionscategory' ) . '</b> category if you never select any category.' );?> </span>
		</div>

			   <div class="ask_row">
			<label> <?php _e( 'Description' );?> : </label>
			<?php $name = 'post_desc';
						$settings = array(
						'wpautop' => true, // use wpautop?
						'media_buttons' => true, // show insert/upload button(s)
						'textarea_name' => $name, // set the textarea name to something different, square brackets [] can be used here
						'textarea_rows' => '10', // rows="..."
						'tabindex' => '',
						'editor_css' => '<style>.wp-editor-wrap{width:88%;margin-left:0px;}</style>', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
						'editor_class' => '', // add extra class(es) to the editor textarea
						'teeny' => false, // output the minimal editor config used in Press This
						'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
						'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
						'quicktags' => true,// load Quicktags, can be used to pass settings directly to Quicktags using an array()
						);
						if ( isset( $post_content ) && $post_content != '' ) {  $post_content = $post_content;
						} else { $post_content = $post_content; }
						wp_editor( $content, $name, $settings );
			?>
			<!--<textarea name="post_desc" id="post_desc" cols="" rows="" class="textarea"><?php //echo $post_content;?></textarea>-->
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
						 <input name="user_login_or_not" type="radio" value="new_user" <?php if ( $user_login_or_not == 'new_user' ) { echo 'checked="checked"';}?> onClick="set_login_registration_frm(this.value);" <?php if ( $_REQUEST['msg'] == 'reg_err' ) { echo 'checked="checked"';}?> /><span class="user_login"><?php _e( NEW_USER_TEXT );?> </span>
						 </div>              
					<?php
					if ( $_GET['msg'] == 'log_err' ) {
						?>
					 <p class="que_error_msg"><?php _e( 'Invalid User Login or Password' );?></p>
					<?php
					}
					?>
					<div class="ask_row" id="login_user_frm_id">
					   <label class="login_s" > <?php _e( 'UserName','templatic' );?> <span class="indicates">*</span></label>
					   <input type="text" name="log" id="user_log" class="textfield textfield_login" value="<?php echo $comment_author; ?>" size="22"  />
					   <label class="login_s" ><?php _e( 'Password' );?> <span class="indicates">*</span></label>
					   <input type="password"  class="textfield textfield_login" id="user_pass" name="pwd" />

							<?php	$login_redirect_link = get_settings( 'home' ) . '/?ptype=ask-a-question';?>
				<input type="hidden" name="redirect_to" value="<?php echo $login_redirect_link; ?>" />
				<input type="hidden" name="testcookie" value="1" />
				<input type="hidden" name="pagetype" value="<?php echo $login_redirect_link; ?>" />
					<?php
					if ( $current_user->ID == '' ) {
						?>
		 
		 
		 
		 
		 
					   <div id="contact_detail_id" style="display:none;"> 

					 <div class="form_row clearfix">
				  <label><?php _e( 'User name' ); ?> <span class="indicates">*</span></label>
				   <input name="user_fname" id="user_fname" value="<?php echo $user_fname;?>" type="text" class="textfield" />
					<?php
					if ( $_GET['msg'] == 'reg_err' ) {
							?>
						 <p class="error_msg que_error_msg2">
							<?php
							if ( $_GET['msg1'] == 'name_empty' ) {
								  _e( 'Please Enter your name' );
							}?></p>
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
						_e( 'Please Enter E-mail' );
					} elseif ( $_GET['msg1'] == 'em_exist' ) {
						_e( 'E-mail already exist or wrong E-mail, please select different one' );
					}?></p>
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
				if ( $current_user->ID == '' ) {
			?>
				<input name="submit" type="submit" id="submit" class="b_spacer1"  value="Submit" /> 
				<?php }?>

	  </div>
		 
		 
		 
		 
		 
		 
			<input name="submit" type="submit" id="submit" class="b_spacer2"  value="Submit" /> 
			<?php }// End if().
			?>
			 </div>

		  
				
		
		
		
		
		
		
		
			<?php }// End if().
?>
			<?php
			if ( $current_user->ID != '' ) {
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
