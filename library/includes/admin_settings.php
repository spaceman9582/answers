<?php
global $wpdb;
if ( $_POST ) {
	$cartsql = "select * from $wpdb->options where option_name like 'mysite_general_settings'";
	$cartinfo = $wpdb->get_results( $cartsql );
	if ( $cartinfo ) {
		foreach ( $cartinfo as $cartinfoObj ) {
			$option_id = $cartinfoObj->option_id;
			$option_value = unserialize( $cartinfoObj->option_value );
			$currency = $option_value['currency'];
			$currencysym = $option_value['currencysym'];
            $answers_num = $option_value['answers_num'];
            $main_tab_title1 = $option_value['main_tab_title1'];
            $main_tab_title2 = $option_value['main_tab_title2'];
			$site_email = $option_value['site_email'];
			$site_email_name = $option_value['site_email_name'];
			$approve_status = $option_value['approve_status'];
			$is_allow_user_add = $option_value['is_allow_user_add'];
			$merchantid = $option_value['merchantid'];
			$fees = $option_value['fees'];
		}
	}
	$option_value['currency'] = sanitize_text_field( $_POST['currency'] );
	$option_value['currencysym'] = sanitize_text_field( $_POST['currencysym'] );
	$option_value['answers_num'] = sanitize_text_field( $_POST['answers_num'] );
	$option_value['main_tab_title1'] = sanitize_text_field( $_POST['main_tab_title1'] );
	$option_value['main_tab_title2'] = sanitize_text_field( $_POST['main_tab_title2'] );
	$option_value['site_email'] = $_POST['site_email'];
	$option_value['site_email_name'] = sanitize_text_field( $_POST['site_email_name'] );
	$option_value['is_user_addquestion'] = sanitize_text_field( $_POST['is_user_addquestion'] );
	$option_value['approve_status'] = sanitize_text_field( $_POST['approve_status'] );
	$option_value['merchantid'] = sanitize_text_field( $_POST['merchantid'] );
	$option_value['fees'] = sanitize_text_field( $_POST['fees'] );

	update_option( 'mysite_general_settings',$option_value );
	$message = 'Updated Succesfully.';
}
$cartsql = "select * from $wpdb->options where option_name like 'mysite_general_settings'";
$cartinfo = $wpdb->get_results( $cartsql );
if ( count( $cartinfo ) == 0 ) {
	$paymethodinfo = array(
						'currency'		=> 'USD',
						'currencysym'	=> '$',
						'answers_num'   => '1',
						'main_tab_title1'   => 'Recent',
						'main_tab_title2'   => 'Unanswered',
						'site_email'	=> get_option( 'admin_email' ),
						'site_email_name' => get_option( 'blogname' ),
						'is_user_addquestion'		=> '1',
						'approve_status'	=> 'publish',
						'merchantid'	=> 'merchant@paypal.com',
						'fees'	=> '0',
						);
	$paymethodArray = array(
							'option_name'	=> 'mysite_general_settings',
							'option_value'	=> serialize( $paymethodinfo ),
							);
	$wpdb->insert( $wpdb->options, $paymethodArray );
}

$cartsql = "select * from $wpdb->options where option_name like 'mysite_general_settings'";
$cartinfo = $wpdb->get_results( $cartsql );
if ( $cartinfo ) {

	$option_value = get_option( 'mysite_general_settings' );
	$currency = stripslashes( $option_value['currency'] );
	$currencysym = stripslashes( $option_value['currencysym'] );
//=========01.26 saijiro===============
	$answers_num = stripslashes( $option_value['answers_num'] );
    $main_tab_title1 = stripslashes( $option_value['main_tab_title1'] );
    $main_tab_title2 = stripslashes( $option_value['main_tab_title2'] );
//	===================================
	$site_email = stripslashes( $option_value['site_email'] );
	$site_email_name = stripslashes( $option_value['site_email_name'] );
	$approve_status = stripslashes( $option_value['approve_status'] );
	$is_user_addquestion = stripslashes( $option_value['is_user_addquestion'] );
	$merchantid = stripslashes( $option_value['merchantid'] );
	$fees = stripslashes( $option_value['fees'] );

}
?>

