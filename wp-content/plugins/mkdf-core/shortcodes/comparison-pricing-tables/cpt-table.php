<?php

namespace MikadoCore\CPT\Shortcodes\ComparisonPricingTables;

use MikadoCore\Lib;

class ComparisonPricingTable implements  Lib\ShortcodeInterface
{
    private $base;

    /**
     * ComparisonPricingTable constructor.
     */
    public function __construct() {
        $this->base = 'mkdf_comparison_pricing_table';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Mikado Comparison Pricing Table', 'mkdf-core'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-cmp-pricing-table extended-custom-icon',
            'category'                  => 'by Mikado',
            'allowed_container_element' => 'vc_row',
            'as_child'                  => array('only' => 'mkdf_comparison_pricing_tables_holder'),
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Title', 'mkdf-core'),
                        'param_name'  => 'title',
                        'value'       => esc_html__('Basic Plan', 'mkdf-core'),
                        'description' => ''
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Title Size (px)', 'mkdf-core'),
                        'param_name'  => 'title_size',
                        'value'       => '',
                        'description' => '',
                        'dependency'  => array(
                            'element'   => 'title',
                            'not_empty' => true
                        ),
                        'group'       => esc_html__('Design Options', 'mkdf-core')
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Price', 'mkdf-core'),
                        'param_name'  => 'price',
                        'description' => esc_html__('Default value is 100', 'mkdf-core')
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Currency', 'mkdf-core'),
                        'param_name'  => 'currency',
                        'description' => esc_html__('Default mark is $', 'mkdf-core')
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Price Period', 'mkdf-core'),
                        'param_name'  => 'price_period',
                        'description' => esc_html__('Default label is monthly', 'mkdf-core')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => true,
                        'heading'     => esc_html__('Featured package', 'mkdf-core'),
                        'param_name'  => 'featured_package',
                        'value'       => array(
                            esc_html__('No', 'mkdf-core')  => 'no',
                            esc_html__('Yes', 'mkdf-core') => 'yes'
                        ),
                        'description' => '',
                    ),
                    array(
                        'type'        => 'dropdown',
                        'admin_label' => true,
                        'heading'     => esc_html__('Show Button', 'mkdf-core'),
                        'param_name'  => 'show_button',
                        'value'       => array(
                            esc_html__('Yes', 'mkdf-core') => 'yes',
                            esc_html__('No', 'mkdf-core')  => 'no'
                        ),
                        'description' => '',
                        'save_always' => true,
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Button Text', 'mkdf-core'),
                        'param_name'  => 'button_text',
                        'dependency'  => array(
                            'element' => 'show_button',
                            'value'   => 'yes'
                        )
                    ),
                    array(
                        'type'        => 'textfield',
                        'admin_label' => true,
                        'heading'     => esc_html__('Button Link', 'mkdf-core'),
                        'param_name'  => 'button_link',
                        'dependency'  => array(
                            'element' => 'show_button',
                            'value'   => 'yes'
                        )
                    ),
                    array(
                        'type'        => 'textarea_html',
                        'holder'      => 'div',
                        'class'       => '',
                        'heading'     => esc_html__('Content', 'mkdf-core'),
                        'param_name'  => 'content',
                        'value'       => '<li>' . esc_html__('content content content', 'mkdf-core') . '</li><li>' . esc_html__('content content content', 'mkdf-core') . '</li><li>' . esc_html__('content content content', 'mkdf-core') . '</li>',
                        'description' => '',
                        'admin_label' => false
                    ),
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'title'            => esc_html__('Basic Plan', 'mkdf-core'),
            'title_size'       => '',
            'price'            => '100',
            'currency'         => '$',
            'price_period'     => '',
            'show_button'      => 'yes',
            'featured_package' => 'no',
            'button_link'      => '',
            'button_text'      => 'button',
        );

        $args   = array_merge( $args, staffscout_mikado_icon_collections()->getShortcodeParams() );
        $params = shortcode_atts($args, $atts);


        $params['content'] = $content;
        $params['table_classes'] = $this->getTableClasses($params);
        $params['button_parameters'] = $this->getButtonParameters($params);

        return mkdf_core_get_shortcode_module_template_part('templates/cpt-table-template', 'comparison-pricing-tables', '', $params);
    }

    private function getTableClasses($params) {
        $classes = array('mkdf-comparision-table-holder', 'mkdf-cpt-table');

        if ($params['featured_package'] == 'yes') {
            $classes[] = 'mkdf-featured-comparision-table';
        }

        return $classes;
    }


    private function getButtonParameters($params) {
        $button_params_array = array();

        if (!empty($params['button_text'])) {
            $button_params_array['text'] = $params['button_text'];
        }

        if (!empty($params['button_link'])) {
            $button_params_array['link'] = $params['button_link'];
        }

        $button_params_array['size'] = 'small';

        $button_params_array['shape'] = 'rounded';

        return $button_params_array;
    }
}