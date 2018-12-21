<?php

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Mkdf_Comparison_Pricing_Tables_Holder extends WPBakeryShortCodesContainer
    {
    }
}

if (!function_exists('mkdf_core_add_comparison_pricing_tables_shortcodes')) {
    function mkdf_core_add_comparison_pricing_tables_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'MikadoCore\CPT\Shortcodes\ComparisonPricingTables\ComparisonPricingTablesHolder',
            'MikadoCore\CPT\Shortcodes\ComparisonPricingTables\ComparisonPricingTable'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('mkdf_core_filter_add_vc_shortcode', 'mkdf_core_add_comparison_pricing_tables_shortcodes');
}

if (!function_exists('mkdf_core_set_comparison_pricing_tables_icon_class_name_for_vc_shortcodes')) {
    /**
     * Function that set custom icon class name for animation holder shortcode to set our icon for Visual Composer shortcodes panel
     */
    function mkdf_core_set_comparison_pricing_tables_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-cmp-pricing-tables';
        $shortcodes_icon_class_array[] = '.icon-wpb-cmp-pricing-table';

        return $shortcodes_icon_class_array;
    }

    add_filter('mkdf_core_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_core_set_comparison_pricing_tables_icon_class_name_for_vc_shortcodes');
}