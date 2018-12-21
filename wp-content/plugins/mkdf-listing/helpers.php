<?php

use MikadoListing\Archive;

if ( ! function_exists( 'mkdf_listing_is_wp_job_manager_installed' ) ) {
	/**
	 * check if is installed Wp Job Manager Plugin
	 */
	function mkdf_listing_is_wp_job_manager_installed() {
		return defined( 'JOB_MANAGER_VERSION' );
	}
}

if ( ! function_exists( 'mkdf_listing_is_wp_job_manager_resumes_installed' ) ) {
	/**
	 * check if is installed Wp Job Manager Plugin
	 */
	function mkdf_listing_is_wp_job_manager_resumes_installed() {
		return defined( 'RESUME_MANAGER_VERSION' );
	}
}

if ( ! function_exists( 'mkdf_listing_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function mkdf_listing_theme_installed() {
		return defined( 'MIKADO_ROOT' );
	}
}

if ( ! function_exists( 'mkdf_listing_is_wc_paid_listings_installed' ) ) {
	/**
	 * check if is installed WC Paid Listings Plugin
	 */
	function mkdf_listing_is_wc_paid_listings_installed() {
		return defined( 'JOB_MANAGER_WCPL_VERSION' );
	}
}

if ( ! function_exists( 'mkdf_listing_is_wp_job_manager_locations_installed' ) ) {
	/**
	 * check if is installed Wp Job Manager Regions Plugin
	 */
	function mkdf_listing_is_wp_job_manager_locations_installed() {
		return class_exists( 'Astoundify_Job_Manager_Regions' ) && mkdf_listing_is_wp_job_manager_installed();
	}
}

if ( ! function_exists( 'mkdf_listing_is_wp_job_manager_tags_installed' ) ) {
	/**
	 * check if is installed Wp Job Manager Tags Plugin
	 */
	function mkdf_listing_is_wp_job_manager_tags_installed() {
		return defined( 'JOB_MANAGER_TAGS_VERSION' );
	}
}

if ( ! function_exists( 'mkdf_listing_set_ajax_url' ) ) {
	/**
	 * load plugin ajax functionality
	 */
	function mkdf_listing_set_ajax_url() {
		if ( mkdf_listing_theme_installed() ) {
			echo '<script type="application/javascript">var MikadoListingAjaxUrl = "' . admin_url( 'admin-ajax.php' ) . '"</script>';
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'mkdf_listing_set_ajax_url' );
}

if ( ! function_exists( 'mkdf_listing_load_js_assets' ) ) {
	function mkdf_listing_load_js_assets() {
		$array_deps_css            = array();
		$array_deps_css_responsive = array();
		$array_deps_js             = array(
			'jquery',
			'underscore',
			'jquery-ui-autocomplete'
		);
		
		if ( mkdf_listing_theme_installed() ) {
			$array_deps_css[]            = 'staffscout_mikado_modules';
			$array_deps_css_responsive[] = 'staffscout_mikado_modules_responsive';
			$array_deps_js[]             = 'staffscout_mikado_modules';
			
			wp_enqueue_style( 'mkdf_listing_job_handle_wp_job_manager', MIKADO_LISTING_URL_PATH . 'job/assets/css/listing.min.css', $array_deps_css );
			if ( function_exists( 'staffscout_mikado_is_responsive_on' ) && staffscout_mikado_is_responsive_on() ) {
				wp_enqueue_style( 'mkdf_listing_job_handle_wp_job_manager_responsive', MIKADO_LISTING_URL_PATH . 'job/assets/css/listing-responsive.min.css', $array_deps_css_responsive );
			}
			
			wp_enqueue_style( 'mkdf_listing_resume_handle_wp_job_manager', MIKADO_LISTING_URL_PATH . 'resume/assets/css/resume.min.css', $array_deps_css );
			if ( function_exists( 'staffscout_mikado_is_responsive_on' ) && staffscout_mikado_is_responsive_on() ) {
				wp_enqueue_style( 'mkdf_listing_resume_handle_wp_job_manager_responsive', MIKADO_LISTING_URL_PATH . 'resume/assets/css/resume-responsive.min.css', $array_deps_css_responsive );
			}
			
			wp_enqueue_script( 'rangeslider', MIKADO_LISTING_URL_PATH . 'job/assets/js/plugins/rangeslider.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'select2', MIKADO_LISTING_URL_PATH . 'job/assets/js/plugins/select2.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'mkdf_listing_job_handle_modules', MIKADO_LISTING_URL_PATH . 'job/assets/js/listing.min.js', $array_deps_js, false, true );
			wp_enqueue_script( 'mkdf_listing_resume_handle_modules', MIKADO_LISTING_URL_PATH . 'resume/assets/js/resume.min.js', $array_deps_js, false, true );
		}
	}
	
	//set low priority because listing.min.js need to be loaded after modules.min.js and google api script
	add_action( 'wp_enqueue_scripts', 'mkdf_listing_load_js_assets', 20 );
}

if ( ! function_exists( 'mkdf_listing_style_dynamics_deps' ) ) {
	function mkdf_listing_style_dynamics_deps( $deps ) {
		$style_dynamic_deps_array   = array();
		$style_dynamic_deps_array[] = 'mkdf_listing_job_handle_wp_job_manager';
		$style_dynamic_deps_array[] = 'mkdf_listing_resume_handle_wp_job_manager';
		
		if ( function_exists( 'staffscout_mikado_is_responsive_on' ) && staffscout_mikado_is_responsive_on() ) {
			$style_dynamic_deps_array[] = 'mkdf_listing_job_handle_wp_job_manager_responsive';
			$style_dynamic_deps_array[] = 'mkdf_listing_resume_handle_wp_job_manager_responsive';
		}
		
		return array_merge( $deps, $style_dynamic_deps_array );
	}
	
	add_filter( 'staffscout_mikado_style_dynamic_deps', 'mkdf_listing_style_dynamics_deps' );
}

if ( ! function_exists( 'mkdf_listing_add_maps_extensions' ) ) {
	function mkdf_listing_add_maps_extensions( $extensions ) {
		$items      = array(
			'geometry',
			'places'
		);
		$extensions = array_unique( array_merge( $extensions, $items ) );
		
		return $extensions;
	}
	
	add_filter( 'staffscout_mikado_google_maps_extensions_array', 'mkdf_listing_add_maps_extensions', 10, 1 );
}