<?php
namespace MikadoResume\Lib\Shortcodes;

use MikadoResume\Lib\Shortcodes\ShortcodeInterface;

/**
 * Class ResumeItem
 * @package MikadoResume\Lib\Shortcodes
 */
class ResumeItem implements ShortcodeInterface {
    private static $instance;
    private $base;
    private $basic_params;

    public function __construct() {
        $this->base = 'mkdf_listing_resume_item';
        self::$instance = $this;

        add_action( 'vc_before_init', array( $this, 'vcMap' ) );

        //resume selected projects filter
        add_filter( 'vc_autocomplete_mkdf_listing_resume_item_selected_projects_callback', array( &$this, 'resumeIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //resume selected projects render
        add_filter( 'vc_autocomplete_mkdf_listing_resume_item_selected_projects_render', array( &$this, 'resumeIdAutocompleteRender', ), 10, 1 ); // Render exact resume. Must return an array (label,value)
    }


    /**
     * Returns current instance of class
     * @return ResumeList
     */
    public static function getInstance() {

        if(self::$instance == null) {
            return new self;
        }

        return self::$instance;
    }

    public function getBase() {
        return $this->base;
    }

    public function setBasicParams($params = array()){

        if(is_array($params) && count($params)){
            foreach($params as $param_key => $param_value){
                $this->basic_params[$param_key] = $param_value;
            }
        }

    }

    public function resetBasicParams(){
        if(is_array($this->basic_params) && count($this->basic_params)){
            foreach ($this->basic_params as $param_key => $param_value) {
                unset($this->basic_params[$param_key]);
            }
        }
    }

    public function getBasicParams(){
        return $this->basic_params;
    }

    public function getBasicParamByKey($key){
        return $this->basic_params[$key];
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'     => esc_html__( 'Mikado Resume Item', 'mkdf-listing' ),
                    'base'     => $this->base,
                    'icon'     => 'icon-wpb-resume-item extended-custom-icon',
                    'category' => esc_html__( 'by MIKADO', 'mkdf-listing' ),
                    'params'   => array_merge(
                        array(
                            array(
                                'type'        => 'textfield',
                                'param_name'  => 'custom_class',
                                'heading'     => esc_html__( 'Custom CSS Class', 'mkdf-listing' ),
                                'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'mkdf-listing' )
                            ),
                            array(
                                'type'        => 'autocomplete',
                                'param_name'  => 'selected_projects',
                                'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'mkdf-listing' ),
                                'settings'    => array(
                                    'multiple'      => true,
                                    'sortable'      => true,
                                    'unique_values' => true
                                ),
                                'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'mkdf-listing' )
                            )
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'custom_class'      => '',
            'selected_projects' => ''
        );
        $params = shortcode_atts($args, $atts);

        $this->resetBasicParams();
        $this->setBasicParams($params);

        return mkdf_listing_resume_get_shortcode_module_template_part('templates/resume-item-template', 'resume-item');
    }

    /**
     * Filter resumes by ID or Title
     *
     * @param $query
     *
     * @return array
     */
    public function resumeIdAutocompleteSuggester( $query ) {
        global $wpdb;
        $resume_id    = (int) $query;
        $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'resume' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $resume_id > 0 ? $resume_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['id'];
                $data['label'] = esc_html__( 'Id', 'mkdf-listing' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'mkdf-listing' ) . ': ' . $value['title'] : '' );
                $results[]     = $data;
            }
        }

        return $results;
    }

    /**
     * Find resume by id
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function resumeIdAutocompleteRender( $query ) {
        $query = trim( $query['value'] ); // get value from requested
        if ( ! empty( $query ) ) {
            // get resume
            $resume = get_post( (int) $query );
            if ( ! is_wp_error( $resume ) ) {

                $resume_id    = $resume->ID;
                $resume_title = $resume->post_title;

                $resume_title_display = '';
                if ( ! empty( $resume_title ) ) {
                    $resume_title_display = ' - ' . esc_html__( 'Title', 'mkdf-listing' ) . ': ' . $resume_title;
                }

                $resume_id_display = esc_html__( 'Id', 'mkdf-listing' ) . ': ' . $resume_id;

                $data          = array();
                $data['value'] = $resume_id;
                $data['label'] = $resume_id_display . $resume_title_display;

                return ! empty( $data ) ? $data : false;
            }

            return false;
        }

        return false;
    }
}