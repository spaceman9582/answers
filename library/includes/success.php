<?php
global $upload_folder_path;
if ( $_REQUEST['renew'] ) {
	$title = QUE_RENEW_SUCCESS_TITLE;
} else {
	$title = QUE_POSTED_SUCCESS_TITLE;
}

$paymentmethod = get_post_meta( $_REQUEST['qid'],'paymentmethod',true );
$paid_amount = get_currency_sym() . get_post_meta( $_REQUEST['qid'],'paid_amount',true );
if ( $paymentmethod == 'prebanktransfer' ) {
	$destinationfile = ABSPATH . $upload_folder_path . 'notification/message/payment_success_prebank_transfer.txt';
	$filecontent = __( '<p>Thanks. The property has been submitted successfully.</p><p>In order to publish the property, kindly transfer amount of <u>[#$order_amt#] </u> in our bank. Our bank account details is mentioned below.</p><p>Bank Name : [#$bank_name#]</p><p>Account Number : [#$account_number#]</p><br><p>Please include the following reference : [#$orderId#]</p><p><a href="[#$submited_question_link#]" >View your submitted Question &raquo;</a></p><br><p>Thanks for listing your property at [#$store_name#].</p>' );
} else {
	$destinationfile = ABSPATH . $upload_folder_path . 'notification/message/post_added_success.txt';
	$filecontent = __( '<p class="sucess_msg">Thank you, your question request has been received successfully.</p> <br /><p><a href="[#$submited_question_link#]"  class="btn_input_highlight" >View your submitted Question &raquo;</a></p>  <h4>Thanks for listing your question at [#$store_name#].</h4>' );
	$filecontent = __( $filecontent );
}
if ( file_exists( $destinationfile ) ) {
	$filecontent = file_get_contents( $destinationfile );
}
?>

<?php get_header(); ?>

<div id="content">
 
		<h1 class="page_head"><?php _e( $title ); ?></h1>
		<div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '',' &raquo; ' . __( $title ) ); } ?></p>
	 </div>
	<?php
	$store_name = get_option( 'blogname' );
	if ( $paymentmethod == 'prebanktransfer' ) {
		$paymentupdsql = "select option_value from $wpdb->options where option_name='payment_method_" . $paymentmethod . "'";
		$paymentupdinfo = $wpdb->get_results( $paymentupdsql );
		$paymentInfo = unserialize( $paymentupdinfo[0]->option_value );
		$payOpts = $paymentInfo['payOpts'];
		$bankInfo = $payOpts[0]['value'];
		$accountinfo = $payOpts[1]['value'];
	}
	$post_link = get_option( 'siteurl' ) . '/?ptype=preview&alook=1&qid=' . intval( $_REQUEST['qid'] );
	$orderId = intval( $_REQUEST['qid'] );
	$search_array = array( '[#$order_amt#]','[#$bank_name#]','[#$account_number#]','[#$orderId#]','[#$store_name#]','[#$submited_question_link#]' );
	$replace_array = array( $paid_amount,$bankInfo,$accountinfo,$order_id,$store_name,$post_link );
	$filecontent = str_replace( $search_array,$replace_array,$filecontent );
	echo $filecontent;
	?>

	
			
				</div> <!-- content #end -->

				<?php get_sidebar(); ?>  

			<?php get_footer(); ?>
