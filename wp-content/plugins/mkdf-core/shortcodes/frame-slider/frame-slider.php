<?php
namespace MikadoCore\CPT\Shortcodes\FrameSlider;

use MikadoCore\Lib;

class FrameSlider implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_frame_slider';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Mikado Frame Slider', 'mkdf-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-frame-slider extended-custom-icon',
					'category'                  => esc_html__( 'by MIKADO', 'mkdf-core' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'attach_images',
							'param_name'  => 'images',
							'heading'     => esc_html__( 'Images', 'mkdf-core' ),
							'description' => esc_html__( 'Select images from media library', 'mkdf-core' )
						),
						array(
							'type'        => 'textarea',
							'param_name'  => 'custom_links',
							'heading'     => esc_html__( 'Custom Links', 'mkdf-core' ),
							'description' => esc_html__( 'Delimit links by comma', 'mkdf-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'target',
							'heading'    => esc_html__( 'Custom Link Target', 'mkdf-core' ),
							'value'      => array_flip( staffscout_mikado_get_link_target_array() )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args = array(
			'images'       => '',
			'custom_links' => '',
			'target'       => '_self'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['slider_data'] = $this->getSliderData();
		$params['images']      = $this->getGalleryImages( $params );
		$params['links']       = $this->getGalleryLinks( $params );
		$params['target']      = ! empty( $params['target'] ) ? $params['target'] : $args['target'];
		
		$html = mkdf_core_get_shortcode_module_template_part( 'templates/frame-slider', 'frame-slider', '', $params );
		
		return $html;
	}
	
	private function getSliderData() {
		$slider_data = array();
		
		$slider_data['data-number-of-items']   = '5';
		$slider_data['data-slider-margin']     = '36';
		$slider_data['data-enable-center']     = 'yes';
		$slider_data['data-enable-auto-width'] = 'yes';
		$slider_data['data-enable-navigation'] = 'no';
		$slider_data['data-enable-pagination'] = 'no';
		
		return $slider_data;
	}
	
	private function getGalleryImages( $params ) {
		$image_ids = array();
		$images    = array();
		$i         = 0;
		
		if ( $params['images'] !== '' ) {
			$image_ids = explode( ',', $params['images'] );
		}
		
		foreach ( $image_ids as $id ) {
			
			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
			
			$images[ $i ] = $image;
			$i ++;
		}
		
		return $images;
	}
	
	private function getGalleryLinks( $params ) {
		$custom_links = array();
		
		if ( ! empty( $params['custom_links'] ) ) {
			$custom_links = array_map( 'trim', explode( ',', $params['custom_links'] ) );
		}
		
		return $custom_links;
	}
}
