<?php

if (!function_exists('staffscout_mikado_register_footer_sidebar')) {
    function staffscout_mikado_register_footer_sidebar() {

        register_sidebar(
            array(
                'id'            => 'footer_top_column_1',
                'name'          => esc_html__('Footer Top Column 1', 'staffscout'),
                'description'   => esc_html__('Widgets added here will appear in the first column of top footer area', 'staffscout'),
                'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-1 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                'after_title'   => '</h5></div>'
            )
        );

        register_sidebar(
            array(
                'id'            => 'footer_top_column_2',
                'name'          => esc_html__('Footer Top Column 2', 'staffscout'),
                'description'   => esc_html__('Widgets added here will appear in the second column of top footer area', 'staffscout'),
                'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-2 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                'after_title'   => '</h5></div>'
            )
        );

        register_sidebar(
            array(
                'id'            => 'footer_top_column_3',
                'name'          => esc_html__('Footer Top Column 3', 'staffscout'),
                'description'   => esc_html__('Widgets added here will appear in the third column of top footer area', 'staffscout'),
                'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-3 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                'after_title'   => '</h5></div>'
            )
        );

        register_sidebar(
            array(
                'id'            => 'footer_top_column_4',
                'name'          => esc_html__('Footer Top Column 4', 'staffscout'),
                'description'   => esc_html__('Widgets added here will appear in the fourth column of top footer area', 'staffscout'),
                'before_widget' => '<div id="%1$s" class="widget mkdf-footer-column-4 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                'after_title'   => '</h5></div>'
            )
        );

        register_sidebar(
            array(
                'id'            => 'footer_bottom_column_1',
                'name'          => esc_html__('Footer Bottom Column 1', 'staffscout'),
                'description'   => esc_html__('Widgets added here will appear in the first column of bottom footer area', 'staffscout'),
                'before_widget' => '<div id="%1$s" class="widget mkdf-footer-bottom-column-1 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                'after_title'   => '</h5></div>'
            )
        );

        register_sidebar(
            array(
                'id'            => 'footer_bottom_column_2',
                'name'          => esc_html__('Footer Bottom Column 2', 'staffscout'),
                'description'   => esc_html__('Widgets added here will appear in the second column of bottom footer area', 'staffscout'),
                'before_widget' => '<div id="%1$s" class="widget mkdf-footer-bottom-column-2 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                'after_title'   => '</h5></div>'
            )
        );

        register_sidebar(
            array(
                'id'            => 'footer_bottom_column_3',
                'name'          => esc_html__('Footer Bottom Column 3', 'staffscout'),
                'description'   => esc_html__('Widgets added here will appear in the third column of bottom footer area', 'staffscout'),
                'before_widget' => '<div id="%1$s" class="widget mkdf-footer-bottom-column-3 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="mkdf-widget-title-holder"><h5 class="mkdf-widget-title">',
                'after_title'   => '</h5></div>'
            )
        );
    }

    add_action('widgets_init', 'staffscout_mikado_register_footer_sidebar');
}

if (!function_exists('staffscout_mikado_get_footer')) {
    /**
     * Loads footer HTML
     */
    function staffscout_mikado_get_footer() {
        $parameters = array();
        $page_id = staffscout_mikado_get_page_id();
        $disable_footer_meta = get_post_meta($page_id, 'mkdf_disable_footer_meta', true);

        $parameters['display_footer'] = $disable_footer_meta === 'yes' ? false : true;
        $parameters['footer_skin'] = staffscout_mikado_get_footer_skin();
        $parameters['display_footer_top'] = staffscout_mikado_show_footer_top();
        $parameters['display_footer_bottom'] = staffscout_mikado_show_footer_bottom();

        staffscout_mikado_get_module_template_part('templates/footer', 'footer', '', $parameters);
    }

    add_action('staffscout_mikado_get_footer_template', 'staffscout_mikado_get_footer');
}

