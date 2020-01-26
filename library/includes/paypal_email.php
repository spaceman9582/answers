<?php session_start();
if ( isset( $_REQUEST['ptype'] ) && ($_GET['ptype'] == 'return') ) {
	if ( isset( $_SESSION['paypal_redirect'] ) && $_SESSION['paypal_redirect'] == 1 ) {
		$to = get_site_emailId();

		// yes valid, f.e. change payment status
		$postid = intval( $_GET['qid'] );
		$item_name = sanitize_text_field( $_POST['item_name'] );
		$txn_id = intval( $_POST['txn_id'] );
		$payment_status       = sanitize_text_field( $_POST['payment_status'] );
		$payment_type         = sanitize_text_field( $_POST['payment_type'] );
		$payment_date         = sanitize_text_field( $_POST['payment_date'] );
		$txn_type             = sanitize_text_field( $_POST['txn_type'] );

		$post_default_status = get_property_default_status();
		if ( $post_default_status == '' ) {
			$post_default_status = 'publish';
		}


		$productinfosql = "select ID,post_title,guid,post_author from $wpdb->posts where ID = %d";
		$productinfo = $wpdb->get_results( $wpdb->prepare( $productinfosql,$postid ) );
		foreach ( $productinfo as $productinfoObj ) {
			$post_link = get_option( 'siteurl' ) . '/?page=preview&alook=1&pid=' . $postid;
			$title = $productinfoObj->post_title;
			$post_title = '<a href="' . $post_link . '">' . $productinfoObj->post_title . '</a>';
			$aid = $productinfoObj->post_author;
			$userInfo = get_author_info( $aid );
			$to_name = $userInfo->user_nicename;
			$to_email = $userInfo->user_email;
		}
		$payment_date = date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ) );

		$headerarr = 'MIME-Version: 1.0' . "\r\n";
		$headerarr .= 'Content-type:text/html;charset=UTF-8' . "\r\n";

		// More headers
		$headerarr .= "From: <$to_email>" . "\r\n";

		$transaction_details .= "Payment Details for Question ID #$postid\r";
		$transaction_details .= "<br/><br/>Question Title: $title \r";
		$transaction_details .= "<br/><br/>Date: $payment_date\r";
		$transaction_details .= "<br/><br/>Method: Paypal\r";
		$subject = 'Question Submitted and Payment Success Confirmation Email';

		$headerarr1 = 'MIME-Version: 1.0' . "\r\n";
		$headerarr1 .= 'Content-type:text/html;charset=UTF-8' . "\r\n";

		// More headers
		$headerarr1 .= "From: <$to>" . "\r\n";

		$transaction_details .= "<br/><br/>Question URL\r";
		$transaction_details .= "<br/><br/>$post_title\r";
		mail( $to_email,$subject,$transaction_details,$headerarr1 );
		mail( $to,$subject,$transaction_details,$headerarr );
		unset( $_SESSION['paypal_redirect'] );
	}// End if().
}// End if().

