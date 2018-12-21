<?php
namespace MikadoResume\Lib\Core;

class ResumeQuery
{

    private $query_results;
    private $query_array;
    private $query_meta_array;
	private $post_number;
    private $resume_type_id;
    private $category_array;
    private $meta_query_flag;
    private $checkbox_meta_params;
    private $default_meta_params;
    private $next_page;
    private $user_id;
    private $post_status;
    private $keyword;
    private $post__in;
    private $post__not_in;
    private $tag;
    private $location;
    private $tax_query;
    private $location_object;

    public function __construct($resume_type_id = '', $post_number = '-1', $category_array = array(), $meta_query_flag = false, $checkbox_meta_params = array(), $default_meta_params = array(), $next_page = '', $user_id = '', $post_status = 'publish', $keyword = '', $post__in = array(), $post__not_in = array(), $tag = '', $location = '', $tax_query = array(), $location_object = array()) {

        $this->resume_type_id = $resume_type_id;
        $this->post_number = $post_number;
        $this->category_array = $category_array;
        $this->meta_query_flag = $meta_query_flag;
        $this->checkbox_meta_params = $checkbox_meta_params;
        $this->default_meta_params = $default_meta_params;
        $this->next_page = $next_page;
        $this->user_id = $user_id;
        $this->post_status = $post_status;
        $this->keyword = $keyword;
        $this->post__in = $post__in;
        $this->post__not_in = $post__not_in;
        $this->tag = $tag;
        $this->location = $location;
        $this->tax_query = $tax_query;
        $this->location_object = $location_object;

        $this->generateQueryArray();
        $this->setQueryResults();

    }


    private function generateQueryArray() {

        $this->query_array = array(
            'post_status'      => $this->post_status,
            'post_type'        => 'resume',
            'posts_per_page'   => (int)$this->post_number,
            'suppress_filters' => 0
        );

        if ($this->user_id !== '') {
            $this->query_array['author'] = $this->user_id;
        }
        if ($this->keyword !== '') {
            $this->query_array['s'] = $this->keyword;
        }

        if (!empty($this->resume_type_id)) {
            $this->query_array['tax_query'][] = array(
                'taxonomy' => 'resume_type',
                'field'    => 'term_id',
                'terms'    => $this->resume_type_id
            );
        }

        if (count($this->category_array)) {
            $this->query_array['tax_query'][] = array(
                'taxonomy' => 'resume_category',
                'field'    => 'slug',
                'terms'    => $this->category_array
            );
        }

        if ($this->tag !== '') {
            $this->query_array['tax_query'][] = array(
                'taxonomy' => 'resume_tag',
                'field'    => 'term_id',
                'terms'    => (int)$this->tag
            );
        }

        if ($this->location !== '') {
            $this->query_array['tax_query'][] = array(
                'taxonomy' => 'resume_region',
                'field'    => 'term_id',
                'terms'    => (int)$this->location
            );
        }

        if (count($this->tax_query)) {
            $this->query_array['tax_query'][] = array(
                'taxonomy' => $this->tax_query['tax_id'],
                'field'    => 'slug',
                'terms'    => $this->tax_query['tax_slug_array']
            );
        }

        if (count($this->post__in)) {
            $this->query_array['post__in'] = $this->post__in;
        }
        if (count($this->post__not_in)) {
            $this->query_array['post__not_in'] = $this->post__not_in;
        }

        if ($this->meta_query_flag) {

            $meta_query_fields = array(
                'relation' => 'AND'
            );

            if (count($this->checkbox_meta_params)) {
                foreach ($this->checkbox_meta_params as $param_key => $param_value) {
                    if ($param_value === 'true') {
                    	$meta_query_fields[] = array(
                            'key'   => $param_key,
                            'value' => '1' //amenities has value 1 or 0
                        );
                    }
                    
                    if ( ! empty( $param_value ) && $param_value !== 'true' ) {
	                    $meta_query_fields[] = array(
		                    'key'   => $param_key,
		                    'value' => $param_value,
		                    'compare' => '='
	                    );
                    }
                }
            }
            
            if (count($this->default_meta_params)) {

                foreach ($this->default_meta_params as $param_key => $param_value) {

                    if ($param_value !== '') {
                        if ($param_key === 'price_max') {
                            $meta_query_fields[] = array(
                                'key'     => '_resume_price',
                                'value'   => $param_value,
                                'type'    => 'numeric',
                                'compare' => '<='
                            );
                        } elseif ($param_key === 'price_min') {
                            array(
                                'key'     => '_resume_price',
                                'value'   => $param_value,
                                'type'    => 'numeric',
                                'compare' => '=>'
                            );
                        } elseif ($param_key === 'price_both_values') {
                            array(
                                'key'     => '_resume_price',
                                'value'   => array($param_key['min'], $param_key['max']),
                                'type'    => 'numeric',
                                'compare' => 'BETWEEN'
                            );
                        } elseif ($param_key === 'order') {
	                        $this->query_array['order'] = $param_value;
                        } elseif ($param_key === 'orderby') {
	                        $this->query_array['orderby'] = $param_value;
                        } else {
                            $meta_query_fields[] = array(
                                'key'   => $param_key,
                                'value' => $param_value
                            );
                        }
                    }
                }
            }
            
            $this->query_meta_array[] = $meta_query_fields;
            $this->query_array['meta_query'] = $this->query_meta_array;

        }

        //generate paged param
        if ($this->next_page !== '') {
            $this->query_array['paged'] = (int)$this->next_page;
        } else {
            $this->query_array['paged'] = 1;
        }
    }

