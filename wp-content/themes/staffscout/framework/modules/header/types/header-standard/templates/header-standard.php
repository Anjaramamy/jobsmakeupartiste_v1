<?php do_action('staffscout_mikado_before_page_header'); ?>

<header class="mkdf-page-header">
	<?php do_action('staffscout_mikado_after_page_header_html_open'); ?>
	
	<?php if($show_fixed_wrapper) : ?>
		<div class="mkdf-fixed-wrapper">
	<?php endif; ?>
			
	<div class="mkdf-menu-area <?php echo esc_attr($menu_area_position_class); ?>">
		<?php do_action('staffscout_mikado_after_header_menu_area_html_open') ?>
		
		<?php if($menu_area_in_grid) : ?>
			<div class="mkdf-grid">
		<?php endif; ?>
				
			<div class="mkdf-vertical-align-containers">
				<div class="mkdf-position-left"><!--
				 --><div class="mkdf-position-left-inner">
						<?php if(!$hide_logo) {
							staffscout_mikado_get_logo();
						} ?>
						<?php if($menu_area_position === 'left') : ?>
							<?php staffscout_mikado_get_main_menu(); ?>
						<?php endif; ?>
					</div>
				</div>
				<?php if($menu_area_position === 'center') : ?>
					<div class="mkdf-position-center"><!--
				     --><div class="mkdf-position-center-inner">
							<?php staffscout_mikado_get_main_menu(); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="mkdf-position-right"><!--
				 --><div class="mkdf-position-right-inner">
						<?php if($menu_area_position === 'right') : ?>
							<?php staffscout_mikado_get_main_menu(); ?>
						<?php endif; ?>
						<?php staffscout_mikado_get_header_widget_menu_area(); ?>
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
		staffscout_mikado_get_sticky_header();
	} ?>
	
	<?php do_action('staffscout_mikado_before_page_header_html_close'); ?>
</header>

<?php do_action('staffscout_mikado_after_page_header'); ?>