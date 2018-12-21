<?php
if ( ! function_exists( 'staffscout_mikado_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function staffscout_mikado_register_side_area_sidebar() {
		register_sidebar(
			array(
				'id'            => 'sidearea',
				'name'          => esc_html__( 'Side Area', 'staffscout' ),
				'description'   => esc_html__( 'Side Area', 'staffscout' ),
				'before_widget' => '<div id="%1$s" class="widget mkdf-sidearea %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'staffscout_mikado_register_side_area_sidebar' );
}

if ( ! function_exists( 'staffscout_mikado_side_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different side menu styles
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function staffscout_mikado_side_menu_body_class( $classes ) {
		
		if ( is_active_widget( false, false, 'mkdf_side_area_opener' ) ) {
			
			$classes[] = 'mkdf-side-menu-slide-from-right';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'staffscout_mikado_side_menu_body_class' );
}

if ( ! function_exists( 'staffscout_mikado_get_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function staffscout_mikado_get_side_area() {
		
		if ( is_active_widget( false, false, 'mkdf_side_area_opener' ) ) {
			
			staffscout_mikado_get_module_template_part( 'templates/sidearea', 'sidearea' );
		}
	}
	
	add_action( 'staffscout_mikado_after_body_tag', 'staffscout_mikado_get_side_area', 10 );
}