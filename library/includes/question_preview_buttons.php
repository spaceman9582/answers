<?php
if ( $_POST['payable_amount'] > 0 ) {
	?>
	<p><?php echo __( 'You will be charged ' ) . get_currency_sym() . $_POST['payable_amount'] . __( ' at PayPal for this question. ' );?></p>
	<?php
}
?>
<?php
if ( $_REQUEST['alook'] ) {
} else {
?>
<div class="published_box">
<?php
$form_action_url = get_ssl_normal_url( get_option( 'siteurl' ) . '/?ptype=paynow' );
?>
<form method="post" action="<?php echo $form_action_url; ?>" name="paynow_frm" id="paynow_frm" >
	<?php
	if ( $_REQUEST['delete'] ) {
	?>
		<h5 class="payment_head"><?php _e( 'Are you really sure want to DELETE this property? Deleted property can not be recovered later' );?></h5>
		<input type="button" name="Delete" value="<?php _e( 'Yes, Delete Please!' );?>" class="btn_input_highlight btn_spacer fr" onclick="window.location.href='<?php echo get_option( 'siteurl' );?>/?ptype=delete&qid=<?php echo $_REQUEST['qid']?>'" />
		<input type="button" name="Cancel" value="<?php _e( 'Cancel' );?>" class="btn_input_normal fl" onclick="window.location.href='<?php echo get_author_posts_url( $current_user->data->ID );?>'" />
	<?php
	} else {
	?>
	<div class="fr">
	<input type="hidden" name="paynow" value="1">
	<input type="hidden" name="qid" value="<?php echo $_POST['qid'];?>">
	<?php
	if ( $_REQUEST['qid'] ) {
	?> 
		<input type="submit" name="Submit and Pay" value="<?php _e( 'Update Now' );?>" class="btn_input_highlight " />
	<?php
	} else {
	?>
		<input type="submit" name="Submit and Pay" value="<?php if ( $_POST['payable_amount'] > 0 ) {_e( 'Pay & Publish' );
} else { _e( 'Publish' );}?>" class="btn_input_highlight " />
	<?php
	}
	?>
	</div>
	<div class="fl" >
	<?php /*?><a class="btn_input_normal fl go_spacer" href="<?php echo get_option('siteurl');?>/?ptype=ask-a-question&backandedit=1<?php if($_REQUEST['qid']){ echo '&qid='.$_REQUEST['qid'];}?>"> <?php _e('&laquo; Go Back & Edit Question');?></a><?php */?>
   
   <input type="button" name="Cancel" value="<?php _e( '&laquo; Go Back & Edit Question' );?>" class="btn_input_normal fl go_spacer" onclick="window.location.href='<?php echo get_option( 'siteurl' );?>/?ptype=ask-a-question&backandedit=1<?php if ( $_REQUEST['qid'] ) { echo '&qid=' . $_REQUEST['qid'];}?>'" />
   
	<input type="button" name="Cancel" value="<?php _e( 'Cancel' );?>" class="btn_input_normal fl" onclick="window.location.href='<?php echo get_author_posts_url( $current_user->data->ID );?>'" />
	</div>
	
		<?php }// End if().
?>  
	 </form>
	 </div>
<?php }// End if().
?>
