<?php

if ( ! function_exists( 'staffscout_mikado_side_area_slide_from_right_type_style' ) ) {
	function staffscout_mikado_side_area_slide_from_right_type_style() {
		$width = staffscout_mikado_options()->getOptionValue( 'side_area_width' );
		
		if ( $width !== '' ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-side-menu-slide-from-right .mkdf-side-menu', array(
				'right' => '-' . staffscout_mikado_filter_px( $width ) . 'px',
				'width' => staffscout_mikado_filter_px( $width ) . 'px'
			) );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_side_area_slide_from_right_type_style' );
}

if ( ! function_exists( 'staffscout_mikado_side_area_icon_color_styles' ) ) {
	function staffscout_mikado_side_area_icon_color_styles() {
		$icon_color             = staffscout_mikado_options()->getOptionValue( 'side_area_icon_color' );
		$icon_hover_color       = staffscout_mikado_options()->getOptionValue( 'side_area_icon_hover_color' );
		$close_icon_color       = staffscout_mikado_options()->getOptionValue( 'side_area_close_icon_color' );
		$close_icon_hover_color = staffscout_mikado_options()->getOptionValue( 'side_area_close_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.mkdf-side-menu-button-opener:hover',
			'.mkdf-side-menu-button-opener.opened'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-side-menu-button-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo staffscout_mikado_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color . '!important'
			) );
		}
		
		if ( ! empty( $close_icon_color ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-side-menu a.mkdf-close-side-menu', array(
				'color' => $close_icon_color
			) );
		}
		
		if ( ! empty( $close_icon_hover_color ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-side-menu a.mkdf-close-side-menu:hover', array(
				'color' => $close_icon_hover_color
			) );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_side_area_icon_color_styles' );
}

if ( ! function_exists( 'staffscout_mikado_side_area_styles' ) ) {
	function staffscout_mikado_side_area_styles() {
		$side_area_styles = array();
		$background_color = staffscout_mikado_options()->getOptionValue( 'side_area_background_color' );
		$padding          = staffscout_mikado_options()->getOptionValue( 'side_area_padding' );
		$text_alignment   = staffscout_mikado_options()->getOptionValue( 'side_area_aligment' );
		
		if ( ! empty( $background_color ) ) {
			$side_area_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $padding ) ) {
			$side_area_styles['padding'] = esc_attr( $padding );
		}
		
		if ( ! empty( $text_alignment ) ) {
			$side_area_styles['text-align'] = $text_alignment;
		}
		
		if ( ! empty( $side_area_styles ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-side-menu', $side_area_styles );
		}
		
		if ( $text_alignment === 'center' ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-side-menu .widget img', array(
				'margin' => '0 auto'
			) );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_side_area_styles' );
}