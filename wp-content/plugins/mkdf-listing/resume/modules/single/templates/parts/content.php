<?php
global $post;

if(get_the_content() !== ''){?>
	<div class="mkdf-rs-content-part-holder clearfix">

		<div class="mkdf-rs-content-part right">
			<?php echo do_shortcode(get_the_content()); ?>

            <?php if ( $items = get_post_meta( $post->ID, '_candidate_education', true ) ) : ?>
                <h4><?php _e( 'Education', 'mkdf-listing'); ?></h4>
                <dl class="resume-manager-education">
                    <?php
                    foreach( $items as $item ) : ?>

                        <dt>
                            <div class="mkdf-resume-education-inner">
                                <h5>
                                    <?php printf( __( '%s at %s', 'mkdf-listing'), '<strong class="qualification">' . esc_html( $item['qualification'] ) . '</strong>', '<strong class="location">' . esc_html( $item['location'] ) . '</strong>' ); ?>
                                 </h5>
                                <small class="date"><?php echo esc_html( $item['date'] ); ?></small>
                            </div>
                        </dt>
                        <dd>
                            <?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
                        </dd>

                    <?php endforeach;
                    ?>
                </dl>
            <?php endif; ?>

            <?php if ( $items = get_post_meta( $post->ID, '_candidate_experience', true ) ) : ?>
                <h4><?php _e( 'Experience', 'mkdf-listing'); ?></h4>
                <dl class="resume-manager-experience">
                    <?php
                    foreach( $items as $item ) : ?>

                        <dt>
                             <div class="mkdf-resume-experience-inner">
                                <h5><?php printf( __( '%s (%s)', 'mkdf-listing'), '<strong class="employer">' . esc_html( $item['employer'] ) . '</strong>', '<strong class="date">' . esc_html( $item['date'] ) . '</strong>' ); ?></h5>
                                <small class="job_title"><?php echo esc_html( $item['job_title'] ); ?></small>
                            </div>
                        </dt>
                        <dd>
                            <?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
                        </dd>

                    <?php endforeach;
                    ?>
                </dl>
            <?php endif; ?>
        </div>
	</div>
<?php }