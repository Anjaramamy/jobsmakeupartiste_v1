<?php

if ( ! function_exists( 'staffscout_mikado_like' ) ) {
	/**
	 * Returns StaffScoutMikadoClassLike instance
	 *
	 * @return StaffScoutMikadoClassLike
	 */
	function staffscout_mikado_like() {
		return StaffScoutMikadoClassLike::get_instance();
	}
}

function staffscout_mikado_get_like() {
	
	echo wp_kses( staffscout_mikado_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}