    private function setQueryResults() {

        if (isset($this->location_object['dist']) && isset($this->location_object['lat']) && isset($this->location_object['long'])) {

            //we need to get all resumes, not just posts from first pagination page
            $this->query_array['posts_per_page'] = '-1';

            $query = new \WP_Query($this->query_array);

            $lat = $this->location_object['lat'];
            $long = $this->location_object['long'];
            $dist = $this->location_object['dist'];
            $posts = $query->get_posts();
            $post_in = $post_not_in = $posts_to_check = array();

            if ($posts && count($posts)) {
                foreach ($posts as $post) {
                    $posts_to_check[$post->ID] = $post->post_title;
                }
            }

            //get hide and show arrays
            $geo_location_answer = mkdf_listing_resume_check_distance($lat, $long, $dist, $posts_to_check);


            if (isset($geo_location_answer['hide_items'])) {

                if (count($geo_location_answer['hide_items'])) {
                    $this->query_array['post__not_in'] = $geo_location_answer['hide_items'];
                }

            }

            if (isset($geo_location_answer['show_items'])) {

                if (count($geo_location_answer['show_items'])) {
                    $this->query_array['post_in'] = $geo_location_answer['show_items'];
                }

            }

            //set post_per_page like it should be
            $this->query_array['posts_per_page'] = $this->post_number;

            //finally get real query results
            $this->query_results = new \WP_Query($this->query_array);

        } else {
            $this->query_results = new \WP_Query($this->query_array);
        }
    }

    public function getQueryResults() {
        return $this->query_results;
    }

    public function getQueryResultsArray() {
        $resume_array = array();

        if ($this->query_results->have_posts()) {
            while ($this->query_results->have_posts()) {
                $this->query_results->the_post();
                $resume_array[get_the_ID()] = get_the_title();
            }
            wp_reset_postdata();
        }

        return $resume_array;

    }


}

class ResumeRating
{

    private $post_id;
    private $rating_value;
    private $average_rate;
    private $old_value;

    public function __construct($post_id, $rating_value = false, $action = '', $old_value = '') {

        $this->post_id = $post_id;
        $this->rating_value = $rating_value;
        $this->update_flag = true;
        $this->old_value = $old_value;

        switch ($action) {
            case 'get_average_rating':
                $this->setAverageRating();
                break;
            case 'set_new_rating':
                $this->increaseRating();
                break;
            case 'edit_rating':
                $this->editRating();
                break;
        }

    }

    public function increaseRating() {
        $this->updateRateNumber();
        $this->updateRateCount();
    }

    public function editRating() {

        $new_value = (int)$this->getRateCount() - (int)$this->old_value + (int)$this->rating_value;
        $this->setRateCount($new_value);

    }


    public function setAverageRating() {

        $rating_value = $this->getRateCount();
        $number_of_rates = $this->getRateNumber();

        if ($rating_value == '' || $number_of_rates == '') {
            $this->average_rate = 0;
        }

        if ($number_of_rates > 0 && $rating_value > 0) {
            $this->average_rate = round($rating_value / ($number_of_rates), 2);
        }

    }

