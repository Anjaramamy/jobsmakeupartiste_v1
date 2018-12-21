<?php

class StaffScoutMikadoClassResumeSliderWidget extends StaffScoutMikadoClassWidget {
    
	private $base;
    private $basic_params;

    public function __construct() {
        parent::__construct(
            'mkdf_resume_slider',
            esc_html__( 'Mikado Resume Slider Widget', 'mkdf-listing' ),
            array( 'description' => esc_html__( 'Add resume slider to widget areas', 'mkdf-listing' ) )
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

    public function generateResumeTypeArray(){
        $this->types = mkdf_listing_resume_get_resume_types_VC_Array();
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
					'name'          => 'resume_category',
					'title'         => esc_html__('Resume Category', 'mkdf-listing'),
					'options'       => mkdf_listing_resume_categories_VC_ARRAY(true)
				),
                array(
                    'type'          => 'textfield',
                    'name'          => 'resume_list_id',
                    'title'         => esc_html__('IDs of resume items', 'mkdf-listing'),
                    'description'   => esc_html__('Enter IDs of resume items separated with comma (for example 23,24,35)', 'mkdf-listing'),
                    'options'       => '',
                ),
				array(
					'type'          => 'textfield',
					'name'          => 'resume_list_number',
					'title'         => esc_html__('Number of items', 'mkdf-listing'),
					'options'       => '',
				),
                array(
                    'type'          => 'dropdown',
                    'name'          => 'resume_space_between_items',
                    'title'         => esc_html__( 'Space Between Resumes', 'mkdf-listing' ),
                    'options'       => array_flip( staffscout_mikado_get_space_between_items_array() ),
                ),
                array(
                    'type'          => 'dropdown',
                    'name'          => 'enable_loop',
                    'title'         => esc_html__( 'Enable Slider Loop', 'mkdf-listing' ),
                    'options'       => array_flip( staffscout_mikado_get_yes_no_select_array( false, false ) ),
                ),
                array(
                    'type'          => 'dropdown',
                    'name'          => 'enable_autoplay',
                    'title'         => esc_html__( 'Enable Slider Autoplay', 'mkdf-listing' ),
                    'options'       => array_flip( staffscout_mikado_get_yes_no_select_array( false, true ) )
                ),
                array(
                    'type'          => 'textfield',
                    'name'          => 'slider_speed',
                    'title'         => esc_html__( 'Slide Duration', 'mkdf-listing' ),
                    'description'   => esc_html__( 'Default options is 5000 (ms)', 'mkdf-listing' ),
                ),
                array(
                    'type'          => 'textfield',
                    'name'          => 'slider_speed_animation',
                    'title'         => esc_html__( 'Slide Animation Duration', 'mkdf-listing' ),
                    'description'   => esc_html__( 'Speed of slide animation in milliseconds. Default options is 600.', 'mkdf-listing' )
                ),
                array(
                    'type'          => 'dropdown',
                    'name'          => 'enable_navigation',
                    'title'         => esc_html__( 'Enable Slider Navigation Arrows', 'mkdf-listing' ),
                    'options'       => array_flip( staffscout_mikado_get_yes_no_select_array( false, true ) ),
                ),
                array(
                    'type'          => 'dropdown',
                    'name'          => 'enable_pagination',
                    'title'         => esc_html__( 'Enable Slider Pagination', 'mkdf-listing' ),
                    'options'       => array_flip( staffscout_mikado_get_yes_no_select_array( false, true ) ),
                )

		);

	}

    public function widget( $args, $instance ) {
        if ( ! is_array( $instance ) ) {
            $instance = array();
        }

        $instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'grid';
        $instance['resume_list_columns'] = 1;

        //prepare variables
        $params = '';

        $this->resetBasicParams();
        $this->setBasicParams($instance);

        $this->setBasicParams(array(
            'resume_slider' => 'yes'
        ));

        //is instance empty?
        if ( is_array( $instance ) && count( $instance ) ) {
            //generate shortcode params
            foreach ( $instance as $key => $options ) {
                $params .= " $key='$options' ";
            }
        }
        ?>

        <div class="mkdf-rs-slider-holder widget mkdf-rs-list-items-holder clearfix mkdf-resume-list-default">
            <?php

            if ( ! empty( $instance['widget_title'] ) ) {
                echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
            }

            ?>

            <?php echo staffscout_mikado_execute_shortcode( 'mkdf_listing_resume_list', $this->getBasicParams() ); ?>
        </div>
        <?php
    }
}