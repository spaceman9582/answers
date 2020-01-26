<?php
$wp_user_roles_arr = get_option( 'wp_user_roles' );
if ( strstr( $_SERVER['REQUEST_URI'],'/themes.php' ) && $_REQUEST['activated'] == 'true' ) {
	$wp_user_roles_arr['agent'] = array(
							'name'	=> 'Agent',
							'capabilities' => array(
													'upload_files' => 0,
													'edit_posts' => 0,
													'edit_published_posts' => 0,
													'publish_posts' => 0,
													'read' => 1,
													'level_2' => 1,
													'level_1' => 1,
													'level_0' => 1,
													'delete_posts' => 0,
													'delete_published_posts' => 0,
												),

							);

	update_option( 'wp_user_roles', $wp_user_roles_arr );
}


///auto install start//
if ( strstr( $_SERVER['REQUEST_URI'],'themes.php' ) ) {
	if ( $_REQUEST['dummy'] == 'del' ) {
		delete_dummy_data();
		echo THEME_DUMMY_DELETE_MESSAGE;
	}
	if ( ($_REQUEST['template'] == '' && $post_counts > 0 && $_REQUEST['page'] == '') || $_REQUEST['activated'] == 'true' ) {
		echo THEME_ACTIVE_MESSAGE;
	}
	if ( $_REQUEST['activated'] ) {
		require_once( TEMPLATEPATH . '/auto_install.php' );
	}
}

function delete_dummy_data() {
	global $wpdb;
	$productArray = array();
	$pids_sql = "select p.ID from $wpdb->posts p join $wpdb->postmeta pm on pm.post_id=p.ID where meta_key='pt_dummy_content' and meta_value=1";
	$pids_info = $wpdb->get_results( $pids_sql );
	foreach ( $pids_info as $pids_info_obj ) {
		wp_delete_post( $pids_info_obj->ID );
	}

}
	///auto install end//

