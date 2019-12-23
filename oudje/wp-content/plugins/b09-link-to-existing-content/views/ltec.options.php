<?php 

class Link_to_Existing_Content_Options {
	
	var $filter_exists_post_types 	= false;
	var $filter_exists_taxonomies 	= false;
	var $filter_exists_shortcode 	= false;
	var $message					= false;
	var $plugin_path				= false;
	
	/*
	*	Class Constructor
	*
	*/
	
	function Link_to_Existing_Content_Options($plugin_path = ""){
		$this->plugin_path = $plugin_path;

		add_action('admin_menu', array(&$this, 'ltec_add_options_panel'));
	}
	
	function ltec_add_options_panel() {
		$page = add_options_page(
			__("Options for Links to existing Content", "link-to-existing-content"), 
			__("Link to existing Content", "link-to-existing-content"), 
			"administrator", 
			"link_to_existing_content", 
			array(
				&$this, 
				'options_page_init'
			)
		);
		add_action( 'admin_print_styles-' . $page, array(&$this, 'add_admin_styles') );
	}
	
	
	/*
	*	Function options_page_init
	* 
	*	@description: set plugin locale, update options if set
	* 	
	*/
	
	function options_page_init(){
		
		$locale = get_locale();
		if ( !empty($locale) )
			load_textdomain("link-to-existing-content", "{$this->plugin_path}/lang/ltec-{$locale}.mo");
		
		$action = isset($_POST["ltec_action"]) ? $_POST["ltec_action"] : false;
		$options = isset($_POST["ltec_options"]) ? $_POST["ltec_options"] : false;
		$nonce = isset($_POST["ltec_nonce"]) ? $_POST["ltec_nonce"] : false;
		
		if($action == "update" && wp_verify_nonce($nonce, "ltec_update_options")) {
			update_option("ltec_options", $options);
			$this->message = __("Options saved.", "link-to-existing-content");
		}
		
		$this->build_options_ui();
		
	}
	
