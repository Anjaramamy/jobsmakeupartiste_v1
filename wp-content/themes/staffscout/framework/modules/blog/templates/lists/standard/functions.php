<?php

if ( ! function_exists( 'staffscout_mikado_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function staffscout_mikado_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'staffscout' );
		
		return $templates;
	}
	
	add_filter( 'staffscout_mikado_register_blog_templates', 'staffscout_mikado_register_blog_standard_template_file' );
}

if ( ! function_exists( 'staffscout_mikado_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function staffscout_mikado_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'staffscout' );
		
		return $options;
	}
	
	add_filter( 'staffscout_mikado_blog_list_type_global_option', 'staffscout_mikado_set_blog_standard_type_global_option' );
}