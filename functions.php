<?php
	/*************************************************************
		* Do not modify unless you know what you're doing, SERIOUSLY!
	*************************************************************/
	error_reporting( 0 );
	ob_start();
	load_theme_textdomain( 'default' );
	/*load_textdomain( 'default', TEMPLATEPATH.'/en_US.mo' );*/
	define( 'DOMAIN','templatic' );
	global $blog_id;
if ( get_option( 'upload_path' ) && get_option( 'upload_path' ) != 'wp-content/uploads' ) {
	$upload_folder_path = "wp-content/blogs.dir/$blog_id/files/";
} else {
	$upload_folder_path = 'wp-content/uploads/';
}
	global $blog_id;
if ( $blog_id ) { $thumb_url = "&amp;bid=$blog_id";}

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

	/* Admin framework version 2.0 by Zeljan Topic */
	//error_reporting(E_ERROR);
	// Theme variables
	require_once( TEMPLATEPATH . '/library/functions/theme_variables.php' );
	/* wp editor default mode should be visual */
	/*add_filter( 'wp_default_editor', create_function( '', 'return "tinymce";' ) );*//*PHP7 Compatibility*/
	add_filter( 'wp_default_editor', function(){return "tinymce";} );
	//** ADMINISTRATION FILES **//

	// Theme admin functions
	require_once( $functions_path . 'admin_functions.php' );

	// Theme admin options
	require_once( $functions_path . 'admin_options.php' );

	// Theme admin Settings
	require_once( $functions_path . 'admin_settings.php' );


	//** FRONT-END FILES **//
	require_once( $functions_path . 'image_resizer.php' );
	// Widgets
	require_once( $functions_path . 'widgets_functions.php' );
	// Custom
	require_once( $functions_path . 'custom_functions.php' );

	// Comments
	require_once( $functions_path . 'comments_functions.php' );
	require_once( $functions_path . 'yoast-canonical.php' );
	require_once( $functions_path . 'yoast-breadcrumbs.php' );

	require_once( $functions_path . '/admin_dashboard.php' );
	require_once( TEMPLATEPATH . '/language.php' );

	require( TEMPLATEPATH . '/product_menu.php' );

	require( TEMPLATEPATH . '/library/includes/comment-rating.php' );

if ( file_exists( get_template_directory() . '/library/functions/auto_install/auto_install.php' ) ) {
	require_once( get_template_directory() . '/library/functions/auto_install/auto_install.php' );

}
	global $table_prefix,$wpdb;

if ( get_option( 'ptthemes_captcha_reg_flag' ) == '' ) {
	include_once( TEMPLATEPATH . '/library/captcha/captcha_function.php' );
}

	//if(mysql_query("SELECT * FROM $wpdb->comments WHERE column_name='correct_ans'"))
if ( $wpdb->query( "SHOW COLUMNS FROM $wpdb->comments where Field='correct_ans'" ) ) {

} else {
	$cquery = "ALTER TABLE $wpdb->comments ADD correct_ans TINYINT( 4 ) NOT NULL DEFAULT '0'";
	$wpdb->query( $cquery );
}

	//add_action("admin_notices", "autoinstall_admin_header");
