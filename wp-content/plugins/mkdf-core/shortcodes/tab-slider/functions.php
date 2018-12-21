<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Mkdf_Tab_Slider extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_Mkdf_Tab_Slider_Item extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'mkdf_core_add_tab_slider_shortcodes' ) ) {
    function mkdf_core_add_tab_slider_shortcodes( $shortcodes_class_name ) {
        $shortcodes = array(
            'MikadoCore\CPT\Shortcodes\TabSlider\TabSlider',
            'MikadoCore\CPT\Shortcodes\TabSlider\TabSliderItem'
        );

        $shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

        return $shortcodes_class_name;
    }

    add_filter( 'mkdf_core_filter_add_vc_shortcode', 'mkdf_core_add_tab_slider_shortcodes' );
}

if ( ! function_exists( 'mkdf_core_set_tab_slider_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for tabs shortcode to set our icon for Visual Composer shortcodes panel
     */
    function mkdf_core_set_tab_slider_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-tab-slider';
        $shortcodes_icon_class_array[] = '.icon-wpb-tab-slider-item';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'mkdf_core_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_core_set_tab_slider_icon_class_name_for_vc_shortcodes' );
}

if(!function_exists('staffscout_mikado_remove_auto_ptag')) {
    function staffscout_mikado_remove_auto_ptag($content, $autop = false) {
        if($autop) {
            $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        }

        return do_shortcode($content);
    }
}