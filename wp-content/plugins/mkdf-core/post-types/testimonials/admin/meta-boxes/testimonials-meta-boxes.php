<?php

if ( ! function_exists( 'mkdf_core_map_testimonials_meta' ) ) {
	function mkdf_core_map_testimonials_meta() {
		$testimonial_meta_box = staffscout_mikado_add_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'mkdf-core' ),
				'name'  => 'testimonial_meta'
			)
		);

        staffscout_mikado_add_meta_box_field(
            array(
                'name'        => 'mkdf_testimonial_quote_image',
                'type'        => 'image',
                'label'       => esc_html__( 'Quote Image', 'mkdf-core' ),
                'parent'      => $testimonial_meta_box,
            )
        );
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'mkdf-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'mkdf-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'mkdf-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'mkdf-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'mkdf-core' ),
				'description' => esc_html__( 'Enter author name', 'mkdf-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'mkdf-core' ),
				'description' => esc_html__( 'Enter author job position', 'mkdf-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);

        staffscout_mikado_add_meta_box_field(
            array(
                'name'        => 'mkdf_testimonial_company_logo',
                'type'        => 'image',
                'label'       => esc_html__( 'Company Logo', 'mkdf-core' ),
                'parent'      => $testimonial_meta_box,
            )
        );

        staffscout_mikado_add_meta_box_field(
            array(
                'name'        => 'mkdf_testimonial_background_image',
                'type'        => 'image',
                'label'       => esc_html__( 'Background Image', 'mkdf-core' ),
                'parent'      => $testimonial_meta_box,
            )
        );
	}
	
	add_action( 'staffscout_mikado_meta_boxes_map', 'mkdf_core_map_testimonials_meta', 95 );
}