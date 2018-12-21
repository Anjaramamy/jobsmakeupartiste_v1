<?php
if(!function_exists('mkdf_listing_resume_map_resume_settings')) {
	function mkdf_listing_resume_map_resume_settings() {
		$resume_types = mkdf_listing_resume_get_resume_types(true);
		$resume_types_by_key = $resume_types['key_value'];
		$resume_types_objects = $resume_types['obj'];

		$default_value = '';
		if(isset($resume_types_by_key[0])){
			$default_value = $resume_types_by_key[0];
		}

        $enable_multi_resumes = function_exists('job_manager_multi_job_type') ? job_manager_multi_job_type() : false;
		$enable_categories = mkdf_listing_resume_enable_categories();

        mkdf_listing_resume_add_resume_field(
            array(
                'id' => 'resume_rate',
                'type' => 'text',
                'label' => esc_html__('Rate (per Hour)', 'mkdf-listing'),
                'required' => false,
                'placeholder' => esc_html__('e.q 45', 'mkdf-listing'),
                'description' => '',
                'priority' => 9
            )
        );

        mkdf_listing_resume_add_resume_field(
            array(
                'id' => 'profile_image',
                'type'  => 'file',
                'multiple'  => false,
                'label' => esc_html__('Profile Image', 'mkdf-listing'),
                'required' => false,
                'placeholder' => esc_html__('Image', 'mkdf-listing'),
                'description' => '',
                'priority' => 6,
                'front_end_field' => true,
                'back_end_field' => true
            )
        );
		mkdf_listing_resume_add_resume_field(
			array(
				'id' => 'resume_mail',
				'type'  => 'text',
				'label' => esc_html__('E-mail', 'mkdf-listing'),
				'required' => false,
				'placeholder' => esc_html__('Enter e-mail', 'mkdf-listing'),
				'description' => '',
				'priority' => 13
			)
		);

        mkdf_listing_resume_add_resume_field(
            array(
                'id' => 'resume_website',
                'type'  => 'text',
                'label' => esc_html__('Website', 'mkdf-listing'),
                'required' => false,
                'placeholder' => esc_html__('Enter website', 'mkdf-listing'),
                'description' => '',
                'priority' => 14,
                'back_end_field' => true
            )
        );

		$social_network_array = mkdf_listing_resume_get_resume_social_network_array();

		$counter = 16;
		foreach($social_network_array as $network){
			$counter++;
			mkdf_listing_resume_add_resume_field(
				array(
					'id' => 'resume_'.$network['id'].'_url',
					'type'  => 'text',
					'label' => esc_html($network['name']),
					'required' => false,
					'placeholder' => esc_html($network['label']),
					'description' => '',
					'priority' => $counter
				)
			);
		}

	}
	add_action('staffscout_mikado_meta_boxes_map_on_init_action', 'mkdf_listing_resume_map_resume_settings');
}