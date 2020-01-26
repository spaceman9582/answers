<?php
add_action( 'admin_notices', 'tmpl_answers_autoinstall' );
function tmpl_answers_autoinstall() {
	global $wpdb,$pagenow;
	if ( $pagenow == 'themes.php' ) :
		$wp_user_roles_arr = get_option( $wpdb->prefix . 'user_roles' );

		$dummy_insert = '';
		if ( isset( $_REQUEST['dummy_insert'] ) ) {
			$dummy_insert = $_REQUEST['dummy_insert'];
		}

		$post_counts = $wpdb->get_var( "select count(p.ID) from $wpdb->posts p join $wpdb->postmeta pm on pm.post_id=p.ID where (meta_key='pt_dummy_content' || meta_key='tl_dummy_content' || meta_key='auto_install') and (meta_value=1 || meta_value='auto_install')" );

		/* help links */
		$menu_msg1 = "<ul><li><a href='" . site_url( '/wp-admin/admin.php?page=theme_settings' ) . "'>" . __( 'Add your logo','magazine' ) . ' </a></li>';
		$menu_msg1 .= "<li><a href='" . site_url( '/wp-admin/admin.php?page=theme_settings' ) . "'>" . __( 'Change site colors','magazine' ) . ' </a></li>';
		$menu_msg1 .= "<li><a href='" . site_url( '/wp-admin/nav-menus.php?action=edit' ) . "'>" . __( 'Manage menu navigation','magazine' ) . '</a></li>';
		$menu_msg1 .= "<li><a href='" . site_url( '/wp-admin/widgets.php' ) . "'>" . __( 'Manage sidebar widgets ','magazine' ) . ' </a></li></ul>';

		$menu_msg2 = "<ul><li><a href='" . site_url( '/wp-admin/post-new.php' ) . "'>" . __( 'Add a post','magazine' ) . '</a></li>';
		$menu_msg2 .= "<li><a href='" . site_url( '/wp-admin/post-new.php?post_type=page' ) . "'>" . __( 'Setup pages','magazine' ) . '</a></li></ul>';

		$my_theme = wp_get_theme();
		$theme_name = $my_theme->get( 'Name' );
		$version = $my_theme->get( 'Version' );

		$dummydata_title = '';
		$dummy_data_msg = '';
		$dummy_theme_message = '';
		$dummydata_title .= '<h3 class="twp-act-msg">' . sprintf( __( 'Thank you. %1$s (<small>v</small> %2$s) is now activated.','magazine' ),@wp_get_theme(),strtolower( $version ) ) . ' <a href="' . site_url() . '">Visit Your Site</a></h3>';

		/* system info goes in this filter */
		$dummydata_title = apply_filters( 'tmpl_after_install_delete_button',$dummydata_title );

		/* theme message */
		$dummy_theme_message .= '<div class="tmpl-wp-desc">The <b>' . wp_get_theme() . '</b> theme is ideal for creating a question answer portal. To help you setup the theme, please refer to its <a href="http://templatic.com/docs/shopoholic-theme-guide/">Installation Guide</a> to help you better understand the theme&#39;s functions. To help you get started, we have outlined a few recommended steps below to get you going. Should you need any assistance please create a ticket in our <a href="http://templatic.com/docs/submit-a-ticket/">helpdesk</a>.</div>';

		/* guilde and support link */

		$dummy_data_msg .= apply_filters( 'tmpl_after_install_delete_button',$dummy_data_msg );

		$dummy_nstallation_link  = '<div class="tmpl-ai-btm-links clearfix"><ul><li>Need Help?</li><li><a href="https://templatic.com/docs/answers-theme-guide/">Theme & Installation Guide</a></li><li><a href="http://templatic.com/docs/submit-a-ticket/">HelpDesk</a></li></ul><p><a href="http://templatic.com">Team Templatic</a> at your service</p></div>';

		if ( $post_counts > 0 ) {

			$theme_name = get_option( 'stylesheet' );

			$dummy_data_msg = '';

			$dummy_data_msg = $dummydata_title;

			$dummy_data_text_msg = '
			
			<h4><span id="success_msg_install" style="color:green;">' . __( 'All done. Your site is ready with sample data now.', 'magazine' ) . ' <a href="' . site_url() . '">' . __( 'Visit your site', 'magazine' ) . '</a>.</span>
			<p>' . __( 'To make further adjustments to your site simply visit the', 'magazine' ) . ' <a href="' . site_url() . '">' . __( 'homepage', 'magazine' ) . '</a></p></h4>
<hr>
			<div id="install-notification" ><h4 id="install_message">' . __( 'Wish to delete sample data?', 'magazine' ) . ' </h4><p>' . __( 'Please note that deleting sample data will also remove any content you may have added or edited on any sample content. Deleting the sample data will also remove all sample widgets which were inserted.', 'magazine' ) . '</p><span><h4>' . __( 'I understand.', 'magazine' ) . ' <a class="button button-primary delete-data-button" href="' . home_url() . '/wp-admin/themes.php?dummy=del">' . __( 'Delete sample data','magazine' ) . '</a></h4></span>';

			$dummy_data_text_msg .= '<span id="install-notification-nonce" class="hidden">' . esc_attr( wp_create_nonce( 'install-notification-nonce' ) ) . '</span></div>';

			$dummy_data_msg .= $dummy_theme_message;

		} else {

			$theme_name = get_option( 'stylesheet' );

			$dummy_data_msg = '';

			$dummy_data_msg = $dummydata_title;

			$dummy_data_text_msg = '<div id="install-notification" class="tmpl-auto-install-yb"><h4>' . __( 'Your site not looking like our online demo?','magazine' ) . ' </h4> <span><a class="button button-primary" href="' . home_url() . '/wp-admin/themes.php?dummy_insert=1">' . __( 'Install sample data','magazine' ) . '</a></span> <p>' . __( 'So that you don&prime;t start on a blank site, the sample data will help you get started with the theme. The content includes some default settings, widgets in their locations, pages, posts and a few dummy posts.', 'magazine' ) . '</p>';

			$dummy_data_text_msg .= '<span id="install-notification-nonce" class="hidden">' . esc_attr( wp_create_nonce( 'install-notification-nonce' ) ) . '</span></div>';

			$dummy_data_msg .= $dummy_theme_message;

		}// End if().

		/* if($post_counts>0) 	{*/

		$theme_name = get_option( 'stylesheet' );

		$dummy_data_msg = '';
		$dummy_data_msg_l = '';
		$dummy_data_msg = $dummydata_title;

		$t_theme_licence_key_ = get_option( 'templatic_licence_key' );

		$licencekey_frm = '<h2>' . __( 'Your site not looking like our online demo?', 'magazine' ) . '</h2>

					<div class="sample-data-wrap">

					' . $dummy_data_text_msg . do_action( 'tmpl_error_message' ) . '</div>';

		$dummy_data_msg .= '

		<form action="#" name="" method="post">

		<div class="form-table">

			<div class="theme-step">

				<div class="licence-key">

					' . $licencekey_frm . '

					</div>	';

			$dummy_data_msg .= '</div>';

		$dummy_data_msg_l .= '<div class="wrapper_templatic_auto_install_col3"><div class="templatic_auto_install_col3"><h4>' . __( 'Customize Your Website','magazine' ) . '</h4>' . $menu_msg1 . '</div>';
		$dummy_data_msg_l .= '<div class="templatic_auto_install_col3"><h4>' . __( 'Next Steps','magazine' ) . '</h4>' . $menu_msg2 . '</div></div>';

		$dummy_data_msg .= "<div class='sample-data'>" . $dummy_theme_message . $dummy_data_msg_l . '</div></div>';
		$dummy_data_msg .= '</form>';
		$dummy_data_msg .= $dummy_nstallation_link;

		/* Delete the dummy data */
		if ( isset( $_REQUEST['dummy'] ) && $_REQUEST['dummy'] == 'del' ) {
			tmpl_answers_delete_dummy_data();
			update_option( 'listing_xml',0 );
			$url = admin_url() . 'themes.php';
			wp_redirect( admin_url() . 'themes.php' );
		}

		if ( $dummy_insert ) {
			require_once( get_template_directory() . '/library/functions/auto_install/auto_install_data.php' );
			wp_redirect( admin_url() . 'themes.php?x=y' );
			exit;
		}

		define( 'THEME_ACTIVE_MESSAGE','<div id="ajax-notification" class="welcome-panel tmpl-welcome-panel"><div class="welcome-panel-content">' . $dummy_data_msg . '<span id="ajax-notification-nonce" class="hidden">' . esc_attr( wp_create_nonce( 'ajax-notification-nonce' ) ) . '</span><a href="javascript:;" id="dismiss-ajax-notification" class="templatic-dismiss" style="float:right">Dismiss</a></div></div>' );

		/* print the autoinstall box */
		echo THEME_ACTIVE_MESSAGE;
	endif;
}


