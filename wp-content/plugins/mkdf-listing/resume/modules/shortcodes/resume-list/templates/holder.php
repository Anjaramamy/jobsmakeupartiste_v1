<?php
use MikadoResume\Lib\Front;
use MikadoResume\Lib\Core;

$this_object = mkdf_listing_resume_list_class_instance();
$query_results = $this_object->getQueryResults();
$holder_classes = $this_object->getBasicParamByKey('holder_classes');
$holder_inner_classes = $this_object->getBasicParamByKey('holder_inner_classes');
$holder_data_params = $this_object->getBasicParamByKey('holder_data_params');
$data_params = $this_object->getBasicParamByKey('data_params');
$html = '';
$type = $this_object->getBasicParamByKey('type');
$title= $this_object->getBasicParamByKey('title');
$text= $this_object->getBasicParamByKey('text');
?>

<div class="mkdf-rs-list-holder clearfix">

    <div class="mkdf-rs-list-items-holder clearfix <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data_params, array('data')); ?>>
        <?php if ( $type === 'simple' ) { ?>
            <div class="mkdf-rs-list-items-text-holder">
                <div class="mkdf-rs-list-items-text-holder-inner">
                    <?php if(!empty($title)) { ?>
                        <h2 class="mkdf-rs-list-items-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php } ?>
                    <?php if(!empty($text)) { ?>
                        <p class="mkdf-rs-list-items-text">
                            <?php echo $text; ?>
                        </p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <div class="mkdf-rs-list-items-holder-inner mkdf-rs-list-inner <?php echo esc_attr($holder_inner_classes); ?> clearfix" <?php echo staffscout_mikado_get_inline_attrs($data_params); ?>>
            <?php
            if ($query_results->have_posts()) {
                while ($query_results->have_posts()) {
                    $query_results->the_post();
                    $article_obj = new Core\ResumeArticle(get_the_ID());

                    $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                    $img_style = '';
                    if ($img_url !== '') {
                        $img_style = 'background-image: url(' . esc_url($img_url) . ')';
                    }

                    $params = array(
                        'type_html'    => $article_obj->getTaxHtml('resume_type', 'mkdf-resume-type-wrapper'),
                        'cat_html'     => $article_obj->getTaxHtml('resume_category', 'mkdf-resume-cat-wrapper'),
                        'rating_html'  => $article_obj->getResumeAverageRating(),
                        'address_html' => $article_obj->getAddressIconHtml(),
                        'article_obj'  => $article_obj,
                        'price_html'   => $article_obj->getPriceHtml(),
                        'img_style'    => $img_style,
                    );

                    $html .= mkdf_listing_resume_get_shortcode_module_template_part('templates/item', 'resume-list', $type, $params);
                }
            } else {
                $html = mkdf_listing_resume_get_shortcode_module_template_part('templates/post-not-found', 'resume-list');
            }

            wp_reset_postdata();
            echo wp_kses_post($html);
            ?>
        </div>
        <?php
        echo mkdf_listing_resume_get_shortcode_module_template_part('templates/load-more-template', 'resume-list', '', $params);
        ?>
    </div>
</div>