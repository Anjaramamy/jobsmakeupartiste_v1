<?php
use MikadoResume\Lib\Front;
use MikadoResume\Lib\Core;
use  MikadoResume\Maps;

if (!function_exists('mkdf_listing_resume_type_get_custom_fields')) {

    function mkdf_listing_resume_type_get_custom_fields() {
        $type_id = $post_id = '';
        $html = '';

        if (isset($_POST['selectedType'])) {
            $type_id = $_POST['selectedType'];

            if (isset($_POST['currentPostId']) && $_POST['currentPostId'] && $_POST['currentPostId'] !== 'false') {
                $post_id = $_POST['currentPostId'];
            }

            if ($type_id !== '') {
                ob_start();
                $object = new Front\ResumeTypeFieldCreator($type_id, $post_id);
                $object->renderResumeFormFields();
                $html .= ob_get_clean();
            }
        }

        $return_obj = array(
            'html' => $html
        );

        echo json_encode($return_obj);
        exit;
    }

    add_action('wp_ajax_nopriv_mkdf_listing_resume_type_get_custom_fields', 'mkdf_listing_resume_type_get_custom_fields');
    add_action('wp_ajax_mkdf_listing_resume_type_get_custom_fields', 'mkdf_listing_resume_type_get_custom_fields');
}


if (!function_exists('mkdf_listing_resume_get_archive_search_response')) {

    function mkdf_listing_resume_get_archive_search_response() {

        $search_params = array();
        $multiple_map_vars = array();
        $html = '';
        $max_num_pages = '';
        $found_posts = '';

        $post_in_array = $post_not_in_array = $locationObject = array();

        if (isset($_POST)) {
            if (isset($_POST['searchParams'])) {
                $search_params = $_POST['searchParams'];
            }
            extract($search_params);

            $next_page = '';
            //just if is load more button clicked, take nextPage from params
            if ($enableLoadMore !== 'false') {
                $next_page = $search_params['nextPage'];
            }

            $cat_array = array();
            if (is_array($category) && count($category)) {
                foreach ($category as $cat_id => $cat_value) {
                    $cat_array[] = $cat_id;
                }
            }


            $meta_query_flag = false;
            if (count($customFields)) {
                $meta_query_flag = true;
            }

            $type_array = array();
            if (is_array($type) && count($type)) {
                foreach ($type as $type_id => $type_value) {
                    $type_array[] = $type_id;
                }
            }

            $query_params = array(
                'type'                => $type_array,
                'category_array'      => $cat_array,
                'keyword'             => $keyword,
                'post_in'             => $post_in_array,
                'post_not_in'         => $post_not_in_array,
                'tag'                 => $tag,
                'location'            => $location,
                'post_number'         => $number,
                'meta_query_flag'     => $meta_query_flag,
                'default_meta_params' => $customFields,
                'next_page'           => $next_page,
                'location_object'     => $locationObject
            );

            $query_results = mkdf_listing_resume_get_resume_query_results($query_params);

            $max_num_pages = $query_results->max_num_pages;
            $found_posts = $query_results->found_posts;

            if ($query_results->have_posts()) {
                while ($query_results->have_posts()) {
                    $query_results->the_post();

                    $article = new Core\ResumeArticle(get_the_ID());
                    $title = strtolower(get_the_title());
                    $title = str_replace(' ', '-', $title);

                    $excerpt = get_the_excerpt(get_the_ID());

                    $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                    $img_style = '';
                    if ($img_url !== '') {
                        $img_style = 'background-image: url(' . esc_url($img_url) . ')';
                    }

                    $params = array(
                        'rating_html'  => $article->getResumeAverageRating(),
                        'address_html' => $article->getAddressIconHtml(true, false),
                        'price_html'   => $article->getPriceHtml(),
                        'type_html'    => $article->getTaxHtml('resume_type', 'mkdf-resume-type-wrapper'),
                        'cat_html'     => $article->getTaxHtml('resume_category', 'mkdf-resume-cat-wrapper'),
                        'title'        => $title,
                        'img_style'    => $img_style,
                        'excerpt'      => $excerpt,
                    );

                    ob_start();
                    mkdf_listing_resume_get_archive_module_template_part('single', '', $params);
                    $html .= ob_get_clean();
                }
                wp_reset_postdata();
            } else {
                ob_start();
                mkdf_listing_resume_get_archive_module_template_part('archive/templates/post-not-found');
                $html = ob_get_clean();
            }

            $map_var_obj = new Maps\MapGlobalVars('multiple', '', $query_results);
            $multiple_map_vars = $map_var_obj->getMultipleVars();

            $return_obj = array(
                'html'         => $html,
                'maxNumPages'  => $max_num_pages,
                'mapAddresses' => $multiple_map_vars,
                'foundPosts'   => $found_posts
            );
            echo json_encode($return_obj);
            exit;
        }

    }

    add_action('wp_ajax_nopriv_mkdf_listing_resume_get_archive_search_response', 'mkdf_listing_resume_get_archive_search_response');
    add_action('wp_ajax_mkdf_listing_resume_get_archive_search_response', 'mkdf_listing_resume_get_archive_search_response');
}

