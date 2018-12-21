<article class="mkdf-ls-item mkdf-item-space clearfix">
    <div class="mkdf-ls-inner">
        <a href="<?php echo get_the_permalink(); ?>" class="mkdf-ls-item-author-image">
            <?php echo get_avatar(get_the_author_meta('ID'), 80 ); ?>
        </a>
        <div class="mkdf-ls-content">
            <h5 class="mkdf-listing-title">
                <a href="<?php echo get_the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h5>

             <?php if (! empty ($address_html)) { ?>
                <?php echo wp_kses_post($address_html); ?>
             <?php } ?>
        </div>
    </div>
</article>
