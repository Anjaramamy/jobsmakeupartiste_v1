<?php
namespace MikadoListing\Lib\Shortcodes;

use MikadoListing\Lib\Shortcodes\ShortcodeInterface;
use MikadoListing\Lib\Core;

/**
 * Class ListingAdvancedSearch
 * @package MikadoListing\Lib\Shortcodes
 */
class ListingAdvancedSearch implements ShortcodeInterface
{

    private static $instance;
    private $basic_params;
    private $base;
    private $types;
    private $query;

    public function __construct() {

        $this->base = 'mkdf_listing_job_advanced_search';
        self::$instance = $this;

        add_action('vc_before_init', array($this, 'generateListingTypeArray'));
        add_action('vc_before_init', array($this, 'vcMap'));

    }


    /**
     * Returns current instance of class
     * @return ListingAdvancedSearch
     */
    public static function getInstance() {
        if (self::$instance == null) {
            return new self;
        }

        return self::$instance;
    }

    /**
     * Make sleep magic method private, so nobody can serialize instance.
     */

    private function __clone() {
    }

    /**
     * Make sleep magic method private, so nobody can serialize instance.
     */
    private function __sleep() {
    }

    /**
     * Make wakeup magic method private, so nobody can unserialize instance.
     */
    private function __wakeup() {
    }

    public function generateListingTypeArray() {
        $this->types = mkdf_listing_job_get_listing_types_VC_Array();
    }

    public function getBase() {
        return $this->base;
    }

    public function setBasicParams($params = array()) {

        if (is_array($params) && count($params)) {
            foreach ($params as $param_key => $param_value) {
                $this->basic_params[$param_key] = $param_value;
            }
        }

    }

    public function resetBasicParams() {
        if (is_array($this->basic_params) && count($this->basic_params)) {
            foreach ($this->basic_params as $param_key => $param_value) {
                unset($this->basic_params[$param_key]);
            }
        }
    }

    public function getBasicParams() {
        return $this->basic_params;
    }

    public function getBasicParamByKey($key) {
        return $this->basic_params[$key];
    }

    public function setQueryResults($query) {
        $this->query = $query;
    }

    public function getQueryResults() {
        return $this->query;
    }

