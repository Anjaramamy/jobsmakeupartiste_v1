<?php
use MikadoListing\Lib\Core;
if(!function_exists('mkdf_listing_job_comment_additional_fields')) {

	function mkdf_listing_job_comment_additional_fields() {

		if (is_singular('job_listing')) {
			$html = '<div class="mkdf-rating-form-title-holder">'; //Form title begin
			$html .= '<div class="mkdf-rating-form-title">';
			$html .= '<h5>' . esc_html__('Write a Review','mkdf-listing') . '</h5>';
			$html .= '</div>';
			$html .= '<div class="mkdf-comment-form-rating">
						<label>' . esc_html__('Rate Here', 'mkdf-listing') . '<span class="required">*</span></label>
						<span class="mkdf-comment-rating-box">';
			for ($i = 1; $i <= 5; $i++) {
				$html .= '<span class="mkdf-star-rating" data-value="' . $i . '"></span>';
			}
			$html .= '<input type="hidden" name="mkdf_listing_job_rating" id="mkdf-rating" value="3">';
			$html .= '</span></div>';
			$html .= '</div>'; //Form title end

			$html .= '<div class="mkdf-comment-input-title">';
			$html .= '<input id="title" name="mkdf_listing_job_comment_title" class="mkdf-input-field" type="text" placeholder="' . esc_html__('Title of your Review', 'mkdf-listing') . '"/>';
			$html .= '</div>';

			print $html;
		}
	}

	add_action( 'comment_form_top', 'mkdf_listing_job_comment_additional_fields' );

}

if(!function_exists('mkdf_listing_job_extend_comment_edit_metafields')) {

	function mkdf_listing_job_extend_comment_edit_metafields($comment_id) {

		$comment = get_comment( $comment_id );
		$old_value = get_comment_meta($comment_id, 'mkdf_listing_job_rating', true);
		$post_id = $comment->comment_post_ID ;

		if ((!isset($_POST['extend_comment_update']) || !wp_verify_nonce($_POST['extend_comment_update'], 'extend_comment_update')) && !is_singular('job_listing')) return;

		if ((isset($_POST['mkdf_listing_job_comment_title'])) && ($_POST['mkdf_listing_job_comment_title'] != '')):
			$title = wp_filter_nohtml_kses($_POST['mkdf_listing_job_comment_title']);
			update_comment_meta($comment_id, 'mkdf_listing_job_comment_title', $title);
		else :
			delete_comment_meta($comment_id, 'mkdf_listing_job_comment_title');
		endif;

		if ((isset($_POST['mkdf_listing_job_rating'])) && ($_POST['mkdf_listing_job_rating'] != '')){
			$new_rating = wp_filter_nohtml_kses($_POST['mkdf_listing_job_rating']);
			update_comment_meta($comment_id, 'mkdf_listing_job_rating', $new_rating);

			$rating_obj = new Core\ListingRating($post_id, $new_rating, 'edit_rating', $old_value);
			$rating_obj->editRating();
		}
		else {
			delete_comment_meta($comment_id, 'mkdf_listing_job_rating');
		}
	}

	add_action('edit_comment', 'mkdf_listing_job_extend_comment_edit_metafields');
}

if(!function_exists('mkdf_listing_job_extend_comment_add_meta_box')) {

	function mkdf_listing_job_extend_comment_add_meta_box() {
		add_meta_box('title', esc_html__('Comment - Reviews', 'mkdf-listing'), 'mkdf_listing_job_extend_comment_meta_box', 'comment', 'normal', 'high');
	}

	add_action('add_meta_boxes_comment', 'mkdf_listing_job_extend_comment_add_meta_box');

}

if(!function_exists('mkdf_listing_job_extend_comment_meta_box')) {

	function mkdf_listing_job_extend_comment_meta_box($comment) {

		if ($comment->post_type == 'job_listing') {
			$title = get_comment_meta($comment->comment_ID, 'mkdf_listing_job_comment_title', true);
			$rating = get_comment_meta($comment->comment_ID, 'mkdf_listing_job_rating', true);
			wp_nonce_field('extend_comment_update', 'extend_comment_update', false);
			?>
			<p>
				<label for="title"><?php esc_html_e('Comment Title', 'mkdf-listing'); ?></label>
				<input type="text" name="mkdf_listing_job_comment_title" value="<?php echo esc_attr($title); ?>" class="widefat"/>
			</p>
			<p>
				<label for="rating"><?php esc_html_e('Rating', 'mkdf-listing'); ?>: </label>
				<span class="commentratingbox">
					<?php
					for ($i = 1; $i <= 5; $i++) {
						echo '<span class="commentrating"><input type="radio" name="mkdf_listing_job_rating" id="rating" value="' . $i . '"';
						if ($rating == $i) echo ' checked="checked"';
						echo ' />' . $i . ' </span>';
					}
					?>
				</span>
			</p>
			<?php
		}
	}
}

