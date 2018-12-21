<?php

if ( ! function_exists( 'staffscout_mikado_load_search' ) ) {
	function staffscout_mikado_load_search() {
		$search_type_meta = staffscout_mikado_options()->getOptionValue( 'search_type' );
		$search_type      = ! empty( $search_type_meta ) ? $search_type_meta : 'fullscreen';
		
		if ( staffscout_mikado_active_widget( false, false, 'mkdf_search_opener' ) ) {
			include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/search/types/' . $search_type . '.php';
		}
	}
	
	add_action( 'init', 'staffscout_mikado_load_search' );
}

if ( ! function_exists( 'staffscout_mikado_get_holder_params_search' ) ) {
	/**
	 * Function which return holder class and holder inner class for blog pages
	 */
	function staffscout_mikado_get_holder_params_search() {
		$search_title = array();
		
		$layout = staffscout_mikado_options()->getOptionValue( 'search_page_layout' );
		if ( $layout == 'in-grid' ) {
			$search_title['holder'] = 'mkdf-container';
			$search_title['inner']  = 'mkdf-container-inner clearfix';
		} else {
			$search_title['holder'] = 'mkdf-full-width';
			$search_title['inner']  = 'mkdf-full-width-inner';
		}
		
		/**
		 * Available parameters for holder params
		 * -holder
		 * -inner
		 */
		return apply_filters( 'staffscout_mikado_search_holder_params', $search_title );
	}
}

if ( ! function_exists( 'staffscout_mikado_get_search_page' ) ) {
	function staffscout_mikado_get_search_page() {
		$sidebar_layout = staffscout_mikado_sidebar_layout();
		
		$params = array(
			'sidebar_layout' => $sidebar_layout
		);
		
		staffscout_mikado_get_module_template_part( 'templates/holder', 'search', '', $params );
	}
}

if ( ! function_exists( 'staffscout_mikado_get_search_page_layout' ) ) {
	/**
	 * Function which create query for blog lists
	 */
	function staffscout_mikado_get_search_page_layout() {
		global $wp_query;
		$path   = apply_filters( 'staffscout_mikado_search_page_path', 'templates/page' );
		$type   = apply_filters( 'staffscout_mikado_search_page_layout', 'default' );
		$module = apply_filters( 'staffscout_mikado_search_page_module', 'search' );
		$plugin = apply_filters( 'staffscout_mikado_search_page_plugin_override', false );
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$params = array(
			'type'          => $type,
			'query'         => $wp_query,
			'paged'         => $paged,
			'max_num_pages' => staffscout_mikado_get_max_number_of_pages(),
		);
		
		$params = apply_filters( 'staffscout_mikado_search_page_params', $params );
		
		staffscout_mikado_get_module_template_part( $path . '/' . $type, $module, '', $params, $plugin );
	}
}

if ( ! function_exists( 'staffscout_mikado_get_search_title' ) ) {
    /**
     * Function which return holder class and holder inner class for blog pages
     */
    function staffscout_mikado_get_search_title() {
        $search_title = staffscout_mikado_options()->getOptionValue( 'search_title' );

        return $search_title;
    }
}

if ( ! function_exists( 'staffscout_mikado_get_search_subtitle' ) ) {
    /**
     * Function which return holder class and holder inner class for blog pages
     */
    function staffscout_mikado_get_search_subtitle() {
        $search_subtitle = staffscout_mikado_options()->getOptionValue( 'search_subtitle' );

        return $search_subtitle;
    }
}

if (!function_exists('staffscout_mikado_register_fullscreen_search_botom_sidebar')) {
    function staffscout_mikado_register_fullscreen_search_botom_sidebar() {

        register_sidebar(
            array(
                'id'            => 'fullscreen_search_botom',
                'name'          => esc_html__('Fullscreen Search Bottom', 'staffscout'),
                'description'   => esc_html__('Widgets added here will appear in the bottom of fullscreen search', 'staffscout'),
                'before_widget' => '<div id="%1$s" class="widget mkdf-fullscreen-search-bottom %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                'after_title'   => '</h5></div>'
            )
        );
    }

    add_action('widgets_init', 'staffscout_mikado_register_fullscreen_search_botom_sidebar');
}