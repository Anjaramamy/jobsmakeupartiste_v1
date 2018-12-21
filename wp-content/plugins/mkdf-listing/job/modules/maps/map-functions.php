<?php
use  MikadoListing\Maps;

if (!function_exists('mkdf_listing_job_generate_listing_map_vars')) {

    /**
     * Generates map variables based on sent attributes
     * $attributes can contain:
     *      $type - 'single' or 'multiple'. Single map variables is for google map on single listing pages, multiple is used for different lists and archive pages
     *      $id - id of current listing. Note that id is only used for single listing pages
     *      $query - $query is used just for multiple type. $query is Wp_Query object containing listing items which should be presented on map
     *      $init_multiple_map - boolean value to enable initial setting of map items. For example, when listing items are loaded via ajax, this is set on false, and in that case this param is false
     *
     * @param $attributes
     *
     */

    function mkdf_listing_job_generate_listing_map_vars($attributes) {

        $type = '';
        $id = '';
        $query = '';
        $init_multiple_map = false;

        extract($attributes);
        new Maps\MapGlobalVars($type, $id, $query, $init_multiple_map);

    }

}


if (!function_exists('mkdf_listing_job_set_global_map_variables')) {
    /**
     * Function for setting global map variables
     */
    function mkdf_listing_job_set_global_map_variables() {
        $global_map_variables = array();

        if(mkdf_listing_theme_installed()) {

            $global_map_variables['mapStyle'] = json_decode(staffscout_mikado_options()->getOptionValue('listing_map_style'));
            $global_map_variables['scrollable'] = staffscout_mikado_options()->getOptionValue('listing_maps_scrollable') == 'yes' ? true : false;
            $global_map_variables['draggable'] = staffscout_mikado_options()->getOptionValue('listing_maps_draggable') == 'yes' ? true : false;
            $global_map_variables['streetViewControl'] = staffscout_mikado_options()->getOptionValue('listing_maps_street_view_control') == 'yes' ? true : false;
            $global_map_variables['zoomControl'] = staffscout_mikado_options()->getOptionValue('listing_maps_zoom_control') == 'yes' ? true : false;
            $global_map_variables['mapTypeControl'] = staffscout_mikado_options()->getOptionValue('listing_maps_type_control') == 'yes' ? true : false;

            $global_map_variables = apply_filters('mkdf_listing_job_filter_js_global_map_variables', $global_map_variables);

            wp_localize_script('staffscout_mikado_modules', 'mkdfMapsVars', array(
                'global' => $global_map_variables
            ));

        }
    }

    add_action('wp_enqueue_scripts', 'mkdf_listing_job_set_global_map_variables', 20);

}

if (!function_exists('mkdf_listing_job_set_single_map_variables')) {
    /**
     * Function for setting single map variables
     */
    function mkdf_listing_job_set_single_map_variables() {

        if (is_singular('job_listing')) {
            $map_array = array(
                'type' => 'single',
                'id'   => get_the_ID()
            );
            mkdf_listing_job_generate_listing_map_vars($map_array);
        }

    }

    add_action('wp', 'mkdf_listing_job_set_single_map_variables', 1);
}


if (!function_exists('mkdf_listing_job_get_listing_item_map')) {
    /**
     * Function that renders map holder for single listing item
     *
     * @return string
     */
    function mkdf_listing_job_get_listing_item_map($latitude, $longitude) {


        $html = '<div id="mkdf-ls-single-map-holder"></div>
				<meta itemprop="latitude" content="' . $latitude . '">
				<meta itemprop="longitude" content="' . $longitude . '">';

        do_action('mkdf_listing_job_after_listing_map');

        return $html;

    }

}

if (!function_exists('mkdf_listing_job_get_listing_multiple_map')) {
    /**
     * Function that renders map holder for multiple listing item
     *
     * @return string
     */
    function mkdf_listing_job_get_listing_multiple_map() {

        $html = '<div id="mkdf-ls-multiple-map-holder"></div>';

        do_action('mkdf_listing_job_after_listing_map');

        return $html;

    }

}