    public function getAverageRating() {
        return $this->average_rate;
    }

    private function updateRateNumber($action = 'plus') {

        $current_rates = $this->getRateNumber();

        if ($current_rates === '') {
            $current_rates = 1;
        } else {
            $current_rates++;
        }

        $this->setRateNumber($current_rates);

    }

    private function getRateNumber() {
        return get_post_meta($this->post_id, 'mkdf_listing_resume_post_rating_number', true);
    }

    private function setRateNumber($count) {
        update_post_meta($this->post_id, 'mkdf_listing_resume_post_rating_number', $count);
    }

    private function updateRateCount() {

        $rating_value = $this->getRateCount();


        if ($rating_value === '') {
            $rating_value = $this->rating_value;
        } else {
            $rating_value += $this->rating_value;
        }

        $this->setRateCount($rating_value);

    }

    private function getRateCount() {
        return get_post_meta($this->post_id, 'mkdf_listing_resume_post_rating_value', true);
    }

    private function setRateCount($value) {
        update_post_meta($this->post_id, 'mkdf_listing_resume_post_rating_value', $value);
    }

    public function getRatingHtml($show_number = true) {

        //20* average rating in order to get actual percentages(average rating go from 0 to 5)
        $width = 20 * $this->getAverageRating();
        $style = 'width: ' . $width . '%';

        if ($width == '' && $width == 0) {
            return;
        }
        ?>
        <div class="mkdf-resume-rating-holder">

            <meta itemprop="ratingValue" content="<?php echo esc_attr($this->getAverageRating()); ?>">

            <?php if ($show_number) { ?>
                <div class="mkdf-average-rating">
					<span>
						<?php echo esc_attr($this->getAverageRating()); ?>
					</span>
                </div>
            <?php } ?>

            <div class="mkdf-resume-rating-stars-holder">
                <span class="mkdf-rating-stars" <?php echo staffscout_mikado_get_inline_style($style) ?>></span>
            </div>

        </div>
        <?php
    }

}

class ResumeViews
{

    private $post_id;
    private $user_address;
    private $cookie_name;

    public function __construct($post_id, $user_address = '') {

        $this->post_id = $post_id;
        $this->user_address = $user_address;
        $this->cookie_name = 'mkdf_listing_resume_single_id_' . $this->post_id;

    }

    public function setCountValue() {

        if ($this->isSetCookie()) {
            return;
        } else {
            $this->updateTotalCount();
        }

    }

    public function isSetCookie() {

        $flag = false;

        if (isset($_COOKIE[$this->cookie_name])) {
            $flag = true;
        }

        return $flag;

    }

    public function setCookie() {
        if (!$this->isSetCookie()) {
            setcookie($this->cookie_name, $this->cookie_name, time() * 20, '/');
        }
    }

    private function updateTotalCount() {

        $current_count = $this->getViewCount();

        if ($current_count == '') {
            $current_count = 1;
        } else {
            $current_count++;
        }
        $this->setViewCount($current_count);

    }

    public function getViewCount() {
        return get_post_meta($this->post_id, 'mkdf_listing_resume_post_view_count', true);
    }

    private function setViewCount($value) {
        update_post_meta($this->post_id, 'mkdf_listing_resume_post_view_count', $value);
    }

}

class ResumeArticle
{

    private static $instance;
    private $post_id;
    private $post_type;

    public function __construct($post_id) {
        $this->post_id = $post_id;
        $this->setPostType();
    }

    /**
     * Returns current instance of class
     * @return ResumeArticle
     */
    public static function getInstance() {
        if (self::$instance == null) {
            return new self;
        }

        return self::$instance;
    }

    /**
     * Make sleep magic method private, so nobody can serialize instance.
     */

    private function __clone() {
    }

    /**
     * Make sleep magic method private, so nobody can serialize instance.
     */
    private function __sleep() {
    }

    /**
     * Make wakeup magic method private, so nobody can unserialize instance.
     */
    private function __wakeup() {
    }

    private function setPostType() {
        $this->post_type = get_post_type($this->post_id);
    }

    private function getPostType() {
        return $this->post_type;
    }

