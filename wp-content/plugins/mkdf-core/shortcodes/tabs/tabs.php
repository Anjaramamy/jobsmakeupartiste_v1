<?php
namespace MikadoCore\CPT\Shortcodes\Tabs;

use MikadoCore\Lib;

class Tabs implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_tabs';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Mikado Tabs', 'mkdf-core' ),
					'base'            => $this->getBase(),
					'as_parent'       => array( 'only' => 'mkdf_tabs_item' ),
					'content_element' => true,
					'category'        => esc_html__( 'by MIKADO', 'mkdf-core' ),
					'icon'            => 'icon-wpb-tabs extended-custom-icon',
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'mkdf-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'mkdf-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'mkdf-core' ),
							'value'       => array(
								esc_html__( 'Standard', 'mkdf-core' ) => 'standard',
								esc_html__( 'Boxed', 'mkdf-core' )    => 'boxed',
								esc_html__( 'Simple', 'mkdf-core' )   => 'simple',
								esc_html__( 'Vertical', 'mkdf-core' ) => 'vertical'
							),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class' => '',
			'type'         => 'standard'
		);
		$params = shortcode_atts( $args, $atts );
		
		// Extract tab titles
		preg_match_all( '/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		
		/**
		 * get tab titles array
		 */
		if ( isset( $matches[0] ) ) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach ( $tab_titles as $tab ) {
			preg_match( '/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['tabs_titles']    = $tab_title_array;
		$params['content']        = $content;
		
		$output = mkdf_core_get_shortcode_module_template_part( 'templates/tab-template', 'tabs', '', $params );
		
		return $output;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-tabs-' . esc_attr( $params['type'] ) : 'mkdf-tabs-standard';
		
		return implode( ' ', $holderClasses );
	}
}