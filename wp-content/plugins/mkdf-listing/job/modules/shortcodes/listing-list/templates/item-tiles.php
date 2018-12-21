<?php
$this_object = mkdf_listing_job_list_class_instance();
$profile_image = get_post_meta(get_the_ID(), '_lists_image', true);
$resizedImage = staffscout_mikado_resize_image( null, $profile_image, 152, 44, true );
$imgID = !empty($profile_image) ? staffscout_mikado_get_attachment_id_from_url($profile_image) : '';
$imageAlt = !empty($imgID) ? get_post_meta( $imgID, '_wp_attachment_image_alt', true ) : esc_html__( 'Company Logo', 'mkdf-listing' );
?>
<article class="mkdf-ls-item mkdf-item-space clearfix">

    <div class="mkdf-ls-item-holder">

        <?php if(has_post_thumbnail() && $img_style !== '') { ?>

            <div class="mkdf-ls-item-image">

                <a href="<?php echo get_the_permalink(); ?>" class="mkdf-ls-item-featured-image">
                    <?php echo get_the_post_thumbnail(get_the_ID(), 'staffscout_mikado_image_landscape_medium'); ?>
                </a>

                <?php if ( ! empty($resizedImage)) { ?>
                    <a href="<?php echo get_the_permalink(); ?>" class="mkdf-ls-item-author-image">
                        <img src="<?php echo esc_url($resizedImage['img_url']); ?>" alt="<?php echo esc_attr($imageAlt); ?>" />
                    </a>
                <?php } ?>

            </div>

        <?php }?>

    </div>

</article>