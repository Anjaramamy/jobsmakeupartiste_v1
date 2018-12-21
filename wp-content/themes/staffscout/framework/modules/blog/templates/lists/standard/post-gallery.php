<?php $like_posts_enabled = staffscout_mikado_like_posts_enabled(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-heading">
            <?php staffscout_mikado_get_module_template_part('templates/parts/post-type/gallery', 'blog', '', $part_params); ?>
        </div>
        <div class="mkdf-post-text">

            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-text-main">
                    <?php staffscout_mikado_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php staffscout_mikado_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                    <?php do_action('staffscout_mikado_single_link_pages'); ?>
                </div>
                <div class="mkdf-post-info-bottom">
                    <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                    <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>
                    <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                    <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                </div>
            </div>
            <?php if($like_posts_enabled) : ?>
                <div class="mkdf-post-info-left">
                    <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>