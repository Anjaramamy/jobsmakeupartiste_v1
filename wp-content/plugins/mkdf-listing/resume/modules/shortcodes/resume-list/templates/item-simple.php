<?php
$this_object = mkdf_listing_resume_list_class_instance();
$profile_image = get_post_meta(get_the_ID(), '_profile_image', true);
$resizedImage = staffscout_mikado_resize_image( null, $profile_image, 80, 80, true );
$candidate_title = get_post_meta(get_the_ID(), '_candidate_title', true);
$item_classes = !empty($profile_image) ? 'mkdf-rsi-has-profile-image' : '';
$imgID = !empty($profile_image) ? staffscout_mikado_get_attachment_id_from_url($profile_image) : '';
$imageAlt = !empty($imgID) ? get_post_meta( $imgID, '_wp_attachment_image_alt', true ) : esc_html__( 'Resume Profile Image', 'mkdf-listing' );
?>
<article class="mkdf-rs-item mkdf-item-space clearfix <?php echo esc_attr($item_classes); ?>">
    <div class="mkdf-rsi-inner">
        <?php if (!empty($profile_image)) { ?>
            <a href="<?php echo get_the_permalink(); ?>" class="mkdf-rls-img-holder">
                <?php if ( ! empty($resizedImage)) { ?>
                    <img src="<?php echo esc_url($resizedImage['img_url']); ?>" alt="<?php echo esc_attr($imageAlt); ?>" />
                <?php } else { ?>
                    <img src="<?php echo esc_url($profile_image); ?>" alt="<?php echo esc_attr($imageAlt); ?>" />
                <?php } ?>
            </a>
        <?php } ?>
        <div class="mkdf-rsi-content">
            <h5 class="mkdf-resume-title">
                <a href="<?php echo get_the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h5>
            <?php if (!empty($candidate_title)) { ?>
                <p><?php echo esc_html($candidate_title); ?></p>
            <?php } ?>
        </div>
    </div>
</article>

