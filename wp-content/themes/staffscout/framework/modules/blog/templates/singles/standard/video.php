<?php $like_posts_enabled = staffscout_mikado_like_posts_enabled(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-heading">
            <?php staffscout_mikado_get_module_template_part('templates/parts/post-type/video', 'blog', '', $part_params); ?>
        </div>
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <?php if($like_posts_enabled) : ?>
                    <div class="mkdf-post-info-top">
                        <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                <?php endif; ?>
                <div class="mkdf-post-text-main">
                    <div class="mkdf-post-top-content">
                        <?php staffscout_mikado_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                        <?php the_content(); ?>
                        <?php do_action('staffscout_mikado_single_link_pages'); ?>
                    </div>
                    <div class="mkdf-post-info-bottom clearfix">
                        <div class="mkdf-post-info-bottom-left">
                            <h5 class="mkdf-tag-title">Tags:</h5>
                            <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                        </div>
                        <div class="mkdf-post-info-bottom-right">
                            <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                            <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>
                            <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                            <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>