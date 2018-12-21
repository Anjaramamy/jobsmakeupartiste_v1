<?php
use MikadoResume\Lib\Core;

?>
<div class="mkdf-rs-archive-holder clearfix">

    <div class="mkdf-rs-archive-map-holder">
        <?php echo mkdf_listing_resume_get_resume_multiple_map(); ?>
    </div>

    <div class="mkdf-rs-archive-items-wrapper">

        <div class="mkdf-rs-archive-items-title">
            <h3>
                <?php esc_html_e('Find Your Staff Today!', 'mkdf-listing'); ?>
            </h3>
        </div>

        <?php
        mkdf_listing_resume_get_archive_module_template_part('filter');

        ?>

        <div class="mkdf-rs-archive-items mkdf-normal-space mkdf-rs-archive-two-columns clearfix">
            <div class="mkdf-rs-archive-items-inner mkdf-outer-space clearfix">
                <?php if ($query_results->have_posts()) {

                    while ($query_results->have_posts()) {
                        $query_results->the_post();
                        $article = new Core\ResumeArticle(get_the_ID());
                        $title = strtolower(get_the_title());
                        $title = str_replace(' ', '-', $title);

                        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                        $img_style = '';
                        if ($img_url !== '') {
                            $img_style = 'background-image: url(' . esc_url($img_url) . ')';
                        }

                        $excerpt = get_the_excerpt(get_the_ID());

                        $params = array(
                            'type_html'    => $article->getTaxHtml('resume_type', 'mkdf-resume-type-wrapper'),
                            'rating_html'  => $article->getResumeAverageRating(),
                            'address_html' => $article->getAddressIconHtml(true, false),
                            'price_html'   => $article->getPriceHtml(),
                            'title'        => $title,
                            'img_style'    => $img_style,
                            'excerpt'      => $excerpt,
                        );
                        mkdf_listing_resume_get_archive_module_template_part('single', '', $params);
                    }
                    wp_reset_postdata();
                } else {
                    mkdf_listing_resume_get_archive_module_template_part('post-not-found');
                } ?>
            </div>
        </div>
        <?php
        mkdf_listing_resume_get_archive_module_template_part('load-more-template');
        ?>
    </div>
</div>