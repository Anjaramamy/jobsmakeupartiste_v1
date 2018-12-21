<?php

if(!function_exists('staffscout_mikado_is_yith_wishlist_installed')) {
    function staffscout_mikado_is_yith_wishlist_installed() {
        return defined('YITH_WCWL');
    }
}

if(!function_exists('staffscout_mikado_woocommerce_wishlist_shortcode')) {
    function staffscout_mikado_woocommerce_wishlist_shortcode() {

        if(staffscout_mikado_is_yith_wishlist_installed()) {
            echo do_shortcode('[yith_wcwl_add_to_wishlist]');
        }
    }
}