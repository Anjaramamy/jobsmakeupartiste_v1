<?php

namespace MikadofMembership\Shortcodes\MikadofUserLogin;

use MikadofMembership\Lib\ShortcodeInterface;

class MikadofUserLogin implements ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_user_login';
		
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
		
		$html = mkdf_membership_get_shortcode_template_part( 'login', 'login-template', '', $params );
		
		return $html;
	}
}