<?php get_header(); ?>

<div id="content">
		 <h1 class="page_head"><?php _e( PAYMENT_SUCCESS_TITLE );?></h1>
		<div class="breadcrumbs">
		<p><?php if ( get_option( 'ptthemes_breadcrumbs' ) ) { yoast_breadcrumb( '',' &raquo; ' . __( PAYMENT_SUCCESS_TITLE ) ); } ?></p>
	 </div>
	<?php
	global $upload_folder_path;
	$destinationfile = ABSPATH . $upload_folder_path . 'notification/message/payment_success_paypal.txt';
	if ( file_exists( $destinationfile ) ) {
		$filecontent = file_get_contents( $destinationfile );
	} else {
		$filecontent = __( PAYMENT_SUCCESS_AND_RETURN_MSG );
	}
?>
<?php
$store_name = get_option( 'blogname' );
$post_link = get_option( 'siteurl' ) . '/?ptype=preview&alook=1&qid=' . $_REQUEST['qid'];
$search_array = array( '[#$store_name#]','[#$submited_question_link#]' );
$replace_array = array( $store_name,$post_link );
$filecontent = str_replace( $search_array,$replace_array,$filecontent );
if ( $filecontent ) {
	echo $filecontent;
} else {
?> 
<h4><?php _e( PAYMENT_SUCCESS_MSG1 ); ?></h4>
<h6><?php _e( PAYMENT_SUCCESS_MSG2 ); ?></h6>
<h6><?php _e( PAYMENT_SUCCESS_MSG3 . ' ' . get_option( 'blogname' ) . '.' ); ?></h6>
<?php
}
?>

				
				</div> <!-- content #end -->

				<?php get_sidebar(); ?>  

			<?php get_footer(); ?>
