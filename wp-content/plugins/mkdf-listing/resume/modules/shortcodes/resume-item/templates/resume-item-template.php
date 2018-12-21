<?php
$this_object = mkdf_listing_resume_item_class_instance();
$id = $this_object->getBasicParamByKey('selected_projects');
$profile_image = get_post_meta($id, '_profile_image', true);
$candidate_title = get_post_meta($id, '_candidate_title', true);
$item_classes = !empty($profile_image) ? 'mkdf-rsi-has-profile-image' : '';
$imgID = !empty($profile_image) ? staffscout_mikado_get_attachment_id_from_url($profile_image) : '';
$image_src = wp_get_attachment_image_src($imgID, 'staffscout_mikado_image_landscape_medium');
$imageAlt = !empty($imgID) ? get_post_meta( $imgID, '_wp_attachment_image_alt', true ) : esc_html__( 'Resume Profile Image', 'mkdf-listing' );
?>
<article class="mkdf-resume-item mkdf-item-space clearfix <?php echo esc_attr($item_classes); ?>">
    <div class="mkdf-resume-item-inner">
        <?php if (!empty($profile_image)) { ?>
            <a href="<?php echo get_the_permalink($id); ?>" class="mkdf-resume-item-img-holder">
                <img src="<?php echo esc_url($image_src[0]); ?>" alt="<?php echo esc_attr($imageAlt); ?>" />
            </a>
        <?php } ?>
        <div class="mkdf-resume-item-content">
            <div class="mkdf-resume-item-content-inner">
            <h3 class="mkdf-resume-item-title">
                <a href="<?php echo get_the_permalink($id); ?>">
                    <?php echo get_the_title( $id ); ?>
                </a>
            </h3>
            <?php if (!empty($candidate_title)) { ?>
                <p><?php echo esc_html($candidate_title); ?></p>
            <?php } ?>
            </div>
        </div>
    </div>
</article>

