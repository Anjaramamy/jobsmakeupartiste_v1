<?php
namespace MikadofTwitter\Shortcodes\TwitterList;

use MikadofTwitter\Lib;
/**
 * Class Team
 */
class TwitterList implements Lib\ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'mkdf_twitter_list';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * @see mkd_core_get_carousel_slider_array_vc()
     */
    public function vcMap()	{

        vc_map( array(
            'name' => esc_html__('Mikado Twitter List', 'mkdf-twitter-feed'),
            'base' => $this->base,
            'category' => 'by MIKADO',
            'icon' => 'icon-wpb-twitter-list extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('User ID', 'mkdf-twitter-feed'),
                    'admin_label' => true,
                    'param_name' => 'user_id'
                ),
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    'heading' => esc_html__('Columns', 'mkdf-twitter-feed'),
                    'param_name' => 'number_of_columns',
                    'value'      => array(
                        esc_html__( 'One', 'mkdf-twitter-feed' )   => '1',
                        esc_html__( 'Two', 'mkdf-twitter-feed' )   => '2',
                        esc_html__( 'Three', 'mkdf-twitter-feed' ) => '3',
                        esc_html__( 'Four', 'mkdf-twitter-feed' )  => '4',
                        esc_html__( 'Five', 'mkdf-twitter-feed' )  => '5'
                    ),
                    'save_always' => true
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'space_between_columns',
                    'heading'    => esc_html__( 'Space Between Columns', 'mkdf-twitter-feed' ),
                    'value'      => array(
                        esc_html__( 'Normal', 'mkdf-twitter-feed' )   => 'normal',
                        esc_html__( 'Small', 'mkdf-twitter-feed' )    => 'small',
                        esc_html__( 'Tiny', 'mkdf-twitter-feed' )     => 'tiny',
                        esc_html__( 'No Space', 'mkdf-twitter-feed' ) => 'no'
                    )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Number of Tweets', 'mkdf-twitter-feed'),
                    'admin_label' => true,
                    'param_name' => 'number_of_tweets'
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Tweets Cache Time', 'mkdf-twitter-feed' ),
                    'admin_label'   => true,
                    'param_name'    => 'transient_time',
                )
            )
        ) );

    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null)
    {

        $args = array(
            'user_id' => '',
            'number_of_columns' => '3',
            'space_between_columns' => 'normal',
            'number_of_tweets' => '',
            'transient_time' => '',
        );


        $params = shortcode_atts($args, $atts);
        extract($params);

        $params['holder_classes'] = $this->getHolderClasses($params);

        $twitter_api = new \MikadofTwitterApi();
        $params['twitter_api'] = $twitter_api;
        if ( $twitter_api->hasUserConnected() ) {
            $response = $twitter_api->fetchTweets( $user_id, $number_of_tweets, array(
                'transient_time' => $transient_time,
                'transient_id'   => 'mkdf_twitter_' . rand(0,1000)
            ) );

            $params['response'] = $response;
        }
        //Get HTML from template based on type of team
        $html = mkdf_twitter_get_shortcode_module_template_part('holder', 'twitter-list', '', $params);

        return $html;

    }

    public function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = $this->getColumnNumberClass( $params['number_of_columns'] );
        $holderClasses[] = ! empty( $params['space_between_columns'] ) ? 'mkdf-tl-' . $params['space_between_columns'] . '-space' : 'mkdf-tl-normal-space';

        return implode( ' ', $holderClasses );
    }

    public function getColumnNumberClass( $params ) {
        switch ( $params ) {
            case 1:
                $classes = 'mkdf-tl-one-column';
                break;
            case 2:
                $classes = 'mkdf-tl-two-columns';
                break;
            case 3:
                $classes = 'mkdf-tl-three-columns';
                break;
            case 4:
                $classes = 'mkdf-tl-four-columns';
                break;
            case 5:
                $classes = 'mkdf-tl-five-columns';
                break;
            default:
                $classes = 'mkdf-tl-three-columns';
                break;
        }

        return $classes;
    }

}