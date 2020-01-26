<?php
global $current_user;
if ( $_POST && $current_user->data->ID == '' && $_SESSION['question_info']['user_email'] ) {
	if ( $_SESSION['question_info']['user_email'] == '' ) {
		wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=reg_err' );
	}

	include_once( ABSPATH . 'wp-includes/registration.php' );

	global $wpdb;
	$errors = new WP_Error();

	$user_email = $_SESSION['question_info']['user_email'];
	$user_login = $_SESSION['question_info']['user_fname'];
	$user_login = $user_login;
	$user_email = apply_filters( 'user_registration_email', $user_email );

	// Check the username
	if ( $user_login == '' ) {
		$errors->add( 'empty_username', __( 'ERROR: Please enter a username.' ) );
	} elseif ( ! validate_username( $user_login ) ) {
		$errors->add( 'invalid_username', __( '<strong>ERROR</strong>: This username is invalid.  Please enter a valid username.' ) );
		$user_login = '';
	} elseif ( username_exists( $user_login ) ) {
		$errors->add( 'username_exists', __( '<strong>ERROR</strong>: ' . $user_email . ' This username is already registered, please choose another one.' ) );
	}

	// Check the e-mail address
	if ( $user_email == '' ) {
		$errors->add( 'empty_email', __( '<strong>ERROR</strong>: Please type your e-mail address.' ) );
	} elseif ( ! is_email( $user_email ) ) {
		$errors->add( 'invalid_email', __( '<strong>ERROR</strong>: The email address isn&#8217;t correct.' ) );
		$user_email = '';
	} elseif ( email_exists( $user_email ) ) {
		wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=existreg_err' );
	}

	do_action( 'register_post', $user_login, $user_email, $errors );

	$errors = apply_filters( 'registration_errors', $errors );
	if ( $errors->get_error_code() ) {
		wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=reg_err' );
	}

	$user_pass = $_SESSION['question_info']['user_pwd'];
	if ( $user_pass == '' ) {
		$user_pass = wp_generate_password( 12,false );
	}
	$user_id = wp_create_user( $user_login, $user_pass, $user_email );
	$current_user->data->ID = $user_id;
	if ( ! $user_id ) {
		wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=cannotreg_err' );
	}

	$user_fname = $_SESSION['question_info']['user_fname'];
	$user_web = $_SESSION['question_info']['user_web'];
	$userName = $_SESSION['question_info']['user_fname'];
	$user_nicename = strtolower( str_replace( array( "'", '"', '?', '.', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '+', '+', ' ' ),array( '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-' ),$user_login ) );
	$user_nicename = get_user_nice_name( $user_fname,'' ); //generate nice name

	$user_address_info = array(
							'user_twitter'	=> $user_twitter,
							);
	foreach ( $user_address_info as $key => $val ) {
		update_usermeta( $user_id, $key, $val ); // User Address Information Here
	}
		$updateUsersql = "update $wpdb->users set user_url=\"$user_web\", user_nicename=%s, display_name=%s where ID=%d";
		$wpdb->query( $wpdb->prepare( $updateUsersql,$user_nicename,$user_fname,$user_id ) );

	$_POST['log'] = $user_login;
	$_POST['pwd'] = $user_pass;
	$secure_cookie = '';
	if ( ! empty( $_POST['log'] ) && ! force_ssl_admin() ) {
		$user_name = $_POST['log'];
		if ( $user = get_userdatabylogin( $user_name ) ) {
			if ( get_user_option( 'use_ssl', $user->ID ) ) {
				$secure_cookie = true;
				force_ssl_admin( true );
			}
		}
	}
	$current_user = wp_signon( '', $secure_cookie );
	//wp_new_user_notification($user_id, $user_pass);
	if ( $user_id ) {
		//wp_new_user_notification($user_id, $user_pass);
		///////REGISTRATION EMAIL START//////
		$fromEmail = get_site_emailId();
		$fromEmailName = get_site_emailName();
		$store_name = get_option( 'blogname' );
		global $upload_folder_path;
		$clientdestinationfile = ABSPATH . $upload_folder_path . 'notification/emails/registration.txt';
		if ( ! file_exists( $clientdestinationfile ) ) {
			$client_message = REGISTRATION_EMAIL_DEFAULT_TEXT;
		} else {
			$client_message = file_get_contents( $clientdestinationfile );
		}
		$filecontent_arr1 = explode( '[SUBJECT-STR]',$client_message );
		$filecontent_arr2 = explode( '[SUBJECT-END]',$filecontent_arr1[1] );
		$subject = $filecontent_arr2[0];
		if ( $subject == '' ) {
			$subject = 'Registration Email';
		}
		$client_message = $filecontent_arr2[1];
		//      $store_login = get_option('siteurl').'/?page=login';
		$store_login = '<a href="' . get_option( 'siteurl' ) . '/?ptype=login&page1=sign_in">Click Login</a>';
		$store_login_link = get_option( 'siteurl' ) . '/?ptype=login&page1=sign_in';
		/////////////customer email//////////////
		$search_array = array( '[#$user_name#]','[#$user_login#]','[#$user_password#]','[#$store_name#]','[#$store_login_url#]','[#$store_login_url_link#]' );
		$replace_array = array( $_SESSION['question_info']['user_fname'],$user_login,$user_pass,$store_name,$store_login,$store_login_link );
		$client_message = str_replace( $search_array,$replace_array,$client_message );
		sendEmail( $fromEmail,$fromEmailName,$user_email,$userName,$subject,$client_message,$extra = '' );///To clidne email
		//////REGISTRATION EMAIL END////////
	}
	$current_user_id = $user_id;
} else {
	wp_redirect( get_option( 'siteurl' ) . '/?ptype=ask-a-question&backandedit=1&msg=reg_err' );
}// End if().

