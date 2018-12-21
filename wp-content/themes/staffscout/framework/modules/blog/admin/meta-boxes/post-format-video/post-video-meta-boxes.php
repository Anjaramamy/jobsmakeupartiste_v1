<?php

if ( ! function_exists( 'staffscout_mikado_map_post_video_meta' ) ) {
	function staffscout_mikado_map_post_video_meta() {
		$video_post_format_meta_box = staffscout_mikado_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'staffscout' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'staffscout' ),
				'description'   => esc_html__( 'Choose video type', 'staffscout' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'staffscout' ),
					'self'            => esc_html__( 'Self Hosted', 'staffscout' )
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'social_networks' => '#mkdf_mkdf_video_self_hosted_container',
						'self'            => '#mkdf_mkdf_video_embedded_container'
					),
					'show'       => array(
						'social_networks' => '#mkdf_mkdf_video_embedded_container',
						'self'            => '#mkdf_mkdf_video_self_hosted_container'
					)
				)
			)
		);
		
		$mkdf_video_embedded_container = staffscout_mikado_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'mkdf_video_embedded_container',
				'hidden_property' => 'mkdf_video_type_meta',
				'hidden_value'    => 'self'
			)
		);
		
		$mkdf_video_self_hosted_container = staffscout_mikado_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'mkdf_video_self_hosted_container',
				'hidden_property' => 'mkdf_video_type_meta',
				'hidden_value'    => 'social_networks'
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'staffscout' ),
				'description' => esc_html__( 'Enter Video URL', 'staffscout' ),
				'parent'      => $mkdf_video_embedded_container,
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'staffscout' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'staffscout' ),
				'parent'      => $mkdf_video_self_hosted_container,
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'staffscout' ),
				'description' => esc_html__( 'Enter video image', 'staffscout' ),
				'parent'      => $mkdf_video_self_hosted_container,
			)
		);
	}
	
	add_action( 'staffscout_mikado_meta_boxes_map', 'staffscout_mikado_map_post_video_meta', 22 );
}