<?php

if ( ! function_exists( 'staffscout_mikado_fullscreen_menu_general_styles' ) ) {
	function staffscout_mikado_fullscreen_menu_general_styles() {
		$text_alignment          = staffscout_mikado_options()->getOptionValue( 'fullscreen_alignment' );
		$text_alignment_selector = array(
			'nav.mkdf-fullscreen-menu ul li',
			'.mkdf-fullscreen-above-menu-widget-holder',
			'.mkdf-fullscreen-below-menu-widget-holder'
		);
		
		if ( ! empty( $text_alignment ) ) {
			echo staffscout_mikado_dynamic_css( $text_alignment_selector, array(
				'text-align' => $text_alignment
			) );
		}
		
		$background_color         = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_background_color' );
		$background_transparency  = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_background_transparency' );
		$background_image         = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_background_image' );
		$background_pattern_image = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_pattern_image' );
		
		$fullscreen_background_color        = ! empty( $background_color ) ? staffscout_mikado_hex2rgb( $background_color ) : '';
		$fullscreen_background_transparency = $background_transparency !== '' ? $background_transparency : 0.9;
		
		if ( ! empty( $fullscreen_background_color ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-fullscreen-menu-holder', array(
				'background-color' => 'rgba(' . $fullscreen_background_color[0] . ',' . $fullscreen_background_color[1] . ',' . $fullscreen_background_color[2] . ',' . $fullscreen_background_transparency . ')'
			) );
		}
		
		if ( ! empty( $background_image ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-fullscreen-menu-holder', array(
				'background-image'    => 'url(' . esc_url( $background_image ) . ')',
				'background-position' => 'center 0',
				'background-repeat'   => 'no-repeat'
			) );
		}
		
		if ( ! empty( $background_pattern_image ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-fullscreen-menu-holder', array(
				'background-image'    => 'url(' . esc_url( $background_pattern_image ) . ')',
				'background-repeat'   => 'repeat',
				'background-position' => '0 0'
			) );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_fullscreen_menu_general_styles' );
}

if ( ! function_exists( 'staffscout_mikado_fullscreen_menu_first_level_style' ) ) {
	function staffscout_mikado_fullscreen_menu_first_level_style() {
		$first_menu_style = staffscout_mikado_get_typography_styles( 'fullscreen_menu' );
		
		$first_menu_selector = array(
			'nav.mkdf-fullscreen-menu > ul > li > a'
		);
		
		echo staffscout_mikado_dynamic_css( $first_menu_selector, $first_menu_style );
		
		
		$first_menu_hover_style = array();
		
		if ( staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_hover_color' ) !== '' ) {
			$first_menu_hover_style['color'] = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_hover_color' );
		}
		
		if ( ! empty( $first_menu_hover_style ) ) {
			echo staffscout_mikado_dynamic_css( 'nav.mkdf-fullscreen-menu > ul > li > a:hover', $first_menu_hover_style );
		}
		
		$first_menu_active_style = array();
		
		if ( staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_active_color' ) !== '' ) {
			$first_menu_active_style['color'] = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_active_color' );
		}
		
		if ( ! empty( $first_menu_active_style ) ) {
			echo staffscout_mikado_dynamic_css( 'nav.mkdf-fullscreen-menu > ul > li.mkdf-active-item > a', $first_menu_active_style );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_fullscreen_menu_first_level_style' );
}

if ( ! function_exists( 'staffscout_mikado_fullscreen_menu_second_level_style' ) ) {
	function staffscout_mikado_fullscreen_menu_second_level_style() {
		$second_menu_style = staffscout_mikado_get_typography_styles( 'fullscreen_menu', '_2nd' );
		
		$second_menu_selector = array(
			'nav.mkdf-fullscreen-menu ul li ul li a'
		);
		
		echo staffscout_mikado_dynamic_css( $second_menu_selector, $second_menu_style );
		
		
		$second_menu_hover_style = array();
		
		if ( staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_hover_color_2nd' ) !== '' ) {
			$second_menu_hover_style['color'] = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_hover_color_2nd' );
		}
		
		if ( ! empty( $second_menu_hover_style ) ) {
			echo staffscout_mikado_dynamic_css( 'nav.mkdf-fullscreen-menu ul li ul li a:hover, nav.mkdf-fullscreen-menu ul li ul li.current-menu-ancestor > a, nav.mkdf-fullscreen-menu ul li ul li.current-menu-item > a', $second_menu_hover_style );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_fullscreen_menu_second_level_style' );
}

if ( ! function_exists( 'staffscout_mikado_fullscreen_menu_third_level_style' ) ) {
	function staffscout_mikado_fullscreen_menu_third_level_style() {
		$third_menu_style = staffscout_mikado_get_typography_styles( 'fullscreen_menu', '_3rd' );
		
		$third_menu_selector = array(
			'nav.mkdf-fullscreen-menu ul li ul li ul li a'
		);
		
		echo staffscout_mikado_dynamic_css( $third_menu_selector, $third_menu_style );
		
		
		$third_menu_hover_style = array();
		
		if ( staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_hover_color_3rd' ) !== '' ) {
			$third_menu_hover_style['color'] = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_hover_color_3rd' );
		}
		
		if ( ! empty( $third_menu_hover_style ) ) {
			echo staffscout_mikado_dynamic_css( 'nav.mkdf-fullscreen-menu ul li ul li ul li a:hover, nav.mkdf-fullscreen-menu ul li ul li ul li.current-menu-ancestor > a, nav.mkdf-fullscreen-menu ul li ul li ul li.current-menu-item > a', $third_menu_hover_style );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_fullscreen_menu_third_level_style' );
}

if ( ! function_exists( 'staffscout_mikado_fullscreen_menu_icon_styles' ) ) {
	function staffscout_mikado_fullscreen_menu_icon_styles() {
		$icon_color       = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_icon_color' );
		$icon_hover_color = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.mkdf-fullscreen-menu-opener:hover',
			'.mkdf-fullscreen-menu-opener.mkdf-fm-opened'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-fullscreen-menu-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo staffscout_mikado_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color . '!important'
			) );
		}
		
		$mobile_icon_color       = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_icon_mobile_color' );
		$mobile_icon_hover_color = staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_icon_mobile_hover_color' );
		
		$mobile_icon_hover_selector = array(
			'.edgtf-mobile-header .edgtf-fullscreen-menu-opener:hover',
			'.edgtf-mobile-header .edgtf-fullscreen-menu-opener.edgtf-fm-opened'
		);
		
		if ( ! empty( $mobile_icon_color ) ) {
			echo staffscout_mikado_dynamic_css( '.edgtf-mobile-header .edgtf-fullscreen-menu-opener', array(
				'color' => $mobile_icon_color
			) );
		}
		
		if ( ! empty( $mobile_icon_hover_color ) ) {
			echo staffscout_mikado_dynamic_css( $mobile_icon_hover_selector, array(
				'color' => $mobile_icon_hover_color . '!important'
			) );
		}
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_fullscreen_menu_icon_styles' );
}