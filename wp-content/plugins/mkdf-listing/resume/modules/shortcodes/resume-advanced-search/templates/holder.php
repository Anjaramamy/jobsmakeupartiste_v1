<?php
use MikadoResume\Lib\Front;
use MikadoResume\Lib\Core;

$this_object = mkdf_listing_resume_adv_search_class_instance();

$query_results = $this_object->getQueryResults();
$data_params = $this_object->getBasicParamByKey('data_params');
$holder_classes = $this_object->getBasicParamByKey('holder_classes');
$items_classes = $this_object->getBasicParamByKey('items_classes');
$content_in_grid = $this_object->getBasicParamByKey('content_in_grid') === 'yes' ? true : false;
$item_type = $this_object->getBasicParamByKey('item_type') === 'standard' ? 'standard' : 'list';
$grid_class = '';
$search_title = $this_object->getBasicParamByKey('search_title');
$enable_sidebar = $this_object->getBasicParamByKey('enable_sidebar');
if ($content_in_grid) {
    $grid_class = 'mkdf-grid';
}

$map_flag = $this_object->getBasicParamByKey('enable_map') === 'yes' ? true : false;
$keyword_flag = $this_object->getBasicParamByKey('keyword_search') === 'yes' ? true : false;
$location_flag = $this_object->getBasicParamByKey('location_search') === 'yes' ? true : false;
$category_flag = $this_object->getBasicParamByKey('category_search') === 'yes' ? true : false;

$html = ''; ?>

<div
        class="mkdf-rs-adv-search-holder clearfix <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($data_params, array('data')); ?>>
    <?php

    if ($map_flag) {
        echo mkdf_listing_resume_get_shortcode_module_template_part('templates/map', 'resume-advanced-search');
    }

    ?>
    <div class="mkdf-rs-adv-search-content <?php echo esc_attr($grid_class); ?>">

        <div class="mkdf-rs-adv-search-content-holder">

            <?php if ($search_title !== '') { ?>

                <h3 class="mkdf-rs-adv-title">
                    <?php echo wp_kses_post($search_title); ?>
                </h3>

            <?php } ?>

            <div class="mkdf-rs-adv-search-filters-items">

                <div class="mkdf-rs-adv-search-filters-holder clearfix">


                    <div class="mkdf-rs-adv-search-filters">
                        <div class="mkdf-rs-adv-search-filters-inner clearfix">
                            <?php

                            //keyword input
                            if ($keyword_flag) {
                                echo mkdf_listing_resume_get_shortcode_module_template_part('templates/keyword', 'resume-advanced-search');
                            }

                            //locations select
                            if ($location_flag) {
                                echo mkdf_listing_resume_get_shortcode_module_template_part('templates/locations', 'resume-advanced-search');
                            }

                            //categories select
                            if ($category_flag) {
                                echo mkdf_listing_resume_get_shortcode_module_template_part('templates/categories', 'resume-advanced-search');
                            }

                            ?>
                        </div>
                    </div>

                    <?php

                    //submit button
                    echo mkdf_listing_resume_get_shortcode_module_template_part('templates/submit', 'resume-advanced-search');

                    ?>

                </div>

                <div class="mkdf-rs-adv-search-items-holder mkdf-normal-space mkdf-adv-search-four-columns clearfix">
                    <div class="mkdf-rs-adv-search-items-holder-inner <?php echo esc_attr($items_classes); ?> clearfix">
                    <?php
                    if ($query_results->have_posts()) {
                        while ($query_results->have_posts()) {
                            $query_results->the_post();
                            $article_obj = new Core\ResumeArticle(get_the_ID());

                            $excerpt = get_the_excerpt(get_the_ID());

//                            $image = ;
//                            var_dump($image);

                            $img_url = get_post_meta(get_the_ID(), '_candidate_photo', true);

                            $img_style = '';
                            if ($img_url !== '') {
                                $img_style = 'background-image: url(' . esc_url($img_url) . ')';
                            }

                            $params = array(
                                'type_html'       => $article_obj->getTaxHtml('resume_type', 'mkdf-resume-type-wrapper'),
                                'cat_html'        => $article_obj->getTaxHtml('resume_category', 'mkdf-resume-cat-wrapper'),
                                'rating_html'     => $article_obj->getResumeAverageRating(),
                                'address_html'    => $article_obj->getAddressIconHtml(true, false),
                                'price_html'      => $article_obj->getPriceHtml(),
                                'price_rate_html' => $article_obj->getPriceRateHtml(),
                                'expire_date_html' => $article_obj->getExpireDateHtml(),
                                'article_obj'     => $article_obj,
                                'excerpt'      => $excerpt,
                                'img_style'    => $img_style,
                            );

                            if($item_type === 'list') {
                                $html .= mkdf_listing_resume_get_shortcode_module_template_part('templates/item-type-list', 'resume-advanced-search', '', $params);
                            } else {
                                $html .= mkdf_listing_resume_get_shortcode_module_template_part('templates/item-type-standard', 'resume-advanced-search', '', $params);
                            }
                        }
                    } else {
                        $html = mkdf_listing_resume_get_shortcode_module_template_part('templates/post-not-found', 'resume-advanced-search');
                    }

                    wp_reset_postdata();
                    print $html; ?>

                    </div>

                    <?php echo mkdf_listing_resume_get_shortcode_module_template_part('templates/load-more-template', 'resume-advanced-search');
                    ?>
                </div>

            </div>
        </div>

        <?php if ($enable_sidebar === 'yes') { ?>
            <aside class="mkdf-rs-adv-search-sidebar-holder mkdf-sidebar">
                <?php staffscout_mikado_get_resume_search_widget_area(); ?>
            </aside>
        <?php } ?>

    </div>
</div>