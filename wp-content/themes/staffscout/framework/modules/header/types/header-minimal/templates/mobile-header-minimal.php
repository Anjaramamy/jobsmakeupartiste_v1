<?php do_action('staffscout_mikado_before_mobile_header'); ?>

<header class="mkdf-mobile-header">
	<?php do_action('staffscout_mikado_after_mobile_header_html_open'); ?>
	
	<div class="mkdf-mobile-header-inner">
		<div class="mkdf-mobile-header-holder">
			<div class="mkdf-grid">
				<div class="mkdf-vertical-align-containers">
					<div class="mkdf-position-left">
						<div class="mkdf-position-left-inner">
							<?php staffscout_mikado_get_mobile_logo(); ?>
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
			</div>
		</div>
	</div>
	
	<?php do_action('staffscout_mikado_before_mobile_header_html_close'); ?>
</header>

<?php do_action('staffscout_mikado_after_mobile_header'); ?>