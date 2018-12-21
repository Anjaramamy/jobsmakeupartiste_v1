<?php

if ( ! function_exists( 'staffscout_mikado_map_post_gallery_meta' ) ) {
	
	function staffscout_mikado_map_post_gallery_meta() {
		$gallery_post_format_meta_box = staffscout_mikado_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'staffscout' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		staffscout_mikado_add_multiple_images_field(
			array(
				'name'        => 'mkdf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'staffscout' ),
				'description' => esc_html__( 'Choose your gallery images', 'staffscout' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'staffscout_mikado_meta_boxes_map', 'staffscout_mikado_map_post_gallery_meta', 21 );
}
