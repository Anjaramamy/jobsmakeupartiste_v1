<?php

if ( ! function_exists( 'staffscout_mikado_include_header_types' ) ) {
	/**
	 * Load's all header types by going through all folders that are placed directly in header types folder
	 */
	function staffscout_mikado_include_header_types() {
		foreach ( glob( MIKADO_FRAMEWORK_HEADER_ROOT_DIR . '/types/*/load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'init', 'staffscout_mikado_include_header_types', 0 ); // 0 is set so we can be able to register widgets for header types because of widget_ini action
}

if ( ! function_exists( 'staffscout_mikado_include_header_types_before_load' ) ) {
	/**
	 * Load's all header types before load files by going through all folders that are placed directly in header types folder.
	 * Functions from this files before-load are used to set all hooks and variables before global options map are init
	 */
	function staffscout_mikado_include_header_types_before_load() {
		foreach ( glob( MIKADO_FRAMEWORK_HEADER_ROOT_DIR . '/types/*/before-load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'staffscout_mikado_options_map', 'staffscout_mikado_include_header_types_before_load', 1 ); // 1 is set to just be before header option map init
}

if ( ! function_exists( 'staffscout_mikado_include_header_types_after_load' ) ) {
	/**
	 * Load's all header types after load files by going through all folders that are placed directly in header types folder.
	 * Functions from this files after-load are used to set all hooks that are used for header types options and template files
	 */
	function staffscout_mikado_include_header_types_after_load() {
		foreach ( glob( MIKADO_FRAMEWORK_HEADER_ROOT_DIR . '/types/*/after-load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'wp', 'staffscout_mikado_include_header_types_after_load', 11 ); // 11 is set to be after wp query loaded to be sure that object id is set
}

if ( ! function_exists( 'staffscout_mikado_include_custom_walker_navigation_for_header_types' ) ) {
	/**
	 * Load's all custom walkers navigation from header types folder
	 */
	function staffscout_mikado_include_custom_walker_navigation_for_header_types() {
		foreach ( glob( MIKADO_FRAMEWORK_HEADER_ROOT_DIR . '/types/*/nav-menu/*.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'staffscout_mikado_include_custom_walkers_nav', 'staffscout_mikado_include_custom_walker_navigation_for_header_types' );
}

if ( ! function_exists( 'staffscout_mikado_header_register_main_navigation' ) ) {
	/**
	 * Registers main navigation
	 */
	function staffscout_mikado_header_register_main_navigation() {
		$headers_menu_array = apply_filters( 'staffscout_mikado_register_headers_menu', array( 'main-navigation' => esc_html__( 'Main Navigation', 'staffscout' ) ) );
		
		register_nav_menus( $headers_menu_array );
	}
	
	add_action( 'init', 'staffscout_mikado_header_register_main_navigation' );
}

if ( ! function_exists( 'staffscout_mikado_header_widget_areas' ) ) {
	/**
	 * Registers widget areas for header types
	 */
	function staffscout_mikado_header_widget_areas() {
		register_sidebar(
			array(
				'id'            => 'mkdf-header-widget-logo-area',
				'name'          => esc_html__( 'Header Widget Logo Area', 'staffscout' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-header-widget-logo-area">',
				'after_widget'  => '</div>',
				'description'   => esc_html__( 'Widgets added here will appear in the logo area', 'staffscout' )
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'mkdf-header-widget-menu-area',
				'name'          => esc_html__( 'Header Widget Menu Area', 'staffscout' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s mkdf-header-widget-menu-area">',
				'after_widget'  => '</div>',
				'description'   => esc_html__( 'Widgets added here will appear in the menu area', 'staffscout' )
			)
		);
	}
	
	add_action( 'widgets_init', 'staffscout_mikado_header_widget_areas' );
}

if ( ! function_exists( 'staffscout_mikado_get_header_type_meta_values' ) ) {
	/**
	 * Function which get all meta values from database for header types
	 */
	function staffscout_mikado_get_header_type_meta_values() {
		global $wpdb;
		global $mkdf_header_types_values;
		
		if ( staffscout_mikado_is_wpml_installed() ) {
			$lang = ICL_LANGUAGE_CODE;
			
			$sql = "SELECT pm.meta_value
					FROM {$wpdb->prefix}postmeta pm
					LEFT JOIN {$wpdb->prefix}posts p ON p.ID = pm.post_id
					LEFT JOIN {$wpdb->prefix}icl_translations icl_t ON icl_t.element_id = p.ID
					WHERE pm.meta_key = 'mkdf_header_type_meta'
					AND icl_t.language_code='$lang'";
		} else {
			$sql = "SELECT pm.meta_value
					FROM {$wpdb->prefix}postmeta pm
					WHERE pm.meta_key = 'mkdf_header_type_meta'";
		}
		
		$results = $wpdb->get_results( $sql, ARRAY_A );
		
		if ( ! ( is_array( $results ) && count( $results ) ) ) {
			$mkdf_header_types_values = false;
		} else {
			$results_array = array();
			foreach ( $results as $result ) {
				foreach ( $result as $value ) {
					$results_array[] = $value;
				}
			}
			
			$mkdf_header_types_values = $results_array;
		}
	}
	
	add_action( 'after_setup_theme', 'staffscout_mikado_get_header_type_meta_values', 2 ); // privileges 2 is set because load.php files for modules are init with privileges 1
}

if ( ! function_exists( 'staffscout_mikado_check_is_header_type_enabled' ) ) {
	/**
	 * This function check is forwarded header type enabled in global option or meta boxes option
	 */
	function staffscout_mikado_check_is_header_type_enabled( $header_type = '', $page_id = '' ) {
		global $mkdf_header_types_values;
		$per_page_header_types = $mkdf_header_types_values;
		
		if ( ! empty( $page_id ) ) {
			$global_header_type = staffscout_mikado_get_meta_field_intersect( 'header_type', $page_id );
		} else {
			$global_header_type = staffscout_mikado_options()->getOptionValue( 'header_type' );
		}
		
		if ( ! empty( $per_page_header_types ) && empty( $page_id ) ) {
			return in_array( $header_type, $per_page_header_types ) || $header_type === $global_header_type;
		} else {
			return $global_header_type === $header_type;
		}
	}
}