<?php
/**
 * Plugin Name: [Forminator] - Custom Forminator upload path.
 * Description: [Forminator] - Custom Forminator upload path: wp-content/uploads/[your-custom-folder]/([user-name|user-id])/([form-id])/([field-value])/([year])/([month])
 * Author: Thobk @ WPMUDEV
 * Author URI: https://premium.wpmudev.org
 * License: GPLv2 or later
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } elseif ( defined( 'WP_CLI' ) && WP_CLI ) { return; }

add_action( 'plugins_loaded', 'wpmudev_forminator_custom_upload_files_path_func', 100 );

function wpmudev_forminator_custom_upload_files_path_func() {
	if ( defined('FORMINATOR_PRO') && class_exists( 'Forminator' ) ) {
		
		class WPMUDEV_Forminator_Custom_Upload_Path{
			public $form_ids = array();//Enter list form ids which you want to custom uploads path, e.g array(123, 456, ). Leave empty to apply this custom code for all forms.
			public $sub_folder = ''; //wp-content/uploads/[your-custom-folder].
			public $hash_folder = false;// if enabled it, the folder will be hash with method crc32 (the result like this: 3d653119 ), source: https://www.php.net/manual/en/function.hash.php
			public $separated_by_user = null;//'ID' | 'user_login' | 'user_email': /wp-content/uploads/[sub-folder]/[user-id|user-name]/
			public $separated_by_form_id = false;// Enable this to save images in folder /wp-content/uploads/[sub-folder]/[form-id]/.
			public $folder_field_key = null;//enter field id here (e.g 'email-1'): /wp-content/uploads/[sub-folder]/[form-id]/[field-value]/
			public $separated_by_month_year = true;// Enable this to save images in folder /wp-content/

			private static $_instance;
			public function __construct(){

				add_filter( 'forminator_form_before_save_entry', array( $this, 'add_anchor_change_upload_dir_byname' ), 10, 1 );
				add_filter( 'upload_dir', array( $this, 'upload_dir' ) );
				add_action( 'forminator_form_after_save_entry', array( $this, 'remove_anchor_change_upload_dir_byname' ), 10, 2 );
			}

			public static function get_instance(){
				if( is_null( self::$_instance ) ){
					self::$_instance = new self();
				}
				return self::$_instance;
			}

			function add_anchor_change_upload_dir_byname( $form_id ){
				global $wpmudev_forminator_upload_dir_form_id;
				if( $this->form_ids && ! in_array( $form_id, $this->form_ids ) ){
					return;
				}
				$wpmudev_forminator_upload_dir_form_id = $form_id;
			}

			public function get_upload_path( $uploads ){
				$upload_path = trailingslashit( $uploads['basedir'] );// wp-content/uploads
				// $upload_path = ABSPATH;

				if( $this->sub_folder ){
					$upload_path .= $this->get_sub_folder();
				}
				return $upload_path;
			}

			public function get_sub_folder(){
				global $wpmudev_forminator_upload_dir_form_id;
				$sub_folder = $this->sub_folder;
				if( $this->hash_folder ){
					$sub_folder = hash('crc32', $sub_folder);
				}

				$sub_folder = trailingslashit( $sub_folder );

				// separated by current user.
				if( $this->separated_by_user && is_user_logged_in() ){
					$user = wp_get_current_user();
					if( isset( $user->{$this->separated_by_user} ) ){
						$sub_folder .= sanitize_key( $user->{$this->separated_by_user} ) .'/';
					}
				}

				// separated upload path by form id: wp-content/uploads/[sub-folder]/[form-id].
				if( $this->separated_by_form_id ){
					$sub_folder .= $wpmudev_forminator_upload_dir_form_id .'/';
				}

				// separated upload path by field value: wp-content/uploads/[sub-folder]/[form-id]/[field-value]
				if( $this->folder_field_key && ! empty( $_POST[ $this->folder_field_key ] ) ){
					$sub_folder .= sanitize_key( $_POST[ $this->folder_field_key ] ) .'/';
				}

				// separated by current user.
				// if( $this->separated_by_user && is_user_logged_in() ){
				// 	$user = wp_get_current_user();
				// 	if( isset( $user->{$this->separated_by_user} ) ){
				// 		$sub_folder .= sanitize_key( $user->{$this->separated_by_user} ) .'/';
				// 	}
				// }

				if( $this->separated_by_month_year ){
					$sub_folder .= date('Y') .'/';
					$sub_folder .= date('m') .'/';
				}

				return $sub_folder;
			}

			function upload_dir( $uploads ){
				global $wpmudev_forminator_upload_dir_form_id;

				if( $wpmudev_forminator_upload_dir_form_id && ! empty( $uploads['path'] ) ){
					$uploads['path'] = $this->get_upload_path( $uploads );

					$uploads['url'] = str_replace( ABSPATH, site_url('/'), $uploads['path'] );
				}
				return $uploads;
			}

			function remove_anchor_change_upload_dir_byname( $module_id, $response ){
				global $wpmudev_forminator_upload_dir_form_id;
				if ( $response && is_array( $response ) ) {
					if ( $response['success'] ) {
						if ( $wpmudev_forminator_upload_dir_form_id ) {
							unset( $GLOBALS['wpmudev_forminator_upload_dir_form_id'] );
						}
					}
				}
			}

		}


		$run = WPMUDEV_Forminator_Custom_Upload_Path::get_instance();

	}
}