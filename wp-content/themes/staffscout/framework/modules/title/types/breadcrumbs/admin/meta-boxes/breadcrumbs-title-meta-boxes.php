<?php

if ( ! function_exists( 'staffscout_mikado_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function staffscout_mikado_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'staffscout' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'staffscout' ),
				'parent'      => $show_title_area_meta_container
			)
		);

        staffscout_mikado_add_meta_box_field(
            array(
                'name'        => 'mkdf_breadcrumbs_current_color_meta',
                'type'        => 'color',
                'label'       => esc_html__( 'Current Breadcrumb Color', 'staffscout' ),
                'description' => esc_html__( 'Choose a color for current breadcrumb text', 'staffscout' ),
                'parent'      => $show_title_area_meta_container
            )
        );
	}
	
	add_action( 'staffscout_mikado_additional_title_area_meta_boxes', 'staffscout_mikado_breadcrumbs_title_type_options_meta_boxes' );
}