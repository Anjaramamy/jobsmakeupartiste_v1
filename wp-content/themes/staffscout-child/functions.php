<?php

/*** Child Theme Function  ***/

function staffscout_mikado_child_theme_enqueue_scripts() {
	
	$parent_style = 'staffscout_mikado_default_style';
	
	wp_enqueue_style('staffscout_mikado_child_style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
}

add_action( 'wp_enqueue_scripts', 'staffscout_mikado_child_theme_enqueue_scripts' );

function notux_widgets_init() {	
	// Mon widget sur mesure
		register_sidebar( array(
			'name'			=> __( 'Sidebar pub', '' ),
			'id'			=> 'zone-widgets-1',
			'description'	=> __( 'Description de la zone de widgets.', '' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<div class="widget-title th3">',
			'after_title'	=> '</div>',
		) );
}
add_action( 'widgets_init', 'notux_widgets_init' );

function sideBarBas() {	
	// Mon widget sur mesure
		register_sidebar( array(
			'name'			=> __( 'Sidebar pub', '' ),
			'id'			=> 'zone-widgets-2',
			'description'	=> __( 'Description de la zone de widgets.', '' ),
			'before_widget'	=> '<div class="widget wdgBasFooter">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<div class="widget-title th3">',
			'after_title'	=> '</div>',
		) );
}
add_action( 'widgets_init', 'sideBarBas' );



function twentyfifteen_scripts() {
	wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/generale.js', array( 'jquery' ), '20141010' );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );