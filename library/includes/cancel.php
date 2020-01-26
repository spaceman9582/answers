<?php get_header(); ?>

<div id="content">
 
		<h1 class="page_head"><?php _e( PAY_CANCELATION_TITLE );?></h1>
		<div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '',' &raquo; ' . __( PAY_CANCELATION_TITLE ) ); } ?></p>
	 </div>
	<?php
	global $upload_folder_path;
		$destinationfile = ABSPATH . $upload_folder_path . 'notification/message/payment_cancel_paypal.txt';
	if ( file_exists( $destinationfile ) ) {
		$filecontent = file_get_contents( $destinationfile );
	} else {
		$filecontent = PAY_CANCEL_MSG . PRPOERTY_PAY_CANCEL_MSG;
	}
		?>
		<?php
		$store_name = get_option( 'blogname' );
		$post_link = get_option( 'siteurl' ) . '/?ptype=preview&alook=1&qid=' . intval( $_REQUEST['qid'] );
		$search_array = array( '[#$store_name#]','[#$submited_question_link#]' );
		$replace_array = array( $store_name,$post_link );
		$filecontent = str_replace( $search_array,$replace_array,$filecontent );
		if ( $filecontent ) {
		?>
		
			<?php echo $filecontent; ?> 
		
		<?php
		} else {
		?>
		<h1><?php _e( PAY_CANCEL_MSG ); ?></h1> 
		<?php
		}
		?>	

				
				</div> <!-- content #end -->

				<?php get_sidebar(); ?>  

			<?php get_footer(); ?>
