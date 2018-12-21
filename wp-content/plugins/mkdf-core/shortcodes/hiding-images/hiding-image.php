<?php
namespace MikadoCore\CPT\Shortcodes\HidingImages;

use MikadoCore\Lib;

class HidingImage implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkdf_hiding_image';
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
            'name'                    => esc_html__('Hiding Image', 'mkdf-core'),
            'base'                    => $this->getBase(),
            'as_child'                => array('only' => 'mkdf_hiding_images'),
            'category'                => esc_html__('by MIKADO', 'mkdf-core'),
            'icon'                    => 'icon-wpb-hiding-image extended-custom-icon',
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'attach_image',
                    'admin_label' => true,
                    'heading'     => esc_html__('Image', 'mkdf-core'),
                    'param_name'  => 'image',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Link', 'mkdf-core'),
                    'value'       => '',
                    'param_name'  => 'link',
                    'dependency'  => array('element' => 'image', 'not_empty' => true)
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Target', 'mkdf-core'),
                    'param_name'  => 'target',
                    'value'       => array(
                        esc_html__('Blank', 'mkdf-core') => '_blank',
                        esc_html__('Self', 'mkdf-core')  => '_self'
                    ),
                    'save_always' => true,
                    'dependency'  => array('element' => 'image', 'not_empty' => true)
                )
            )
        ));

    }

    public function render($atts, $content = null) {

        $default_atts = array(
            'image'       => '',
            'link'        => '',
            'target'      => ''
        );

        $params = shortcode_atts($default_atts, $atts);
        extract($params);

        return mkdf_core_get_shortcode_module_template_part('templates/hiding-image', 'hiding-images', '', $params);

    }
}