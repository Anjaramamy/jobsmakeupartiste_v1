<?php

if ( ! function_exists( 'staffscout_mikado_theme_version_class' ) ) {
	/**
	 * Function that adds classes on body for version of theme
	 */
	function staffscout_mikado_theme_version_class( $classes ) {
		$current_theme = wp_get_theme();
		
		//is child theme activated?
		if ( $current_theme->parent() ) {
			//add child theme version
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-child-ver-' . $current_theme->get( 'Version' );
			
			//get parent theme
			$current_theme = $current_theme->parent();
		}
		
		if ( $current_theme->exists() && $current_theme->get( 'Version' ) != '' ) {
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-ver-' . $current_theme->get( 'Version' );
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'staffscout_mikado_theme_version_class' );
}

if ( ! function_exists( 'staffscout_mikado_boxed_class' ) ) {
	/**
	 * Function that adds classes on body for boxed layout
	 */
	function staffscout_mikado_boxed_class( $classes ) {
		$allow_boxed_layout = true;
		$allow_boxed_layout = apply_filters( 'staffscout_mikado_allow_content_boxed_layout', $allow_boxed_layout );
		
		if ( $allow_boxed_layout && staffscout_mikado_get_meta_field_intersect( 'boxed' ) === 'yes' ) {
			$classes[] = 'mkdf-boxed';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'staffscout_mikado_boxed_class' );
}

if ( ! function_exists( 'staffscout_mikado_paspartu_class' ) ) {
	/**
	 * Function that adds classes on body for paspartu layout
	 */
	function staffscout_mikado_paspartu_class( $classes ) {
		$id = staffscout_mikado_get_page_id();
		
		//is paspartu layout turned on?
		if ( staffscout_mikado_get_meta_field_intersect( 'paspartu', $id ) === 'yes' ) {
			$classes[] = 'mkdf-paspartu-enabled';
			
			if ( staffscout_mikado_get_meta_field_intersect( 'disable_top_paspartu', $id ) === 'yes' ) {
				$classes[] = 'mkdf-top-paspartu-disabled';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'staffscout_mikado_paspartu_class' );
}

if ( ! function_exists( 'staffscout_mikado_page_smooth_scroll_class' ) ) {
	/**
	 * Function that adds classes on body for page smooth scroll
	 */
	function staffscout_mikado_page_smooth_scroll_class( $classes ) {
		//is smooth scroll enabled enabled?
		if ( staffscout_mikado_options()->getOptionValue( 'page_smooth_scroll' ) == 'yes' ) {
			$classes[] = 'mkdf-smooth-scroll';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'staffscout_mikado_page_smooth_scroll_class' );
}

if ( ! function_exists( 'staffscout_mikado_smooth_page_transitions_class' ) ) {
	/**
	 * Function that adds classes on body for smooth page transitions
	 */
	function staffscout_mikado_smooth_page_transitions_class( $classes ) {
		$id = staffscout_mikado_get_page_id();
		
		if ( staffscout_mikado_get_meta_field_intersect( 'smooth_page_transitions', $id ) == 'yes' ) {
			$classes[] = 'mkdf-smooth-page-transitions';
			
			if ( staffscout_mikado_get_meta_field_intersect( 'page_transition_preloader', $id ) == 'yes' ) {
				$classes[] = 'mkdf-smooth-page-transitions-preloader';
			}
			
			if ( staffscout_mikado_get_meta_field_intersect( 'page_transition_fadeout', $id ) == 'yes' ) {
				$classes[] = 'mkdf-smooth-page-transitions-fadeout';
			}
			
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'staffscout_mikado_smooth_page_transitions_class' );
}

if ( ! function_exists( 'staffscout_mikado_content_initial_width_body_class' ) ) {
	/**
	 * Function that adds transparent content class to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with transparent content body class added
	 */
	function staffscout_mikado_content_initial_width_body_class( $classes ) {
		$initial_content_width = staffscout_mikado_get_meta_field_intersect( 'initial_content_width', staffscout_mikado_get_page_id() );
		
		if ( ! empty( $initial_content_width ) ) {
			$classes[] = $initial_content_width;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'staffscout_mikado_content_initial_width_body_class' );
}

if ( ! function_exists( 'staffscout_mikado_set_content_behind_header_class' ) ) {
	function staffscout_mikado_set_content_behind_header_class( $classes ) {
		$id = staffscout_mikado_get_page_id();
		
		if ( get_post_meta( $id, 'mkdf_page_content_behind_header_meta', true ) === 'yes' ) {
			$classes[] = 'mkdf-content-is-behind-header';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'staffscout_mikado_set_content_behind_header_class' );
}

if ( ! function_exists( 'staffscout_mikado_set_like_posts_enabled_class' ) ) {
    function staffscout_mikado_set_like_posts_enabled_class( $classes ) {
        if(staffscout_mikado_core_plugin_installed() && staffscout_mikado_options()->getOptionValue('enable_social_share') === 'yes' && staffscout_mikado_options()->getOptionValue('enable_social_share_on_post') === 'yes') {
            $classes[] = 'mkdf-like-posts-enabled';
        }

        return $classes;
    }

    add_filter( 'body_class', 'staffscout_mikado_set_like_posts_enabled_class' );
}