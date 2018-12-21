<div class="mkdf-fullscreen-menu-holder-outer">
	<div class="mkdf-fullscreen-menu-holder">
		<div class="mkdf-fullscreen-menu-holder-inner">
			<?php if ($fullscreen_menu_in_grid) : ?>
				<div class="mkdf-container-inner">
			<?php endif;

			//Sidearea above menu
			if(is_active_sidebar( 'fullscreen_menu_above' ) ) : ?>
				<div class="mkdf-fullscreen-above-menu-widget-holder">
					<?php dynamic_sidebar('fullscreen_menu_above'); ?>
				</div>
			<?php endif;

			//Navigation
			staffscout_mikado_get_module_template_part('templates/full-screen-menu-navigation', 'header/types/header-minimal');;

			//Sidearea under menu
			if(is_active_sidebar('fullscreen_menu_below')) : ?>
				<div class="mkdf-fullscreen-below-menu-widget-holder">
					<?php dynamic_sidebar('fullscreen_menu_below'); ?>
				</div>
			<?php endif;

			if ($fullscreen_menu_in_grid) : ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>