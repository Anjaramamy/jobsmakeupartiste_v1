<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = MIKADO_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'staffscout_mikado_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function staffscout_mikado_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'staffscout_mikado_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'staffscout_mikado_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function staffscout_mikado_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'staffscout' ),
				'value'      => array(
					esc_html__( 'Full Width', 'staffscout' ) => 'full-width',
					esc_html__( 'In Grid', 'staffscout' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Mikado Anchor ID', 'staffscout' ),
				'description' => esc_html__( 'For example "home"', 'staffscout' ),
				'group'       => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'staffscout' ),
				'group'      => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'staffscout' ),
				'group'      => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'staffscout' ),
				'value'       => array(
					esc_html__( 'Never', 'staffscout' )        => '',
					esc_html__( 'Below 1280px', 'staffscout' ) => '1280',
					esc_html__( 'Below 1024px', 'staffscout' ) => '1024',
					esc_html__( 'Below 768px', 'staffscout' )  => '768',
					esc_html__( 'Below 680px', 'staffscout' )  => '680',
					esc_html__( 'Below 480px', 'staffscout' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'staffscout' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Mikado Parallax Background Image', 'staffscout' ),
				'group'      => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Mikado Parallax Speed', 'staffscout' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'staffscout' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Mikado Parallax Section Height (px)', 'staffscout' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'staffscout' ),
				'value'      => array(
					esc_html__( 'Default', 'staffscout' ) => '',
					esc_html__( 'Left', 'staffscout' )    => 'left',
					esc_html__( 'Center', 'staffscout' )  => 'center',
					esc_html__( 'Right', 'staffscout' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'staffscout' ),
				'value'      => array(
					esc_html__( 'Full Width', 'staffscout' ) => 'full-width',
					esc_html__( 'In Grid', 'staffscout' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'staffscout' ),
				'group'      => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'staffscout' ),
				'group'      => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'staffscout' ),
				'value'       => array(
					esc_html__( 'Never', 'staffscout' )        => '',
					esc_html__( 'Below 1280px', 'staffscout' ) => '1280',
					esc_html__( 'Below 1024px', 'staffscout' ) => '1024',
					esc_html__( 'Below 768px', 'staffscout' )  => '768',
					esc_html__( 'Below 680px', 'staffscout' )  => '680',
					esc_html__( 'Below 480px', 'staffscout' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'staffscout' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'staffscout' ),
				'value'      => array(
					esc_html__( 'Default', 'staffscout' ) => '',
					esc_html__( 'Left', 'staffscout' )    => 'left',
					esc_html__( 'Center', 'staffscout' )  => 'center',
					esc_html__( 'Right', 'staffscout' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'staffscout' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( staffscout_mikado_revolution_slider_installed() ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Mikado Enable Passepartout', 'staffscout' ),
					'value'       => array_flip( staffscout_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Mikado Settings', 'staffscout' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Mikado Passepartout Size', 'staffscout' ),
					'value'       => array(
						esc_html__( 'Tiny', 'staffscout' )   => 'tiny',
						esc_html__( 'Small', 'staffscout' )  => 'small',
						esc_html__( 'Normal', 'staffscout' ) => 'normal',
						esc_html__( 'Large', 'staffscout' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'staffscout' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Side Passepartout', 'staffscout' ),
					'value'       => array_flip( staffscout_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'staffscout' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Top Passepartout', 'staffscout' ),
					'value'       => array_flip( staffscout_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'staffscout' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'staffscout_mikado_vc_row_map' );
}