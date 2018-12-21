<?php

if ( ! function_exists( 'staffscout_mikado_header_minimal_full_screen_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function staffscout_mikado_header_minimal_full_screen_menu_body_class( $classes ) {
		$classes[] = 'mkdf-' . staffscout_mikado_options()->getOptionValue( 'fullscreen_menu_animation_style' );
		
		return $classes;
	}
	
	if ( staffscout_mikado_check_is_header_type_enabled( 'header-minimal', staffscout_mikado_get_page_id() ) ) {
		add_filter( 'body_class', 'staffscout_mikado_header_minimal_full_screen_menu_body_class' );
	}
}

if ( ! function_exists( 'staffscout_mikado_get_header_minimal_full_screen_menu' ) ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function staffscout_mikado_get_header_minimal_full_screen_menu() {
		$parameters = array(
			'fullscreen_menu_in_grid' => staffscout_mikado_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ? true : false
		);
		
		staffscout_mikado_get_module_template_part( 'templates/full-screen-menu', 'header/types/header-minimal', '', $parameters );
	}
	
	if ( staffscout_mikado_check_is_header_type_enabled( 'header-minimal', staffscout_mikado_get_page_id() ) ) {
		add_action( 'staffscout_mikado_after_header_area', 'staffscout_mikado_get_header_minimal_full_screen_menu', 10 );
	}
}