<?php
namespace MikadoCore\CPT\Shortcodes\PricingTable;

use MikadoCore\Lib;

class PricingTable implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_pricing_table';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Mikado Pricing Table', 'mkdf-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'mkdf_pricing_table_item' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by MIKADO', 'mkdf-core' ),
					'icon'                    => 'icon-wpb-pricing-table extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'columns',
							'heading'     => esc_html__( 'Number of Columns', 'mkdf-core' ),
							'value'       => array(
								esc_html__( 'One', 'mkdf-core' )   => 'mkdf-one-column',
								esc_html__( 'Two', 'mkdf-core' )   => 'mkdf-two-columns',
								esc_html__( 'Three', 'mkdf-core' ) => 'mkdf-three-columns',
								esc_html__( 'Four', 'mkdf-core' )  => 'mkdf-four-columns',
								esc_html__( 'Five', 'mkdf-core' )  => 'mkdf-five-columns',
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'mkdf-core' ),
							'value'       => array_flip( staffscout_mikado_get_space_between_items_array() ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'columns'             => 'mkdf-two-columns',
			'space_between_items' => 'normal'
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_class = $this->getHolderClasses( $params, $args );
		
		$html = '<div class="mkdf-pricing-tables clearfix ' . esc_attr( $holder_class ) . '">';
			$html .= '<div class="mkdf-pt-wrapper mkdf-outer-space">';
				$html .= do_shortcode( $content );
			$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['columns'] ) ? $params['columns'] : $args['columns'];
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $args['space_between_items'] . '-space';
		
		return implode( ' ', $holderClasses );
	}
}