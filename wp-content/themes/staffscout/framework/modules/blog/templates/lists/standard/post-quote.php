<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="mkdf-post-content">
        <div class="mkdf-post-text">
            <div class="mkdf-post-text-inner">
                <div class="mkdf-post-text-main">
                    <?php staffscout_mikado_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                    <div class="mkdf-post-mark">
                        <span class="icon_quotations mkdf-quote-mark"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>