	/*
	*	Function build_options_ui
	* 
	*	@description: build the ui under settings->link_to_existing_content
	* 	
	*/

	
	
	
	function build_options_ui(){
		
		if(current_user_can("administrator")){
			error_reporting(E_ALL);
			ini_set('display_errors','On');
		}
		
		// read the options
		// delete_option("ltec_options");
		$options = get_option("ltec_options");

		
		$active_post_types = isset($options["post_types"]) ? $options["post_types"] : array();
		$active_taxonomies = isset($options["taxonomies"]) ? $options["taxonomies"] : array();
		$use_shortcode = isset($options["use_shortcode"]) ? (bool) $options["use_shortcode"] : false;

		
		// Detect eventual Filters and overwrite settings with them
		
		$filter_exists_post_types = false;
		$filter_exists_taxonomies = false;
		$filter_exists_use_shortcode = false;
		
		
		$post_type_objects = get_post_types( array( 'public' => true ), 'objects' );
		unset($post_type_objects["attachment"]);
		
		$filtered_post_types = $this->maybe_apply_filter_to_array("link_to_existing_content_post_types", "array");
		
		if($filtered_post_types && is_array($filtered_post_types)) {
			$filter_exists_post_types = true;
			$active_post_types = $filtered_post_types;
		}	
		
		$taxonomies = get_taxonomies( array( 'public' => true ), 'objects' );
		unset($taxonomies["post_format"]);
		
		$filtered_taxonomies = $this->maybe_apply_filter_to_array("link_to_existing_content_taxonomies", "array");
		
		if( $filtered_taxonomies && is_array($filtered_taxonomies)) {
			$filter_exists_taxonomies = true;
			$active_taxonomies = $filtered_taxonomies;
		}
		
		$detect_sc = -1;
		$detect_sc = intval(apply_filters("link_to_existing_content_use_shortcode", $detect_sc));

		if($detect_sc != -1) {
			$use_shortcode = apply_filters("link_to_existing_content_use_shortcode", $use_shortcode);
			$filter_exists_use_shortcode = true;
		}
		
		?>
		
		<div class="wrap nosubsub ltec-options">
			<div id="icon-link-manager" class="icon32"><br /></div>
			<h2>
				<?php _e("Options for Links to existing Content", "link-to-existing-content");  ?>
			</h2>
			
			<?php if ( $this->message ) : ?>
				<div style="margin-top: 10px;" id="message" class="updated fade">
					<p>
						<?php echo $this->message; ?>
					</p>
				</div>
			<?php endif; ?>
			
			
			<form method="post">
				<?php wp_nonce_field("ltec_update_options", "ltec_nonce"); ?>
				<input type='hidden' value='update' name='ltec_action'></input>
				<h3>
					<?php _e("Content Types", "link-to-existing-content"); ?>
				</h3>
				<p>
					<?php printf( __("Control what content types you want to appear in the %sOr link to existing content%s dialog. Selecting all has the same result as selecting none.", 'link-to-existing-content'), "<em>", "</em>"); ?><br />
				</p>
			
				
				<div class='tables'>
					<table class="widefat <?php if($filter_exists_post_types) echo "disabled"; ?>">
						<thead>
							<tr class="title">
								<th class="manage-column column-cb check-column" scope="col"><input type="checkbox" <?php if($filter_exists_post_types) echo "disabled='disabled'"; ?> class="toggle-all" id="all-post-types"></input></th>
								<th class="manage-column" scope="col">
									<label for="all-post-types"><?php _e("Post Types", "link-to-existing-content"); ?></label>
									<?php if($filter_exists_post_types): ?>
									<small class='notice'><?php _e("Your theme seems to have a filter running for this setting. Remove it to be able to edit it from here.", "link-to-existing-content"); ?></small>
									<?php endif; ?>
								</th>
								
							</tr>
						</thead>
						<tbody>
							<?php foreach($post_type_objects as $name => $pt): ?>
							<tr>
								<td class="check-column">
									<input type="checkbox" value="<?php echo $name; ?>" <?php if(in_array($name, $active_post_types)) echo "checked='checked'"; ?> id="post_type-<?php echo $name; ?>" name="ltec_options[post_types][]" <?php if($filter_exists_post_types) echo "disabled='disabled'"; ?>></input>
								</td>
								<td>
									<label for="post_type-<?php echo $name; ?>"><?php echo $pt->labels->name; ?></label>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<table class="widefat <?php if($filter_exists_taxonomies) echo "disabled"; ?>">
						<thead>
							<tr class="title">
								<th class="manage-column column-cb check-column" scope="col"><input type="checkbox" class="toggle-all" <?php if($filter_exists_taxonomies) echo "disabled='disabled'"; ?> id="all-taxonomies"></input></th>
								<th class="manage-column" scope="col">
									<label for="all-taxonomies"><?php _e("Taxonomies", "inline-attachments"); ?></label>
									<?php if($filter_exists_taxonomies): ?>
									<small class='notice'><?php _e("Your theme seems to have a filter running for this setting. Remove it to be able to edit it from here.", "link-to-existing-content"); ?></small>
									<?php endif; ?>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($taxonomies as $name => $tax): ?>
							<tr>
								<td class="check-column">
									<input type="checkbox" value="<?php echo $name; ?>" <?php if(in_array($name, $active_taxonomies)) echo "checked='checked'"; ?> id="taxonomy-<?php echo $name; ?>" name="ltec_options[taxonomies][]" <?php if($filter_exists_taxonomies) echo "disabled='disabled'"; ?>></input>
								</td>
								<td>
									<label for="taxonomy-<?php echo $name; ?>"><?php echo $tax->labels->name; ?></label>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<h3>
						<?php _e("Other Options", "link-to-existing-content"); ?>
					</h3>
					<table class="widefat <?php if($filter_exists_use_shortcode) echo "disabled"; ?>">
						<thead>
							<tr class="title">
								<th class="manage-column column-cb check-column hidden" scope="col"><input type="checkbox" class="toggle-all" <?php if($filter_exists_use_shortcode) echo "disabled='disabled'"; ?> id="cb-shortcode"></input></th>
								<th colspan="2" class="manage-column" scope="col">
									<label for="cb-shortcode"><?php _e("Shortcode Functionality", "link-to-existing-content"); ?></label>
									<?php if($filter_exists_use_shortcode): ?>
									<small class='notice'><?php _e("Your theme seems to have a filter running for this setting. Remove it to be able to edit it from here.", "link-to-existing-content"); ?></small>
									<?php endif; ?>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="check-column">
									<input type="checkbox" value="true" <?php if($use_shortcode) echo "checked='checked'"; ?> id="ltec_use_shortcode" name="ltec_options[use_shortcode]" <?php if($filter_exists_use_shortcode) echo "disabled='disabled'"; ?>></input>
								</td>
								<td>
									<label for="ltec_use_shortcode">
										<?php _e("Enable the plugin's built-in shortcode functionality. This will prevent links leading to 404-Pages, if the linked content doesn't exist anymore or if the site was moved to a different web address", "link-to-existing-content"); ?>
									</label>
								</td>
							</tr>
						</tbody>
					</table>
					
				</div>
				<div class="submit">
					<input class="button-primary" type="submit" value="<?php _e("Save Changes"); ?>">
				</div>
			</form>
			<p>
				<?php 
					_e('The settings can all be overwritten from your functions.php using filters.', 'link-to-existing-content');
					printf(
						' <a href="%s" target="_blank">%s</a>',
						"http://wordpress.org/plugins/b09-link-to-existing-content/faq/",
						__('Instructions + FAQ', 'ltec')
					)
				?>
			</p>
		</div>
	<?php }
	
	/*
	*	Function maybe_apply_filter_to_array
	* 
	*	@description checks if there is a filter set for an array
	* 	@param $filter: string with the name of the filter
	* 	@return	false or filtered content
	*/
	
	
	function maybe_apply_filter_to_array($filter) {
	
		$check_array = array(uniqid());
		$result = apply_filters($filter, $check_array);
		
		if($result == $check_array) {
			return false;
		}
		return $result;
	}
	
	
	function add_admin_styles(){ ?>
		<style type="text/css">
			.ltec-options {
				max-width: 600px;
			}
			.ltec-options label {
				display: block;
			}
			.ltec-options .widefat {
				margin: 0 0 15px 0;
			}
			.ltec-options .widefat td {
				padding-top: 8px;
				padding-bottom: 8px;
			}
			.ltec-options .widefat.disabled .notice,
			.ltec-options .widefat.disabled label {
				color: #666;
			}
			.ltec-options .widefat input {
				margin: 0 0 0 8px;
			}
			.ltec-options h3 {
				margin-top: 30px;
			}
			.ltec-options .notice {
				display: block;
			}
		</style>
		
	<?php }
	
}

 ?>