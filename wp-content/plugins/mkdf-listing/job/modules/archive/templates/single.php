<?php
$this_object = mkdf_listing_job_list_class_instance();
$profile_image = get_post_meta(get_the_ID(), '_lists_image', true);
$resizedImage = staffscout_mikado_resize_image( null, $profile_image, 152, 44, true );
$imgID = !empty($profile_image) ? staffscout_mikado_get_attachment_id_from_url($profile_image) : '';
$imageAlt = !empty($imgID) ? get_post_meta( $imgID, '_wp_attachment_image_alt', true ) : esc_html__( 'Company Logo', 'mkdf-listing' );
?>

<article class="mkdf-ls-item mkdf-item-space" id="<?php echo htmlspecialchars($title); ?>">

    <div class="mkdf-ls-item-holder">

        <?php if(has_post_thumbnail() && $img_style !== '') { ?>

            <div class="mkdf-ls-item-image" <?php echo staffscout_mikado_get_inline_style($img_style); ?>>

                <?php if ( ! empty($resizedImage)) { ?>
                    <a href="<?php echo get_the_permalink(); ?>" class="mkdf-ls-item-author-image">
                        <img src="<?php echo esc_url($resizedImage['img_url']); ?>" alt="<?php echo esc_attr($imageAlt); ?>" />
                    </a>
                <?php } ?>

                <a href="<?php echo get_the_permalink(); ?>" class="mkdf-ls-item-image-link"></a>

            </div>

        <?php }?>

        <div class="mkdf-ls-item-inner">

            <?php
            if($address_html !== ''){ ?>

                <div class="mkdf-ls-item-location">
                    <?php print $address_html; ?>
                </div>

            <?php } ?>

            <div class="mkdf-ls-item-title">
                <h4 class="mkdf-listing-title">
                    <a href="<?php echo get_the_permalink(); ?>">
                        <?php echo get_the_title(); ?>
                    </a>
                </h4>
            </div>

            <?php

            if($excerpt !== ''){ ?>

                <p class="mkdf-ls-item-excerpt">
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

                <div class="mkdf-ls-item-type">
                    <?php print $type_html; ?>
                </div>

            <?php } ?>

        </div>

    </div>

</article>