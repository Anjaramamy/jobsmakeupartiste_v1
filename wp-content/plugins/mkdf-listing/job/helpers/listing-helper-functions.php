<?php
use MikadoListing\Lib\Core;

if (!function_exists('mkdf_listing_job_get_listing_variables')) {
    /**
     * Set JQuery mkdfListingGlobalVars variable
     */
    function mkdf_listing_job_get_listing_variables() {
        $listing_variables = array(
            'selectedTypes' => array()
        );

        $listing_variables = apply_filters('mkdf_listing_job_filter_listing_js_global_variables', $listing_variables);

        wp_localize_script('staffscout_mikado_modules', 'mkdfListingGlobalVars', array(
            'vars' => $listing_variables
        ));
    }

    add_action('wp_enqueue_scripts', 'mkdf_listing_job_get_listing_variables', 20);

}

if (!function_exists('mkdf_listing_job_get_listing_types')) {
    /**
     * Get job listing types
     * return value is object with two arrays.
     * param $first_empty - if is true, first array in return object will have empty first element
     * First array is associative array of job listing types. Second array is array of job listing type objects
     * return object
     */
    function mkdf_listing_job_get_listing_types($first_empty = false) {

        $listing_types_array = array();
        $listing_types_array['key_value'] = array();
        $listing_types_array['obj'] = array();
        $args = array(
            'taxonomy'   => 'job_listing_type',
            'hide_empty' => false
        );

        $listing_types = get_terms($args);

        if (is_array($listing_types) && count($listing_types)) {
            if ($first_empty) {
                $listing_types_array['key_value'][''] = '';
            }
            foreach ($listing_types as $listing_type) {

                $listing_types_array['key_value'][$listing_type->term_id] = $listing_type->name;
                $listing_types_array['obj'][] = $listing_type;

            }

        }
        return $listing_types_array;
    }
}

if (!function_exists('mkdf_listing_job_get_listing_region')) {
    /**
     * Get job listing regions
     * return value is object with two arrays.
     * param $first_empty - if is true, first array in return object will have empty first element
     * First array is associative array of job listing regions. Second array is array of job listing regions objects
     * return object
     */
    function mkdf_listing_job_get_listing_region($first_empty = false) {

        $listing_region_array = array();
        $listing_region_array['key_value'] = array();
        $listing_region_array['obj'] = array();
        $args = array(
            'taxonomy'   => 'job_listing_region',
            'hide_empty' => false
        );

        $listing_region = get_terms($args);

        if (is_array($listing_region) && count($listing_region)) {
            if ($first_empty) {
                $listing_region_array['key_value'][''] = '';
            }
            foreach ($listing_region as $listing_region) {

                $listing_region_array['key_value'][$listing_region->term_id] = $listing_region->name;
                $listing_region_array['obj'][] = $listing_region;

            }

        }
        return $listing_region_array;
    }
}

if (!function_exists('mkdf_listing_job_get_listing_types_VC_Array')) {
    /**
     * Get job listing types array prepared for Visual Composer Mapping
     * return array
     */
    function mkdf_listing_job_get_listing_types_VC_Array() {

        $types_obj = mkdf_listing_job_get_listing_types(true);
        $types_array = $types_obj['key_value'];

        return array_flip($types_array);

    }

}

if (!function_exists('mkdf_listing_job_get_listing_type_by_id')) {
    /**
     * Get job listing type
     * param $id - job listing types id
     * return object
     */
    function mkdf_listing_job_get_listing_type_by_id($id) {
        $type = get_term_by('id', $id, 'job_listing_type');
        return $type;
    }
}

