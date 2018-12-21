<?php

if ( ! function_exists( 'staffscout_mikado_search_opener_icon_size' ) ) {
	function staffscout_mikado_search_opener_icon_size() {
		$icon_size = staffscout_mikado_options()->getOptionValue( 'header_search_icon_size' );
		
		if ( ! empty( $icon_size ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-search-opener', array(
				'font-size' => staffscout_mikado_filter_px( $icon_size ) . 'px'
			) );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_search_opener_icon_size' );
}

if ( ! function_exists( 'staffscout_mikado_search_opener_icon_colors' ) ) {
	function staffscout_mikado_search_opener_icon_colors() {
		$icon_color       = staffscout_mikado_options()->getOptionValue( 'header_search_icon_color' );
		$icon_hover_color = staffscout_mikado_options()->getOptionValue( 'header_search_icon_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-search-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-search-opener:hover', array(
				'color' => $icon_hover_color
			) );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_search_opener_icon_colors' );
}

if ( ! function_exists( 'staffscout_mikado_search_opener_text_styles' ) ) {
	function staffscout_mikado_search_opener_text_styles() {
		$item_styles = staffscout_mikado_get_typography_styles( 'search_icon_text' );
		
		$item_selector = array(
			'.mkdf-search-icon-text'
		);
		
		echo staffscout_mikado_dynamic_css( $item_selector, $item_styles );
		
		$text_hover_color = staffscout_mikado_options()->getOptionValue( 'search_icon_text_color_hover' );
		
		if ( ! empty( $text_hover_color ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-search-opener:hover .mkdf-search-icon-text', array(
				'color' => $text_hover_color
			) );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_search_opener_text_styles' );
}