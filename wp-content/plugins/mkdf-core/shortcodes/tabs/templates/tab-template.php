<div class="mkdf-tabs <?php echo esc_attr($holder_classes); ?>">
	<ul class="mkdf-tabs-nav clearfix">
		<?php foreach ($tabs_titles as $tab_title) { ?>
			<li>
				<?php if(!empty($tab_title)) { ?>
					<a href="#tab-<?php echo sanitize_title($tab_title)?>"><?php echo esc_html($tab_title); ?></a>
				<?php } ?>
			</li>
		<?php } ?>
	</ul>
	<?php echo do_shortcode($content); ?>
</div>