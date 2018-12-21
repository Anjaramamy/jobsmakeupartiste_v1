<?php
$web_site = $article_obj->getPostMeta('_resume_website');
$mail = $article_obj->getPostMeta('_resume_mail');
$address = $article_obj->getAddressIconHtml(true, false);
$rate = $article_obj->getPriceRateHtml();
$category = $article_obj->getTaxHtml('resume_category', 'mkdf-resume-cat-wrapper');

?>

<?php if ($web_site !== '' || $mail !== '' || $address !== '' || $rate !== '' || $category !== '') { ?>

<div class="mkdf-rs-candidate-details-inner">

    <h4 class="mkdf-rs-address-title">
        <?php esc_html_e('Candidate Details', 'mkdf-listing'); ?>
    </h4>

    <?php if ($address !== '') { ?>
        <div class="mkdf-rs-address-info">
            <?php echo wp_kses_post($address); ?>
        </div>
    <?php } ?>

    <?php if ($rate !== '') { ?>
        <div class="mkdf-rs-rate-info">
            <?php echo wp_kses_post($rate); ?>
        </div>
    <?php } ?>


    <?php if ($category !== '') { ?>
        <div class="mkdf-rs-category-info">
            <?php echo wp_kses_post($category); ?>
        </div>
    <?php } ?>


    <?php if ($web_site !== '') { ?>
        <div class="mkdf-rs-website-info">
            <?php echo staffscout_mikado_icon_collections()->renderIcon('dripicons-link', 'dripicons'); ?>
            <a href="<?php echo esc_url($web_site) ?>" target="_self">
                <?php echo wp_kses_post($web_site); ?>
            </a>
        </div>
    <?php }

    if ($mail !== '') { ?>
        <div class="mkdf-rs-email-info">
            <?php echo staffscout_mikado_icon_collections()->renderIcon('fa-envelope-o', 'font_awesome'); ?>
            <span>
                <a href="<?php echo esc_url($mail) ?>" target="_self">
                    <?php echo wp_kses_post($mail); ?>
                </a>
            </span>
        </div>
    <?php } ?>

    </div>

<?php }
