<?php
namespace MikadoListing\Lib\Shortcodes;

use MikadoListing\Lib\Shortcodes\ShortcodeInterface;

/**
 * Class ListingList
 * @package MikadoListing\Lib\Shortcodes
 */
class ListingList implements ShortcodeInterface
{

    private static $instance;
    private $base;
    private $basic_params;
    private $cats;
    private $types;
    private $query;

    public function __construct() {

        $this->base = 'mkdf_listing_job_list';
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
            'name'                      => esc_html__('Mikado Listing List', 'mkdf-listing'),
            'base'                      => $this->base,
            'category'                  => esc_html__('by MIKADO', 'mkdf-listing'),
            'icon'                      => 'icon-wpb-ls-list extended-custom-icon',
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
                        esc_html__('Grid', 'mkdf-listing')    => 'grid',
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
                    'type'        => 'textfield',
                    'param_name'  => 'listing_image_size',
                    'heading'     => esc_html__('Image Size', 'mkdf-listing'),
                    'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'mkdf-listing')
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'order_by',
                    'heading'     => esc_html__('Order By', 'mkdf-listing'),
                    'value'       => array(
                        esc_html__('Date', 'mkdf-listing')       => 'date',
                        esc_html__('Title', 'mkdf-listing')      => 'title',
                        esc_html__('Menu Order', 'mkdf-listing') => 'menu_order',
                        esc_html__('Featured', 'mkdf-listing')   => 'featured',
                    ),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'order',
                    'heading'     => esc_html__('Order', 'mkdf-listing'),
                    'value'       => array(
                        esc_html__('ASC', 'mkdf-listing')  => 'ASC',
                        esc_html__('DESC', 'mkdf-listing') => 'DESC',
                    ),
                    'save_always' => true
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
                    'type'       => 'dropdown',
                    'param_name' => 'title_tag',
                    'heading'    => esc_html__( 'Title Tag', 'mkdf-listing' ),
                    'value'      => array_flip( staffscout_mikado_get_title_tag( true ) ),
                    'dependency' => array( 'element' => 'type', 'value'   => array( 'default' ) ),
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
                    'param_name'  => 'load_more',
                    'heading'     => esc_html__('Enable Load More', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array()),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'listing_border',
                    'heading'     => esc_html__('Enable Border', 'mkdf-listing'),
                    'value'       => array_flip(mkdf_listing_job_get_yes_no_select_array()),
                    'dependency'  => array('element' => 'type', 'value' => array('default')),
                    'save_always' => true
                )
            )
        ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'type'                        => 'default',
            'listing_type'                => '',
            'listing_list_id'             => '',
            'listing_list_number'         => '-1',
            'order_by'                    => 'date',
            'order'                       => 'ASC',
            'listing_list_columns'        => '3',
            'listing_space_between_items' => 'normal',
            'listing_image_size'          => 'full',
            'listing_category'            => '',
            'listing_slider'              => 'no',
            'enable_loop'                 => '',
            'enable_autoplay'             => '',
            'slider_speed'                => '',
            'slider_speed_animation'      => '',
            'enable_navigation'           => '',
            'enable_pagination'           => '',
            'load_more'                   => 'no',
            'listing_border'              => 'no',
            'title_tag'                 => 'h4',
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

        $this->resetBasicParams();
        $this->setBasicParams($params);

        $query_results = mkdf_listing_job_get_listing_query_results($this->getQueryArray());

        $this->setQueryResults($query_results);

        $this->setBasicParams(
            array(
                'holder_classes'       => $this->getHolderClasses(),
                'holder_inner_classes' => $this->getHolderInnerClasses(),
                'holder_data_params'   => $this->getHolderDataParams(),
                'image_size'           => $this->getImageSize($params['listing_image_size']),
                'data_params'          => $this->getDataParams()
            )
        );

        return mkdf_listing_job_get_shortcode_module_template_part('templates/holder', 'listing-list');

    }

    public function getHolderClasses() {

        $classes = array();

        $load_more = $this->getBasicParamByKey('load_more');
        if ($load_more && $load_more === 'yes') {
            $classes[] = 'mkdf-has-load-more';
        }

        $border = $this->getBasicParamByKey('listing_border');
        if ($border && $border === 'yes') {
            $classes[] = 'mkdf-has-border';
        }

        $column_space = $this->getBasicParamByKey('listing_space_between_items');
        if ($column_space && $column_space !== '') {
            $classes[] = 'mkdf-' . $column_space . '-space';
        }

        $column_number = $this->getBasicParamByKey('listing_list_columns');
        if ($column_number && $column_number !== '') {
            switch ($column_number):
                case '1':
                    $classes[] = 'mkdf-ls-list-one-column';
                    break;
                case '2':
                    $classes[] = 'mkdf-ls-list-two-columns';
                    break;
                case '3':
                    $classes[] = 'mkdf-ls-list-three-columns';
                    break;
                case '4':
                    $classes[] = 'mkdf-ls-list-four-columns';
                    break;
                case '5':
                    $classes[] = 'mkdf-ls-list-five-columns';
                    break;
                case '6':
                    $classes[] = 'mkdf-ls-list-six-columns';
                    break;
                default:
                    $classes[] = 'mkdf-ls-list-four-columns';
                    break;
            endswitch;
        }

        $type = $this->getBasicParamByKey('type');
        if (!empty($type)) {
            $classes[] = 'mkdf-ls-list-' . esc_attr($type);
        }

        return implode($classes, ' ');
    }

    public function getHolderInnerClasses() {
        $classes = array();

        $slider = $this->getBasicParamByKey('listing_slider');

        $classes[] = 'mkdf-outer-space';

        if ($slider && $slider !== '' && $slider === 'yes') {
            $classes[] = 'mkdf-owl-slider';
        }

        return implode($classes, ' ');

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


    public function getQueryArray() {

        $query_params = array(
            'post_number' => $this->getBasicParamByKey('listing_list_number')
        );

        $type = $this->getBasicParamByKey('listing_type');
        $listing_category = $this->getBasicParamByKey('listing_category');
        $listing_ids = $this->getBasicParamByKey('listing_list_id');

        if (isset($type) && $type !== '') {
            $query_params['type'] = $type;
        }
        if (isset($listing_category) && $listing_category !== '') {
            $query_params['category_array'] = array($listing_category);
        }
        if (isset($listing_ids) && $listing_ids !== '') {
            $listing_ids_array = explode(',', $listing_ids);
            $query_params['post_in'] = $listing_ids_array;
        }

        $orderBy = $this->getBasicParamByKey('order_by');
        $order = $this->getBasicParamByKey('order');

        if ($orderBy === 'featured') {
            $query_params['default_meta_params'] = array('order' => $order);
            $query_params['meta_query_flag'] = true;
            $query_params['checkbox_meta_params'] = array('_featured' => '1');

        } else {
            $query_params['default_meta_params'] = array('orderby' => $orderBy, 'order' => $order);
        }

        return $query_params;

    }

    public function getHolderDataParams() {
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

    public function getDataParams() {
        $slider_data = array();

        $slider_data['data-number-of-items'] = $this->getBasicParamByKey('listing_list_columns');
        $slider_data['data-enable-loop'] = $this->getBasicParamByKey('enable_loop');
        $slider_data['data-enable-autoplay'] = $this->getBasicParamByKey('enable_autoplay');
        $slider_data['data-enable-navigation'] = $this->getBasicParamByKey('enable_navigation');
        $slider_data['data-enable-pagination'] = $this->getBasicParamByKey('enable_pagination');
        $slider_data['data-slider-speed'] = $this->getBasicParamByKey('slider_speed');
        $slider_data['data-slider-speed-animation'] = $this->getBasicParamByKey('slider_speed_animation');

        return $slider_data;
    }
}