<?php
if(!function_exists('mkdf_listing_job_map_listing_settings')) {
	function mkdf_listing_job_map_listing_settings() {
		$listing_types = mkdf_listing_job_get_listing_types(true);
		$listing_types_by_key = $listing_types['key_value'];
		$listing_types_objects = $listing_types['obj'];

		$default_value = '';
		if(isset($listing_types_by_key[0])){
			$default_value = $listing_types_by_key[0];
		}

        $enable_multi_listings = function_exists('job_manager_multi_job_type') ? job_manager_multi_job_type() : false;
		$enable_categories = mkdf_listing_job_enable_categories();

		mkdf_listing_job_add_listing_field(
			array(
				'id' => 'listing_price',
				'type' => 'text',
				'label' => esc_html__('Price', 'mkdf-listing'),
				'required' => false,
				'placeholder' => esc_html__('e.q 7000', 'mkdf-listing'),
				'description' => '',
				'priority' => 9
			)
		);
        mkdf_listing_job_add_listing_field(
            array(
                'id' => 'listing_rate',
                'type' => 'text',
                'label' => esc_html__('Rate (per Hour)', 'mkdf-listing'),
                'required' => false,
                'placeholder' => esc_html__('e.q 45', 'mkdf-listing'),
                'description' => '',
                'priority' => 9
            )
        );
        mkdf_listing_job_add_listing_field(
            array(
                'id' => 'listing_type_background',
                'type' => 'text',
                'label' => esc_html__('Type Background Color', 'mkdf-listing'),
                'required' => false,
                'placeholder' => esc_html__('e.q #4286f4', 'mkdf-listing'),
                'description' => esc_html__('Enter the Background Color for Listing Type. You can use any CSS, HEX or rgb(a) color. For Example: "red", "#4286f4", "rgb(66, 134, 244)" ', 'mkdf-listing'),
                'priority' => 10,
                'front_end_field' => false
            )
        );
        mkdf_listing_job_add_listing_field(
            array(
                'id' => 'company_logo',
                'type'  => 'file',
                'multiple'  => false,
                'label' => esc_html__('Featured Image', 'mkdf-listing'),
                'required' => false,
                'placeholder' => esc_html__('Image', 'mkdf-listing'),
                'description' => '',
                'priority' => 11,
                'back_end_field' => false
            )
        );
        mkdf_listing_job_add_listing_field(
            array(
                'id' => 'lists_image',
                'type'  => 'file',
                'multiple'  => false,
                'label' => esc_html__('Lists Company Logo', 'mkdf-listing'),
                'required' => false,
                'placeholder' => esc_html__('Image', 'mkdf-listing'),
                'description' => '',
                'priority' => 12,
            )
        );
		mkdf_listing_job_add_listing_field(
			array(
				'id' => 'listing_mail',
				'type'  => 'text',
				'label' => esc_html__('E-mail', 'mkdf-listing'),
				'required' => false,
				'placeholder' => esc_html__('Enter e-mail', 'mkdf-listing'),
				'description' => '',
				'priority' => 13
			)
		);

		$social_network_array = mkdf_listing_job_get_listing_social_network_array();

		$counter = 16;
		foreach($social_network_array as $network){
			$counter++;
			mkdf_listing_job_add_listing_field(
				array(
					'id' => 'listing_'.$network['id'].'_url',
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
	add_action('staffscout_mikado_meta_boxes_map_on_init_action', 'mkdf_listing_job_map_listing_settings');
}