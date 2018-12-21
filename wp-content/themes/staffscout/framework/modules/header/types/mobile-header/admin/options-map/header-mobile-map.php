<?php

if ( ! function_exists( 'staffscout_mikado_mobile_header_options_map' ) ) {
	function staffscout_mikado_mobile_header_options_map() {
		
		$panel_mobile_header = staffscout_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Mobile Header', 'staffscout' ),
				'name'  => 'panel_mobile_header',
				'page'  => '_header_page'
			)
		);

		$mobile_header_group = staffscout_mikado_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_group',
				'title'  => esc_html__( 'Mobile Header Styles', 'staffscout' )
			)
		);

		$mobile_header_row1 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $mobile_header_group,
				'name'   => 'mobile_header_row1'
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_header_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Height', 'staffscout' ),
				'parent' => $mobile_header_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_header_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'staffscout' ),
				'parent' => $mobile_header_row1
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_header_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'staffscout' ),
				'parent' => $mobile_header_row1
			)
		);

		$mobile_menu_group = staffscout_mikado_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_menu_group',
				'title'  => esc_html__( 'Mobile Menu Styles', 'staffscout' )
			)
		);

		$mobile_menu_row1 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $mobile_menu_group,
				'name'   => 'mobile_menu_row1'
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_menu_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'staffscout' ),
				'parent' => $mobile_menu_row1
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_menu_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'staffscout' ),
				'parent' => $mobile_menu_row1
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_menu_separator_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Menu Item Separator Color', 'staffscout' ),
				'parent' => $mobile_menu_row1
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'mobile_logo_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Header', 'staffscout' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 1024px', 'staffscout' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'mobile_logo_height_phones',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Devices', 'staffscout' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 480px', 'staffscout' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		staffscout_mikado_add_admin_section_title(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_fonts_title',
				'title'  => esc_html__( 'Typography', 'staffscout' )
			)
		);

		$first_level_group = staffscout_mikado_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'first_level_group',
				'title'       => esc_html__( '1st Level Menu', 'staffscout' ),
				'description' => esc_html__( 'Define styles for 1st level in Mobile Menu Navigation', 'staffscout' )
			)
		);

		$first_level_row1 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'staffscout' ),
				'parent' => $first_level_row1
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'staffscout' ),
				'parent' => $first_level_row1
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'staffscout' ),
				'parent' => $first_level_row1
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'staffscout' ),
				'parent' => $first_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$first_level_row2 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2'
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'staffscout' ),
				'parent' => $first_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'    => 'mobile_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'staffscout' ),
				'parent'  => $first_level_row2,
				'options' => staffscout_mikado_get_text_transform_array()
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'    => 'mobile_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'staffscout' ),
				'parent'  => $first_level_row2,
				'options' => staffscout_mikado_get_font_style_array()
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'    => 'mobile_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'staffscout' ),
				'parent'  => $first_level_row2,
				'options' => staffscout_mikado_get_font_weight_array()
			)
		);

		$first_level_row3 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row3'
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'staffscout' ),
				'default_value' => '',
				'parent'        => $first_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_group = staffscout_mikado_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Dropdown Menu', 'staffscout' ),
				'description' => esc_html__( 'Define styles for drop down menu items in Mobile Menu Navigation', 'staffscout' )
			)
		);

		$second_level_row1 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'staffscout' ),
				'parent' => $second_level_row1
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'staffscout' ),
				'parent' => $second_level_row1
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'staffscout' ),
				'parent' => $second_level_row1
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'staffscout' ),
				'parent' => $second_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$second_level_row2 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2'
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'staffscout' ),
				'parent' => $second_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'staffscout' ),
				'parent'  => $second_level_row2,
				'options' => staffscout_mikado_get_text_transform_array()
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'staffscout' ),
				'parent'  => $second_level_row2,
				'options' => staffscout_mikado_get_font_style_array()
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'staffscout' ),
				'parent'  => $second_level_row2,
				'options' => staffscout_mikado_get_font_weight_array()
			)
		);

		$second_level_row3 = staffscout_mikado_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row3'
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_dropdown_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'staffscout' ),
				'default_value' => '',
				'parent'        => $second_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		staffscout_mikado_add_admin_section_title(
			array(
				'name'   => 'mobile_opener_panel',
				'parent' => $panel_mobile_header,
				'title'  => esc_html__( 'Mobile Menu Opener', 'staffscout' )
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'mobile_menu_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Mobile Navigation Title', 'staffscout' ),
				'description' => esc_html__( 'Enter title for mobile menu navigation', 'staffscout' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3
				)
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_icon_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Color', 'staffscout' ),
				'parent' => $panel_mobile_header
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'name'   => 'mobile_icon_hover_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Hover Color', 'staffscout' ),
				'parent' => $panel_mobile_header
			)
		);
	}
	
	add_action( 'staffscout_mikado_mobile_header_options_map', 'staffscout_mikado_mobile_header_options_map', 10, 1);
}