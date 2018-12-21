<?php
use MikadoResume\Lib\Core;
if (have_posts()) :
	while (have_posts()) : the_post();?>
		<div class="mkdf-full-width">
			<div class="mkdf-full-width-inner clearfix">

				<div <?php staffscout_mikado_class_attribute($holder_class); ?>>
					<?php
					if(post_password_required()) {
						echo get_the_password_form();
					} else {
						//load proper resume template
						$article = new Core\ResumeArticle(get_the_ID());
						$params  = array(
							'article_obj' => $article
						);

						mkdf_listing_resume_single_template_part('single', $resume_template, $params);
					} ?>
				</div>

			</div>
		</div>
	<?php endwhile;
endif;