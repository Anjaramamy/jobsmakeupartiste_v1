<?php

if ( ! function_exists( 'staffscout_mikado_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function staffscout_mikado_register_blog_list_widget( $widgets ) {
		$widgets[] = 'StaffScoutMikadoClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'staffscout_mikado_register_widgets', 'staffscout_mikado_register_blog_list_widget' );
}