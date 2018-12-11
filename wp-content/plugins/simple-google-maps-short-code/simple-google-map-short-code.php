<?php
/*
Plugin Name: Simple Google Maps Shortcode
Plugin URI: https://wordpress.org/plugins/simple-google-maps-short-code/
Description: Adds a simple Google Maps shortcode to any post, page or widget.
Version: 1.3.2
Author: WebFactory Ltd
Author URI: http://www.webfactoryltd.com/
*/

/**
 * Loads the plugin textdomain
 *
 * @access      private
 * @since       1.2
 * @return      void
*/
function pw_map_textdomain() {

	// Set filter for plugin's languages directory
	$lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$lang_dir = apply_filters( 'pw_map_languages_directory', $lang_dir );

	// Load the translations
	load_plugin_textdomain( 'simple-google-maps-short-code', false, $lang_dir );
}
add_action( 'init', 'pw_map_textdomain' );

/**
 * Displays the map
 *
 * @access      private
 * @since       1.0
 * @return      void
*/
function pw_map_shortcode( $atts ) {

	$atts = shortcode_atts(
		array(
			'address'           => false,
			'width'             => '100%',
			'height'            => '400px',
			'enablescrollwheel' => 'true',
			'zoom'              => 15,
			'disablecontrols'   => 'false',
			'key'               => ''
		),
		$atts
	);

	$address = $atts['address'];

	

	if( $address  ) :

    

		$coordinates = pw_map_get_coordinates( $address, false, sanitize_text_field( $atts['key'] ) );

		if( ! is_array( $coordinates ) ) {			
			return;
		}
    
    wp_enqueue_script( 'google-maps-api', '//maps.google.com/maps/api/js?key=' . sanitize_text_field( $atts['key'] ) );
		wp_print_scripts( 'google-maps-api' );

		$map_id = uniqid( 'pw_map_' ); // generate a unique ID for this map

		ob_start(); ?>
		<div class="pw_map_canvas" id="<?php echo esc_attr( $map_id ); ?>" style="height: <?php echo esc_attr( $atts['height'] ); ?>; width: <?php echo esc_attr( $atts['width'] ); ?>"></div>
		<script type="text/javascript">
			var map_<?php echo $map_id; ?>;
			function pw_run_map_<?php echo $map_id ; ?>(){
				var location = new google.maps.LatLng("<?php echo $coordinates['lat']; ?>", "<?php echo $coordinates['lng']; ?>");
				var map_options = {
					zoom: <?php echo $atts['zoom']; ?>,
					center: location,
					scrollwheel: <?php echo 'true' === strtolower( $atts['enablescrollwheel'] ) ? '1' : '0'; ?>,
					disableDefaultUI: <?php echo 'true' === strtolower( $atts['disablecontrols'] ) ? '1' : '0'; ?>,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				map_<?php echo $map_id ; ?> = new google.maps.Map(document.getElementById("<?php echo $map_id ; ?>"), map_options);
				var marker = new google.maps.Marker({
				position: location,
				map: map_<?php echo $map_id ; ?>
				});
			}
			pw_run_map_<?php echo $map_id ; ?>();
		</script>
		<?php
		return ob_get_clean();
	else :
		return __( 'This Google Map cannot be loaded because the maps API does not appear to be loaded', 'simple-google-maps-short-code' );
	endif;
}
add_shortcode( 'pw_map', 'pw_map_shortcode' );

/**
 * Retrieve coordinates for an address
 *
 * Coordinates are cached using transients and a hash of the address
 *
 * @access      private
 * @since       1.0
 * @return      void
*/
function pw_map_get_coordinates( $address, $force_refresh = false, $api_key = '' ) {

	$address_hash = md5( $address );

	$coordinates = get_transient( $address_hash );

	if ( $force_refresh || $coordinates === false ) {

		$args       = apply_filters( 'pw_map_query_args', array( 'key' => $api_key, 'address' => urlencode( $address ), 'key' => $api_key ) );
		$url        = add_query_arg( $args, 'https://maps.googleapis.com/maps/api/geocode/json' );
		$response 	= wp_remote_get( $url );

		if( is_wp_error( $response ) ) {
			return;
		}

		$data = wp_remote_retrieve_body( $response );

		if( is_wp_error( $data ) ) {
			return;
		}

		if ( $response['response']['code'] == 200 ) {

			$data = json_decode( $data );

			if ( $data->status === 'OK' ) {

				$coordinates = $data->results[0]->geometry->location;

				$cache_value['lat'] 	= $coordinates->lat;
				$cache_value['lng'] 	= $coordinates->lng;
				$cache_value['address'] = (string) $data->results[0]->formatted_address;

				// cache coordinates for 3 months
				set_transient($address_hash, $cache_value, 3600*24*30*3);
				$data = $cache_value;

			} elseif ( $data->status === 'ZERO_RESULTS' ) {
				return __( 'No location found for the entered address.', 'simple-google-maps-short-code' );
			} elseif( $data->status === 'INVALID_REQUEST' ) {
				return __( 'Invalid request. Did you enter an address?', 'simple-google-maps-short-code' );
			} else {
				return __( 'Something went wrong while retrieving your map, please ensure you have entered the short code correctly.', 'simple-google-maps-short-code' );
			}

		} else {
			return __( 'Unable to contact Google API service.', 'simple-google-maps-short-code' );
		}

	} else {
	   // return cached results
	   $data = $coordinates;
	}

	return $data;
}


/**
 * Fixes a problem with responsive themes
 *
 * @access      private
 * @since       1.0.1
 * @return      void
*/

function pw_map_css() {
	echo '<style type="text/css">/* =Responsive Map fix
-------------------------------------------------------------- */
.pw_map_canvas img {
	max-width: none;
}</style>';

}
add_action( 'wp_head', 'pw_map_css' );
