<?php

class MikadoListingWidget extends StaffScoutMikadoClassWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_listing_job_widget',
			esc_html__('Mikado Listing Widget', 'mkdf-listing'),
			array( 'description' => esc_html__( 'Add listing element to widget areas', 'mkdf-listing'))
		);

		$this->setParams();        
	}

	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$this->params =array(
            array(
                'type'  => 'textfield',
                'name'  => 'widget_title',
                'title' => esc_html__( 'Widget Title', 'mkdf-listing' )
            ),
            array(
                'type'    => 'textfield',
                'name'    => 'listing_list_number',
                'title'   => esc_html__('Number of Items', 'mkdf-listing')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'type',
                'title'   => esc_html__( 'List Type', 'mkdf-listing' ),
                'options' => array(
                    'default'        => esc_html__( 'Default', 'mkdf-listing' ),
                    'simple'         => esc_html__( 'Simple', 'mkdf-listing' ),
                    'tiles'         => esc_html__( 'Tiles', 'mkdf-listing' ),
                    'grid'         => esc_html__( 'Grid', 'mkdf-listing' ),
                )
            ),
            array(
                'type'        => 'dropdown',
                'name'        => 'order_by',
                'title'       => esc_html__('Order By', 'mkdf-listing'),
                'options'     => array(
                    'date'       => esc_html__('Date', 'mkdf-listing'),
                    'title'      => esc_html__('Title', 'mkdf-listing'),
                    'menu_order' => esc_html__('Menu Order', 'mkdf-listing'),
                    'featured'   => esc_html__('Featured', 'mkdf-listing'),
                ),
            ),
            array(
                'type'        => 'dropdown',
                'name'        => 'order',
                'title'       => esc_html__('Order', 'mkdf-listing'),
                'options'     => array(
                    'ASC'  =>  esc_html__('ASC', 'mkdf-listing'),
                    'DESC' => esc_html__('DESC', 'mkdf-listing')
                ),
            ),
		);
	}

	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget($args, $instance) {
		$params = '';
        
		if (!is_array($instance)) { $instance = array(); }

		// Default values
		if (!isset($instance['listing_list_number'])) { 
		    $instance['listing_list_number'] = 3;
		}

        $instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'grid';
		$instance['listing_list_columns'] = '1';

		if($instance['type'] === 'simple' || $instance['type'] === 'grid') {
            $instance['listing_space_between_items'] = 'tiny';
        }

        if($instance['type'] === 'grid') {
            $instance['listing_list_columns'] = '3';
        }

		foreach ($instance as $key => $value) {
			if($value !== '') {				
				$params .= $key .'='. esc_attr($value). ' ';
			}
		}
		
		echo '<div class="widget mkdf-listing-widget">';
            if ( ! empty( $instance['widget_title'] ) ) {
                echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
            }
			echo do_shortcode("[mkdf_listing_job_list $params]"); // XSS OK
		echo '</div>';
	}
    
}