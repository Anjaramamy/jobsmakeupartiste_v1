<?php

if ( ! function_exists( 'staffscout_mikado_breadcrumbs_title_area_typography_style' ) ) {
	function staffscout_mikado_breadcrumbs_title_area_typography_style() {
		
		$item_styles = staffscout_mikado_get_typography_styles( 'page_breadcrumb' );
		
		$item_selector = array(
			'.mkdf-title-holder .mkdf-title-wrapper .mkdf-breadcrumbs'
		);
		
		echo staffscout_mikado_dynamic_css( $item_selector, $item_styles );
		
		
		$breadcrumb_hover_color = staffscout_mikado_options()->getOptionValue( 'page_breadcrumb_hovercolor' );
		
		$breadcrumb_hover_styles = array();
		if ( ! empty( $breadcrumb_hover_color ) ) {
			$breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
		}
		
		$breadcrumb_hover_selector = array(
			'.mkdf-title-holder .mkdf-title-wrapper .mkdf-breadcrumbs a:hover'
		);
		
		echo staffscout_mikado_dynamic_css( $breadcrumb_hover_selector, $breadcrumb_hover_styles );
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_breadcrumbs_title_area_typography_style' );
}