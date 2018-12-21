<?php

$item_author = get_the_author();
$item_link = get_author_posts_url( get_the_author_meta( 'ID' ));

?>

<div class="mkdf-ls-item-image">
    <a href="<?php echo esc_attr($item_link); ?>">
        <?php echo $image = get_avatar(get_the_author_meta('ID'), 120); ?>
    </a>
</div>

<div class="mkdf-ls-item-author">
<?php

if(!empty($item_author)) {
    echo wp_kses_post($item_author);
}

?>
</div>

