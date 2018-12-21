<?php
use MikadoListing\Lib\Core;

?>
<div class="mkdf-ls-archive-holder clearfix">

    <div class="mkdf-ls-archive-map-holder">
        <?php echo mkdf_listing_job_get_listing_multiple_map(); ?>
    </div>

    <div class="mkdf-ls-archive-items-wrapper">

        <div class="mkdf-ls-archive-items-title">
            <h3>
                <?php esc_html_e('Find Your Dream Job', 'mkdf-listing'); ?>
            </h3>
        </div>

        <?php
        mkdf_listing_job_get_archive_module_template_part('filter');

        ?>

        <div class="mkdf-ls-archive-items mkdf-normal-space mkdf-ls-archive-two-columns clearfix">
            <div class="mkdf-ls-archive-items-inner mkdf-outer-space clearfix">
                <?php if ($query_results->have_posts()) {

                    while ($query_results->have_posts()) {
                        $query_results->the_post();
                        $article = new Core\ListingArticle(get_the_ID());
                        $title = strtolower(get_the_title());
                        $title = str_replace(' ', '-', $title);

                        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                        $img_style = '';
                        if ($img_url !== '') {
                            $img_style = 'background-image: url(' . esc_url($img_url) . ')';
                        }

                        $excerpt = get_the_excerpt(get_the_ID());

                        $params = array(
                            'type_html'    => $article->getTaxHtml('job_listing_type', 'mkdf-listing-type-wrapper'),
                            'rating_html'  => $article->getListingAverageRating(),
                            'address_html' => $article->getAddressIconHtml(true, false),
                            'price_html'   => $article->getPriceHtml(),
                            'title'        => $title,
                            'img_style'    => $img_style,
                            'excerpt'      => $excerpt,
                        );
                        mkdf_listing_job_get_archive_module_template_part('single', '', $params);
                    }
                    wp_reset_postdata();
                } else {
                    mkdf_listing_job_get_archive_module_template_part('post-not-found');
                } ?>
            </div>
        </div>
        <?php
        mkdf_listing_job_get_archive_module_template_part('load-more-template');
        ?>
    </div>
</div>