if (!function_exists('mkdf_listing_job_get_listing_categories')) {

    /**
     * Generate job listing categories
     * return array
     */

    function mkdf_listing_job_get_listing_categories($params = array()) {

        $enable_categories = mkdf_listing_job_enable_categories();
        if (!$enable_categories) {
            return;
        }
        $number = '';
        $meta_key = '';
        $meta_value = '';
        $include = '';
        $include_params = '';
        extract($params);

        $cat_array = array();
        $args = array(
            'taxonomy'         => 'job_listing_category',
            'hide_empty'       => false,
            'suppress_filters' => 0,
            'number'           => $number,
            'meta_key'         => $meta_key,
            'meta_value'       => $meta_value,
            'include'          => $include
        );

        $cats = mkdf_listing_job_get_terms_ordered('job_listing_category', $args, $include_params, 'slug');

        if (is_array($cats) && count($cats)) {
            foreach ($cats as $cat) {

                $gallery_classes = '';
                $gallery_size = get_term_meta($cat->term_id, 'gallery_size', true);
                $gallery_type = get_term_meta($cat->term_id, 'gallery_type', true);
                $custom_link = get_term_meta($cat->term_id, 'category_custom_link', true);

                if ($gallery_size === '') {
                    $gallery_size = 'square-small';
                }
                if ($gallery_type === '') {
                    $gallery_type = 'standard';
                }


                $gallery_classes .= 'mkdf-ls-gallery-' . esc_attr($gallery_type) . ' ';
                $gallery_classes .= 'mkdf-ls-gallery-' . esc_attr($gallery_size) . ' ';

                $gallery_link = get_term_link($cat->term_id, 'job_listing_category');

                $cat_array[] = array(
                    'id'                => $cat->term_id,
                    'slug'              => $cat->slug,
                    'name'              => $cat->name,
                    'desc'              => get_term_field('description', $cat->term_id, 'job_listing_category'),
                    'image_style'       => mkdf_listing_job_get_taxonomy_image_style_attr($cat->term_id),
                    'custom_icon_style' => mkdf_listing_job_get_taxonomy_custom_icon_style_attr($cat->term_id),
                    'icon'              => mkdf_listing_job_get_listing_taxonomy_icon_html($cat->term_id),
                    'gallery_type'      => $gallery_type,
                    'gallery_size'      => $gallery_size,
                    'link'              => $gallery_link,
                    'custom_link'       => $custom_link,
                    'classes'           => $gallery_classes
                );

            }
        }
        return $cat_array;
    }
}

if (!function_exists('mkdf_listing_job_get_listing_taxonomies_formatted')) {
    /**
     * Get job listing taxonomies
     * return value is object with array of object params.
     * @param $params - array of query params
     *
     * @return array
     */
    function mkdf_listing_job_get_listing_taxonomies_formatted($params = array()) {

        $listing_taxonomies_array = array();
        $taxonomy = $number = $include = $meta_key = $meta_value = $include_params = '';
        extract($params);

        $args = array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => true,
            'number'     => $number,
            'include'    => $include,
            'meta_key'   => $meta_key,
            'meta_value' => $meta_value
        );

        $listing_taxonomies = mkdf_listing_job_get_terms_ordered($taxonomy, $args, $include_params, 'slug');

        if (is_array($listing_taxonomies) && count($listing_taxonomies)) {
            foreach ($listing_taxonomies as $tax) {
                $listing_taxonomies_array[] = array(
                    'id'          => $tax->term_id,
                    'item_slug'   => $tax->slug,
                    'name'        => $tax->name,
                    'desc'        => get_term_field('description', $tax->term_id, $taxonomy),
                    'count'       => $tax->count,
                    'link'        => get_term_link($tax->term_id, $taxonomy),
                    'icon'        => mkdf_listing_job_get_listing_taxonomy_icon_html($tax->term_id),
                    'custom_icon' => mkdf_listing_job_get_taxonomy_custom_icon_style_attr($tax->term_id),
                );
            }
        }

        return $listing_taxonomies_array;
    }
}

if (!function_exists('mkdf_listing_job_get_terms_ordered')) {

    function mkdf_listing_job_get_terms_ordered($taxonomy = '', $args = [], $term_order = '', $sort_by = 'slug') {
        // Check if we have a taxonomy set and if the taxonomy is valid. Return false on failure
        if (!$taxonomy)
            return false;

        if (!taxonomy_exists($taxonomy))
            return false;

        // Get our terms
        $terms = get_terms($taxonomy, $args);

        // Check if we have terms to display. If not, return false
        if (empty($terms) || is_wp_error($terms))
            return false;

        /**
         * We have made it to here, lets continue to output our terms
         * Lets first check if we have a custom sort order. If not, return our
         * object of terms as is
         */
        if (!$term_order)
            return $terms;

        // Check if $term_order is an array, if not, convert the string to an array
        if (!is_array($term_order)) {
            // Remove white spaces before and after the comma and convert string to an array
            $no_whitespaces = preg_replace('/\s*,\s*/', ',', filter_var($term_order, FILTER_SANITIZE_STRING));
            $term_order = explode(',', $no_whitespaces);
        }

        // Remove the set of terms from the $terms array so we can move them to the front in our custom order
        $array_a = [];
        $array_b = [];
        foreach ($terms as $term) {
            if (in_array($term->$sort_by, $term_order)) {
                $array_a[] = $term;
            } else {
                $array_b[] = $term;
            }
        }

        /**
         * If we have a custom term order, lets sort our array of terms
         * $term_order can be a comma separated string of slugs or names or an array
         */
        usort($array_a, function ($a, $b) use ($term_order, $sort_by) {
            // Flip the array
            $term_order = array_flip($term_order);

            return $term_order[$a->$sort_by] - $term_order[$b->$sort_by];
        });
        $results = array_merge($array_a, $array_b);

        return $results;
    }


}

