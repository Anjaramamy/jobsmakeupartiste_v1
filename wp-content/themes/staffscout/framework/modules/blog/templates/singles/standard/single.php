<?php

staffscout_mikado_get_single_post_format_html($blog_single_type);

do_action('staffscout_mikado_after_article_content');

staffscout_mikado_get_module_template_part('templates/parts/single/single-navigation', 'blog');

staffscout_mikado_get_module_template_part('templates/parts/single/author-info', 'blog');

staffscout_mikado_get_module_template_part('templates/parts/single/related-posts', 'blog', '', $single_info_params);

staffscout_mikado_get_module_template_part('templates/parts/single/comments', 'blog');