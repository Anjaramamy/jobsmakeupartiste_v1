<?php
namespace MikadoListing\Lib\Shortcodes;

use MikadoListing\Lib\Shortcodes\ShortcodeInterface;

/**
 * Class ListingList
 * @package MikadoListing\Lib\Shortcodes
 */
class ListingTypes implements ShortcodeInterface {

	private static $instance;
	private $base;
	private $basic_params;
	private $types;

	public function __construct() {

		$this->base = 'mkdf_listing_job_types';
		self::$instance = $this;

		add_action('vc_before_init', array($this, 'generateListingTypeArray'));
		add_action('vc_before_init', array($this, 'vcMap'));

		//Listing type filter
		add_filter( 'vc_autocomplete_mkdf_listing_job_types_type_callback', array( &$this, 'listingTypeAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Listing type render
		add_filter( 'vc_autocomplete_mkdf_listing_job_types_type_render', array( &$this, 'listingTypeAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Listing category filter
        add_filter( 'vc_autocomplete_mkdf_listing_job_types_category_callback', array( &$this, 'listingCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Listing category render
        add_filter( 'vc_autocomplete_mkdf_listing_job_types_category_render', array( &$this, 'listingCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}


	/**
	 * Returns current instance of class
	 * @return ListingList
	 */
	public static function getInstance() {

		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}
	/**
	 * Make sleep magic method private, so nobody can serialize instance.
	 */

	private function __clone() {}

	/**
	 * Make sleep magic method private, so nobody can serialize instance.
	 */
	private function __sleep() {}

	/**
	 * Make wakeup magic method private, so nobody can unserialize instance.
	 */
	private function __wakeup() {}

	public function getBase() {
		return $this->base;
	}

	public function setBasicParams($params = array()){

		if(is_array($params) && count($params)){
			foreach($params as $param_key => $param_value){
				$this->basic_params[$param_key] = $param_value;
			}
		}

	}

	public function resetBasicParams(){
		if(is_array($this->basic_params) && count($this->basic_params)){
			foreach ($this->basic_params as $param_key => $param_value) {
				unset($this->basic_params[$param_key]);
			}
		}
	}

	public function getBasicParams(){
		return $this->basic_params;
	}

	public function getBasicParamByKey($key){
		return $this->basic_params[$key];
	}

	public function setQueryResults($query){
		$this->query = $query;
	}
	public function getQueryResults(){
		return $this->query;
	}

	public function generateListingTypeArray(){
		$this->types = mkdf_listing_job_get_listing_types_VC_Array();
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Mikado Listing Types', 'mkdf-listing'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by MIKADO', 'mkdf-listing'),
			'icon'                      => 'icon-wpb-ls-types extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'taxonomy',
                    'heading'    => esc_html__( 'Taxonomy to Display', 'mkdf-listing' ),
                    'value'      => array(
                        esc_html__('Type', 'mkdf-listing')   => 'type',
                        esc_html__('Category', 'mkdf-listing') => 'category',
                    ),
                    'save_always' => true
                ),
                array(
                    'type'        => 'autocomplete',
                    'param_name'  => 'type',
                    'heading'     => esc_html__( 'Show Only Listed Types', 'mkdf-listing' ),
                    'settings'    => array(
                        'multiple'      => true,
                        'sortable'      => true,
                        'unique_values' => true
                    ),
                    'dependency' => array( 'element' => 'taxonomy', 'value'   => array( 'type' ) )
                ),
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'listing_type',
                    'heading'     => esc_html__('Listing Type', 'mkdf-listing'),
                    'value'       => $this->types,
                    'admin_label' => true,
                    'dependency' => array( 'element' => 'taxonomy', 'value'   => array( 'category' ) )
                ),
				array(
					'type'        => 'textfield',
					'param_name'  => 'listing_type_number',
					'heading'     => esc_html__('Number of types', 'mkdf-listing'),
					'value'       => '',
					'admin_label' => true
				),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'layout',
                    'heading'    => esc_html__( 'List Layout', 'mkdf-listing' ),
                    'value'      => array(
                        esc_html__('Advanced', 'mkdf-listing')   => 'advanced',
                        esc_html__('Simple', 'mkdf-listing') => 'simple',
                    ),
                    'save_always' => true
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'number_of_columns',
                    'heading'    => esc_html__( 'Number of Columns', 'mkdf-listing' ),
                    'value'      => array(
                        esc_html__( 'One', 'mkdf-listing' )   => '1',
                        esc_html__( 'Two', 'mkdf-listing' )   => '2',
                        esc_html__( 'Three', 'mkdf-listing' ) => '3',
                        esc_html__( 'Four', 'mkdf-listing' )  => '4',
                        esc_html__( 'Five', 'mkdf-listing' )  => '5',
                        esc_html__( 'Six', 'mkdf-listing' )  => '6'
                    )
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'space_between_columns',
                    'heading'    => esc_html__( 'Space Between Columns', 'mkdf-listing' ),
                    'value'       => array_flip( staffscout_mikado_get_space_between_items_array() ),
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'show_type_number',
                    'heading'    => esc_html__( 'Show Type Number', 'mkdf-listing' ),
                    'value'      => array_flip( staffscout_mikado_get_yes_no_select_array( false, false ) ),
                    'group'      => esc_html__( 'Layout Options', 'mkdf-listing' ),
                    'dependency' => array( 'element' => 'layout', 'value'   => array( 'advanced' ) )
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'show_type_title',
                    'heading'    => esc_html__( 'Show Type Title', 'mkdf-listing' ),
                    'value'      => array_flip( staffscout_mikado_get_yes_no_select_array( false, true ) ),
                    'group'      => esc_html__( 'Layout Options', 'mkdf-listing' ),
                    'dependency' => array( 'element' => 'layout', 'value'   => array( 'advanced' ) )
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'title_tag',
                    'heading'    => esc_html__( 'Title Tag', 'mkdf-listing' ),
                    'value'      => array_flip( staffscout_mikado_get_title_tag( true ) ),
                    'dependency' => array( 'element' => 'show_type_title', 'value'   => array( 'yes' ) ),
                    'group'      => esc_html__( 'Layout Options', 'mkdf-listing' ),
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'show_type_desc',
                    'heading'    => esc_html__( 'Show Type Description', 'mkdf-listing' ),
                    'value'      => array_flip( staffscout_mikado_get_yes_no_select_array( false, true ) ),
                    'group'      => esc_html__( 'Layout Options', 'mkdf-listing' ),
                    'dependency' => array( 'element' => 'layout', 'value'   => array( 'advanced' ) )
                ),
			)
		));

	}

	public function render($atts, $content = null) {
		$args = array(
            'taxonomy'                  => 'type',
            'type'                      => '',
            'listing_type'              => '',
            'category'                  => '',
            'listing_type_number'       => '',
			'layout'                    => 'advanced',
			'number_of_columns'         => '4',
			'space_between_columns'     => 'normal',
			'show_type_number'          => 'no',
			'show_type_title'           => 'yes',
			'title_tag'                 => 'h4',
			'show_type_desc'            => 'yes',
		);
		$params = shortcode_atts($args, $atts);
		extract($params);
		$this->resetBasicParams();
		$this->setBasicParams($params);

        $this->setBasicParams(
            array(
                'holder_classes' => $this->getHolderClasses(),
                'holder_inner_classes' => $this->getHolderInnerClasses(),
            )
        );

		$query_params = array(
			'number'     => $listing_type_number
		);

        if($params['taxonomy'] == 'type') {
            $query_params['taxonomy'] = 'job_listing_type';
            if (!empty($params['type'])) {
                $query_params['include'] = $this->getSelectedTypes();
                $query_params['include_params'] = $params['type'];
            }
        } else if($params['taxonomy'] =='category') {
            $query_params['taxonomy'] = 'job_listing_category';
            if(!empty($params['listing_type'])){
                $query_params['meta_key']  = 'listing_type';
                $query_params['meta_value']  = $params['listing_type'];
            }else{
                if (!empty($params['category'])) {
                    $query_params['include'] = $this->getSelectedCategories();
                    $query_params['include_params'] = $params['category'];
                }
            }
        }

		$terms = mkdf_listing_job_get_listing_taxonomies_formatted($query_params);

		$this->setQueryResults($terms);

		return mkdf_listing_job_get_shortcode_module_template_part('templates/holder', 'listing-types');

	}

    public function getSelectedTypes(){

        $selected_types = explode(',',$this->getBasicParamByKey('type'));
        $selected_types_array = array();

        if(is_array($selected_types) && count($selected_types)){
            foreach ($selected_types as $type_slug){
                $type =  get_term_by( 'slug', $type_slug, 'job_listing_type');
                if($type){
                    $selected_types_array[] = $type->term_id;
                }

            }
        }

        return $selected_types_array;

    }

    public function getSelectedCategories(){

        $selected_cats = explode(',',$this->getBasicParamByKey('category'));
        $selected_cats_array = array();

        if(is_array($selected_cats) && count($selected_cats)){
            foreach ($selected_cats as $cat_slug){
                $cat =  get_term_by( 'slug', $cat_slug, 'job_listing_category');
                if($cat){
                    $selected_cats_array[] = $cat->term_id;
                }

            }
        }

        return $selected_cats_array;

    }

    public function getHolderClasses(){

        $classes = array();

        $layout = $this->getBasicParamByKey('layout');
        if($layout && $layout !== ''){
            $classes[] = 'mkdf-ls-type-' . $layout;
        }


        $column_space = $this->getBasicParamByKey('space_between_columns');
        if($column_space && $column_space !== ''){
            $classes[] = 'mkdf-' . $column_space . '-space';
        }

        $column_number = $this->getBasicParamByKey('number_of_columns');
        if($column_number && $column_number !== ''){
            switch ( $column_number ):
                case '1':
                    $classes[] = 'mkdf-ls-types-one-column';
                    break;
                case '2':
                    $classes[] = 'mkdf-ls-types-two-columns';
                    break;
                case '3':
                    $classes[] = 'mkdf-ls-types-three-columns';
                    break;
                case '4':
                    $classes[] = 'mkdf-ls-types-four-columns';
                    break;
                case '5':
                    $classes[] = 'mkdf-ls-types-five-columns';
                    break;
                case '6':
                    $classes[] = 'mkdf-ls-types-six-columns';
                    break;
                default:
                    $classes[] = 'mkdf-ls-types-four-columns';
                    break;
            endswitch;
        }

        $type = $this->getBasicParamByKey('type');
        if($type && $type !== ''){
            $classes[] = 'mkdf-ls-'.$type.'-taxonomy';
        }

        return implode($classes, ' ');
    }

    public function getHolderInnerClasses(){
        $classes = array();

        $classes[] = 'mkdf-outer-space';

        return implode($classes, ' ');

    }


    public function getQueryArray(){

        $query_params = array(
            'post_number' => $this->getBasicParamByKey('listing_list_number')
        );

        $type = $this->getBasicParamByKey('listing_type');
        $listing_category = $this->getBasicParamByKey('listing_category');

        if($type !== ''){
            $query_params['type'] = $type;
        }
        if($listing_category !== ''){
            $query_params['category_array'] = array($listing_category);
        }

        return $query_params;

    }


	/**
	 * Filter listing types
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function listingTypeAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS listing_type_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'job_listing_type' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['listing_type_title'] ) > 0 ) ? esc_html__( 'Type', 'mkdf-listing' ) . ': ' . $value['listing_type_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find listing type by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function listingTypeAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio type
			$listing_type = get_term_by( 'slug', $query, 'job_listing_type' );
			if ( is_object( $listing_type ) ) {

				$listing_type_slug = $listing_type->slug;
				$listing_type_title = $listing_type->name;

				$listing_type_title_display = '';
				if ( ! empty( $listing_type_title ) ) {
					$listing_type_title_display = esc_html__( 'Type', 'mkdf-listing' ) . ': ' . $listing_type_title;
				}

				$data          = array();
				$data['value'] = $listing_type_slug;
				$data['label'] = $listing_type_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

    /**
     * Filter listing categories
     *
     * @param $query
     *
     * @return array
     */
    public function listingCategoryAutocompleteSuggester( $query ) {
        global $wpdb;
        $post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS listing_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'job_listing_category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['slug'];
                $data['label'] = ( ( strlen( $value['listing_category_title'] ) > 0 ) ? esc_html__( 'Category', 'mkdf-listing' ) . ': ' . $value['listing_category_title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find listing category by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function listingCategoryAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get portfolio type
            $listing_category = get_term_by( 'slug', $query, 'job_listing_category' );
            if ( is_object( $listing_category ) ) {

                $listing_category_slug = $listing_category->slug;
                $listing_category_title = $listing_category->name;

                $listing_category_title_display = '';
                if ( ! empty( $listing_category_title ) ) {
                    $listing_category_title_display = esc_html__( 'Category', 'mkdf-listing' ) . ': ' . $listing_category_title;
                }

                $data          = array();
                $data['value'] = $listing_category_slug;
                $data['label'] = $listing_category_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }

}