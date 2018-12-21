<?php
namespace MikadoListing\Lib\Shortcodes;

use MikadoListing\Lib\Shortcodes\ShortcodeInterface;
use MikadoListing\Lib\Core;

/**
 * Class Button that represents button shortcode
 * @package ListerMikado\Modules\Shortcodes\Button
 */
class ListingSearchSimple implements ShortcodeInterface
{

    private static $instance;
    private $base;
    private $basic_params;
    private $types;
    private $regions;
    private $categories;

    public function __construct() {

        $this->base = 'mkdf_listing_job_search_simple';
        self::$instance = $this;

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
            'name'                      => esc_html__('Mikado Listing Search Simple', 'mkdf-listing'),
            'base'                      => $this->base,
            'category'                  => esc_html__('by MIKADO', 'mkdf-listing'),
            'icon'                      => 'icon-wpb-ls-search extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'       => 'textfield',
                    'param_name' => 'listing_search_keyword_text',
                    'heading'    => esc_html__('Enter keyword text', 'mkdf-listing'),
                    'value'      => '',
                    'dependency' => array('element' => 'listing_search_keyword', 'value' => 'yes')
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
            'listing_search_keyword'       => 'yes',
            'listing_search_button_text'   => esc_html__('SEARCH', 'mkdf-listing'),
            'listing_search_keyword_text'  => esc_html__('Keywords', 'mkdf-listing'),
        );
        $params = shortcode_atts($args, $atts);
        $this->resetBasicParams();
        $this->setBasicParams($params);

        $this->setBasicParams(array(
            'holder_classes' => $this->getHolderClasses()
        ));

        return mkdf_listing_job_get_shortcode_module_template_part('templates/holder', 'listing-search-simple');

    }

    public function getHolderClasses() {

        $classes = array();

        $cols = 1; /* Button is always displayed */
        $listing_search_keyword = $this->getBasicParamByKey('listing_search_keyword');
        if ($listing_search_keyword && $listing_search_keyword == 'yes') {
            $cols++;
        }

        $classes[] = 'mkdf-columns-' . $cols;

        return implode($classes);
    }

}