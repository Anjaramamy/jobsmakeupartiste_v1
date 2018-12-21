<?php

if ( ! function_exists( 'staffscout_mikado_sidearea_options_map' ) ) {
	function staffscout_mikado_sidearea_options_map() {
		
		staffscout_mikado_add_admin_page(
			array(
				'slug'  => '_side_area_page',
				'title' => esc_html__( 'Side Area', 'staffscout' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$side_area_panel = staffscout_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Side Area', 'staffscout' ),
				'name'  => 'side_area',
				'page'  => '_side_area_page'
			)
		);
		
		$side_area_icon_style_group = staffscout_mikado_add_admin_group(
			array(
				'parent'      => $side_area_panel,
				'name'        => 'side_area_icon_style_group',
				'title'       => esc_html__( 'Side Area Icon Style', 'staffscout' ),
				'description' => esc_html__( 'Define styles for Side Area icon', 'staffscout' )
			)
		);
		
		$side_area_icon_style_row1 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row1'
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'side_area_icon_color',
				'label'  => esc_html__( 'Color', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'side_area_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'staffscout' )
			)
		);
		
		$side_area_icon_style_row2 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $side_area_icon_style_group,
				'name'   => 'side_area_icon_style_row2',
				'next'   => true
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'side_area_close_icon_color',
				'label'  => esc_html__( 'Close Icon Color', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'side_area_close_icon_hover_color',
				'label'  => esc_html__( 'Close Icon Hover Color', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'text',
				'name'          => 'side_area_width',
				'default_value' => '',
				'label'         => esc_html__( 'Side Area Width', 'staffscout' ),
				'description'   => esc_html__( 'Enter a width for Side Area', 'staffscout' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'color',
				'name'        => 'side_area_background_color',
				'label'       => esc_html__( 'Background Color', 'staffscout' ),
				'description' => esc_html__( 'Choose a background color for Side Area', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'      => $side_area_panel,
				'type'        => 'text',
				'name'        => 'side_area_padding',
				'label'       => esc_html__( 'Padding', 'staffscout' ),
				'description' => esc_html__( 'Define padding for Side Area in format top right bottom left', 'staffscout' ),
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'parent'        => $side_area_panel,
				'type'          => 'selectblank',
				'name'          => 'side_area_aligment',
				'default_value' => '',
				'label'         => esc_html__( 'Text Alignment', 'staffscout' ),
				'description'   => esc_html__( 'Choose text alignment for side area', 'staffscout' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'staffscout' ),
					'left'   => esc_html__( 'Left', 'staffscout' ),
					'center' => esc_html__( 'Center', 'staffscout' ),
					'right'  => esc_html__( 'Right', 'staffscout' )
				)
			)
		);
	}
	
	add_action( 'staffscout_mikado_options_map', 'staffscout_mikado_sidearea_options_map', 4 );
}