<?php
if(get_the_content() !== ''){?>
	<div class="mkdf-ls-content-part-holder clearfix">

		<div class="mkdf-ls-content-part right">
			<?php echo do_shortcode(get_the_content()); ?>
		</div>

	</div>
<?php }