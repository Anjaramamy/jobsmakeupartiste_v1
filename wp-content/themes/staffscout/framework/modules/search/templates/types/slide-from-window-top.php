<?php ?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mkdf-search-slide-window-top" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="mkdf-grid">
	<?php } ?>
		<div class="mkdf-search-form-inner">
			<span class="mkdf-swt-search-icon">
				<?php echo wp_kses( $search_icon, array(
					'i'    => array( 'class' => true, 'aria-hidden' => true ),
					'span' => array( 'class' => true, 'aria-hidden' => true )
				) ); ?>
			</span>
			<input type="text" placeholder="<?php esc_html_e( 'Search', 'staffscout' ); ?>" name="s" class="mkdf-swt-search-field" autocomplete="off"/>
			<a class="mkdf-swt-search-close" href="#">
				<?php echo wp_kses( $search_icon_close, array(
					'i'    => array( 'class' => true, 'aria-hidden' => true ),
					'span' => array( 'class' => true, 'aria-hidden' => true )
				) ); ?>
			</a>
		</div>
	<?php if ( $search_in_grid ) { ?>
	</div>
	<?php } ?>
</form>