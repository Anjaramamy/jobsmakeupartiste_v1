<?php

if ( ! function_exists( 'staffscout_mikado_footer_options_map' ) ) {
	function staffscout_mikado_footer_options_map() {
		
		staffscout_mikado_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'staffscout' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);
		
		$footer_panel = staffscout_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'staffscout' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

        staffscout_mikado_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_skin',
                'default_value' => 'light',
                'options'       => array(
                    'light'       => esc_html__( 'Light', 'staffscout' ),
                    'dark'   => esc_html__( 'Dark', 'staffscout' ),
                ),
                'label'         => esc_html__( 'Footer Skin', 'staffscout' ),
                'description'   => esc_html__( 'Choose the skin of Footer Content', 'staffscout' ),
                'parent'        => $footer_panel,
            )
        );
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'staffscout' ),
				'parent'        => $footer_panel,
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'staffscout' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_show_footer_top_container'
				),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_top_container = staffscout_mikado_add_admin_container(
			array(
				'name'            => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value'    => 'no',
				'parent'          => $footer_panel
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '4',
				'label'         => esc_html__( 'Footer Top Columns', 'staffscout' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'staffscout' ),
				'options'       => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'staffscout' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'staffscout' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'staffscout' ),
					'left'   => esc_html__( 'Left', 'staffscout' ),
					'center' => esc_html__( 'Center', 'staffscout' ),
					'right'  => esc_html__( 'Right', 'staffscout' )
				),
				'parent'        => $show_footer_top_container,
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'staffscout' ),
				'description' => esc_html__( 'Set background color for top footer area', 'staffscout' ),
				'parent'      => $show_footer_top_container
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'staffscout' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_show_footer_bottom_container'
				),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_bottom_container = staffscout_mikado_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value'    => 'no',
				'parent'          => $footer_panel
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '2',
				'label'         => esc_html__( 'Footer Bottom Columns', 'staffscout' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'staffscout' ),
				'options'       => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'staffscout' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'staffscout' ),
				'parent'      => $show_footer_bottom_container
			)
		);
	}
	
	add_action( 'staffscout_mikado_options_map', 'staffscout_mikado_footer_options_map', 11 );
}