if (!function_exists('mkdf_listing_job_categories_VC_ARRAY')) {

    function mkdf_listing_job_categories_VC_ARRAY($first_empty = false) {

        $vc_cats = array();
        $cats = mkdf_listing_job_get_listing_categories();

        if (is_array($cats) && count($cats)) {
            if ($first_empty) {
                $vc_cats[''] = '';
            }
            foreach ($cats as $cat) {

                $vc_cats[$cat['slug']] = $cat['name'];

            }
        }

        return array_flip($vc_cats);


    }

}


if (!function_exists('mkdf_listing_job_get_taxonomy_image_style_attr')) {
    function mkdf_listing_job_get_taxonomy_image_style_attr($term_id) {
        $image_url_style = '';
        $image_url = get_term_meta($term_id, 'featured_image', true);

        if ($image_url && $image_url !== '') {
            $image_url_style = 'background-image: url(' . esc_url($image_url) . ')';
        }
        return $image_url_style;
    }
}

if (!function_exists('mkdf_listing_job_get_taxonomy_custom_icon_style_attr')) {
    function mkdf_listing_job_get_taxonomy_custom_icon_style_attr($term_id) {
        $image_url_style = '';
        $image_url = get_term_meta($term_id, 'custom_icon', true);

        if ($image_url && $image_url !== '') {
            $image_url_style = 'background-image: url(' . esc_url($image_url) . ')';
        }
        return $image_url_style;
    }
}

if (!function_exists('mkdf_listing_job_get_post_image_style_attr')) {
    function mkdf_listing_job_get_post_image_style_attr($post_id) {
        $image_url_style = '';
        $image_url = get_the_post_thumbnail_url($post_id, 'full');

        if ($image_url && $image_url !== '') {
            $image_url_style = 'background-image: url(' . esc_url($image_url) . ')';
        }
        return $image_url_style;
    }
}


if (!function_exists('mkdf_listing_job_get_listing_categories_array')) {

    /**
     * Generate job listing categories related to job listing type
     * param $type_id - job listing type id
     * return array
     */

    function mkdf_listing_job_get_listing_categories_array() {

        $enable_categories = mkdf_listing_job_enable_categories();
        if (!$enable_categories) {
            return;
        }

        $cat_array = array();

        $args = array(
            'taxonomy' => 'job_listing_category',
        );

        $cats = get_terms($args);

        if (is_array($cats) && count($cats)) {
            foreach ($cats as $cat) {
                $cat_array[$cat->slug] = $cat->name;
            }
        }
        return $cat_array;
    }
}

if (!function_exists('mkdf_listing_job_get_listing_locations_array')) {

    /**
     * Generate job listing categories related to job listing type
     * param $type_id - job listing type id
     * return array
     */

    function mkdf_listing_job_get_listing_locations_array() {

        $location_installed = mkdf_listing_job_locations_plugin_installed();
        if (!$location_installed) {
            return;
        }

        $loc_array = array();

        $args = array(
            'taxonomy' => 'job_listing_region',
        );

        $locs = get_terms($args);

        if (is_array($locs) && count($locs)) {
            foreach ($locs as $loc) {
                $loc_array[$loc->term_id] = $loc->name;
            }
        }
        return $loc_array;
    }
}

if (!function_exists('mkdf_listing_job_get_listing_types_array')) {

    /**
     * Generate job listing categories related to job listing type
     * param $type_id - job listing type id
     * return array
     */

    function mkdf_listing_job_get_listing_types_array() {

        $type_array = array();

        $args = array(
            'taxonomy' => 'job_listing_type',
        );

        $types = get_terms($args);

        if (is_array($types) && count($types)) {
            foreach ($types as $type) {
                $type_array[$type->term_id] = $type->name;
            }
        }
        return $type_array;
    }
}

