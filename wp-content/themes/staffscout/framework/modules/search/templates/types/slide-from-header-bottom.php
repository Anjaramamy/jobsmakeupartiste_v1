<div class="mkdf-slide-from-header-bottom-holder">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="mkdf-form-holder">
			<input type="text" placeholder="<?php esc_html_e( 'Search', 'staffscout' ); ?>" name="s" class="mkdf-search-field" autocomplete="off" />
			<button type="submit" class="mkdf-search-submit"><?php echo staffscout_mikado_icon_collections()->renderIcon( 'icon_search', 'font_elegant' ); ?></button>
		</div>
	</form>
</div>