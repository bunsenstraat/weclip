<?php

function mdcf7_menu() {
	add_menu_page( 'Contact Form 7 Material Design', 'Material CF7', 'manage_options', 'mdcf7_options', 'mdcf7_options', 'dashicons-email-alt', 60  );
	add_submenu_page( 'mdcf7_options', 'Material Design Contact Form 7 - Help', 'Help', 'manage_options', 'mdcf7_help_submenu', 'mdcf7_help_submenu' );
	add_submenu_page( 'mdcf7_options', 'Material Design Contact Form 7 - Contact', 'Contact', 'manage_options', 'mdcf7_contact_submenu', 'mdcf7_contact_submenu' );
}

add_action( 'admin_menu' , 'mdcf7_menu' );

function mdcf7_options() {

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __('You do not have sufficient permissions to access this page') );
	}

	if ( isset( $_REQUEST['action'] ) ) {
		if ( 'save' == $_REQUEST['action'] ) {
				add_option( 'mdcf7_years', 'true', '', 'yes' );
				update_option( 'mdcf7_label_color' , sanitize_text_field($_POST['mdcf7_label_color'] ) );
				update_option( 'mdcf7_label_focus_color' , sanitize_text_field($_POST['mdcf7_label_focus_color'] ) );
				update_option( 'mdcf7_label_underline_focus_color' , sanitize_text_field($_POST['mdcf7_label_underline_focus_color'] ) );
				update_option( 'mdcf7_icon_prefix' , sanitize_text_field($_POST['mdcf7_icon_prefix'] ) );
				update_option( 'mdcf7_icon_focus_prefix' , sanitize_text_field($_POST['mdcf7_icon_focus_prefix'] ) );
				update_option( 'mdcf7_form_bg' , sanitize_text_field($_POST['mdcf7_form_bg'] ) );
				update_option( 'mdcf7_input_bg' , sanitize_text_field($_POST['mdcf7_input_bg'] ) );
				update_option( 'mdcf7_input_color' , sanitize_text_field($_POST['mdcf7_input_color'] ) );
				update_option( 'mdcf7_buttons_color' , sanitize_text_field($_POST['mdcf7_buttons_color'] ) );
				update_option( 'mdcf7_preloader_color' , sanitize_text_field($_POST['mdcf7_preloader_color'] ) );
				update_option( 'mdcf7_check' , sanitize_text_field($_POST['mdcf7_check'] ) );
				update_option( 'mdcf7_check_s' , sanitize_text_field($_POST['mdcf7_check_s'] ) );
				update_option( 'mdcf7_date' , sanitize_text_field($_POST['mdcf7_date'] ) );
				update_option( 'mdcf7_format' , sanitize_text_field($_POST['mdcf7_format'] ) );
				update_option( 'mdcf7_datepicker_min' , sanitize_text_field($_POST['mdcf7_datepicker_min'] ) );
				update_option( 'mdcf7_datepicker_max' , sanitize_text_field($_POST['mdcf7_datepicker_max'] ) );
				update_option( 'mdcf7_datepicker_number' , sanitize_text_field($_POST['mdcf7_datepicker_number'] ) );
				update_option( 'mdcf7_timepicker_d' , sanitize_text_field($_POST['mdcf7_timepicker_d'] ) );
				update_option( 'mdcf7_months' , sanitize_text_field($_POST['mdcf7_months'] ) );
				update_option( 'mdcf7_datapicker_1' , sanitize_text_field($_POST['mdcf7_datapicker_1'] ) );
				update_option( 'mdcf7_datapicker_2' , sanitize_text_field($_POST['mdcf7_datapicker_2'] ) );
				update_option( 'mdcf7_datapicker_3' , sanitize_text_field($_POST['mdcf7_datapicker_3'] ) );
				update_option( 'mdcf7_datapicker_4' , sanitize_text_field($_POST['mdcf7_datapicker_4'] ) );
				update_option( 'mdcf7_datapicker_5' , sanitize_text_field($_POST['mdcf7_datapicker_5'] ) );
				update_option( 'mdcf7_datapicker_6' , sanitize_text_field($_POST['mdcf7_datapicker_6'] ) );
				update_option( 'mdcf7_datapicker_7' , sanitize_text_field($_POST['mdcf7_datapicker_7'] ) );
				update_option( 'mdcf7_datapicker_8' , sanitize_text_field($_POST['mdcf7_datapicker_8'] ) );
				update_option( 'mdcf7_datapicker_9' , sanitize_text_field($_POST['mdcf7_datapicker_9'] ) );
				update_option( 'mdcf7_datapicker_10' , sanitize_text_field($_POST['mdcf7_datapicker_10'] ) );
				update_option( 'mdcf7_datapicker_11' , sanitize_text_field($_POST['mdcf7_datapicker_11'] ) );
				update_option( 'mdcf7_datapicker_12' , sanitize_text_field($_POST['mdcf7_datapicker_12'] ) );
				update_option( 'mdcf7_datapicker_1s' , sanitize_text_field($_POST['mdcf7_datapicker_1s'] ) );
				update_option( 'mdcf7_datapicker_2s' , sanitize_text_field($_POST['mdcf7_datapicker_2s'] ) );
				update_option( 'mdcf7_datapicker_3s' , sanitize_text_field($_POST['mdcf7_datapicker_3s'] ) );
				update_option( 'mdcf7_datapicker_4s' , sanitize_text_field($_POST['mdcf7_datapicker_4s'] ) );
				update_option( 'mdcf7_datapicker_5s' , sanitize_text_field($_POST['mdcf7_datapicker_5s'] ) );
				update_option( 'mdcf7_datapicker_6s' , sanitize_text_field($_POST['mdcf7_datapicker_6s'] ) );
				update_option( 'mdcf7_datapicker_7s' , sanitize_text_field($_POST['mdcf7_datapicker_7s'] ) );
				update_option( 'mdcf7_datapicker_8s' , sanitize_text_field($_POST['mdcf7_datapicker_8s'] ) );
				update_option( 'mdcf7_datapicker_9s' , sanitize_text_field($_POST['mdcf7_datapicker_9s'] ) );
				update_option( 'mdcf7_datapicker_10s' , sanitize_text_field($_POST['mdcf7_datapicker_10s'] ) );
				update_option( 'mdcf7_datapicker_11s' , sanitize_text_field($_POST['mdcf7_datapicker_11s'] ) );
				update_option( 'mdcf7_datapicker_12s' , sanitize_text_field($_POST['mdcf7_datapicker_12s'] ) );
				update_option( 'mdcf7_datapicker_day1' , sanitize_text_field($_POST['mdcf7_datapicker_day1'] ) );
				update_option( 'mdcf7_datapicker_day2' , sanitize_text_field($_POST['mdcf7_datapicker_day2'] ) );
				update_option( 'mdcf7_datapicker_day3' , sanitize_text_field($_POST['mdcf7_datapicker_day3'] ) );
				update_option( 'mdcf7_datapicker_day4' , sanitize_text_field($_POST['mdcf7_datapicker_day4'] ) );
				update_option( 'mdcf7_datapicker_day5' , sanitize_text_field($_POST['mdcf7_datapicker_day5'] ) );
				update_option( 'mdcf7_datapicker_day6' , sanitize_text_field($_POST['mdcf7_datapicker_day6'] ) );
				update_option( 'mdcf7_datapicker_day7' , sanitize_text_field($_POST['mdcf7_datapicker_day7'] ) );
				update_option( 'mdcf7_datapicker_day1s' , sanitize_text_field($_POST['mdcf7_datapicker_day1s'] ) );
				update_option( 'mdcf7_datapicker_day2s' , sanitize_text_field($_POST['mdcf7_datapicker_day2s'] ) );
				update_option( 'mdcf7_datapicker_day3s' , sanitize_text_field($_POST['mdcf7_datapicker_day3s'] ) );
				update_option( 'mdcf7_datapicker_day4s' , sanitize_text_field($_POST['mdcf7_datapicker_day4s'] ) );
				update_option( 'mdcf7_datapicker_day5s' , sanitize_text_field($_POST['mdcf7_datapicker_day5s'] ) );
				update_option( 'mdcf7_datapicker_day6s' , sanitize_text_field($_POST['mdcf7_datapicker_day6s'] ) );
				update_option( 'mdcf7_datapicker_day7s' , sanitize_text_field($_POST['mdcf7_datapicker_day7s'] ) );
				update_option( 'mdcf7_button_ok' , sanitize_text_field($_POST['mdcf7_button_ok'] ) );
				update_option( 'mdcf7_button_clear' , sanitize_text_field($_POST['mdcf7_button_clear'] ) );
				update_option( 'mdcf7_button_today' , sanitize_text_field($_POST['mdcf7_button_today'] ) );
				update_option( 'mdcf7_button_cancel' , sanitize_text_field($_POST['mdcf7_button_cancel'] ) );
				update_option( 'mdcf7_button_file' , sanitize_text_field($_POST['mdcf7_button_file'] ) );
				update_option( 'mdcf7_button_files' , sanitize_text_field($_POST['mdcf7_button_files'] ) );
				update_option( 'mdcf7_roboto' , sanitize_text_field($_POST['mdcf7_roboto'] ) );
				update_option( 'mdcf7_icons' , sanitize_text_field($_POST['mdcf7_icons'] ) );
		}

	}

