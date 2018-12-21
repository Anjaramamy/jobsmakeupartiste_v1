<?php

$item_author = get_the_author();
$item_link = get_author_posts_url( get_the_author_meta( 'ID' ));

$id = get_the_ID();
$image = get_post_meta($id, '_profile_image', true);
$resizedImage = staffscout_mikado_resize_image( null, $image, 120, 120, true );
?>

<div class="mkdf-rs-item-image">
    <a href="<?php echo esc_attr($item_link); ?>">
        <?php if ( ! empty($resizedImage)) { ?>
            <img src="<?php echo esc_url($resizedImage['img_url']); ?>" alt="<?php esc_html_e('Item Author', 'mkdf-listing'); ?>" />
        <?php } else { ?>
            <img src="<?php echo esc_url($image); ?>" alt="<?php esc_html_e('Item Author', 'mkdf-listing'); ?>" />
        <?php } ?>
    </a>
</div>

<div class="mkdf-rs-item-author">
<?php

if(!empty($item_author)) {
    echo wp_kses_post($item_author);
}

?>
</div>

