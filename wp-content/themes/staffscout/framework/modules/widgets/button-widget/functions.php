<?php

if ( ! function_exists( 'staffscout_mikado_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function staffscout_mikado_register_button_widget( $widgets ) {
		$widgets[] = 'StaffScoutMikadoClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'staffscout_mikado_register_widgets', 'staffscout_mikado_register_button_widget' );
}