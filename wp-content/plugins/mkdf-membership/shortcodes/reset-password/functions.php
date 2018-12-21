<?php

if ( ! function_exists( 'mkdf_membership_add_reset_password_shortcodes' ) ) {
	function mkdf_membership_add_reset_password_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'MikadofMembership\Shortcodes\MikadofUserResetPassword\MikadofUserResetPassword'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'mkdf_membership_filter_add_vc_shortcode', 'mkdf_membership_add_reset_password_shortcodes' );
}