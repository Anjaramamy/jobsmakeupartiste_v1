<?php

class StaffScoutMikadoClassListingSliderWidget extends StaffScoutMikadoClassWidget {

	private $base;
    private $basic_params;
    private $cats;

    public function __construct() {
        parent::__construct(
            'mkdf_listing_slider',
            esc_html__( 'Mikado Listing Slider Widget', 'mkdf-listing' ),
            array( 'description' => esc_html__( 'Add listing slider to widget areas', 'mkdf-listing' ) )
        );

        $this->setParams(); print_r($this->setParams());
    }

    public function getBase() {
        return $this->base;
    }

    public function setBasicParams($params = array()){

        if(is_array($params) && count($params)){
            foreach($params as $param_key => $param_options){
                $this->basic_params[$param_key] = $param_options;
            }
        }

    }

    public function resetBasicParams(){
        if(is_array($this->basic_params) && count($this->basic_params)){
            foreach ($this->basic_params as $param_key => $param_options) {
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

    public function generateListingCatsArray(){
        $this->cats = mkdf_listing_job_categories_VC_ARRAY(true);
    }


    protected function setParams() {
        $this->params = array(
                array(
                    'type'  => 'textfield',
                    'name'  => 'widget_title',
                    'title' => esc_html__( 'Widget Title', 'mkdf-listing' )
                ),
                array(
                    'type'          => 'dropdown',
                    'name'          => 'type',
                    'title'         => esc_html__('List Type', 'mkdf-listing'),
                    'options'       => array(
                         'default' => esc_html__('Default', 'mkdf-listing'),
                         'simple' => esc_html__('Simple', 'mkdf-listing'),
                         'tiles' => esc_html__('Tiles', 'mkdf-listing') ,
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'listing_image_size',
                    'title'       => esc_html__( 'Image Size', 'mkdf-listing' ),
                    'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size', 'mkdf-listing' )
                ),
				array(
					'type'        => 'dropdown',
					'name'        => 'listing_category',
					'title'       => esc_html__('Listing Category', 'mkdf-listing'),
					'options'     => mkdf_listing_job_categories_VC_ARRAY(true)
				),
                array(
                    'type'        => 'textfield',
                    'name'        => 'listing_list_id',
                    'title'       => esc_html__('IDs of listing items', 'mkdf-listing'),
                    'description' => esc_html__('Enter IDs of listing items separated with comma (for example 23,24,35)', 'mkdf-listing'),
                    'options'     => '',
                ),
				array(
					'type'        => 'textfield',
					'name'        => 'listing_list_number',
					'title'       => esc_html__('Number of items', 'mkdf-listing'),
					'options'     => '',
				),
                array(
                    'type'        => 'dropdown',
                    'name'        => 'enable_loop',
                    'title'       => esc_html__( 'Enable Slider Loop', 'mkdf-listing' ),
                    'options'     => staffscout_mikado_get_yes_no_select_array( false, false )
                ),
                array(
                    'type'        => 'dropdown',
                    'name'        => 'enable_autoplay',
                    'title'       => esc_html__( 'Enable Slider Autoplay', 'mkdf-listing' ),
                    'options'     => staffscout_mikado_get_yes_no_select_array( false, true )
                ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'slider_speed',
                    'title'       => esc_html__( 'Slide Duration', 'mkdf-listing' ),
                    'description' => esc_html__( 'Default options is 5000 (ms)', 'mkdf-listing' ),
                ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'slider_speed_animation',
                    'title'       => esc_html__( 'Slide Animation Duration', 'mkdf-listing' ),
                    'description' => esc_html__( 'Speed of slide animation in milliseconds. Default options is 600.', 'mkdf-listing' )
                ),
                array(
                    'type'        => 'dropdown',
                    'name'        => 'enable_navigation',
                    'title'       => esc_html__( 'Enable Slider Navigation Arrows', 'mkdf-listing' ),
                    'options'     => staffscout_mikado_get_yes_no_select_array( false, true )
                ),
                array(
                    'type'        => 'dropdown',
                    'name'        => 'enable_pagination',
                    'title'       => esc_html__( 'Enable Slider Pagination', 'mkdf-listing' ),
                    'options'     => staffscout_mikado_get_yes_no_select_array( false, true )
                )

		);

	}

    public function widget( $args, $instance ) {
        if ( ! is_array( $instance ) ) {
            $instance = array();
        }

        $instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'tiles';
        $instance['listing_list_columns'] = 1;

        //prepare variables
        $params = '';

        $this->resetBasicParams();
        $this->setBasicParams($instance);

        $this->setBasicParams(array(
            'listing_slider' => 'yes'
        ));

        //is instance empty?
        if ( is_array( $instance ) && count( $instance ) ) {
            //generate shortcode params
            foreach ( $instance as $key => $options ) {
                $params .= " $key='$options' ";
            }
        }
        ?>

        <div class="mkdf-ls-slider-holder widget mkdf-ls-list-items-holder clearfix">
            <?php

            if ( ! empty( $instance['widget_title'] ) ) {
                echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
            }

            ?>

            <?php echo staffscout_mikado_execute_shortcode( 'mkdf_listing_job_list', $this->getBasicParams() ); ?>
        </div>
        <?php
    }
}