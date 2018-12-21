<?php $i = 0; ?>

<div class="mkdf-expanded-gallery <?php echo esc_attr($holder_classes); ?>">
	<div class="mkdf-eg-inner">
		<?php foreach ($images as $image) { ?>
			<div class="mkdf-eg-image">
				<?php if (!empty($links)) { ?>
					<a itemprop="url" class="mkdf-eg-link" href="<?php echo esc_url($links[$i++]) ?>" title="<?php echo esc_attr($image['alt']); ?>" target="<?php echo esc_attr($target); ?>">
				<?php } ?>
					<?php echo wp_get_attachment_image($image['image_id'], 'full'); ?>
				<?php if (!empty($links)) { ?>
					</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>