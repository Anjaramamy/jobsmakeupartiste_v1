<?php
$is_link = isset($link) && $link != '';
?>
<div class="mkdf-hi-other-image">
<?php if ($is_link) : //link ?>
    <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
<?php endif; ?>
    <?php echo wp_get_attachment_image($image, 'full'); ?>
<?php if ($is_link) : //link ?>
    </a>
<?php endif; ?>
</div>