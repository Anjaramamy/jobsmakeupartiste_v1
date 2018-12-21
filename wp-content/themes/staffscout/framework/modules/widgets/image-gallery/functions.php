<?php

if ( ! function_exists( 'staffscout_mikado_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function staffscout_mikado_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'StaffScoutMikadoClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'staffscout_mikado_register_widgets', 'staffscout_mikado_register_image_gallery_widget' );
}