<?php
if($show_header_top) {
	do_action('staffscout_mikado_before_header_top');
	?>
	
	<?php if($show_header_top_background_div){ ?>
		<div class="mkdf-top-bar-background"></div>
	<?php } ?>
	
	<div class="mkdf-top-bar">
		<?php do_action( 'staffscout_mikado_after_header_top_html_open' ); ?>
		
		<?php if($top_bar_in_grid) : ?>
			<div class="mkdf-grid">
		<?php endif; ?>
				
			<div class="mkdf-vertical-align-containers">
				<div class="mkdf-position-left"><!--
			     --><div class="mkdf-position-left-inner">
						<?php if(is_active_sidebar('mkdf-top-bar-left')) : ?>
							<?php dynamic_sidebar('mkdf-top-bar-left'); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="mkdf-position-right"><!--
				 --><div class="mkdf-position-right-inner">
						<?php if(is_active_sidebar('mkdf-top-bar-right')) : ?>
							<?php dynamic_sidebar('mkdf-top-bar-right'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
				
		<?php if($top_bar_in_grid) : ?>
			</div>
		<?php endif; ?>
		
		<?php do_action( 'staffscout_mikado_before_header_top_html_close' ); ?>
	</div>
	
	<?php do_action('staffscout_mikado_after_header_top');
}