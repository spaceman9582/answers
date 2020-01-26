<?php
// Do not delete these lines
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die( 'Please do not load this page directly. Thanks!' );
}

if ( post_password_required() ) { ?>
		<p class="nocomments"><?php echo get_option( 'ptthemes_password_protected_name' ); ?></p>
	<?php
	return;
}
?>

<!-- You can start editing here. -->
<span id="commentarea"></span>
<form method="post" name="correct_answer_frm" id="correct_answer_frm" action="<?php echo get_option( 'siteurl' ); ?>/?ptype=add_comments">
<div id="comments_wrap">
<?php if ( have_comments() ) : ?>

	<h3><?php echo $post->comment_count . ' ' . __( 'Answers' )  //comments_number(); ?> 

	
	   
	<?php
	if ( @$_REQUEST['msg'] == 'selectans' ) {
		_e( 'Please select correct answer' );
	}
	?>
	</h3>

	
			<?php
			global $current_user,$post,$comment;
			//if($current_user->data->ID==$post->post_author)
			if ( $current_user->data->ID == $post->post_author || current_user_can( 'edit_post' ) ) {
				?>
				<script type="text/javascript">
				function select_as_best_answers(commentid)
				{
				document.location.href="<?php echo get_option( 'siteurl' ); ?>/?ptype=add_comments&set_correct_answer=1&pid=<?php echo $post->ID?>&correct_answer="+commentid;
			}
			</script>
 

			<?php }?>
	
	<ol class="commentlist">
	
		<?php wp_list_comments( 'avatar_size=48&callback=custom_comment' ); ?>
	
	</ol>    

	<div class="navigation">
	
		<div class="fl"><?php previous_comments_link() ?></div>
		
		<div class="fr"><?php next_comments_link() ?></div>
		
		<div class="fix"></div>
		
	</div>
	
	<br />
	
	<?php if ( $comments_by_type['pings'] ) : ?>
	
		<h3 id="pings"><?php echo get_option( 'comment_trackbacks_name' ); ?></h3>
		
			<ol class="commentlist">

							<?php wp_list_comments( 'type=pings' ); ?>
			</ol>
			
	<?php endif; ?>

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( 'open' == $post->comment_status ) : ?>
		<!-- If comments are open, but there are no comments. -->

		<?php else : // comments are closed ?>
	 
		<!-- If comments are closed. -->
		<p class="nocomments"><?php echo get_option( 'ptthemes_comment_closed_name' ); ?></p>

	<?php endif; ?>

<?php endif; ?>

</div> <!-- end #comments_wrap -->
</form>
<?php if ( 'open' == $post->comment_status ) : ?>

