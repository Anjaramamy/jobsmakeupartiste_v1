<?php
namespace MikadoCore\CPT\Shortcodes\PricingTable;

use MikadoCore\Lib;

class PricingTableItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_pricing_table_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Mikado Pricing Table Item', 'mkdf-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-pricing-table-item extended-custom-icon',
					'category'                  => esc_html__( 'by MIKADO', 'mkdf-core' ),
					'allowed_container_element' => 'vc_row',
					'as_child'                  => array( 'only' => 'mkdf_pricing_table' ),
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'mkdf-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'mkdf-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'content_background_color',
							'heading'    => esc_html__( 'Content Background Color', 'mkdf-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'mkdf-core' ),
							'value'       => esc_html__( 'Basic Plan', 'mkdf-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'mkdf-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'price',
							'heading'    => esc_html__( 'Price', 'mkdf-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'price_color',
							'heading'    => esc_html__( 'Price Color', 'mkdf-core' ),
							'dependency' => array( 'element' => 'price', 'not_empty' => true )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'currency',
							'heading'     => esc_html__( 'Currency', 'mkdf-core' ),
							'description' => esc_html__( 'Default mark is $', 'mkdf-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'currency_color',
							'heading'    => esc_html__( 'Currency Color', 'mkdf-core' ),
							'dependency' => array( 'element' => 'currency', 'not_empty' => true )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'price_period',
							'heading'     => esc_html__( 'Price Period', 'mkdf-core' ),
							'description' => esc_html__( 'Default label is monthly', 'mkdf-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'price_period_color',
							'heading'    => esc_html__( 'Price Period Color', 'mkdf-core' ),
							'dependency' => array( 'element' => 'price_period', 'not_empty' => true )
						),
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Show Label', 'mkdf-core' ),
                            'param_name'  => 'show_label',
                            'value'       => array_flip( staffscout_mikado_get_yes_no_select_array( false ) )
                        ),
                        array(
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Label Text', 'mkdf-core' ),
                            'param_name'  => 'label',
                            'dependency' => array( 'element' => 'show_label', 'value' => 'yes' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'label_text_color',
                            'heading'    => esc_html__( 'Color', 'mkdf-core' ),
                            'description' => esc_html__( 'Label Text Color', 'mkdf-core' ),
                            'dependency' => array( 'element' => 'show_label', 'value' => 'yes' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'label_background_color',
                            'heading'    => esc_html__( 'Background Color', 'mkdf-core' ),
                            'description' => esc_html__( 'Label Background Color', 'mkdf-core' ),
                            'dependency' => array( 'element' => 'show_label', 'value' => 'yes' )
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'button_text',
							'heading'     => esc_html__( 'Button Text', 'mkdf-core' ),
							'value'       => esc_html__( 'BUY NOW', 'mkdf-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Button Link', 'mkdf-core' ),
							'dependency' => array( 'element' => 'button_text', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'button_type',
							'heading'     => esc_html__( 'Button Type', 'mkdf-core' ),
							'value'       => array(
								esc_html__( 'Solid', 'mkdf-core' )   => 'solid',
								esc_html__( 'Outline', 'mkdf-core' ) => 'outline'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'button_text', 'not_empty' => true )
						),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_text_color',
                            'heading'    => esc_html__( 'Color', 'mkdf-core' ),
                            'dependency' => array( 'element' => 'button_text', 'not_empty' => true )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_border_color',
                            'heading'    => esc_html__( 'Border Color', 'mkdf-core' ),
                            'dependency' => array( 'element' => 'button_text', 'not_empty' => true )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_background_color',
                            'heading'    => esc_html__( 'Background Color', 'mkdf-core' ),
                            'description' => esc_html__( 'Solid type only', 'mkdf-core' ),
                            'dependency' => array( 'element' => 'button_type', 'value' => 'solid' )
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Active', 'mkdf-core'),
                            'param_name' => 'active',
                            'value' => array(
                                esc_html__('No', 'mkdf-core') => 'no',
                                esc_html__('Yes', 'mkdf-core') => 'yes'
                            ),
                            'save_always' => true,
                        ),
						array(
							'type'       => 'textarea_html',
							'param_name' => 'content',
							'heading'    => esc_html__( 'Content', 'mkdf-core' ),
							'value'      => '<li>content content content</li><li>content content content</li><li>content content content</li>'
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'                       => '',
			'content_background_color'           => '',
			'title'                              => '',
			'title_color'                        => '',
			'price'                              => '100',
			'price_color'                        => '',
			'currency'                           => '$',
			'currency_color'                     => '',
			'price_period'                       => 'monthly',
			'price_period_color'                 => '',
            'show_label'                         => 'no',
            'label'                              => '',
            'label_text'                         => '',
            'label_text_color'                   => '',
            'label_background_color'             =>'',
			'button_text'                        => '',
			'link'                               => '',
			'button_type'                        => 'outline',
            'button_text_color'                  => '',
            'button_border_color'                => '',
            'button_background_color'            => '',
            'active'                             => 'no'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content']             = preg_replace( '#^<\/p>|<p>$#', '', $content ); // delete p tag before and after content
		$params['holder_classes']      = $this->getHolderClasses( $params );
		$params['holder_styles']       = $this->getHolderStyles( $params );
		$params['title_styles']        = $this->getTitleStyles( $params );
		$params['price_styles']        = $this->getPriceStyles( $params );
		$params['currency_styles']     = $this->getCurrencyStyles( $params );
		$params['price_period_styles'] = $this->getPricePeriodStyles( $params );
		$params['button_type']         = ! empty( $params['button_type'] ) ? $params['button_type'] : $args['button_type'];
		$params['button_styles']       = $this->getButtonStyles( $params);
        $params['label_styles']       = $this->getLabelStyles( $params);
		
		$html = mkdf_core_get_shortcode_module_template_part( 'templates/pricing-table-template', 'pricing-table', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

        if($params['active'] == 'yes') {
            $holderClasses[] = 'mkdf-active';
        }

		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['content_background_color'] ) ) {
			$itemStyle[] = 'background-color: ' . $params['content_background_color'];
		}

		return implode( ';', $itemStyle );
	}
	
	private function getTitleStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $itemStyle );
	}
	
	private function getPriceStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['price_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['price_color'];
		}
		
		return implode( ';', $itemStyle );
	}
	
	private function getCurrencyStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['currency_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['currency_color'];
		}
		
		return implode( ';', $itemStyle );
	}
	
	private function getPricePeriodStyles( $params ) {
		$itemStyle = array();
		
		if ( ! empty( $params['price_period_color'] ) ) {
			$itemStyle[] = 'color: ' . $params['price_period_color'];
		}
		
		return implode( ';', $itemStyle );
	}

    private function getButtonStyles( $params ) {
        $itemStyle = array();

        $itemStyle['color'] = $params['button_text_color'];

        $itemStyle['border-color'] = $params['button_border_color'];

        $itemStyle['background-color'] = $params['button_background_color'];

        return $itemStyle;
    }

    private function getLabelStyles( $params ) {
        $itemStyle = array();

        if ( ! empty( $params['label_text_color'] ) ) {
            $itemStyle[] = 'color: ' . $params['label_text_color'];
        }

        if ( ! empty( $params['label_background_color'] ) ) {
            $itemStyle[] = 'background-color: ' . $params['label_background_color'];
        }

        return implode( ';', $itemStyle );
    }
}