?>

	<div class="mdcf7-options-wrapper">

		<form method="post" class="wrap mdcf7-options mdcf7-card">
				<h1>Material Design CF7 - Options</h1>
				<?php				if ( isset( $_REQUEST['action'] ) ) {
					if ( 'save' == $_REQUEST['action'] ) {
						?>
							<p class="welcome mdcf7-notice">The changes have been saved.</p>
						<?php
					}
				}
			 ?>

				<div class="mdcf7-content">
					<p class="welcome">Welcome to the Material plugin page. Here you can change all options: colors, parameters for pickers as well translations. </p>
					<hr>
					<h2>Colors</h2>
					<ul>
						<li>
							<span>Label and border bottom</span>
							<span><input type="text" name="mdcf7_label_color" value="<?php echo get_option("mdcf7_label_color", '#9e9e9e' ); ?>" class="mdcf7-color-field" data-default-color="#9e9e9e" /></span>
						</li>
						<li>
							<span>Label focus </span>
							<span><input type="text" name="mdcf7_label_focus_color" value="<?php echo get_option("mdcf7_label_focus_color", '#00BCD4' ); ?>" class="mdcf7-color-field" data-default-color="#00BCD4" /></span>
						</li>
						<li>
							<span>Label underline focus</span>
							<span><input type="text" name="mdcf7_label_underline_focus_color" value="<?php echo get_option("mdcf7_label_underline_focus_color", '#00BCD4' ); ?>" class="mdcf7-color-field" data-default-color="#00BCD4" /></span>
						</li>
						<li>
							<span>Icon prefix</span>
							<span><input type="text" name="mdcf7_icon_prefix" value="<?php echo get_option("mdcf7_icon_prefix", '#000000' ); ?>" class="mdcf7-color-field" data-default-color="#000000" /></span>
						</li>
						<li>
							<span>Icon prefix focus</span>
							<span><input type="text" name="mdcf7_icon_focus_prefix" value="<?php echo get_option("mdcf7_icon_focus_prefix", '#00BCD4' ); ?>" class="mdcf7-color-field" data-default-color="#00BCD4" /></span>
						</li>
						<li>
							<span>Form background</span>
							<span><input type="text" name="mdcf7_form_bg" value="<?php echo get_option("mdcf7_form_bg", '#ffffff' ); ?>" class="mdcf7-color-field" data-default-color="#ffffff" /></span>
						</li>
						<li>
							<span>Select dropdown  background</span>
							<span><input type="text" name="mdcf7_input_bg" value="<?php echo get_option("mdcf7_input_bg", '#ffffff' ); ?>" class="mdcf7-color-field" data-default-color="#ffffff" /></span>
						</li>
						<li>
							<span>Input text</span>
							<span><input type="text" name="mdcf7_input_color" value="<?php echo get_option("mdcf7_input_color", '#000000' ); ?>" class="mdcf7-color-field" data-default-color="#000000" /></span>
						</li>
						<li>
							<span>Buttons</span>
							<span><input type="text" name="mdcf7_buttons_color" value="<?php echo get_option("mdcf7_buttons_color", '#00BCD4' ); ?>" class="mdcf7-color-field" data-default-color="#00BCD4" /></span>
						</li>
						<li>
							<span>Preloader</span>
							<span><input type="text" name="mdcf7_preloader_color" value="<?php echo get_option("mdcf7_preloader_color", '#00BCD4' ); ?>" class="mdcf7-color-field" data-default-color="#00BCD4" /></span>
						</li>
						<li>
							<span>Checkboxes and radio</span>
							<span><input type="text" name="mdcf7_check" value="<?php echo get_option("mdcf7_check", '#00BCD4' ); ?>" class="mdcf7-color-field" data-default-color="#00BCD4" /></span>
						</li>
						<li>
							<span>Background for slide-checkbox</span>
							<span><input type="text" name="mdcf7_check_s" value="<?php echo get_option("mdcf7_check_s", '#e0f7fa ' ); ?>" class="mdcf7-color-field" data-default-color="#e0f7fa " /></span>
						</li>
						<li>
							<span>Color for pickers (data & time)</span>
							<span><input type="text" name="mdcf7_date" value="<?php echo get_option("mdcf7_date", '#00BCD4 ' ); ?>" class="mdcf7-color-field" data-default-color="#00BCD4 " /></span>
						</li>
					</ul>
					<h2>Parameters</h2>
					<p>Datepicker:</p>
					<ul>
						<li>
							<div class="mdcf7_full">Enter the minimum and maximum date. The settings in the form of parameter (CF7) only applies to the validation when you click the <i>SUBMIT</i> button,
								but for a picker you have to choose separately. There are several ways to determine values: <em>[2017,3,20]</em> - the exact date, or  <em>-30</em>
								- which sets it relatively to the current date (with "a day" as the unit). The minus should be removed if the future date is to be set. You can also use <em>true</em> for setting the current date, <em>false</em> or <em>0</em> if you want to turn off the limits. </div>
							<span>MIN:</span>
							<span><input type="text" name="mdcf7_datepicker_min" value="<?php echo get_option("mdcf7_datepicker_min", '[1997,1,14]' ); ?>" class="mdcf7-field" /></span>
							<span>MAX:</span>
							<span><input type="text" name="mdcf7_datepicker_max" value="<?php echo get_option("mdcf7_datepicker_max", '[2027,1,14]' ); ?>" class="mdcf7-field" /></span>
						</li>
						<li>
							<span>Do you want to lock the moth selection dropdown?</span>
							<span>
								<input name="mdcf7_months" type="hidden" value="0" />
								<input name="mdcf7_months" type="checkbox" value="1" <?php checked( '1', get_option( 'mdcf7_months', 'true' ) ); ?> />
							</span>
						</li>
						<li>
							<div class="mdcf7_full">Here you can enter the number of selected years. <em>0</em> or <em>false</em>  to remove the year selection dropdown.
							</div>
							<span>The number of years to show in the dropdown.</span>
							<span><input type="text" name="mdcf7_datepicker_number" value="<?php echo get_option("mdcf7_datepicker_number", '10' ); ?>" class="mdcf7-field" /></span>
						</li>
					</ul>
					<p>Timepicker:</p>
					<ul>
						<li>
							<div class="mdcf7_full">
								Enter the time you want to be displayed in the timepicker. You can enter the exact hour <em>16:30</em> or the current one <em>now</em>.
							</div>
							<span>Default time:</span>
							<span><input type="text" name="mdcf7_timepicker_d" value="<?php echo get_option("mdcf7_timepicker_d", 'now' ); ?>" class="mdcf7-field" /></span>
						</li>
						<li>
							<span>Use AM/PM format? (default is 24-hour)</span>
							<span>
								<input name="mdcf7_format" type="hidden" value="0" />
								<input name="mdcf7_format" type="checkbox" value="1" <?php checked( '1', get_option( 'mdcf7_format', 'true' ) ); ?> />
							</span>
						</li>
					</ul>
					<p>Font</p>
					<ul>
						<li>
							<div class="mdcf7_full">
								The default font used by Material design is Roboto. In order to change it, you can set your own css by using the class: <em>.wpcf7-form</em>. If the styles for this class are not defined the font from the template will be used.
								If you do not use prefixes, then you can disable the icons.
							</div>
							<span>Disable Roboto?</span>
							<span>
								<input name="mdcf7_roboto" type="hidden" value="0" />
								<input name="mdcf7_roboto" type="checkbox" value="1" <?php checked( '1', get_option( 'mdcf7_roboto', 'true' ) ); ?> />
							</span>
							<span>Disable Material Icons?</span>
							<span>
								<input name="mdcf7_icons" type="hidden" value="0" />
								<input name="mdcf7_icons" type="checkbox" value="1" <?php checked( '1', get_option( 'mdcf7_icons', 'true' ) ); ?> />
							</span>
						</li>
					</ul>
					<h2>Translations</h2>
					<p>Buttons</p>
					<ul>
						<li>
							<span><i>OK</i> </span>
							<span><input type="text" name="mdcf7_button_ok" value="<?php echo get_option("mdcf7_button_ok", "OK" ); ?>" class="mdcf7-field" /></span>
						</li>
						<li>
							<span><i>CLEAR</i></span>
							<span><input type="text" name="mdcf7_button_clear" value="<?php echo get_option("mdcf7_button_clear", "CLEAR" ); ?>" class="mdcf7-field" /></span>
						</li>
						<li>
							<span><i>TODAY</i></span>
							<span><input type="text" name="mdcf7_button_today" value="<?php echo get_option("mdcf7_button_today", "TODAY" ); ?>" class="mdcf7-field" /></span>
						</li>
						<li>
							<span><i>CANCEL</i></span>
							<span><input type="text" name="mdcf7_button_cancel" value="<?php echo get_option("mdcf7_button_cancel", "CANCEL" ); ?>" class="mdcf7-field" /></span>
						</li>
						<li>
							<span><i>FILE</i></span>
							<span><input type="text" name="mdcf7_button_file" value="<?php echo get_option("mdcf7_button_file", "FIELD" ); ?>" class="mdcf7-field" /></span>
						</li>
						<li>
							<span><i>FILES</i></span>
							<span><input type="text" name="mdcf7_button_files" value="<?php echo get_option("mdcf7_button_files", "FIELDS" ); ?>" class="mdcf7-field" /></span>
						</li>
					</ul>
					<p>Datepicker</p>
					<ul class="mdcf7_translations">
						<li>
							<span>Months:</span>
							<span>
								<div class="mdcf7_f"> <p>Full name</p> <p>Short name </p> </div>
								<p>January</p>
								<input type="text" name="mdcf7_datapicker_1" value="<?php echo get_option("mdcf7_datapicker_1", "January" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_1s" value="<?php echo get_option("mdcf7_datapicker_1s", "Jan" ); ?>" class="mdcf7-field" />
								<p>February</p>
								<input type="text" name="mdcf7_datapicker_2" value="<?php echo get_option("mdcf7_datapicker_2", "February" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_2s" value="<?php echo get_option("mdcf7_datapicker_2s", "Feb" ); ?>" class="mdcf7-field" />
								<p>March</p>
								<input type="text" name="mdcf7_datapicker_3" value="<?php echo get_option("mdcf7_datapicker_3", "March" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_3s" value="<?php echo get_option("mdcf7_datapicker_3s", "Mar" ); ?>" class="mdcf7-field" />
								<p>April</p>
								<input type="text" name="mdcf7_datapicker_4" value="<?php echo get_option("mdcf7_datapicker_4", "Aprill" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_4s" value="<?php echo get_option("mdcf7_datapicker_4s", "Apr" ); ?>" class="mdcf7-field" />
								<p>May</p>
								<input type="text" name="mdcf7_datapicker_5" value="<?php echo get_option("mdcf7_datapicker_5", "May" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_5s" value="<?php echo get_option("mdcf7_datapicker_5s", "May" ); ?>" class="mdcf7-field" />
								<p>June</p>
								<input type="text" name="mdcf7_datapicker_6" value="<?php echo get_option("mdcf7_datapicker_6", "June" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_6s" value="<?php echo get_option("mdcf7_datapicker_6s", "Jun" ); ?>" class="mdcf7-field" />
								<p>July</p>
								<input type="text" name="mdcf7_datapicker_7" value="<?php echo get_option("mdcf7_datapicker_7", "July" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_7s" value="<?php echo get_option("mdcf7_datapicker_7s", "Jul" ); ?>" class="mdcf7-field" />
								<p>August</p>
								<input type="text" name="mdcf7_datapicker_8" value="<?php echo get_option("mdcf7_datapicker_8", "August" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_8s" value="<?php echo get_option("mdcf7_datapicker_8s", "Aug" ); ?>" class="mdcf7-field" />
								<p>September</p>
								<input type="text" name="mdcf7_datapicker_9" value="<?php echo get_option("mdcf7_datapicker_9", "September" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_9s" value="<?php echo get_option("mdcf7_datapicker_9s", "Sep" ); ?>" class="mdcf7-field" />
								<p>October</p>
								<input type="text" name="mdcf7_datapicker_10" value="<?php echo get_option("mdcf7_datapicker_10", "October" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_10s" value="<?php echo get_option("mdcf7_datapicker_10s", "Oct" ); ?>" class="mdcf7-field" />
								<p>November</p>
								<input type="text" name="mdcf7_datapicker_11" value="<?php echo get_option("mdcf7_datapicker_11", "November" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_11s" value="<?php echo get_option("mdcf7_datapicker_11s", "Nov" ); ?>" class="mdcf7-field" />
								<p>December</p>
								<input type="text" name="mdcf7_datapicker_12" value="<?php echo get_option("mdcf7_datapicker_12", "December" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_12s" value="<?php echo get_option("mdcf7_datapicker_12s", "Dec" ); ?>" class="mdcf7-field" />
							</span>
						</li>
						<li>
							<span>Days:</span>
							<span>
								<div class="mdcf7_f"> <p>Full name</p> <p>Short name </p> </div>
								<p>Sunday</p>
								<input type="text" name="mdcf7_datapicker_day1" value="<?php echo get_option("mdcf7_datapicker_day1", "Sunday" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_day1s" value="<?php echo get_option("mdcf7_datapicker_day1s", "Sun" ); ?>" class="mdcf7-field" />
								<p>Monday</p>
								<input type="text" name="mdcf7_datapicker_day2" value="<?php echo get_option("mdcf7_datapicker_day2", "Monday" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_day2s" value="<?php echo get_option("mdcf7_datapicker_day2s", "Mon" ); ?>" class="mdcf7-field" />
								<p>Tuesday</p>
								<input type="text" name="mdcf7_datapicker_day3" value="<?php echo get_option("mdcf7_datapicker_day3", "Tuesday" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_day3s" value="<?php echo get_option("mdcf7_datapicker_day3s", "Tue" ); ?>" class="mdcf7-field" />
								<p>Wednesday</p>
								<input type="text" name="mdcf7_datapicker_day4" value="<?php echo get_option("mdcf7_datapicker_day4", "Wednesday" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_day4s" value="<?php echo get_option("mdcf7_datapicker_das4s", "Wed" ); ?>" class="mdcf7-field" />
								<p>Thursday</p>
								<input type="text" name="mdcf7_datapicker_day5" value="<?php echo get_option("mdcf7_datapicker_day5", "Thursday" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_day5s" value="<?php echo get_option("mdcf7_datapicker_day5s", "Thu" ); ?>" class="mdcf7-field" />
								<p>Friday</p>
								<input type="text" name="mdcf7_datapicker_day6" value="<?php echo get_option("mdcf7_datapicker_day6", "Friday" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_day6s" value="<?php echo get_option("mdcf7_datapicker_day6s", "Fri" ); ?>" class="mdcf7-field" />
								<p>Saturday</p>
								<input type="text" name="mdcf7_datapicker_day7" value="<?php echo get_option("mdcf7_datapicker_day7", "Saturday" ); ?>" class="mdcf7-field" />
								<input type="text" name="mdcf7_datapicker_day7s" value="<?php echo get_option("mdcf7_datapicker_day7s", "Sat" ); ?>" class="mdcf7-field" />
							</span>
						</li>
					</ul>
				<input type="hidden" name="action" value="save" />
				<input type="submit" class="btn-fixed" value="SAVE" />
			</div>
		</form>

	</div>