<div id="respond">

	<?php /*?> <h3><?php comment_form_title(  ); ?></h3><?php */?>

	
		<h3><?php _e( 'Answer Question' );?></h3>
	<div class="cancel-comment-reply">
	
			<?php cancel_comment_reply_link(); ?>

		</div>

	<?php if ( get_option( 'comment_registration' ) && ! $user_ID ) : ?>

		<p><?php echo get_option( 'ptthemes_comment_mustbe_name' ); ?> <a href="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?redirect_to=<?php echo urlencode( get_permalink() ); ?>"><?php echo get_option( 'ptthemes_comment_loggedin_name' ); ?></a> <?php echo get_option( 'ptthemes_comment_postcomment_name' ); ?></p>

	<?php else : ?>

		<form action="<?php echo get_option( 'siteurl' ); ?>/?ptype=add_comments" method="post" id="commentform">
			<input type="hidden" name="referer" id="referer" class="textfield2" value="<?php echo get_permalink( $post->ID ); ?>" />
			<?php if ( $user_ID ) { ?>
				<p><?php _e( 'Loged in as - ' ); ?>
				<?php echo $user_identity; ?>
				<?php /*?>. <a href="<?php echo get_option('siteurl'); ?>/?ptype=login&action=logout" title="Log out of this account"><?php _e('Logout &raquo;');?></a></p><?php */?>
				<?php }?>
				 <p class="clearfix">
				 <label > <?php _e( 'Your Answer' )?></label>
				 <textarea name="comment" id="comment" rows="10" cols="10" tabindex="4" class="textarea" required></textarea></p>

			<?php if ( ! $user_ID ) : ?>
			  <p class="clearfix">
				<label class="fix-label"> <?php _e( "I'm" )?></label>
				<input name="user_login_or_not" type="radio" value="existing_user" <?php if ( $user_login_or_not == 'existing_user' ) { echo 'checked="checked"';}?> checked onClick="set_login_registration_frm(this.value);" <?php if ( $_REQUEST['msg'] == 'log_err' ) { echo 'checked="checked"';}?>  class="radio" /> 
					<span class="user_login"> <?php _e( 'Existing User' );?></span>   
				<?php if ( get_option( 'users_can_register' ) != '' ) : ?>	
					<input name="user_login_or_not" type="radio" value="new_user" <?php if ( $user_login_or_not == 'new_user' ) { echo 'checked="checked"';}?> onClick="set_login_registration_frm(this.value);" <?php if ( $_REQUEST['msg'] == 'reg_err' || $_REQUEST['msg'] == 'regexist_err' ) { echo 'checked="checked"';}?> class="radio" /> 
						<span class="user_login"><?php _e( 'New User? Register Now' );?></span> 
				<?php endif; ?>	
			</p>

								 <p class="clearfix respond-col" id="login_user_frm_id">
						<label class="label-col" > <?php _e( 'Username' );?> <span class="indicates">*	</span>
					
							<input type="text" name="log" id="user_log" class="textfield2" value="<?php echo $comment_author; ?>" size="22" tabindex="1" required/>
						</label>
					 
					 
						<label class="label-col" > <?php _e( 'Password' );?> <span class="indicates">*</span>
						<input type="password" name="pwd" id="user_pass" class="textfield2" value="<?php echo $comment_author; ?>" size="22" tabindex="1" required/>
					  </label>

								 </p>

							  <div id="contact_detail_id" style="display:none;">
					<p class="clearfix"><label for="author">  <?php _e( 'Name','templatic' ); ?> <span class="indicates">*</span> </label> 
						<input type="text" name="user_fname" id="user_fname" class="textfield" value="<?php echo $user_fname; ?>" size="22" tabindex="1" />
						<?php
						if ( $_GET['msg'] == 'reg_err' ) {
							?>
							<span class="error_msg que_error_msg">
							<?php
							if ( $_GET['msg1'] == 'name_empty' ) {
								_e( 'Please Enter Name' );
							}?></span>
							<?php
						}
							?>    
					</p>

					<p class="clearfix">
						<label for="email"> <?php _e( 'Email','templatic' ); ?> <span class="indicates">*</span> </label>
						<input type="text" name="user_email" id="user_email" class="textfield" value="<?php echo $user_email; ?>" size="22" tabindex="2" />
						<?php
						if ( $_GET['msg'] == 'reg_err' || $_GET['msg'] == 'regexist_err' ) {
							?>
							<span class="error_msg que_error_msg">
							<?php
							if ( $_GET['msg1'] == 'em_empty' ) {
								_e( 'Please Enter Email' );
							} elseif ( $_GET['msg1'] == 'em_exist' ) {
								_e( 'E-mail already exist or wrong E-mail, please select different one' );
							}
							if ( $_GET['msg'] == 'regexist_err' ) {
								_e( 'E-mail already exist or wrong E-mail, please select different one' );
							}
							?></span>
							<?php
						}
						?> 
					</p>

					<p class="clearfix">
					<label for="url"> <?php _e( 'Password' );?> <span class="indicates">*</span></label>
					<input type="password" name="user_pwd" id="user_pwd" class="textfield" value="<?php echo $user_pwd; ?>" size="22" tabindex="3" />
						<?php
						if ( $_GET['msg'] == 'reg_err' ) {
								?>
								<span class="error_msg que_error_msg">
								<?php
								if ( $_GET['msg1'] == 'pw_empty' ) {
									  _e( 'Please Enter Password' );
								} elseif ( $_GET['msg1'] == 'pw_min' ) {
									  _e( 'Password should be minimum of 5 characters' );
								} elseif ( $_GET['msg1'] == 'captcha_empty' ) {
									  _e( 'Please Enter Captcha' );
								} elseif ( $_GET['msg1'] == 'captcha_wrong' ) {
									  _e( 'Captcha was wrong' );
								}
								?></span>
								<?php
						}
					?> 
					</p>
				</div>
				<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/library/js/question_validation.js"></script>
				<script language="javascript" type="text/javascript">
				<?php
				if ( $_REQUEST['msg'] == 'log_err' || $_REQUEST['msg'] == 'reg_err' || $_REQUEST['msg'] == 'regexist_err' ) {
					if ( $_REQUEST['msg'] == 'log_err' ) {
					?>
					set_login_registration_frm('existing_user');
					<?php
					} else {
					?>
					set_login_registration_frm('new_user');
					<?php
					}
				}
				?>
				</script>
			<?php endif; ?>
	<div class="aleft" > <input name="submit" type="submit" id="submit" class="<?php if ( $user_ID ) { echo 'spacer';} ?>" value="Submit" />
			<?php comment_id_fields(); ?>

		</div>

		<?php do_action( 'comment_form', $post->ID ); ?>

		</form>

	<?php endif; // If logged in ?>

	<div class="fix"></div>
	
</div> <!-- end #respond -->

<?php endif; // if you delete this the sky will fall on your head ?>