    public function getTaxArray($taxonomy) {

        $tax_array = array();
        $taxes = wp_get_object_terms($this->post_id, $taxonomy);

        if (is_array($taxes) && count($taxes)) {
            foreach ($taxes as $tax) {

                $tax_array[] = array(
                    'id'        => $tax->term_id,
                    'name'      => $tax->name,
                    'link'      => get_term_link($tax->term_id, $taxonomy),
                    'icon_html' => mkdf_listing_resume_get_resume_taxonomy_icon_html($tax->term_id)
                );

            }
        }
        return $tax_array;
    }


    public function getPostMeta($post_meta) {

        $meta_field_value = get_post_meta($this->post_id, $post_meta, true);
        return $meta_field_value;

    }

    public function getTaxHtml($taxonomy, $custom_css_class = '') {

        $html = '';
        $taxes = $this->getTaxArray($taxonomy);

        if (count($taxes)) {
            $html .= '<div class="mkdf-tax-wrapper ' . esc_attr($custom_css_class) . '">';
            foreach ($taxes as $tax) {

                $html .= '<a href="' . esc_url($tax['link']) . '">';

                if ($tax['icon_html'] !== '') {
                    $html .= '<span class="mkdf-tax-icon">';
                    $html .= $tax['icon_html'];
                    $html .= '</span>';
                }

                $html .= '<span class="mkdf-tax-name">' . esc_attr($tax['name']) . '</span>';
                $html .= '</a>';
            }
            $html .= '</div>';
        }
        return $html;
    }

    public function getResumeAverageRating($show_number = true) {

        ob_start();
        $rating_obj = new ResumeRating($this->post_id, false, 'get_average_rating');
        $rating_obj->getRatingHtml($show_number);
        $html = ob_get_clean();

        return $html;
    }

    public function getAddressIconHtml($show_icon = true, $show_label = true) {

        $params_address = mkdf_listing_resume_get_address_params($this->post_id);
        $city = $this->getPostMeta('geolocation_city');

        extract($params_address);
        $html = '';
        $get_directions_link = '';

        if ($address_lat !== '' && $address_long !== '') {
            $get_directions_link = '//maps.google.com/maps?daddr=' . $address_lat . ',' . $address_long;
        }

        if ($get_directions_link !== '' && $show_icon) {
            $html .= '<div class="mkdf-rs-adr-pin">';
            $html .= '<a href="' . $get_directions_link . '" target="_blank">';
            $html .= staffscout_mikado_icon_collections()->renderIcon('dripicons-location', 'dripicons');
            $html .= '</a>';
            $html .= '</div>';
        }

        if ($city !== '') {
            $html .= '<div class="mkdf-rs-adr-city">';
            if ($show_label) {
                $html .= '<span>' . esc_html__('In ', 'mkdf-listing') . '</span>';
            }
            if ($get_directions_link !== '' && !$show_icon) {
                $html .= '<a href="' . $get_directions_link . '" target="_blank">';
            }
            $html .= '<span class="mkdf-city">' . esc_html($city) . '</span>';
            if ($get_directions_link !== '' && !$show_icon) {
                $html .= '</a>';
            }
            $html .= '</div>';
        }

        return $html;

    }

    public function getPriceHtml() {
        $price_html = '';

        $price = $this->getPostMeta('_resume_price');

        if (($price && $price !== '')) {

            $price_html .= '<div class="mkdf-rs-price-holder">';
            if ($price && $price !== '') {
                $price_html .= '<span class="mkdf-rs-price-amount">';
                $price_html .= esc_attr('$') . esc_attr($price);
                $price_html .= '</span>';
            }

            $price_html .= '</div>';
        }

        return $price_html;
    }

    public function getPriceRateHtml() {
        $price_rate_html = '';

        $price_rate = $this->getPostMeta('_resume_rate');

        if (($price_rate && $price_rate !== '')) {

            $price_rate_html .= '<div class="mkdf-rs-price-rate-holder">';
            if ($price_rate && $price_rate !== '') {
                $price_rate_html .= '<span class="mkdf-rs-price-rate-amount">';
                $price_rate_html .= esc_attr('$') . esc_attr($price_rate);
                $price_rate_html .= '</span>';
            }

            $price_rate_html .= '</div>';
        }

        return $price_rate_html;
    }

