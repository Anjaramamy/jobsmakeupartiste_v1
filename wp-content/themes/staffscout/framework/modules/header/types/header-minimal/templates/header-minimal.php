<?php do_action('staffscout_mikado_before_page_header'); ?>

<header class="mkdf-page-header">
	<?php do_action('staffscout_mikado_after_page_header_html_open'); ?>
	
	<?php if($show_fixed_wrapper) : ?>
		<div class="mkdf-fixed-wrapper">
	<?php endif; ?>
			
	<div class="mkdf-menu-area">
		<?php do_action('staffscout_mikado_after_header_menu_area_html_open'); ?>
		
		<?php if($menu_area_in_grid) : ?>
			<div class="mkdf-grid">
		<?php endif; ?>
				
			<div class="mkdf-vertical-align-containers">
				<div class="mkdf-position-left">
					<div class="mkdf-position-left-inner">
						<?php if(!$hide_logo) {
							staffscout_mikado_get_logo();
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
				
		<?php if($menu_area_in_grid) : ?>
			</div>
		<?php endif; ?>
	</div>
			
	<?php if($show_fixed_wrapper) { ?>
		</div>
	<?php } ?>
	
	<?php if($show_sticky) {
		staffscout_mikado_get_sticky_header('minimal', 'header/types/header-minimal');
	} ?>
	
	<?php do_action('staffscout_mikado_before_page_header_html_close'); ?>
</header>

<?php staffscout_mikado_get_mobile_header('minimal', 'header/types/header-minimal'); ?>