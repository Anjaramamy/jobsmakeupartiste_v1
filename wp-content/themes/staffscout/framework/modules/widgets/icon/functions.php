<?php

if ( ! function_exists( 'staffscout_mikado_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function staffscout_mikado_register_icon_widget( $widgets ) {
		$widgets[] = 'StaffScoutMikadoClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'staffscout_mikado_register_widgets', 'staffscout_mikado_register_icon_widget' );
}