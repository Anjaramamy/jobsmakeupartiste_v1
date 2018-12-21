<?php
namespace MikadoResume\Maps;
class MapGlobalVars
{

    private $id;
    private $type;
    private $query;
    private $init_multiple_map;
    private $multiple_vars;

    public function __construct($type, $id = '', $query = '', $init_multiple_map = false) {

        $this->type = $type;
        $this->id = $id;
        $this->query = $query;
        $this->init_multiple_map = $init_multiple_map;
        $this->multiple_vars['addresses'] = array();

        if ($this->type === 'single') {
            add_action('wp_enqueue_scripts', array($this, 'generateSingleGlobalVar'), 20);
        }
        if ($this->type === 'multiple') {
            $this->setMultipleVars();

            if ($this->init_multiple_map) {
                add_action('wp_footer', array($this, 'setMultipleGlobalVars'));
            }
        }
    }

    public function generateSingleGlobalVar() {

        $single_map_variables = array();

        if ($this->id !== '') {
            $single_map_variables['currentResume'] = $this->generateResumeMapParams($this->id);
        }

        $single_map_variables = apply_filters('mkdf_listing_resume_filter_js_single_map_variables', $single_map_variables);

        wp_localize_script('staffscout_mikado_modules', 'mkdfSingleResumeMapVars', array(
            'single' => $single_map_variables
        ));

    }

    public function setMultipleGlobalVars() {

        $multiple_map_variables = $this->getMultipleVars();

        wp_localize_script('staffscout_mikado_modules', 'mkdfMultipleResumeMapVars', array(
            'multiple' => $multiple_map_variables
        ));

    }

    public function setMultipleVars() {

        if ($this->query !== '') {
            if ($this->query->have_posts()) {
                while ($this->query->have_posts()) {
                    $this->query->the_post();
                    $this->multiple_vars['addresses'][] = $this->generateResumeMapParams(get_the_ID());
                }
                wp_reset_postdata();
            }
        }

    }

    public function getMultipleVars() {
        return $this->multiple_vars;
    }

    private function generateResumeMapParams($resume_item_id) {

        $resume_map_params = array();

        //get resume image
        $image = get_avatar_url(get_the_author_meta('ID'));

        //get resume position
        $position = get_post_meta( $resume_item_id, '_candidate_title', true);

        //Get item type
        $resume_types = wp_get_post_terms($resume_item_id, 'resume_type');
        $resume_type_id = false;
        if (is_array($resume_types) && count($resume_types)) {
            $resume_type_id = $resume_types[0]->term_id;
        }

        //Get item category
        $resume_cat_id = false;
        $categories = wp_get_post_terms($resume_item_id, 'resume_category');
        if (is_array($categories) && count($categories)) {
            $resume_cat_id = $categories[0]->term_id;
        }

        //take marker pin
        $marker_pin_icon = $marker_pin_icon_pack = $marker_pin = $marker_class = '';

        if ($resume_cat_id) {

            $image_url_style = mkdf_listing_resume_get_taxonomy_custom_icon_style_attr($resume_cat_id);
            if ($image_url_style !== '') {
                $marker_class = 'mkdf-pin-custom';
                $marker_pin = '<span class="mkdf-pin-custom-image"' . staffscout_mikado_get_inline_style($image_url_style) . '></span>';
            } else {
                $marker_class = 'mkdf-pin-icon';
                $marker_pin_icon_pack = get_term_meta($resume_cat_id, 'icon_pack', true);
                //take category icon
                if ($marker_pin_icon_pack !== '') {
                    $param = staffscout_mikado_icon_collections()->getIconCollectionParamNameByKey($marker_pin_icon_pack);
                    $marker_pin_icon = get_term_meta($resume_cat_id, $param, true);
                }

                if ($marker_pin_icon !== '' && $marker_pin_icon_pack !== '') {
                    $marker_pin = staffscout_mikado_icon_collections()->renderIcon($marker_pin_icon, $marker_pin_icon_pack);
                }
            }
        }

        //get address params
        $address_array = mkdf_listing_resume_get_address_params($resume_item_id);

        //Get item location
        if ($address_array['address'] === '' && $address_array['address_lat'] === '' && $address_array['address_long'] === '') {
            $resume_map_params['location'] = null;
        } else {
            $resume_map_params['location'] = array(
                'address'   => $address_array['address'],
                'latitude'  => $address_array['address_lat'],
                'longitude' => $address_array['address_long']
            );
        }


        $resume_map_params['title'] = get_the_title($resume_item_id);

        if (isset($resume_type_id) && $resume_type_id) {
            $resume_post = get_post($resume_type_id);
            $resume_item_type_name = null;
            if ($resume_post && $resume_post !== null) {
                $resume_item_type_name = $resume_type_id !== '' ? get_post($resume_type_id)->post_name : null;
            }
            $resume_map_params['resumeType'] = $resume_item_type_name;
        }

        $resume_map_params['markerClass'] = $marker_class;
        $resume_map_params['markerPin'] = $marker_pin;
        $resume_map_params['featuredImage'] = $image;
        $resume_map_params['position'] = $position;
        $resume_map_params['itemUrl'] = get_the_permalink($resume_item_id);

        return $resume_map_params;

    }

}