if (!function_exists('mkdf_listing_job_get_listing_type_custom_fields')) {
    /**
     * Get Listing Type custom fields
     * param $id - Listing Type id
     * return array
     */
    function mkdf_listing_job_get_listing_type_custom_fields($id) {
        return get_term_meta($id, 'listing_type_custom_fields', true);
    }
}


if (!function_exists('mkdf_listing_job_get_listing_type_options_array')) {
    /**
     * Generate options array for job meta custom select field(this is repeater field).
     * params $field_obj - field object contain labels and options array
     * return array
     */
    function mkdf_listing_job_get_listing_type_options_array($field_obj) {
        $options = array();

        //check if are set option values and option labels for current select field
        if (is_array($field_obj['option_values']) && count($field_obj['option_values'])
            && is_array($field_obj['option_labels']) && count($field_obj['option_labels'])
        ) {

            for ($i = 0; $i < count($field_obj['option_values']); $i++) {

                if (isset($field_obj['option_values'][$i]) && $field_obj['option_values'][$i] !== ''
                    && isset($field_obj['option_labels'][$i]) && $field_obj['option_labels'][$i]
                ) {

                    $options[$field_obj['option_values'][$i]] = $field_obj['option_labels'][$i];

                }
            }

        }

        return $options;
    }
}

if (!function_exists('mkdf_listing_job_get_listing_number_per_page')) {
    /**
     * Generate listing per page number
     * return string
     */
    function mkdf_listing_job_get_listing_number_per_page() {

        $number = '';

        $mkdf_listing_job_option = staffscout_mikado_options()->getOptionValue('listings_per_page');
        $wp_job_option = get_option('job_manager_per_page');
        $default_option = get_option('posts_per_page');

        if ($mkdf_listing_job_option !== '') {
            $number = esc_attr($mkdf_listing_job_option);
        } elseif ($wp_job_option !== '') {
            $number = esc_attr($wp_job_option);
        } else {
            $number = esc_attr($default_option);
        }

        return $number;

    }

}

if (!function_exists('mkdf_listing_job_set_listing_titles_global_var')) {
    /**
     * Localize listing titles array
     * We use it for keyword fields autocomplete
     */
    function mkdf_listing_job_set_listing_titles_global_var() {

        new Core\ListingTitleGlobalVar();

    }

    add_action('wp_footer', 'mkdf_listing_job_set_listing_titles_global_var');
}

if (!function_exists('mkdf_listing_job_build_query_string')) {
    /**
     * Function build query string based on params
     * return string
     */
    function mkdf_listing_job_build_query_string($keyword, $type, $salary) {

        $query = http_build_query(array(
            'keywords' => $keyword,
            'type'     => $type,
            'salary'   => $salary
        ));

        return '?' . $query;

    }

}

if (!function_exists('mkdf_listing_job_get_user_address')) {

    /**
     * Function provides user ip address
     * return string
     */

    function mkdf_listing_job_get_user_address() {

        $ipaddress = '';
        if (isset($_SERVER)) {

            if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']) {
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else if (isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED']) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            } else if (isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR']) {
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            } else if (isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED']) {
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            } else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']) {

                if (isset($_SERVER['REMOTE_PORT']) && $_SERVER['REMOTE_PORT']) {
                    $ipaddress = $_SERVER['REMOTE_ADDR'] . '-' . $_SERVER['REMOTE_PORT'];
                } else {
                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                }

            }
        }


        return $ipaddress;

    }

}


if (!function_exists('mkdf_listing_job_enable_categories')) {
    /**
     * Check listing categories option
     * return bool
     */
    function mkdf_listing_job_enable_categories() {

        $option = get_option('job_manager_enable_categories');
        $flag = ($option === '1') ? true : false;
        return $flag;

    }

}

if (!function_exists('mkdf_listing_job_locations_plugin_installed')) {
    /**
     * Check if locations plugin installed
     * return bool
     */
    function mkdf_listing_job_locations_plugin_installed() {

        return class_exists('Astoundify_Job_Manager_Regions');

    }

}


