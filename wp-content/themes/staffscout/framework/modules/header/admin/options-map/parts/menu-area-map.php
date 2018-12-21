<?php

if ( ! function_exists( 'staffscout_mikado_get_hide_dep_for_header_menu_area_options' ) ) {
	function staffscout_mikado_get_hide_dep_for_header_menu_area_options() {
		$hide_dep_options = apply_filters( 'staffscout_mikado_header_menu_area_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'staffscout_mikado_header_menu_area_options_map' ) ) {
	function staffscout_mikado_header_menu_area_options_map( $panel_header ) {
		$hide_dep_options = staffscout_mikado_get_hide_dep_for_header_menu_area_options();
		
		$menu_area_container = staffscout_mikado_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'menu_area_container',
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		staffscout_mikado_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Menu Area Style', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area In Grid', 'staffscout' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'staffscout' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_menu_area_in_grid_container'
				)
			)
		);
		
		$menu_area_in_grid_container = staffscout_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_container,
				'name'            => 'menu_area_in_grid_container',
				'hidden_property' => 'menu_area_in_grid',
				'hidden_value'    => 'no'
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Color', 'staffscout' ),
				'description'   => esc_html__( 'Set grid background color for menu area', 'staffscout' ),
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'text',
				'name'          => 'menu_area_grid_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Transparency', 'staffscout' ),
				'description'   => esc_html__( 'Set grid background transparency for menu area', 'staffscout' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Shadow', 'staffscout' ),
				'description'   => esc_html__( 'Set shadow on grid area', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Border', 'staffscout' ),
				'description'   => esc_html__( 'Set border on grid area', 'staffscout' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_menu_area_in_grid_border_container'
				)
			)
		);
		
		$menu_area_in_grid_border_container = staffscout_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_in_grid_container,
				'name'            => 'menu_area_in_grid_border_container',
				'hidden_property' => 'menu_area_in_grid_border',
				'hidden_value'    => 'no'
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_border_container,
				'type'          => 'color',
				'name'          => 'menu_area_in_grid_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'staffscout' ),
				'description'   => esc_html__( 'Set border color for menu area', 'staffscout' ),
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'color',
				'name'          => 'menu_area_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Background Color', 'staffscout' ),
				'description'   => esc_html__( 'Set background color for menu area', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'staffscout' ),
				'description'   => esc_html__( 'Set background transparency for menu area', 'staffscout' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Area Shadow', 'staffscout' ),
				'description'   => esc_html__( 'Set shadow on menu area', 'staffscout' ),
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Border', 'staffscout' ),
				'description'   => esc_html__( 'Set border on menu area', 'staffscout' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_menu_area_border_container'
				)
			)
		);
		
		$menu_area_border_container = staffscout_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_container,
				'name'            => 'menu_area_border_container',
				'hidden_property' => 'menu_area_border',
				'hidden_value'    => 'no'
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_border_container,
				'type'          => 'color',
				'name'          => 'menu_area_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'staffscout' ),
				'description'   => esc_html__( 'Set border color for menu area', 'staffscout' ),
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'text',
				'name'          => 'menu_area_height',
				'default_value' => '',
				'label'         => esc_html__( 'Height', 'staffscout' ),
				'description'   => esc_html__( 'Enter header height', 'staffscout' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		do_action( 'staffscout_mikado_header_menu_area_additional_options', $panel_header );
	}
	
	add_action( 'staffscout_mikado_header_menu_area_options_map', 'staffscout_mikado_header_menu_area_options_map', 10, 1 );
}