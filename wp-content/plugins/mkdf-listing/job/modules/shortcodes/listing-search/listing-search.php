<?php
namespace MikadoListing\Lib\Shortcodes;

use MikadoListing\Lib\Shortcodes\ShortcodeInterface;
use MikadoListing\Lib\Core;

/**
 * Class Button that represents button shortcode
 * @package ListerMikado\Modules\Shortcodes\Button
 */
class ListingSearch implements ShortcodeInterface
{

    private static $instance;
    private $base;
    private $basic_params;
    private $types;
    private $regions;
    private $categories;

    public function __construct() {

        $this->base = 'mkdf_listing_job_search';
        self::$instance = $this;

        add_action('vc_before_init', array($this, 'generateListingTypeArray'));
        add_action('vc_before_init', array($this, 'generateListingRegionArray'));
        add_action('vc_before_init', array($this, 'generateCategoriesArray'));
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


    public function getBase() {
        return $this->base;
    }

    public function generateListingTypeArray() {
        $types_array = mkdf_listing_job_get_listing_types(true);
        $this->types = $types_array['key_value'];
    }

    public function getListingTypes() {
        return $this->types;
    }

    public function generateListingRegionArray() {
        $region_array = mkdf_listing_job_get_listing_region(true);
        $this->regions = $region_array['key_value'];
    }

    public function getListingRegions() {
        return $this->regions;
    }

    public function generateCategoriesArray() {
        $category_array = mkdf_listing_job_get_listing_cats(true);
        $this->categories = $category_array['obj'];
    }

    public function getListingCategories() {
        return $this->categories;
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

    public function vcMap() {

        vc_map(array(
            'name'                      => esc_html__('Mikado Listing Search', 'mkdf-listing'),
            'base'                      => $this->base,
            'category'                  => esc_html__('by MIKADO', 'mkdf-listing'),
            'icon'                      => 'icon-wpb-ls-search extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'listing_search_keyword',
                    'heading'    => esc_html__('Enable search by Keyword', 'mkdf-listing'),
                    'value'      => array_flip(mkdf_listing_job_get_yes_no_select_array(true, true))
                ),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'listing_search_keyword_text',
                    'heading'    => esc_html__('Enter keyword text', 'mkdf-listing'),
                    'value'      => '',
                    'dependency' => array('element' => 'listing_search_keyword', 'value' => 'yes')
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'listing_search_type',
                    'heading'    => esc_html__('Enable search by type', 'mkdf-listing'),
                    'value'      => array_flip(mkdf_listing_job_get_yes_no_select_array(true, true))
                ),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'listing_search_type_text',
                    'heading'    => esc_html__('Enter type text', 'mkdf-listing'),
                    'value'      => '',
                    'dependency' => array('element' => 'listing_search_type', 'value' => 'yes')
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'listing_search_category',
                    'heading'    => esc_html__('Enable search by category', 'mkdf-listing'),
                    'value'      => array_flip(mkdf_listing_job_get_yes_no_select_array(true, true))
                ),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'listing_search_type_category',
                    'heading'    => esc_html__('Enter category text', 'mkdf-listing'),
                    'value'      => '',
                    'dependency' => array('element' => 'listing_search_category', 'value' => 'yes')
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'listing_search_region',
                    'heading'    => esc_html__('Enable search by region', 'mkdf-listing'),
                    'value'      => array_flip(mkdf_listing_job_get_yes_no_select_array(true, true))
                ),
                array(
                    'type'       => 'textfield',
                    'param_name' => 'listing_search_button_text',
                    'heading'    => esc_html__('Enter button text', 'mkdf-listing'),
                    'value'      => ''
                ),
            ),
        ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'listing_search_keyword'       => '',
            'listing_search_type'          => 'yes',
            'listing_search_category'      => 'yes',
            'listing_search_region'        => 'yes',
            'listing_search_button_text'   => esc_html__('SEARCH', 'mkdf-listing'),
            'listing_search_keyword_text'  => esc_html__('Keywords', 'mkdf-listing'),
            'listing_search_type_text'     => esc_html__('Type', 'mkdf-listing'),
            'listing_search_category_text' => esc_html__('All Categories', 'mkdf-listing'),
        );
        $params = shortcode_atts($args, $atts);
        $this->resetBasicParams();
        $this->setBasicParams($params);

        $this->setBasicParams(array(
            'holder_classes' => $this->getHolderClasses()
        ));

        return mkdf_listing_job_get_shortcode_module_template_part('templates/holder', 'listing-search');

    }

    public function getHolderClasses() {

        $classes = array();

        $cols = 1; /* Button is always displayed */
        $listing_search_keyword = $this->getBasicParamByKey('listing_search_keyword');
        $listing_search_type = $this->getBasicParamByKey('listing_search_type');
        $listing_search_category = $this->getBasicParamByKey('listing_search_category');
        $listing_search_region = $this->getBasicParamByKey('listing_search_region');
        if ($listing_search_keyword && $listing_search_keyword == 'yes') {
            $cols++;
        }
        if ($listing_search_type && $listing_search_type == 'yes') {
            $cols++;
        }
        if ($listing_search_category && $listing_search_category == 'yes') {
            $cols++;
        }
        if ($listing_search_region && $listing_search_region == 'yes') {
            $cols++;
        }

        $classes[] = 'mkdf-columns-' . $cols;

        return implode($classes);
    }

}