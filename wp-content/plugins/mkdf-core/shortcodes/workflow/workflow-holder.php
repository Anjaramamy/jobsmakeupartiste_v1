<?php

namespace  MikadoCore\CPT\Shortcodes\Workflow;

use MikadoCore\Lib;

/**
 * class Workflow
 */
class WorkflowHolder implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'mkdf_workflow';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
	    if ( function_exists( 'vc_map' ) ) {

		    vc_map( array(
			    'name'                    => esc_html__( 'Workflow', 'mkdf-core' ),
			    'base'                    => $this->base,
			    'as_parent'               => array( 'only' => 'mkdf_workflow_item' ),
			    'content_element'         => true,
			    'category'                => esc_html__( 'by MIKADO', 'mkdf-core'),
			    'icon'                    => 'icon-wpb-workflow extended-custom-icon',
			    'js_view'                 => 'VcColumnView',
			    'params'                  => array(
				    array(
					    'type'        => 'textfield',
					    'heading'     => esc_html__( 'Extra class name', 'mkdf-core' ),
					    'param_name'  => 'el_class',
					    'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'mkdf-core' )
				    ),
				    array(
					    'type'        => 'colorpicker',
					    'heading'     => esc_html__( 'Workflow line color', 'mkdf-core' ),
					    'param_name'  => 'line_color',
					    'description' => esc_html__( 'Pick a color for the workflow line.', 'mkdf-core' )
				    ),
				    array(
					    'type'        => 'dropdown',
					    'heading'     => esc_html__( 'Animate Workflow', 'mkdf-core' ),
					    'param_name'  => 'animate',
					    'value'       => array(
						    esc_html__( 'Yes', 'mkdf-core' ) => 'yes',
						    esc_html__( 'No', 'mkdf-core' )  => 'no',
					    ),
					    'description' => esc_html__( 'Animate Workflow shortcode when it comes into viewport', 'mkdf-core' ),
					    'save_always' => true,
				    )
			    )
		    ) );
	    }
    }

    public function render($atts, $content = null) {
        $default_atts = (array(
            'el_class'     => '',
            'line_color'   => '',
            'animate'      => 'yes',
        ));

        $params       = shortcode_atts($default_atts, $atts);
        $style_params = $this->getStyleProperties($params);
        $params       = array_merge($params, $style_params);
        extract($params);

        $params['el_class'] = $this->getWorkflowClasses($params);
        $params['content']  = $content;
        $output             = '';

        $output .= mkdf_core_get_shortcode_module_template_part('templates/workflow-holder-template', 'workflow', '', $params);

        return $output;
    }

    /**
     * Generates workflow extra classes
     *
     * @param $params
     *
     * @return string
     */
    private function getWorkflowClasses($params) {

        $el_class = '';
        $class    = $params['el_class'];

        if($class !== '') {
            $el_class = $class;
        }

        if($params['animate'] == 'yes') {
            $el_class = 'mkdf-workflow-animate';
        }

        return $el_class;
    }

    /**
     * Generates main line color
     *
     * @param $params
     *
     * @return array
     */

    private function getStyleProperties($params) {

        $style                    = array();
        $style['main_line_style'] = '';

        if($params['line_color'] !== '') {
            $style['main_line_style'] = 'background-color:'.$params['line_color'].';';
        }

        return $style;
    }

}
