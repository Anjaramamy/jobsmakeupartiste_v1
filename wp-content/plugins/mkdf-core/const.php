<?php

define('MIKADO_CORE_VERSION', '1.0');
define('MIKADO_CORE_ABS_PATH', dirname(__FILE__));
define('MIKADO_CORE_REL_PATH', dirname(plugin_basename(__FILE__ )));
define('MIKADO_CORE_URL_PATH', plugin_dir_url( __FILE__ ));
define('MIKADO_CORE_ASSETS_PATH', MIKADO_CORE_ABS_PATH.'/assets');
define('MIKADO_CORE_ASSETS_URL_PATH', MIKADO_CORE_URL_PATH.'assets');
define('MIKADO_CORE_CPT_PATH', MIKADO_CORE_ABS_PATH.'/post-types');
define('MIKADO_CORE_CPT_URL_PATH', MIKADO_CORE_URL_PATH.'post-types');
define('MIKADO_CORE_SHORTCODES_PATH', MIKADO_CORE_ABS_PATH.'/shortcodes');
define('MIKADO_CORE_SHORTCODES_URL_PATH', MIKADO_CORE_URL_PATH.'shortcodes');