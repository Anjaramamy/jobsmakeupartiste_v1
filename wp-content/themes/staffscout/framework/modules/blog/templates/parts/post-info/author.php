<div class="mkdf-post-info-author">
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="mkdf-post-info-author-image">
            <a itemprop="url" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
            </a>
        </div>
    <?php } ?>
    <a itemprop="author" class="mkdf-post-info-author-link" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
        <?php the_author_meta('display_name'); ?>
    </a>
</div>

