<?php
/**
 * Options map file
 */

if ( ! function_exists( 'mkdf_membership_membership_options_map' ) ) {
	function mkdf_membership_membership_options_map( $page ) {
		
		if ( mkdf_membership_theme_installed() ) {
			
			$panel_social_login = staffscout_mikado_add_admin_panel(
				array(
					'page'  => $page,
					'name'  => 'panel_social_login',
					'title' => esc_html__( 'Enable Social Login', 'mkdf-membership' )
				)
			);
			
			staffscout_mikado_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_social_login',
					'default_value' => 'no',
					'label'         => esc_html__( 'Enable Social Login', 'mkdf-membership' ),
					'description'   => esc_html__( 'Enabling this option will allow login from social networks of your choice', 'mkdf-membership' ),
					'args'          => array(
						'dependence'             => true,
						'dependence_hide_on_yes' => '',
						'dependence_show_on_yes' => '#mkdf_panel_enable_social_login'
					),
					'parent'        => $panel_social_login
				)
			);
			
			$panel_enable_social_login = staffscout_mikado_add_admin_panel(
				array(
					'page'            => $page,
					'name'            => 'panel_enable_social_login',
					'title'           => esc_html__( 'Enable Login via', 'mkdf-membership' ),
					'hidden_property' => 'enable_social_login',
					'hidden_value'    => 'no'
				)
			);
			
			staffscout_mikado_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_facebook_social_login',
					'default_value' => 'no',
					'label'         => esc_html__( 'Facebook', 'mkdf-membership' ),
					'description'   => esc_html__( 'Enabling this option will allow login via Facebook', 'mkdf-membership' ),
					'args'          => array(
						'dependence'             => true,
						'dependence_hide_on_yes' => '',
						'dependence_show_on_yes' => '#mkdf_enable_facebook_social_login_container'
					),
					'parent'        => $panel_enable_social_login
				)
			);
			
			$enable_facebook_social_login_container = staffscout_mikado_add_admin_container(
				array(
					'name'            => 'enable_facebook_social_login_container',
					'hidden_property' => 'enable_facebook_social_login',
					'hidden_value'    => 'no',
					'parent'          => $panel_enable_social_login
				)
			);
			
			staffscout_mikado_add_admin_field(
				array(
					'type'          => 'text',
					'name'          => 'enable_facebook_login_fbapp_id',
					'default_value' => '',
					'label'         => esc_html__( 'Facebook App ID', 'mkdf-membership' ),
					'description'   => esc_html__( 'Copy your application ID form created Facebook Application', 'mkdf-membership' ),
					'parent'        => $enable_facebook_social_login_container
				)
			);
			
			staffscout_mikado_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_google_social_login',
					'default_value' => 'no',
					'label'         => esc_html__( 'Google+', 'mkdf-membership' ),
					'description'   => esc_html__( 'Enabling this option will allow login via Google+', 'mkdf-membership' ),
					'args'          => array(
						'dependence'             => true,
						'dependence_hide_on_yes' => '',
						'dependence_show_on_yes' => '#mkdf_enable_google_social_login_container'
					),
					'parent'        => $panel_enable_social_login
				)
			);
			
			$enable_google_social_login_container = staffscout_mikado_add_admin_container(
				array(
					'name'            => 'enable_google_social_login_container',
					'hidden_property' => 'enable_google_social_login',
					'hidden_value'    => 'no',
					'parent'          => $panel_enable_social_login
				)
			);
			
			staffscout_mikado_add_admin_field(
				array(
					'type'          => 'text',
					'name'          => 'enable_google_login_client_id',
					'default_value' => '',
					'label'         => esc_html__( 'Client ID', 'mkdf-membership' ),
					'description'   => esc_html__( 'Copy your Client ID form created Google Application', 'mkdf-membership' ),
					'parent'        => $enable_google_social_login_container
				)
			);
		}
	}
	
	add_action( 'staffscout_mikado_social_options', 'mkdf_membership_membership_options_map' );
}
