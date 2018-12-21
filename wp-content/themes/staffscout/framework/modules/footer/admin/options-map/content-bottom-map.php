<?php

if ( ! function_exists( 'staffscout_mikado_content_bottom_options_map' ) ) {
	function staffscout_mikado_content_bottom_options_map() {
		
		$panel_content_bottom = staffscout_mikado_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__( 'Content Bottom Area Style', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'enable_content_bottom_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'staffscout' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'staffscout' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_enable_content_bottom_area_container'
				),
				'parent'        => $panel_content_bottom
			)
		);
		
		$enable_content_bottom_area_container = staffscout_mikado_add_admin_container(
			array(
				'parent'          => $panel_content_bottom,
				'name'            => 'enable_content_bottom_area_container',
				'hidden_property' => 'enable_content_bottom_area',
				'hidden_value'    => 'no'
			)
		);
		
		$staffscout_custom_sidebars = staffscout_mikado_get_custom_sidebars();
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'content_bottom_sidebar_custom_display',
				'default_value' => '',
				'label'         => esc_html__( 'Widget Area to Display', 'staffscout' ),
				'description'   => esc_html__( 'Choose a Content Bottom widget area to display', 'staffscout' ),
				'options'       => $staffscout_custom_sidebars,
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Display in Grid', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will place Content Bottom in grid', 'staffscout' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'content_bottom_background_color',
				'label'       => esc_html__( 'Background Color', 'staffscout' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'staffscout' ),
				'parent'      => $enable_content_bottom_area_container
			)
		);
	}
	
	add_action( 'staffscout_mikado_additional_page_options_map', 'staffscout_mikado_content_bottom_options_map' );
}