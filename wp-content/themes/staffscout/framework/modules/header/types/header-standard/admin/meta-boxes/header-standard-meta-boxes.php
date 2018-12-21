<?php

if ( ! function_exists( 'staffscout_mikado_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function staffscout_mikado_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'staffscout_mikado_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'staffscout_mikado_header_standard_meta_map' ) ) {
	function staffscout_mikado_header_standard_meta_map( $parent ) {
		$hide_dep_options = staffscout_mikado_get_hide_dep_for_header_standard_meta_boxes();
		
		staffscout_mikado_add_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'mkdf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'staffscout' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'staffscout' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'staffscout' ),
					'left'   => esc_html__( 'Left', 'staffscout' ),
					'right'  => esc_html__( 'Right', 'staffscout' ),
					'center' => esc_html__( 'Center', 'staffscout' )
				),
				'hidden_property' => 'mkdf_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
	}
	
	add_action( 'staffscout_mikado_additional_header_area_meta_boxes_map', 'staffscout_mikado_header_standard_meta_map' );
}