    public function getExpireDateHtml() {
        $expire_date_html = '';

        $expire_date = $this->getPostMeta('_job_expires');

        $date_format = get_option('job_manager_date_format');

        if ($date_format === 'default') {
            $display_date = date_i18n(get_option('date_format'), get_post_time('U'));
        } else {
            $display_date = human_time_diff(get_post_time('U'), current_time('timestamp'));
        }

        $expire_date_format = $display_date;

        if (($expire_date && $expire_date !== '')) {

            $expire_date_html .= '<div class="mkdf-rs-expire-date-holder">';
            if ($expire_date && $expire_date !== '') {
                $expire_date_html .= '<span class="mkdf-rs-expire-date-inner">';
                $expire_date_html .= esc_attr($expire_date_format);
                $expire_date_html .= '</span>';
            }

            $expire_date_html .= '</div>';
        }

        return $expire_date_html;
    }

    public function getFeaturedImageDiv() {
        $image_html = '';
        $image_html .= '<div class="mkdf-as-item-image"';
        $image_html .= ' style="background-image:url(';
        $image_html .= wp_get_attachment_image_url(get_post_thumbnail_id($this->post_id), 'full');
        $image_html .= ')">';
        $image_html .= '</div>';

        return $image_html;
    }

}

class ResumeTitleGlobalVar
{

    private $type;

    public function __construct($type = '') {

        $this->type = $type;
        $this->generateGlobalVar();

    }

    public function generateGlobalVar() {

        $resume_posts = $params = array();

        if ($this->type !== '') {
            $params['type'] = $this->type;
        }

        $query_results = mkdf_listing_resume_get_resume_query_results($params);

        if ($query_results->have_posts()) {
            while ($query_results->have_posts()) {
                $query_results->the_post();
                $resume_posts[] = get_the_title();
            }
            wp_reset_postdata();
        }

        $resume_posts = apply_filters('mkdf_listing_resume_filter_js_resume_variables', $resume_posts);

        wp_localize_script('staffscout_mikado_modules', 'mkdfResumeTitles', array(
            'titles' => $resume_posts
        ));
    }

}

class ResumeRelatedPosts
{

    private $post_id;
    private $post_type;
    private $tax_array;

    public function __construct($post_id, $tax_array = array()) {
        $this->post_id = $post_id;
        $this->tax_array = $tax_array;
        $this->setPostType();
    }

    private function setPostType() {
        $this->post_type = get_post_type($this->post_id);
    }

    private function getPostType() {
        return $this->post_type;
    }

    public function getRelatedPosts() {

        $post_taxes = $this->getTaxesByPriority();
        $related_posts = false;

        if (count($post_taxes)) {
            foreach ($post_taxes as $tax_key => $tax_prior) {

                if (taxonomy_exists($tax_key)) {
                    $current_post_tax_array = $this->getRelatedPostsByTax($tax_key);
                    if (count($current_post_tax_array)) {
                        $related_posts = $this->getPosts($tax_key, $current_post_tax_array);
                    }
                    if ($related_posts) {
                        return $related_posts;
                    }
                }

            }
        }
    }

    private function getTaxesByPriority() {

        $tax_prior_array = array();

        if (count($this->tax_array)) {

            foreach ($this->tax_array as $tax_obj) {
                $tax_prior_array[$tax_obj['id']] = $tax_obj['priority'];
            }
            array_multisort($tax_prior_array, SORT_ASC, $this->tax_array);

        }
        return $tax_prior_array;

    }

    private function getRelatedPostsByTax($tax_key) {
        //in this case, function wp_get_object_terms will always return array, because we check in a step before if taxonomy exists
        $taxes = wp_get_object_terms($this->post_id, $tax_key);
        $tax_array = array();

        if (count($taxes)) {
            foreach ($taxes as $tax) {
                $tax_array[] = $tax->slug;
            }
        }

        return $tax_array;
    }

    private function getPosts($tax_key, $post_taxes) {

        if ($this->post_type === 'resume') {
            $params = array(
                'tax_array'   => array(
                    'tax_id'         => $tax_key,
                    'tax_slug_array' => $post_taxes
                ),
                'post_not_in' => array($this->post_id)
            );
            return mkdf_listing_resume_get_resume_query_results($params);
        } else {
            $args = array(
                'post_not_in' => array($this->post_id),
                'order'       => 'DESC',
                'orderby'     => 'date',
                'tax_query'   => array(
                    array(
                        'taxonomy' => $tax_key,
                        'field'    => 'term_id',
                        'terms'    => $post_taxes,
                    ),
                )
            );
            $related_posts = new \WP_Query($args);

            return $related_posts;

        }

    }
}