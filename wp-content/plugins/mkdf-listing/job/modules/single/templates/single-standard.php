<?php

$featured_image = '';

if(has_post_thumbnail()) {
    $featured_image = 'featured-image';
}

?>

<article class="mkdf-ls-single-item <?php echo esc_attr($featured_image); ?>" id="<?php echo get_the_ID();?>">
	<?php
        echo mkdf_listing_job_single_template_part('sections/header-top', '', $params);
        echo mkdf_listing_job_single_template_part('sections/content', '', $params);
	?>
</article>