    public function vcMap() {

        vc_map(array(
            'name'                      => esc_html__('Mikado Listing Advanced Search', 'mkdf-listing'),
            'base'                      => $this->base,
            'category'                  => esc_html__('by MIKADO', 'mkdf-listing'),
            'icon'                      => 'icon-wpb-ls-adv-search extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'number',
                    'heading'     => esc_html__('Number of items', 'mkdf-listing'),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'search_title',
                    'heading'     => esc_html__('Listing Title', 'mkdf-listing'),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'load_more',
                    'heading'     => esc_html__('Enable load more', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'content_in_grid',
                    'heading'     => esc_html__('Content in Grid', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'enable_map',
                    'heading'     => esc_html__('Enable Map', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'map_in_grid',
                    'heading'     => esc_html__('Map in Grid', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array(true)),
                    'admin_label' => true,
                    'dependency'  => array(
                        'element' => 'enable_map',
                        'value'   => 'yes'
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'enable_sidebar',
                    'heading'     => esc_html__('Enable Sidebar', 'mkdf-listing'),
                    'description' => esc_html__('Enable a Custom Sidebar which can be set from Mikado Sidebar Options', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array(true)),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'keyword_search',
                    'heading'     => esc_html__('Enable Keyword Search', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'location_search',
                    'heading'     => esc_html__('Enable Location Search', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'category_search',
                    'heading'     => esc_html__('Enable Category Search', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'item_type',
                    'heading'     => esc_html__('Listing Item Type', 'mkdf-listing'),
                    'value'       => array(
                        esc_html__('Standard', 'mkdf-listing') => 'standard',
                        esc_html__('List', 'mkdf-listing')     => 'list',
                    ),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'enable_item_appear_animation',
                    'heading'     => esc_html__('Enable Item Appear Animation', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'image_size',
                    'heading'     => esc_html__('Image Size', 'mkdf-listing'),
                    'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'mkdf-listing'),
                    'dependency'  => array(
                        'element' => 'item_type',
                        'value'   => 'standard'
                    )
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'title_tag',
                    'heading'    => esc_html__('Title Tag', 'mkdf-listing'),
                    'value'      => array_flip(staffscout_mikado_get_title_tag(true)),
                    'dependency' => array('element' => 'item_type', 'value' => array('standard')),
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'border',
                    'heading'     => esc_html__('Enable Border', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array()),
                    'dependency'  => array('element' => 'item_type', 'value' => array('standard')),
                    'save_always' => true
                )
            )
        ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'type'                         => 'all',
            'number'                       => '-1',
            'load_more'                    => '',
            'content_in_grid'              => '',
            'enable_map'                   => '',
            'map_in_grid'                  => '',
            'enable_sidebar'               => '',
            'keyword_search'               => 'yes',
            'location_search'              => 'yes',
            'category_search'              => 'yes',
            'banner_image'                 => '',
            'banner_text'                  => '',
            'search_title'                 => '',
            'banner_link'                  => '',
            'item_type'                    => 'standard',
            'enable_item_appear_animation' => '',
            'image_size'                   => 'full',
            'title_tag'                    => 'h4',
            'border'                       => 'no',
        );

        $params = shortcode_atts($args, $atts);
        $this->resetBasicParams();
        $this->setBasicParams($params);
        extract($params);

        //get query results
        $query_results = null;

        $query_params = array(
            'post_number' => $number
        );

        $query_results = mkdf_listing_job_get_listing_query_results($query_params);

        //set query results
        $this->setQueryResults($query_results);

        //init google map if is chosen in shortcode options
        $this->initGoogleMap();

        //add data param
        $this->setBasicParams(array(
            'data_params'    => $this->getDattaParams(),
            'holder_classes' => $this->getHolderClasses(),
            'items_classes'  => $this->getItemsClasses(),
            'image_size'     => $this->getImageSize($params['image_size']),
        ));

        echo mkdf_listing_job_get_shortcode_module_template_part('templates/holder', 'listing-advanced-search');
    }

    private function getHolderClasses() {

        $classes = array();

        $map_flag = $this->getBasicParamByKey('enable_map') === 'yes' ? true : false;

        if ($map_flag) {
            $classes[] = 'mkdf-ls-adv-with-map';
        }

        $sidebar_flag = $this->getBasicParamByKey('enable_sidebar') === 'yes' ? true : false;

        if ($sidebar_flag) {
            $classes[] = 'mkdf-ls-adv-with-sidebar';
        }

        $border = $this->getBasicParamByKey('border');
        if ($border && $border === 'yes') {
            $classes[] = 'mkdf-has-border';
        }

        return implode($classes, ' ');

    }

    private function getItemsClasses() {

        $classes = array();

        $item_type = $this->getBasicParamByKey('item_type');

        if ($item_type === 'standard') {
            $classes[] = 'mkdf-outer-space';
        } else {
            $classes[] = '';
        }

        return implode($classes, ' ');

    }

    private function getDattaParams() {

        $dataString = '';
        $params = $this->getBasicParams();

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        $params['max_num_pages'] = 0;
        $query_results = $this->getQueryResults();

        if ($query_results && $query_results !== null) {
            $params['max_num_pages'] = $query_results->max_num_pages;
        }

        if (isset($paged)) {
            $params['next_page'] = $paged + 1;
        }

        foreach ($params as $key => $value) {
            if ($value !== '') {
                $new_key = str_replace('_', '-', $key);
                $dataString .= ' data-' . $new_key . '="' . esc_attr($value) . '"';
            }
        }

        return $dataString;
    }

    public function getImageSize($image_size) {
        $image_size = trim($image_size);
        //Find digits
        preg_match_all('/\d+/', $image_size, $matches);
        if (in_array($image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
            return $image_size;
        } elseif (!empty($matches[0])) {
            return array(
                $matches[0][0],
                $matches[0][1]
            );
        } else {
            return 'full';
        }
    }

    public function getListingTypeHtml() {

        $html = '';
        $listing_types = mkdf_listing_job_get_listing_types_by_listing_id(get_the_ID());

        if (count($listing_types)) {

            $html .= '<div class="mkdf-listing-type-wrapper">';
            foreach ($listing_types as $type) {
                $html .= '<a href="' . esc_url($type['link']) . '">';
                $html .= '<span>' . esc_attr($type['name']) . '</span>';
                $html .= '</a>';
            }

            $html .= '</div>';
        }

        return $html;

    }

    public function getListingCategoryHtml() {

        $html = mkdf_listing_job_get_listing_categories_by_listing_id(get_the_ID());
        return $html;

    }


    public function getListingAverageRating() {

        $html = '';
        $rating_obj = new Core\ListingRating(get_the_ID(), false, 'get_average_rating');
        $html .= $rating_obj->getRatingHtml();

        return $html;
    }

    public function getAddressIconHtml() {

        $html = mkdf_listing_job_get_address_html(get_the_ID());
        return $html;

    }

    public function initGoogleMap() {
        $enable_map = $this->getBasicParamByKey('enable_map');
        if ($enable_map === 'yes') {
            //generate multiple map global vars from current query results
            $map_array = array(
                'type'              => 'multiple',
                'query'             => $this->getQueryResults(),
                'init_multiple_map' => true
            );
            mkdf_listing_job_generate_listing_map_vars($map_array);
        }
    }

}