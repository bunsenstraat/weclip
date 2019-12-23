<?php
	/* Dequeue globally enqueued styles from CF7 */
add_action( 'wp_enqueue_scripts', 'mdcf7_cf7_cleanup', 100 );
function mdcf7_cf7_cleanup() {
	   wp_deregister_style( 'contact-form-7' );
}

/* Enqueue Material Design Scripts & Styles */
if (!is_admin()) add_action("wp_enqueue_scripts", "mdcf7_enqueue", 99999);
function mdcf7_enqueue() { 
  wp_register_script ( 'mdcf7-script', plugins_url ('../addons/js/material-cf7.js', __FILE__), array( 'jquery' ), false, true); /* in a Footer */
  wp_enqueue_script('mdcf7-script');
  // js parameters
  $mdcf7_datepicker_min =   wp_strip_all_tags( get_option( 'mdcf7_datepicker_min', '[1997,1,14]' ));
  if ( $mdcf7_datepicker_min == "" ) { $mdcf7_datepicker_min = "[1997,1,14]"; }
  $mdcf7_datepicker_max =   wp_strip_all_tags( get_option( 'mdcf7_datepicker_max', '[2027,1,14]' ));
  if ( $mdcf7_datepicker_max == "" ) { $mdcf7_datepicker_max = "[2027,1,14]"; }
  $mdcf7_timepicker_d =   wp_strip_all_tags( get_option( 'mdcf7_timepicker_d', 'now' ));
  if ( $mdcf7_timepicker_d == "" ) { $mdcf7_timepicker_d = "now"; }
  $mdcf7_timepicker_d = "'" . $mdcf7_timepicker_d . "'";
  if ( get_option('mdcf7_months') == false ) {   $mdcf7_months = "true"; } else {   $mdcf7_months = "false"; };
  if ( get_option('mdcf7_format') == true ) {   $mdcf7_format = "true"; } else {   $mdcf7_format = "false"; };
  $mdcf7_datepicker_number =   wp_strip_all_tags( get_option( 'mdcf7_datepicker_number', '10' ));
  if ( $mdcf7_datepicker_number == "" ) { $mdcf7_datepicker_number = "10"; }
  $mdcf7_datapicker_1 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_1', 'January' ));
  $mdcf7_datapicker_2 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_2', 'February' ));
  $mdcf7_datapicker_3 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_3', 'March' ));
  $mdcf7_datapicker_4 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_4', 'Aprill' ));
  $mdcf7_datapicker_5 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_5', 'May' ));
  $mdcf7_datapicker_6 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_6', 'June' ));
  $mdcf7_datapicker_7 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_7', 'July' ));
  $mdcf7_datapicker_8 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_8', 'August' ));
  $mdcf7_datapicker_9 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_9', 'September' ));
  $mdcf7_datapicker_10 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_10', 'October' ));
  $mdcf7_datapicker_11 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_11', 'November' ));
  $mdcf7_datapicker_12 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_12', 'December' ));
  $mdcf7_datapicker_1s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_1s', 'Jan' ));
  $mdcf7_datapicker_2s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_2s', 'Feb' ));
  $mdcf7_datapicker_3s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_3s', 'Mar' ));
  $mdcf7_datapicker_4s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_4s', 'Apr' ));
  $mdcf7_datapicker_5s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_5s', 'May' ));
  $mdcf7_datapicker_6s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_6s', 'Jun' ));
  $mdcf7_datapicker_7s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_7s', 'Jul' ));
  $mdcf7_datapicker_8s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_8s', 'Aug' ));
  $mdcf7_datapicker_9s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_9s', 'Sep' ));
  $mdcf7_datapicker_10s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_10s', 'Octr' ));
  $mdcf7_datapicker_11s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_11s', 'Novr' ));
  $mdcf7_datapicker_12s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_12s', 'Dec' ));
  $mdcf7_datapicker_day1 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day1', 'Sunday' ));
  $mdcf7_datapicker_day2 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day2', 'Monday' ));
  $mdcf7_datapicker_day3 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day3', 'Tuesday' ));
  $mdcf7_datapicker_day4 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day4', 'Wednesday' ));
  $mdcf7_datapicker_day5 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day5', 'Thursday' ));
  $mdcf7_datapicker_day6 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day6', 'Friday' ));
  $mdcf7_datapicker_day7 =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day7', 'Saturday' ));
  $mdcf7_datapicker_day1s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day1s', 'Sun' ));
  $mdcf7_datapicker_day2s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day2s', 'Mon' ));
  $mdcf7_datapicker_day3s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day3s', 'Tue' ));
  $mdcf7_datapicker_day4s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day4s', 'Wed' ));
  $mdcf7_datapicker_day5s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day5s', 'Thu' ));
  $mdcf7_datapicker_day6s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day6s', 'Fri' ));
  $mdcf7_datapicker_day7s =  wp_strip_all_tags( get_option( 'mdcf7_datapicker_day7s', 'Sat' ));
  $mdcf7_datapicker_fullmonths = "['{$mdcf7_datapicker_1}', '{$mdcf7_datapicker_2}', '{$mdcf7_datapicker_3}', '{$mdcf7_datapicker_4}', '{$mdcf7_datapicker_5}', '{$mdcf7_datapicker_6}', '{$mdcf7_datapicker_7}', '{$mdcf7_datapicker_8}', '{$mdcf7_datapicker_9}', '{$mdcf7_datapicker_10}', '{$mdcf7_datapicker_11}', '{$mdcf7_datapicker_12}']";
  $mdcf7_datapicker_shortmonths = "['{$mdcf7_datapicker_1s}', '{$mdcf7_datapicker_2s}', '{$mdcf7_datapicker_3s}', '{$mdcf7_datapicker_4s}', '{$mdcf7_datapicker_5s}', '{$mdcf7_datapicker_6s}', '{$mdcf7_datapicker_7s}', '{$mdcf7_datapicker_8s}', '{$mdcf7_datapicker_9s}', '{$mdcf7_datapicker_10s}', '{$mdcf7_datapicker_11s}', '{$mdcf7_datapicker_12s}']";
  $mdcf7_datapicker_fulldays = "['{$mdcf7_datapicker_day1}', '{$mdcf7_datapicker_day2}', '{$mdcf7_datapicker_day3}', '{$mdcf7_datapicker_day4}', '{$mdcf7_datapicker_day5}', '{$mdcf7_datapicker_day6}', '{$mdcf7_datapicker_day7}']";
  $mdcf7_datapicker_shortdays = "['{$mdcf7_datapicker_day1s}', '{$mdcf7_datapicker_day2s}', '{$mdcf7_datapicker_day3s}', '{$mdcf7_datapicker_day4s}', '{$mdcf7_datapicker_day5s}', '{$mdcf7_datapicker_day6s}', '{$mdcf7_datapicker_day7s}']";
  $mdcf7_button_ok =   wp_strip_all_tags( get_option( 'mdcf7_button_ok', 'OK' ));
  if ( $mdcf7_button_ok == "" ) { $mdcf7_button_ok = "OK"; }
  $mdcf7_button_ok = "'" . $mdcf7_button_ok . "'";
  $mdcf7_button_clear =   wp_strip_all_tags( get_option( 'mdcf7_button_clear', 'CLEAR' ));
  if ( $mdcf7_button_clear == "" ) { $mdcf7_button_clear = "CLEAR"; }
  $mdcf7_button_clear = "'" . $mdcf7_button_clear . "'";
  $mdcf7_button_today =   wp_strip_all_tags( get_option( 'mdcf7_button_today', 'TODAY' ));
  if ( $mdcf7_button_today == "" ) { $mdcf7_button_today = "TODAY"; }
  $mdcf7_button_today = "'" . $mdcf7_button_today . "'";
  $mdcf7_button_cancel =   wp_strip_all_tags( get_option( 'mdcf7_button_cancel', 'CANCEL' ));
  if ( $mdcf7_button_cancel == "" ) { $mdcf7_button_cancel = "CANCEL"; }
  $mdcf7_button_cancel = "'" . $mdcf7_button_cancel . "'";
	$mdcf7_button_file =   wp_strip_all_tags( get_option( 'mdcf7_button_file', 'FILE' ));
  if ( $mdcf7_button_file == "" ) { $mdcf7_button_file = "FILE"; }
	$mdcf7_button_files =   wp_strip_all_tags( get_option( 'mdcf7_button_files', 'FILES' ));
  if ( $mdcf7_button_files == "" ) { $mdcf7_button_files = "FILES"; }
	$showoff_params = array( 'file' => $mdcf7_button_file, 'files' => $mdcf7_button_files );
  $mdcf7_option_scripts = "jQuery(document).ready(function ($) {
  jQuery('.wpcf7 .wpcf7-date').pickadate({
    selectMonths: {$mdcf7_months},
    selectYears: {$mdcf7_datepicker_number},
  	min: {$mdcf7_datepicker_min},
  	max: {$mdcf7_datepicker_max},
    monthsFull: {$mdcf7_datapicker_fullmonths},
    monthsShort: {$mdcf7_datapicker_shortmonths},
    weekdaysFull: {$mdcf7_datapicker_fulldays},
    weekdaysShort: {$mdcf7_datapicker_shortdays},
    today: {$mdcf7_button_today},
    clear: {$mdcf7_button_clear},
    close: {$mdcf7_button_ok},
  	format: 'yyyy-mm-dd',
    closeOnSelect: false
    });
  jQuery('.wpcf7 .timepicker').pickatime({
    default: {$mdcf7_timepicker_d},
    fromnow: 0,
    twelvehour: {$mdcf7_format},
    cleartext: {$mdcf7_button_clear},
		donetext: {$mdcf7_button_ok},
    canceltext: {$mdcf7_button_cancel},
    autoclose: false,
    ampmclickable: true
});

  });
  ";
  $mdcf7_option_scripts = trim(preg_replace('/\s\s+/', ' ', $mdcf7_option_scripts));
   wp_add_inline_script( 'mdcf7-script', $mdcf7_option_scripts );
  wp_localize_script( 'mdcf7-script', 'parameters', $showoff_params );

  // add styles 
  wp_register_style( 'mdcf7-styles', plugins_url('../addons/css/cf7material-styles.css', __FILE__) );
  wp_enqueue_style(  'mdcf7-styles' );
  // add inline Styles
  $mdcf7_a =  wp_strip_all_tags( get_option( 'mdcf7_label_color', '#9e9e9e' ));
  $mdcf7_b =  wp_strip_all_tags( get_option( 'mdcf7_label_focus_color', '#00BCD4' ));
  $mdcf7_c =  wp_strip_all_tags( get_option( 'mdcf7_label_underline_focus_color', '#00BCD4' ));
  $mdcf7_d =  wp_strip_all_tags( get_option( 'mdcf7_icon_prefix', '#000000' ));
  $mdcf7_e =  wp_strip_all_tags( get_option( 'mdcf7_icon_focus_prefix', '#00BCD4' ));
  $mdcf7_f =  wp_strip_all_tags( get_option( 'mdcf7_form_bg', '#ffffff' ));
  $mdcf7_g =  wp_strip_all_tags( get_option( 'mdcf7_input_bg', '#ffffff' ));
  $mdcf7_h =  wp_strip_all_tags( get_option( 'mdcf7_input_color', '#000000' ));
  $mdcf7_i =  wp_strip_all_tags( get_option( 'mdcf7_buttons_color', '#00BCD4' ));
  $mdcf7_j =  wp_strip_all_tags( get_option( 'mdcf7_preloader_color', '#00BCD4' ));
  $mdcf7_k =  wp_strip_all_tags( get_option( 'mdcf7_check', '#00BCD4' ));
  $mdcf7_k_s =  wp_strip_all_tags( get_option( 'mdcf7_check_s', '#e0f7fa ' ));
  $mdcf7_l =  wp_strip_all_tags( get_option( 'mdcf7_date', '#00BCD4 ' ));
	if ( get_option('mdcf7_roboto') == false ) {   $mdcf7_roboto = ".wpcf7-form { font-family: 'Roboto', sans-serif !important;}"; } else {   $mdcf7_roboto = ""; };
  $mdcf7_option_styles = "
    .wpcf7 .wpcf7-form .input-field label {
      color: {$mdcf7_a};
    }
    .wpcf7-form input:not([type]), .wpcf7-form input[type=text]:not(.browser-default), .wpcf7-form input[type=password]:not(.browser-default), .wpcf7-form input[type=email]:not(.browser-default), .wpcf7-form input[type=url]:not(.browser-default), .wpcf7-form input[type=time]:not(.browser-default), .wpcf7-form input[type=date]:not(.browser-default), .wpcf7-form input[type=datetime]:not(.browser-default), .wpcf7-form input[type=datetime-local]:not(.browser-default), .wpcf7-form input[type=tel]:not(.browser-default), .wpcf7-form input[type=number]:not(.browser-default), .wpcf7-form input[type=search]:not(.browser-default), .wpcf7-form textarea.materialize-textarea {
    border-bottom: 1px solid {$mdcf7_a};
    }
    .wpcf7 .wpcf7-form .input-field input[type=text]:focus + label, .wpcf7-form input:not([type]):focus:not([readonly])+label, .wpcf7-form input[type=text]:not(.browser-default):focus:not([readonly])+label, .wpcf7-form input[type=password]:not(.browser-default):focus:not([readonly])+label, .wpcf7-form input[type=email]:not(.browser-default):focus:not([readonly])+label, .wpcf7-form input[type=url]:not(.browser-default):focus:not([readonly])+label, .wpcf7-form input[type=time]:not(.browser-default):focus:not([readonly])+label, .wpcf7-form input[type=date]:not(.browser-default):focus:not([readonly])+label, .wpcf7-form input[type=datetime]:not(.browser-default):focus:not([readonly])+label, .wpcf7-form input[type=datetime-local]:not(.browser-default):focus:not([readonly])+label, .wpcf7-form input[type=tel]:not(.browser-default):focus:not([readonly])+label, .wpcf7-form input[type=number]:not(.browser-default):focus:not([readonly])+label, .wpcf7-form input[type=search]:not(.browser-default):focus:not([readonly])+label, .wpcf7-form textarea.materialize-textarea:focus:not([readonly])+label, .wpcf7-form .dropdown-content li>a, .wpcf7-form .dropdown-content li>span {
      color: {$mdcf7_b};
    }
    .wpcf7-form input:not([type]):focus:not([readonly]), .wpcf7-form input[type=text]:not(.browser-default):focus:not([readonly]), .wpcf7-form input[type=password]:not(.browser-default):focus:not([readonly]), .wpcf7-form input[type=email]:not(.browser-default):focus:not([readonly]), .wpcf7-form input[type=url]:not(.browser-default):focus:not([readonly]), .wpcf7-form input[type=time]:not(.browser-default):focus:not([readonly]), .wpcf7-form input[type=date]:not(.browser-default):focus:not([readonly]), .wpcf7-form input[type=datetime]:not(.browser-default):focus:not([readonly]), .wpcf7-form input[type=datetime-local]:not(.browser-default):focus:not([readonly]), .wpcf7-form input[type=tel]:not(.browser-default):focus:not([readonly]), .wpcf7-form input[type=number]:not(.browser-default):focus:not([readonly]), .wpcf7-form input[type=search]:not(.browser-default):focus:not([readonly]), .wpcf7-form textarea.materialize-textarea:focus:not([readonly]) {
    border-bottom: 1px solid {$mdcf7_c};
    box-shadow: 0 1px 0 0 {$mdcf7_c};
    }
    .wpcf7-form .input-field .prefix {
      color: {$mdcf7_d}
    }
    .wpcf7-form .input-field .prefix.active {
      color: {$mdcf7_e}
    }
    .wpcf7-form {
      background-color: {$mdcf7_f};
    }
    .wpcf7-form input:not([type]), .wpcf7-form input[type=text]:not(.browser-default), .wpcf7-form input[type=password]:not(.browser-default), .wpcf7-form input[type=email]:not(.browser-default), .wpcf7-form input[type=url]:not(.browser-default), .wpcf7-form input[type=time]:not(.browser-default), .wpcf7-form input[type=date]:not(.browser-default), .wpcf7-form input[type=datetime]:not(.browser-default), .wpcf7-form input[type=datetime-local]:not(.browser-default), .wpcf7-form input[type=tel]:not(.browser-default), .wpcf7-form input[type=number]:not(.browser-default), .wpcf7-form input[type=search]:not(.browser-default), .wpcf7-form textarea.materialize-textarea, .wpcf7-form label {

      color: {$mdcf7_h};
    }
    .wpcf7-form .dropdown-content {
      background-color: {$mdcf7_g};
    }
    .wpcf7 .wpcf7-form .wpcf7-submit, .wpcf7 .wpcf7-form .btn-large,  .wpcf7 .wpcf7-form .btn {
      background-color: {$mdcf7_i} !important;
    }
    .wpcf7-form input[type=range]+.thumb {
      background-color: {$mdcf7_i} !important;
    }
    .wpcf7-form input[type=range]::-webkit-slider-thumb {
      background: {$mdcf7_i} !important;
    }
    .wpcf7-form input[type=range]::-ms-thumb  {
      background: {$mdcf7_i} !important;
    }
    .wpcf7-form input[type=range]::-moz-range-thumb  {
      background: {$mdcf7_i} !important;
    }
    .wpcf7-form .spinner-layer {
      border-color: {$mdcf7_j};
    }
    .wpcf7-form [type=radio]:checked+label:after, .wpcf7-form [type=radio].with-gap:checked+label:before, .wpcf7-form [type=radio].with-gap:checked+label:after {
     border: 2px solid {$mdcf7_k};
    }
    .wpcf7-form [type=radio]:checked+label:after, .wpcf7-form [type=radio].with-gap:checked+label:after, .wpcf7-form .switch label input[type=checkbox]:checked+.lever:after {
      background-color: {$mdcf7_k};
    }
    .wpcf7-form [type=checkbox]:checked+label:before {
    border-right: 2px solid {$mdcf7_k};
    border-bottom: 2px solid {$mdcf7_k};
   }
   .wpcf7 .wpcf7-form [type=checkbox].filled-in:checked+label:after {
    border: 2px solid {$mdcf7_k};
    background-color: {$mdcf7_k};
  }
  .wpcf7 .wpcf7-form .switch label input[type=checkbox]:checked+.lever {
   background-color: {$mdcf7_k_s};
  }
  .wpcf7-form .picker__date-display, .wpcf7-form .picker__date-display, .wpcf7-form .clockpicker-canvas line, .wpcf7-form .clockpicker-canvas circle, .wpcf7-form .picker__day--selected, .wpcf7-form .picker__day--selected:hover, .wpcf7-form .picker--focused .picker__day--selected {
    background-color: {$mdcf7_l};
    fill: {$mdcf7_l};
    stroke: {$mdcf7_l};
  }
  .wpcf7-form .picker__close, .wpcf7-form .picker__today, .wpcf7-form .picker__day.picker__day--today {
    color: {$mdcf7_l};
  }
	{$mdcf7_roboto}
    ";

  $mdcf7_option_styles = trim(preg_replace('/\s\s+/', ' ', $mdcf7_option_styles));

  wp_add_inline_style( 'mdcf7-styles', $mdcf7_option_styles );
    /* Add a Roboto Font with Material Icons */
			if ( get_option('mdcf7_icons') == false ) {
  wp_enqueue_style( 'mdcf7-google-fonts', plugins_url ('../addons/css/materialicons.css', __FILE__), false ); }
		if ( get_option('mdcf7_roboto') == false ) {
  wp_enqueue_style( 'mdcf7-google-fonts2', plugins_url ('../addons/css/roboto.css', __FILE__), false );
}
}

add_action( 'admin_head', 'mdcf7_admin_styles' );
function mdcf7_admin_styles() {  
  wp_register_style( 'mdcf7-styles-admin', plugins_url('../addons/css/admin-styles.min.css', __FILE__) );
  wp_enqueue_style(  'mdcf7-styles-admin' );
  wp_enqueue_style( 'wp-color-picker' );
  wp_enqueue_script( 'mdcf7-picker', plugins_url ('../addons/js/admin.js', __FILE__), array( 'wp-color-picker' ), false, true );
  wp_enqueue_style( 'mdcf7-google-fonts2', plugins_url ('../addons/css/roboto.css', __FILE__), false );
}
