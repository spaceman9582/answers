<?php // Do not delete these lines
if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die( 'Please do not load this page directly. Thanks!' );
}

if ( ! empty( $post->post_password ) ) { // if there's a password
	if ( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] != $post->post_password ) {  // and it doesn't match the cookie
		?>

		<p class="nocomments"><?php echo get_option( 'ptthemes_password_protected_name' ); ?></p>

			<?php
			return;
	}
}

	/* This variable is for alternating comment background */
	$oddcomment = 'alt';
?>

<!-- You can start editing here. -->

<div id="comments_wrap">

<?php if ( $comments ) : ?>

	<h3><?php comments_number();?></h3>

<ol class="commentlist">
	
		<?php wp_list_comments( 'avatar_size=48&callback=custom_comment_blog' ); ?>
	
	</ol>   

<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( 'open' == $post->comment_status ) : ?>
		<!-- If comments are open, but there are no comments. -->

		<?php else : // comments are closed ?>
	 
		<!-- If comments are closed. -->
		<p class="nocomments"><?php echo get_option( 'ptthemes_comment_closed_name' ); ?></p>

	<?php endif; ?>

<?php endif; ?>

</div> <!-- end #comments_wrap -->

<?php if ( 'open' == $post->comment_status ) : ?>

<div id="respond">

	<h3><?php _e( 'Leave a Reply' );?></h3>

	<?php if ( get_option( 'comment_registration' ) && ! $user_ID ) : ?>

		<p><?php echo get_option( 'ptthemes_comment_mustbe_name' ); ?> <a href="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?redirect_to=<?php echo urlencode( get_permalink() ); ?>"><?php echo get_option( 'ptthemes_comment_loggedin_name' ); ?></a> <?php echo get_option( 'ptthemes_comment_postcomment_name' ); ?></p>

	<?php else : ?>
	
		<form action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post" id="commentform" class="comment_blog">

			<?php if ( $user_ID ) : ?>

				<p><?php _e( 'Logged in as ' ); ?> &rarr; <a href="<?php echo get_option( 'siteurl' ); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a></p>

			<?php else : ?>

				<p class="commpadd"> <label for="author"><?php _e( 'Name' );?> <span class="indicates"><?php if ( $req ) { _e( '*' );} ?> </span></label> <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" class="textfield" />
				</p>

				<p class="commpadd"> <label for="email"> <?php _e( 'E-mail' );?> <span class="indicates"><?php if ( $req ) { _e( '*' );} ?></span></label> <input type="text" name="email" id="email" value="<?php echo $comment_auth_email; ?>" size="22" tabindex="2"  class="textfield"  />
				</p>

				<p class="commpadd"> <label for="url"><small><?php _e( 'Website' );?></small></label> <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3"  class="textfield"  />
				</p>

			<?php endif; ?>

		<p class="commpadd"> <label> Comment </label><textarea name="comment" id="comment"  rows="10" cols="10" tabindex="4" class="textarea"></textarea></p>

		<div class="aleft" ><input name="submit" type="submit" id="submit" class="b_spacer3" tabindex="5" value="Submit" />

			<?php comment_id_fields(); ?>

		</div>

		<?php do_action( 'comment_form', $post->ID ); ?>

		</form>

	<?php endif; // If logged in ?>

	<div class="fix"></div>
	
</div> <!-- end #respond -->

<?php endif; // if you delete this the sky will fall on your head ?>