<?php
}


function mdcf7_help_submenu() {
?>

	<div  class="wrap mdcf7-help mdcf7-card">
			<h1>Material Design CF7 - Help <a class="donate" target="_blank" href="https://www.paypal.com/pools/c/7ZZwQimfUd">DONATE</a></h1>
			<div class="mdcf7-content">
					<p class="welcome">Below we have gathered the information needed to prepare the appropriate form. No additional shortcode is required in this plugin, however, we need a properly prepared structure.
					Check out how easy it is!</p>
					<hr>
					<h2>General rule</h2>
					<div class="mdcf7_full">The most important part in preparing a proper form is its Strucure. It is crucial to remember about the spacing between elements of the form, as in the example below.
						 Instead of using the spacing, you can manually put it in the selector <em>p</em>. You also have to remember to always use it in the right order. It is important that <em>&lt;label&gt;</em> is at the begining and that it does not  wrap any other elements.
					</div>
					<pre rel="Contact Form 7 SHORTCODE">
						<div class="mdcf7-copy">COPY</div>
						<div class="mdcf7-watch"><a href="#">DEMO</a></div>
					<code>
&lt;<span class="red">label</span>&gt;<span class="black">What's your name?</span>&lt;/<span class="red">label</span>&gt;
&lt;<span class="red">i</span> <span class="green">class</span>="<span class="blue">material-icons prefix</span>"&gt;<span class="black">account_circle</span>&lt;/<span class="red">i</span>&gt;
[<span class="red">text*</span> <span class="blue">your-name</span>]

&lt;<span class="red">label</span>&gt;<span class="black">What's your surname?</span>&lt;/<span class="red">label</span>&gt;
&lt;<span class="red">i</span> <span class="green">class</span>="<span class="blue">material-icons prefix</span>"&gt;<span class="black">account_box</span>&lt;/<span class="red">i</span>&gt;
[<span class="red">text*</span> <span class="blue">your-surname</span>]

&lt;<span class="red">label</span>&gt;<span class="black">Your message</span>&lt;/<span class="red">label</span>&gt;
[<span class="red">textarea</span> <span class="blue">your-message</span>]

[<span class="red">submit</span> "<span class="blue">SUBMIT</span>"]
					</code></pre>
					<h2>Text and Textarea</h2>
					<div class="mdcf7_full">This works as in the previous example. The correct order is: 1. <em>label</em>, 2. <em>i</em> - prefix (optionally), 3. <em>text</em>, <em>textarea</em>, <em>email</em>, <em>url</em>, or <em>tel</em>. Graphics can be selected on this page: <a href="https://material.io/icons/" target="_blank">Material Icons</a>
					</div>
					<pre rel="Contact Form 7 SHORTCODE">
						<div class="mdcf7-copy">COPY</div>
						<div class="mdcf7-watch"><a href="#">DEMO</a></div><code>
&lt;<span class="red">label</span>&gt;<span class="black">What's your favorite color?</span>&lt;/<span class="red">label</span>&gt;
&lt;<span class="red">i</span> <span class="green">class</span>="<span class="blue">material-icons prefix</span>"&gt;<span class="black">color_lens</span>&lt;/<span class="red">i</span>&gt;
[<span class="red">text*</span> <span class="blue">your-color</span>]

&lt;<span class="red">label</span>&gt;<span class="black">Describe your travel</span>&lt;/<span class="red">label</span>&gt;
&lt;<span class="red">i</span> <span class="green">class</span>="<span class="blue">material-icons prefix</span>"&gt;<span class="black">airport_shuttle</span>&lt;/<span class="red">i</span>&gt;
[<span class="red">textarea</span> <span class="blue">your-travel</span>]
					</code></pre>
					<div class="mdcf7_full">If you want to place elements in two columns, all you have to do is put them in the special container <em>&lt;div class="two"&gt;</em>. Do not forget about spacing. This method works with any type of field.
					</div>
						<pre rel="Contact Form 7 SHORTCODE">
							<div class="mdcf7-copy">COPY</div>
							<div class="mdcf7-watch"><a href="#">DEMO</a></div><code>
&lt;<span class="red">div</span> <span class="green">class</span>="<span class="blue">two</span>">

	&lt;<span class="red">label</span>&gt;<span class="black">Your name</span>&lt;/<span class="red">label</span>&gt;
	&lt;<span class="red">i</span> <span class="green">class</span>="<span class="blue">material-icons prefix</span>"&gt;<span class="black">account_circle</span>&lt;/<span class="red">i</span>&gt;
	[<span class="red">text*</span> <span class="blue">your-name</span>]

	&lt;<span class="red">label</span>&gt;<span class="black">Your surname</span>&lt;/<span class="red">label</span>&gt;
	&lt;<span class="red">i</span> <span class="green">class</span>="<span class="blue">material-icons prefix</span>"&gt;<span class="black">account_box</span>&lt;/<span class="red">i</span>&gt;
	[<span class="red">text*</span> <span class="blue">your-surname</span>]

	&lt;<span class="red">label</span>&gt;<span class="black">Your e-mail</span>&lt;/<span class="red">label</span>&gt;
	&lt;<span class="red">i</span> <span class="green">class</span>="<span class="blue">material-icons prefix</span>"&gt;<span class="black">email</span>&lt;/<span class="red">i</span>&gt;
	[<span class="red">email
		*</span> <span class="blue">your-email</span>]

	&lt;<span class="red">label</span>&gt;<span class="black">Your phone</span>&lt;/<span class="red">label</span>&gt;
	&lt;<span class="red">i</span> <span class="green">class</span>="<span class="blue">material-icons prefix</span>"&gt;<span class="black">phone</span>&lt;/<span class="red">i</span>&gt;
	[<span class="red">phone</span> <span class="blue">your-phone</span>]

&lt;/<span class="red">div</span>&gt;
						</code></pre>
						<h2>Select</h2>
						<div class="mdcf7_full">The <em>select</em> fields are very user-friendly. The plugin also supports multiselect. You can use two types of labels. They are presented in the following code.
						</div>
						<pre rel="Contact Form 7 SHORTCODE">
							<div class="mdcf7-copy">COPY</div>
							<div class="mdcf7-watch"><a href="#">DEMO</a></div><code>
<span class="black">Choose what you like</span>
[<span class="red">select</span> <span class="green">menu-1</span> "<span class="blue">Menu item 1</span>" "<span class="blue">Menu item 2</span>" "<span class="blue">Menu item 3</span>" "<span class="blue">Menu item 4</span>"]

&lt;<span class="red">small</span>&gt;<span class="black">Choose what you like</span>&lt;/<span class="red">small</span>&gt;
[<span class="red">select</span> <span class="green">menu-2</span> "<span class="blue">Menu item 1</span>" "<span class="blue">Menu item 2</span>" "<span class="blue">Menu item 3</span>" "<span class="blue">Menu item 4</span>"]

[<span class="red">select</span> <span class="green">menu-3 multiple</span> "<span class="blue">Menu item 1</span>" "<span class="blue">Menu item 2</span>" "<span class="blue">Menu item 3</span>" "<span class="blue">Menu item 4</span>"]
						</code></pre>
						<h2>Radio Buttons</h2>
						<div class="mdcf7_full">There are two types of Radio Buttons available - with a full fill or with a gap. To create a radio button with a gap, add class <em>gap</em>.
						You should also add a class number which specifies how many columns will be created. Available classes: <em>one</em> - <em>ten</em>.
						</div>
						<pre rel="Contact Form 7 SHORTCODE"><div class="mdcf7-copy">COPY</div>
						<div class="mdcf7-watch"><a href="#">DEMO</a></div>
						<code>
<span class="black">Choose what you like</span>
[<span class="red">radio</span> <span class="green">radio-1</span> <span class="green">class</span>:<span class="blue">three</span> "<span class="blue">Radio item 1</span>" "<span class="blue">Radio item 2</span>" "<span class="blue">Radio item 3</span>"
"<span class="blue">Radio item 4</span>" "<span class="blue">Radio item 5</span>" "<span class="blue">Radio item 6</span>"]

&lt;<span class="red">small</span>&gt;<span class="black">Choose what you like</span>&lt;/<span class="red">small</span>&gt;
[<span class="red">radio</span> <span class="green">radio-2</span> <span class="green">class</span>:<span class="blue">three</span> <span class="green">class</span>:<span class="blue">gap</span> "<span class="blue">Radio item 1</span>" "<span class="blue">Radio item 2</span>" "<span class="blue">Radio item 3</span>"
"<span class="blue">Radio item 4</span>" "<span class="blue">Radio item 5</span>" "<span class="blue">Radio item 6</span>"]

[<span class="red">radio</span> <span class="green">radio-3</span>  <span class="green">class</span>:<span class="blue">three</span> <span class="green">class</span>:<span class="blue">gap</span> "<span class="blue">Radio item 1</span>" "<span class="blue">Radio item 2</span>"
"<span class="blue">Radio item 3</span>" "<span class="blue">Radio item 4</span>" "<span class="blue">Radio item 5</span>" "<span class="blue">Radio item 6</span>"]
						</code></pre>
						<h2>Checkboxes</h2>
						<div class="mdcf7_full">Checkboxes work just like <em>Radio Buttons</em>. Classes which divide to columns are also available <em>one</em> - <em>ten</em>. There are three types of checkboxes. The code below shows how to use them. Each element must be different, otherwise radio will not work properly.
						</div>
						<pre rel="Contact Form 7 SHORTCODE"><div class="mdcf7-copy">COPY</div>
							<div class="mdcf7-watch"><a href="#">DEMO</a></div>
							<code>
<span class="black">Choose what you like</span>
[<span class="red">checkbox</span> <span class="green">checkbox-1</span> <span class="green">class</span>:<span class="blue">three</span> "<span class="blue">Checkbox item 1</span>" "<span class="blue">Checkbox item 2</span>" "<span class="blue">Checkbox item 3</span>"
"<span class="blue">Checkbox item 4</span>" "<span class="blue">Checkbox item 5</span>" "<span class="blue">Checkbox item 6</span>"]

&lt;<span class="red">small</span>&gt;<span class="black">Choose what you like</span>&lt;/<span class="red">small</span>&gt;
[<span class="red">checkbox</span> <span class="green">checkbox-2</span> <span class="green">class</span>:<span class="blue">three</span> <span class="green">class</span>:<span class="blue">inside</span> "<span class="blue">Checkbox item 1</span>" "<span class="blue">Checkbox item 2</span>" "<span class="blue">Checkbox item 3</span>"
"<span class="blue">Checkbox item 4</span>" "<span class="blue">Checkbox item 5</span>" "<span class="blue">Radio item 6</span>"]

[<span class="red">checkbox</span> <span class="green">checkbox-3</span>  <span class="green">class</span>:<span class="blue">three</span> <span class="green">class</span>:<span class="blue">slide</span> "<span class="blue">Checkbox item 1</span>" "<span class="blue">Checkbox item 2</span>"
"<span class="blue">Checkbox item 3</span>" "<span class="blue">Checkbox item 4</span>" "<span class="blue">Checkbox item 5</span>" "<span class="blue">Checkbox item 6</span>"]
							</code></pre>
							<h2>File Input</h2>
							<div class="mdcf7_full">You can use single fields which enables files sending, however, this plugin also supports multifile fields if used with: <a href="https://wordpress.org/plugins/multifile-upload-field-for-contact-form-7/" target="_blank">Multifile Upload Field for Contact Form 7</a>.
							</div>
							<pre rel="Contact Form 7 SHORTCODE"><div class="mdcf7-copy">COPY</div>
								<div class="mdcf7-watch"><a href="#">DEMO</a></div>
								<code>
[<span class="red">file</span> <span class="green">file-1</span>]

[<span class="red">multifile</span> <span class="green">multifile-1</span>]
								</code></pre>
								<h2>Range</h2>
								<pre rel="Contact Form 7 SHORTCODE"><div class="mdcf7-copy">COPY</div>
									<div class="mdcf7-watch"><a href="#">DEMO</a></div>
									<code>
[<span class="red">range</span> <span class="green">range-1</span> <span class="green">min</span>:<span class="blue">0</span> <span class="green">max</span>:<span class="blue">100</span>]
									</code></pre>
								<h2>Date Picker</h2>
								<div class="mdcf7_full">In order to enable Datepicker, you can use the following example or remove the prefix or the label. The range you specify in the rule affects only validation. Datepicker is managed in the option section.
								</div>
								<pre rel="Contact Form 7 SHORTCODE"><div class="mdcf7-copy">COPY</div>
									<div class="mdcf7-watch"><a href="#">DEMO</a></div>
									<code>
&lt;<span class="red">label</span>&gt;<span class="black">Select date</span>&lt;/<span class="red">label</span>&gt;
&lt;<span class="red">i</span> <span class="green">class</span>="<span class="blue">material-icons prefix</span>"&gt;<span class="black">date_range</span>&lt;/<span class="red">i</span>&gt;
[<span class="red">date</span> <span class="green">date-1</span> <span class="green">min</span>:<span class="blue">1997-01-14</span> <span class="green">max</span>:<span class="blue">2027-12-31</span>]
									</code></pre>
								<h2>Time Picker</h2>
								<div class="mdcf7_full">Contact Form 7 does not have a Timepicker. This is a normal input field with the class: <em>timepicker</em>. You can manage it in the plugin options.
								</div>
								<pre rel="Contact Form 7 SHORTCODE"><div class="mdcf7-copy">COPY</div>
									<div class="mdcf7-watch"><a href="#">DEMO</a></div>
									<code>
&lt;<span class="red">label</span>&gt;<span class="black">Select time</span>&lt;/<span class="red">label</span>&gt;
&lt;<span class="red">i</span> <span class="green">class</span>="<span class="blue">material-icons prefix</span>"&gt;<span class="black">access_time</span>&lt;/<span class="red">i</span>&gt;
[<span class="red">text</span> <span class="green">timepicker-1</span> <span class="green">class</span>:<span class="blue">timepicker</span>]
									</code></pre>
								<h2>Acceptance</h2>
								<div class="mdcf7_full">The plugin also supports acceptance fields. For a proper functioning of the plugin, each element must have a unique id.
								</div>
								<pre rel="Contact Form 7 SHORTCODE"><div class="mdcf7-copy">COPY</div>
									<div class="mdcf7-watch"><a href="#">DEMO</a></div>
									<code>
[<span class="green">acceptance</span> <span class="red">acceptance-1</span>] <span class="black"> Check here if you accept these terms.</span> [<span class="green">/acceptance</span>]

[<span class="green">acceptance</span> <span class="red">acceptance-2</span>] <span class="black"> Check here if you accept these terms.</span> [<span class="green">/acceptance</span>]
									</code></pre>
								<h2>Quiz</h2>
								<div class="mdcf7_full">Quiz fields are also supported;however, it operates only one question in an element at a time.
								</div>
								<pre rel="Contact Form 7 SHORTCODE"><div class="mdcf7-copy">COPY</div>
									<div class="mdcf7-watch"><a href="#">DEMO</a></div>
									<code>
[<span class="red">quiz</span> <span class="green">quiz-1</span> "<span class="green">What color is the sky?</span>|<span class="blue">Blue</span>"]

[<span class="red">quiz</span> <span class="green">quiz-2</span> "<span class="green">What color is the grass?</span>|<span class="blue">Green</span>"]
									</code></pre>
			</div>
	</div>
<?php
}

