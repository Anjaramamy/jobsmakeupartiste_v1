<?php do_action('staffscout_mikado_before_sticky_header'); ?>

<div class="mkdf-sticky-header">
    <?php do_action( 'staffscout_mikado_after_sticky_menu_html_open' ); ?>
    <div class="mkdf-sticky-holder">
        <?php if($sticky_header_in_grid) : ?>
        <div class="mkdf-grid">
            <?php endif; ?>
            <div class=" mkdf-vertical-align-containers">
                <div class="mkdf-position-left"><!--
				 --><div class="mkdf-position-left-inner">
                        <?php if(!$hide_logo) {
                            staffscout_mikado_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="mkdf-position-right"><!--
				 --><div class="mkdf-position-right-inner">
						<?php staffscout_mikado_get_sticky_menu('mkdf-sticky-nav'); ?>
						<?php if(is_active_sidebar('mkdf-sticky-right')) : ?>
                            <?php dynamic_sidebar('mkdf-sticky-right'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if($sticky_header_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
	<?php do_action( 'staffscout_mikado_before_sticky_menu_html_close' ); ?>
</div>

<?php do_action('staffscout_mikado_after_sticky_header'); ?>