if (!function_exists('mkdf_listing_job_get_listing_cats')) {
    /**
     * Get job listing categories
     * return value is object with two arrays.
     * param $first_empty - if is true, first array in return object will have empty first element
     * First array is associative array of job listing regions. Second array is array of job listing regions objects
     * return object
     */
    function mkdf_listing_job_get_listing_cats($first_empty = false) {

        $listing_category_array = array();
        $listing_category_array['key_value'] = array();
        $listing_category_array['obj'] = array();
        $args = array(
            'taxonomy'   => 'job_listing_category',
            'hide_empty' => false
        );

        $listing_categories = get_terms($args);

        if (is_array($listing_categories) && count($listing_categories)) {
            if ($first_empty) {
                $listing_category_array['key_value'][''] = '';
            }
            foreach ($listing_categories as $listing_category) {

                $listing_category_array['key_value'][$listing_category->term_id] = $listing_category->name;
                $listing_category_array['obj'][] = $listing_category;

            }

        }

        return $listing_category_array;
    }
}


if (!function_exists('mkdf_listing_job_get_listing_types_by_listing_id')) {
    /**
     * Get Listing Types by listing id
     * params $id - listing id
     * return array
     */
    function mkdf_listing_job_get_listing_types_by_listing_id($id) {

        $return_array = array();

        $types = wp_get_object_terms($id, 'job_listing_type');

        if (is_array($types) && count($types)) {
            foreach ($types as $type) {
                $return_array[] = array(
                    'id'   => $type->term_id,
                    'name' => $type->name,
                    'link' => get_term_link($type->term_id, 'job_listing_type')
                );
            }
        }

        return $return_array;

    }

}

if (!function_exists('mkdf_listing_job_get_listing_categories_by_listing_id')) {
    /**
     * Get Listing Categories by listing id
     * params $id - listing id
     * return array
     */
    function mkdf_listing_job_get_listing_categories_by_listing_id($id) {

        $cats = array();
        $html = '';

        $types = wp_get_object_terms($id, 'job_listing_category');

        if (is_array($types) && count($types)) {
            foreach ($types as $type) {
                $cats[] = array(
                    'id'        => $type->term_id,
                    'name'      => $type->name,
                    'link'      => get_term_link($type->term_id, 'job_listing_category'),
                    'icon_html' => mkdf_listing_job_get_listing_taxonomy_icon_html($type->term_id)
                );
            }
        }

        if (count($cats)) {
            $html .= '<div class="mkdf-listing-cat-wrapper">';
            foreach ($cats as $cat) {
                $html .= '<a href="' . esc_url($cat['link']) . '">';
                $html .= '<span class="mkdf-listing-cat-icon">';
                $html .= mkdf_listing_job_get_listing_taxonomy_icon_html($cat['id']);
                $html .= '</span>';
                $html .= '<span class="mkdf-listing-cat-name">' . esc_attr($cat['name']) . '</span>';
                $html .= '</a>';
            }
            $html .= '</div>';
        }

        return $html;

    }

}

if (!function_exists('mkdf_listing_job_get_listing_taxonomy_icon_html')) {
    /**
     * Get Listing Category Icon Html
     * params $id - listing id
     * return string
     */
    function mkdf_listing_job_get_listing_taxonomy_icon_html($id) {

        $html = $icon_html = '';
        $icon_pack = get_term_meta($id, 'icon_pack', true);
        $custom_icon = get_term_meta($id, 'custom_icon', true);
        $classes = array(
            'mkdf-ls-cat-icon'
        );


        if (!empty($custom_icon)) {
            $classes[] = 'mkdf-custom-icon';
            $icon_html = '<img src="' . $custom_icon . '" alt="' . esc_attr__('Category Custom Icon', 'select-listing') . '"/>';
        } elseif ($icon_pack !== '') {
            $param = staffscout_mikado_icon_collections()->getIconCollectionParamNameByKey($icon_pack);
            $icon = get_term_meta($id, $param, true);

            if ($icon !== '') {
                $icon_html = staffscout_mikado_icon_collections()->renderIcon($icon, $icon_pack);
            }
        }

        if ($icon_html !== '') {
            $html .= '<span class="' . implode(' ', $classes) . '">';
            $html .= $icon_html;
            $html .= '</span>';
        }

        return $html;

        return $icon_html;

    }
}

