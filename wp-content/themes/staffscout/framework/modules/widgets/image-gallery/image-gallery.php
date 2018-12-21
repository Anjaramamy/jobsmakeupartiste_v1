<?php

class StaffScoutMikadoClassImageGalleryWidget extends StaffScoutMikadoClassWidget {
	public function __construct() {
		parent::__construct(
			'mkdf_image_gallery_widget',
			esc_html__( 'Mikado Image Gallery Widget', 'staffscout' ),
			array( 'description' => esc_html__( 'Add image gallery element to widget areas', 'staffscout' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'extra_class',
				'title' => esc_html__( 'Custom CSS Class', 'staffscout' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'staffscout' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Gallery Type', 'staffscout' ),
				'options' => array(
					'grid'   => esc_html__( 'Image Grid', 'staffscout' ),
					'slider' => esc_html__( 'Slider', 'staffscout' )
				)
			),
			array(
				'type'        => 'textfield',
				'name'        => 'images',
				'title'       => esc_html__( 'Image ID\'s', 'staffscout' ),
				'description' => esc_html__( 'Add images id for your image gallery widget, separate id\'s with comma', 'staffscout' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'image_size',
				'title'       => esc_html__( 'Image Size', 'staffscout' ),
				'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'staffscout' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'enable_image_shadow',
				'title'   => esc_html__( 'Enable Image Shadow', 'staffscout' ),
				'options' => staffscout_mikado_get_yes_no_select_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'image_behavior',
				'title'   => esc_html__( 'Image Behavior', 'staffscout' ),
				'options' => array(
					''            => esc_html__( 'None', 'staffscout' ),
					'lightbox'    => esc_html__( 'Open Lightbox', 'staffscout' ),
					'custom-link' => esc_html__( 'Open Custom Link', 'staffscout' ),
					'zoom'        => esc_html__( 'Zoom', 'staffscout' ),
					'grayscale'   => esc_html__( 'Grayscale', 'staffscout' )
				)
			),
			array(
				'type'        => 'textarea',
				'name'        => 'custom_links',
				'title'       => esc_html__( 'Custom Links', 'staffscout' ),
				'description' => esc_html__( 'Delimit links by comma', 'staffscout' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'custom_link_target',
				'title'   => esc_html__( 'Custom Link Target', 'staffscout' ),
				'options' => staffscout_mikado_get_link_target_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'number_of_columns',
				'title'   => esc_html__( 'Number of Columns', 'staffscout' ),
				'options' => array(
					'two'   => esc_html__( 'Two', 'staffscout' ),
					'three' => esc_html__( 'Three', 'staffscout' ),
					'four'  => esc_html__( 'Four', 'staffscout' ),
					'five'  => esc_html__( 'Five', 'staffscout' ),
					'six'   => esc_html__( 'Six', 'staffscout' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'space_between_columns',
				'title'   => esc_html__( 'Space Between Items', 'staffscout' ),
				'options' => staffscout_mikado_get_space_between_items_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'slider_navigation',
				'title'   => esc_html__( 'Enable Slider Navigation Arrows', 'staffscout' ),
				'options' => staffscout_mikado_get_yes_no_select_array( false )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'slider_pagination',
				'title'   => esc_html__( 'Enable Slider Pagination', 'staffscout' ),
				'options' => staffscout_mikado_get_yes_no_select_array( false )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		$extra_class      = ! empty( $instance['extra_class'] ) ? $instance['extra_class'] : '';
		$instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'grid';
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		?>
		
		<div class="widget mkdf-image-gallery-widget <?php echo esc_html( $extra_class ); ?>">
			<?php
			if ( ! empty( $instance['widget_title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			echo do_shortcode( "[mkdf_image_gallery $params]" ); // XSS OK
			?>
		</div>
		<?php
	}
}