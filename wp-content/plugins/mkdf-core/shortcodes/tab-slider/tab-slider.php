<?php
namespace MikadoCore\CPT\Shortcodes\TabSlider;

use MikadoCore\Lib;

class TabSlider implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkdf_tab_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(array(
                'name' => esc_html__('Mikado Tab Slider', 'mkdf-core'),
                'base' => $this->base,
                'as_parent' => array('only' => 'mkdf_tab_slider_item'),
                'content_element' => true,
                'category' => esc_html__('by MIKADO', 'mkdf-core'),
                'icon' => 'icon-wpb-tabs extended-custom-icon',
                'js_view' => 'VcColumnView',
                'params' => array(
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'slider_loop',
                        'heading'     => esc_html__( 'Enable Slider Loop', 'mkdf-core' ),
                        'value'       => array_flip( staffscout_mikado_get_yes_no_select_array( false, true ) ),
                        'save_always' => true,
                        'group'       => esc_html__( 'Slider Settings', 'mkdf-core' )
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'slider_autoplay',
                        'heading'     => esc_html__( 'Enable Slider Autoplay', 'mkdf-core' ),
                        'value'       => array_flip( staffscout_mikado_get_yes_no_select_array( false, true ) ),
                        'save_always' => true,
                        'group'       => esc_html__( 'Slider Settings', 'mkdf-core' )
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'slider_speed',
                        'heading'     => esc_html__( 'Slide Duration', 'mkdf-core' ),
                        'description' => esc_html__( 'Default value is 5000 (ms)', 'mkdf-core' ),
                        'group'       => esc_html__( 'Slider Settings', 'mkdf-core' )
                    ),
                    array(
                        'type'        => 'textfield',
                        'param_name'  => 'slider_speed_animation',
                        'heading'     => esc_html__( 'Slide Animation Duration', 'mkdf-core' ),
                        'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'mkdf-core' ),
                        'group'       => esc_html__( 'Slider Settings', 'mkdf-core' )
                    ),
                    array(
                        'type'        => 'dropdown',
                        'param_name'  => 'slider_navigation',
                        'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'mkdf-core' ),
                        'value'       => array_flip( staffscout_mikado_get_yes_no_select_array( false, true ) ),
                        'save_always' => true,
                        'group'       => esc_html__( 'Slider Settings', 'mkdf-core' )
                    ),
                )
            ));
        }

    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'slider_loop'             => 'yes',
            'slider_autoplay'         => 'yes',
            'slider_speed'            => '5000',
            'slider_speed_animation'  => '600',
            'slider_navigation'       => 'yes',
        );

        $params = array('content' => $content);

        $params['slider_data']  = $this->getSliderData( $params );

        return mkdf_core_get_shortcode_module_template_part('templates/tab-slider-holder', 'tab-slider', '', $params);
    }

    private function getSliderData( $params ) {
        $slider_data = array();

        $slider_data['data-enable-pagination']      = 'yes';
        $slider_data['data-enable-pagination-data'] = 'yes';
        $slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
        $slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
        $slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
        $slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
        $slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : 'no';

        return $slider_data;
    }

}