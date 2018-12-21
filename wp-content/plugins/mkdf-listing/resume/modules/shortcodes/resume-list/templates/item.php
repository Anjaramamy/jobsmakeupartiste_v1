<?php
$this_object = mkdf_listing_resume_list_class_instance();
$id = get_the_ID();
$profile_image = get_post_meta($id, '_profile_image', true);
$candidate_title = get_post_meta($id, '_candidate_title', true);
$imgID = !empty($profile_image) ? staffscout_mikado_get_attachment_id_from_url($profile_image) : '';
$image_src = wp_get_attachment_image_src($imgID, 'staffscout_mikado_image_landscape_medium');
$imageAlt = !empty($imgID) ? get_post_meta( $imgID, '_wp_attachment_image_alt', true ) : esc_html__( 'Resume Profile Image', 'mkdf-listing' );
?>
<article class="mkdf-rs-item mkdf-item-space clearfix">

    <div class="mkdf-rs-item-holder">

        <?php if (!empty($profile_image)) { ?>
            <a href="<?php echo get_the_permalink(); ?>" class="mkdf-resume-item-img-holder">
                <img src="<?php echo esc_url($image_src[0]); ?>" alt="<?php echo esc_attr($imageAlt); ?>" />
            </a>
        <?php } ?>

        <div class="mkdf-rs-item-inner">
            <div class="mkdf-rs-item-title">
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
    </div>

</article>