if (!function_exists('staffscout_mikado_show_footer_top')) {
    /**
     * Check footer top showing
     * Function check value from options and checks if footer columns are empty.
     * return bool
     */
    function staffscout_mikado_show_footer_top() {
        $footer_top_flag = false;
        $page_id = get_queried_object_id();

        if ( empty( $page_id ) ) {
            $page_id = -1;
        }

        //check value from options and meta field on current page
        $option_flag = (staffscout_mikado_get_meta_field_intersect('show_footer_top', $page_id) === 'yes') ? true : false;

        //check footer columns.If they are empty, disable footer top
        $columns_flag = false;
        for ($i = 1; $i <= 4; $i++) {
            $footer_columns_id = 'footer_top_column_' . $i;
            if (is_active_sidebar($footer_columns_id)) {
                $columns_flag = true;
                break;
            }
        }

        if ($option_flag && $columns_flag) {
            $footer_top_flag = true;
        }

        return $footer_top_flag;
    }
}

if (!function_exists('staffscout_mikado_show_footer_bottom')) {
    /**
     * Check footer bottom showing
     * Function check value from options and checks if footer columns are empty.
     * return bool
     */
    function staffscout_mikado_show_footer_bottom() {
        $footer_bottom_flag = false;
        $page_id = get_queried_object_id();

        if ( empty( $page_id ) ) {
            $page_id = -1;
        }

        //check value from options and meta field on current page
        $option_flag = (staffscout_mikado_get_meta_field_intersect('show_footer_bottom', $page_id) === 'yes') ? true : false;

        //check footer columns.If they are empty, disable footer bottom
        $columns_flag = false;
        for ($i = 1; $i <= 3; $i++) {
            $footer_columns_id = 'footer_bottom_column_' . $i;
            if (is_active_sidebar($footer_columns_id)) {
                $columns_flag = true;
                break;
            }
        }

        if ($option_flag && $columns_flag) {
            $footer_bottom_flag = true;
        }

        return $footer_bottom_flag;
    }
}

if (!function_exists('staffscout_mikado_get_content_bottom_area')) {
    /**
     * Loads content bottom area HTML with all needed parameters
     */
    function staffscout_mikado_get_content_bottom_area() {
        $parameters = array();

        //Current page id
        $id = staffscout_mikado_get_page_id();

        //is content bottom area enabled for current page?
        $parameters['content_bottom_area'] = staffscout_mikado_get_meta_field_intersect('enable_content_bottom_area', $id);

        if ($parameters['content_bottom_area'] === 'yes') {

            //Sidebar for content bottom area
            $parameters['content_bottom_area_sidebar'] = staffscout_mikado_get_meta_field_intersect('content_bottom_sidebar_custom_display', $id);
            //Content bottom area in grid
            $parameters['grid_class'] = (staffscout_mikado_get_meta_field_intersect('content_bottom_in_grid', $id)) === 'yes' ? 'mkdf-grid' : 'mkdf-full-width';

            $parameters['content_bottom_style'] = array();

            //Content bottom area background color
            $background_color = staffscout_mikado_get_meta_field_intersect('content_bottom_background_color', $id);
            if ($background_color !== '') {
                $parameters['content_bottom_style'][] = 'background-color: ' . $background_color . ';';
            }

            if (is_active_sidebar($parameters['content_bottom_area_sidebar'])) {
                staffscout_mikado_get_module_template_part('templates/parts/content-bottom-area', 'footer', '', $parameters);
            }
        }
    }
}

if (!function_exists('staffscout_mikado_get_footer_top')) {
    /**
     * Return footer top HTML
     */
    function staffscout_mikado_get_footer_top() {
        $parameters = array();

        //get number of top footer columns
        $parameters['footer_top_columns'] = staffscout_mikado_options()->getOptionValue('footer_top_columns');

        //get footer top grid/full width class
        $parameters['footer_top_grid_class'] = staffscout_mikado_options()->getOptionValue('footer_in_grid') === 'yes' ? 'mkdf-grid' : 'mkdf-full-width';

        //get footer top other classes
        $footer_top_classes = array();

        //footer alignment
        $footer_top_alignment = staffscout_mikado_options()->getOptionValue('footer_top_columns_alignment');
        $footer_top_classes[] = !empty($footer_top_alignment) ? 'mkdf-footer-top-alignment-' . esc_attr($footer_top_alignment) : '';

        $footer_top_classes = apply_filters('staffscout_mikado_footer_top_classes', $footer_top_classes);

        $parameters['footer_top_classes'] = implode(' ', $footer_top_classes);

        staffscout_mikado_get_module_template_part('templates/parts/footer-top', 'footer', '', $parameters);
    }
}

