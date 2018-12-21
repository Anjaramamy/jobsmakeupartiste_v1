<?php
use MikadoListing\Lib\Core;
if (have_posts()) :
	while (have_posts()) : the_post();?>
		<div class="mkdf-full-width">
			<div class="mkdf-full-width-inner clearfix">

				<div <?php staffscout_mikado_class_attribute($holder_class); ?>>
					<?php
					if(post_password_required()) {
						echo get_the_password_form();
					} else {
						//load proper listing template
						$article = new Core\ListingArticle(get_the_ID());
						$params  = array(
							'article_obj' => $article
						);

						mkdf_listing_job_single_template_part('single', $listing_template, $params);
					} ?>
				</div>

			</div>
		</div>
	<?php endwhile;
endif;