/*
 To delete dummy data
*/
function tmpl_answers_delete_dummy_data() {
	global $wpdb;

	delete_option( 'sidebars_widgets' ); //delete widgets
	$productArray = array();
	$pids_sql = "select p.ID from $wpdb->posts p join $wpdb->postmeta pm on pm.post_id=p.ID where (meta_key='pt_dummy_content' || meta_key='tl_dummy_content' || meta_key='auto_install') and (meta_value=1 || meta_value='auto_install')";

	$pids_info = $wpdb->get_results( $pids_sql );
	foreach ( $pids_info as $pids_info_obj ) {
		wp_delete_post( $pids_info_obj->ID,true );
	}
	$widget_array = array(
		'widget_social_media',
		'widget_googlemap_homepage',
		'widget_templatic_text',
		'widget_supreme_subscriber_widget',
		'widget_hybrid-categories',
		'widget_widget_directory_featured_category_list',
		'widget_directory_featured_homepage_listing',
		'widget_templatic_key_search_widget',
		'widget_flicker_widget',
		'widget_hybrid-pages',
		'widget_templatic_browse_by_categories',
		'widget_templatic_aboust_us',
		'widget_supreme_facebook',
		'widget_directory_mile_range_widget',
		'widget_directory_neighborhood',
		'widget_templatic_popular_post_technews',
		'widget_templatic_twiter',
		'widget_text',
		'widget_templatic_google_map',
		'widget_supreme_facebook',
	);
	foreach ( $widget_array as $widget_array ) {
		delete_option( $widget_array ); //delete widgets
	}
}
/* Setting For dismiss auto install notification message from themes.php START */
wp_register_theme_activation_hook( wp_get_theme(), 'activate' );
wp_register_theme_deactivation_hook( wp_get_theme(), 'deactivate' );
function wp_register_theme_activation_hook( $code, $function ) {

	add_option( 'hide_ajax_notification',  false );

}
function wp_register_theme_deactivation_hook( $code, $function ) {
	/* store function in code specific global */
	$GLOBALS[ 'wp_register_theme_deactivation_hook_function' . $code ] = $function;

	/* create a runtime function which will delete the option set while activation of this theme and will call deactivation function provided in $function */
	$fn = create_function( '$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option( "hide_ajax_notification" );' );

	/* Your theme can perceive this hook as a deactivation hook.*/
	add_action( 'switch_theme', $fn );
}
//add_action( 'admin_footer', 'tmpl_splendor_register_admin_scripts'  );
add_action( 'wp_ajax_hide_admin_notification', 'tmpl_answers_hide_admin_notification' );
add_action( 'wp_ajax_hide_authoinstall_notification', 'tmpl_answers_hide_autoinstall_notification' );
function activate() {
	add_option( 'hide_ajax_notification', false );
	add_option( 'hide_install_notification', false );
}
function deactivate() {
	delete_option( 'hide_ajax_notification' );
	delete_option( 'hide_install_notification' );
}
function tmpl_splendor_register_admin_scripts() {
	wp_register_script( 'ajax-notification-admin', get_template_directory_uri() . '/js/_admin-install.js' );
	wp_enqueue_script( 'ajax-notification-admin' );
}
function tmpl_splendor_hide_admin_notification() {
	if ( wp_verify_nonce( $_REQUEST['nonce'], 'ajax-notification-nonce' ) ) {
		if ( update_option( 'hide_ajax_notification', true ) ) {
			die( '1' );
		} else {
			die( '0' );
		}
	}
}
/* to hide auto install notifications */
function tmpl_splendor_hide_autoinstall_notification() {
	if ( wp_verify_nonce( $_REQUEST['nonce'], 'install-notification-nonce' ) ) {
		if ( update_option( 'hide_install_notification', true ) ) {
			die( '1' );
		} else {
			die( '0' );
		}
	}
}


