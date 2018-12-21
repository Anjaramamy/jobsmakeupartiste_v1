<div class="<?php echo esc_attr( $blog_classes ) ?>" <?php echo esc_attr( $blog_data_params ) ?>>
	<div class="mkdf-blog-holder-inner mkdf-outer-space">
		<div class="mkdf-blog-masonry-grid-sizer"></div>
		<div class="mkdf-blog-masonry-grid-gutter"></div>
		<?php
		if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			staffscout_mikado_get_post_format_html( $blog_type );
		endwhile;
		else:
			staffscout_mikado_get_module_template_part( 'templates/parts/no-posts', 'blog' );
		endif;
		
		wp_reset_postdata();
		?>
	</div>
	<?php staffscout_mikado_get_module_template_part( 'templates/parts/pagination/pagination', 'blog', '', $params ); ?>
</div>