<?php if(is_array($features) && count($features)) : ?>
	<div <?php staffscout_mikado_class_attribute($holder_classes); ?>>
		<div class="mkdf-cpt-features-holder mkdf-cpt-table">
			<div class="mkdf-cpt-features-title-holder mkdf-cpt-table-head-holder">
				<div class="mkdf-cpt-table-head-holder-inner">
					<h5 class="mkdf-cpt-features-title"><?php echo wp_kses_post(preg_replace('#^<\/p>|<p>$#', '', $title)); ?></h5>
				</div>
			</div>
			<div class="mkdf-cpt-features-list-holder mkdf-cpt-table-content">
				<ul class="mkdf-cpt-features-list">
					<?php foreach($features as $feature) : ?>
						<li class="mkdf-cpt-features-item"><h6><?php echo esc_html($feature); ?></h6></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<?php echo do_shortcode($content); ?>
	</div>
<?php endif; ?>