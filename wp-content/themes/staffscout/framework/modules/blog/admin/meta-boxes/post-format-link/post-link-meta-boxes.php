<?php

if ( ! function_exists( 'staffscout_mikado_map_post_link_meta' ) ) {
	function staffscout_mikado_map_post_link_meta() {
		$link_post_format_meta_box = staffscout_mikado_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'staffscout' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'staffscout' ),
				'description' => esc_html__( 'Enter link', 'staffscout' ),
				'parent'      => $link_post_format_meta_box,
			
			)
		);
	}
	
	add_action( 'staffscout_mikado_meta_boxes_map', 'staffscout_mikado_map_post_link_meta', 24 );
}