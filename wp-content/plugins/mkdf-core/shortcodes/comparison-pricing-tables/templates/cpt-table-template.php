<div <?php staffscout_mikado_class_attribute($table_classes); ?>>
	<div class="mkdf-cpt-table-holder-inner">
		<div class="mkdf-cpt-table-head-holder">
			<div class="mkdf-cpt-table-head-holder-inner">
				<?php if ($title !== '') : ?>
					<h5 class="mkdf-cpt-table-title"><?php echo esc_html($title); ?></h5>
				<?php endif; ?>
			</div>
		</div>

		<div class="mkdf-cpt-table-content">
			<?php echo do_shortcode(preg_replace('#^<\/p>|<p>$#', '', $content)); ?>
		</div>
		<?php if($show_button == 'yes') { ?>
			<div class="mkdf-cpt-table-footer">
                <?php if ($price !== '') : ?>
                    <div class="mkdf-cpt-table-price-holder">
                        <?php if ($currency !== '') : ?>
                        <span class="mkdf-cpt-table-currency"><?php echo esc_html($currency); ?></span>

						<?php endif; ?>

						<span class="mkdf-cpt-table-price"><?php echo esc_html($price); ?></span>

                        <?php if ($price_period !== '') : ?>
                            <span class="mkdf-cpt-table-period">
								/ <?php echo esc_html($price_period); ?>
							</span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
				<?php echo staffscout_mikado_get_button_html($button_parameters); ?>
			</div>
		<?php } ?>
	</div>
</div>