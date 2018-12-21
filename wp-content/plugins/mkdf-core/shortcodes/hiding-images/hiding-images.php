<?php
namespace MikadoCore\CPT\Shortcodes\HidingImages;

use MikadoCore\Lib;

class HidingImages implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkdf_hiding_images';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            'name'                    => esc_html__('Hiding Images', 'mkdf-core'),
            'base'                    => $this->getBase(),
            'as_parent'               => array('only' => 'mkdf_hiding_image'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'category'                => esc_html__('by MIKADO', 'mkdf-core'),
            'icon'                    => 'icon-wpb-hiding-images extended-custom-icon',
            'js_view'                 => 'VcColumnView',
            'params'                  => array(
                array(
                    'heading'     => esc_html__('Main Image', 'mkdf-core'),
                    'type'        => 'attach_image',
                    'admin-label' => true,
                    'param_name'  => 'main_image',
                    'value'       => '',
                    'description' => esc_html__('This image is shown inside the laptop monitor in the middle', 'mkdf-core'),
                ),
                array(
                    'heading'     => esc_html__('Link', 'mkdf-core'),
                    'type'        => 'textfield',
                    'param_name'  => 'link',
                    'admin_label' => true
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__('Target', 'mkdf-core'),
                    'param_name' => 'target',
                    'value'      => array(
                        ''                           => '',
                        esc_html__('Self', 'mkdf-core')  => '_self',
                        esc_html__('Blank', 'mkdf-core') => '_blank'
                    ),
                    'dependency' => array('element' => 'link', 'not_empty' => true),
                ),
            )
        ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'main_image' => '',
            'link'       => '',
            'target'     => '_self'
        );

        $params = shortcode_atts($args, $atts);

        extract($params);

        $params['content'] = $content;

        return mkdf_core_get_shortcode_module_template_part('templates/hiding-images', 'hiding-images', '', $params);
    }
}