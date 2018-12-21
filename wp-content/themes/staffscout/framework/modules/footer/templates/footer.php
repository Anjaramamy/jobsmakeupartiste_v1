<?php staffscout_mikado_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer && ($display_footer_top || $display_footer_bottom)) { ?>
			<footer class="mkdf-page-footer <?php echo esc_attr($footer_skin); ?>">
					<div class="footerInstagram">
					<?php
						if($display_footer_bottom) {
						staffscout_mikado_get_footer_bottom();
					}
					?>
					</div>
					<?php	
						if($display_footer_top) {
						staffscout_mikado_get_footer_top();
					}
					
					?>
					<?php dynamic_sidebar( 'zone-widgets-2' ); ?>
			</footer>
		<?php } ?>
	</div> <!-- close div.mkdf-wrapper-inner  -->
</div> <!-- close div.mkdf-wrapper -->
<?php wp_footer(); ?>
</body>
</html>