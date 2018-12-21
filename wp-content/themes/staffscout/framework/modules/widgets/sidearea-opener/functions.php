<?php

if ( ! function_exists( 'staffscout_mikado_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function staffscout_mikado_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'StaffScoutMikadoClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'staffscout_mikado_register_widgets', 'staffscout_mikado_register_sidearea_opener_widget' );
}