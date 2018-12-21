<?php if(has_post_thumbnail()) {
	?>
	<div class="mkdf-ls-item-image">
        <?php echo get_the_post_thumbnail(get_the_ID(), 'full') ?>
	</div>
<?php }