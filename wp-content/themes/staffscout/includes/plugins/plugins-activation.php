<?php

if(!function_exists('staffscout_mikado_register_required_plugins')) {
    /**
     * Registers theme required and optional plugins. Hooks to tgmpa_register hook
     */
    function staffscout_mikado_register_required_plugins() {
        $plugins = array(
            array(
                'name'               => esc_html__('WPBakery Visual Composer', 'staffscout'),
                'slug'               => 'js_composer',
                'source'             => get_template_directory().'/includes/plugins/js_composer.zip',
                'version'            => '5.4.5',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Revolution Slider', 'staffscout'),
                'slug'               => 'revslider',
                'source'             => get_template_directory().'/includes/plugins/revslider.zip',
                'version'            => '5.4.6.4',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Mikado Core', 'staffscout'),
                'slug'               => 'mkdf-core',
                'source'             => get_template_directory().'/includes/plugins/mkdf-core.zip',
                'version'            => '1.0',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'                  => esc_html__('Envato Market', 'kamera'),
                'slug'                  => 'envato-market', // The plugin slug (typically the folder name).
                'source'                => get_template_directory() . '/includes/plugins/envato-market.zip', // The plugin source.
                'required'              => true,
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'               => esc_html__('Mikado Instagram Feed', 'staffscout'),
                'slug'               => 'mkdf-instagram-feed',
                'source'             => get_template_directory().'/includes/plugins/mkdf-instagram-feed.zip',
                'version'            => '1.0',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Mikado Twitter Feed', 'staffscout'),
                'slug'               => 'mkdf-twitter-feed',
                'source'             => get_template_directory().'/includes/plugins/mkdf-twitter-feed.zip',
                'version'            => '1.0',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
	        array(
		        'name'               => esc_html__('Mikado Membership', 'staffscout'),
		        'slug'               => 'mkdf-membership',
		        'source'             => get_template_directory().'/includes/plugins/mkdf-membership.zip',
		        'version'            => '1.0',
		        'required'           => true,
		        'force_activation'   => false,
		        'force_deactivation' => false
	        ),
	        array(
		        'name'               => esc_html__('Mikado Listing', 'staffscout'),
		        'slug'               => 'mkdf-listing',
		        'source'             => get_template_directory().'/includes/plugins/mkdf-listing.zip',
		        'version'            => '1.0.1',
		        'required'           => true,
		        'force_activation'   => false,
		        'force_deactivation' => false
	        ),
	        array(
		        'name'         => esc_html__( 'WooCommerce', 'staffscout' ),
		        'slug'         => 'woocommerce',
		        'external_url' => 'https://wordpress.org/plugins/woocommerce/',
		        'required'     => false
	        ),
	        array(
		        'name'         => esc_html__( 'Contact Form 7', 'staffscout' ),
		        'slug'         => 'contact-form-7',
		        'external_url' => 'https://wordpress.org/plugins/contact-form-7/',
		        'required'     => false
	        ),
            array(
                'name'         => esc_html__( 'WP Job Manager', 'staffscout' ),
                'slug'         => 'wp-job-manager',
                'external_url' => 'https://wordpress.org/plugins/wp-job-manager/',
                'required'     => false
            ),
            array(
                'name'         => esc_html__( 'Regions for WP Job Manager', 'staffscout' ),
                'slug'         => 'wp-job-manager-locations',
                'external_url' => 'https://wordpress.org/plugins/wp-job-manager-locations/',
                'required'     => false
            )
        );

        $config = array(
            'domain'           => 'staffscout',
            'default_path'     => '',
            'parent_slug' 	   => 'themes.php',
            'capability' 	   => 'edit_theme_options',
            'menu'             => 'install-required-plugins',
            'has_notices'      => true,
            'is_automatic'     => false,
            'message'          => '',
            'strings'          => array(
                'page_title'                      => esc_html__('Install Required Plugins', 'staffscout'),
                'menu_title'                      => esc_html__('Install Plugins', 'staffscout'),
                'installing'                      => esc_html__('Installing Plugin: %s', 'staffscout'),
                'oops'                            => esc_html__('Something went wrong with the plugin API.', 'staffscout'),
                'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'staffscout'),
                'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'staffscout'),
                'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'staffscout'),
                'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'staffscout'),
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'staffscout'),
                'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'staffscout'),
                'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'staffscout'),
                'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'staffscout'),
                'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'staffscout'),
                'activate_link'                   => _n_noop('Activate installed plugin', 'Activate installed plugins', 'staffscout'),
                'return'                          => esc_html__('Return to Required Plugins Installer', 'staffscout'),
                'plugin_activated'                => esc_html__('Plugin activated successfully.', 'staffscout'),
                'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'staffscout'),
                'nag_type'                        => 'updated'
            )
        );

        tgmpa($plugins, $config);
    }

    add_action('tgmpa_register', 'staffscout_mikado_register_required_plugins');
}