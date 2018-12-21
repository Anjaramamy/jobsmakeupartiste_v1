<?php

namespace MikadofMembership\Lib;

/**
 * Interface ShortcodeInterface
 * @package MikadofMembership\Lib
 */
interface ShortcodeInterface {
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null );
}