if (!function_exists('mkdf_listing_job_marker_info_template')) {
    /**
     * Template with placeholders for marker info window
     *
     * uses underscore templates
     *
     */
    function mkdf_listing_job_marker_info_template() {

        $html = '<script type="text/template" class="mkdf-info-window-template">
				<div class="mkdf-info-window">
                    <a href="<%= itemUrl %>"></a>
                    <div class="mkdf-info-window-details">
                        <h6 class="mkdf-info-window-company">
                            <%= itemAuthor %>
                        </h6>
                        <p class="mkdf-info-window-title">
                            <%= title %>
                        </p>
                    </div>
				</div>
			</script>';

        print $html;

    }

    add_action('mkdf_listing_job_after_listing_map', 'mkdf_listing_job_marker_info_template');

}

if (!function_exists('mkdf_listing_job_marker_template')) {
    /**
     * Template with placeholders for marker
     */
    function mkdf_listing_job_marker_template() {

        $html = '<script type="text/template" class="mkdf-marker-template">
				<div class="mkdf-map-marker <%= pinClass %>">
					<div class="mkdf-map-marker-inner">
					<%= pin %>
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		                    width="27px" height="41px" viewBox="0 0 27 41" enable-background="new 0 0 27 41" xml:space="preserve">
						<path fill="#FF3366" d="M13.563,0.237c-6.792,0-12.315,5.525-12.315,12.315c0,5.529,3.729,13.558,5.953,17.854  C10.24,36.274,13.459,41,14.098,41c0.794,0,3.816-5.029,6.466-10.761c1.598-3.457,5.315-12.1,5.315-17.687  C25.879,5.762,20.354,0.237,13.563,0.237z"/>
						<circle xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" cx="13.563" cy="12.219" r="4.647"/>
						</svg>
					</div>
				</div>
			</script>';

        print $html;

    }

    add_action('mkdf_listing_job_after_listing_map', 'mkdf_listing_job_marker_template');

}


if (!function_exists('mkdf_listing_job_get_address_params')) {

    /**
     * Function that set up address params
     * param id - id of current post
     *
     * @return array
     */

    function mkdf_listing_job_get_address_params($id) {

        $address_array = array();
        $address_string = get_post_meta($id, 'geolocation_formatted_address', true);
        $address_lat = get_post_meta($id, 'geolocation_lat', true);
        $address_long = get_post_meta($id, 'geolocation_long', true);

        $address_array['address'] = $address_string !== '' ? $address_string : '';
        $address_array['address_lat'] = $address_lat !== '' ? $address_lat : '';
        $address_array['address_long'] = $address_long !== '' ? $address_long : '';

        return $address_array;

    }

}

if (!function_exists('mkdf_listing_job_get_address_html')) {
    /**
     * Function return listing address html
     * param id - id of current post
     *
     * @return string
     */
    function mkdf_listing_job_get_address_html($id) {

        $params_address = mkdf_listing_job_get_address_params($id);
        $city = get_post_meta($id, 'geolocation_city', true);

        extract($params_address);
        $html = '';
        $get_directions_link = '';

        if ($address_lat !== '' && $address_long !== '') {
            $get_directions_link = '//maps.google.com/maps?daddr=' . $address_lat . ',' . $address_long;
        }

        if ($get_directions_link !== '') {
            $html .= '<div class="mkdf-ls-adr-pin">';
            $html .= '<a href="' . $get_directions_link . '" target="_blank">';
            $html .= staffscout_mikado_icon_collections()->renderIcon('icon_pin', 'font_elegant');
            $html .= '</a>';
            $html .= '</div>';
        }

        if ($city !== '') {
            $html .= '<div class="mkdf-ls-adr-city">';
            $html .= '<span>' . esc_html__('In ', 'mkdf-listing') . '</span>';
            $html .= '<span class="mkdf-city">' . esc_html($city) . '</span>';
            $html .= '</div>';
        }

        return $html;
    }
}