<?php

$id = get_the_ID();
$image = get_post_meta($id, '_candidate_photo', true);
?>

<?php if(!empty($image)) { ?>

<div class="mkdf-rs-item-image">
    <img src="<?php echo esc_url($image); ?>" alt="<?php esc_html_e('Item Image', 'mkdf-listing'); ?>" />
</div>

<?php }