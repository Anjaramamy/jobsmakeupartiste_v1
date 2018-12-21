<?php
namespace MikadoCore\CPT\Shortcodes\TabSlider;

use MikadoCore\Lib;

class TabSliderItem implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkdf_tab_slider_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(array(
                'name'                    => esc_html__('Mikado Tab Slider Item', 'mkdf-core'),
                'base'                    => $this->base,
                'category'                => esc_html__( 'by MIKADO', 'mkdf-core' ),
                'icon'                    => 'icon-wpb-tabs-item extended-custom-icon',
                'as_parent'               => array('except' => 'vc_row'),
                'as_child'                => array('only' => 'mkdf_tab_slider'),
                'content_element'         => true,
                'js_view'                 => 'VcColumnView',
                'params'                  => array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Slide Title', 'mkdf-core'),
                        'param_name'  => 'slide_title',
                        'admin_label' => true
                    ),
                )
            ));
        }
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'slide_title'    => ''
        );

        $params = shortcode_atts($default_atts, $atts);

        $params['content'] = $content;

        return mkdf_core_get_shortcode_module_template_part('templates/tab-slider-item', 'tab-slider', '', $params);
    }
}