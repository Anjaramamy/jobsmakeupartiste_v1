<?php

if ( ! function_exists( 'staffscout_mikado_header_top_bar_styles' ) ) {
	/**
	 * Generates styles for header top bar
	 */
	function staffscout_mikado_header_top_bar_styles() {
		$top_header_height = staffscout_mikado_options()->getOptionValue( 'top_bar_height' );
		
		if ( ! empty( $top_header_height ) ) {
			echo staffscout_mikado_dynamic_css( '.mkdf-top-bar', array( 'height' => staffscout_mikado_filter_px( $top_header_height ) . 'px' ) );
			echo staffscout_mikado_dynamic_css( '.mkdf-top-bar .mkdf-logo-wrapper a', array( 'max-height' => staffscout_mikado_filter_px( $top_header_height ) . 'px' ) );
		}
		
		echo staffscout_mikado_dynamic_css( '.mkdf-top-bar-background', array( 'height' => staffscout_mikado_get_top_bar_background_height() . 'px' ) );
		
		if ( staffscout_mikado_options()->getOptionValue( 'top_bar_in_grid' ) == 'yes' ) {
			$top_bar_grid_selector                = '.mkdf-top-bar .mkdf-grid .mkdf-vertical-align-containers';
			$top_bar_grid_styles                  = array();
			$top_bar_grid_background_color        = staffscout_mikado_options()->getOptionValue( 'top_bar_grid_background_color' );
			$top_bar_grid_background_transparency = staffscout_mikado_options()->getOptionValue( 'top_bar_grid_background_transparency' );
			
			if ( !empty($top_bar_grid_background_color) ) {
				$grid_background_color        = $top_bar_grid_background_color;
				$grid_background_transparency = 1;
				
				if ( $top_bar_grid_background_transparency !== '' ) {
					$grid_background_transparency = $top_bar_grid_background_transparency;
				}
				
				$grid_background_color                   = staffscout_mikado_rgba_color( $grid_background_color, $grid_background_transparency );
				$top_bar_grid_styles['background-color'] = $grid_background_color;
			}
			
			echo staffscout_mikado_dynamic_css( $top_bar_grid_selector, $top_bar_grid_styles );
		}
		
		$top_bar_styles   = array();
		$background_color = staffscout_mikado_options()->getOptionValue( 'top_bar_background_color' );
		$border_color     = staffscout_mikado_options()->getOptionValue( 'top_bar_border_color' );
		
		if ( $background_color !== '' ) {
			$background_transparency = 1;
			if ( staffscout_mikado_options()->getOptionValue( 'top_bar_background_transparency' ) !== '' ) {
				$background_transparency = staffscout_mikado_options()->getOptionValue( 'top_bar_background_transparency' );
			}
			
			$background_color                   = staffscout_mikado_rgba_color( $background_color, $background_transparency );
			$top_bar_styles['background-color'] = $background_color;
			
			echo staffscout_mikado_dynamic_css( '.mkdf-top-bar-background', array( 'background-color' => $background_color ) );
		}
		
		if ( staffscout_mikado_options()->getOptionValue( 'top_bar_border' ) == 'yes' && $border_color != '' ) {
			$top_bar_styles['border-bottom'] = '1px solid ' . $border_color;
		}
		
		echo staffscout_mikado_dynamic_css( '.mkdf-top-bar', $top_bar_styles );
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_header_top_bar_styles' );
}