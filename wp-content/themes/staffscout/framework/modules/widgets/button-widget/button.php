<?php

class StaffScoutMikadoClassButtonWidget extends StaffScoutMikadoClassWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_button_widget',
			esc_html__( 'Mikado Button Widget', 'staffscout' ),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'staffscout' ) )
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
					'solid'   => esc_html__( 'Solid', 'staffscout' ),
					'outline' => esc_html__( 'Outline', 'staffscout' ),
					'simple'  => esc_html__( 'Simple', 'staffscout' )
				)
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'size',
				'title'       => esc_html__( 'Size', 'staffscout' ),
				'options'     => array(
					'small'  => esc_html__( 'Small', 'staffscout' ),
					'medium' => esc_html__( 'Medium', 'staffscout' ),
					'large'  => esc_html__( 'Large', 'staffscout' ),
					'huge'   => esc_html__( 'Huge', 'staffscout' )
				),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'staffscout' )
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__( 'Text', 'staffscout' ),
				'default' => esc_html__( 'Button Text', 'staffscout' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'staffscout' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Link Target', 'staffscout' ),
				'options' => staffscout_mikado_get_link_target_array()
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'staffscout' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'hover_color',
				'title' => esc_html__( 'Hover Color', 'staffscout' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'background_color',
				'title'       => esc_html__( 'Background Color', 'staffscout' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'staffscout' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_background_color',
				'title'       => esc_html__( 'Hover Background Color', 'staffscout' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'staffscout' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'border_color',
				'title'       => esc_html__( 'Border Color', 'staffscout' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'staffscout' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_border_color',
				'title'       => esc_html__( 'Hover Border Color', 'staffscout' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'staffscout' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin', 'staffscout' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'staffscout' )
			),
            array(
                'type'        => 'textfield',
                'name'        => 'padding',
                'title'       => esc_html__( 'Button Padding', 'staffscout' ),
                'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'staffscout' )
            )
		);
	}
	
	public function widget( $args, $instance ) {
		$params = '';
		
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		// Default values
		if ( ! isset( $instance['text'] ) ) {
			$instance['text'] = 'Button Text';
		}
		
		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget mkdf-button-widget">';
			echo do_shortcode( "[mkdf_button $params]" ); // XSS OK
		echo '</div>';
	}
}