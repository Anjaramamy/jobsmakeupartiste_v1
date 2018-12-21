<?php
namespace MikadoCore\CPT\Shortcodes\Workflow;

use MikadoCore\Lib;

/**
 * class Workflow
 */
class WorkflowItem implements Lib\ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkdf_workflow_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            "name"     => esc_html__('Workflow Item', 'mkdf-core'),
            "base"     => $this->base,
            "as_child" => array('only' => 'mkdf_workflow'),
            "category" => esc_html__('by MIKADO', 'mkdf-core'),
            "icon"     => "icon-wpb-workflow-item extended-custom-icon",
            "params"   => array_merge(
                array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Title', 'mkdf-core'),
                        'param_name'  => 'title',
                        'admin_label' => true,
                        'description' => esc_html__('Enter workflow item title.', 'mkdf-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'title_color',
                        'heading'    => esc_html__('Title Color', 'mkdf-core'),
                        'dependency' => array('element' => 'title', 'not_empty' => true)
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Workflow Label', 'mkdf-core'),
                        'param_name'  => 'label',
                        'admin_label' => true,
                        'description' => esc_html__('Enter workflow item label, e.g. Step 1.', 'mkdf-core')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Label text color', 'mkdf-core'),
                        'param_name'  => 'label_text_color',
                        'description' => esc_html__('Pick a color for the label border color.', 'mkdf-core')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Label border color', 'mkdf-core'),
                        'param_name'  => 'label_border_color',
                        'description' => esc_html__('Pick a color for the label border color.', 'mkdf-core')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Label background color', 'mkdf-core'),
                        'param_name'  => 'label_background_color',
                        'description' => esc_html__('Pick a color for the label background color.', 'mkdf-core')
                    ),
                    array(
                        'type'        => 'textarea',
                        'heading'     => esc_html__('Text', 'mkdf-core'),
                        'param_name'  => 'text',
                        'description' => esc_html__('Enter workflow item text.', 'mkdf-core')
                    ),
                    array(
                        'type'        => 'attach_image',
                        'heading'     => esc_html__('Image', 'mkdf-core'),
                        'param_name'  => 'image',
                        'description' => esc_html__('Insert workflow item image.', 'mkdf-core')
                    ),
                    array(
                        'type'        => 'checkbox',
                        'heading'     => esc_html__('Set image on right side', 'mkdf-core'),
                        'param_name'  => 'image_float',
                        'value'       => array('Make Image Float Right?' => 'yes'),
                        'description' => ''
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Image alignment', 'mkdf-core'),
                        'param_name'  => 'image_alignment',
                        'admin_label' => true,
                        'value'       => array(
                            esc_html__('Center', 'mkdf-core') => 'center',
                            esc_html__('Left', 'mkdf-core')   => 'left',
                            esc_html__('Right', 'mkdf-core')  => 'right'
                        )
                    ),
                    array(
                        'type'       => 'textfield',
                        'param_name' => 'custom_link',
                        'heading'    => esc_html__('Image Custom Link', 'mkdf-core'),
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'custom_link_target',
                        'heading'    => esc_html__('Custom Link Target', 'mkdf-core'),
                        'value'      => array_flip(staffscout_mikado_get_link_target_array()),
                        'dependency' => Array('element' => 'custom_link', 'not_empty' => true)
                    ),
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = (array(
            'title'                  => '',
            'title_color'            => '',
            'text'                   => '',
            'label'                  => '',
            'image'                  => '',
            'image_float'            => '',
            'image_alignment'        => 'center',
            'custom_link'            => '',
            'custom_link_target'     => '_self',
            'label_text_color'       => '',
            'label_border_color'     => '',
            'label_background_color' => '',

        ));
        $params = shortcode_atts($default_atts, $atts);
        $style_params = $this->getStyleProperties($params);
        $params = array_merge($params, $style_params);
        extract($params);

        $params['image_on_right_class'] = $this->imageOnRightSideClass($params);
        $params['custom_link_target'] = !empty($params['custom_link_target']) ? $params['custom_link_target'] : $default_atts['custom_link_target'];
        $params['title_styles'] = $this->getTitleStyles($params);

        $output = '';
        $output .= mkdf_core_get_shortcode_module_template_part('templates/workflow-item-template', 'workflow', '', $params);

        return $output;
    }


    /**
     * Checks if image is set to be on right and set class
     *
     * @param $params
     *
     * @return string
     */
    private function imageOnRightSideClass($params) {

        $class = '';

        if ($params['image_float'] == 'yes') {
            $class .= 'reverse';
        }

        return $class;
    }

    /**
     * Generates label line color
     *
     * @param $params
     *
     * @return array
     */

    private function getStyleProperties($params) {

        $style = array();
        $style['label_text_color'] = '';
        $style['label_border_color'] = '';
        $style['label_background_color'] = '';
        $style['line_color'] = '';

        if ($params['label_text_color'] !== '') {
            $style['label_text_color'] = 'color:' . $params['label_text_color'] . ';';
        }

        if ($params['label_border_color'] !== '') {
            $style['label_border_color'] = 'border-color:' . $params['label_border_color'] . ';';
        }

        if ($params['label_background_color'] !== '') {
            $style['label_background_color'] = 'background-color:' . $params['label_background_color'] . ';';
            $style['line_color'] = 'background-color:' . $params['label_background_color'] . ';';
        }

        return $style;
    }

    private function getTitleStyles($params) {
        $styles = array();

        if (!empty($params['title_color'])) {
            $styles[] = 'color: ' . $params['title_color'];
        }

        return implode(';', $styles);
    }
}
