<div class="mkdf-process-holder <?php echo esc_attr( $holder_classes ); ?>">
	<div class="mkdf-mark-horizontal-holder">
		<?php for ( $i = 1; $i <= $number_of_items; $i ++ ) { ?>
			<div class="mkdf-process-mark">
				<div class="mkdf-process-line"></div>
				<div class="mkdf-process-circle"><?php echo esc_attr( $i ); ?></div>
			</div>
		<?php } ?>
	</div>
	<div class="mkdf-mark-vertical-holder">
		<?php for ( $i = 1; $i <= $number_of_items; $i ++ ) { ?>
			<div class="mkdf-process-mark">
				<div class="mkdf-process-line"></div>
				<div class="mkdf-process-circle"><?php echo esc_attr( $i ); ?></div>
			</div>
		<?php } ?>
	</div>
	<div class="mkdf-process-inner">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>