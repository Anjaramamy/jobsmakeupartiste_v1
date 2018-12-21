<?php

if ( ! function_exists( 'mkdf_core_enqueue_scripts_for_custom_font_shortcodes' ) ) {
	/**
	 * Function that includes all necessary 3rd party scripts for this shortcode
	 */
	function mkdf_core_enqueue_scripts_for_custom_font_shortcodes() {
		wp_enqueue_script( 'typed', MIKADO_CORE_SHORTCODES_URL_PATH . '/custom-font/assets/js/plugins/typed.js', array( 'jquery' ), false, true );
	}
	
	add_action( 'staffscout_mikado_enqueue_third_party_scripts', 'mkdf_core_enqueue_scripts_for_custom_font_shortcodes' );
}

if ( ! function_exists( 'mkdf_core_add_custom_font' ) ) {
	function mkdf_core_add_custom_font( $shortcodes_class_name ) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\CustomFont\CustomFont'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'mkdf_core_filter_add_vc_shortcode', 'mkdf_core_add_custom_font' );
}

if ( ! function_exists( 'mkdf_core_set_custom_font_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for counter shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function mkdf_core_set_custom_font_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-custom-font';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'mkdf_core_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_core_set_custom_font_icon_class_name_for_vc_shortcodes' );
}