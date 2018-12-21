<?php

if ( ! function_exists( 'staffscout_mikado_register_sidebars' ) ) {
	/**
	 * Function that registers theme's sidebars
	 */
	function staffscout_mikado_register_sidebars() {
		
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar', 'staffscout' ),
				'description'   => esc_html__( 'Default Sidebar', 'staffscout' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="mkdf-widget-title-holder"><h4 class="mkdf-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'staffscout_mikado_register_sidebars', 1 );
}

if ( ! function_exists( 'staffscout_mikado_add_support_custom_sidebar' ) ) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates StaffScoutMikadoClassSidebar object
	 */
	function staffscout_mikado_add_support_custom_sidebar() {
		add_theme_support( 'StaffScoutMikadoClassSidebar' );
		
		if ( get_theme_support( 'StaffScoutMikadoClassSidebar' ) ) {
			new StaffScoutMikadoClassSidebar();
		}
	}
	
	add_action( 'after_setup_theme', 'staffscout_mikado_add_support_custom_sidebar' );
}