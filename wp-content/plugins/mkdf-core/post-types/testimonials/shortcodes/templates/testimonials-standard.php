<div class="mkdf-testimonial-content <?php echo esc_attr($container_classes); ?>" <?php staffscout_mikado_inline_style($container_styles); ?>>
	<div class="mkdf-testimonial-text-holder">
        <div class="mkdf-testimonial-text-inner">
            <?php if ( ! empty( $quote_image ) ) { ?>
                <div class="mkdf-testimonial-quote-image">
                    <img src="<?php echo esc_url($quote_image); ?>" alt="<?php echo esc_attr($quote_img_alt); ?>" />
                </div>
            <?php }?>
            <?php if ( ! empty( $title ) ) { ?>
                <h2 itemprop="name" class="mkdf-testimonial-title entry-title"><?php echo esc_html( $title ); ?></h2>
            <?php } ?>
            <?php if ( ! empty( $text ) ) { ?>
                <p class="mkdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
            <?php } ?>
            <?php if ( ! empty( $author ) ) { ?>
                <h4 class="mkdf-testimonial-author">
                    <span class="mkdf-testimonials-author-name"><?php echo esc_html( $author ) . ', '; ?></span>
                    <?php if ( ! empty( $position ) ) { ?>
                        <span class="mkdf-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
                    <?php } ?>
                </h4>
            <?php } ?>
        </div>
	</div>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="mkdf-testimonial-bullets-holder" data-bullet-image="<?php echo get_the_post_thumbnail_url( get_the_ID(), array( 66, 66 ) ); ?>" data-bullet-company="<?php echo esc_url($company_logo, 'full'); ?>">
		</div>
	<?php } ?>
</div>