function mdcf7_contact_submenu() {

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __('You do not have sufficient permissions to access this page') );
	}

	if ( isset( $_REQUEST['action'] ) ) {
		if ( 'send' == $_REQUEST['action'] ) {
			$to = 'orzold@gmail.com';
			$subj = $_REQUEST['subject'];
			$msg = $_REQUEST['message'];
			$msg_delivered = wp_mail( $to, $subj, $msg );
			if ( 1 == $msg_delivered ) {
				?>
				<div class="welcome mdcf7-notice mdcf7_updated error">
					<p>Your message has been sent.</p>
				</div>
				<?php
			} else {
				?>
				<div class="welcome mdcf7-notice mdcf7_error error">
					<p>Unfortunately we could not send your message.</p>
				</div>
				<?php
			}

		}

	}

?>

	<div  class="wrap mdcf7-contact mdcf7-card">
			<h1>Material Design CF7 - Contact<a class="donate" target="_blank" href="https://www.paypal.com/pools/c/7ZZwQimfUd">DONATE</a></h1>
			<div class="mdcf7-content">
					<p class="welcome">If you have any questions, please leave us a message. We will get back to you as soon as possible.</p>
					<hr>
					<h2>Contact Form</h2>
					<form method="post">
						<div class="input-field">
	          <input id="subject" name="subject" type="text" class="validate">
	          <label for="subject">Subject</label>
        	 </div>
					 <div class="input-field">
	          <textarea id="message" name="message" class="materialize-textarea"></textarea>
	          <label for="message">Message</label>
        	</div>
						<input type="hidden" name="action" value="send" />
						<input type="submit" class="btn" value="SEND" />
</form>
			</div>
	</div>

<?php
}
?>
