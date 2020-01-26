<?php
global $current_user;
global $wpdb;
if ( $_POST ) {
	if ( $_POST['paynow'] ) {
		if ( ! $current_user->data->ID ) {
			include_once( TEMPLATEPATH . '/library/includes/guest_insertuser.php' );
		}

		$property_info = $_SESSION['question_info'];
		$custom = array();

		$post_title = $property_info['post_title'];
		$post_desc = $property_info['post_desc'];
		$queston_cat = $property_info['queston_cat'];
		$post_tags = str_replace( ' ',',',$property_info['post_tags'] );
		$payable_amount = $property_info['payable_amount'];
		$my_post = array();
		if ( $payable_amount > 0 ) {
			$post_default_status = 'draft';
		} else {
			$post_default_status = get_property_default_status();
		}

		if ( $_REQUEST['qid'] && $property_info['renew'] == '' ) {
			$my_post['ID'] = intval( $_POST['qid'] );
			if ( $property_info['remove_feature'] != '' && $property_info['remove_feature'] == '0' && in_category( get_cat_id_from_name( get_option( 'ptthemes_featuredcategory' ) ),$_REQUEST['qid'] ) ) {
				$catids_arr[] = get_cat_id_from_name( get_option( 'ptthemes_featuredcategory' ) );
			}
			$my_post['post_status'] = get_post_status( $_POST['qid'] );
		} else {
			$my_post['post_status'] = $post_default_status;
		}
		if ( $current_user->data->ID ) {
			$my_post['post_author'] = $current_user->data->ID;
		}
		$catids_arr = array();
		if ( $queston_cat ) {
			$catids_arr = $queston_cat;
		} elseif ( get_option( 'ptthemes_questionscategory' ) ) {
			$catids_arr[] = get_cat_id_from_name( get_option( 'ptthemes_questionscategory' ) );
		}

		$post_tags_arr = explode( ',',$post_tags );
		if ( count( $post_tags_arr ) > 5 ) {
			$post_tags_arr = array_slice( $post_tags_arr,0,4 );
		}
		$my_post['post_title'] = $post_title;
		$my_post['post_content'] = $post_desc;
		$my_post['post_category'] = $catids_arr;
		$my_post['tags_input'] = explode( ',',$post_tags );

		if ( $_REQUEST['qid'] ) {
			if ( $property_info['renew'] ) {
				$my_post['ID'] = intval( $_REQUEST['qid'] );
				$last_postid = wp_insert_post( $my_post );
			} else {
				$last_postid = wp_update_post( $my_post );
			}
		} else {
			$last_postid = wp_insert_post( $my_post ); //Insert the post into the database
			include( TEMPLATEPATH . '/library/includes/email_alert_question_add.php' );  // email notification to admin
		}
		foreach ( $custom as $key => $val ) {
			update_post_meta( $last_postid, $key, $val );
		}

		$_SESSION['question_info'] = array();
		if ( $_REQUEST['qid'] && $property_info['renew'] == '' ) {
			wp_redirect( get_author_posts_url( $current_user->data->ID ) );
			exit;
		} else {
			if ( $payable_amount == '' || $payable_amount <= 0 ) {
				$suburl .= "&qid=$last_postid";
				wp_redirect( get_option( 'siteurl' ) . "/?ptype=success$suburl" );
				exit;
			} else {
				$paymentSuccessFlag = 0;
				if ( $paymentmethod == 'prebanktransfer' || $paymentmethod == 'payondelevary' ) {
					if ( $property_info['renew'] ) {
						$suburl = '&renew=1';
					}
					$suburl .= "&qid=$last_postid";
					wp_redirect( get_option( 'siteurl' ) . '/?ptype=success&paydeltype=' . $paymentmethod . $suburl );
				} else {
					$merchant_id = get_merchantid();
					session_start();
					$_SESSION['paypal_redirect'] = 1;
					$returnUrl = get_option( 'siteurl' ) . '/?ptype=return&pmethod=paypal';
					$cancel_return = get_option( 'siteurl' ) . '/?ptype=cancel_return&pmethod=paypal';
					$notify_url = get_option( 'siteurl' ) . '/?ptype=notifyurl&pmethod=paypal';
					$currency_code = get_currency_type();
					global $payable_amount,$post_title,$last_postid;
					?>
					<form name="frm_payment_method" action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" value="<?php echo $payable_amount;?>" name="amount"/>
					<input type="hidden" value="<?php echo $returnUrl;?>&qid=<?php echo $last_postid;?>" name="return"/>
					<input type="hidden" value="<?php echo $cancel_return;?>&qid=<?php echo $last_postid;?>" name="cancel_return"/>
					<input type="hidden" value="<?php echo $notify_url;?>" name="notify_url"/>
					<input type="hidden" value="_xclick" name="cmd"/>
					<input type="hidden" value="<?php echo stripslashes( $post_title );?>" name="item_name"/>
					<input type="hidden" value="<?php echo $merchant_id;?>" name="business"/>
					<input type="hidden" value="<?php echo $currency_code;?>" name="currency_code"/>
					<input type="hidden" value="<?php echo $last_postid;?>" name="custom" />
					<input type="hidden" name="no_note" value="1">
					<input type="hidden" name="no_shipping" value="1">
					</form>
					
					<div class="wrapper" >
							<div class="clearfix container_message">
									<center><h1 class="head2"><?php _e( 'Processing For Paypal, Please wait ...' );?></h1></center>
							 </div>
					</div>
					<script>
					setTimeout("document.frm_payment_method.submit()",50); 
					</script> 
					<?php
				}// End if().
				exit;
			}// End if().
		}// End if().
	}// End if().
} else {
	echo __( "Cheatin' uh?",'templatic' );
	exit;
}// End if().
?>
