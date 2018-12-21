<?php

if ( ! function_exists( 'staffscout_mikado_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function staffscout_mikado_register_social_icon_widget( $widgets ) {
		$widgets[] = 'StaffScoutMikadoClassSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'staffscout_mikado_register_widgets', 'staffscout_mikado_register_social_icon_widget' );
}