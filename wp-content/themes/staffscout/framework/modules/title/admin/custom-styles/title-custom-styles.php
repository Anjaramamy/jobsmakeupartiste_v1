<?php

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/custom-styles/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists( 'staffscout_mikado_title_area_typography_style' ) ) {
	function staffscout_mikado_title_area_typography_style() {
		
		// title default/small style
		
		$item_styles = staffscout_mikado_get_typography_styles( 'page_title' );
		
		$item_selector = array(
			'.mkdf-title-holder .mkdf-title-wrapper .mkdf-page-title'
		);
		
		echo staffscout_mikado_dynamic_css( $item_selector, $item_styles );
		
		// subtitle style
		
		$item_styles = staffscout_mikado_get_typography_styles( 'page_subtitle' );
		
		$item_selector = array(
			'.mkdf-title-holder .mkdf-title-wrapper .mkdf-page-subtitle'
		);
		
		echo staffscout_mikado_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'staffscout_mikado_style_dynamic', 'staffscout_mikado_title_area_typography_style' );
}