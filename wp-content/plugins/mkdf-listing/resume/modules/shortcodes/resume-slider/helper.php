<?php
use MikadoResume\Lib\Shortcodes;
if(!function_exists('mkdf_listing_resume_slider_shortcode_helper')) {
	function mkdf_listing_resume_slider_shortcode_helper($shortcodes_class_name) {

		$shortcodes = array(
			'MikadoResume\Lib\Shortcodes\ResumeSlider'
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	add_filter('mkdf_listing_resume_filter_add_vc_shortcode', 'mkdf_listing_resume_slider_shortcode_helper');
}

if(!function_exists('mkdf_listing_resume_slider_class_instance')){

	function mkdf_listing_resume_slider_class_instance(){
		return Shortcodes\ResumeSlider::getInstance();
	}

}

if( !function_exists('mkdf_listing_resume_set_ls_slider_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for button shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function mkdf_listing_resume_set_ls_slider_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-rs-slider';

		return $shortcodes_icon_class_array;
	}

	add_filter('mkdf_core_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_listing_resume_set_ls_slider_icon_class_name_for_vc_shortcodes');
}