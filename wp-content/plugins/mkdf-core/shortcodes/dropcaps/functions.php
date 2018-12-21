<?php

if ( ! function_exists( 'mkdf_core_add_dropcaps_shortcodes' ) ) {
	function mkdf_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'mkdf_core_filter_add_vc_shortcode', 'mkdf_core_add_dropcaps_shortcodes' );
}