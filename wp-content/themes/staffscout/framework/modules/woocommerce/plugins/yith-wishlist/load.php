<?php

include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/yith-wishlist-functions.php';
include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/yith-wishlist-conf.php';

if(staffscout_mikado_is_yith_wishlist_installed()){
    include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/woocommerce/plugins/yith-wishlist/widgets/yith-wishlist.php';
}