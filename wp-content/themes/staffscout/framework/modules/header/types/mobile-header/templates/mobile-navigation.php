<?php do_action('staffscout_mikado_before_mobile_navigation'); ?>

    <div class="mkdf-mobile-side-area">
        <div class="mkdf-close-mobile-side-area-holder">
            <?php echo staffscout_mikado_icon_collections()->renderIcon('dripicons-cross', 'dripicons'); ?>
        </div>
        <div class="mkdf-mobile-side-area-inner">
            <nav class="mkdf-mobile-nav">
                <?php wp_nav_menu(array(
                    'theme_location'  => 'mobile-navigation',
                    'container'       => '',
                    'container_class' => '',
                    'menu_class'      => '',
                    'menu_id'         => '',
                    'fallback_cb'     => 'top_navigation_fallback',
                    'link_before'     => '<span>',
                    'link_after'      => '</span>',
                    'walker'          => new StaffScoutMikadoClassMobileNavigationWalker()
                )); ?>
            </nav>
        </div>
        <div class="mkdf-mobile-widget-area">
            <div class="mkdf-mobile-widget-area-inner">
                <?php
                if(is_active_sidebar('mkdf-mobile-area')) : ?>
                    <?php dynamic_sidebar('mkdf-mobile-area'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php do_action('staffscout_mikado_after_mobile_navigation'); ?>