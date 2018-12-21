<div class="mkdf-social-share-holder mkdf-dropdown">
	<a href="javascript:void(0)" target="_self" class="mkdf-social-share-dropdown-opener">
        <span class="mkdf-social-share-title"><?php esc_html_e('Share this', 'mkdf-core') ?></span>
		<i class="social_share"></i>
	</a>
	<div class="mkdf-social-share-dropdown">
		<ul>
			<?php foreach ($networks as $net) {
				echo wp_kses($net, array(
					'li'   => array(
						'class' => true
					),
					'a'    => array(
						'itemprop' => true,
						'class'    => true,
						'href'     => true,
						'target'   => true,
						'onclick'  => true
					),
					'img'  => array(
						'itemprop' => true,
						'class'    => true,
						'src'      => true,
						'alt'      => true
					),
					'span' => array(
						'class' => true
					)
				));
			} ?>
		</ul>
	</div>
</div>