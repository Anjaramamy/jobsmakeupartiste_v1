<?php do_action('staffscout_mikado_before_mobile_header'); ?>

<header class="mkdf-mobile-header">
	<?php do_action('staffscout_mikado_after_mobile_header_html_open'); ?>
	
	<div class="mkdf-mobile-header-inner">
		<div class="mkdf-mobile-header-holder">
			<div class="mkdf-grid">
				<div class="mkdf-vertical-align-containers">
					<div class="mkdf-vertical-align-containers">
						<div class="mkdf-position-left">
							<div class="mkdf-position-left-inner">
								<?php staffscout_mikado_get_mobile_logo(); ?>
							</div>
						</div>
						<div class="mkdf-position-right">
							<div class="mkdf-position-right-inner">
                                <?php if($show_navigation_opener) : ?>
                                    <div class="mkdf-mobile-menu-opener">
                                        <a href="javascript:void(0)">
									<span class="mkdf-mobile-menu-icon">
										<?php echo staffscout_mikado_icon_collections()->renderIcon('dripicons-menu', 'dripicons'); ?>
									</span>
                                            <?php if(!empty($mobile_menu_title)) { ?>
                                                <h5 class="mkdf-mobile-menu-text"><?php echo esc_attr($mobile_menu_title); ?></h5>
                                            <?php } ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php staffscout_mikado_get_mobile_nav(); ?>
	</div>
	
	<?php do_action('staffscout_mikado_before_mobile_header_html_close'); ?>
</header>

<?php do_action('staffscout_mikado_after_mobile_header'); ?>