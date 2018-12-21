<?php

if ( ! function_exists( 'staffscout_mikado_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function staffscout_mikado_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'StaffScoutMikadoClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'staffscout_mikado_register_widgets', 'staffscout_mikado_register_woocommerce_dropdown_cart_widget' );
}