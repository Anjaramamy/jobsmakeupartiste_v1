<?php

class StaffScoutMikadoClassLike {
	private static $instance;
	
	private function __construct() {
		add_action( 'wp_ajax_staffscout_mikado_like', array( $this, 'ajax' ) );
		add_action( 'wp_ajax_nopriv_staffscout_mikado_like', array( $this, 'ajax' ) );
	}
	
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		
		return self::$instance;
	}
	
	function ajax() {
		
		//update
		if ( isset( $_POST['likes_id'] ) ) {
			$post_id = str_replace( 'mkdf-like-', '', $_POST['likes_id'] );
			$post_id = substr( $post_id, 0, - 4 );
			$type    = isset( $_POST['type'] ) ? $_POST['type'] : '';
			
			echo wp_kses( $this->like_post( $post_id, 'update', $type ), array(
				'span' => array(
					'class'       => true,
					'aria-hidden' => true,
					'style'       => true,
					'id'          => true
				),
				'i'    => array(
					'class' => true,
					'style' => true,
					'id'    => true
				)
			) );
		} //get
		else {
			$post_id = str_replace( 'mkdf-like-', '', $_POST['likes_id'] );
			$post_id = substr( $post_id, 0, - 4 );
			echo wp_kses( $this->like_post( $post_id, 'get' ), array(
				'span' => array(
					'class'       => true,
					'aria-hidden' => true,
					'style'       => true,
					'id'          => true
				),
				'i'    => array(
					'class' => true,
					'style' => true,
					'id'    => true
				)
			) );
		}
		
		exit;
	}
	
	public function like_post( $post_id, $action = 'get', $type = '' ) {
		if ( ! is_numeric( $post_id ) ) {
			return;
		}
		
		switch ( $action ) {
			
			case 'get':
				$like_count = get_post_meta( $post_id, '_mkdf-like', true );
                $icon = '<i class="dripicons-heart" aria-hidden="true"></i>';
				
				if ( ! $like_count ) {
					$like_count = 0;
					add_post_meta( $post_id, '_mkdf-like', $like_count, true );
					$icon = '<i class="dripicons-heart" aria-hidden="true"></i>';
				}
				
				$return_value = $icon . "<span>" . esc_attr( $like_count ) . "</span>";
				
				return $return_value;
				break;
			
			case 'update':
				$like_count = get_post_meta( $post_id, '_mkdf-like', true );
				
				if ( isset( $_COOKIE[ 'mkdf-like_' . $post_id ] ) ) {
					return $like_count;
				}
				
				$like_count ++;
				
				update_post_meta( $post_id, '_mkdf-like', $like_count );
				setcookie( 'mkdf-like_' . $post_id, $post_id, time() * 20, '/' );
				
				$return_value = "<i class='dripicons-heart' aria-hidden='true'></i><span>" . esc_attr( $like_count ) . "</span>";
				
				return $return_value;
				
				break;
			default:
				return '';
				break;
		}
	}
	
	public function add_like() {
		global $post;
		
		$output = $this->like_post( $post->ID );
		
		$class       = 'mkdf-like';
		$rand_number = rand( 100, 999 );
		$title       = esc_html__( 'Like this', 'staffscout' );
		
		if ( isset( $_COOKIE[ 'mkdf-like_' . $post->ID ] ) ) {
			$class = 'mkdf-like liked';
			$title = esc_html__( 'You already like this!', 'staffscout' );
		}
		
		return '<a href="#" class="' . $class . '" id="mkdf-like-' . $post->ID . '-' . $rand_number . '" title="' . $title . '">' . $output . '</a>';
	}
}

if ( ! function_exists( 'staffscout_mikado_create_like' ) ) {
	function staffscout_mikado_create_like() {
		StaffScoutMikadoClassLike::get_instance();
	}
	
	add_action( 'after_setup_theme', 'staffscout_mikado_create_like' );
}