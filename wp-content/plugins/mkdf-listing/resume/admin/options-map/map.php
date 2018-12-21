<?php

if ( ! function_exists('mkdf_listing_resume_options_map') ) {

	function mkdf_listing_resume_options_map() {

		staffscout_mikado_add_admin_page( array(
			'slug'  => '_resume',
			'title' =>  esc_html__('Resume', 'mkdf-listing'),
			'icon'  => 'fa fa-camera-retro'
		) );

		$panel_archive = staffscout_mikado_add_admin_panel( array(
			'title' => esc_html__('Archive', 'mkdf-listing'),
			'name'  => 'panel_archive',
			'page'  => '_resume'
		) );

		staffscout_mikado_add_admin_field(
			array(
				'parent'		=> $panel_archive,
				'type'			=> 'text',
				'name'			=> 'resumes_per_page',
				'default_value'	=> '',
				'label'			=> esc_html__('Number of resumes per page', 'mkdf-listing'),
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		staffscout_mikado_add_admin_field(
			array(
				'parent'		=> $panel_archive,
				'type'			=> 'yesno',
				'name'			=> 'resumes_archive_load_more',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Load More on Archive Pages', 'mkdf-listing'),
				'description'	=> '',
			)
		);

		$panel_maps = staffscout_mikado_add_admin_panel( array(
			'title' => 'Maps',
			'name'  => 'panel_maps',
			'page'  => '_resume'
		) );

		staffscout_mikado_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'textarea',
				'name'			=> 'resume_map_style',
				'default_value'	=> '',
				'label'			=> esc_html__('Maps Style', 'mkdf-listing'),
				'description'	=> esc_html__('Insert map style json', 'mkdf-listing'),
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'resume_maps_scrollable',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Scrollable Maps', 'mkdf-listing'),
				'description'	=> '',
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'resume_maps_draggable',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Draggable Maps', 'mkdf-listing'),
				'description'	=> '',
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'resume_maps_street_view_control',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Maps Street View Controls', 'mkdf-listing'),
				'description'	=> '',
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'resume_maps_zoom_control',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Maps Zoom Control', 'mkdf-listing'),
				'description'	=> '',
			)
		);

		staffscout_mikado_add_admin_field(
			array(
				'parent'		=> $panel_maps,
				'type'			=> 'yesno',
				'name'			=> 'resume_maps_type_control',
				'default_value'	=> 'yes',
				'label'			=> esc_html__('Maps Type Control', 'mkdf-listing'),
				'description'	=> '',
			)
		);

        $panel_terms = staffscout_mikado_add_admin_panel( array(
            'title' => 'Terms And Conditions',
            'name'  => 'panel_terms',
            'page'  => '_resume'
        ) );

        staffscout_mikado_add_admin_field(
            array(
                'parent'		=> $panel_terms,
                'type'			=> 'text',
                'name'			=> 'resume_item_terms_link',
                'default_value'	=> '',
                'label'			=> esc_html__('Terms And Conditions Page URL', 'mkdf-listing'),
                'description'   => esc_html__('Enter the page URL with terms and conditions.','mkdf-listing')
            )
        );


	}
	add_action( 'staffscout_mikado_options_map', 'mkdf_listing_resume_options_map', 15);
}