/* Alert warning message when user goes to delete data: start */
add_action( 'admin_footer','tmpl_answers_delete_sample_data' );
function tmpl_answers_delete_sample_data() {
	?>
<script type="text/javascript">
jQuery(document).ready( function(){

		jQuery('.tmpl-auto-install-yb a.button-primary').click(function(e){
			/* if button is disabled then do not allow to click again */
			if(jQuery(this).is('[disabled=disabled]')){
				return false;
			}	
			if(jQuery(this).parent().find('.delete-data-button').length <= 0 )
			{ 
					jQuery('span a.button-primary').html('Installing Sample Data...');
					jQuery('.tmpl-auto-install-yb span').append('<span style="color:green">This <strong>could take up to 5-10 minutes</strong>. Sit back and relax while we install the sample data for you. Please do not close this window until it completes.</span>');
					/* disable button during auto install is running */
					jQuery(this).attr("disabled","disabled");
					return true;
			}
		});
		
		jQuery('.delete-data-button').click(function(){

			/* if button is disabled then do not allow to click again */
			if(jQuery(this).is('[disabled=disabled]')){
				return false;
			}	

			  if (confirm("Sure want to delete sample data?") == true) {
				jQuery('span a.delete-data-button').html('Deleting Sample Data...');
				jQuery('#install-notification #success_msg_install').remove();
				jQuery('#install-notification  span').append('<span style="color:red;font-size: 13px;">This <strong>could take up to 5-10 minutes</strong>. Sit back and relax while we delete the sample data for you. Please do not close this window until it completes.</span>');
				/* disable button during auto install is running */
				 jQuery(this).attr("disabled","disabled");
				 return true;
			}else{
				return false;
			}
		});
		
		<?php if ( isset( $_REQUEST['x'] ) && $_REQUEST['x'] == 'y' ) { ?>
		   jQuery('.tmpl-auto-install-yb span').append('<span style="color:green">All done. Your site is ready with sample data now. <a href="<?php echo site_url(); ?>">Visit your site</a>.</span>');
		<?php } ?>
  
});
</script>
<?php
}

?>
