<?php

if ( ! function_exists( 'staffscout_mikado_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function staffscout_mikado_register_search_opener_widget( $widgets ) {
		$widgets[] = 'StaffScoutMikadoClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'staffscout_mikado_register_widgets', 'staffscout_mikado_register_search_opener_widget' );
}