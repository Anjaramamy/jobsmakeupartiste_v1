<?php do_action('staffscout_mikado_after_sticky_header'); ?>

<div class="mkdf-sticky-header">
    <?php do_action('staffscout_mikado_after_sticky_menu_html_open'); ?>
    <div class="mkdf-sticky-holder">
        <?php if ($sticky_header_in_grid) : ?>
        <div class="mkdf-grid">
            <?php endif; ?>
            <div class=" mkdf-vertical-align-containers">
                <div class="mkdf-position-left">
                    <div class="mkdf-position-left-inner">
                        <?php if (!$hide_logo) {
                            staffscout_mikado_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="mkdf-position-right">
                    <div class="mkdf-position-right-inner">
                        <a href="javascript:void(0)" class="mkdf-fullscreen-menu-opener">
                            <span class="mkdf-fm-lines">
								<span class="mkdf-fm-line mkdf-line-1"></span>
								<span class="mkdf-fm-line mkdf-line-2"></span>
								<span class="mkdf-fm-line mkdf-line-3"></span>
							</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php if ($sticky_header_in_grid) : ?>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php do_action('staffscout_mikado_after_sticky_header'); ?>
