<?php
global $current_user;
if ( $_POST ) {
    //============01.26 saijiro ================================================================
    $_SESSION['upload_arr_id'] = array();
    if ( $_FILES ) {

        $files = $_FILES["my_file_upload"];

        $upload_arr_id = array();

       foreach ($files['name'] as $key => $value) {
				if ($files['name'][$key]) {
					$file = array(
						'name' => $files['name'][$key],
	 					'type' => $files['type'][$key],
						'tmp_name' => $files['tmp_name'][$key],
						'error' => $files['error'][$key],
 						'size' => $files['size'][$key]
					);
					$_FILES = array ("kv_multiple_attachments" => $file);
					foreach ($_FILES as $file => $array) {

                        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
                        $attach_id = media_handle_upload( $file, 1 );
                        array_push($upload_arr_id, $attach_id);
//                        if ( is_numeric( $attach_id ) ) {
//                            update_post_meta( 100, '_my_file_upload', $attach_id );
//                        }

					}
				}
        }
        $_SESSION['upload_arr_id'] = $upload_arr_id;
    }
//===============================================================================================

	$_SESSION['question_info'] = $_POST;
	//$post_desc = $_SESSION['question_info']['post_content'];
	if ( $_POST['post_title'] && $_REQUEST['qid'] == '' ) {
		if ( function_exists( 'pt_check_captch_cond' ) ) {
			if ( ! pt_check_captch_cond() && $_REQUEST['emsg'] == '' ) {
				wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&emsg=captch' );
				exit;
			}
		}

		$pcd = explode( ',',get_option( 'ptthemes_recaptcha_reg_flag' ) );
		if ( in_array( 'Ask a Question page',$pcd ) || in_array( 'All of them',$pcd ) ) {
			/*fetch captcha private key*/
			$privatekey = get_option( 'ptthemes_recaptcha_secret' );
			/*get the response from captcha that the entered captcha is valid or not*/
			$response = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $privatekey . '&response=' . $_REQUEST['g-recaptcha-response'] . '&remoteip=' . getenv( 'REMOTE_ADDR' ) );
			/*decode the captcha response*/
			$responde_encode = json_decode( $response['body'] );
			/*check the response is valid or not*/
			if ( ! $responde_encode->success ) {
				wp_redirect( site_url() . '/?ptype=ask-a-question&backandedit=1&emsg=captch' );
				exit;
			}
		}
	}
	if ( $current_user->data->ID == '' ) {
		if ( $_POST['user_login_or_not'] == 'existing_user' ) {
			$log = sanitize_text_field( $_POST['log'] );
			$pwd = $_POST['pwd'];
			$current_user = veryfy_login_and_proced( $_POST );
		} else {
			$user_login = '';
			$user_email = '';
			if ( $_POST['user_fname'] == '' ) {
				wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=reg_err&msg1=name_empty' );
				exit;
			}
			if ( preg_match( '/\s/',$_POST['user_fname'] ) ) {
				wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=reg_err&msg1=name_space' );
				exit;
			}
			if ( $_POST['user_email'] ) {
				$user_login = sanitize_text_field( $_POST['user_fname'] );
				$user_email = $_POST['user_email'];

				$errors = register_new_user_question( $user_login, $user_email );
				if ( is_wp_error( $errors ) ) {
					wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=reg_err&msg1=em_exist' );
					exit;
				}
			} else {
				wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=reg_err&msg1=em_empty' );
				exit;
			}
			if ( $_POST['user_pwd'] ) {
				if ( strlen( $_POST['user_pwd'] ) < 6 ) {
					wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=reg_err&msg1=pw_min' );
					exit;
				}
			} else {
				wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=reg_err&msg1=pw_empty' );
				exit;
			}
		}// End if().
	}// End if().
	$post_title = sanitize_text_field( $_POST['post_title'] );
	if ( $post_title == '' ) {
		wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=empty_title' );
	}

	$post_desc = $_POST['post_desc'];
	$post_tags = $_POST['post_tags'];
	if ( $current_user->data->ID == '' ) {
		$post_author = sanitize_text_field( $_POST['user_fname'] );
	} else {
		$post_author = $current_user->data->display_name;
	}
} else {
	$post_info = get_post_info( $_REQUEST['qid'] );
	$post_title = sanitize_text_field( $post_info['post_title'] );
	$post_desc = $post_info['post_content'];
	$post_author = get_user_name( $post_info['post_author'] );
	$post_tags1 = get_the_tags( $_REQUEST['qid'] );
	$tags_arr = array();
	if ( $post_tags1 ) {
		foreach ( $post_tags1 as $post_tags1_obj ) {
			$tags_arr[] = $post_tags1_obj->name;
		}
	}
	if ( $tags_arr ) {
		$post_tags = implode( ', ',$tags_arr );
	}
}// End if().
?>
<?php get_header(); ?>
 <div id="content">
	   <div class="entry"> 
	   <div class="published_info"> 
		<?php
		_e( stripslashes( get_option( 'ptthemes_askque_preview_page_content' ) ) );
		include( TEMPLATEPATH . '/library/includes/question_preview_buttons.php' );
		?></div>
	</div>

 <div class="posts">
	
  <div class="question_list">
				 <span class="answers_total">
		<a href="#"><?php if ( $_GET['ptype'] == 'preview' ) {echo '0';
} else { comments_number( '0', '0', '%' );} ?> </a>   <?php _e( 'Answers' );?> 
				</span>

								<h1> <?php echo stripslashes( $post_title ); ?></h1>
				<p> <span class="user"><?php _e( 'Asked by' );?>: <strong><?php echo stripslashes( $post_author ); ?></strong> </span> 
				<span class="views"><?php if ( $_REQUEST['qid'] ) { echo user_post_visit_count( $_REQUEST['qid'] );
} else { echo '0';}?> <?php _e( 'views' );?></span> 
				<?php if ( $post_tags ) {?> <span class="ptags"> <?php echo stripslashes( $post_tags ); ?> </span><?php }?>
			   </p>
			   </div> <!-- question #end -->
     <div class="image_group" style="margin-left: 120px">

         <?php foreach ($upload_arr_id as $key => $val){
             $img_title = get_post_meta( $val, '_wp_attached_file');
             ?>
             <img src="<?php echo get_option( 'siteurl' ).'/wp-content/uploads/'.$img_title[0];?>"  height="120" width="120">
         <?php }?>

     </div>


								<?php echo stripslashes( ($post_desc) ); ?>
 </div> 
	
						 
		</div> <!-- content #end -->

				<?php get_sidebar(); ?>  
<?php /*?><?php if(!$_REQUEST['alook']){?>
<script type="text/javascript">
document.paynow_frm.submit();
</script>
<?php }?><?php */?>
<?php get_footer(); ?>
