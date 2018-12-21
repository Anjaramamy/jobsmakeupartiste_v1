<?php
/**
 * Wordpress Users Login
 */

if ( ! function_exists( 'mkdf_membership_login_user' ) ) {
	/**
	 * Login user
	 */
	function mkdf_membership_login_user() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			mkdf_membership_ajax_response( 'error', esc_html__( 'All fields are empty', 'mkdf-membership' ) );
		} else {
			check_ajax_referer( 'mkdf-ajax-login-nonce', 'security' );
			$data = $_POST;
			
			$login = $data['login_data'];
			parse_str( $login, $login_data );
			
			$credentials['user_login']    = $login_data['user_login_name'];
			$credentials['user_password'] = $login_data['user_login_password'];
			$redirect_uri                 = $login_data['redirect'];
			
			if ( isset( $credentials['remember'] ) && $credentials['remember'] == 'forever' ) {
				$credentials['remember'] = true;
			} else {
				$credentials['remember'] = false;
			}
			$user_signon = wp_signon( $credentials, false );
			
			if ( is_wp_error( $user_signon ) ) {
				mkdf_membership_ajax_response( 'error', esc_html__( 'Wrong username or password.', 'mkdf-membership' ) );
			} else {
				if ( $redirect_uri == '' ) {
					$redirect_uri = mkdf_membership_get_dashboard_page_url();
					if ( empty( $redirect_uri ) ) {
						$redirect_uri = esc_url( home_url( '/' ) );
					}
				}
				mkdf_membership_ajax_response( 'success', esc_html__( 'Login successful, redirecting...', 'mkdf-membership' ), $redirect_uri );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_nopriv_mkdf_membership_login_user', 'mkdf_membership_login_user' );
}

if ( ! function_exists( 'mkdf_membership_register_user' ) ) {
	/**
	 * Register new user
	 */
	function mkdf_membership_register_user() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			mkdf_membership_ajax_response( 'error', esc_html__( 'All fields are empty', 'mkdf-membership' ) );
		} else {
			check_ajax_referer( 'mkdf-ajax-register-nonce', 'security' );
			$data = $_POST;
			
			$register = $data['register_data'];
			parse_str( $register, $register_data );
			$credentials['user_login']       = $register_data['user_register_name'];
			
			$credentials['user_email']       = $register_data['user_register_email'];
			$credentials['password']         = $register_data['user_register_password'];
			$credentials['confirm_password'] = $register_data['user_register_confirm_password'];
			$credentials['user_name_societe']   = $register_data['user_register_name_societe'];
			
			

			$user_id    = username_exists( $credentials['user_login'] );
			$user_email = email_exists( $credentials['user_email'] );
			
			//$user_name_societe = namesociete_exists( $credentials['user_name_societe'] );
			
			if ( ! $user_id && ! $user_email ) {
				if ( $credentials['password'] == $credentials['confirm_password'] ) {
					$user_save_flag = wp_create_user( $credentials['user_login'], $credentials['password'], $credentials['user_email'] , $credentials['name_societe'] );
					
					if ( is_wp_error( $user_save_flag ) ) {
						mkdf_membership_ajax_response( 'error', esc_html__( 'Something went wrong', 'mkdf-membership' ) );
					} else {
						wp_update_user( array( 'ID' => $user_save_flag, 'role' => get_option( 'default_role' ) ) );
						$mail_to = $credentials['user_email'];
						
						$subject = esc_html__( 'User Registration', 'mkdf-membership' ); //Subject
						$message = esc_html__( 'You have registered successfully on ', 'mkdf-membership' ) . esc_url( get_site_url() ); //Message
						wp_mail( $mail_to, $subject, $message );
						mkdf_membership_ajax_response( 'success', esc_html__( 'You have registered successfully, please login with the created credentials', 'mkdf-membership' ) );
						
					}
				} else {
					mkdf_membership_ajax_response( 'error', esc_html__( 'Both passwords must match in order to register', 'mkdf-membership' ) );
				}
			} elseif ( $user_id ) {
				mkdf_membership_ajax_response( 'error', esc_html__( 'Username already exists', 'mkdf-membership' ) );
			} else {
				mkdf_membership_ajax_response( 'error', esc_html__( 'User with that name already exists', 'mkdf-membership' ) );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_nopriv_mkdf_membership_register_user', 'mkdf_membership_register_user' );
}

if ( ! function_exists( 'mkdf_membership_user_lost_password' ) ) {
	/**
	 * Reset user password
	 */
	function mkdf_membership_user_lost_password() {
		
		if ( ! function_exists( 'retrieve_password' ) ) {
			ob_start();
			include_once( ABSPATH . 'wp-login.php' );
			ob_clean();
		}
		
		$result = retrieve_password();
		if ( $result === true ) {
			mkdf_membership_ajax_response( 'success', esc_html__( 'We have sent you an email', 'mkdf-membership' ) );
		} else {
			mkdf_membership_ajax_response( 'error', $result->get_error_message() );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_nopriv_mkdf_membership_user_lost_password', 'mkdf_membership_user_lost_password' );
}