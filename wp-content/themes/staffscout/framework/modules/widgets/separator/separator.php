<?php

class StaffScoutMikadoClassSeparatorWidget extends StaffScoutMikadoClassWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_separator_widget',
			esc_html__( 'Mikado Separator Widget', 'staffscout' ),
			array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'staffscout' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'staffscout' ),
				'options' => array(
					'normal'     => esc_html__( 'Normal', 'staffscout' ),
					'full-width' => esc_html__( 'Full Width', 'staffscout' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'staffscout' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'staffscout' ),
					'left'   => esc_html__( 'Left', 'staffscout' ),
					'right'  => esc_html__( 'Right', 'staffscout' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'staffscout' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'staffscout' ),
					'dashed' => esc_html__( 'Dashed', 'staffscout' ),
					'dotted' => esc_html__( 'Dotted', 'staffscout' )
				)
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'staffscout' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width (px or %)', 'staffscout' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'staffscout' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin (px or %)', 'staffscout' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin (px or %)', 'staffscout' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget mkdf-separator-widget">';
			echo do_shortcode( "[mkdf_separator $params]" ); // XSS OK
		echo '</div>';
	}
}