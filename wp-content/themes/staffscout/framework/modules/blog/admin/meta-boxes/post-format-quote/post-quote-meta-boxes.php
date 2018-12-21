<?php

if ( ! function_exists( 'staffscout_mikado_map_post_quote_meta' ) ) {
	function staffscout_mikado_map_post_quote_meta() {
		$quote_post_format_meta_box = staffscout_mikado_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'staffscout' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'staffscout' ),
				'description' => esc_html__( 'Enter Quote text', 'staffscout' ),
				'parent'      => $quote_post_format_meta_box,
			
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'staffscout' ),
				'description' => esc_html__( 'Enter Quote author', 'staffscout' ),
				'parent'      => $quote_post_format_meta_box,
			)
		);
	}
	
	add_action( 'staffscout_mikado_meta_boxes_map', 'staffscout_mikado_map_post_quote_meta', 25 );
}