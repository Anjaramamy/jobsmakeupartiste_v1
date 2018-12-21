<?php

if ( ! function_exists( 'staffscout_mikado_register_raw_html_widget' ) ) {
	/**
	 * Function that register raw html widget
	 */
	function staffscout_mikado_register_raw_html_widget( $widgets ) {
		$widgets[] = 'StaffScoutMikadoClassRawHTMLWidget';
		
		return $widgets;
	}
	
	add_filter( 'staffscout_mikado_register_widgets', 'staffscout_mikado_register_raw_html_widget' );
}