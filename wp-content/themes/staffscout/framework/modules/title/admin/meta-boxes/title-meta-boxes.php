<?php

if ( ! function_exists( 'staffscout_mikado_get_title_types_meta_boxes' ) ) {
	function staffscout_mikado_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'staffscout_mikado_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'staffscout' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'staffscout_mikado_map_title_meta' ) ) {
	function staffscout_mikado_map_title_meta() {
		$title_type_meta_boxes = staffscout_mikado_get_title_types_meta_boxes();
		
		$title_meta_box = staffscout_mikado_add_meta_box(
			array(
				'scope' => apply_filters( 'staffscout_mikado_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Title', 'staffscout' ),
				'name'  => 'title_meta'
			)
		);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'staffscout' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'staffscout' ),
				'parent'        => $title_meta_box,
				'options'       => staffscout_mikado_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '',
						'no'  => '#mkdf_mkdf_show_title_area_meta_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '#mkdf_mkdf_show_title_area_meta_container',
						'no'  => '',
						'yes' => '#mkdf_mkdf_show_title_area_meta_container'
					)
				)
			)
		);
		
			$show_title_area_meta_container = staffscout_mikado_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'mkdf_show_title_area_meta_container',
					'hidden_property' => 'mkdf_show_title_area_meta',
					'hidden_value'    => 'no'
				)
			);
		
				staffscout_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'staffscout' ),
						'description'   => esc_html__( 'Choose title type', 'staffscout' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				staffscout_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'staffscout' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'staffscout' ),
						'options'       => staffscout_mikado_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'staffscout' ),
						'description' => esc_html__( 'Set a height for Title Area', 'staffscout' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'staffscout' ),
						'description' => esc_html__( 'Choose a background color for title area', 'staffscout' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'staffscout' ),
						'description' => esc_html__( 'Choose an Image for title area', 'staffscout' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				staffscout_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'staffscout' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'staffscout' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'staffscout' ),
							'hide'                => esc_html__( 'Hide Image', 'staffscout' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'staffscout' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'staffscout' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'staffscout' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'staffscout' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'staffscout' )
						)
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'staffscout' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'staffscout' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'staffscout' ),
							'header_bottom' => esc_html__( 'From Bottom of Header', 'staffscout' ),
							'window_top'    => esc_html__( 'From Window Top', 'staffscout' )
						)
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'staffscout' ),
						'options'       => staffscout_mikado_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'staffscout' ),
						'description' => esc_html__( 'Choose a color for title text', 'staffscout' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'staffscout' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'staffscout' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				staffscout_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'staffscout' ),
						'options'       => staffscout_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'staffscout' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'staffscout' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'staffscout_mikado_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'staffscout_mikado_meta_boxes_map', 'staffscout_mikado_map_title_meta', 60 );
}