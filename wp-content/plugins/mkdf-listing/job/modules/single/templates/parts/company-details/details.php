<?php
$web_site = $article_obj->getPostMeta('_company_website');
$mail = $article_obj->getPostMeta('_listing_mail');
$address = $article_obj->getAddressIconHtml(true, false);
$rate = $article_obj->getPriceRateHtml();
$category = $article_obj->getTaxHtml('job_listing_category', 'mkdf-listing-cat-wrapper');

?>

<?php if ($web_site !== '' || $mail !== '' || $address !== '' || $rate !== '' || $category !== '') { ?>

<div class="mkdf-ls-company-details-inner">

    <h4 class="mkdf-ls-address-title">
        <?php esc_html_e('Company Details', 'mkdf-listing'); ?>
    </h4>

    <?php if ($address !== '') { ?>
        <div class="mkdf-ls-address-info">
            <?php echo wp_kses_post($address); ?>
        </div>
    <?php } ?>

    <?php if ($rate !== '') { ?>
        <div class="mkdf-ls-rate-info">
            <?php echo wp_kses_post($rate); ?>
            <span class="mkdf-ls-price-rate-label"><?php esc_html_e('/ hour', 'mkdf-listing'); ?></span>
        </div>
    <?php } ?>


    <?php if ($category !== '') { ?>
        <div class="mkdf-ls-category-info">
            <?php echo wp_kses_post($category); ?>
        </div>
    <?php } ?>


    <?php if ($web_site !== '') { ?>
        <div class="mkdf-ls-website-info">
            <?php echo staffscout_mikado_icon_collections()->renderIcon('fa-link', 'font_awesome'); ?>
            <a href="<?php echo esc_url($web_site) ?>" target="_blank">
                <?php echo wp_kses_post($web_site); ?>
            </a>
        </div>
    <?php }

    if ($mail !== '') { ?>
        <div class="mkdf-ls-email-info">
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
