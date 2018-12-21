<?php

if ( ! function_exists( 'staffscout_mikado_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function staffscout_mikado_register_custom_font_widget( $widgets ) {
		$widgets[] = 'StaffScoutMikadoClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'staffscout_mikado_register_widgets', 'staffscout_mikado_register_custom_font_widget' );
}