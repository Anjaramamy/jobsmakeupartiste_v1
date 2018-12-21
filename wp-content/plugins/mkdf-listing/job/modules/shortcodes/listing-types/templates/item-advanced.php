<article class="mkdf-ls-type-item mkdf-item-space">

    <div class="mkdf-ls-type-item-inner">

        <a href="<?php echo esc_attr($link); ?>" target="_self" itemprop="url"></a>

        <div class="mkdf-ls-content-holder">

            <?php if($show_type_number && $show_type_number == 'yes') { ?>
                <div class="mkdf-ls-count-main">
                    <?php echo esc_html($count); ?>
                </div>
            <?php } ?>

            <?php if($show_type_title && $show_type_title == 'yes') { ?>
            <div class="mkdf-ls-title-holder">
                <<?php echo esc_attr($title_tag); ?> class="mkdf-ls-type-title">
                    <?php echo esc_html($name); ?>
                </<?php echo esc_attr($title_tag); ?>>
            </div>
            <?php } ?>

            <?php if($show_type_number && $show_type_number == 'yes') { ?>
                <div class="mkdf-ls-count-sub">
                    <span class="sub-count-text"><?php printf( _n( '%s open position', '%s open positions', $count, 'mkdf-listing' ), number_format_i18n( $count ) ); ?></span>
                </div>
            <?php } ?>

            <?php if($show_type_desc && $show_type_desc == 'yes') { ?>
            <div class="mkdf-ls-desc-holder">
                <?php print $desc; ?>
            </div>
            <?php } ?>
        </div>

    </div>

</article>