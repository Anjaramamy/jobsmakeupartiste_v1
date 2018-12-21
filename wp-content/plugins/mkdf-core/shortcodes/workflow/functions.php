<?php


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_mkdf_Workflow extends WPBakeryShortCodesContainer {}
}

if(!function_exists('mkdf_core_add_workflow_shortcodes')) {
	function mkdf_core_add_workflow_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\Workflow\WorkflowHolder',
			'MikadoCore\CPT\Shortcodes\Workflow\WorkflowItem'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('mkdf_core_filter_add_vc_shortcode', 'mkdf_core_add_workflow_shortcodes');
}

if( !function_exists('mkdf_core_set_workflow_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for video button shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function mkdf_core_set_workflow_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-workflow-item';
		$shortcodes_icon_class_array[] = '.icon-wpb-workflow-holder';

		return $shortcodes_icon_class_array;
	}
	
	add_filter('mkdf_core_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_core_set_workflow_icon_class_name_for_vc_shortcodes');
}