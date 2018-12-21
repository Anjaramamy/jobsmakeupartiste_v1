<?php
$mkdf_search_holder_params = staffscout_mikado_get_holder_params_search();
?>
<?php get_header(); ?>
<?php staffscout_mikado_get_title(); ?>
	<div class="<?php echo esc_attr( $mkdf_search_holder_params['holder'] ); ?>">
		<?php do_action( 'staffscout_mikado_after_container_open' ); ?>
		<div class="<?php echo esc_attr( $mkdf_search_holder_params['inner'] ); ?>">
			<?php staffscout_mikado_get_search_page(); ?>
		</div>
		<?php do_action( 'staffscout_mikado_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>