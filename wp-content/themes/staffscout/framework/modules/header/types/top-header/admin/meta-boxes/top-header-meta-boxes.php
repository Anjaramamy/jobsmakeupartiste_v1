<?php

if ( ! function_exists( 'staffscout_mikado_get_hide_dep_for_top_header_area_meta_boxes' ) ) {
	function staffscout_mikado_get_hide_dep_for_top_header_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'staffscout_mikado_top_header_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'staffscout_mikado_header_top_area_meta_options_map' ) ) {
	function staffscout_mikado_header_top_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = staffscout_mikado_get_hide_dep_for_top_header_area_meta_boxes();
		
		$top_header_container = staffscout_mikado_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'mkdf_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		staffscout_mikado_add_admin_section_title(
			array(
				'parent' => $top_header_container,
				'name'   => 'top_area_style',
				'title'  => esc_html__( 'Top Area', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_top_bar_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Top Bar', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will show header top bar area', 'staffscout' ),
				'parent'        => $top_header_container,
				'options'       => staffscout_mikado_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#mkdf_top_bar_container_no_style',
						'no'  => '#mkdf_top_bar_container_no_style',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#mkdf_top_bar_container_no_style'
					)
				)
			)
		);
		
		$top_bar_container = staffscout_mikado_add_admin_container_no_style(
			array(
				'name'            => 'top_bar_container_no_style',
				'parent'          => $top_header_container,
				'hidden_property' => 'mkdf_top_bar_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);

        staffscout_mikado_add_meta_box_field(
            array(
                'name'          => 'mkdf_top_bar_skin_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Top Bar Skin', 'staffscout' ),
                'description'   => esc_html__( 'Choose a predefined Skin for Top Bar header elements.', 'staffscout' ),
                'parent'        => $top_bar_container,
                'options'       => array(
                    ''             => esc_html__( 'Default', 'staffscout' ),
                    'top-light-header' => esc_html__( 'Light', 'staffscout' ),
                    'top-dark-header'  => esc_html__( 'Dark', 'staffscout' )
                )
            )
        );
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_top_bar_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar In Grid', 'staffscout' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'staffscout' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => staffscout_mikado_get_yes_no_select_array()
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'   => 'mkdf_top_bar_background_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Top Bar Background Color', 'staffscout' ),
				'parent' => $top_bar_container
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_top_bar_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Background Color Transparency', 'staffscout' ),
				'description' => esc_html__( 'Set top bar background color transparenct. Value should be between 0 and 1', 'staffscout' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_top_bar_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar Border', 'staffscout' ),
				'description'   => esc_html__( 'Set border on top bar', 'staffscout' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => staffscout_mikado_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#mkdf_top_bar_border_container',
						'no'  => '#mkdf_top_bar_border_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#mkdf_top_bar_border_container'
					)
				)
			)
		);
		
		$top_bar_border_container = staffscout_mikado_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'hidden_property' => 'mkdf_top_bar_border_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_top_bar_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'staffscout' ),
				'description' => esc_html__( 'Choose color for top bar border', 'staffscout' ),
				'parent'      => $top_bar_border_container
			)
		);
	}
	
	add_action( 'staffscout_mikado_additional_header_area_meta_boxes_map', 'staffscout_mikado_header_top_area_meta_options_map', 10, 1 );
}