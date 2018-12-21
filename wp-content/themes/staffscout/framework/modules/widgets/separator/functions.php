<?php

if ( ! function_exists( 'staffscout_mikado_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function staffscout_mikado_register_separator_widget( $widgets ) {
		$widgets[] = 'StaffScoutMikadoClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'staffscout_mikado_register_widgets', 'staffscout_mikado_register_separator_widget' );
}