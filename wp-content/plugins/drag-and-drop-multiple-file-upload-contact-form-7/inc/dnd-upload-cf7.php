<?php

	/**
	* @Description : Plugin main core
	* @Package : Drag & Drop Multiple File Upload - Contact Form 7
	* @Author : Glen Don L. Mongaya
	*/

	if ( ! defined( 'ABSPATH' ) || ! defined('dnd_upload_cf7') ) {
		exit;
	}

	/**
	* Begin : begin plugin hooks
	*/

	add_action( 'wpcf7_init', 'dnd_cf7_upload_add_form_tag_file' );
	add_action( 'wpcf7_enqueue_scripts', 'dnd_cf7_scripts' );

	// Hook language init
	add_action('plugins_loaded','dnd_load_plugin_textdomain');

	// Ajax Upload
	add_action( 'wp_ajax_dnd_codedropz_upload', 'dnd_upload_cf7_upload' );
	add_action( 'wp_ajax_nopriv_dnd_codedropz_upload', 'dnd_upload_cf7_upload' );

	// Hook - Ajax Delete
	add_action('wp_ajax_nopriv_dnd_codedropz_upload_delete', 'dnd_codedropz_upload_delete');
	add_action('wp_ajax_dnd_codedropz_upload_delete','dnd_codedropz_upload_delete');

	// Hook mail cf7
	add_filter('wpcf7_posted_data', 'dnd_wpcf7_posted_data', 10, 1);
	add_action('wpcf7_before_send_mail','dnd_cf7_before_send_mail', 30, 1);
	add_action('wpcf7_mail_components','dnd_cf7_mail_components', 50, 2);

	// Auto clean up dir/files
	add_action('template_redirect', 'dnd_cf7_auto_clean_dir', 20, 0 );

	// Add row meta links
	add_filter( 'plugin_row_meta', 'dnd_custom_plugin_row_meta', 10, 2 );

	// Add custom mime-type
	add_filter('upload_mimes', 'dnd_extra_mime_types', 1, 1);

	// Add Submenu - Settings
	add_action('admin_menu', 'dnd_admin_settings');

	// Load plugin text-domain
	function dnd_load_plugin_textdomain() {
		load_plugin_textdomain( 'dnd-upload-cf7', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
	}

	// Modify contact form posted_data
	function dnd_wpcf7_posted_data( $posted_data ){

		// Subbmisson instance from CF7
		$submission = WPCF7_Submission::get_instance();

		// Make sure we have the data
		if ( ! $posted_data ) {
            $posted_data = $submission->get_posted_data();
        }

		// Scan and get all form tags from cf7 generator
		$forms_tags = $submission->get_contact_form();
		$uploads_dir = dnd_get_upload_dir();

		if( $forms = $forms_tags->scan_form_tags() ) {
			foreach( $forms as $field ) {
				$field_name = $field->name;
				if( $field->basetype == 'mfile' && isset( $posted_data[$field_name] ) && ! empty( $posted_data[$field_name] ) ) {
					foreach( $posted_data[$field_name] as $key => $file ) {
						$posted_data[$field_name][$key] = trailingslashit( $uploads_dir['upload_url'] ) . basename( $file );
					}
				}
			}
		}

		return $posted_data;
	}

	// Hooks for admin settings
	function dnd_admin_settings() {
		add_submenu_page( 'wpcf7', 'Drag & Drop Uploader - Settings', 'Drag & Drop Upload', 'manage_options', 'drag-n-drop-upload','dnd_upload_admin_settings');
		add_action('admin_init','dnd_upload_register_settings');
	}

	// Add custom mime-types
	function dnd_extra_mime_types( $mime_types ){
		$mime_types['xls'] = 'application/excel, application/vnd.ms-excel, application/x-excel, application/x-msexcel';
		$mime_types['xlsx'] = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
		return $mime_types;
	}

	// Default Error Message
	function dnd_cf7_error_msg( $error_key ) {

		// Array of default error message
		$errors = array(
			'server_limit'		=>	__('The uploaded file exceeds the maximum upload size of your server.','dnd-upload-cf7'),
			'failed_upload'		=>	__('Uploading a file fails for any reason','dnd-upload-cf7'),
			'large_file'		=>	__('Uploaded file is too large','dnd-upload-cf7'),
			'invalid_type'		=>	__('Uploaded file is not allowed for file type','dnd-upload-cf7'),
			'max_file_limit'	=>	__('Note : Some of the files are not uploaded ( Only %count% files allowed )','dnd-upload-cf7'),
		);

		// return error message based on $error_key request
		if( isset( $errors[ $error_key ] ) ) {
			return $errors[ $error_key ];
		}

		return false;
	}

	// Get folder path
	function dnd_get_upload_dir() {
		$upload = wp_upload_dir();
		$uploads_dir = wpcf7_dnd_dir . '/wpcf7-files';

		// If save as attachment ( also : Check if upload use year and month folders )
		if( get_option('drag_n_drop_mail_attachment') == 'yes' ) {
			$uploads_dir = ( get_option('uploads_use_yearmonth_folders') ? wpcf7_dnd_dir . $upload['subdir'] : wpcf7_dnd_dir );
		}

		// Create directory
		if ( ! is_dir( trailingslashit( $upload['basedir'] ) . $uploads_dir ) ) {
			wp_mkdir_p( trailingslashit( $upload['basedir'] ) . $uploads_dir );
		}

		// Make sure directory exist before returning
		if( file_exists( trailingslashit( $upload['basedir'] ) . $uploads_dir ) ) {
			return array(
				'upload_dir'	=>	trailingslashit( $upload['basedir'] ) . $uploads_dir,
				'upload_url'	=>	trailingslashit( $upload['baseurl'] ) . $uploads_dir
			);
		}

		return trailingslashit( $upload['basedir'] ) . $uploads_dir;
	}

	// Clean up directory - From Contact Form 7
	function dnd_cf7_auto_clean_dir( $seconds = 3600, $max = 60 ) {
		if ( is_admin() || 'GET' != $_SERVER['REQUEST_METHOD'] || is_robots() || is_feed() || is_trackback() ) {
			return;
		}

		// Setup dirctory path
		$upload = wp_upload_dir();
		$dir = trailingslashit( $upload['basedir'] ) . wpcf7_dnd_dir . '/wpcf7-files/';

		// Make sure dir is readable or writable
		if ( ! is_dir( $dir ) || ! is_readable( $dir ) || ! wp_is_writable( $dir ) ) {
			return;
		}

		$seconds = apply_filters( 'dnd_cf7_auto_delete_files', $seconds );
		$max = absint( $max );
		$count = 0;

		if ( $handle = @opendir( $dir ) ) {
			while ( false !== ( $file = readdir( $handle ) ) ) {
				if ( $file == "." || $file == ".." ) {
					continue;
				}

				// Get file time of files OLD files.
				$mtime = @filemtime( $dir . $file );

				if ( $mtime && time() < $mtime + absint( $seconds ) ) { // less than $seconds old
					continue;
				}

				// Delete files from dir
				wp_delete_file( $dir . $file );

				$count += 1;

				if ( $max <= $count ) {
					break;
				}
			}
			@closedir( $handle );
		}
		@rmdir( $dir );
	}

	// Hooks before sending the email - ( append links to body email )
	function dnd_cf7_before_send_mail( $wpcf7 ){
		global $_mail;

		// Get upload path / dir
		$upload_path = dnd_get_upload_dir();

		// Mail Counter
		$_mail = 0;

		// Check If send attachment as link
		if( ! get_option('drag_n_drop_mail_attachment') ) {
			return $wpcf7;
		}

		// cf7 instance
		$submission = WPCF7_Submission::get_instance();

		// Check for submission
		if( $submission ) {

			// Get posted data
			$submitted['posted_data'] = $submission->get_posted_data();

			// Parse fields
			$fields = $wpcf7->scan_form_tags();

			// Prop email
			$mail = $wpcf7->prop('mail');
			$mail_2 = $wpcf7->prop('mail_2');

			// Default upload path
			$simple_path = dirname( $upload_path['upload_url'] ); // dirname - remove duplicate form dir (/wpcf-dnd-uploads/wpcf7-dnd-uploads/example.jpg)

			// Loop fields and replace mfile code
			foreach( $fields as $field ) {
				if( $field->basetype == 'mfile') {
					if( isset( $submitted['posted_data'][$field->name] ) && ! empty( $submitted['posted_data'][$field->name] ) ) {
						$files = implode( "\n" , $submitted['posted_data'][$field->name] );
						$mail['body'] = str_replace( "[$field->name]", "\n" . $files, $mail['body'] );
						if( $mail_2['active'] ) {
							$mail_2['body'] = str_replace( "[$field->name]", "\n" . $files, $mail_2['body'] );
						}
					}
				}
			}

			// Save the email body
			$wpcf7->set_properties( array("mail" => $mail) );

			// if mail 2
			if( $mail_2['active'] ) {
				$wpcf7->set_properties( array("mail_2" => $mail_2) );
			}
		}

		return $wpcf7;
	}

	// hooks - Custom cf7 Mail components ( Attached File on Email )
	function dnd_cf7_mail_components( $components, $form ) {
		global $_mail;

		// Get upload directory
		$uploads_dir = dnd_get_upload_dir();

		// cf7 - Submission Object
		$submission = WPCF7_Submission::get_instance();

		// get all form fields
		$fields = $form->scan_form_tags();

		// Send email link as an attachment.
		if( get_option('drag_n_drop_mail_attachment') == 'yes' ) {
			return $components;
		}

		// If mail_2 is set - Do not send attachment ( unless File Attachment field is not empty )
		if( ( $mail_2 = $form->prop('mail_2') ) && $mail_2['active'] && empty( $mail_2['attachments'] ) && $_mail >= 1 ) {
			return $components;
		}

		// Loop fields get mfile only.
		foreach( $fields as $field ) {

			// If field type equal to mfile which our default field.
			if( $field->basetype == 'mfile') {

				// Make sure we have files to attach
				if( isset( $_POST[ $field->name ] ) && count( $_POST[ $field->name ] ) > 0 ) {

					// Loop all the files and attach to cf7 components
					foreach( $_POST[ $field->name ] as $_file ) {

						// Join dir and a new file name ( get from <input type="hidden" name="upload-file-333"> )
						$new_file_name = trailingslashit( $uploads_dir['upload_dir'] ) . basename( $_file );

						// Check if submitted and file exists then file is ready.
						if ( $submission && file_exists( $new_file_name ) ) {
							$components['attachments'][] = $new_file_name;
						}
					}
				}

			}
		}

		// Increment mail counter
		$_mail = $_mail + 1;

		// Return setup components
		return $components;
	}

	// Load js and css
	function dnd_cf7_scripts() {

		// Get plugin version
		$version = dnd_upload_cf7_version;

		// enque script
		wp_enqueue_script( 'codedropz-uploader', plugins_url ('/assets/js/codedropz-uploader-min.js', dirname(__FILE__) ), array('jquery'), $version, true );
		wp_enqueue_script( 'dnd-upload-cf7', plugins_url ('/assets/js/dnd-upload-cf7.js', dirname(__FILE__) ), array('jquery','codedropz-uploader','contact-form-7'), $version, true );

		//  registered script with data for a JavaScript variable.
		wp_localize_script( 'dnd-upload-cf7', 'dnd_cf7_uploader',
			array(
				'ajax_url' 				=> admin_url( 'admin-ajax.php' ),
				'drag_n_drop_upload' 	=> array(
					'text'				=>	( get_option('drag_n_drop_text') ? get_option('drag_n_drop_text') : __('Drag & Drop Files Here','dnd-upload-cf7') ),
					'or_separator'		=>	( get_option('drag_n_drop_separator') ? get_option('drag_n_drop_separator') : __('or','dnd-upload-cf7') ),
					'browse'			=>	( get_option('drag_n_drop_browse_text') ? get_option('drag_n_drop_browse_text') : __('Browse Files','dnd-upload-cf7') ),
					'server_max_error'	=>	( get_option('drag_n_drop_error_server_limit') ? get_option('drag_n_drop_error_server_limit') : dnd_cf7_error_msg('server_limit') ),
					'large_file'		=>	( get_option('drag_n_drop_error_files_too_large') ? get_option('drag_n_drop_error_files_too_large') : dnd_cf7_error_msg('large_file') ),
					'inavalid_type'		=>	( get_option('drag_n_drop_error_invalid_file') ? get_option('drag_n_drop_error_invalid_file') : dnd_cf7_error_msg('invalid_type') ),
					'max_file_limit'	=>	( get_option('drag_n_drop_error_max_file') ? get_option('drag_n_drop_error_max_file') : dnd_cf7_error_msg('max_file_limit') ),
				)
			)
		);

		// enque style
		wp_enqueue_style( 'dnd-upload-cf7', plugins_url ('/assets/css/dnd-upload-cf7.css', dirname(__FILE__) ), '', $version );
	}

	// Generate tag
	function dnd_cf7_upload_add_form_tag_file() {
		wpcf7_add_form_tag(	array( 'mfile ', 'mfile*'), 'dnd_cf7_upload_form_tag_handler', array( 'name-attr' => true ) );
	}

	// Form tag handler from the tag - callback
	function dnd_cf7_upload_form_tag_handler( $tag ) {

		// check and make sure tag name is not empty
		if ( empty( $tag->name ) ) {
			return '';
		}

		// Validate our fields
		$validation_error = wpcf7_get_validation_error( $tag->name );

		// Generate class
		$class = wpcf7_form_controls_class( 'drag-n-drop-file d-none' );

		// Add not-valid class if there's an error.
		if ( $validation_error ) {
			$class .= ' wpcf7-not-valid';
		}

		// Setup element attributes
		$atts = array();

		$atts['size'] = $tag->get_size_option( '40' );
		$atts['class'] = $tag->get_class_option( $class );
		$atts['id'] = $tag->get_id_option();
		$atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );

		// If file is required
		if ( $tag->is_required() ) {
			$atts['aria-required'] = 'true';
		}

		// Set invalid attributes if there's validation error
		$atts['aria-invalid'] = $validation_error ? 'true' : 'false';

		// Set input type and name
		$atts['type'] = 'file';
		$atts['multiple'] = 'multiple';
		$atts['data-name'] = $tag->name;
		$atts['data-type'] = $tag->get_option( 'filetypes','', true);
		$atts['data-limit'] = $tag->get_option( 'limit','', true);
		$atts['data-max'] = $tag->get_option( 'max-file','', true);

		// Combine and format attrbiutes
		$atts = wpcf7_format_atts( $atts );

		// Return our element and attributes
		return sprintf('<span class="wpcf7-form-control-wrap %1$s"><input %2$s />%3$s</span>',	sanitize_html_class( $tag->name ), $atts, $validation_error );
	}

	// Encode type filter to support multipart since this is input type file
	add_filter( 'wpcf7_form_enctype', 'dnd_upload_cf7_form_enctype_filter' );

	function dnd_upload_cf7_form_enctype_filter( $enctype ) {
		$multipart = (bool) wpcf7_scan_form_tags( array( 'type' => array( 'drag_drop_file', 'drag_drop_file*' ) ) );

		if ( $multipart ) {
			$enctype = 'multipart/form-data';
		}

		return $enctype;
	}

	// Validation + upload handling filter
	add_filter( 'wpcf7_validate_mfile', 'dnd_upload_cf7_validation_filter', 10, 2 );
	add_filter( 'wpcf7_validate_mfile*', 'dnd_upload_cf7_validation_filter', 10, 2 );

	function dnd_upload_cf7_validation_filter( $result, $tag ) {
		$name = $tag->name;
		$id = $tag->get_id_option();

		$multiple_files = ( isset( $_POST[ $name ] ) ? $_POST[ $name ] : null );

		// Check if we have files or if it's empty
		if( ( is_null( $multiple_files ) || count( $multiple_files ) == 0 ) && $tag->is_required() ) {
			$result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
			return $result;
		}

		return $result;
	}

	// Generate Admin From Tag
	add_action( 'wpcf7_admin_init', 'dnd_upload_cf7_add_tag_generator', 50 );

	function dnd_upload_cf7_add_tag_generator() {
		$tag_generator = WPCF7_TagGenerator::get_instance();
		$tag_generator->add( 'upload-file', __( 'multiple file upload', 'dnd-upload-cf7' ),'dnd_upload_cf7_tag_generator_file' );
	}

	// Display form in admin
	function dnd_upload_cf7_tag_generator_file( $contact_form, $args = '' ) {

		// Parse data and get our options
		$args = wp_parse_args( $args, array() );

		// Our multiple upload field
		$type = 'mfile';

		$description = __( "Generate a form-tag for a file uploading field. For more details, see %s.", 'contact-form-7' );
		$desc_link = wpcf7_link( __( 'https://contactform7.com/file-uploading-and-attachment/', 'contact-form-7' ), __( 'File Uploading and Attachment', 'contact-form-7' ) );

		?>

		<div class="control-box">
			<fieldset>
				<legend><?php echo sprintf( esc_html( $description ), $desc_link ); ?></legend>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></th>
							<td>
								<fieldset>
									<legend class="screen-reader-text"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></legend>
									<label><input type="checkbox" name="required" /> <?php echo esc_html( __( 'Required field', 'contact-form-7' ) ); ?></label>
								</fieldset>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?></label></th>
							<td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-limit' ); ?>"><?php echo esc_html( __( "File size limit (bytes)", 'contact-form-7' ) ); ?></label></th>
							<td><input type="text" name="limit" class="filesize oneline option" id="<?php echo esc_attr( $args['content'] . '-limit' ); ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-filetypes' ); ?>"><?php echo esc_html( __( 'Acceptable file types', 'contact-form-7' ) ); ?></label></th>
							<td><input type="text" name="filetypes" class="filetype oneline option" placeholder="jpeg|png|jpg|gif" id="<?php echo esc_attr( $args['content'] . '-filetypes' ); ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-max-file' ); ?>"><?php echo esc_html( __( 'Max file upload', 'contact-form-7' ) ); ?></label></th>
							<td><input type="text" name="max-file" class="filetype oneline option" placeholder="10" id="<?php echo esc_attr( $args['content'] . '-max-file' ); ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-id' ); ?>"><?php echo esc_html( __( 'Id attribute', 'contact-form-7' ) ); ?></label></th>
							<td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-id' ); ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class attribute', 'contact-form-7' ) ); ?></label></th>
							<td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</div>

		<div class="insert-box">
			<input type="text" name="<?php echo $type; ?>" class="tag code" readonly="readonly" onfocus="this.select()" />
			<div class="submitbox">
				<input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
			</div>
			<br class="clear" />
			<p class="description mail-tag">
				<label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>"><?php echo sprintf( esc_html( __( "To attach the file uploaded through this field to mail, you need to insert the corresponding mail-tag (%s) into the File Attachments field on the Mail tab.", 'contact-form-7' ) ), '<strong><span class="mail-tag"></span></strong>' ); ?><input type="text" class="mail-tag code hidden" readonly="readonly" id="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>" /></label>
			</p>
		</div>

		<?php
	}

	// Begin process upload
	function dnd_upload_cf7_upload() {

		// Get upload dir
		$path = dnd_get_upload_dir();

		// input type file 'name'
		$name = 'upload-file';

		$file = isset( $_FILES[$name] ) ? $_FILES[$name] : null;

		// Tells whether the file was uploaded via HTTP POST
		if ( ! is_uploaded_file( $file['tmp_name'] ) ) {
			wp_send_json_error( get_option('drag_n_drop_error_failed_to_upload') ? get_option('drag_n_drop_error_failed_to_upload') : dnd_cf7_error_msg('failed_upload') );
		}

		/* File type validation */
		$file_type_pattern = dnd_upload_cf7_filetypes( $_POST['supported_type'] );

		// validate file type
		if ( ! preg_match( $file_type_pattern, $file['name'] ) ) {
			wp_send_json_error( get_option('drag_n_drop_error_invalid_file') ? get_option('drag_n_drop_error_invalid_file') : dnd_cf7_error_msg('invalid_type') );
		}

		// validate file size limit
		if( $file['size'] > (int)$_POST['size_limit'] ) {
			wp_send_json_error( get_option('drag_n_drop_error_files_too_large') ? get_option('drag_n_drop_error_files_too_large') : dnd_cf7_error_msg('large_file') );
		}

		// Create file name
		$filename = $file['name'];
		$filename = wpcf7_canonicalize( $filename, 'as-is' );
		$filename = wpcf7_antiscript_file_name( $filename );

		// Add filter on upload file name
		$filename = apply_filters( 'wpcf7_upload_file_name', $filename,	$file['name'] );

		// Generate new filename
		$filename = wp_unique_filename( $path['upload_dir'], $filename );
		$new_file = path_join( $path['upload_dir'], $filename );

		// Upload File
		if ( false === move_uploaded_file( $file['tmp_name'], $new_file ) ) {
			wp_send_json_error( get_option('drag_n_drop_error_failed_to_upload') ? get_option('drag_n_drop_error_failed_to_upload') : dnd_cf7_error_msg('failed_upload') );
		}else{

			$files = array(
				'path'	=>	basename( $path['upload_dir'] ),
				'file'	=>	str_replace('/','-', $filename )
			);

			// Change file permission to 0400
			chmod( $new_file, 0644 );

			wp_send_json_success( $files );
		}

		die;
	}

	// Delete file
	function dnd_codedropz_upload_delete() {

		// Get upload dir
		$upload_dir = dnd_get_upload_dir();

		// Make sure path is set
		if( isset( $_POST['path'] ) && ! empty( $_POST['path'] ) ) {
			$file_path = trailingslashit( dirname( $upload_dir['upload_dir'] ) ) . trim( $_POST['path'] );
			if( file_exists( $file_path ) ){
				wp_delete_file( $file_path );
				wp_send_json_success( 'true' );
			}
		}

		die;
	}

	// Setup file type pattern for validation
	function dnd_upload_cf7_filetypes( $types ) {
		$file_type_pattern = '';

		// If contact form 7 5.0 and up
		if( function_exists('wpcf7_acceptable_filetypes') ) {
			$file_type_pattern = wpcf7_acceptable_filetypes( $types, 'regex' );
			$file_type_pattern = '/\.(' . $file_type_pattern . ')$/i';
		}else{
			$allowed_file_types = array();
			$file_types = explode( '|', $types );

			foreach ( $file_types as $file_type ) {
				$file_type = trim( $file_type, '.' );
				$file_type = str_replace( array( '.', '+', '*', '?' ), array( '\.', '\+', '\*', '\?' ), $file_type );
				$allowed_file_types[] = $file_type;
			}

			$allowed_file_types = array_unique( $allowed_file_types );
			$file_type_pattern = implode( '|', $allowed_file_types );

			$file_type_pattern = trim( $file_type_pattern, '|' );
			$file_type_pattern = '(' . $file_type_pattern . ')';
			$file_type_pattern = '/\.' . $file_type_pattern . '$/i';
		}

		return $file_type_pattern;
	}

	// Admin Settings
	function dnd_upload_admin_settings( ) {
		echo '<div class="wrap">';
			echo '<h1>Drag & Drop Uploader - Settings</h1>';

				echo '<div class="update-nag notice" style="width: 98%;padding: 0px 10px;margin-bottom: 5px;">';
					echo '<p>Checkout more features on <a href="https://codedropz.com/purchase-plugin/" target="_blank">Pro Version</a></p>';
				echo '</div>';

				// Error settings
				settings_errors();

				echo '<form method="post" action="options.php"> ';
					settings_fields( 'drag-n-drop-upload-file-cf7' );
					do_settings_sections( 'drag-n-drop-upload-file-cf7' );
		?>

				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e('Send Attachment as links?','dnd-upload-cf7'); ?></th>
						<td><input name="drag_n_drop_mail_attachment" type="checkbox" value="yes" <?php checked('yes', get_option('drag_n_drop_mail_attachment')); ?>></td>
					</tr>
				</table>

				<h2><?php _e('Uploader Info','dnd-upload-cf7'); ?></h2>

				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e('Drag & Drop Text','dnd-upload-cf7'); ?></th>
						<td><input type="text" name="drag_n_drop_text" class="regular-text" value="<?php echo esc_attr( get_option('drag_n_drop_text') ); ?>" placeholder="Drag & Drop Files Here" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"></th>
						<td><input type="text" name="drag_n_drop_separator" value="<?php echo esc_attr( get_option('drag_n_drop_separator') ); ?>" placeholder="or" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e('Browse Text','dnd-upload-cf7'); ?></th>
						<td><input type="text" name="drag_n_drop_browse_text" class="regular-text" value="<?php echo esc_attr( get_option('drag_n_drop_browse_text') ); ?>" placeholder="Browse Files" /></td>
					</tr>
				</table>

				<h2><?php _e('Error Message','dnd-upload-cf7'); ?></h2>

				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e('File exceeds server limit','dnd-upload-cf7'); ?></th>
						<td><input type="text" name="drag_n_drop_error_server_limit" class="regular-text" value="<?php echo esc_attr( get_option('drag_n_drop_error_server_limit') ); ?>" placeholder="<?php echo dnd_cf7_error_msg('server_limit'); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e('Failed to Upload','dnd-upload-cf7'); ?></th>
						<td><input type="text" name="drag_n_drop_error_failed_to_upload" class="regular-text" value="<?php echo esc_attr( get_option('drag_n_drop_error_failed_to_upload') ); ?>" placeholder="<?php echo dnd_cf7_error_msg('failed_upload'); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e('Files too large','dnd-upload-cf7'); ?></th>
						<td><input type="text" name="drag_n_drop_error_files_too_large" class="regular-text" value="<?php echo esc_attr( get_option('drag_n_drop_error_files_too_large') ); ?>" placeholder="<?php echo dnd_cf7_error_msg('large_file'); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e('Invalid file Type','dnd-upload-cf7'); ?></th>
						<td><input type="text" name="drag_n_drop_error_invalid_file" class="regular-text" value="<?php echo esc_attr( get_option('drag_n_drop_error_invalid_file') ); ?>" placeholder="<?php echo dnd_cf7_error_msg('invalid_type'); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e('Max File Limit','dnd-upload-cf7'); ?></th>
						<td><input type="text" name="drag_n_drop_error_max_file" class="regular-text" value="<?php echo esc_attr( get_option('drag_n_drop_error_max_file') ); ?>" placeholder="" /><p class="description">Example: `Note : Some of the files are not uploaded ( Only %count% files allowed )`</p></td>
					</tr>
				</table>

				<?php submit_button(); ?>

		<?php
			echo '</form>';
		echo '</div>';
	}

	// Add custom links
	function dnd_custom_plugin_row_meta( $links, $file ) {
		if ( strpos( $file, 'drag-n-drop-upload-cf7.php' ) !== false ) {
			$new_links = array('pro-version' => '<a href="https://codedropz.com/purchase-plugin/" target="_blank" style="font-weight:bold; color:#f4a647;">Pro Version</a>');
			$links = array_merge( $links, $new_links );
		}
		return $links;
	}

	// Save admin settings
	function dnd_upload_register_settings() {
		register_setting( 'drag-n-drop-upload-file-cf7', 'drag_n_drop_mail_attachment','sanitize_text_field' );
		register_setting( 'drag-n-drop-upload-file-cf7', 'drag_n_drop_text','sanitize_text_field' );
		register_setting( 'drag-n-drop-upload-file-cf7', 'drag_n_drop_separator','sanitize_text_field' );
		register_setting( 'drag-n-drop-upload-file-cf7', 'drag_n_drop_browse_text','sanitize_text_field' );
		register_setting( 'drag-n-drop-upload-file-cf7', 'drag_n_drop_error_server_limit','sanitize_text_field' );
		register_setting( 'drag-n-drop-upload-file-cf7', 'drag_n_drop_error_failed_to_upload','sanitize_text_field' );
		register_setting( 'drag-n-drop-upload-file-cf7', 'drag_n_drop_error_files_too_large','sanitize_text_field' );
		register_setting( 'drag-n-drop-upload-file-cf7', 'drag_n_drop_error_invalid_file','sanitize_text_field' );
		register_setting( 'drag-n-drop-upload-file-cf7', 'drag_n_drop_error_max_file','sanitize_text_field' );
	}