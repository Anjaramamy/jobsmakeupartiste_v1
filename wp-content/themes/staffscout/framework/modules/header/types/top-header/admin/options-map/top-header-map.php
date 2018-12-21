<?php

if ( ! function_exists( 'staffscout_mikado_get_hide_dep_for_top_header_options' ) ) {
	function staffscout_mikado_get_hide_dep_for_top_header_options() {
		$hide_dep_options = apply_filters( 'staffscout_mikado_top_header_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'staffscout_mikado_header_top_options_map' ) ) {
	function staffscout_mikado_header_top_options_map( $panel_header ) {
		$hide_dep_options = staffscout_mikado_get_hide_dep_for_top_header_options();
		
		$top_header_container = staffscout_mikado_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $panel_header,
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'top_bar',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Top Bar', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will show top bar area', 'staffscout' ),
				'parent'        => $top_header_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_top_bar_container"
				)
			)
		);
		
		$top_bar_container = staffscout_mikado_add_admin_container(
			array(
				'name'            => 'top_bar_container',
				'parent'          => $top_header_container,
				'hidden_property' => 'top_bar',
				'hidden_value'    => 'no'
			)
		);

        staffscout_mikado_add_admin_field(
            array(
                'parent'        => $top_bar_container,
                'type'          => 'select',
                'name'          => 'top_bar_skin',
                'default_value' => '',
                'label'         => esc_html__( 'Top Bar Skin', 'staffscout' ),
                'description'   => esc_html__( 'Choose a predefined Skin for Top Bar header elements.', 'staffscout' ),
                'options'       => array(
                    ''             => esc_html__( 'Default', 'staffscout' ),
                    'top-light-header' => esc_html__( 'Light', 'staffscout' ),
                    'top-dark-header'  => esc_html__( 'Dark', 'staffscout' )
                ),
            )
        );
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'top_bar_in_grid',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Top Bar in Grid', 'staffscout' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'staffscout' ),
				'parent'        => $top_bar_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_top_bar_in_grid_container"
				)
			)
		);
		
		$top_bar_in_grid_container = staffscout_mikado_add_admin_container(
			array(
				'name'            => 'top_bar_in_grid_container',
				'parent'          => $top_bar_container,
				'hidden_property' => 'top_bar_in_grid',
				'hidden_value'    => 'no'
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_grid_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Grid Background Color', 'staffscout' ),
				'description' => esc_html__( 'Set grid background color for top bar', 'staffscout' ),
				'parent'      => $top_bar_in_grid_container
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_grid_background_transparency',
				'type'        => 'text',
				'label'       => esc_html__( 'Grid Background Transparency', 'staffscout' ),
				'description' => esc_html__( 'Set grid background transparency for top bar', 'staffscout' ),
				'parent'      => $top_bar_in_grid_container,
				'args'        => array( 'col_width' => 3 )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'staffscout' ),
				'description' => esc_html__( 'Set background color for top bar', 'staffscout' ),
				'parent'      => $top_bar_container
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_background_transparency',
				'type'        => 'text',
				'label'       => esc_html__( 'Background Transparency', 'staffscout' ),
				'description' => esc_html__( 'Set background transparency for top bar', 'staffscout' ),
				'parent'      => $top_bar_container,
				'args'        => array( 'col_width' => 3 )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'top_bar_border',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Top Bar Border', 'staffscout' ),
				'description'   => esc_html__( 'Set top bar border', 'staffscout' ),
				'parent'        => $top_bar_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_top_bar_border_container"
				)
			)
		);
		
		$top_bar_border_container = staffscout_mikado_add_admin_container(
			array(
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'hidden_property' => 'top_bar_border',
				'hidden_value'    => 'no'
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_border_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Top Bar Border', 'staffscout' ),
				'description' => esc_html__( 'Set border color for top bar', 'staffscout' ),
				'parent'      => $top_bar_border_container
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'top_bar_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Height', 'staffscout' ),
				'description' => esc_html__( 'Enter top bar height (Default is 40px)', 'staffscout' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
	}
	
	add_action( 'staffscout_mikado_header_top_options_map', 'staffscout_mikado_header_top_options_map', 10, 1 );
}