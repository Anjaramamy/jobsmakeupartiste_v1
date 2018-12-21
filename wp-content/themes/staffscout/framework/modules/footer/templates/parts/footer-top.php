<div class="mkdf-footer-top-holder">
	<div class="mkdf-footer-top-inner <?php echo esc_attr($footer_top_grid_class); ?>">
		<div class="mkdf-grid-row <?php echo esc_attr($footer_top_classes); ?>">
			<?php for($i = 1; $i <= $footer_top_columns; $i++) {
                $id = staffscout_mikado_get_page_id();
                $custom_widgets = get_post_meta($id, 'mkdf_custom_footer_col_' . $i . '_widget_meta', true);
			    ?>
				<div class="mkdf-column-content mkdf-grid-col-<?php echo esc_attr(12 / $footer_top_columns); ?>">
					<?php

                        $widget_area = $custom_widgets;

                        if ($custom_widgets == ''){
                            $widget_area = 'footer_top_column_'.$i;
                        }

						if(is_active_sidebar($widget_area)) {
							dynamic_sidebar($widget_area);
						}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>