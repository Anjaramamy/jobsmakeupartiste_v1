<?php

if ( ! function_exists( 'staffscout_mikado_register_widgets' ) ) {
	function staffscout_mikado_register_widgets() {
		$widgets = apply_filters( 'staffscout_mikado_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'staffscout_mikado_register_widgets' );
}