function autoinstall_admin_header() {
	global $wpdb;
	$tmp = '';
	$pg = '';
	$dummy = '';
	$dummy_insert = '';
	if ( isset( $_REQUEST['template'] ) ) :
		$tmp = sanitize_text_field( $_REQUEST['template'] );
		endif;
	if ( isset( $_GET['page'] ) ) :
		$pg = sanitize_text_field( $_GET['page'] );
		endif;
	if ( isset( $_REQUEST['dummy'] ) ) :
		$dummy = sanitize_text_field( $_REQUEST['dummy'] );
		endif;
	if ( isset( $_REQUEST['dummy_insert'] ) ) :
		$dummy_insert = sanitize_text_field( $_REQUEST['dummy_insert'] );
		endif;

	if ( strstr( $_SERVER['REQUEST_URI'],'themes.php' ) && $tmp == '' && $pg == '' ) {

		$menu_msg = "<p><b>CUSTOMIZE:</b> <a href='" . site_url( '/wp-admin/customize.php' ) . "'><b>Customize your Theme Options.</b></a><br/> <b>HELP:</b> <a href='//templatic.com/docs/answers-theme-guide/'> <b>Theme Documentation Guide</b></a> | <b>SUPPORT:</b><a href='https://templatic.com/contact/'> <b>HelpDesk</b></a></p>";

		$dummydata_title .= '<h3 class="twp-act-msg">' . sprintf( __( 'Thank you. %1$s (<small>%2$s</small>) theme is now activated.','templatic-admin' ),@wp_get_theme(),strtolower( $version ) ) . ' <a href="' . site_url() . '">Visit Your Site</a></h3>';

		/* system info goes in this filter */

		$dummydata_title .= apply_filters( 'tmpl_after_install_delete_button',$dummydata_title );
		/* guilde and support link */

		$dummy_data_msg .= apply_filters( 'tmpl_after_install_delete_button',$dummy_data_msg );

		$dummy_nstallation_link  = '<div class="tmpl-ai-btm-links clearfix"><ul><li>Need Help?</li><li><a href="//templatic.com/docs/answers-theme-guide/">Theme & Installation Guide</a></li><li><a href="//templatic.com/forums/viewforum.php?f=140">Support Forum</a></li><li><a href="//templatic.com/docs/submit-a-ticket/">HelpDesk</a></li></ul><p><a href="//templatic.com">Team Templatic</a> at your service</p></div>';
		$post_counts = $wpdb->get_var( "select count(post_id) from $wpdb->postmeta where (meta_key='pt_dummy_content' || meta_key='tl_dummy_content') and meta_value=1" );
		if ( $post_counts > 0 ) {
			$dummy_data_msg = '<h4><span id="success_msg_install" style="color:green;">' . __( 'All done. Your site is ready with sample data now.', 'templatic' ) . ' <a href="' . site_url() . '">' . __( 'Visit your site', 'templatic' ) . '</a>.</span><p>' . __( 'To make further adjustments to your site simply visit the', 'templatic' ) . ' <a href="' . site_url() . '">' . __( 'homepage', 'templatic' ) . '</a></p></h4><hr><div id="install-notification" ><h4 id="install_message">' . __( 'Wish to delete sample data?', 'templatic' ) . ' </h4><p>' . __( 'Please note that deleting sample data will also remove any content you may have added or edited on any sample content. Deleting the sample data will also remove all sample widgets which were inserted.', 'templatic' ) . '</p><span><h4>' . __( 'I understand.', 'templatic' ) . ' <a class="button button-primary delete-data-button" href="' . home_url() . '/wp-admin/themes.php?dummy=del">' . __( 'Delete sample data','templatic' ) . '</a></h4></span><span id="install-notification-nonce" class="hidden">' . esc_attr( wp_create_nonce( 'install-notification-nonce' ) ) . '</span></div>' . $dummy_nstallation_link;

		} else {
			$dummy_data_msg = '<div id="install-notification" class="tmpl-auto-install-yb"><h4>' . __( 'Your site not looking like our online demo?','templatic' ) . ' </h4> <span><a class="button button-primary" href="' . home_url() . '/wp-admin/themes.php?dummy_insert=1">' . __( 'Install sample data','templatic' ) . '</a></span> <p>' . __( 'So that you don&prime;t start on a blank site, the sample data will help you get started with the theme. The content includes some default settings, widgets in their locations, pages, posts and a few dummy listings.', 'templatic' ) . '</p>' . $dummy_nstallation_link ;

		}

		if ( $dummy == 'del' ) {
			delete_dummy_data();
			wp_redirect( admin_url() . 'themes.php' );
			exit;
		}
		if ( $dummy_insert ) {
			require_once( TEMPLATEPATH . '/auto_install.php' );
			wp_redirect( admin_url() . 'themes.php' );
			exit;
		}
		//define('THEME_ACTIVE_MESSAGE','<div id="ajax-notification" class="updated templatic_autoinstall"><p> '.$dummy_data_msg.'</p></div>');
		define( 'THEME_ACTIVE_MESSAGE','<div id="ajax-notification" class="welcome-panel tmpl-welcome-panel"><div class="welcome-panel-content">' . $dummy_data_msg . '<span id="ajax-notification-nonce" class="hidden">' . esc_attr( wp_create_nonce( 'ajax-notification-nonce' ) ) . '</span><a href="javascript:;" id="dismiss-ajax-notification" class="templatic-dismiss" style="float:right">Dismiss</a></div></div>' );
		echo THEME_ACTIVE_MESSAGE;

	}// End if().
}



function delete_dummy_data() {
	global $wpdb;
	delete_option( 'sidebars_widgets' ); //delete widgets
	$pids_sql = "select p.ID from $wpdb->posts p join $wpdb->postmeta pm on pm.post_id=p.ID where (meta_key='pt_dummy_content' || meta_key='tl_dummy_content') and meta_value=1";
	$pids_info = $wpdb->get_results( $pids_sql );
	foreach ( $pids_info as $pids_info_obj ) {
		wp_delete_post( $pids_info_obj->ID,true );
	}
}

function get_image_cutting_edge( $args = array() ) {
	if ( $args['image_cut'] ) {
		$cut_post = $args['image_cut'];
	} else {
		$cut_post = get_option( 'ptthemes_image_x_cut' );
	}
	if ( $cut_post ) {
		if ( $cut_post == 'top' ) {
			$thumb_url .= '&amp;a=t';
		} elseif ( $cut_post == 'bottom' ) {
			$thumb_url .= '&amp;a=b';
		} elseif ( $cut_post == 'left' ) {
			$thumb_url .= '&amp;a=l';
		} elseif ( $cut_post == 'right' ) {
			$thumb_url .= '&amp;a=r';
		} elseif ( $cut_post == 'top right' ) {
			$thumb_url .= '&amp;a=tr';
		} elseif ( $cut_post == 'top left' ) {
			$thumb_url .= '&amp;a=tl';
		} elseif ( $cut_post == 'bottom right' ) {
			$thumb_url .= '&amp;a=br';
		} elseif ( $cut_post == 'bottom left' ) {
			$thumb_url .= '&amp;a=bl';
		}
	}
	return $thumb_url;
}

	add_action( 'after_setup_theme', 'setup' );
function setup() {
	add_theme_support( 'post-thumbnails' ); // This feature enables post-thumbnail support for a theme
	add_image_size( 'listing-thumb', 95, 95, true ); //(cropped)
}

	add_filter( 'image_size_names_choose', 'custom_image_sizes_crop' );
function custom_image_sizes_crop( $sizes ) {
	$custom_sizes = array(
	'listing-thumb' => 'Listing Thumb',
	);
	return array_merge( $sizes, $custom_sizes );
}

	add_action( 'admin_footer','delete_sample_data' );
if ( ! function_exists( 'delete_sample_data' ) ) {
	function delete_sample_data() {
		?>
		<script type="text/javascript">
		jQuery(document).ready( function(){
			jQuery('.button_delete').click( function() {
				if(confirm('All the sample data and your modifications done with it, will be deleted forever! Still you want to proceed?')){
					window.location = "<?php echo home_url()?>/wp-admin/themes.php?dummy=del";
					}else{
					return false;
				}   
			});
		});
		</script>
	<?php }
}

	//Set Default permalink on theme activation: start
	add_action( 'load-themes.php', 'default_permalink_set' );
function default_permalink_set() {
	global $pagenow;
	if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) { // Test if theme is activate
		//Set default permalink to postname start
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
		$wp_rewrite->flush_rules();
		if ( function_exists( 'flush_rewrite_rules' ) ) {
			flush_rewrite_rules( true );
		}
	}
}
	//Set Default permalink on theme activation: end

	/* css to hide notification */
	add_action( 'admin_notices','add_css_to_admin' );
