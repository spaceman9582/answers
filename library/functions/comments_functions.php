<?php
error_reporting( 0 );
/*
URI: //wphacks.com/log/how-to-add-spam-and-delete-buttons-to-your-blog/
*/

function delete_comment_link( $id ) {
	if ( current_user_can( 'edit_post' ) ) {
		echo ' | <a href="' . admin_url( "comment.php?action=cdc&c=$id" ) . '">delete</a> ';
		echo ' | <a href="' . admin_url( "comment.php?action=cdc&dt=spam&c=$id" ) . '">spam</a>';
	}
}

// Use legacy comments on versions before WP 2.7
add_filter( 'comments_template', 'old_comments' );

function old_comments( $file ) {

	if ( ! function_exists( 'wp_list_comments' ) ) : // WP 2.7-only check
		$file = TEMPLATEPATH . '/comments-old.php';
	endif;
	return $file;
}

// Custom comment loop
function custom_comment( $comment, $args, $depth ) {
	   $GLOBALS['comment'] = $comment; ?>
	
<li class="comment wrap threaded clearfix <?php if ( 1 == $comment->user_id ) { @$oddcomment = 'authcomment';
} echo @$oddcomment; ?> <?php if ( $comment->correct_ans ) {?> selectedans<?php }?>" id="comment-<?php comment_ID() ?>" >

<?php if ( $comment->correct_ans ) {?> <span class="bestanswer"><i class="fa fa-check"></i><?php // _e('Best Answer');?></span><?php }?>			
		
		
					<?php /*?><p><small><?php comment_date('M d, Y'); ?></small></p><?php */?>

						<div class="votes">
					<?php echo temckrating_display_filter( '' );?>
			</div>

						<?php /*?><div class="meta-left">

						<div class="meta-wrap">
                        <?php if($comment->user_id){ get_user_profile_pic($comment->user_id,48,48);
                        }else{
                        echo get_avatar( $comment, 48, $template_path . ''.get_bloginfo('template_directory').'/images/gravatar.png' );
						}?><br />

						<p class="authorcomment"><br /></p>


						</div>

						</div><?php */?>

				
				<div class="content_left">

									<?php
                                    echo "<span style='display: flex;align-items: baseline;'>Your Answer:";
                                        comment_text();
                                        echo "</span>";


                                        $comment_other1 = get_comment_meta(get_comment_ID(), 'comment1', true);

                                        $comment_other2 = get_comment_meta(get_comment_ID(), 'comment2', true);

                                        if($comment_other1 != null){
                                            echo "<span style='display: flex;align-items: baseline;'>Answer1:";
                                            echo "<p>$comment_other1</p>";
                                            echo "</span>";
                                        }

                                        if($comment_other2 != null){
                                            echo "<span style='display: flex;align-items: baseline;'>Answer2:";
                                            echo "<p>$comment_other2</p>";
                                            echo "</span>";
                                        }



                                    ?>
					

										 <p class="author">

										<?php if ( $comment->user_id ) { get_user_profile_pic( $comment->user_id,38,38 );
} else {
	//echo get_avatar( $comment, 38, $template_path . ''.get_bloginfo('template_directory').'/images/gravatar.png' );
	echo get_avatar( $comment, 38, $template_path . '' . get_bloginfo( 'template_directory' ) . '/images/gravatar.png', null, array(
		'class' => array( 'agent_photo' ),
	) );
}?>

										<span class="auhtor_name"><strong> 
					<?php if ( $comment->user_id != 0 ) { ?>
					<a href="<?php echo get_author_posts_url( $comment->user_id );?>"><?php echo $comment->comment_author;?></a>
					<?php } else { ?>
					<?php echo $comment->comment_author;?>
					<?php //comment_author_link()
}?></strong>  <small>- <?php comment_date( 'H:m, M d, Y' ); ?> </small> </span>

					
									  <span class="comments_links">
						<?php edit_comment_link( 'edit', '', '' );  ?>
					<?php

                    if ( current_user_can( 'administrator' ) ) {
                        echo '|';
                        comment_reply_link(array_merge($args, array(
                            'depth' => $depth,
                            'reply_text' => __( 'reply' ),
                            'max_depth' => $args['max_depth'],
                        )));
                    }
                    ?>
						<?php delete_comment_link( get_comment_ID() ); ?>
				  </span>
				  </p>
			</div>

		<span class="comm-reply">
			<?php
			global $current_user,$post,$comment;
//====01.26 saijiro=======================================
//			if ( $current_user->data->ID == $post->post_author || current_user_can( 'edit_post' ) ) {
			if ( current_user_can( 'administrator' ) ) {
//====01.26 saijiro=======================================
				?>
				<input type="radio" name="correct_answer" value="<?php echo $comment->comment_ID?>" <?php if ( $comment->correct_ans ) {?> checked="checked"<?php }?> onchange="select_as_best_answers(this.value);" /> 
			<small>: <?php _e( 'Select as Best answer' );?></small>
			<?php
			}
		?> 
		

			   </span>

<?php }


function custom_comment_blog( $comment, $args, $depth ) {
	   $GLOBALS['comment'] = $comment; ?>
	
<li class="comment wrap threaded  clearfix <?php if ( 1 == $comment->user_id ) { $oddcomment = 'authcomment';
} echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>" >
		
			<div class="meta-left" >
			
				<div class="meta-wrap">
					
					<?php echo get_avatar( $comment, 48, $template_path . '' . get_bloginfo( 'template_directory' ) . '/images/gravatar.png' ); ?><br />
					
					<p class="authorcomment"><br /></p>
					
					 
						<?php /*?><p><small><?php comment_date('M d, Y'); ?></small></p><?php */?>
				
				</div>
				
			</div>
			
					
				
				<div class="content_left content_left_2">
					<p><strong> <?php comment_author_link() ?></strong>  <span class="date">on  <?php comment_date( 'M d, Y' ); ?></span> </p>

								<?php comment_text() ?>
					
				<?php if ( $comment->comment_approved == '0' ) : ?>
					
				<p><a href="#" class="report"><?php _e( 'Report' );?></a> <em><?php echo get_option( 'ptthemes_comment_moderation_name' ); ?></em></p>

				
								</div>

						
								<?php endif; ?>
				
			</div>
		

		<span class="comm-reply spacer_com">

		<?php comment_reply_link( array_merge( $args, array(
			'add_below' => 'div-comment',
			'reply_text' => __( 'reply' ),
			'depth' => $depth,
			'max_depth' => $args['max_depth'],
		) ) ) ?>

		<?php edit_comment_link( 'edit', ' | ', '' ); ?>

		<?php delete_comment_link( get_comment_ID() ); ?>

			   </span>

	 
		 
<?php }
?>
<?php
////////////////////////////////////////////////////////////
add_filter( 'comments_template', 'old_comments_blog' );
function old_comments_blog( $file ) {
	global $post;
	$blob_posts_arr = explode( ',',get_blog_cat_postids() );
	if ( in_array( $post->ID,$blob_posts_arr ) ) {

		if ( ! function_exists( 'wp_list_comments' ) ) : // WP 2.7-only check
			$file = TEMPLATEPATH . '/comments-old.php';
			else :
				$file = TEMPLATEPATH . '/comments_blog.php';
				endif;

			return $file;
	}
}
?>