if (!function_exists('mkdf_listing_job_get_free_package')) {
    /**
     * Get Free Package
     * return array
     */
    function mkdf_listing_job_get_free_package() {

        $package = array();
        $package_obj = false;

        $package_args = mkdf_listing_job_get_free_package_params();

        $free_packages = get_posts($package_args);

        if (is_array($free_packages) && count($free_packages)) {
            $package_obj = $free_packages[0];
        }

        if ($package_obj) {
            $package['id'] = $package_obj->ID;
            $package['package_limit'] = get_post_meta($package_obj->ID, '_job_listing_limit', true);
            $package['package_duration'] = get_post_meta($package_obj->ID, '_job_listing_duration', true);
            $package['package_featured'] = get_post_meta($package_obj->ID, '_job_listing_featured', true);
        }

        return $package;
    }

}

if (!function_exists('mkdf_listing_job_get_free_package_params')) {
    /**
     * Get Free Package Params Array
     * return array
     */
    function mkdf_listing_job_get_free_package_params() {
        $params = array(
            'post_type'        => 'product',
            'posts_per_page'   => -1,
            'suppress_filters' => 0,
            'tax_query'        => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => array('job_package', 'job_package_subscription')
                )
            ),
            'meta_query'       => array(
                'relation' => 'AND',
                array(
                    'key'     => '_visibility',
                    'value'   => array('visible', 'catalog'),
                    'compare' => 'IN'
                ),
                array(
                    'key'     => '_price',
                    'value'   => array('', 0),
                    'compare' => 'IN'
                )
            )
        );
        return $params;
    }

}


if (!function_exists('mkdf_listing_job_get_listing_rating_html')) {
    /**
     * Function return listing rating html
     * param id - id of current post
     *
     * @return string
     */
    function mkdf_listing_job_get_listing_rating_html($id) {

        $rating_html = '';
        $rating_obj = new Core\ListingRating($id, false, 'get_average_rating');
        ob_start();
        $rating_obj->getRatingHtml();
        $rating_html .= ob_get_clean();

        return $rating_html;

    }

}

if (!function_exists('mkdf_listing_job_get_listing_price_html')) {
    /**
     * Function return listing price html
     * param id - id of current post
     *
     * @return string
     */
    function mkdf_listing_job_get_listing_price_html($id) {

        $price_html = '';
        $price = get_post_meta($id, '_listing_price', true);

        if (($price && $price !== '')) {

            $price_html .= '<div class="mkdf-ls-price-holder">';
            if ($price && $price !== '') {
                $price_html .= '<span class="mkdf-ls-price-amount">';
                $price_html .= esc_attr('$') . esc_attr($price);
                $price_html .= '</span>';
            }

            $price_html .= '</div>';
        }

        return $price_html;

    }

}

if (!function_exists('mkdf_listing_job_get_listing_social_network_array')) {
    /**
     * Function generate social network array
     *
     * @return array
     */
    function mkdf_listing_job_get_listing_social_network_array() {

        $social_networks = array(
            'facebook'   => esc_html__('Facebook', 'mkdf-listing'),
            'twitter'    => esc_html__('Twitter', 'mkdf-listing'),
            'instagram'  => esc_html__('Instagram', 'mkdf-listing'),
            'pinterest'  => esc_html__('Pinterest', 'mkdf-listing'),
            'soundcloud' => esc_html__('Sound Cloud', 'mkdf-listing'),
            'vimeo'      => esc_html__('Vimeo', 'mkdf-listing'),
            'youtube'    => esc_html__('Youtube', 'mkdf-listing'),
            'skype'      => esc_html__('Skype', 'mkdf-listing'),
            'linkedin'   => esc_html__('LinkedIn', 'mkdf-listing')
        );

        $return_array = array();
        foreach ($social_networks as $net_id => $net_name) {
            $return_array[$net_id]['id'] = $net_id;
            $return_array[$net_id]['name'] = $net_name;
            $return_array[$net_id]['label'] = esc_html__('Enter ', 'mkdf-listing') . esc_attr($net_name) . esc_html__(' Profile Url', 'mkdf-listing');
            $return_array[$net_id]['icon'] = $net_id;
        }
        return $return_array;

    }

}
if (!function_exists('mkdf_listing_job_comment_relative_date')) {
    /**
     * Function generate relative date for listing comments
     *
     */
    function mkdf_listing_job_comment_relative_date() {
        return human_time_diff(get_the_time('U'), current_time('timestamp')) . esc_html__(' ago', 'mkdf-listing');
    }

    add_filter('get_comment_date', 'mkdf_listing_job_comment_relative_date');
}