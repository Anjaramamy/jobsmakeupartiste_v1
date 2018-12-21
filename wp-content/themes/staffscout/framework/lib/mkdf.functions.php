<?php

/**
 * Function that checks if option has value from theme options.
 * It first checks global $theme_name_php_global_options variable and if option does'nt exists there
 * it checks default theme options
 *
 * @param $name string name of the option to retrieve
 *
 * @return bool
 */
function staffscout_mikado_option_has_value( $name ) {
	global $theme_name_php_global_options;
	global $theme_name_php_global_Framework;
	
	if ( array_key_exists( $name, $theme_name_php_global_Framework->mkdOptions->options ) ) {
		if ( isset( $theme_name_php_global_options[ $name ] ) ) {
			return true;
		} else {
			return false;
		}
	} else {
		global $post;
		
		$value = get_post_meta( $post->ID, $name, true );
		
		if ( isset( $value ) && $value !== "" ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Function that gets option by it's name.
 * It first checks if option exists in $theme_name_php_global_options global array and if it does'nt exists there
 * it checks default theme options array.
 *
 * @param $name string name of the option to retrieve
 *
 * @return mixed|void
 */
function staffscout_mikado_option_get_value( $name ) {
	global $theme_name_php_global_options;
	global $theme_name_php_global_Framework;
	
	if ( array_key_exists( $name, $theme_name_php_global_Framework->mkdOptions->options ) ) {
		if ( isset( $theme_name_php_global_options[ $name ] ) ) {
			return $theme_name_php_global_options[ $name ];
		} else {
			return $theme_name_php_global_Framework->mkdOptions->getOption( $name );
		}
	} else {
		global $post;
		
		if ( ! empty( $post ) ) {
			$value = get_post_meta( $post->ID, $name, true );
		}
		if ( isset( $value ) && $value !== "" ) {
			return $value;
		} else {
			return $theme_name_php_global_Framework->mkdMetaBoxes->getOption( $name );
		}
	}
}

/**
 * Function that gets attachment thumbnail url from attachment url
 *
 * @param $attachment_url string url of the attachment
 *
 * @return bool|string
 *
 * @see staffscout_mikado_get_attachment_id_from_url()
 */
function staffscout_mikado_get_attachment_thumb_url( $attachment_url ) {
	$attachment_id = staffscout_mikado_get_attachment_id_from_url( $attachment_url );
	
	if ( ! empty( $attachment_id ) ) {
		return wp_get_attachment_thumb_url( $attachment_id );
	} else {
		return $attachment_url;
	}
}

/**
 * Function that registers skin style. Wrapper around wp_register_style function,
 * it prepends $src with skin path
 *
 * @param $handle string unique key for style
 * @param $src string path inside skin folder
 * @param array $deps array of handles that style will depend on
 * @param bool|string $ver whether to add version string or not.
 * @param string $media media for which to add style. Defaults to 'all'
 *
 * @see wp_register_style()
 */
function staffscout_mikado_register_skin_style( $handle, $src, $deps = array(), $ver = false, $media = 'all' ) {
	global $theme_name_php_global_Framework;
	
	$src = get_template_directory_uri() . '/framework/admin/skins/' . $theme_name_php_global_Framework->getSkin() . '/' . $src;
	wp_register_style( $handle, $src, $deps = array(), $ver = false, $media = 'all' );
}

/**
 * Function that registers skin script. Wrapper around wp_register_script function,
 * it prepends $src with skin path
 *
 * @param $handle string unique key for style
 * @param $src string path inside skin folder
 * @param array $deps array of handles that style will depend on
 * @param bool|string $ver whether to add version string or not.
 * @param bool $in_footer whether to include script in footer or not.
 *
 * @see wp_register_script()
 */
function staffscout_mikado_register_skin_script( $handle, $src, $deps = array(), $ver = false, $in_footer = false ) {
	global $theme_name_php_global_Framework;
	
	$src = get_template_directory_uri() . '/framework/admin/skins/' . $theme_name_php_global_Framework->getSkin() . '/' . $src;
	wp_register_script( $handle, $src, $deps, $ver, $in_footer );
}

if ( ! function_exists( 'staffscout_mikado_generate_dynamic_css_and_js' ) ) {
	/**
	 * Function that gets content of dynamic assets files and puts that in static ones
	 */
	function staffscout_mikado_generate_dynamic_css_and_js() {
		global $wp_filesystem;
		WP_Filesystem();
		
		if ( staffscout_mikado_is_css_folder_writable() ) {
			$css_dir = MIKADO_ASSETS_ROOT_DIR . '/css/';
			
			ob_start();
			include_once $css_dir . 'style_dynamic.php';
			$css = ob_get_clean();
			if ( is_multisite() ) {
				$wp_filesystem->put_contents( $css_dir . 'style_dynamic_ms_id_' . staffscout_mikado_get_multisite_blog_id() . '.css', $css );
			} else {
				$wp_filesystem->put_contents( $css_dir . 'style_dynamic.css', $css );
			}
			
			ob_start();
			include_once $css_dir . 'style_dynamic_responsive.php';
			$css = ob_get_clean();
			if ( is_multisite() ) {
				$wp_filesystem->put_contents( $css_dir . 'style_dynamic_responsive_ms_id_' . staffscout_mikado_get_multisite_blog_id() . '.css', $css );
			} else {
				$wp_filesystem->put_contents( $css_dir . 'style_dynamic_responsive.css', $css );
			}
		}
	}
	
	add_action( 'staffscout_mikado_after_theme_option_save', 'staffscout_mikado_generate_dynamic_css_and_js' );
}

if ( ! function_exists( 'staffscout_mikado_gallery_upload_get_images' ) ) {
	/**
	 * Function that outputs single image html that is used in multiple image upload field
	 * Hooked to wp_ajax_mkd_gallery_upload_get_images action
	 */
	function staffscout_mikado_gallery_upload_get_images() {
		$ids = $_POST['ids'];
		$ids = explode( ",", $ids );
		
		foreach ( $ids as $id ):
			$image = wp_get_attachment_image_src( $id, 'thumbnail', true );
			echo '<li class="mkdf-gallery-image-holder"><img src="' . esc_url( $image[0] ) . '"/></li>';
		endforeach;
		
		exit;
	}
	
	add_action( 'wp_ajax_staffscout_mikado_gallery_upload_get_images', 'staffscout_mikado_gallery_upload_get_images' );
}

if ( ! function_exists( 'staffscout_mikado_hex2rgb' ) ) {
	/**
	 * Function that transforms hex color to rgb color
	 *
	 * @param $hex string original hex string
	 *
	 * @return array array containing three elements (r, g, b)
	 */
	function staffscout_mikado_hex2rgb( $hex ) {
		$hex = str_replace( "#", "", $hex );
		
		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );
		
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}
}

if ( ! function_exists( 'staffscout_mikado_addslashes' ) ) {
	/**
	 * Function that checks if magic quotes are turned on (for older versions of php) and returns escaped string
	 *
	 * @param $str string string to be escaped
	 *
	 * @return string escaped string
	 */
	function staffscout_mikado_addslashes( $str ) {
		//is magic quotes turned off in php.ini?
		if ( ! get_magic_quotes_gpc() ) {
			//apply addslashes
			$str = addslashes( $str );
		}
		
		//return escaped string
		return $str;
	}
}

if ( ! function_exists( 'staffscout_mikado_get_attachment_meta' ) ) {
	/**
	 * Function that returns attachment meta data from attachment id
	 *
	 * @param $attachment_id
	 * @param array $keys sub array of attachment meta
	 *
	 * @return array|mixed
	 */
	function staffscout_mikado_get_attachment_meta( $attachment_id, $keys = array() ) {
		$meta_data = array();
		
		//is attachment id set?
		if ( ! empty( $attachment_id ) ) {
			//get all post meta for given attachment id
			$meta_data = get_post_meta( $attachment_id, '_wp_attachment_metadata', true );
			
			//is subarray of meta array keys set?
			if ( is_array( $keys ) && count( $keys ) ) {
				$sub_array = array();
				
				//for each defined key
				foreach ( $keys as $key ) {
					//check if that key exists in all meta array
					if ( array_key_exists( $key, $meta_data ) ) {
						//assign key from meta array for current key to meta subarray
						$sub_array[ $key ] = $meta_data[ $key ];
					}
				}
				
				//we want meta array to be subarray because that is what used whants to get
				$meta_data = $sub_array;
			}
		}
		
		//return meta array
		return $meta_data;
	}
}

if ( ! function_exists( 'staffscout_mikado_get_attachment_id_from_url' ) ) {
	/**
	 * Function that retrieves attachment id for passed attachment url
	 *
	 * @param $attachment_url
	 *
	 * @return null|string
	 */
	function staffscout_mikado_get_attachment_id_from_url( $attachment_url ) {
		global $wpdb;
		$attachment_id = '';
		
		//is attachment url set?
		if ( $attachment_url !== '' ) {
			//prepare query

			$query = $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid=%s", $attachment_url );
			
			//get attachment id
			$attachment_id = $wpdb->get_var( $query );
		}
		
		//return id
		return $attachment_id;
	}
}

if ( ! function_exists( 'staffscout_mikado_get_attachment_meta_from_url' ) ) {
	/**
	 * Function that returns meta array for give attachment url
	 *
	 * @param $attachment_url
	 * @param array $keys sub array of attachment meta
	 *
	 * @return array|mixed
	 *
	 * @see staffscout_mikado_get_attachment_id_from_url()
	 * @see staffscout_mikado_get_attachment_meta()
	 *
	 * @version 0.1
	 */
	function staffscout_mikado_get_attachment_meta_from_url( $attachment_url, $keys = array() ) {
		$attachment_meta = array();
		
		//get attachment id for attachment url
		$attachment_id = staffscout_mikado_get_attachment_id_from_url( $attachment_url );
		
		//is attachment id set?
		if ( ! empty( $attachment_id ) ) {
			//get post meta
			$attachment_meta                  = staffscout_mikado_get_attachment_meta( $attachment_id, $keys );
			$attachment_meta['attachment_id'] = $attachment_id;
		}
		
		//return post meta
		return $attachment_meta;
	}
}

if ( ! function_exists( 'staffscout_mikado_get_image_dimensions' ) ) {
	/**
	 * Function that returns image sizes array. First looks in post_meta table if attachment exists in the database,
	 * if it does not than it uses getimagesize PHP function to get image sizes
	 *
	 * @param $url string url of the image
	 *
	 * @return array array of image sizes that contains height and width
	 *
	 * @see  staffscout_mikado_get_attachment_meta_from_url()
	 * @uses getimagesize
	 *
	 * @version 0.1
	 */
	function staffscout_mikado_get_image_dimensions( $url ) {
		$image_sizes = array();
		
		//is url passed?
		if ( $url !== '' ) {
			//get image sizes from posts meta if attachment exists
			$image_sizes = staffscout_mikado_get_attachment_meta_from_url( $url, array( 'width', 'height' ) );
			
			//image does not exists in post table, we have to use PHP way of getting image size
			if ( ! count( $image_sizes ) ) {
				//can we open file by url?
				if ( ini_get( 'allow_url_fopen' ) == 1 && file_exists( $url ) ) {
					list( $width, $height, $type, $attr ) = getimagesize( $url );
				} else {
					//we can't open file directly, have to locate it with relative path.
					$image_obj           = parse_url( $url );
					$image_relative_path = $_SERVER['DOCUMENT_ROOT'] . $image_obj['path'];
					
					if ( file_exists( $image_relative_path ) ) {
						list( $width, $height, $type, $attr ) = getimagesize( $image_relative_path );
					}
				}
				
				//did we get width and height from some of above methods?
				if ( isset( $width ) && isset( $height ) ) {
					//set them to our image sizes array
					$image_sizes = array(
						'width'  => $width,
						'height' => $height
					);
				}
			}
		}
		
		return $image_sizes;
	}
}

if ( ! function_exists( 'staffscout_mikado_get_native_fonts_list' ) ) {
	/**
	 * Function that returns array of native fonts
	 * @return array
	 */
	function staffscout_mikado_get_native_fonts_list() {
		
		return apply_filters( 'staffscout_mikado_get_native_fonts_list', array(
			'Arial',
			'Arial Black',
			'Comic Sans MS',
			'Courier New',
			'Georgia',
			'Impact',
			'Lucida Console',
			'Lucida Sans Unicode',
			'Palatino Linotype',
			'Tahoma',
			'Times New Roman',
			'Trebuchet MS',
			'Verdana'
		) );
	}
}

if ( ! function_exists( 'staffscout_mikado_get_native_fonts_array' ) ) {
	/**
	 * Function that returns formatted array of native fonts
	 *
	 * @uses staffscout_mikado_get_native_fonts_list()
	 * @return array
	 */
	function staffscout_mikado_get_native_fonts_array() {
		$native_fonts_list  = staffscout_mikado_get_native_fonts_list();
		$native_font_index  = 0;
		$native_fonts_array = array();
		
		foreach ( $native_fonts_list as $native_font ) {
			$native_fonts_array[ $native_font_index ] = array( 'family' => $native_font );
			$native_font_index ++;
		}
		
		return $native_fonts_array;
	}
}

if ( ! function_exists( 'staffscout_mikado_is_native_font' ) ) {
	/**
	 * Function that checks if given font is native font
	 *
	 * @param $font_family string
	 *
	 * @return bool
	 */
	function staffscout_mikado_is_native_font( $font_family ) {
		return in_array( str_replace( '+', ' ', $font_family ), staffscout_mikado_get_native_fonts_list() );
	}
}

if ( ! function_exists( 'staffscout_mikado_merge_fonts' ) ) {
	/**
	 * Function that merge google and native fonts
	 *
	 * @uses staffscout_mikado_get_native_fonts_array()
	 * @return array
	 */
	function staffscout_mikado_merge_fonts() {
		global $theme_name_php_global_fonts_array;
		
		if ( isset( $theme_name_php_global_fonts_array ) ) {
			$native_fonts = staffscout_mikado_get_native_fonts_array();
			
			if ( is_array( $native_fonts ) && count( $native_fonts ) ) {
				
				if ( staffscout_mikado_core_plugin_installed() ) {
					$theme_name_php_global_fonts_array = array_merge( $native_fonts, $theme_name_php_global_fonts_array );
				} else {
					$theme_name_php_global_fonts_array = $native_fonts;
				}
			}
		}
	}
	
	add_action( 'admin_init', 'staffscout_mikado_merge_fonts' );
}

if ( ! function_exists( 'staffscout_mikado_is_css_folder_writable' ) ) {
	/**
	 * Function that checks if css folder is writable
	 * @return bool
	 *
	 * @version 0.1
	 * @uses is_writable()
	 */
	function staffscout_mikado_is_css_folder_writable() {
		$css_dir = MIKADO_ASSETS_ROOT_DIR . '/css';
		
		return is_writable( $css_dir );
	}
}

if ( ! function_exists( 'staffscout_mikado_is_js_folder_writable' ) ) {
	/**
	 * Function that checks if js folder is writable
	 * @return bool
	 *
	 * @version 0.1
	 * @uses is_writable()
	 */
	function staffscout_mikado_is_js_folder_writable() {
		$js_dir = MIKADO_ASSETS_ROOT_DIR . '/js';
		
		return is_writable( $js_dir );
	}
}

if ( ! function_exists( 'staffscout_mikado_assets_folders_writable' ) ) {
	/**
	 * Function that if css and js folders are writable
	 * @return bool
	 *
	 * @version 0.1
	 * @see staffscout_mikado_is_css_folder_writable()
	 * @see staffscout_mikado_is_js_folder_writable()
	 */
	function staffscout_mikado_assets_folders_writable() {
		return staffscout_mikado_is_css_folder_writable() && staffscout_mikado_is_js_folder_writable();
	}
}

if ( ! function_exists( 'staffscout_mikado_writable_assets_folders_notice' ) ) {
	/**
	 * Function that prints notice that css and js folders aren't writable. Hooks to admin_notices action
	 *
	 * @version 0.1
	 * @link http://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
	 */
	function staffscout_mikado_writable_assets_folders_notice() {
		global $pagenow;
		
		$is_theme_options_page = isset( $_GET['page'] ) && strstr( $_GET['page'], 'staffscout_mikado_theme_menu' );
		
		if ( $pagenow === 'admin.php' && $is_theme_options_page ) {
			if ( ! staffscout_mikado_assets_folders_writable() ) { ?>
				<div class="error">
					<p><?php esc_html_e( 'Note that writing permissions aren\'t set for folders containing css and js files on your server.
					We recommend setting writing permissions in order to optimize your site performance.
					For further instructions, please refer to our documentation.', 'staffscout' ); ?></p>
				</div>
			<?php }
		}
	}
	
	add_action( 'admin_notices', 'staffscout_mikado_writable_assets_folders_notice' );
}

if ( ! function_exists( 'staffscout_mikado_inline_style' ) ) {
	/**
	 * Function that echoes generated style attribute
	 *
	 * @param $value string | array attribute value
	 *
	 * @see staffscout_mikado_get_inline_style()
	 */
	function staffscout_mikado_inline_style( $value ) {
		echo staffscout_mikado_get_inline_style( $value );
	}
}

if ( ! function_exists( 'staffscout_mikado_get_inline_style' ) ) {
	/**
	 * Function that generates style attribute and returns generated string
	 *
	 * @param $value string | array value of style attribute
	 *
	 * @return string generated style attribute
	 *
	 * @see staffscout_mikado_get_inline_style()
	 */
	function staffscout_mikado_get_inline_style( $value ) {
		return staffscout_mikado_get_inline_attr( $value, 'style', ';' );
	}
}

if ( ! function_exists( 'staffscout_mikado_class_attribute' ) ) {
	/**
	 * Function that echoes class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @see staffscout_mikado_get_class_attribute()
	 */
	function staffscout_mikado_class_attribute( $value ) {
		echo staffscout_mikado_get_class_attribute( $value );
	}
}

if ( ! function_exists( 'staffscout_mikado_get_class_attribute' ) ) {
	/**
	 * Function that returns generated class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @return string generated class attribute
	 *
	 * @see staffscout_mikado_get_inline_attr()
	 */
	function staffscout_mikado_get_class_attribute( $value ) {
		return staffscout_mikado_get_inline_attr( $value, 'class', ' ' );
	}
}

if ( ! function_exists( 'staffscout_mikado_get_inline_attr' ) ) {
	/**
	 * Function that generates html attribute
	 *
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 * @param $allow_zero_values boolean allow data to have zero value
	 *
	 * @return string generated html attribute
	 */
	function staffscout_mikado_get_inline_attr( $value, $attr, $glue = '', $allow_zero_values = false ) {
		if ( $allow_zero_values ) {
			if ( $value !== '' ) {
				
				if ( is_array( $value ) && count( $value ) ) {
					$properties = implode( $glue, $value );
				} elseif ( $value !== '' ) {
					$properties = $value;
				}
				
				return $attr . '="' . esc_attr( $properties ) . '"';
			}
		} else {
			if ( ! empty( $value ) ) {
				
				if ( is_array( $value ) && count( $value ) ) {
					$properties = implode( $glue, $value );
				} elseif ( $value !== '' ) {
					$properties = $value;
				}
				
				return $attr . '="' . esc_attr( $properties ) . '"';
			}
		}
		
		return '';
	}
}

if ( ! function_exists( 'staffscout_mikado_inline_attr' ) ) {
	/**
	 * Function that generates html attribute
	 *
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 *
	 * @return string generated html attribute
	 */
	function staffscout_mikado_inline_attr( $value, $attr, $glue = '' ) {
		echo staffscout_mikado_get_inline_attr( $value, $attr, $glue );
	}
}

if ( ! function_exists( 'staffscout_mikado_get_inline_attrs' ) ) {
	/**
	 * Generate multiple inline attributes
	 *
	 * @param $attrs
	 *
	 * @return string
	 */
	function staffscout_mikado_get_inline_attrs( $attrs, $allow_zero_values = false ) {
		$output = '';
		
		if ( is_array( $attrs ) && count( $attrs ) ) {
			if ( $allow_zero_values ) {
				foreach ( $attrs as $attr => $value ) {
					$output .= ' ' . staffscout_mikado_get_inline_attr( $value, $attr, '', true );
				}
			} else {
				foreach ( $attrs as $attr => $value ) {
					$output .= ' ' . staffscout_mikado_get_inline_attr( $value, $attr );
				}
			}
		}
		
		$output = ltrim( $output );
		
		return $output;
	}
}

if ( ! function_exists( 'staffscout_mikado_get_skin_uri' ) ) {
	/**
	 * Returns current skin URI
	 * @return mixed
	 */
	function staffscout_mikado_get_skin_uri() {
		global $theme_name_php_global_Framework;
		
		$current_skin = $theme_name_php_global_Framework->getSkin();
		
		return $current_skin->getSkinURI();
	}
}

if ( ! function_exists( 'staffscout_mikado_core_plugin_message' ) ) {
	/**
	 * Function that prints a mesasge in the admin if user hides TGMPA plugin activation message
	 */
	function staffscout_mikado_core_plugin_message() {
		if ( get_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice', true ) && ! staffscout_mikado_core_plugin_installed() ) {
			echo apply_filters( 'staffscout_mikado_core_plugin_message', '<div class="update-nag">' . esc_html__( 'Installation of the "Mikado Core" plugin is essential for proper theme functioning. Please ', 'staffscout' ) . '<a href="' . esc_url( admin_url( 'themes.php?page=install-required-plugins' ) ) . '">' . esc_html__( 'install', 'staffscout' ) . '</a>' . esc_html__( ' this plugin and activate it', 'staffscout' ) . '</div>' );
		}
	}
	
	add_action( 'admin_notices', 'staffscout_mikado_core_plugin_message' );
}

if ( ! function_exists( 'staffscout_mikado_get_theme_info_item' ) ) {
	/**
	 * Returns desired info of the current theme
	 *
	 * @param $item string info item to get
	 *
	 * @return string
	 */
	function staffscout_mikado_get_theme_info_item( $item ) {
		if ( $item !== '' ) {
			$current_theme = wp_get_theme();
			
			if ( $current_theme->parent() ) {
				$current_theme = $current_theme->parent();
			}
			
			if ( $current_theme->exists() && $current_theme->get( $item ) != "" ) {
				return $current_theme->get( $item );
			}
		}
		
		return '';
	}
}

if ( ! function_exists( 'staffscout_mikado_resize_image' ) ) {
	/**
	 * Function that generates custom thumbnail for given attachment
	 *
	 * @param null $attach_id id of attachment
	 * @param null $attach_url URL of attachment
	 * @param int $width desired height of custom thumbnail
	 * @param int $height desired width of custom thumbnail
	 * @param bool $crop whether to crop image or not
	 *
	 * @return array returns array containing img_url, width and height
	 *
	 * @see staffscout_mikado_get_attachment_id_from_url()
	 * @see get_attached_file()
	 * @see wp_get_attachment_url()
	 * @see wp_get_image_editor()
	 */
	function staffscout_mikado_resize_image( $attach_id = null, $attach_url = null, $width = null, $height = null, $crop = true ) {
		$return_array = array();
		
		//is attachment id empty?
		if ( empty( $attach_id ) && $attach_url !== '' ) {
			//get attachment id from url
			$attach_id = staffscout_mikado_get_attachment_id_from_url( $attach_url );
		}
		
		if ( ! empty( $attach_id ) && ( isset( $width ) && isset( $height ) ) ) {
			
			//get file path of the attachment
			$img_path = get_attached_file( $attach_id );
			
			//get attachment url
			$img_url = wp_get_attachment_url( $attach_id );
			
			//break down img path to array so we can use it's components in building thumbnail path
			$img_path_array = pathinfo( $img_path );
			
			//build thumbnail path
			$new_img_path = $img_path_array['dirname'] . '/' . $img_path_array['filename'] . '-' . $width . 'x' . $height . '.' . $img_path_array['extension'];
			
			//build thumbnail url
			$new_img_url = str_replace( $img_path_array['filename'], $img_path_array['filename'] . '-' . $width . 'x' . $height, $img_url );
			
			//check if thumbnail exists by it's path
			if ( ! file_exists( $new_img_path ) ) {
				//get image manipulation object
				$image_object = wp_get_image_editor( $img_path );
				
				if ( ! is_wp_error( $image_object ) ) {
					//resize image and save it new to path
					$image_object->resize( $width, $height, $crop );
					$image_object->save( $new_img_path );
					
					//get sizes of newly created thumbnail.
					///we don't use $width and $height because those might differ from end result based on $crop parameter
					$image_sizes = $image_object->get_size();
					
					$width  = $image_sizes['width'];
					$height = $image_sizes['height'];
				}
			}
			
			//generate data to be returned
			$return_array = array(
				'img_url'    => $new_img_url,
				'img_width'  => $width,
				'img_height' => $height
			);
		} //attachment wasn't found, probably because it comes from external source
		elseif ( $attach_url !== '' && ( isset( $width ) && isset( $height ) ) ) {
			//generate data to be returned
			$return_array = array(
				'img_url'    => $attach_url,
				'img_width'  => $width,
				'img_height' => $height
			);
		}
		
		return $return_array;
	}
}

if ( ! function_exists( 'staffscout_mikado_generate_thumbnail' ) ) {
	/**
	 * Generates thumbnail img tag. It calls staffscout_mikado_resize_image function which resizes img on the fly
	 *
	 * @param null $attach_id attachment id
	 * @param null $attach_url attachment URL
	 * @param  int $width width of thumbnail
	 * @param int $height height of thumbnail
	 * @param bool $crop whether to crop thumbnail or not
	 *
	 * @return string generated img tag
	 *
	 * @see staffscout_mikado_resize_image()
	 * @see staffscout_mikado_get_attachment_id_from_url()
	 */
	function staffscout_mikado_generate_thumbnail( $attach_id = null, $attach_url = null, $width = null, $height = null, $crop = true ) {
		//is attachment id empty?
		if ( empty( $attach_id ) ) {
			//get attachment id from attachment url
			$attach_id = staffscout_mikado_get_attachment_id_from_url( $attach_url );
		}
		
		if ( ! empty( $attach_id ) || ! empty( $attach_url ) ) {
			$img_info = staffscout_mikado_resize_image( $attach_id, $attach_url, $width, $height, $crop );
			$img_alt  = ! empty( $attach_id ) ? get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) : '';
			
			if ( is_array( $img_info ) && count( $img_info ) ) {
				return '<img src="' . $img_info['img_url'] . '" alt="' . $img_alt . '" width="' . $img_info['img_width'] . '" height="' . $img_info['img_height'] . '" />';
			}
		}
		
		return '';
	}
}

if ( ! function_exists( 'staffscout_mikado_get_template_part' ) ) {
	/**
	 * Loads template part with parameters. If file with slug parameter added exists it will load that file, else it will load file without slug added.
	 * Child theme friendly function
	 *
	 * @param string $template name of the template to load without extension
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 * @param boolean $plugin if template path should be overridden with plugin module
	 */
	function staffscout_mikado_get_template_part( $template, $slug = '', $params = array(), $plugin = false ) {
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$templates = array();
		
		if ( $template !== '' ) {
			if ( $slug !== '' ) {
				$templates[] = "{$template}-{$slug}.php";
			}
			
			$templates[] = $template . '.php';
		}
		
		$located = staffscout_mikado_find_template_path( $templates, $plugin );
		
		if ( $located ) {
			include( $located );
		}
	}
}

if ( ! function_exists( 'staffscout_mikado_get_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $module name of the module folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 * @param boolean $plugin if template path should be overridden with plugin module
	 *
	 * @see staffscout_mikado_get_template_part()
	 */
	function staffscout_mikado_get_module_template_part( $template, $module, $slug = '', $params = array(), $plugin = false ) {
		$root          = $plugin ? apply_filters( 'staffscout_mikado_edit_module_template_path', $root = 'framework/modules/' ) : 'framework/modules/';
		$template_path = $root . $module;
		
		staffscout_mikado_get_template_part( $template_path . '/' . $template, $slug, $params, $plugin );
	}
}

if ( ! function_exists( '
' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $module name of the module folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 * @see staffscout_mikado_get_template_part()
	 */
	function staffscout_mikado_get_shortcode_module_template_part( $template, $module, $slug = '', $params = array() ) {
		
		//HTML Content from template
		$html          = '';
		$template_path = 'framework/modules/shortcodes/' . $module;
		
		$temp = $template_path . '/' . $template;
		
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$templates = array();
		
		if ( $temp !== '' ) {
			if ( $slug !== '' ) {
				$templates[] = "{$temp}-{$slug}.php";
			}
			
			$templates[] = $temp . '.php';
		}
		$located = staffscout_mikado_find_template_path( $templates );
		if ( $located ) {
			ob_start();
			include( $located );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if ( ! function_exists( 'staffscout_mikado_get_blog_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $module name of the module folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 * @see staffscout_mikado_get_template_part()
	 */
	function staffscout_mikado_get_blog_module_template_part( $module, $slug = '', $params = array() ) {
		
		//HTML Content from template
		$html          = '';
		$template_path = 'framework/modules/blog/' . $module;
		
		$temp = $template_path;
		
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$templates = array();
		
		if ( $temp !== '' ) {
			if ( $slug !== '' ) {
				$templates[] = "{$temp}-{$slug}.php";
			}
			$templates[] = $temp . '.php';
		}
		
		$located = staffscout_mikado_find_template_path( $templates );
		
		if ( $located ) {
			ob_start();
			include( $located );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if ( ! function_exists( 'staffscout_mikado_find_template_path' ) ) {
	/**
	 * Find template path and return it
	 *
	 * @param $template_names
	 * @param $plugin
	 *
	 * @return string
	 */
	function staffscout_mikado_find_template_path( $template_names, $plugin = false ) {
		$located = '';
		foreach ( (array) $template_names as $template_name ) {
			if ( ! $template_name ) {
				continue;
			}
			if ( file_exists( get_stylesheet_directory() . '/' . $template_name ) ) {
				$located = get_stylesheet_directory() . '/' . $template_name;
				break;
			} elseif ( file_exists( get_template_directory() . '/' . $template_name ) ) {
				$located = get_template_directory() . '/' . $template_name;
				break;
			} elseif ( $plugin && file_exists( $template_name ) ) {
				$located = $template_name;
				break;
			}
		}
		
		return $located;
	}
}

if ( ! function_exists( 'staffscout_mikado_filter_suffix' ) ) {
	/**
	 * Removes suffix from given value. Useful when you have to remove parts of user input, e.g px at the end of string
	 *
	 * @param $value
	 * @param $suffix
	 *
	 * @return string
	 */
	function staffscout_mikado_filter_suffix( $value, $suffix ) {
		if ( $value !== '' && staffscout_mikado_string_ends_with( $value, $suffix ) ) {
			$value = substr( $value, 0, strpos( $value, $suffix ) );
		}
		
		return $value;
	}
}

if ( ! function_exists( 'staffscout_mikado_filter_px' ) ) {
	/**
	 * Removes px in provided value if value ends with px
	 *
	 * @param $value
	 *
	 * @return string
	 *
	 * @see staffscout_mikado_filter_suffix
	 */
	function staffscout_mikado_filter_px( $value ) {
		return staffscout_mikado_filter_suffix( $value, 'px' );
	}
}

if ( ! function_exists( 'staffscout_mikado_string_ends_with' ) ) {
	/**
	 * Checks if $haystack ends with $needle and returns proper bool value
	 *
	 * @param $haystack string to check
	 * @param $needle string with which $haystack needs to end
	 *
	 * @return bool
	 */
	function staffscout_mikado_string_ends_with( $haystack, $needle ) {
		if ( $haystack !== '' && $needle !== '' ) {
			return ( substr( $haystack, - strlen( $needle ), strlen( $needle ) ) == $needle );
		}
		
		return true;
	}
}

if ( ! function_exists( 'staffscout_mikado_dynamic_css' ) ) {
	/**
	 * Generates css based on selector and rules that are provided
	 *
	 * @param array|string $selector selector for which to generate styles
	 * @param array $rules associative array of rules.
	 *
	 * Example of usage: if you want to generate this css:
	 *      header { width: 100%; }
	 * function call should look like this: staffscout_mikado_dynamic_css('header', array('width' => '100%'));
	 *
	 * @return string
	 */
	function staffscout_mikado_dynamic_css( $selector, $rules ) {
		$output = '';
		//check if selector and rules are valid data
		if ( ! empty( $selector ) && ( is_array( $rules ) && count( $rules ) ) ) {
			if ( MIKADO_THEME_ENV == 'dev' ) {
				$calling_function = debug_backtrace();
				
				if ( isset( $calling_function[0]['file'] ) && isset( $calling_function[1]['function'] ) ) {
					$output .= '/* generated in ' . $calling_function[0]['file'] . ' ' . $calling_function[1]['function'] . ' function */' . "\n";
				}
			}
			
			if ( is_array( $selector ) && count( $selector ) ) {
				$output .= implode( ', ', $selector );
			} else {
				$output .= $selector;
			}
			
			$output .= ' { ';
			foreach ( $rules as $prop => $value ) {
				if ( $prop !== '' ) {
					$output .= $prop . ': ' . esc_attr( $value ) . ';';
				}
			}
			
			$output .= '}' . "\n\n";
		}
		
		return $output;
	}
}

if ( ! function_exists( 'staffscout_mikado_get_formatted_font_family' ) ) {
	/**
	 * Returns formatted font family name for css usage
	 *
	 * @param $value
	 *
	 * @return mixed
	 */
	function staffscout_mikado_get_formatted_font_family( $value ) {
		return str_replace( '+', ' ', $value );
	}
}

if ( ! function_exists( 'staffscout_mikado_active_widget' ) ) {
	/**
	 * Whether widget is displayed on the front-end.
	 */
	function staffscout_mikado_active_widget( $callback = false, $widget_id = false, $id_base = false, $skip_inactive = true ) {
		global $wp_registered_widgets;
		
		$sidebars_widgets = wp_get_sidebars_widgets();
		$sidebars_array   = array();
		
		if ( is_array( $sidebars_widgets ) ) {
			foreach ( $sidebars_widgets as $sidebar => $widgets ) {
				if ( $skip_inactive && ( 'wp_inactive_widgets' === $sidebar || 'orphaned_widgets' === substr( $sidebar, 0, 16 ) ) ) {
					continue;
				}
				if ( is_array( $widgets ) ) {
					foreach ( $widgets as $widget ) {
						if ( ( $callback && isset( $wp_registered_widgets[ $widget ]['callback'] ) && $wp_registered_widgets[ $widget ]['callback'] == $callback ) || ( $id_base && _get_widget_id_base( $widget ) == $id_base ) ) {
							if ( ! $widget_id || $widget_id == $wp_registered_widgets[ $widget ]['id'] ) {
								$sidebars_array[] = $sidebar;
							}
						}
					}
				}
			}
			
			return $sidebars_array;
		}
		
		return false;
	}
}

if ( ! function_exists( 'staffscout_mikado_execute_shortcode' ) ) {
	/**
	 * @param $shortcode_tag - shortcode base
	 * @param $atts - shortcode attributes
	 * @param null $content - shortcode content
	 *
	 * @return mixed|string
	 */
	function staffscout_mikado_execute_shortcode( $shortcode_tag, $atts, $content = null ) {
		global $shortcode_tags;
		
		if ( ! isset( $shortcode_tags[ $shortcode_tag ] ) ) {
			return;
		}
		
		if ( is_array( $shortcode_tags[ $shortcode_tag ] ) ) {
			$shortcode_array = $shortcode_tags[ $shortcode_tag ];
			
			return call_user_func( array(
				$shortcode_array[0],
				$shortcode_array[1]
			), $atts, $content, $shortcode_tag );
		}
		
		return call_user_func( $shortcode_tags[ $shortcode_tag ], $atts, $content, $shortcode_tag );
	}
}

if ( ! function_exists( 'staffscout_mikado_is_page_smooth_scroll_enabled' ) ) {
	/**
	 * Function that check is page smooth scroll is enabled
	 */
	function staffscout_mikado_is_page_smooth_scroll_enabled() {
		$mac_os = strpos( $_SERVER['HTTP_USER_AGENT'], 'Macintosh; Intel Mac OS X' );
		
		$is_enabled = false;
		
		//is smooth scroll enabled enabled and not Mac device?
		if ( staffscout_mikado_options()->getOptionValue( 'page_smooth_scroll' ) == 'yes' && $mac_os == false ) {
			$is_enabled = true;
		}
		
		return $is_enabled;
	}
}

if ( ! function_exists( 'staffscout_mikado_show_comments' ) ) {
	/**
	 * Functions which check are comments enabled on page
	 *
	 * @return boolean
	 */
	function staffscout_mikado_show_comments() {
		$comments = false;
		$id       = staffscout_mikado_get_page_id();
		
		$page_comments_meta = get_post_meta( $id, 'mkdf_page_comments_meta', true );
		
		if ( ! empty( $page_comments_meta ) ) {
			$comments = $page_comments_meta == 'no' ? false : true;
		} else {
			if ( is_page() && staffscout_mikado_options()->getOptionValue( 'page_show_comments' ) == 'yes' ) {
				$comments = true;
			} elseif ( is_singular( 'post' ) && staffscout_mikado_options()->getOptionValue( 'blog_single_comments' ) == 'yes' ) {
				$comments = true;
			} else {
				$comments = apply_filters( 'staffscout_mikado_post_type_comments', $comments );
			}
		}
		
		return $comments;
	}
}

if ( ! function_exists( 'staffscout_mikado_page_comments' ) ) {
	/**
	 * Functions which show comments on page
	 *
	 * @return boolean
	 */
	function staffscout_mikado_page_comments() {
		$comments = staffscout_mikado_show_comments();
		
		if ( $comments ) {
			comments_template( '', true );
		}
	}
	
	add_action( 'staffscout_mikado_page_after_content', 'staffscout_mikado_page_comments' );
}

if ( ! function_exists( 'staffscout_mikado_page_show_pagination' ) ) {
	/**
	 * Functions which show pagination on pages
	 *
	 * @return boolean
	 */
	function staffscout_mikado_page_show_pagination() {
		$args_pages = array(
			'before'   => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages">',
			'after'    => '</div></div>',
			'pagelink' => '<span>%</span>'
		);
		
		wp_link_pages( $args_pages );
	}
	
	add_action( 'staffscout_mikado_page_after_content', 'staffscout_mikado_page_show_pagination' );
}

if ( ! function_exists( 'staffscout_mikado_icon_collections' ) ) {
	/**
	 * Returns instance of StaffScoutMikadoClassIconCollections class
	 *
	 * @return StaffScoutMikadoClassIconCollections
	 */
	function staffscout_mikado_icon_collections() {
		return StaffScoutMikadoClassIconCollections::get_instance();
	}
}

if ( ! function_exists( 'staffscout_mikado_get_meta_field_intersect' ) ) {
	/**
	 * @param $name
	 * @param $post_id
	 *
	 * @return bool|mixed|void
	 */
	function staffscout_mikado_get_meta_field_intersect( $name, $post_id = '' ) {
		$post_id = ! empty( $post_id ) ? $post_id : get_the_ID();
		
		if ( staffscout_mikado_is_woocommerce_installed() && staffscout_mikado_is_woocommerce_shop() ) {
			$post_id = staffscout_mikado_get_woo_shop_page_id();
		}
		
		$value = staffscout_mikado_options()->getOptionValue( $name );
		
		if ( $post_id !== - 1 ) {
			$meta_field = get_post_meta( $post_id, 'mkdf_' . $name . '_meta', true );
			if ( $meta_field !== '' && $meta_field !== false ) {
				$value = $meta_field;
			}
		}
		
		$value = apply_filters( 'staffscout_mikado_meta_field_intersect_' . $name, $value );
		
		return $value;
	}
}

if ( ! function_exists( 'staffscout_mikado_get_typography_styles' ) ) {
	/**
	 * Generates typography styles for global options
	 *
	 * @param $prefix - unique name of global option
	 * @param $suffix - additional name of global option
	 *
	 * @return array
	 */
	function staffscout_mikado_get_typography_styles( $prefix = '', $suffix = '' ) {
		$color          = staffscout_mikado_options()->getOptionValue( $prefix . '_color' . $suffix );
		$font_family    = staffscout_mikado_options()->getOptionValue( $prefix . '_google_fonts' . $suffix );
		$font_size      = staffscout_mikado_options()->getOptionValue( $prefix . '_font_size' . $suffix );
		$line_height    = staffscout_mikado_options()->getOptionValue( $prefix . '_line_height' . $suffix );
		$font_style     = staffscout_mikado_options()->getOptionValue( $prefix . '_font_style' . $suffix );
		$font_weight    = staffscout_mikado_options()->getOptionValue( $prefix . '_font_weight' . $suffix );
		$letter_spacing = staffscout_mikado_options()->getOptionValue( $prefix . '_letter_spacing' . $suffix );
		$text_transform = staffscout_mikado_options()->getOptionValue( $prefix . '_text_transform' . $suffix );
		
		$styles = array();
		
		if ( ! empty( $color ) ) {
			$styles['color'] = $color;
		}
		if ( isset( $font_family ) && $font_family !== false && $font_family !== '-1' && $font_family !== '' ) {
			$styles['font-family'] = staffscout_mikado_get_formatted_font_family( $font_family );
		}
		if ( ! empty( $font_size ) ) {
			if ( staffscout_mikado_string_ends_with( $font_size, 'px' ) || staffscout_mikado_string_ends_with( $font_size, 'em' ) ) {
				$styles['font-size'] = $font_size;
			} else {
				$styles['font-size'] = staffscout_mikado_filter_px( $font_size ) . 'px';
			}
		}
		if ( ! empty( $line_height ) ) {
			if ( staffscout_mikado_string_ends_with( $line_height, 'px' ) || staffscout_mikado_string_ends_with( $line_height, 'em' ) ) {
				$styles['line-height'] = $line_height;
			} else {
				$styles['line-height'] = staffscout_mikado_filter_px( $line_height ) . 'px';
			}
		}
		if ( ! empty( $font_style ) ) {
			$styles['font-style'] = $font_style;
		}
		if ( ! empty( $font_weight ) ) {
			$styles['font-weight'] = $font_weight;
		}
		if ( $letter_spacing !== '' ) {
			if ( staffscout_mikado_string_ends_with( $letter_spacing, 'px' ) || staffscout_mikado_string_ends_with( $letter_spacing, 'em' ) ) {
				$styles['letter-spacing'] = $letter_spacing;
			} else {
				$styles['letter-spacing'] = staffscout_mikado_filter_px( $letter_spacing ) . 'px';
			}
		}
		if ( ! empty( $text_transform ) ) {
			$styles['text-transform'] = $text_transform;
		}
		
		return $styles;
	}
}

if ( ! function_exists( 'staffscout_mikado_get_responsive_typography_styles' ) ) {
	/**
	 * Generates typography responsive styles for global options
	 *
	 * @param $prefix - unique name of global option
	 * @param $suffix - additional name of global option
	 *
	 * @return array
	 */
	function staffscout_mikado_get_responsive_typography_styles( $prefix = '', $suffix = '' ) {
		$font_size      = staffscout_mikado_options()->getOptionValue( $prefix . '_font_size' . $suffix );
		$line_height    = staffscout_mikado_options()->getOptionValue( $prefix . '_line_height' . $suffix );
		$letter_spacing = staffscout_mikado_options()->getOptionValue( $prefix . '_letter_spacing' . $suffix );
		
		$styles = array();
		
		if ( ! empty( $font_size ) ) {
			if ( staffscout_mikado_string_ends_with( $font_size, 'px' ) || staffscout_mikado_string_ends_with( $font_size, 'em' ) ) {
				$styles['font-size'] = $font_size;
			} else {
				$styles['font-size'] = staffscout_mikado_filter_px( $font_size ) . 'px';
			}
		}
		if ( ! empty( $line_height ) ) {
			if ( staffscout_mikado_string_ends_with( $line_height, 'px' ) || staffscout_mikado_string_ends_with( $line_height, 'em' ) ) {
				$styles['line-height'] = $line_height;
			} else {
				$styles['line-height'] = staffscout_mikado_filter_px( $line_height ) . 'px';
			}
		}
		if ( $letter_spacing !== '' ) {
			if ( staffscout_mikado_string_ends_with( $letter_spacing, 'px' ) || staffscout_mikado_string_ends_with( $letter_spacing, 'em' ) ) {
				$styles['letter-spacing'] = $letter_spacing;
			} else {
				$styles['letter-spacing'] = staffscout_mikado_filter_px( $letter_spacing ) . 'px';
			}
		}
		
		return $styles;
	}
}

if ( ! function_exists( 'staffscout_mikado_paged_home' ) ) {
	/**
	 * Set false to on paged url on homepage
	 *
	 * @return int
	 */
	function staffscout_mikado_paged_home() {
		global $wp_query;
		
		if ( is_page() && ! is_feed() && 'page' == get_option( 'show_on_front' ) && $wp_query->queried_object->ID == get_option( 'page_on_front' ) ) {
			$redirect_url = false;
			
			return $redirect_url;
		}
	}
	
	add_filter( 'redirect_canonical', 'staffscout_mikado_paged_home' );
}

if ( ! function_exists( 'staffscout_mikado_register_button' ) ) {
	/**
	 * Register button with shortcodes for WP editor
	 *
	 * @param $buttons
	 *
	 * @return mixed
	 */
	function staffscout_mikado_register_button( $buttons ) {
		array_push( $buttons, "|", "mkd_shortcodes" );
		
		return $buttons;
	}
}

if ( ! function_exists( 'staffscout_mikado_add_plugin' ) ) {
	function staffscout_mikado_add_plugin( $plugin_array ) {
		$plugin_array['mkd_shortcodes'] = MIKADO_FRAMEWORK_ROOT . '/admin/assets/js/mkdf-shortcodes.js';
		
		return $plugin_array;
	}
}

if ( ! function_exists( 'staffscout_mikado_shortcodes_button' ) ) {
	/**
	 * Register Mikado Shortcodes in WP Editor
	 */
	function staffscout_mikado_shortcodes_button() {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
			return;
		}
		
		if ( get_user_option( 'rich_editing' ) == 'true' ) {
			add_filter( 'mce_external_plugins', 'staffscout_mikado_add_plugin' );
			add_filter( 'mce_buttons', 'staffscout_mikado_register_button' );
		}
	}
	
	add_action( 'after_setup_theme', 'staffscout_mikado_shortcodes_button' );
}

/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function staffscout_mikado_get_image_sizes() {
	global $_wp_additional_image_sizes;
	
	$sizes = array();
	
	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array( 'medium', 'large' ) ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}
	
	return $sizes;
}

/**
 * Get size information for a specific image size.
 *
 * @uses   staffscout_mikado_get_image_size()
 *
 * @param  string $size The image size for which to retrieve data.
 *
 * @return bool|array $size Size data about an image size or false if the size doesn't exist.
 */
function staffscout_mikado_get_image_size( $size ) {
	$sizes = staffscout_mikado_get_image_sizes();
	
	if ( isset( $sizes[ $size ] ) ) {
		return $sizes[ $size ];
	}
	
	return false;
}

if ( ! function_exists( 'staffscout_mikado_option_get_uploaded_file_icon' ) ) {
	function staffscout_mikado_option_get_uploaded_file_icon( $value ) {
		$id = staffscout_mikado_get_attachment_id_from_url( $value );
		
		return wp_mime_type_icon( $id );
	}
}

if ( ! function_exists( 'staffscout_mikado_option_get_uploaded_file_title' ) ) {
	function staffscout_mikado_option_get_uploaded_file_title( $value ) {
		$id = staffscout_mikado_get_attachment_id_from_url( $value );
		
		return get_the_title( $id );
	}
}