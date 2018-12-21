<?php
use MikadoListing\Lib\Front;
use MikadoListing\Lib\Core;

$this_object = mkdf_listing_job_list_class_instance();
$query_results = $this_object->getQueryResults();
$holder_classes = $this_object->getBasicParamByKey('holder_classes');
$holder_inner_classes = $this_object->getBasicParamByKey('holder_inner_classes');
$holder_data_params = $this_object->getBasicParamByKey('holder_data_params');
$data_params = $this_object->getBasicParamByKey('data_params');
$image_size = $this_object->getBasicParamByKey('image_size');
$type = $this_object->getBasicParamByKey('type');
$title_tag = $this_object->getBasicParamByKey('title_tag');
$html = ''; ?>

<div class="mkdf-ls-list-holder clearfix">

    <div class="mkdf-ls-list-items-holder clearfix <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data_params, array('data')); ?>>
        <div class="mkdf-ls-list-items-holder-inner mkdf-ls-list-inner <?php echo esc_attr($holder_inner_classes); ?> clearfix" <?php echo staffscout_mikado_get_inline_attrs($data_params); ?>>
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
                        'type_html'    => $article_obj->getTaxHtml('job_listing_type', 'mkdf-listing-type-wrapper'),
                        'cat_html'     => $article_obj->getTaxHtml('job_listing_category', 'mkdf-listing-cat-wrapper'),
                        'rating_html'  => $article_obj->getListingAverageRating(),
                        'address_html' => $article_obj->getAddressIconHtml(true, false),
                        'article_obj'  => $article_obj,
                        'price_html'   => $article_obj->getPriceHtml(),
                        'excerpt'      => $excerpt,
                        'img_style'    => $img_style,
                        'image_size'   => $image_size,
                        'title_tag'   => $title_tag,
                    );

                    $html .= mkdf_listing_job_get_shortcode_module_template_part('templates/item', 'listing-list', $type, $params);
                }
            } else {
                $html = mkdf_listing_job_get_shortcode_module_template_part('templates/post-not-found', 'listing-list');
            }

            wp_reset_postdata();
            print $html;
            ?>
        </div>
        <?php
        echo mkdf_listing_job_get_shortcode_module_template_part('templates/load-more-template', 'listing-list', '', $params);
        ?>
    </div>
</div>