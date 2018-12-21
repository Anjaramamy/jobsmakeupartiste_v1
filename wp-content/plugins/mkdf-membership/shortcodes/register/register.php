<?php

namespace MikadofMembership\Shortcodes\MikadofUserRegister;

use MikadofMembership\Lib\ShortcodeInterface;

class MikadofUserRegister implements ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_user_register';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {}
	
	public function render( $atts, $content = null ) {
		$args   = array();
		$params = shortcode_atts( $args, $atts );
		extract( $params );
		
		$html = '';
		
		if ( ! is_user_logged_in() ) {
			if ( get_option( 'users_can_register' ) ) {
				$html .= mkdf_membership_get_shortcode_template_part( 'register', 'register-template', '', $params );
			} else {
				$message = esc_html__( "You don't have permission to register", 'mkdf-membership' );
				$html    .= mkdf_membership_get_shortcode_template_part( 'register', 'register-message', '', array( 'message' => $message ) );
			}
		} else {
			$message = esc_html__( 'You are already logged in', 'mkdf-membership' );
			$html    .= mkdf_membership_get_shortcode_template_part( 'register', 'register-message', '', array( 'message' => $message ) );
		}
		
		return $html;
	}
}