<?php

if ( ! function_exists( 'staffscout_mikado_get_hide_dep_for_header_standard_options' ) ) {
	function staffscout_mikado_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'staffscout_mikado_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'staffscout_mikado_header_standard_map' ) ) {
	function staffscout_mikado_header_standard_map( $parent ) {
		$hide_dep_options = staffscout_mikado_get_hide_dep_for_header_standard_options();
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'staffscout' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'staffscout' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'staffscout' ),
					'left'   => esc_html__( 'Left', 'staffscout' ),
					'center' => esc_html__( 'Center', 'staffscout' )
				),
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options
			)
		);
	}
	
	add_action( 'staffscout_mikado_additional_header_menu_area_options_map', 'staffscout_mikado_header_standard_map' );
}