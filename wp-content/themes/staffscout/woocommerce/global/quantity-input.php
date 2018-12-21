<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ($max_value && $min_value === $max_value) {
    ?>
    <div class="mkdf-quantity-buttons quantity hidden">
        <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr($input_name); ?>"
               value="<?php echo esc_attr($min_value); ?>"/>
    </div>
    <?php
} else {
    ?>
    <div class="mkdf-quantity-buttons quantity">
        <label class="mkdf-quantity-label" for="<?php echo esc_attr( $input_id ); ?>"><?php esc_html_e( 'Quantity', 'staffscout' ); ?></label>
        <span class="mkdf-quantity-minus dripicons-chevron-left"></span>
        <input type="text" id="<?php echo esc_attr( $input_id ); ?>" class="input-text qty text mkdf-quantity-input"
               data-step="<?php echo esc_attr($step); ?>"
               data-min="<?php echo esc_attr($min_value); ?>"
               data-max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>"
               name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($input_value); ?>"
               title="<?php echo esc_attr_x('Qty', 'Product quantity input tooltip', 'staffscout') ?>" size="4"
               pattern="<?php echo esc_attr($pattern); ?>" inputmode="<?php echo esc_attr($inputmode); ?>"/>
        <span class="mkdf-quantity-plus icon dripicons-chevron-right"></span>
    </div>
    <?php
}