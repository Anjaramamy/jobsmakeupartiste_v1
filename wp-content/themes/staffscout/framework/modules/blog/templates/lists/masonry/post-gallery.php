<?php
$post_classes[] = 'mkdf-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-heading">
            <?php staffscout_mikado_get_module_template_part('templates/parts/post-type/gallery', 'blog', '', $part_params); ?>
        </div>
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-info-top">
                    <?php staffscout_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                </div>
                <div class="mkdf-post-text-main">
                    <?php staffscout_mikado_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php staffscout_mikado_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>