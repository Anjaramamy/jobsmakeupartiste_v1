<?php
use MikadoListing\Lib\Shortcodes;
if(!function_exists('mkdf_listing_job_types_shortcode_helper')) {
	function mkdf_listing_job_types_shortcode_helper($shortcodes_class_name) {

		$shortcodes = array(
			'MikadoListing\Lib\Shortcodes\ListingTypes'
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	add_filter('mkdf_listing_job_filter_add_vc_shortcode', 'mkdf_listing_job_types_shortcode_helper');
}

if(!function_exists('mkdf_listing_job_types_class_instance')){

	function mkdf_listing_job_types_class_instance(){
		return Shortcodes\ListingTypes::getInstance();
	}

}

if( !function_exists('mkdf_listing_job_set_ls_types_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for button shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function mkdf_listing_job_set_ls_types_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-ls-types';

		return $shortcodes_icon_class_array;
	}

	add_filter('mkdf_core_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_listing_job_set_ls_types_icon_class_name_for_vc_shortcodes');
}