<form action="<?php echo get_option( 'siteurl' );?>/wp-admin/admin.php?page=product_menu.php" method="post">
  <style>
h2 { color:#464646;font-family:Georgia,"Times New Roman","Bitstream Charter",Times,serif;
font-size:24px;
font-size-adjust:none;
font-stretch:normal;
font-style:italic;
font-variant:normal;
font-weight:normal;
line-height:35px;
margin:0;
padding:14px 15px 3px 0;
text-shadow:0 1px 0 #FFFFFF;  }
</style>
  <h2><?php _e( 'General Settings' );?></h2>
	<?php if ( $message ) {?>
  <div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
	<p><?php _e( $message );?> </p>
  </div>
	<?php }?>
  <table width="80%" cellpadding="5" class="widefat post fixed" >
	<thead>
	  <tr>
		<td width="29%"><?php _e( 'Sender (Name that will be shown as email sender when users receive emails from this site)' );?></td>
		<td width="71%"><input type="text" name="site_email_name" value="<?php echo $site_email_name;?>" /></td>
	  </tr>
	  <tr>
		<td><?php _e( 'Email Address (emails to users will be sent via this mail ID)' );?></td>
		<td><input type="text" name="site_email" value="<?php echo $site_email;?>" /></td>
	  </tr>
	  <tr>
		<td><?php _e( 'Default Currency (Ex.: USD)' );?></td>
		<td><input type="text" name="currency" value="<?php echo $currency;?>" /></td>
	  </tr>
	  <tr>
		<td><?php _e( 'Default Currency Symbol (Ex.: $)' );?></td>
		<td><input type="text" name="currencysym" value="<?php echo $currencysym;?>" /></td>
	  </tr>
	   <tr>
		<td><?php _e( 'Allow users to submit question on your site?' );?></td>
		<td><input type="radio" name="is_user_addquestion" <?php if ( $is_user_addquestion == '1' ) { echo 'checked="checked"';}?>  value="1" /> <?php _e( 'Yes' );?>  <input type="radio" name="is_user_addquestion" <?php if ( $is_user_addquestion == '0' ) { echo 'checked="checked"';}?> value="0" /> <?php _e( 'No' );?></td>
	  </tr>
	   <tr>
		<td><?php _e( 'Question Default  Status (when a user posts a question, should it be auto published on your site?)' );?></td>
		<td><select name="approve_status">
			<option value="publish" <?php if ( $approve_status == 'publish' ) {?> selected="selected"<?php }?>><?php _e( 'Publish' );?></option>
			<option value="draft" <?php if ( $approve_status == 'draft' ) {?> selected="selected"<?php }?>><?php _e( 'Draft' );?></option>
		  </select>
		</td>
	  </tr>
<!--      //=========01.26 saijiro===============-->
      <tr>
          <td><?php _e( 'Answers Num' );?></td>
          <td><input type="text" name="answers_num" value="<?php echo $answers_num;?>" /></td>
      </tr>

      <tr>
          <td><?php _e( 'Main Tab title' );?></td>

                  <td>
                      <input type="text" name="main_tab_title1" value="<?php echo $main_tab_title1;?>" />
                      <input type="text" name="main_tab_title2" value="<?php echo $main_tab_title2;?>" />
                  </td>
      </tr>
<!--      //=========01.26 saijiro===============-->
	<tr><td colspan="2"><h2><?php _e( 'Payment Settings' );?></h2></td></tr>
	  <tr>
	  <tr>
		<td><?php _e( 'Question Post Fees in ' );
		echo '(' . get_currency_sym() . ')';?></td>
		<td><input type="text" name="fees" value="<?php echo $fees;?>" /></td>
	  </tr>
	   <tr>
		<td><?php _e( 'Paypal Merchant ID (Merchant ID to whom payment will be deposited)' );?></td>
		<td><input type="text" name="merchantid" value="<?php echo $merchantid;?>" /></td>
	  </tr>

			  <td></td>
		<td><h2><input type="submit" name="submit" value="<?php _e( 'Submit' );?>" class="button-secondary action" /></h2></td>
	  </tr>
	</thead>
  </table>
</form>
