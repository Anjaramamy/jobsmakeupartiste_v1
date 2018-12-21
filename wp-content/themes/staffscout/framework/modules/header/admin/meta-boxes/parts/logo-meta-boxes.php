<?php

if ( ! function_exists( 'staffscout_mikado_logo_meta_box_map' ) ) {
	function staffscout_mikado_logo_meta_box_map() {
		
		$logo_meta_box = staffscout_mikado_add_meta_box(
			array(
				'scope' => apply_filters( 'staffscout_mikado_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Logo', 'staffscout' ),
				'name'  => 'logo_meta'
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'staffscout' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'staffscout' ),
				'parent'      => $logo_meta_box
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'staffscout' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'staffscout' ),
				'parent'      => $logo_meta_box
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'staffscout' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'staffscout' ),
				'parent'      => $logo_meta_box
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'staffscout' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'staffscout' ),
				'parent'      => $logo_meta_box
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'staffscout' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'staffscout' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'staffscout_mikado_meta_boxes_map', 'staffscout_mikado_logo_meta_box_map', 47 );
}