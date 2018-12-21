<div class="mkdf-ss-holder <?php echo esc_attr( $holder_classes ); ?>">
	<?php if ( ! empty( $image ) ) { ?>
		<div class="mkdf-ss-image" <?php echo staffscout_mikado_get_inline_style( $image_styles ); ?>>
			<?php echo wp_get_attachment_image( $image, 'full' ); ?>
		</div>
	<?php } ?>
	<div class="mkdf-ss-content" <?php echo staffscout_mikado_get_inline_style( $content_style ); ?>>
		<?php if ( ! empty( $title ) ) { ?>
			<<?php echo esc_attr( $title_tag ); ?> class="mkdf-ss-title" <?php echo staffscout_mikado_get_inline_style( $title_styles ); ?>>
				<?php echo esc_html( $title ); ?>
			</<?php echo esc_attr( $title_tag ); ?>>
		<?php } ?>
		<?php if ( ! empty( $text ) ) { ?>
			<p class="mkdf-ss-text" <?php echo staffscout_mikado_get_inline_style( $text_styles ); ?>><?php echo wp_kses( $text, array( 'br' => true ) ); ?></p>
		<?php } ?>
		<?php if ( ! empty( $button_text ) ): ?>
			<?php echo staffscout_mikado_get_button_html( array(
				'custom_class'           => 'mkdf-ss-link',
				'text'                   => esc_html( $button_text ),
				'type'                   => esc_attr( $button_type ),
				'size'                   => esc_attr( $button_size ),
				'link'                   => ! empty( $button_link ) ? esc_url( $button_link ) : '#',
				'target'                 => ! empty( $button_target ) ? esc_attr( $button_target ) : '_self',
				'color'                  => esc_attr( $button_color ),
				'hover_color'            => esc_attr( $button_hover_color ),
				'background_color'       => esc_attr( $button_background_color ),
				'hover_background_color' => esc_attr( $button_hover_background_color ),
				'border_color'           => esc_attr( $button_border_color ),
				'hover_border_color'     => esc_attr( $button_hover_border_color ),
				'margin'                 => $button_top_margin !== '' ? esc_attr( $button_top_margin ) . ' 0 0' : ''
			) ); ?>
		<?php endif; ?>
	</div>
</div>