function add_css_to_admin() {
	echo '<style type="text/css">
		#message1{
		display:none;
		}
		
		body .button.delete-data-button { background: #d54e21; border-color: #d54e21; box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset }
		
		body .button.delete-data-button:hover { background: #e65423; border-color: #d54e21; box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset }
		
		.welcome-panel-content .form-table {width: auto; margin: 0 -20px!important; display: flex; display: -webkit-flex; justify-content: space-between; -webkit-justify-content: space-between; margin-top: 20px; }
		
		.form-table, .form-table td, .form-table td p, .form-table th, .form-wrap label { font-size: 16px; }
		
		.licence-key input[type="password"] { background-color: #fff; border: 1px solid #ddd; box-shadow: none; clear: both; color: #333; display: inline-block; font-size: 16px; margin: 0; outline: 0 none; padding: 12px; transition: border-color 0.05s ease-in-out 0s; width: 100%; border-radius: 4px; position: relative;}
		
		.licence-key h2 span, .sample-data h2 span{padding-right:10px;}
		.form-table h2 { 
		border-bottom: 1px solid #dedede;
	    clear: both;
	    color: #666;
	    font-size: 24px;
	    font-weight: 400;
	    margin: 30px 0;
	    padding: 0 0 7px;
		}
		
		.licence-key { border-radius: 4px; margin-bottom: 80px; position: relative;}
		
		
		.form-table > div{
		
		margin: 0 20px;
		
		max-width: 50%;
		
		width: 100%;
		
		}
		
		.video iframe{border-radius:0 0 4px 4px; margin-bottom: 40px;}
		
		
		
		.window {
		
		background: none repeat scroll 0 0 #fff;
		
		border-radius: 4px;
		
		padding: 20px;
		
		position: absolute;
		
		z-index: 2;
		
		}
		
		#mask{
		
		background: none repeat scroll 0 0 black;
		
		height: 100%;
		
		left: 0 !important;
		
		opacity: 0.5;
		
		position: absolute;
		
		top: 0 !important;
		
		width: 100%;
		
		z-index: 1;
		
		}
		
		.dashicons, .dashicons-before::before{
		
		text-decoration: none!important;
		
		}
		
		.tmpl-welcome-panel{border-width: 1px!important;}
		
		.form-table a { color: #0074a2; }
		
		
		
		.licence-key-wrap:before{content: "\f00c"; font-family: FontAwesome; position: absolute; color: #62b748; bottom: inherit;}
		.licence-key-wrap p{padding-left: 25px; font-size: 18px;}
		
		.form-table .sample-data{margin-top: 55px;}
		
		.welcome-panel .twp-act-msg { font-size: 24px !important; color: #333 !important; }
		
		.licensekey_boxes h2 { color: #333; font-size: 22px; font-weight: bold; margin: 0 0 5px; }
		
		#adminmenu .wp-submenu a:focus, #adminmenu .wp-submenu a:hover, #adminmenu a:hover, #adminmenu li.menu-top > a:focus { color: #0074a2 !important; }
		
		.theme-browser .theme .theme-actions { padding: 4px 10px !important; }
		
		.tmpl-welcome-panel{
		
		margin: 50px auto!important;
		
		}
		
		.welcome-panel{
		
		padding: 20px;
		border: none;
		
		}
		
		.welcome-panel h4{
		
		margin: 1em 0;
		
		}
		.before-autoinstall{position: relative;}
		.before-autoinstall.licence-key-wrap:before{bottom: 0;}
		
		.tmpl-welcome-panel {
		overflow: hidden;
		max-width: 1472px;
		border: 2px solid #cccccc;
		box-shadow: none;
		margin-bottom: 30px;
		}
		
		.wrapper_templatic_auto_install_col3 {
		display: inline-block;
		width: 100%;
		}
		
		.templatic_auto_install_col3 {
		display: inline-block;
		vertical-align: top;
		width: 100%;
		max-width: 312px;
		margin: 0 38px 20px 0;
		}
		
		.templatic_auto_install_col3 h4 {
		border-bottom: 1px solid #ddd;
		font-size: 16px;
		color: #333;
		padding-bottom: 4px;
		}
		
		.templatic_auto_install_col3 ul {
		list-style: disc outside;
		margin: 5px 0 5px 15px;
		}
		
		.templatic_auto_install_col3 ul li {
		margin-bottom: 0;
		}
		
		.wrapper_templatic_auto_install_col3 a {
		display: inline-block!important;
		}
		
		.tmpl-ai-btm-links {
		background: #fcf48c;
		padding: 22px 16px;
		margin: 18px -23px 0 -23px;
		display: inline-block;
		width: 100%;
		}
		
		.tmpl-ai-btm-links ul {
		float: left;
		margin: 0;
		}
		
		.tmpl-ai-btm-links ul li {
		display: inline-block;
		vertical-align: top;
		font-size: 14px;
		color: #666;
		margin: 0 0 0 30px;
		}
		
		.tmpl-ai-btm-links p {
		float: right;
		font-size: 14px;
		color: #777;
		font-style: italic;
		margin: 3px 0;
		}
		
		.tmpl-auto-install-yb {
		background: #fffbcc;
		border: 1px solid #e6db55;
		padding: 18px 20px;
		margin: 18px 0;
		position: relative;
		}
		
		.tmpl-auto-install-yb h4 {
		display: inline-block;
		font-size: 18px;
		color: #000;
		font-weight: bold;
		margin: 0 10px 0 0;
		}
		
		.tmpl-auto-install-yb p {
		font-size: 15px;
		color: #000;
		margin-bottom: 0;
		}
		
		.wp-core-ui .templatic_login input[type=submit].button-primary, .templatic_login input[type=submit], .wp-core-ui .button-primary, .wp-core-ui .button-primary, .wp-core-ui .button-primary, .wp-core-ui .button-primary, .templatic_login .button-primary {
		background: none repeat scroll 0 0 #2EA2CC;
		border-color: #0074A2;
		box-shadow: 0 1px 0 rgba(120,200,230,0.5) inset, 0 1px 0 rgba(0,0,0,0.15);
		-webkit-box-shadow: 0 1px 0 rgba(120,200,230,0.5) inset, 0 1px 0 rgba(0,0,0,0.15);
		border-color: #21759B;
		border-radius: 3px;
		border-style: solid;
		border-width: 1px;
		box-shadow: 0 1px 0 rgba(120,200,230,0.5) inset;
		color: #FFFFFF;
		cursor: pointer;
		display: inline-block;
		font-size: 12px;
		height: 30px;
		line-height: 30px;
		margin-right: 10px;
		padding: 0 12px 2px;
		text-decoration: none;
		text-shadow: 0 1px 0 rgba(0,0,0,0.1);
		}
		
		</style>';
}


/*add_filter('wp_nav_menu_args', 'prefix_nav_menu_args');
function prefix_nav_menu_args($args = ''){
    $args['container'] = false;
    return $args;
}*/


?>
