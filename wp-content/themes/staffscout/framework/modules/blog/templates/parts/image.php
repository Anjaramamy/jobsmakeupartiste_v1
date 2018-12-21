<?php
$image_size          = isset( $image_size ) ? $image_size : 'full';
$image_meta          = get_post_meta( get_the_ID(), 'mkdf_blog_list_featured_image_meta', true );
$has_featured        = ! empty( $image_meta ) || has_post_thumbnail();
$blog_list_image_id  = ! empty( $image_meta ) && staffscout_mikado_blog_item_has_link() ? staffscout_mikado_get_attachment_id_from_url( $image_meta ) : '';
?>

<?php if ( $has_featured ) { ?>
	<div class="mkdf-post-image">
		<?php if ( staffscout_mikado_blog_item_has_link() ) { ?>
			<a itemprop="url" href="<?php echo get_the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php } ?>
			<?php if ( ! empty( $blog_list_image_id ) ) {
				echo wp_get_attachment_image( $blog_list_image_id, $image_size );
			} else {
				the_post_thumbnail( $image_size );
			} ?>
		<?php if ( staffscout_mikado_blog_item_has_link() ) { ?>
			</a>
		<?php } ?>
		<?php do_action('staffscout_mikado_action_blog_inside_image_tag')?>
	</div>
<?php } ?>