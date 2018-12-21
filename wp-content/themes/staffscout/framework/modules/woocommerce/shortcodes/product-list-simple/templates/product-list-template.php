<div class="mkdf-pls-holder <?php echo esc_attr($holder_classes) ?>">
    <ul class="mkdf-pls-inner">
        <?php if($query_result->have_posts()): while ($query_result->have_posts()) : $query_result->the_post(); ?>
            <li class="mkdf-pls-item">
                <div class="mkdf-pls-image">
                    <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php staffscout_mikado_get_module_template_part('templates/parts/image-simple', 'woocommerce', '', $params); ?>
                    </a>    
                </div>
                <div class="mkdf-pls-text">
                    <?php staffscout_mikado_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>
    
                    <?php staffscout_mikado_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>
    
                    <?php staffscout_mikado_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>
                </div>
            </li>
        <?php endwhile; else: ?>
            <li class="mkdf-pls-messsage">
                <?php staffscout_mikado_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params); ?>
            </li>
        <?php endif;
            wp_reset_postdata();
        ?>
    </ul>
</div>