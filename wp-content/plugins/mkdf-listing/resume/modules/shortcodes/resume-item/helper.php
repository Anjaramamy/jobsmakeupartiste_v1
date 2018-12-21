<?php
use MikadoResume\Lib\Shortcodes;

if(!function_exists('mkdf_listing_resume_item_shortcode_helper')) {
    function mkdf_listing_resume_item_shortcode_helper($shortcodes_class_name) {

        $shortcodes = array(
            'MikadoResume\Lib\Shortcodes\ResumeItem'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('mkdf_listing_resume_filter_add_vc_shortcode', 'mkdf_listing_resume_item_shortcode_helper');
}

if(!function_exists('mkdf_listing_resume_item_class_instance')){

    function mkdf_listing_resume_item_class_instance(){
        return Shortcodes\ResumeItem::getInstance();
    }

}