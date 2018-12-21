<?php

if ( ! function_exists( 'staffscout_mikado_include_mobile_header_menu' ) ) {
	function staffscout_mikado_include_mobile_header_menu( $menus ) {
		$menus['mobile-navigation'] = esc_html__( 'Mobile Navigation', 'staffscout' );
		
		return $menus;
	}
	
	add_filter( 'staffscout_mikado_register_headers_menu', 'staffscout_mikado_include_mobile_header_menu' );
}

if ( ! function_exists( 'staffscout_mikado_mobile_header_class' ) ) {
	function staffscout_mikado_mobile_header_class( $classes ) {
		$classes[] = 'mkdf-default-mobile-header';
		
		$classes[] = 'mkdf-sticky-up-mobile-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'staffscout_mikado_mobile_header_class' );
}

if ( ! function_exists( 'staffscout_mikado_get_mobile_header' ) ) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function staffscout_mikado_get_mobile_header( $slug = '', $module = '' ) {
		if ( staffscout_mikado_is_responsive_on() ) {
			$mobile_menu_title = staffscout_mikado_options()->getOptionValue( 'mobile_menu_title' );
			$has_navigation    = has_nav_menu( 'main-navigation' ) || has_nav_menu( 'mobile-navigation' ) ? true : false;
			
			$parameters = array(
				'show_navigation_opener' => $has_navigation,
				'mobile_menu_title'      => $mobile_menu_title
			);
			
			$module = ! empty( $module ) ? $module : 'header/types/mobile-header';
			
			staffscout_mikado_get_module_template_part( 'templates/mobile-header', $module, $slug, $parameters );
		}
	}
	
	add_action( 'staffscout_mikado_after_page_header', 'staffscout_mikado_get_mobile_header' );
}

if ( ! function_exists( 'staffscout_mikado_get_mobile_logo' ) ) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 */
	function staffscout_mikado_get_mobile_logo() {
		$show_logo_image = staffscout_mikado_options()->getOptionValue( 'hide_logo' ) === 'yes' ? false : true;
		
		if ( $show_logo_image ) {
			$mobile_logo_image = staffscout_mikado_get_meta_field_intersect( 'logo_image_mobile', staffscout_mikado_get_page_id() );
			
			//check if mobile logo has been set and use that, else use normal logo
			$logo_image = ! empty( $mobile_logo_image ) ? $mobile_logo_image : staffscout_mikado_get_meta_field_intersect( 'logo_image', staffscout_mikado_get_page_id() );
			
			//get logo image dimensions and set style attribute for image link.
			$logo_dimensions = staffscout_mikado_get_image_dimensions( $logo_image );
			
			$logo_height = '';
			$logo_styles = '';
			if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
				$logo_height = $logo_dimensions['height'];
				$logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px'; //divided with 2 because of retina screens
			}
			
			//set parameters for logo
			$parameters = array(
				'logo_image'      => $logo_image,
				'logo_dimensions' => $logo_dimensions,
				'logo_height'     => $logo_height,
				'logo_styles'     => $logo_styles
			);
			
			staffscout_mikado_get_module_template_part( 'templates/mobile-logo', 'header/types/mobile-header', '', $parameters );
		}
	}
}

if ( ! function_exists( 'staffscout_mikado_register_mobile_header_areas' ) ) {
    /**
     * Registers widget areas for mobile header when it is enabled
     */
    function staffscout_mikado_register_mobile_header_areas() {
        register_sidebar(
            array(
                'id'            => 'mkdf-mobile-area',
                'name'          => esc_html__( 'Mobile Area', 'staffscout' ),
                'description'   => esc_html__( 'Widgets added here will appear in Mobile Area', 'staffscout' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>'
            )
        );
    }

    add_action( 'widgets_init', 'staffscout_mikado_register_mobile_header_areas' );
}

if ( ! function_exists( 'staffscout_mikado_get_mobile_nav' ) ) {
	/**
	 * Loads mobile navigation HTML
	 */
	function staffscout_mikado_get_mobile_nav() {
		staffscout_mikado_get_module_template_part( 'templates/mobile-navigation', 'header/types/mobile-header' );
	}
}