if(!function_exists('mkdf_listing_job_save_comment_meta_data')) {

	function mkdf_listing_job_save_comment_meta_data($comment_id) {

		$comment = get_comment( $comment_id );
		$post_id = $comment->comment_post_ID;

		if ((isset($_POST['mkdf_listing_job_comment_title'])) && ($_POST['mkdf_listing_job_comment_title'] != '')) {
			$title = wp_filter_nohtml_kses($_POST['mkdf_listing_job_comment_title']);
			add_comment_meta($comment_id, 'mkdf_listing_job_comment_title', $title);
		}

		if ((isset($_POST['mkdf_listing_job_rating'])) && ($_POST['mkdf_listing_job_rating'] != '')) {
			$rating = wp_filter_nohtml_kses($_POST['mkdf_listing_job_rating']);
			add_comment_meta($comment_id, 'mkdf_listing_job_rating', $rating);

			$rating_obj = new Core\ListingRating($post_id, $rating);
			$rating_obj->increaseRating();

		}

	}

	add_action('comment_post', 'mkdf_listing_job_save_comment_meta_data');

}

if(!function_exists('mkdf_listing_job_verify_comment_meta_data')) {

	function mkdf_listing_job_verify_comment_meta_data($commentdata) {

		if ( is_singular('job_listing') ) {
			if (!isset($_POST['mkdf_listing_job_rating'])) {
				wp_die(esc_html__('Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.', 'mkdf-listing'));
			}
		}
		return $commentdata;
	}

	add_filter('preprocess_comment', 'mkdf_listing_job_verify_comment_meta_data');

}


if(!function_exists('mkdf_listing_job_get_current_post_comments')){

	function mkdf_listing_job_get_current_post_comments($post_id, $order_by = 'comment_date_gmt' , $order = 'desc'){

		$meta_key  = '';
		if($order_by === 'rating'){
			$order_by = 'meta_value';
			$meta_key  = 'mkdf_listing_job_rating';
		}elseif($order_by === 'date'){
			$order_by = 'comment_date_gmt';
		};

		$comment_args = array(
			'post_id' => $post_id,
			'status' => 'approve',
			'orderby' => $order_by,
			'meta_key'  => $meta_key,
			'order' => $order
		);
		if ( is_user_logged_in() ) {
			$comment_args['include_unapproved'] = get_current_user_id();
		} else {
			$commenter = wp_get_current_commenter();
			if ( $commenter['comment_author_email'] ) {
				$comment_args['include_unapproved'] = $commenter['comment_author_email'];
			}
		}

		$comments  = get_comments($comment_args);
		return $comments;

	}
}

if ( ! function_exists( 'mkdf_listing_job_post_reviews_html' ) ) {

	function mkdf_listing_job_post_reviews_html($reviews = array(), $post_id) {

		$post = get_post($post_id);
		$html = '';

		if(count($reviews)){

			foreach ($reviews as $comment){

				$is_pingback_comment = $comment->comment_type == 'pingback';
				$is_author_comment  = $post->post_author == $comment->user_id;

				$comment_class = 'mkdf-comment clearfix';

				if($is_author_comment) {
					$comment_class .= ' mkdf-post-author-comment';
				}

				if($is_pingback_comment) {
					$comment_class .= ' mkdf-pingback-comment';
				}
				$review_rating = get_comment_meta( $comment->comment_ID, 'mkdf_listing_job_rating', true );
				$review_rating_style  = 'width: '.esc_attr($review_rating*20).'%';
				$review_title = get_comment_meta( $comment->comment_ID, 'mkdf_listing_job_comment_title', true );

				$comment_params = array(
					'comment'   => $comment,
					'is_pingback_comment' => $is_pingback_comment,
					'is_author_comment' => $is_author_comment,
					'comment_class' => $comment_class,
					'review_rating_style' => $review_rating_style,
					'review_title' => $review_title,
				);
				$html .= mkdf_listing_job_single_template_part('review/review', '', $comment_params);

			}
		}
		return $html;
	}
}

if(!function_exists('mkdf_listing_job_get_post_reviews_ajax')){

	function mkdf_listing_job_get_post_reviews_ajax(){

		if(isset($_POST)) {
			$html = '';

			foreach($_POST as $key => $value) {
				if($key !== '') {
					$addUnderscoreBeforeCapitalLetter  = preg_replace('/([A-Z])/', '_$1', $key);
					$setAllLettersToLowercase          = strtolower($addUnderscoreBeforeCapitalLetter);
					$params[$setAllLettersToLowercase] = $value;
				}
			}
			extract($params);
			if(isset($order) && $order !== '' && isset($order_by) && $order_by !== '' && isset($post_id) && $post_id !== ''){
				$post_comments = mkdf_listing_job_get_current_post_comments($post_id, $order_by, $order );
				ob_start();
				mkdf_listing_job_post_reviews_html($post_comments, $post_id);
				$html = ob_get_clean();
			}

			$return_obj = array(
				'html' => $html
			);
			echo json_encode($return_obj); exit;
		}

	}

	add_action('wp_ajax_nopriv_mkdf_listing_job_get_post_reviews_ajax', 'mkdf_listing_job_get_post_reviews_ajax');
	add_action( 'wp_ajax_mkdf_listing_job_get_post_reviews_ajax', 'mkdf_listing_job_get_post_reviews_ajax' );
}