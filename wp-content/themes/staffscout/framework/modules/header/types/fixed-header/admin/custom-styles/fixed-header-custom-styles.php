<?php

if ( ! function_exists( 'staffscout_mikado_fixed_header_styles' ) ) {
	/**
	 * Generates styles for fixed haeder
	 */
	function staffscout_mikado_fixed_header_styles() {
		$background_color        = staffscout_mikado_options()->getOptionValue( 'fixed_header_background_color' );
		$background_transparency = staffscout_mikado_options()->getOptionValue( 'fixed_header_transparency' );
		$border_color            = staffscout_mikado_options()->getOptionValue( 'fixed_header_border_bottom_color' );
		
		$fixed_area_styles = array();
		if ( ! empty( $background_color ) ) {
			$fixed_header_background_color              = $background_color;
			$fixed_header_background_color_transparency = 1;
			
			if ( $background_transparency !== '' ) {
				$fixed_header_background_color_transparency = $background_transparency;
			}
			
			$fixed_area_styles['background-color'] = staffscout_mikado_rgba_color( $fixed_header_background_color, $fixed_header_background_color_transparency ) . '!important';
		}
		
		if ( empty( $background_color ) && $background_transparency !== '' ) {
			$fixed_header_background_color              = '#fff';
			$fixed_header_background_color_transparency = $background_transparency;
			
			$fixed_area_styles['background-color'] = staffscout_mikado_rgba_color( $fixed_header_background_color, $fixed_header_background_color_transparency ) . '!important';
		}
		
		$selector = array(
			'.mkdf-page-header .mkdf-fixed-wrapper.fixed .mkdf-menu-area'
		);
		
		echo staffscout_mikado_dynamic_css( $selector, $fixed_area_styles );
		
		$fixed_area_holder_styles = array();
		
		if ( ! empty( $border_color ) ) {
			$fixed_area_holder_styles['border-bottom-color'] = $border_color;
		}
		
		$selector_holder = array(
			'.mkdf-page-header .mkdf-fixed-wrapper.fixed'
		);
		
		echo staffscout_mikado_dynamic_css( $selector_holder, $fixed_area_holder_styles );
		
		// fixed menu style
		
		$menu_item_styles = staffscout_mikado_get_typography_styles( 'fixed' );
		
		$menu_item_selector = array(
			'.mkdf-fixed-wrapper.fixed .mkdf-main-menu > ul > li > a'
		);
		
		echo staffscout_mikado_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		
		$hover_color = staffscout_mikado_options()->getOptionValue( 'fixed_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.mkdf-fixed-wrapper.fixed .mkdf-main-menu > ul > li:hover > a',
			'.mkdf-fixed-wrapper.fixed .mkdf-main-menu > ul > li.mkdf-active-item > a'
		);
		
		echo staffscout_mikado_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_fixed_header_styles' );
}