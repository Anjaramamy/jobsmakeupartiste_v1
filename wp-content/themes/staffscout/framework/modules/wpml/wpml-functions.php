<?php

if ( ! function_exists( 'staffscout_mikado_disable_wpml_css' ) ) {
	function staffscout_mikado_disable_wpml_css() {
		define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
	}
	
	add_action( 'after_setup_theme', 'staffscout_mikado_disable_wpml_css' );
}