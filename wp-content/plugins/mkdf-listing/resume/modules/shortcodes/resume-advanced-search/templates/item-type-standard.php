<?php
$this_object = mkdf_listing_resume_adv_search_class_instance();

$item_link = get_the_permalink();
$item_title = get_the_title();
$item_author = get_the_author()
?>
<article class="mkdf-rs-item mkdf-item-space mkdf-rs-item-type-standard clearfix">

    <div class="mkdf-rs-item-holder">

        <?php if($img_style !== '') { ?>

            <div class="mkdf-rs-item-image" <?php echo staffscout_mikado_get_inline_style($img_style); ?>>

                <a href="<?php echo esc_attr($item_link); ?>" class="mkdf-rs-item-author-image">
                    <?php echo get_avatar(get_the_author_meta('ID'), 120); ?>
                </a>

            </div>

        <?php }?>

        <div class="mkdf-rs-item-inner">

            <?php
            if($address_html !== ''){ ?>

                <div class="mkdf-rs-item-location">
                    <?php print $address_html; ?>
                </div>

            <?php } ?>

            <div class="mkdf-rs-item-title">
                <h4 class="mkdf-resume-title">
                    <a href="<?php echo get_the_permalink(); ?>">
                        <?php echo get_the_title(); ?>
                    </a>
                </h4>
            </div>

            <?php

            if($excerpt !== ''){ ?>

                <p class="mkdf-rs-item-excerpt">
                    <?php
                    /**
                     * we used regex instead of default
                     * strip_shortcodes() function because
                     * it was not working in ajax call from advance search
                     */
                    print preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '',$excerpt);
                    ?>
                </p>

            <?php } ?>

            <?php

            if($type_html !== ''){ ?>

                <div class="mkdf-rs-item-type">
                    <?php print $type_html; ?>
                </div>

            <?php } ?>

        </div>

    </div>

</article>