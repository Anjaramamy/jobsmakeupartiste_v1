<?php

if ( ! function_exists( 'staffscout_mikado_map_footer_meta' ) ) {
	function staffscout_mikado_map_footer_meta() {
		
		$footer_meta_box = staffscout_mikado_add_meta_box(
			array(
				'scope' => apply_filters( 'staffscout_mikado_set_scope_for_meta_boxes', array( 'page', 'post', 'resume', 'job_listing' ) ),
				'title' => esc_html__( 'Footer', 'staffscout' ),
				'name'  => 'footer_meta'
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_disable_footer_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Footer for this Page', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'staffscout' ),
				'parent'        => $footer_meta_box
			)
		);

        staffscout_mikado_add_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'mkdf_footer_skin_meta',
                'default_value' => '',
                'options'       => array(
                    ''       => esc_html__( 'Default', 'staffscout' ),
                    'light'       => esc_html__( 'Light', 'staffscout' ),
                    'dark'   => esc_html__( 'Dark', 'staffscout' ),
                ),
                'label'         => esc_html__( 'Footer Skin', 'staffscout' ),
                'description'   => esc_html__( 'Choose the skin of Footer Content', 'staffscout' ),
                'parent'        => $footer_meta_box,
            )
        );
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_show_footer_top_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Top', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'staffscout' ),
				'parent'        => $footer_meta_box,
				'options'       => staffscout_mikado_get_yes_no_select_array()
			)
		);

        staffscout_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_footer_top_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Footer Top Background Color', 'staffscout'),
                'description' => esc_html__('Set background color for top footer area', 'staffscout'),
                'parent' => $footer_meta_box
            )
        );

        $staffscout_custom_sidebars = staffscout_mikado_get_custom_sidebars();
        if(count($staffscout_custom_sidebars) > 0) {
            staffscout_mikado_add_meta_box_field(array(
                'name' => 'mkdf_custom_footer_col_1_widget_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Custom Widget Area in Footer Column 1', 'staffscout'),
                'description' => esc_html__('Choose custom widget area to display in footer column 1"', 'staffscout'),
                'parent' => $footer_meta_box,
                'options' => $staffscout_custom_sidebars
            ));
        }

        if(count($staffscout_custom_sidebars) > 0) {
            staffscout_mikado_add_meta_box_field(array(
                'name' => 'mkdf_custom_footer_col_2_widget_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Custom Widget Area in Footer Column 2', 'staffscout'),
                'description' => esc_html__('Choose custom widget area to display in footer column 2"', 'staffscout'),
                'parent' => $footer_meta_box,
                'options' => $staffscout_custom_sidebars
            ));
        }

        if(count($staffscout_custom_sidebars) > 0) {
            staffscout_mikado_add_meta_box_field(array(
                'name' => 'mkdf_custom_footer_col_3_widget_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Custom Widget Area in Footer Column 3', 'staffscout'),
                'description' => esc_html__('Choose custom widget area to display in footer column 3"', 'staffscout'),
                'parent' => $footer_meta_box,
                'options' => $staffscout_custom_sidebars
            ));
        }

        if(count($staffscout_custom_sidebars) > 0) {
            staffscout_mikado_add_meta_box_field(array(
                'name' => 'mkdf_custom_footer_col_4_widget_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Custom Widget Area in Footer Column 4', 'staffscout'),
                'description' => esc_html__('Choose custom widget area to display in footer column 4"', 'staffscout'),
                'parent' => $footer_meta_box,
                'options' => $staffscout_custom_sidebars
            ));
        }
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_show_footer_bottom_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Bottom', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'staffscout' ),
				'parent'        => $footer_meta_box,
				'options'       => staffscout_mikado_get_yes_no_select_array()
			)
		);

        staffscout_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_footer_bottom_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Footer Bottom Background Color', 'staffscout'),
                'description' => esc_html__('Set background color for bottom footer area', 'staffscout'),
                'parent' => $footer_meta_box
            )
        );
	}
	
	add_action( 'staffscout_mikado_meta_boxes_map', 'staffscout_mikado_map_footer_meta', 70 );
}