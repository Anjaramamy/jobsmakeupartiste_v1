<?php

if ( ! function_exists( 'staffscout_mikado_register_blog_masonry_template_file' ) ) {
	/**
	 * Function that register blog masonry template
	 */
	function staffscout_mikado_register_blog_masonry_template_file( $templates ) {
		$templates['blog-masonry'] = esc_html__( 'Blog: Masonry', 'staffscout' );
		
		return $templates;
	}
	
	add_filter( 'staffscout_mikado_register_blog_templates', 'staffscout_mikado_register_blog_masonry_template_file' );
}

if ( ! function_exists( 'staffscout_mikado_set_blog_masonry_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function staffscout_mikado_set_blog_masonry_type_global_option( $options ) {
		$options['masonry'] = esc_html__( 'Blog: Masonry', 'staffscout' );
		
		return $options;
	}
	
	add_filter( 'staffscout_mikado_blog_list_type_global_option', 'staffscout_mikado_set_blog_masonry_type_global_option' );
}