if (!function_exists('mkdf_listing_resume_get_main_search_response')) {

    function mkdf_listing_resume_get_main_search_response() {

        $keyword = $type = $salary = '';
        $params = array();

        if (isset($_POST)) {

            foreach ($_POST as $key => $value) {
                if ($key !== '') {
                    $addUnderscoreBeforeCapitalLetter = preg_replace('/([A-Z])/', '_$1', $key);
                    $setAllLettersToLowercase = strtolower($addUnderscoreBeforeCapitalLetter);
                    $params[$setAllLettersToLowercase] = $value;
                }
            }
            extract($params);
            $href_attr = mkdf_listing_resume_build_query_string($keyword, $type, $salary);

            $return_obj = array(
                'href' => $href_attr
            );

            echo json_encode($return_obj);
            exit;
        }

    }

    add_action('wp_ajax_nopriv_mkdf_listing_resume_get_main_search_response', 'mkdf_listing_resume_get_main_search_response');
    add_action('wp_ajax_mkdf_listing_resume_get_main_search_response', 'mkdf_listing_resume_get_main_search_response');
}

if (!function_exists('mkdf_listing_resume_send_resume_item_enquiry')) {

    function mkdf_listing_resume_send_resume_item_enquiry() {
        if (isset($_POST['data'])) {

            $error = false;
            $responseMessage = '';

            $email_data = $_POST['data'];
            $nonce = $email_data['nonce'];

            if (wp_verify_nonce($nonce, 'mkdf_listing_resume_validate_resume_item_enquiry')) {

                //Validate
                if ($email_data['name']) {
                    $name = esc_html($email_data['name']);
                } else {
                    $error = true;
                    $responseMessage = esc_html__('Please insert valid name', 'mkdf-listing');
                }

                if ($email_data['email']) {
                    $email = esc_html($email_data['email']);
                } else {
                    $error = true;
                    $responseMessage = esc_html__('Please insert valid email', 'mkdf-listing');
                }

                if ($email_data['message']) {
                    $message = esc_html($email_data['message']);
                } else {
                    $error = true;
                    $responseMessage = esc_html__('Please insert valid phone', 'mkdf-listing');
                }

                //Send Mail and response
                if ($error) {

                    wp_send_json_error($responseMessage);

                } else {

                    //Get post id from request
                    $post_id = $email_data['itemId'];
                    //Get email address
                    $mail_to = get_post_meta($post_id, '_resume_mail', true);

                    $headers = array(
                        'From: ' . $name . ' <' . $email . '>',
                        'Reply-To: ' . $name . ' <' . $email . '>',
                    );

                    $additional_emails = array();

                    $post = get_post($post_id);
                    $additional_emails[] = get_the_author_meta('user_email', (int)$post->post_author);
                    $headers[] = 'Bcc: ' . implode(',', $additional_emails);

                    $messageTemplate = esc_html__('From', 'mkdf-listing') . ': ' . $name . "\r\n";
                    $messageTemplate .= esc_html__('Message', 'mkdf-listing') . ': ' . $message . "\r\n\n";
                    $messageTemplate .= esc_html__('Message sent via enquiry form on', 'mkdf-listing') . ' ' . get_bloginfo('name') . ' - ' . esc_url(home_url('/'));
	
	                $result = wp_mail(
		                $mail_to, //Mail To
		                esc_html__('New Enquiry form blog name', 'mkdf-listing'), //Subject
		                $messageTemplate, //Message
		                $headers //Additional Headers
	                );
	
	                if(!$result) {
		                global $phpmailer;
		                var_dump($phpmailer->ErrorInfo);
	                }

                    $responseMessage = esc_html__('Enquiry sent successfully', 'mkdf-listing');
                    wp_send_json_success($responseMessage);
                }

            }


        } else {
            $message = esc_html__('Please review your enquiry and send again', 'mkdf-listing');
            wp_send_json_error($message);
        }
    }

    add_action('wp_ajax_nopriv_mkdf_listing_resume_send_resume_item_enquiry', 'mkdf_listing_resume_send_resume_item_enquiry');
    add_action('wp_ajax_mkdf_listing_resume_send_resume_item_enquiry', 'mkdf_listing_resume_send_resume_item_enquiry');
}