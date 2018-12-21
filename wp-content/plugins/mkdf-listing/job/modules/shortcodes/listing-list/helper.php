<?php
use MikadoListing\Lib\Shortcodes;
use MikadoListing\Lib\Core;

if (!function_exists('mkdf_listing_job_list_shortcode_helper')) {
    function mkdf_listing_job_list_shortcode_helper($shortcodes_class_name) {

        $shortcodes = array(
            'MikadoListing\Lib\Shortcodes\ListingList'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('mkdf_listing_job_filter_add_vc_shortcode', 'mkdf_listing_job_list_shortcode_helper');
}

if (!function_exists('mkdf_listing_job_list_class_instance')) {

    function mkdf_listing_job_list_class_instance() {
        return Shortcodes\ListingList::getInstance();
    }

}

if (!function_exists('mkdf_listing_job_set_ls_list_icon_class_name_for_vc_shortcodes')) {
    /**
     * Function that set custom icon class name for button shortcode to set our icon for Visual Composer shortcodes panel
     */
    function mkdf_listing_job_set_ls_list_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-ls-list';

        return $shortcodes_icon_class_array;
    }

    add_filter('mkdf_core_filter_add_vc_shortcodes_custom_icon_class', 'mkdf_listing_job_set_ls_list_icon_class_name_for_vc_shortcodes');
}

if (!function_exists('mkdf_listing_job_list_class_instance')) {

    function mkdf_listing_job_list_class_instance() {
        return Shortcodes\ListingList::getInstance();
    }

}

if (!function_exists('mkdf_listing_job_list_load_more_response')) {

    function mkdf_listing_job_list_load_more_response() {

        $params = array();
        $sc_params = array();
        $html = '';
        $max_num_pages = '';

        if (isset($_POST)) {
            foreach ($_POST as $key => $value) {
                if ($key !== '') {
                    $addUnderscoreBeforeCapitalLetter = preg_replace('/([A-Z])/', '_$1', $key);
                    $setAllLettersToLowercase = strtolower($addUnderscoreBeforeCapitalLetter);
                    $params[$setAllLettersToLowercase] = $value;
                }
            }

            extract($params);
            $next_page = '';

            foreach ($load_more_data as $key => $value) {
                if ($key !== '') {
                    $addUnderscoreBeforeCapitalLetter = preg_replace('/([A-Z])/', '_$1', $key);
                    $setAllLettersToLowercase = strtolower($addUnderscoreBeforeCapitalLetter);
                    $sc_params[$setAllLettersToLowercase] = $value;
                }
            }

            //make a new instance of adv search shortcode
            $listing_list_obj = mkdf_listing_job_list_class_instance();
            //set basic params for new shortcode instance
            $listing_list_obj->setBasicParams($sc_params);

            if ($enable_load_more) {
                $next_page = $load_more_data['nextPage'];
            }

            $title_tag = $load_more_data['titleTag'];

            $type = $load_more_data['type'];

            $query_array = $listing_list_obj->getQueryArray();
            $query_array['next_page'] = $next_page;
            $query_results = mkdf_listing_job_get_listing_query_results($query_array);

            //set query results for new shortcode instance
            $listing_list_obj->setQueryResults($query_results);

            $max_num_pages = $query_results->max_num_pages;

            if ($query_results->have_posts()) {
                while ($query_results->have_posts()) {
                    $query_results->the_post();
                    $article_obj = new Core\ListingArticle(get_the_ID());

                    $excerpt = get_the_excerpt(get_the_ID());

                    $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                    $img_style = '';
                    if ($img_url !== '') {
                        $img_style = 'background-image: url(' . esc_url($img_url) . ')';
                    }

                    $params = array(
                        'type_html'    => $article_obj->getTaxHtml('job_listing_type', 'mkdf-listing-type-wrapper'),
                        'cat_html'     => $article_obj->getTaxHtml('job_listing_category', 'mkdf-listing-cat-wrapper'),
                        'rating_html'  => $article_obj->getListingAverageRating(),
                        'address_html' => $article_obj->getAddressIconHtml(),
                        'article_obj'  => $article_obj,
                        'price_html'   => $article_obj->getPriceHtml(),
                        'excerpt'      => $excerpt,
                        'img_style'    => $img_style,
                        'image_size'   => $image_size,
                        'title_tag'    => $title_tag,
                    );

                    $html .= mkdf_listing_job_get_shortcode_module_template_part('templates/item', 'listing-list', $type, $params);

                }
                wp_reset_postdata();
            } else {
                ob_start();
                $html = mkdf_listing_job_get_shortcode_module_template_part('templates/post-not-found', 'listing-advanced-search');
                $html .= ob_get_clean();
            }

            $return_obj = array(
                'html'        => $html,
                'maxNumPages' => $max_num_pages
            );

            echo json_encode($return_obj);
            exit;
        }

    }

    add_action('wp_ajax_nopriv_mkdf_listing_job_list_load_more_response', 'mkdf_listing_job_list_load_more_response');
    add_action('wp_ajax_mkdf_listing_job_list_load_more_response', 'mkdf_listing_job_list_load_more_response');
}