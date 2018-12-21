<?php

if (staffscout_mikado_is_yith_wishlist_installed()) {
    add_action('woocommerce_before_shop_loop_item', 'staffscout_mikado_woocommerce_wishlist_shortcode', 3);
}