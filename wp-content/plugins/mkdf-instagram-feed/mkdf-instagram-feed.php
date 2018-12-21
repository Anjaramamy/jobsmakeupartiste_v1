<?php
/*
Plugin Name: Mikado Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Mikado Themes
Version: 1.0
*/
define('MIKADO_INSTAGRAM_FEED_VERSION', '1.0');
define('MIKADO_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('MIKADO_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));

include_once 'load.php';

if(!function_exists('mkdf_instagram_feed_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function mkdf_instagram_feed_text_domain() {
        load_plugin_textdomain('mkdf-instagram-feed', false, MIKADO_INSTAGRAM_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'mkdf_instagram_feed_text_domain');
}