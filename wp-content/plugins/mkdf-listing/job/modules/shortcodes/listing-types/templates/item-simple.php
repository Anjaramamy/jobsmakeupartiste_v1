<article class="mkdf-ls-type-item mkdf-item-space">

    <div class="mkdf-ls-type-item-inner">

        <div class="mkdf-ls-content-holder">
            <div class="mkdf-ls-content-left">
                <?php if ($custom_icon !== '') {?>
                    <div class="mkdf-ls-custom-icon-holder" <?php echo staffscout_mikado_get_inline_style($custom_icon); ?>></div>
                <?php } else { ?>

                    <div class="mkdf-ls-icon-holder">
                        <?php print $icon; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="mkdf-ls-content-right">
                <div class="mkdf-ls-type-title-holder">
                    <a href="<?php echo esc_attr($link); ?>" target="_self" itemprop="url" >
                        <h6 class="mkdf-ls-type-title">
                            <?php echo esc_html($name); ?>
                        </h6>
                    </a>
                </div>
                <div class="mkdf-ls-count-holder">
                    <?php echo esc_html($count); ?>
                </div>
            </div>
        </div>

    </div>

</article>