<?php

$id = get_the_ID();
$image = get_post_meta($id, '_candidate_photo', true);
$image_id = staffscout_mikado_get_attachment_id_from_url( $image );
$item_profession = get_post_meta($id, '_candidate_title', true);

?>
<article class="mkdf-rs-item mkdf-item-space" id="<?php echo htmlspecialchars($title); ?>">

    <?php if(!empty($image)) { ?>

        <div class="mkdf-rs-item-holder">


                <div class="mkdf-rs-item-image">

                    <?php echo wp_get_attachment_image( $image_id, 'staffscout_mikado_image_landscape_medium' ); ?>

                    <div class="mkdf-rs-item-inner">

                        <div class="mkdf-rs-item-title">
                            <h4 class="mkdf-resume-title">
                                <a href="<?php echo get_the_permalink(); ?>">
                                    <?php echo get_the_title(); ?>
                                </a>
                            </h4>
                        </div>

                        <div class="mkdf-rs-item-profession">

                            <?php

                            if(!empty($item_profession)) {
                                echo wp_kses_post($item_profession);
                            }

                            ?>

                        </div>

                    </div>

                    <a href="<?php echo get_the_permalink(); ?>" class="mkdf-rs-item-featured-image"></a>

                </div>

        </div>

    <?php }?>

</article>