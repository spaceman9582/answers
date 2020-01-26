<?php
global $wpdb;
if ( $_REQUEST['set_correct_answer'] ) {
	if ( $_REQUEST['correct_answer'] ) {
		$cid = sanitize_text_field( $_REQUEST['correct_answer'] );
		$pid = intval( $_REQUEST['pid'] );
		$wpdb->query( $wpdb->prepare( "update $wpdb->comments set correct_ans=0 where comment_post_ID=%d",$pid ) );
		$wpdb->query( $wpdb->prepare( "update $wpdb->comments set correct_ans=1 where comment_ID=%d",$cid ) );
		$redurl = str_replace( '?msg=selectans','',str_replace( '&msg=selectans','',$_SERVER['HTTP_REFERER'] ) );
		wp_redirect( $redurl . '#comments' );
	} else {
		$redurl = str_replace( '?msg=selectans','',str_replace( '&msg=selectans','',$_SERVER['HTTP_REFERER'] ) );
		if ( strstr( $redurl,'?' ) ) {
			$redirect_url = $redurl . '&msg=selectans#comments';
		} else {
			$redirect_url = $redurl . '?msg=selectans#comments';
		}
		wp_redirect( $redirect_url );
	}
	exit;
}
global $current_user;
if ( $_REQUEST ) {
	$_SESSION['comments_info'] = $_REQUEST;
	if ( $current_user->data->ID == '' ) {
		if ( $_REQUEST['user_login_or_not'] == 'existing_user' ) {
			$log = sanitize_text_field( $_REQUEST['log'] );
			$pwd = $_REQUEST['pwd'];
			$current_user = veryfy_login_and_proced( $_REQUEST,$_SERVER['HTTP_REFERER'] );
			include_once( TEMPLATEPATH . '/library/includes/comment_add.php' );
		} else {
			$user_login = '';
			$user_email = '';
			$base_url = sanitize_text_field( $_REQUEST['referer'] );

			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			if ( is_plugin_active( 'wp-recaptcha/wp-recaptcha.php' ) ) {

				if ( file_exists( ABSPATH . 'wp-content/plugins/wp-recaptcha/recaptchalib.php' ) ) {
					require_once( ABSPATH . 'wp-content/plugins/wp-recaptcha/recaptchalib.php' );
				}
				$a = get_option( 'recaptcha_options' );
				$show_in_registration = $a['show_in_registration']; // get option for captcha is enable for registration page

				$privatekey = $a['private_key'];
				/* get response for entered captcha */
					$resp = recaptcha_check_answer($privatekey,
						getenv( 'REMOTE_ADDR' ),
						$_POST['recaptcha_challenge_field'],
					$_POST['recaptcha_response_field']);


				/* blank field validation */
				if ( isset( $_POST['recaptcha_response_field'] ) && empty( $_POST['recaptcha_response_field'] ) || $_POST['recaptcha_response_field'] == '' ) {
						$redirect_url = $base_url . '?msg=reg_err&msg1=captcha_empty#respond';
						wp_redirect( $redirect_url );
						exit;
				}
				/* if captcha is not matched then add an error message */
				if ( ! $resp->is_valid ) {
					$redirect_url = $base_url . '&msg=reg_err&msg1=captcha_wrong#respond';
						wp_redirect( $redirect_url );
				}
			}




			if ( strstr( $base_url,'msg=' ) ) {
				$baseurl_arr = explode( 'msg=',$base_url );
				$base_url = substr( $baseurl_arr[0],0,strlen( $baseurl_arr[0] ) -1 );
			}

			if ( $_POST['user_fname'] == '' ) {
				if ( strstr( $_REQUEST['referer'],'?' ) ) {
					$redirect_url = $base_url . '&msg=reg_err&msg1=name_empty#respond';
				} else {
					$redirect_url = $base_url . '?msg=reg_err&msg1=name_empty#respond';
				}
				wp_redirect( $redirect_url );
				exit;
			}
			if ( $_POST['user_email'] == '' ) {
				if ( strstr( $_REQUEST['referer'],'?' ) ) {
					$redirect_url = $base_url . '&msg=reg_err&msg1=em_empty#respond';
				} else {
					$redirect_url = $base_url . '?msg=reg_err&msg1=em_empty#respond';
				}
				wp_redirect( $redirect_url );
				exit;
			}
			if ( $_POST['user_pwd'] ) {
				if ( strlen( $_POST['user_pwd'] ) < 6 ) {
					if ( strstr( $_REQUEST['referer'],'?' ) ) {
						$redirect_url = $base_url . '&msg=reg_err&msg1=pw_min#respond';
					} else {
						$redirect_url = $base_url . '?msg=reg_err&msg1=pw_min#respond';
					}
					wp_redirect( $redirect_url );
					exit;
				}
			} else {
				if ( strstr( $_REQUEST['referer'],'?' ) ) {
					$redirect_url = $base_url . '&msg=reg_err&msg1=pw_empty#respond';
				} else {
					$redirect_url = $base_url . '?msg=reg_err&msg1=pw_empty#respond';
				}
				wp_redirect( $redirect_url );
				exit;
			}

			if ( $_REQUEST['user_email'] ) {
				$user_login = $_REQUEST['user_email'];
				$user_email = $_REQUEST['user_email'];
				$user_pwd = $_REQUEST['user_pwd'];
				$errors = register_new_user_question( $user_login, $user_email,$user_pwd );
				global $current_user;
				if ( is_wp_error( $errors ) ) {
					if ( $errors->errors['username_exists'] ) {
						$errortype = 'regexist_err';
					} else {
						$errortype = 'reg_err';
					}
					if ( strstr( $_REQUEST['referer'],'?' ) ) {
						$redirect_url = $base_url . "&msg=$errortype#respond";
					} else {
						$redirect_url = $base_url . "?msg=$errortype#respond";
					}
					wp_redirect( $redirect_url );
					exit;
				} else {
					$user_pass = $_REQUEST['user_pwd'];
					$user_fname = $_REQUEST['user_fname'];
					//$user_login = str_replace(' ','',$_REQUEST['user_fname']);
					$user_login = $_REQUEST['user_email'];
					$user_email = $_REQUEST['user_email'];
					$user_pwd = $_REQUEST['user_pwd'];

					if ( $user_pass == '' ) {
						$user_pass = wp_generate_password( 12,false );
					}

					if ( is_wp_error( $errors ) ) {

					} else {
						$user_id = wp_create_user( $user_login, $user_pwd, $user_email );
						$user_nicename = get_user_nice_name( $_POST['user_fname'] ); //generate nice name
						$updateUsersql = "update $wpdb->users set display_name=\"$user_fname\" ,user_nicename=\"$user_nicename\" where ID=\"$user_id\"";
						$wpdb->query( $updateUsersql );
						$user_address_info = array(
						'first_name'	=> sanitize_text_field( $_POST['user_fname'] ),
						);
						foreach ( $user_address_info as $key => $val ) {
							update_usermeta( $user_id, $key, $val ); // User Address Information Here
						}

						$_POST['log'] = $_REQUEST['user_email'];
						$_POST['pwd'] = $_REQUEST['user_pwd'];
						$_POST['testcookie'] = 1;

						$secure_cookie = '';
						// If the user wants ssl but the session is not ssl, force a secure cookie.
						if ( ! empty( $_POST['log'] ) && ! force_ssl_admin() ) {
							$user_name = $_POST['log'];
							if ( $user = get_userdatabylogin( $user_name ) ) {
								if ( get_user_option( 'use_ssl', $user->ID ) ) {
									$secure_cookie = true;
									force_ssl_admin( true );
								}
							}
						}
						$redirect_to = $_REQUEST['reg_redirect_link'];
						if ( ! $secure_cookie && is_ssl() && force_ssl_login() && ! force_ssl_admin() && ( 0 !== strpos( $redirect_to, 'https' ) ) && ( 0 === strpos( $redirect_to, 'http' ) ) ) {
							$secure_cookie = false;
						}

						$user = wp_signon( '', $secure_cookie );
						global $current_user;
						$current_user = $user;
					}// End if().

					if ( ! $user_id ) {
						if ( strstr( $_REQUEST['referer'],'?' ) ) {
							$redirect_url = $base_url . "&msg=$errortype#respond";
						} else {
							$redirect_url = $base_url . "?msg=$errortype#respond";
						}
						wp_redirect( $redirect_url );
					}

					include_once( TEMPLATEPATH . '/library/includes/comment_add.php' );
				}// End if().
			} else {
				$errortype = 'reg_err';
				if ( strstr( $_REQUEST['referer'],'?' ) ) {
					$redirect_url = $base_url . "&msg=$errortype#respond";
				} else {
					$redirect_url = $base_url . "?msg=$errortype#respond";
				}
				wp_redirect( $redirect_url );
				exit;
			}// End if().
		}// End if().
	}// End if().
}// End if().
include_once( TEMPLATEPATH . '/library/includes/comment_add.php' );

