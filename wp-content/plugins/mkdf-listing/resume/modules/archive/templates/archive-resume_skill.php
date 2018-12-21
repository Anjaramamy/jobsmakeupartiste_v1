<?php
get_header();
?>
	<div class="mkdf-full-width">
		<?php do_action('mkdf_listing_resume_action_after_container_open'); ?>
		<div class="mkdf-full-width-inner">
			<?php
			mkdf_listing_resume_get_resume_archive_pages();
			?>
		</div>
		<?php do_action('mkdf_listing_resume_action_before_container_close'); ?>
	</div>
<?php get_footer();