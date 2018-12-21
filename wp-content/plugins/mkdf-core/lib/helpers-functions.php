<?php

if ( ! function_exists( 'mkdf_core_get_cpt_shortcode_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $shortcode name of the shortcode folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 * @param array $additional_params array of additional parameters to pass to template
	 *
	 * @return html
	 */
	function mkdf_core_get_cpt_shortcode_module_template_part( $shortcode, $template, $slug = '', $params = array(), $additional_params = array() ) {
		
		//HTML Content from template
		$html          = '';
		$template_path = MIKADO_CORE_CPT_PATH . '/' . $shortcode . '/shortcodes/templates';
		
		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		if ( is_array( $additional_params ) && count( $additional_params ) ) {
			extract( $additional_params );
		}
		
		$template = '';
		
		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";
				
				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}
		
		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if ( ! function_exists( 'mkdf_core_get_cpt_single_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $cpt_name name of the cpt folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function mkdf_core_get_cpt_single_module_template_part( $template, $cpt_name, $slug = '', $params = array() ) {
		
		//HTML Content from template
		$html          = '';
		$template_path = MIKADO_CORE_CPT_PATH . '/' . $cpt_name;
		
		$temp = $template_path . '/' . $template;
		
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$template = '';
		
		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";
				
				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}
		
		if ( ! empty( $template ) ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}
		
		print $html;
	}
}

if(!function_exists('mkdf_core_return_cpt_single_module_template_part')) {
    /**
     * Loads module template part.
     *
     * @param string $cpt_name name of the cpt folder
     * @param string $template name of the template to load
     * @param string $slug
     * @param array $params array of parameters to pass to template
     *
     * @return html
     */
    function mkdf_core_return_cpt_single_module_template_part($template, $cpt_name, $slug = '', $params = array()) {

        //HTML Content from template
        $html = '';
        $template_path = MIKADO_CORE_CPT_PATH.'/'.$cpt_name;

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

if(!function_exists('mkdf_core_get_shortcode_module_template_part')) {
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
	function mkdf_core_get_shortcode_module_template_part($template, $shortcode, $slug = '', $params = array()) {
		
		//HTML Content from template
		$html          = '';
		$template_path = MIKADO_CORE_SHORTCODES_PATH.'/'.$shortcode;
		
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

if( ! function_exists( 'mkdf_core_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 */
	function mkdf_core_ajax_status($status, $message, $data = NULL) {
		$response = array (
			'status' => $status,
			'message' => $message,
			'data' => $data
		);
		
		$output = json_encode($response);
		
		exit($output);
	}
}

if(!function_exists('staffscout_mikado_add_user_custom_fields')) {
	/**
	 * Function creates custom social fields for users
	 *
	 * return $user_contact
	 */
	function staffscout_mikado_add_user_custom_fields($user_contact) {
		/**
		 * Function that add custom user fields
		 **/
		$user_contact['facebook']   = esc_html__('Facebook', 'mkdf-core');
		$user_contact['twitter']    = esc_html__('Twitter', 'mkdf-core');
		$user_contact['linkedin']   = esc_html__('Linkedin', 'mkdf-core');
		$user_contact['instagram']  = esc_html__('Instagram', 'mkdf-core');
		$user_contact['pinterest']  = esc_html__('Pinterest', 'mkdf-core');
		$user_contact['tumblr']     = esc_html__('Tumbrl', 'mkdf-core');
		$user_contact['googleplus'] = esc_html__('Google Plus', 'mkdf-core');
		
		return $user_contact;
	}
	
	add_filter('user_contactmethods', 'staffscout_mikado_add_user_custom_fields');
}

if ( ! function_exists( 'mkdf_core_set_open_graph_meta' ) ) {
	/*
	 * Function that echoes open graph meta tags if enabled
	 */
	function mkdf_core_set_open_graph_meta() {
		
		if ( staffscout_mikado_option_get_value( 'enable_open_graph' ) === 'yes' ) {
			
			// get the id
			$id = get_queried_object_id();
			
			// default type is article, override it with product if page is woo single product
			$type        = 'article';
			$description = '';
			
			// check if page is generic wp page w/o page id
			if ( staffscout_mikado_is_default_wp_template() ) {
				$id = 0;
			}
			
			// check if page is woocommerce shop page
			if ( staffscout_mikado_is_woocommerce_installed() && ( function_exists( 'is_shop' ) && is_shop() ) ) {
				$shop_page_id = get_option( 'woocommerce_shop_page_id' );
				
				if ( ! empty( $shop_page_id ) ) {
					$id = $shop_page_id;
					// set flag
					$description = 'woocommerce-shop';
				}
			}
			
			if ( function_exists( 'is_product' ) && is_product() ) {
				$type = 'product';
			}
			
			// if id exist use wp template tags
			if ( ! empty( $id ) ) {
				$url   = get_permalink( $id );
				$title = get_the_title( $id );
				
				// apply bloginfo description to woocommerce shop page instead of first product item description
				if ( $description === 'woocommerce-shop' ) {
					$description = get_bloginfo( 'description' );
				} else {
					$description = strip_tags( apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $id ) ) );
				}
				
				// has featured image
				if ( get_post_thumbnail_id( $id ) !== '' ) {
					$image = wp_get_attachment_url( get_post_thumbnail_id( $id ) );
				} else {
					$image = staffscout_mikado_option_get_value( 'open_graph_image' );
				}
			} else {
				global $wp;
				$url         = esc_url( home_url( add_query_arg( array(), $wp->request ) ) );
				$title       = get_bloginfo( 'name' );
				$description = get_bloginfo( 'description' );
				$image       = staffscout_mikado_option_get_value( 'open_graph_image' );
			}
			?>
			
			<meta property="og:url" content="<?php echo esc_url( $url ); ?>"/>
			<meta property="og:type" content="<?php echo esc_html( $type ); ?>"/>
			<meta property="og:title" content="<?php echo esc_html( $title ); ?>"/>
			<meta property="og:description" content="<?php echo esc_html( $description ); ?>"/>
			<meta property="og:image" content="<?php echo esc_url( $image ); ?>"/>
		
		<?php }
	}
	
	add_action( 'staffscout_mikado_header_meta', 'mkdf_core_set_open_graph_meta' );
}