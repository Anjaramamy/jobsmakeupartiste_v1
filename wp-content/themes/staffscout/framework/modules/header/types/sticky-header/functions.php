<?php

if ( ! function_exists( 'staffscout_mikado_sticky_header_global_js_var' ) ) {
	function staffscout_mikado_sticky_header_global_js_var( $global_variables ) {
		$global_variables['mkdfStickyHeaderHeight']             = staffscout_mikado_get_sticky_header_height();
		$global_variables['mkdfStickyHeaderTransparencyHeight'] = staffscout_mikado_get_sticky_header_height_of_complete_transparency();
		
		return $global_variables;
	}
	
	add_filter( 'staffscout_mikado_js_global_variables', 'staffscout_mikado_sticky_header_global_js_var' );
}

if ( ! function_exists( 'staffscout_mikado_sticky_header_per_page_js_var' ) ) {
	function staffscout_mikado_sticky_header_per_page_js_var( $perPageVars ) {
		$perPageVars['mkdfStickyScrollAmount'] = staffscout_mikado_get_sticky_scroll_amount();
		
		return $perPageVars;
	}
	
	add_filter( 'staffscout_mikado_per_page_js_vars', 'staffscout_mikado_sticky_header_per_page_js_var' );
}

if ( ! function_exists( 'staffscout_mikado_register_sticky_header_areas' ) ) {
	/**
	 * Registers widget area for sticky header
	 */
	function staffscout_mikado_register_sticky_header_areas() {
		register_sidebar(
			array(
				'id'            => 'mkdf-sticky-right',
				'name'          => esc_html__( 'Sticky Header Widget Area', 'staffscout' ),
				'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the sticky menu', 'staffscout' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-sticky-right">',
				'after_widget'  => '</div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'staffscout_mikado_register_sticky_header_areas' );
}

if ( ! function_exists( 'staffscout_mikado_get_sticky_menu' ) ) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function staffscout_mikado_get_sticky_menu( $additional_class = 'mkdf-default-nav' ) {
		staffscout_mikado_get_module_template_part( 'templates/sticky-navigation', 'header/types/sticky-header', '', array( 'additional_class' => $additional_class ) );
	}
}

if ( ! function_exists( 'staffscout_mikado_get_sticky_header' ) ) {
	/**
	 * Loads sticky header behavior HTML
	 */
	function staffscout_mikado_get_sticky_header( $slug = '', $module = '' ) {
		$parameters = array(
			'hide_logo'             => staffscout_mikado_options()->getOptionValue( 'hide_logo' ) == 'yes' ? true : false,
			'sticky_header_in_grid' => staffscout_mikado_options()->getOptionValue( 'sticky_header_in_grid' ) == 'yes' ? true : false
		);
		
		$module = ! empty( $module ) ? $module : 'header/types/sticky-header';
		
		staffscout_mikado_get_module_template_part( 'templates/sticky-header', $module, $slug, $parameters );
	}
}

if ( ! function_exists( 'staffscout_mikado_get_sticky_header_height' ) ) {
	/**
	 * Returns top sticky header height
	 *
	 * @return bool|int|void
	 */
	function staffscout_mikado_get_sticky_header_height() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'staffscout_mikado_allow_sticky_header_behavior', $allow_sticky_behavior );
		$header_behaviour      = staffscout_mikado_get_meta_field_intersect( 'header_behaviour' );
		
		//sticky menu height, needed only for sticky header on scroll up
		if ( $allow_sticky_behavior && in_array( $header_behaviour, array( 'sticky-header-on-scroll-up' ) ) ) {
			$sticky_header_height = staffscout_mikado_filter_px( staffscout_mikado_options()->getOptionValue( 'sticky_header_height' ) );
			
			return $sticky_header_height !== '' ? intval( $sticky_header_height ) : 70;
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'staffscout_mikado_get_sticky_header_height_of_complete_transparency' ) ) {
	/**
	 * Returns top sticky header height it is fully transparent. used in anchor logic
	 *
	 * @return bool|int|void
	 */
	function staffscout_mikado_get_sticky_header_height_of_complete_transparency() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'staffscout_mikado_allow_sticky_header_behavior', $allow_sticky_behavior );
		
		if ( $allow_sticky_behavior ) {
			$stickyHeaderTransparent = staffscout_mikado_options()->getOptionValue( 'sticky_header_background_color' ) !== '' && staffscout_mikado_options()->getOptionValue( 'sticky_header_transparency' ) === '0';
			
			if ( $stickyHeaderTransparent ) {
				return 0;
			} else {
				$sticky_header_height = staffscout_mikado_filter_px( staffscout_mikado_options()->getOptionValue( 'sticky_header_height' ) );
				
				return $sticky_header_height !== '' ? intval( $sticky_header_height ) : 70;
			}
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'staffscout_mikado_get_sticky_scroll_amount' ) ) {
	/**
	 * Returns top sticky scroll amount
	 *
	 * @return bool|int|void
	 */
	function staffscout_mikado_get_sticky_scroll_amount() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'staffscout_mikado_allow_sticky_header_behavior', $allow_sticky_behavior );
		$header_behaviour      = staffscout_mikado_get_meta_field_intersect( 'header_behaviour' );
		
		//sticky menu scroll amount
		if ( $allow_sticky_behavior && in_array( $header_behaviour, array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' ) ) ) {
			$sticky_scroll_amount = staffscout_mikado_filter_px( staffscout_mikado_get_meta_field_intersect( 'scroll_amount_for_sticky' ) );
			
			return $sticky_scroll_amount !== '' ? intval( $sticky_scroll_amount ) : 0;
		} else {
			return 0;
		}
	}
}