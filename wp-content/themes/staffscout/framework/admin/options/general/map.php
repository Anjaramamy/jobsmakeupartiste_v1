<?php

if ( ! function_exists( 'staffscout_mikado_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function staffscout_mikado_general_options_map() {
		
		staffscout_mikado_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'staffscout' ),
				'icon'  => 'fa fa-institution'
			)
		);

        $panel_logo = staffscout_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_logo',
                'title' => esc_html__( 'Branding', 'staffscout' )
            )
        );

        staffscout_mikado_add_admin_field(
            array(
                'parent'        => $panel_logo,
                'type'          => 'yesno',
                'name'          => 'hide_logo',
                'default_value' => 'no',
                'label'         => esc_html__( 'Hide Logo', 'staffscout' ),
                'description'   => esc_html__( 'Enabling this option will hide logo image', 'staffscout' ),
                'args'          => array(
                    "dependence"             => true,
                    "dependence_hide_on_yes" => "#mkdf_hide_logo_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_logo_container = staffscout_mikado_add_admin_container(
            array(
                'parent'          => $panel_logo,
                'name'            => 'hide_logo_container',
                'hidden_property' => 'hide_logo',
                'hidden_value'    => 'yes'
            )
        );

        staffscout_mikado_add_admin_field(
            array(
                'name'          => 'logo_image',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
                'label'         => esc_html__( 'Logo Image - Default', 'staffscout' ),
                'parent'        => $hide_logo_container
            )
        );

        staffscout_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_dark',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
                'label'         => esc_html__( 'Logo Image - Dark', 'staffscout' ),
                'parent'        => $hide_logo_container
            )
        );

        staffscout_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_light',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT . "/img/logo_white.png",
                'label'         => esc_html__( 'Logo Image - Light', 'staffscout' ),
                'parent'        => $hide_logo_container
            )
        );

        staffscout_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_sticky',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
                'label'         => esc_html__( 'Logo Image - Sticky', 'staffscout' ),
                'parent'        => $hide_logo_container
            )
        );

        staffscout_mikado_add_admin_field(
            array(
                'name'          => 'logo_image_mobile',
                'type'          => 'image',
                'default_value' => MIKADO_ASSETS_ROOT . "/img/logo.png",
                'label'         => esc_html__( 'Logo Image - Mobile', 'staffscout' ),
                'parent'        => $hide_logo_container
            )
        );
		
		$panel_design_style = staffscout_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Appearance', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'staffscout' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'staffscout' ),
				'parent'        => $panel_design_style
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'staffscout' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_additional_google_fonts_container"
				)
			)
		);
		
		$additional_google_fonts_container = staffscout_mikado_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'additional_google_fonts_container',
				'hidden_property' => 'additional_google_fonts',
				'hidden_value'    => 'no'
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'staffscout' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'staffscout' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'staffscout' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'staffscout' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'staffscout' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'staffscout' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'staffscout' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'staffscout' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'staffscout' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'staffscout' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'staffscout' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'staffscout' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'staffscout' ),
					'100i' => esc_html__( '100 Thin Italic', 'staffscout' ),
					'200'  => esc_html__( '200 Extra-Light', 'staffscout' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'staffscout' ),
					'300'  => esc_html__( '300 Light', 'staffscout' ),
					'300i' => esc_html__( '300 Light Italic', 'staffscout' ),
					'400'  => esc_html__( '400 Regular', 'staffscout' ),
					'400i' => esc_html__( '400 Regular Italic', 'staffscout' ),
					'500'  => esc_html__( '500 Medium', 'staffscout' ),
					'500i' => esc_html__( '500 Medium Italic', 'staffscout' ),
					'600'  => esc_html__( '600 Semi-Bold', 'staffscout' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'staffscout' ),
					'700'  => esc_html__( '700 Bold', 'staffscout' ),
					'700i' => esc_html__( '700 Bold Italic', 'staffscout' ),
					'800'  => esc_html__( '800 Extra-Bold', 'staffscout' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'staffscout' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'staffscout' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'staffscout' )
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'staffscout' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'staffscout' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'staffscout' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'staffscout' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'staffscout' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'staffscout' ),
					'greek'        => esc_html__( 'Greek', 'staffscout' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'staffscout' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'staffscout' )
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'staffscout' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #00bbb3', 'staffscout' ),
				'parent'      => $panel_design_style
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'staffscout' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'staffscout' ),
				'parent'      => $panel_design_style
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'staffscout' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'staffscout' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Passepartout Layout - begin **********************/
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'staffscout' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_boxed_container"
				)
			)
		);
		
			$boxed_container = staffscout_mikado_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'hidden_property' => 'boxed',
					'hidden_value'    => 'no'
				)
			);
		
				staffscout_mikado_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'staffscout' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'staffscout' ),
						'parent'      => $boxed_container
					)
				);
				
				staffscout_mikado_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'staffscout' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'staffscout' ),
						'parent'      => $boxed_container
					)
				);
				
				staffscout_mikado_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'staffscout' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'staffscout' ),
						'parent'      => $boxed_container
					)
				);
				
				staffscout_mikado_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'staffscout' ),
						'description'   => esc_html__( 'Choose background image attachment', 'staffscout' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'staffscout' ),
							'fixed'  => esc_html__( 'Fixed', 'staffscout' ),
							'scroll' => esc_html__( 'Scroll', 'staffscout' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'staffscout' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_paspartu_container"
				)
			)
		);
		
			$paspartu_container = staffscout_mikado_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'hidden_property' => 'paspartu',
					'hidden_value'    => 'no'
				)
			);
		
				staffscout_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'staffscout' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'staffscout' ),
						'parent'      => $paspartu_container
					)
				);
				
				staffscout_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'staffscout' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'staffscout' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				staffscout_mikado_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'staffscout' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'staffscout' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				staffscout_mikado_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'staffscout' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'staffscout' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'staffscout' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'mkdf-grid-1100' => esc_html__( '1100px - default', 'staffscout' ),
					'mkdf-grid-1300' => esc_html__( '1300px', 'staffscout' ),
					'mkdf-grid-1200' => esc_html__( '1200px', 'staffscout' ),
					'mkdf-grid-1000' => esc_html__( '1000px', 'staffscout' ),
					'mkdf-grid-800'  => esc_html__( '800px', 'staffscout' )
				)
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'staffscout' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'staffscout' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = staffscout_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Behavior', 'staffscout' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'staffscout' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'staffscout' ),
				'parent'        => $panel_settings,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkdf_page_transitions_container"
				)
			)
		);
		
			$page_transitions_container = staffscout_mikado_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'hidden_property' => 'smooth_page_transitions',
					'hidden_value'    => 'no'
				)
			);
		
				staffscout_mikado_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'staffscout' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'staffscout' ),
						'parent'        => $page_transitions_container,
						'args'          => array(
							"dependence"             => true,
							"dependence_hide_on_yes" => "",
							"dependence_show_on_yes" => "#mkdf_page_transition_preloader_container"
						)
					)
				);
				
				$page_transition_preloader_container = staffscout_mikado_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'hidden_property' => 'page_transition_preloader',
						'hidden_value'    => 'no'
					)
				);
		
		
					staffscout_mikado_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'staffscout' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = staffscout_mikado_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'staffscout' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'staffscout' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = staffscout_mikado_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					staffscout_mikado_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'staffscout' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
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
					
					staffscout_mikado_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'staffscout' ),
							'parent'        => $row_pt_spinner_animation
						)
					);
					
					staffscout_mikado_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'staffscout' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'staffscout' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'staffscout' ),
				'parent'        => $panel_settings
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'staffscout' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'staffscout' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = staffscout_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'staffscout' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'staffscout' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = staffscout_mikado_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'staffscout' )
			)
		);
		
		staffscout_mikado_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'staffscout' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'staffscout' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'staffscout_mikado_options_map', 'staffscout_mikado_general_options_map', 1 );
}

if ( ! function_exists( 'staffscout_mikado_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function staffscout_mikado_page_general_style( $style ) {
		$current_style = '';
		$page_id       = staffscout_mikado_get_page_id();
		$class_prefix  = staffscout_mikado_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = staffscout_mikado_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = staffscout_mikado_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = staffscout_mikado_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = staffscout_mikado_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.mkdf-boxed .mkdf-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= staffscout_mikado_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';
		
		$paspartu_color = staffscout_mikado_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = staffscout_mikado_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( staffscout_mikado_string_ends_with( $paspartu_width, '%' ) || staffscout_mikado_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.mkdf-paspartu-enabled .mkdf-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= staffscout_mikado_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		$paspartu_responsive_width = staffscout_mikado_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( staffscout_mikado_string_ends_with( $paspartu_responsive_width, '%' ) || staffscout_mikado_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';
			}
		}
		
		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . staffscout_mikado_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'staffscout_mikado_add_page_custom_style', 'staffscout_mikado_page_general_style' );
}