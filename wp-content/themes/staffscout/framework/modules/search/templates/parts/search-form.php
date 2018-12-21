<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mkdf-search-page-form" method="get">
	<h2 class="mkdf-search-title"><?php esc_html_e( 'New search:', 'staffscout' ); ?></h2>
	<div class="mkdf-form-holder">
		<div class="mkdf-column-left">
			<input type="text" name="s" class="mkdf-search-field" autocomplete="off" value="" placeholder="<?php esc_html_e( 'Type here', 'staffscout' ); ?>"/>
		</div>
		<div class="mkdf-column-right">
			<button type="submit" class="mkdf-search-submit"><span class="icon_search"></span></button>
		</div>
	</div>
	<div class="mkdf-search-label">
		<?php esc_html_e( 'If you are not happy with the results below please do another search', 'staffscout' ); ?>
	</div>
</form>