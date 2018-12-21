<?php

//define constants
define( 'MIKADO_ROOT', get_template_directory_uri() );
define( 'MIKADO_ROOT_DIR', get_template_directory() );
define( 'MIKADO_ASSETS_ROOT', get_template_directory_uri() . '/assets' );
define( 'MIKADO_ASSETS_ROOT_DIR', get_template_directory() . '/assets' );
define( 'MIKADO_FRAMEWORK_ROOT', get_template_directory_uri() . '/framework' );
define( 'MIKADO_FRAMEWORK_ROOT_DIR', get_template_directory() . '/framework' );
define( 'MIKADO_FRAMEWORK_ADMIN_ASSETS_ROOT', get_template_directory_uri() . '/framework/admin/assets' );
define( 'MIKADO_FRAMEWORK_MODULES_ROOT', get_template_directory_uri() . '/framework/modules' );
define( 'MIKADO_FRAMEWORK_MODULES_ROOT_DIR', get_template_directory() . '/framework/modules' );
define( 'MIKADO_FRAMEWORK_HEADER_ROOT', get_template_directory_uri() . '/framework/modules/header' );
define( 'MIKADO_FRAMEWORK_HEADER_ROOT_DIR', get_template_directory() . '/framework/modules/header' );
define( 'MIKADO_FRAMEWORK_HEADER_TYPES_ROOT', get_template_directory_uri() . '/framework/modules/header/types' );
define( 'MIKADO_FRAMEWORK_HEADER_TYPES_ROOT_DIR', get_template_directory() . '/framework/modules/header/types' );
define( 'MIKADO_THEME_ENV', 'dev' );

//include necessary files
include_once MIKADO_ROOT_DIR . '/framework/mkdf-framework.php';
include_once MIKADO_ROOT_DIR . '/includes/nav-menu/mkdf-menu.php';
require_once MIKADO_ROOT_DIR . '/includes/plugins/class-tgm-plugin-activation.php';
include_once MIKADO_ROOT_DIR . '/includes/plugins/plugins-activation.php';
include_once MIKADO_ROOT_DIR . '/assets/custom-styles/general-custom-styles.php';
include_once MIKADO_ROOT_DIR . '/assets/custom-styles/general-custom-styles-responsive.php';

if ( ! is_admin() ) {
	include_once MIKADO_ROOT_DIR . '/includes/mkdf-body-class-functions.php';
	include_once MIKADO_ROOT_DIR . '/includes/mkdf-loading-spinners.php';
}