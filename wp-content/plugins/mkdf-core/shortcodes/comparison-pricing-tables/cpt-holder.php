<?php

namespace MikadoCore\CPT\Shortcodes\ComparisonPricingTables;

use MikadoCore\Lib;

class ComparisonPricingTablesHolder implements Lib\ShortcodeInterface {
	private $base;

	/**
	 * ComparisonPricingTablesHolder constructor.
	 */
	public function __construct() {
		$this->base = 'mkdf_comparison_pricing_tables_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}


	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                    => esc_html__('Mikado Comparison Pricing Table', 'mkdf-core'),
			'base'                    => $this->base,
			'as_parent'               => array('only' => 'mkdf_comparison_pricing_table'),
			'content_element'         => true,
			'category'                => 'by MIKADO',
			'icon'                    => 'icon-wpb-cmp-pricing-tables extended-custom-icon',
			'show_settings_on_create' => true,
			'params'                  => array(
				array(
					'type'        => 'dropdown',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => esc_html__('Columns', 'mkdf-core'),
					'param_name'  => 'columns',
					'value'       => array(
						esc_html__('Two', 'mkdf-core')   => 'mkdf-two-columns',
						esc_html__('Three', 'mkdf-core') => 'mkdf-three-columns',
						esc_html__('Four', 'mkdf-core')  => 'mkdf-four-columns',
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type'        => 'textarea',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => esc_html__('Title', 'mkdf-core'),
					'param_name'  => 'title',
					'value'       => '',
					'save_always' => true
				),
				array(
					'type'        => 'exploded_textarea',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => esc_html__('Features', 'mkdf-core'),
					'param_name'  => 'features',
					'value'       => '',
					'save_always' => true,
					'description' => esc_html__('Enter features. Separate each features with new line (enter).', 'mkdf-core')
				)
			),
			'js_view'                 => 'VcColumnView'
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'  => 'mkdf-two-columns',
			'features' => '',
			'title'    => '',
		);

		$params = shortcode_atts($args, $atts);

		$params['features'] = $this->getFeaturesArray($params);
		$params['content'] = $content;
		$params['holder_classes'] = $this->getHolderClasses($params);

		return mkdf_core_get_shortcode_module_template_part('templates/cpt-holder-template', 'comparison-pricing-tables', '', $params);
	}

	private function getFeaturesArray($params) {
		$features = array();

		if (!empty($params['features'])) {
			$features = explode(',', $params['features']);
		}

		return $features;
	}

	private function getHolderClasses($params) {
		$classes = array('mkdf-comparision-pricing-tables-holder');

		if ($params['columns'] !== '') {
			$classes[] = $params['columns'];
		}

		return $classes;
	}
}