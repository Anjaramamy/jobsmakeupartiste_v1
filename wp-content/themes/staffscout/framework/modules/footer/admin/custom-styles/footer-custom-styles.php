<?php

if ( ! function_exists( 'staffscout_mikado_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function staffscout_mikado_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = staffscout_mikado_options()->getOptionValue( 'footer_top_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo staffscout_mikado_dynamic_css( '.mkdf-page-footer .mkdf-footer-top-holder', $item_styles );
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_footer_top_general_styles' );
}

if ( ! function_exists( 'staffscout_mikado_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function staffscout_mikado_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = staffscout_mikado_options()->getOptionValue( 'footer_bottom_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo staffscout_mikado_dynamic_css( '.mkdf-page-footer .mkdf-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_footer_bottom_general_styles' );
}