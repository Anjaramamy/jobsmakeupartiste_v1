<?php

if ( ! function_exists( 'staffscout_mikado_add_product_list_carousel_shortcode' ) ) {
	function staffscout_mikado_add_product_list_carousel_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'MikadoCore\CPT\Shortcodes\ProductListCarousel\ProductListCarousel',
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	if ( staffscout_mikado_core_plugin_installed() ) {
		add_filter( 'mkdf_core_filter_add_vc_shortcode', 'staffscout_mikado_add_product_list_carousel_shortcode' );
	}
}

if ( ! function_exists( 'staffscout_mikado_add_product_list_carousel_into_shortcodes_list' ) ) {
	function staffscout_mikado_add_product_list_carousel_into_shortcodes_list( $woocommerce_shortcodes ) {
		$woocommerce_shortcodes[] = 'mkdf_product_list_carousel';
		
		return $woocommerce_shortcodes;
	}
	
	add_filter( 'staffscout_mikado_woocommerce_shortcodes_list', 'staffscout_mikado_add_product_list_carousel_into_shortcodes_list' );
}