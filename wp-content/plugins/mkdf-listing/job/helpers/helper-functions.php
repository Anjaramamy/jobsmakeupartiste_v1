<?php
use MikadoListing\Lib\Shortcodes;
if(!function_exists('mkdf_listing_job_get_listing_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function mkdf_listing_job_get_listing_module_template_part($module, $template, $slug = '', $params = array()) {

		//HTML Content from template
		$html = '';
		$template_path = MIKADO_LISTING_ABS_PATH.'/job/modules/'.$module.'/templates';

		$temp = $template_path.'/'.$template;

		if(is_array($params) && count($params)) {
			extract($params);
		}

		$template = '';

		if (!empty($temp)) {
			if (!empty($slug)) {
				$template = "{$temp}-{$slug}.php";

				if(!file_exists($template)) {
					$template = $temp.'.php';
				}
			} else {
				$template = $temp.'.php';
			}
		}

		if (!empty($template)) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}

		return $html;
	}
}
if(!function_exists('mkdf_listing_job_single_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function mkdf_listing_job_single_template_part($template, $slug = '', $params = array()) {

		//HTML Content from template
		$html = '';
		$template_path = MIKADO_LISTING_ABS_PATH.'/job/modules/single/templates';

		$temp = $template_path.'/'.$template;

		if(is_array($params) && count($params)) {
			extract($params);
		}

		$template = '';

		if (!empty($temp)) {
			if (!empty($slug)) {
				$template = "{$temp}-{$slug}.php";

				if(!file_exists($template)) {
					$template = $temp.'.php';
				}
			} else {
				$template = $temp.'.php';
			}
		}

		if (!empty($template)) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}

		print $html;
	}
}


if(!function_exists('mkdf_listing_job_get_archive_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function mkdf_listing_job_get_archive_module_template_part($template, $slug = '', $params = array()) {

		//HTML Content from template
		$html = '';
		$template_path = MIKADO_LISTING_ABS_PATH.'/job/modules/archive/templates';

		$temp = $template_path.'/'.$template;

		if(is_array($params) && count($params)) {
			extract($params);
		}

		$template = '';

		if (!empty($temp)) {
			if (!empty($slug)) {
				$template = "{$temp}-{$slug}.php";

				if(!file_exists($template)) {
					$template = $temp.'.php';
				}
			} else {
				$template = $temp.'.php';
			}
		}

		if (!empty($template)) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}

		print $html;
	}
}

if(!function_exists('mkdf_listing_job_get_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $shortcode name of the shortcode folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function mkdf_listing_job_get_shortcode_module_template_part($template, $shortcode, $slug = '', $params = array()) {

		//HTML Content from template
		$html          = '';
		$template_path = MIKADO_LISTING_ABS_PATH.'/job/modules/shortcodes/'.$shortcode;

		$temp = $template_path.'/'.$template;

		if(is_array($params) && count($params)) {
			extract($params);
		}

		$template = '';

		if (!empty($temp)) {
			if (!empty($slug)) {
				$template = "{$temp}-{$slug}.php";

				if(!file_exists($template)) {
					$template = $temp.'.php';
				}
			} else {
				$template = $temp.'.php';
			}
		}

		if ($template) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}

		return $html;
	}
}

if(!function_exists('mkdf_listing_job_include_shortcodes_file')) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function mkdf_listing_job_include_shortcodes_file() {
		foreach(glob(MIKADO_LISTING_ABS_PATH.'/job/modules/shortcodes/*/load.php') as $shortcode_load) {
			include_once $shortcode_load;
		}

	}

	add_action('init', 'mkdf_listing_job_include_shortcodes_file', 6); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if(!function_exists('mkdf_listing_job_load_shortcodes')) {
	function mkdf_listing_job_load_shortcodes() {
		include_once MIKADO_LISTING_ABS_PATH.'/job/lib/shortcodes/shortcode-loader.php';
		Shortcodes\ShortcodeLoader::getInstance()->load();
	}

	add_action('init', 'mkdf_listing_job_load_shortcodes', 7); // permission 7 is set to be before vc_before_init hook that has permission 9 and after mkdf_listing_job_include_shortcodes_file hook
}

if ( ! function_exists( 'mkdf_listing_job_get_yes_no_select_array' ) ) {
	/**
	 * Returns array of yes no
	 * @return array
	 */
	function mkdf_listing_job_get_yes_no_select_array( $enable_default = true, $set_yes_to_be_first = false ) {
		$select_options = array();

		if ( $enable_default ) {
			$select_options[''] = esc_html__( 'Default', 'mkdf-listing' );
		}

		if ( $set_yes_to_be_first ) {
			$select_options['yes'] = esc_html__( 'Yes', 'mkdf-listing' );
			$select_options['no']  = esc_html__( 'No', 'mkdf-listing' );
		} else {
			$select_options['no']  = esc_html__( 'No', 'mkdf-listing' );
			$select_options['yes'] = esc_html__( 'Yes', 'mkdf-listing' );
		}

		return $select_options;
	}
}

if ( ! function_exists( 'mkdf_listing_job_get_title_tag' ) ) {
	/**
	 * Returns array of title tags
	 *
	 * @param bool $first_empty
	 * @param array $additional_elements
	 *
	 * @return array
	 */
	function mkdf_listing_job_get_title_tag( $first_empty = false, $additional_elements = array() ) {
		$title_tag = array();

		if ( $first_empty ) {
			$title_tag[''] = esc_html__( 'Default', 'mkdf-listing' );
		}

		$title_tag['h1'] = 'h1';
		$title_tag['h2'] = 'h2';
		$title_tag['h3'] = 'h3';
		$title_tag['h4'] = 'h4';
		$title_tag['h5'] = 'h5';
		$title_tag['h6'] = 'h6';

		if ( ! empty( $additional_elements ) ) {
			$title_tag = array_merge( $title_tag, $additional_elements );
		}

		return $title_tag;
	}
}

if ( ! function_exists( 'mkdf_membership_listing_add_social_share_option' ) ) {
    function mkdf_membership_listing_add_social_share_option( $container ) {
        staffscout_mikado_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'enable_social_share_on_job_listing',
                'default_value' => 'no',
                'label'         => esc_html__( 'Listing', 'mkdf-listing' ),
                'description'   => esc_html__( 'Show Social Share for Listing Items', 'mkdf-listing' ),
                'parent'        => $container
            )
        );
    }

    add_action( 'staffscout_mikado_post_types_social_share', 'mkdf_membership_listing_add_social_share_option', 10, 1 );
}