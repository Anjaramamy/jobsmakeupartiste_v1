<?php

if ( ! function_exists( 'staffscout_mikado_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function staffscout_mikado_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'staffscout' );
		
		return $type;
	}
	
	add_filter( 'staffscout_mikado_title_type_global_option', 'staffscout_mikado_set_title_centered_type_for_options' );
	add_filter( 'staffscout_mikado_title_type_meta_boxes', 'staffscout_mikado_set_title_centered_type_for_options' );
}