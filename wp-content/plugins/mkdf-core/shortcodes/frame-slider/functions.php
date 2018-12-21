<?php

if ( ! function_exists( 'mkdf_core_add_frame_slider_shortcodes' ) ) {
	function mkdf_core_add_frame_slider_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\FrameSlider\FrameSlider'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'mkdf_core_filter_add_vc_shortcode', 'mkdf_core_add_frame_slider_shortcodes' );
}

if ( ! function_exists( 'mkdf_core_set_frame_slider_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for frame slider shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function mkdf_core_set_frame_slider_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-frame-slider';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'mkdf_core_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_core_set_frame_slider_icon_class_name_for_vc_shortcodes' );
}