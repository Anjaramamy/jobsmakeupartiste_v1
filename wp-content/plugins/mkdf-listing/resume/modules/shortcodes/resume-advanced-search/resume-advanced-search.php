<?php
namespace MikadoResume\Lib\Shortcodes;

use MikadoResume\Lib\Shortcodes\ShortcodeInterface;
use MikadoResume\Lib\Core;

/**
 * Class ResumeAdvancedSearch
 * @package MikadoResume\Lib\Shortcodes
 */
class ResumeAdvancedSearch implements ShortcodeInterface
{

    private static $instance;
    private $basic_params;
    private $base;
    private $types;
    private $query;

    public function __construct() {

        $this->base = 'mkdf_listing_resume_advanced_search';
        self::$instance = $this;

        add_action('vc_before_init', array($this, 'generateResumeTypeArray'));
        add_action('vc_before_init', array($this, 'vcMap'));

    }


    /**
     * Returns current instance of class
     * @return ResumeAdvancedSearch
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

    public function generateResumeTypeArray() {
        $this->types = mkdf_listing_resume_get_resume_types_VC_Array();
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
            'name'                      => esc_html__('Mikado Resume Advanced Search', 'mkdf-listing'),
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
                    'heading'     => esc_html__('Resume Title', 'mkdf-listing'),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'load_more',
                    'heading'     => esc_html__('Enable load more', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_resume_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'content_in_grid',
                    'heading'     => esc_html__('Content in Grid', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_resume_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'enable_map',
                    'heading'     => esc_html__('Enable Map', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_resume_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'map_in_grid',
                    'heading'     => esc_html__('Map in Grid', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_resume_get_yes_no_select_array(true)),
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
                    'value'       => array_flip(mkdf_listing_resume_get_yes_no_select_array(true)),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'keyword_search',
                    'heading'     => esc_html__('Enable Keyword Search', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_resume_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'location_search',
                    'heading'     => esc_html__('Enable Location Search', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_resume_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'category_search',
                    'heading'     => esc_html__('Enable Category Search', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_resume_get_yes_no_select_array(true)),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'item_type',
                    'heading'     => esc_html__('Resume Item Type', 'mkdf-listing'),
                    'value'       => array(
                        esc_html__('Standard', 'mkdf-listing') => 'standard',
                        esc_html__('List', 'mkdf-listing')     => 'list',
                    ),
                    'admin_label' => true
                )
            )
        ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'type'            => 'all',
            'number'          => '-1',
            'load_more'       => '',
            'content_in_grid' => '',
            'enable_map'      => '',
            'map_in_grid'     => '',
            'enable_sidebar'  => '',
            'keyword_search'  => 'yes',
            'location_search' => 'yes',
            'category_search' => 'yes',
            'banner_image'    => '',
            'banner_text'     => '',
            'search_title'    => '',
            'banner_link'     => '',
            'item_type'       => 'standard'
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

        $query_results = mkdf_listing_resume_get_resume_query_results($query_params);

        //set query results
        $this->setQueryResults($query_results);

        //init google map if is chosen in shortcode options
        $this->initGoogleMap();

        //add data param
        $this->setBasicParams(array(
            'data_params'    => $this->getDattaParams(),
            'holder_classes' => $this->getHolderClasses(),
            'items_classes' => $this->getItemsClasses()
        ));

        echo mkdf_listing_resume_get_shortcode_module_template_part('templates/holder', 'resume-advanced-search');
    }

    private function getHolderClasses() {

        $classes = array();

        $map_flag = $this->getBasicParamByKey('enable_map') === 'yes' ? true : false;

        if ($map_flag) {
            $classes[] = 'mkdf-rs-adv-with-map';
        }

        $sidebar_flag = $this->getBasicParamByKey('enable_sidebar') === 'yes' ? true : false;

        if ($sidebar_flag) {
            $classes[] = 'mkdf-rs-adv-with-sidebar';
        }

        return implode($classes, ' ');

    }

    private function getItemsClasses() {

        $classes = array();

        $item_type = $this->getBasicParamByKey('item_type');

        if($item_type === 'standard') {
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

    public function getResumeTypeHtml() {

        $html = '';
        $resume_types = mkdf_listing_resume_get_resume_types_by_resume_id(get_the_ID());

        if (count($resume_types)) {

            $html .= '<div class="mkdf-resume-type-wrapper">';
            foreach ($resume_types as $type) {
                $html .= '<a href="' . esc_url($type['link']) . '">';
                $html .= '<span>' . esc_attr($type['name']) . '</span>';
                $html .= '</a>';
            }

            $html .= '</div>';
        }

        return $html;

    }

    public function getResumeCategoryHtml() {

        $html = mkdf_listing_resume_get_resume_categories_by_resume_id(get_the_ID());
        return $html;

    }


    public function getResumeAverageRating() {

        $html = '';
        $rating_obj = new Core\ResumeRating(get_the_ID(), false, 'get_average_rating');
        $html .= $rating_obj->getRatingHtml();

        return $html;
    }

    public function getAddressIconHtml() {

        $html = mkdf_listing_resume_get_address_html(get_the_ID());
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
            mkdf_listing_resume_generate_resume_map_vars($map_array);
        }
    }

}