<?php if ( ! staffscout_mikado_post_has_read_more() ) { ?>
	<div class="mkdf-post-read-more-button">
		<?php
		if ( staffscout_mikado_core_plugin_installed() ) {
			echo staffscout_mikado_get_button_html(
				apply_filters(
					'staffscout_mikado_blog_template_read_more_button',
					array(
						'type'         => 'simple',
						'size'         => 'medium',
						'link'         => get_the_permalink(),
						'text'         => esc_html__( 'READ MORE', 'staffscout' ),
						'custom_class' => 'mkdf-blog-list-button'
					)
				)
			);
		} else { ?>
			<a itemprop="url" href="<?php echo esc_attr( get_the_permalink() ); ?>" target="_self" class="mkdf-btn mkdf-btn-medium mkdf-btn-simple mkdf-blog-list-button">
                <span class="mkdf-btn-text"><?php echo esc_html__( 'READ MORE', 'staffscout' ); ?></span>
			</a>
		<?php } ?>
	</div>
<?php } ?>