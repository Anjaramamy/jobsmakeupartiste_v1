<?php
namespace MikadoListing\Lib\Shortcodes;

use MikadoListing\Lib\Shortcodes\ShortcodeInterface;

/**
 * Class ListingList
 * @package MikadoListing\Lib\Shortcodes
 */
class ListingSlider implements ShortcodeInterface
{

    private static $instance;
    private $base;
    private $basic_params;
    private $types;
    private $cats;

    public function __construct() {

        $this->base = 'mkdf_listing_job_slider';
        self::$instance = $this;

        add_action('vc_before_init', array($this, 'vcMap'));
        $this->generateListingCatsArray();
        $this->generateListingTypeArray();

    }


    /**
     * Returns current instance of class
     * @return ListingList
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

    public function setQueryResults($query) {
        $this->query = $query;
    }

    public function getQueryResults() {
        return $this->query;
    }

    public function generateListingTypeArray() {
        $this->types = mkdf_listing_job_get_listing_types_VC_Array();
    }

    public function getListingTypes() {
        return $this->types;
    }

    public function generateListingCatsArray() {
        $this->cats = mkdf_listing_job_categories_VC_ARRAY(true);
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Mikado Listing Slider', 'mkdf-listing'),
            'base'                      => $this->base,
            'category'                  => esc_html__('by MIKADO', 'mkdf-listing'),
            'icon'                      => 'icon-wpb-ls-slider extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'type',
                    'heading'     => esc_html__('List Type', 'mkdf-listing'),
                    'value'       => array(
                        esc_html__('Default', 'mkdf-listing') => 'default',
                        esc_html__('Simple', 'mkdf-listing')  => 'simple',
                        esc_html__('Tiles', 'mkdf-listing')   => 'tiles',
                    ),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'listing_type',
                    'heading'     => esc_html__('Listing Type', 'mkdf-listing'),
                    'value'       => $this->types,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'listing_category',
                    'heading'     => esc_html__('Listing Category', 'mkdf-listing'),
                    'value'       => $this->cats,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'listing_list_id',
                    'heading'     => esc_html__('IDs of listing items', 'mkdf-listing'),
                    'description' => esc_html__('Enter IDs of listing items separated with comma (for example 23,24,35)', 'mkdf-listing'),
                    'value'       => '',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'listing_list_number',
                    'heading'     => esc_html__('Number of items', 'mkdf-listing'),
                    'value'       => '',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'listing_list_columns',
                    'heading'     => esc_html__('Number of columns', 'mkdf-listing'),
                    'value'       => array(
                        esc_html__('Default', 'mkdf-listing')       => '',
                        esc_html__('One Column', 'mkdf-listing')    => '1',
                        esc_html__('Two Columns', 'mkdf-listing')   => '2',
                        esc_html__('Three Columns', 'mkdf-listing') => '3',
                        esc_html__('Four Columns', 'mkdf-listing')  => '4',
                        esc_html__('Five Columns', 'mkdf-listing')  => '5',
                        esc_html__('Six Columns', 'mkdf-listing')   => '6'
                    ),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'listing_space_between_items',
                    'heading'     => esc_html__('Space Between Listings', 'mkdf-listing'),
                    'value'       => array_flip(staffscout_mikado_get_space_between_items_array()),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'listing_border',
                    'heading'     => esc_html__('Enable Border', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array()),
                    'dependency'  => array('element' => 'type', 'value' => array('default')),
                    'save_always' => true
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'title_tag',
                    'heading'    => esc_html__( 'Title Tag', 'mkdf-listing' ),
                    'value'      => array_flip( staffscout_mikado_get_title_tag( true ) ),
                    'dependency' => array( 'element' => 'type', 'value'   => array( 'default' ) ),
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'enable_loop',
                    'heading'     => esc_html__('Enable Slider Loop', 'mkdf-listing'),
                    'value'       => array_flip(staffscout_mikado_get_yes_no_select_array(false, false)),
                    'save_always' => true,
                    'group'       => esc_html__('Slider Settings', 'mkdf-listing')
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'enable_autoplay',
                    'heading'     => esc_html__('Enable Slider Autoplay', 'mkdf-listing'),
                    'value'       => array_flip(staffscout_mikado_get_yes_no_select_array(false, true)),
                    'save_always' => true,
                    'group'       => esc_html__('Slider Settings', 'mkdf-listing')
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'slider_speed',
                    'heading'     => esc_html__('Slide Duration', 'mkdf-listing'),
                    'description' => esc_html__('Default value is 5000 (ms)', 'mkdf-listing'),
                    'group'       => esc_html__('Slider Settings', 'mkdf-listing')
                ),
                array(
                    'type'        => 'textfield',
                    'param_name'  => 'slider_speed_animation',
                    'heading'     => esc_html__('Slide Animation Duration', 'mkdf-listing'),
                    'description' => esc_html__('Speed of slide animation in milliseconds. Default value is 600.', 'mkdf-listing'),
                    'group'       => esc_html__('Slider Settings', 'mkdf-listing')
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'enable_navigation',
                    'heading'     => esc_html__('Enable Slider Navigation Arrows', 'mkdf-listing'),
                    'value'       => array_flip(staffscout_mikado_get_yes_no_select_array(false, true)),
                    'save_always' => true,
                    'group'       => esc_html__('Slider Settings', 'mkdf-listing')
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'enable_pagination',
                    'heading'     => esc_html__('Enable Slider Pagination', 'mkdf-listing'),
                    'value'       => array_flip(staffscout_mikado_get_yes_no_select_array(false, true)),
                    'save_always' => true,
                    'group'       => esc_html__('Slider Settings', 'mkdf-listing')
                )

			)
		));

	}

    public function render($atts, $content = null) {
        $args = array(
            'type'                        => '',
            'listing_type'                => '',
            'listing_list_id'             => '',
            'listing_list_number'         => '-1',
            'listing_list_columns'        => '4',
            'listing_space_between_items' => 'normal',
            'listing_category'            => '',
            'listing_border'              => '',
            'enable_loop'                 => 'no',
            'enable_autoplay'             => 'yes',
            'slider_speed'                => '5000',
            'slider_speed_animation'      => '600',
            'enable_navigation'           => 'yes',
            'enable_pagination'           => 'yes',
            'title_tag'                 => 'h4',
        );
        $params = shortcode_atts($args, $atts);
        extract($params);

        $this->resetBasicParams();
        $this->setBasicParams($params);

        $this->setBasicParams(array(
            'listing_slider' => 'yes'
        ));

        $html = '<div class="mkdf-ls-slider-holder">';
        $html .= staffscout_mikado_execute_shortcode('mkdf_listing_job_list', $this->getBasicParams());
        $html .= '</div>';

        return $html;

    }
}