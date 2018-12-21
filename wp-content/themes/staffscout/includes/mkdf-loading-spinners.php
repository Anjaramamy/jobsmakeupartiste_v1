<?php

if(!function_exists('staffscout_mikado_loading_spinners')) {
    function staffscout_mikado_loading_spinners() {
    	$id = staffscout_mikado_get_page_id();
	    $spinner_type = staffscout_mikado_get_meta_field_intersect('smooth_pt_spinner_type',$id);

        $spinner_html = '';
        if(!empty($spinner_type)){
            switch ($spinner_type) {
                case 'staffscout':
                    $spinner_html = staffscout_mikado_loading_spinner_staffscout();
                    break;
                case 'rotate_circles':
                    $spinner_html = staffscout_mikado_loading_spinner_rotate_circles();
                    break;
                case 'pulse':
                    $spinner_html = staffscout_mikado_loading_spinner_pulse();
                    break;
                case 'double_pulse':
                    $spinner_html =  staffscout_mikado_loading_spinner_double_pulse();
                    break;
                case 'cube':
                    $spinner_html =  staffscout_mikado_loading_spinner_cube();
                    break;
                case 'rotating_cubes':
                    $spinner_html =  staffscout_mikado_loading_spinner_rotating_cubes();
                    break;
                case 'stripes':
                    $spinner_html =  staffscout_mikado_loading_spinner_stripes();
                    break;
                case 'wave':
                    $spinner_html =  staffscout_mikado_loading_spinner_wave();
                    break;
                case 'two_rotating_circles':
                    $spinner_html =  staffscout_mikado_loading_spinner_two_rotating_circles();
                    break;
                case 'five_rotating_circles':
                    $spinner_html =  staffscout_mikado_loading_spinner_five_rotating_circles();
                    break;
				case 'atom':
                    $spinner_html = staffscout_mikado_loading_spinner_atom();
                    break;
				case 'clock':
                    $spinner_html = staffscout_mikado_loading_spinner_clock();
                    break;
				case 'mitosis':
                    $spinner_html = staffscout_mikado_loading_spinner_mitosis();
                    break;
				case 'lines':
                    $spinner_html = staffscout_mikado_loading_spinner_lines();
                    break;
				case 'fussion':
                    $spinner_html = staffscout_mikado_loading_spinner_fussion();
                    break;
				case 'wave_circles':
                    $spinner_html = staffscout_mikado_loading_spinner_wave_circles();
                    break;
				case 'pulse_circles':
                    $spinner_html = staffscout_mikado_loading_spinner_pulse_circles();
                    break;
	            default:
		            $spinner_html = staffscout_mikado_loading_spinner_pulse();
            }
        }

        echo wp_kses($spinner_html, array(
            'div' => array(
                'class' => true,
                'style' => true,
                'id' => true
            ),
            'span' => array( 
                'class' => true
            ),
            'i' => array( 
                'class' => true
            )
        ));
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_staffscout')) {
    function staffscout_mikado_loading_spinner_staffscout() {
        $html = '';
        $html .= '<div class="mkdf-staffscout-loader">';
        $html .= '<div class="mkdf-icon-rocket-bg"></div>';
        $html .= '<div class="mkdf-icon-rocket">';
        $html .= '<i class="mkdf-icon-dripicons dripicon dripicons-rocket"></i>';
        $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_rotate_circles')) {
    function staffscout_mikado_loading_spinner_rotate_circles() {
        $html = '';
        $html .= '<div class="mkdf-rotate-circles">';
        $html .= '<div></div>';
        $html .= '<div></div>';
        $html .= '<div></div>';
        $html .= '</div>';
	    
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_pulse')) {
    function staffscout_mikado_loading_spinner_pulse() {
        $html = '<div class="pulse"></div>';
	    
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_double_pulse')) {
    function staffscout_mikado_loading_spinner_double_pulse() {
        $html = '';
        $html .= '<div class="double_pulse">';
        $html .= '<div class="double-bounce1"></div>';
        $html .= '<div class="double-bounce2"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_cube')) {
    function staffscout_mikado_loading_spinner_cube() {
        $html = '<div class="cube"></div>';
	    
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_rotating_cubes')) {
    function staffscout_mikado_loading_spinner_rotating_cubes() {
        $html = '';
        $html .= '<div class="rotating_cubes">';
        $html .= '<div class="cube1"></div>';
        $html .= '<div class="cube2"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_stripes')) {
    function staffscout_mikado_loading_spinner_stripes() {
        $html = '';
        $html .= '<div class="stripes">';
        $html .= '<div class="rect1"></div>';
        $html .= '<div class="rect2"></div>';
        $html .= '<div class="rect3"></div>';
        $html .= '<div class="rect4"></div>';
        $html .= '<div class="rect5"></div>';
        $html .= '</div>';
	    
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_wave')) {
    function staffscout_mikado_loading_spinner_wave() {
        $html = '';
        $html .= '<div class="wave">';
        $html .= '<div class="bounce1"></div>';
        $html .= '<div class="bounce2"></div>';
        $html .= '<div class="bounce3"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_two_rotating_circles')) {
    function staffscout_mikado_loading_spinner_two_rotating_circles() {
        $html = '';
        $html .= '<div class="two_rotating_circles">';
        $html .= '<div class="dot1"></div>';
        $html .= '<div class="dot2"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_five_rotating_circles')) {
    function staffscout_mikado_loading_spinner_five_rotating_circles() {
        $html = '';
        $html .= '<div class="five_rotating_circles">';
        $html .= '<div class="spinner-container container1">';
        $html .= '<div class="circle1"></div>';
        $html .= '<div class="circle2"></div>';
        $html .= '<div class="circle3"></div>';
        $html .= '<div class="circle4"></div>';
        $html .= '</div>';
        $html .= '<div class="spinner-container container2">';
        $html .= '<div class="circle1"></div>';
        $html .= '<div class="circle2"></div>';
        $html .= '<div class="circle3"></div>';
        $html .= '<div class="circle4"></div>';
        $html .= '</div>';
        $html .= '<div class="spinner-container container3">';
        $html .= '<div class="circle1"></div>';
        $html .= '<div class="circle2"></div>';
        $html .= '<div class="circle3"></div>';
        $html .= '<div class="circle4"></div>';
        $html .= '</div>';
        $html .= '</div>';
	    
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_atom')) {
    function staffscout_mikado_loading_spinner_atom(){
        $html = '';
        $html .= '<div class="atom">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
	    
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_clock')) {
    function staffscout_mikado_loading_spinner_clock(){
        $html = '';
        $html .= '<div class="clock">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
	    
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_mitosis')) {
    function staffscout_mikado_loading_spinner_mitosis(){
        $html = '';
        $html .= '<div class="mitosis">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
	    
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_lines')) {
    function staffscout_mikado_loading_spinner_lines(){
        $html = '';
        $html .= '<div class="lines">';
        $html .= '<div class="line1"></div>';
		$html .= '<div class="line2"></div>';
		$html .= '<div class="line3"></div>';
		$html .= '<div class="line4"></div>';
        $html .= '</div>';
	    
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_fussion')) {
    function staffscout_mikado_loading_spinner_fussion(){
        $html = '';
        $html .= '<div class="fussion">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
	    
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_wave_circles')) {
    function staffscout_mikado_loading_spinner_wave_circles(){
        $html = '';
        $html .= '<div class="wave_circles">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
	    
        return $html;
    }
}

if(!function_exists('staffscout_mikado_loading_spinner_pulse_circles')) {
    function staffscout_mikado_loading_spinner_pulse_circles(){
        $html = '';
        $html .= '<div class="pulse_circles">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
	    
        return $html;
    }
}
