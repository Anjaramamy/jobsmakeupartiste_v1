<?php
$main_image = wp_get_attachment_image_src($main_image, 'full');
?>
<div class="mkdf-hiding-images">
    <div class="mkdf-hi-inner">
        <div class="mkdf-hi-other-images">
            <?php echo do_shortcode($content); ?>
        </div>
        <div class="mkdf-hi-main-image">
            <?php if(!empty($link)) : ?>
            <a class="mkdf-hiding-image-link" href="<?php echo esc_attr($link); ?>" <?php staffscout_mikado_get_inline_attr($target, 'target'); ?>></a>
            <div class="mkdf-hi-main-image-holder" style="background-image: url('<?php echo esc_url($main_image[0]); ?>')">
                <?php else: ?>
                <div class="mkdf-hi-main-image-holder" style="background-image: url('<?php echo esc_url($main_image[0]); ?>')">
                    <?php endif; ?>
                </div>
                <img class="mkdf-hi-laptop" src="<?php echo esc_url(MIKADO_CORE_URL_PATH); ?>assets/css/img/hidden-images-laptop-frame.png" alt="<?php esc_attr_e('laptop-frame','mkdf-core') ?>">
            </div>
        </div>
    </div>