<?php
/*
Plugin Name: Mikado Listing
Description: Plugin that extends wp_job_manager functionality
Author: Mikado Themes
Version: 1.0.1
*/

require_once 'const.php';
require_once 'helpers.php';

if (!function_exists('mkdf_listing_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function mkdf_listing_text_domain() {
        load_plugin_textdomain('mkdf-listing', false, MIKADO_LISTING_REL_PATH . '/languages');
    }

    add_action('plugins_loaded', 'mkdf_listing_text_domain');
}

if (!function_exists('mkdf_listing_version_class')) {
    /**
     * Adds plugins version class to body
     * @param $classes
     * @return array
     */
    function mkdf_listing_version_class($classes) {
        $classes[] = 'mkdf-listing-' . MIKADO_LISTING_VERSION;

        return $classes;
    }

    add_filter('body_class', 'mkdf_listing_version_class');
}

if (!function_exists('mkdf_listing_load_files')) {
    /**
     * load plugin files on init action
     */
    function mkdf_listing_load_files() {

        require_once 'load.php';
    }

    add_action('plugins_loaded', 'mkdf_listing_load_files');
}