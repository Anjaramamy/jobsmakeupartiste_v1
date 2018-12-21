<?php

$featured_image = '';

$id = get_the_ID();
$image = get_post_meta($id, '_candidate_photo', true);

if(!empty($image)) {
    $featured_image = 'featured-image';
}

?>

<article class="mkdf-rs-single-item <?php echo esc_attr($featured_image); ?>" id="<?php echo get_the_ID();?>">
	<?php
        echo mkdf_listing_resume_single_template_part('sections/header-top', '', $params);
        echo mkdf_listing_resume_single_template_part('sections/content', '', $params);
	?>
</article>