if (!function_exists('staffscout_mikado_get_footer_bottom')) {
    /**
     * Return footer bottom HTML
     */
    function staffscout_mikado_get_footer_bottom() {
        $parameters = array();

        //get number of bottom footer columns
        $parameters['footer_bottom_columns'] = staffscout_mikado_options()->getOptionValue('footer_bottom_columns');

        //get footer top grid/full width class
        $parameters['footer_bottom_grid_class'] = staffscout_mikado_options()->getOptionValue('footer_in_grid') === 'yes' ? 'mkdf-grid' : 'mkdf-full-width';

        //get footer top other classes
        $footer_bottom_classes = array();
        $footer_bottom_classes = apply_filters('staffscout_mikado_footer_bottom_classes', $footer_bottom_classes);

        $parameters['footer_bottom_classes'] = implode(' ', $footer_bottom_classes);

        staffscout_mikado_get_module_template_part('templates/parts/footer-bottom', 'footer', '', $parameters);
    }
}

if (!function_exists('staffscout_mikado_get_footer_skin')) {
    /**
     * Return footer skin class
     */
    function staffscout_mikado_get_footer_skin() {
        $footerClasses = '';

        $id = staffscout_mikado_get_page_id();

        $footer_skin = staffscout_mikado_get_meta_field_intersect('footer_skin', $id);

        if($footer_skin == 'light') {
            $footerClasses = 'mkdf-footer-light-skin';
        } elseif($footer_skin == 'dark') {
            $footerClasses = 'mkdf-footer-dark-skin';
        }

        return $footerClasses;
    }
}

if ( ! function_exists( 'staffscout_mikado_footer_skin_body_class' ) ) {
    /**
     * Function that adds body classes for different footer skin styles
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function staffscout_mikado_footer_skin_body_class( $classes ) {

        $id = staffscout_mikado_get_page_id();

        $footer_skin = staffscout_mikado_get_meta_field_intersect('footer_skin', $id);

        if($footer_skin == 'light') {
            $classes[] = 'mkdf-footer-light-skin-btt';
        } elseif($footer_skin == 'dark') {
            $classes[] = 'mkdf-footer-dark-skin-btt';
        }

        return $classes;
    }

    add_filter( 'body_class', 'staffscout_mikado_footer_skin_body_class' );
}

if (!function_exists('staffscout_mikado_footer_page_styles')) {
    /**
     * @param $styles
     *
     * @return array
     */
    function staffscout_mikado_footer_page_styles($styles) {
        $id = staffscout_mikado_get_page_id();

        $top_background_color = get_post_meta($id, 'mkd_footer_top_background_color_meta', true);

        $bottom_background_color = get_post_meta($id, 'mkd_footer_bottom_background_color_meta', true);

        $page_prefix = staffscout_mikado_get_unique_page_class($id);

        $current_style = '';


        //Footer Top background color
        if ($top_background_color !== '') {

            $footer_top_bg_color_selectors = array(
                'body' . $page_prefix . ' footer.mkdf-page-footer .mkdf-footer-top-holder'
            );

            $footer_top_bg_color_styles = array(
                'background-color' => $top_background_color
            );

            $current_style .= staffscout_mikado_dynamic_css($footer_top_bg_color_selectors, $footer_top_bg_color_styles);
        }

        //Footer Bottom background color
        if ($bottom_background_color !== '') {

            $footer_bottom_bg_color_selectors = array(
                'body' . $page_prefix . ' footer.mkdf-page-footer .mkdf-footer-bottom-holder'
            );

            $footer_bottom_bg_color_styles = array(
                'background-color' => $bottom_background_color
            );

            $current_style .= staffscout_mikado_dynamic_css($footer_bottom_bg_color_selectors, $footer_bottom_bg_color_styles);
        }

        $current_style = $current_style . $styles;

        return $current_style;
    }

    add_filter('staffscout_mikado_add_page_custom_style', 'staffscout_mikado_footer_page_styles');
}
