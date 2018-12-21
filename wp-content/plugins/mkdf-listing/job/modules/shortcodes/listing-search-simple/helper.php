<?php
use MikadoListing\Lib\Shortcodes;
if(!function_exists('mkdf_listing_job_search_simple_shortcode_helper')) {
	function mkdf_listing_job_shortcodes_search_simple_helper($shortcodes_class_name) {

		$shortcodes = array(
			'MikadoListing\Lib\Shortcodes\ListingSearchSimple'
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	add_filter('mkdf_listing_job_filter_add_vc_shortcode', 'mkdf_listing_job_shortcodes_search_simple_helper');
}

if(!function_exists('mkdf_listing_job_main_search_class_instance')){

	function mkdf_listing_job_main_search_simple_class_instance(){
		return Shortcodes\ListingSearchSimple::getInstance();
	}

}

if( !function_exists('mkdf_listing_job_set_ls_search_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for button shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function mkdf_listing_job_set_ls_search_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-ls-search';

		return $shortcodes_icon_class_array;
	}

	add_filter('mkdf_core_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_listing_job_set_ls_search_icon_class_name_for_vc_shortcodes');
}