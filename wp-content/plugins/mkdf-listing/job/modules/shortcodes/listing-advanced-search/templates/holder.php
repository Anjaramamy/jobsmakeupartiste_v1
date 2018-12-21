<?php
use MikadoListing\Lib\Front;
use MikadoListing\Lib\Core;

$this_object = mkdf_listing_job_adv_search_class_instance();

$query_results = $this_object->getQueryResults();
$data_params = $this_object->getBasicParamByKey('data_params');
$holder_classes = $this_object->getBasicParamByKey('holder_classes');
$items_classes = $this_object->getBasicParamByKey('items_classes');
$content_in_grid = $this_object->getBasicParamByKey('content_in_grid') === 'yes' ? true : false;
$item_type = $this_object->getBasicParamByKey('item_type') === 'standard' ? 'standard' : 'list';
$grid_class = '';
$search_title = $this_object->getBasicParamByKey('search_title');
$enable_sidebar = $this_object->getBasicParamByKey('enable_sidebar');
$image_size = $this_object->getBasicParamByKey('image_size');
$title_tag = $this_object->getBasicParamByKey('title_tag');
if ($content_in_grid) {
    $grid_class = 'mkdf-grid';
}

$map_flag = $this_object->getBasicParamByKey('enable_map') === 'yes' ? true : false;
$keyword_flag = $this_object->getBasicParamByKey('keyword_search') === 'yes' ? true : false;
$location_flag = $this_object->getBasicParamByKey('location_search') === 'yes' ? true : false;
$category_flag = $this_object->getBasicParamByKey('category_search') === 'yes' ? true : false;

$html = ''; ?>

<div
        class="mkdf-ls-adv-search-holder clearfix <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($data_params, array('data')); ?>>
    <?php

    if ($map_flag) {
        echo mkdf_listing_job_get_shortcode_module_template_part('templates/map', 'listing-advanced-search');
    }

    ?>
    <div class="mkdf-ls-adv-search-content <?php echo esc_attr($grid_class); ?>">

        <div class="mkdf-ls-adv-search-content-holder">

            <?php if ($search_title !== '') { ?>

                <h3 class="mkdf-ls-adv-title">
                    <?php echo wp_kses_post($search_title); ?>
                </h3>

            <?php } ?>

            <div class="mkdf-ls-adv-search-filters-items">

                <div class="mkdf-ls-adv-search-filters-holder clearfix">


                    <div class="mkdf-ls-adv-search-filters">
                        <div class="mkdf-ls-adv-search-filters-inner clearfix">
                            <?php

                            //keyword input
                            if ($keyword_flag) {
                                echo mkdf_listing_job_get_shortcode_module_template_part('templates/keyword', 'listing-advanced-search');
                            }

                            //locations select
                            if ($location_flag) {
                                echo mkdf_listing_job_get_shortcode_module_template_part('templates/locations', 'listing-advanced-search');
                            }

                            //categories select
                            if ($category_flag) {
                                echo mkdf_listing_job_get_shortcode_module_template_part('templates/categories', 'listing-advanced-search');
                            }

                            ?>
                        </div>
                    </div>

                    <?php

                    //submit button
                    echo mkdf_listing_job_get_shortcode_module_template_part('templates/submit', 'listing-advanced-search');

                    ?>

                </div>

                <?php
                //type checkboxes
                echo mkdf_listing_job_get_shortcode_module_template_part('templates/types', 'listing-advanced-search');

                ?>

                <div class="mkdf-ls-adv-search-items-holder mkdf-small-space mkdf-adv-search-four-columns clearfix">
                    <div class="mkdf-ls-adv-search-items-holder-inner <?php echo esc_attr($items_classes); ?> clearfix">
                    <?php
                    if ($query_results->have_posts()) {
                        while ($query_results->have_posts()) {
                            $query_results->the_post();
                            $article_obj = new Core\ListingArticle(get_the_ID());

                            $excerpt = get_the_excerpt(get_the_ID());

                            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                            $img_style = '';
                            if ($img_url !== '') {
                                $img_style = 'background-image: url(' . esc_url($img_url) . ')';
                            }

                            $params = array(
                                'type_html'       => $article_obj->getTaxHtml('job_listing_type', 'mkdf-listing-type-wrapper'),
                                'cat_html'        => $article_obj->getTaxHtml('job_listing_category', 'mkdf-listing-cat-wrapper'),
                                'rating_html'     => $article_obj->getListingAverageRating(),
                                'address_html'    => $article_obj->getAddressIconHtml(true, false),
                                'price_html'      => $article_obj->getPriceHtml(),
                                'price_rate_html' => $article_obj->getPriceRateHtml(),
                                'expire_date_html' => $article_obj->getExpireDateHtml(),
                                'article_obj'     => $article_obj,
                                'excerpt'      => $excerpt,
                                'img_style'    => $img_style,
                                'image_size'   => $image_size,
                                'title_tag'   => $title_tag,
                            );

                            if($item_type === 'list') {
                                $html .= mkdf_listing_job_get_shortcode_module_template_part('templates/item-type-list', 'listing-advanced-search', '', $params);
                            } else {
                                $html .= mkdf_listing_job_get_shortcode_module_template_part('templates/item-type-standard', 'listing-advanced-search', '', $params);
                            }
                        }
                    } else {
                        $html = mkdf_listing_job_get_shortcode_module_template_part('templates/post-not-found', 'listing-advanced-search');
                    }

                    wp_reset_postdata();
                    print $html; ?>

                    </div>

                    <?php echo mkdf_listing_job_get_shortcode_module_template_part('templates/load-more-template', 'listing-advanced-search');
                    ?>
                </div>

            </div>
        </div>

        <?php if ($enable_sidebar === 'yes') { ?>
            <aside class="mkdf-ls-adv-search-sidebar-holder mkdf-sidebar">
                <?php staffscout_mikado_get_listing_search_widget_area(); ?>
            </aside>
        <?php } ?>
    </div>
</div>