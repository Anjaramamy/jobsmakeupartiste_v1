<?php

if ( ! function_exists( 'staffscout_mikado_map_general_meta' ) ) {
	function staffscout_mikado_map_general_meta() {
		
		$general_meta_box = staffscout_mikado_add_meta_box(
			array(
				'scope' => apply_filters( 'staffscout_mikado_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'General', 'staffscout' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'staffscout' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'staffscout' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'staffscout' ),
				'parent'        => $general_meta_box
			)
		);
		
		$mkdf_content_padding_group = staffscout_mikado_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Style', 'staffscout' ),
				'description' => esc_html__( 'Define styles for Content area', 'staffscout' ),
				'parent'      => $general_meta_box
			)
		);
		
			$mkdf_content_padding_row = staffscout_mikado_add_admin_row(
				array(
					'name'   => 'mkdf_content_padding_row',
					'next'   => true,
					'parent' => $mkdf_content_padding_group
				)
			);
		
				staffscout_mikado_add_meta_box_field(
					array(
						'name'   => 'mkdf_page_content_top_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Top Padding', 'staffscout' ),
						'parent' => $mkdf_content_padding_row,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'name'    => 'mkdf_page_content_top_padding_mobile',
						'type'    => 'selectsimple',
						'label'   => esc_html__( 'Set this top padding for mobile header', 'staffscout' ),
						'parent'  => $mkdf_content_padding_row,
						'options' => staffscout_mikado_get_yes_no_select_array( false )
					)
				);
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_page_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'staffscout' ),
				'description' => esc_html__( 'Choose background color for page content', 'staffscout' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'    => 'mkdf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'staffscout' ),
				'parent'  => $general_meta_box,
				'options' => staffscout_mikado_get_yes_no_select_array(),
				'args'    => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#mkdf_boxed_container_meta',
						'no'  => '#mkdf_boxed_container_meta',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#mkdf_boxed_container_meta'
					)
				)
			)
		);
		
			$boxed_container_meta = staffscout_mikado_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'hidden_property' => 'mkdf_boxed_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'staffscout' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'staffscout' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'staffscout' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'staffscout' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'staffscout' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'staffscout' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'name'          => 'mkdf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => 'fixed',
						'label'         => esc_html__( 'Background Image Attachment', 'staffscout' ),
						'description'   => esc_html__( 'Choose background image attachment', 'staffscout' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'staffscout' ),
							'fixed'  => esc_html__( 'Fixed', 'staffscout' ),
							'scroll' => esc_html__( 'Scroll', 'staffscout' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'staffscout' ),
				'parent'        => $general_meta_box,
				'options'       => staffscout_mikado_get_yes_no_select_array(),
				'args'    => array(
					'dependence'    => true,
					'hide'          => array(
						''    => '#mkdf_mkdf_paspartu_container_meta',
						'no'  => '#mkdf_mkdf_paspartu_container_meta',
						'yes' => ''
					),
					'show'          => array(
						''    => '',
						'no'  => '',
						'yes' => '#mkdf_mkdf_paspartu_container_meta'
					)
				)
			)
		);
		
			$paspartu_container_meta = staffscout_mikado_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'mkdf_paspartu_container_meta',
					'hidden_property' => 'mkdf_paspartu_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'staffscout' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'staffscout' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'staffscout' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'staffscout' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'staffscout' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'staffscout' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				staffscout_mikado_add_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'mkdf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'staffscout' ),
						'options'       => staffscout_mikado_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Width Layout - begin **********************/
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'staffscout' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'staffscout' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'staffscout' ),
					'mkdf-grid-1100' => esc_html__( '1100px', 'staffscout' ),
					'mkdf-grid-1300' => esc_html__( '1300px', 'staffscout' ),
					'mkdf-grid-1200' => esc_html__( '1200px', 'staffscout' ),
					'mkdf-grid-1000' => esc_html__( '1000px', 'staffscout' ),
					'mkdf-grid-800'  => esc_html__( '800px', 'staffscout' )
				)
			)
		);
		
		/***************** Content Width Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'          => 'mkdf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'staffscout' ),
				'parent'        => $general_meta_box,
				'options'       => staffscout_mikado_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#mkdf_page_transitions_container_meta',
						'no'  => '#mkdf_page_transitions_container_meta',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#mkdf_page_transitions_container_meta'
					)
				)
			)
		);
		
			$page_transitions_container_meta = staffscout_mikado_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'page_transitions_container_meta',
					'hidden_property' => 'mkdf_smooth_page_transitions_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				staffscout_mikado_add_meta_box_field(
					array(
						'name'        => 'mkdf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'staffscout' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'staffscout' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => staffscout_mikado_get_yes_no_select_array(),
						'args'        => array(
							'dependence' => true,
							'hide'       => array(
								''    => '#mkdf_page_transition_preloader_container_meta',
								'no'  => '#mkdf_page_transition_preloader_container_meta',
								'yes' => ''
							),
							'show'       => array(
								''    => '',
								'no'  => '',
								'yes' => '#mkdf_page_transition_preloader_container_meta'
							)
						)
					)
				);
				
				$page_transition_preloader_container_meta = staffscout_mikado_add_admin_container(
					array(
						'parent'          => $page_transitions_container_meta,
						'name'            => 'page_transition_preloader_container_meta',
						'hidden_property' => 'mkdf_page_transition_preloader_meta',
						'hidden_values'   => array(
							'',
							'no'
						)
					)
				);
				
					staffscout_mikado_add_meta_box_field(
						array(
							'name'   => 'mkdf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'staffscout' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = staffscout_mikado_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'staffscout' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'staffscout' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = staffscout_mikado_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					staffscout_mikado_add_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'mkdf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'staffscout' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'staffscout' ),
								'staffscout'        		=> esc_html__( 'Staff Scout', 'staffscout' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'staffscout' ),
								'pulse'                 => esc_html__( 'Pulse', 'staffscout' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'staffscout' ),
								'cube'                  => esc_html__( 'Cube', 'staffscout' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'staffscout' ),
								'stripes'               => esc_html__( 'Stripes', 'staffscout' ),
								'wave'                  => esc_html__( 'Wave', 'staffscout' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'staffscout' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'staffscout' ),
								'atom'                  => esc_html__( 'Atom', 'staffscout' ),
								'clock'                 => esc_html__( 'Clock', 'staffscout' ),
								'mitosis'               => esc_html__( 'Mitosis', 'staffscout' ),
								'lines'                 => esc_html__( 'Lines', 'staffscout' ),
								'fussion'               => esc_html__( 'Fussion', 'staffscout' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'staffscout' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'staffscout' )
							)
						)
					);
					
					staffscout_mikado_add_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'mkdf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'staffscout' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					staffscout_mikado_add_meta_box_field(
						array(
							'name'        => 'mkdf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'staffscout' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'staffscout' ),
							'options'     => staffscout_mikado_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		staffscout_mikado_add_meta_box_field(
			array(
				'name'        => 'mkdf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'staffscout' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'staffscout' ),
				'parent'      => $general_meta_box,
				'options'     => staffscout_mikado_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'staffscout_mikado_meta_boxes_map', 'staffscout_mikado_map_general_meta', 10 );
}