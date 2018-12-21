<?php

class StaffScoutMikadoClassBlogListWidget extends StaffScoutMikadoClassWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_blog_list_widget',
			esc_html__( 'Mikado Blog List Widget', 'staffscout' ),
			array( 'description' => esc_html__( 'Display a list of your blog posts', 'staffscout' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'staffscout' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'staffscout' ),
				'options' => array(
					'simple'  => esc_html__( 'Simple', 'staffscout' ),
					'minimal' => esc_html__( 'Minimal', 'staffscout' )
				)
			),
			array(
				'type'  => 'textfield',
				'name'  => 'number_of_posts',
				'title' => esc_html__( 'Number of Posts', 'staffscout' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'space_between_items',
				'title'   => esc_html__( 'Space Between Items', 'staffscout' ),
				'options' => staffscout_mikado_get_space_between_items_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order_by',
				'title'   => esc_html__( 'Order By', 'staffscout' ),
				'options' => staffscout_mikado_get_query_order_by_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order',
				'title'   => esc_html__( 'Order', 'staffscout' ),
				'options' => staffscout_mikado_get_query_order_array()
			),
			array(
				'type'        => 'textfield',
				'name'        => 'category',
				'title'       => esc_html__( 'Category Slug', 'staffscout' ),
				'description' => esc_html__( 'Leave empty for all or use comma for list', 'staffscout' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_tag',
				'title'   => esc_html__( 'Title Tag', 'staffscout' ),
				'options' => staffscout_mikado_get_title_tag( true )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_transform',
				'title'   => esc_html__( 'Title Text Transform', 'staffscout' ),
				'options' => staffscout_mikado_get_text_transform_array( true )
			),
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		$instance['image_size']        = 'thumbnail';
		$instance['post_info_section'] = 'yes';
		$instance['number_of_columns'] = '1';
		
		// Filter out all empty params
		$instance         = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		$instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'simple';
		
		$params = '';
		//generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget mkdf-blog-list-widget">';
			if ( ! empty( $instance['widget_title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			
			echo do_shortcode( "[mkdf_blog_list $params]" ); // XSS OK
		echo '</div>';
	}
}