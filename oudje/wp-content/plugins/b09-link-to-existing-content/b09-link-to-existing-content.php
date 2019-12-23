<?php
	/*
	Plugin Name: B09 Link to Existing Content
	Plugin URI: http://wordpress.org/plugins/b09-link-to-existing-content/
	Description: Seamless integration of the "Link to existing Content"-Functionality in Wordpress with the plugin "Search Everything". Gives you control over the post types and taxonomies you want to link to. Optional shortcode-feature for internal links, with id, linktext and target. Read the <a href='http://wordpress.org/plugins/b09-link-to-existing-content/faq/' target='_blank'>plugin FAQs</a> for more information.
	Version: 2.1.3
	Author: BASICS09
	Author URI: http://www.basics09.de
	
	///////////////
	
	Control the plugins behaviour by copying the following snippets in the functions.php of your theme:
	
	// Control which post types should be searched 
	
	add_filter("link_to_existing_content_post_types", "my_link_to_existing_content_post_types");
	function my_link_to_existing_content_post_types($post_types) {
		$post_types = array("post");
		return $post_types;
	}
	
	Control which taxonomies should be searched
	
	add_filter("link_to_existing_content_taxonomies", "my_link_to_existing_content_taxonomies");
	function my_link_to_existing_content_taxonomies($taxonomies){
		$taxonomies = array("category", "genre");
		return $taxonomies;
	}
	
	// Enable shortcode functionality:
	
	add_filter("link_to_existing_content_use_shortcode", "__return_true");
	
	// Disable Admin Script

	add_filter("link_to_existing_content_use_admin_script", "__return_false");
	
	// Overwrite the default shortcode handling:
	
	remove_shortcode("link");
	add_shortcode("link", "render_internal_link");
	function render_internal_link($atts){
		return "...";
	}
	
	*	
	*	
	*/
	

	/*
	*  Class instantiation
	*
	*/
	$b09_link_to_existing_content = new B09_Link_To_Existing_Content();
	
	/*
	* 	Class B09_Link_To_Existing_Content
	*
	* 	@param: none
	*	@returns: nothing
	*
	*/
	
	class B09_Link_To_Existing_Content {
		
		var $path;
		var $dir;
		var $nonce;
		var $shortcode_name = "link";
		var $use_shortcode = false;
		var $use_admin_script = true;
		var $options;
		
		function B09_Link_To_Existing_Content(){
		
			$this->path = dirname(__FILE__).'';
			$this->dir = plugins_url('',__FILE__);
			$this->options = get_option('ltec_options');
			
			// Hack: Overwrite the $_SERVER["SCRIPT_NAME"], so that Search Everything can add it's filters
			
			// Disabled for compatibility reasons
			if (basename($_SERVER["SCRIPT_NAME"]) == "admin-ajax.php") {	
				$_SERVER["SCRIPT_NAME"] = $this->path . "/b09-link-to-existing-content.php";
			}
			
			add_action("plugins_loaded", array($this, "load_text_domain"));
			add_action("init", array($this, "init"), 100);
			add_action('wp_ajax_b09-link-ajax', array($this, "ajax_search_posts") );
			
			// Filters for the Plugins Overview
			add_filter('plugin_action_links_' .plugin_basename( __FILE__ ), array( &$this, 'action_links') );
			
			// Add the plugin scripts
			global $pagenow;
			if(is_admin()){
				add_action("admin_enqueue_scripts", array($this, "plugin_scripts") );
			}
			
			// include the options page
			if(is_admin()){
				include ( $this->path  . '/views/ltec.options.php' );
				$ltec_admin = new Link_to_Existing_Content_Options($this->path);
			}
			
		}
		
		function init(){
			
			// Overwrite the use_shortcode setting with the stored option
			if(isset($this->options["use_shortcode"]))
				$this->use_shortcode = (bool) $this->options["use_shortcode"];
			
			// Apply the use_shortcode filter
			$this->use_shortcode = apply_filters("link_to_existing_content_use_shortcode", $this->use_shortcode);

			// Apply the admin script filter
			$this->use_admin_script = apply_filters("link_to_existing_content_use_admin_script", $this->use_admin_script);

			// Add the shortcode hook
			add_shortcode($this->shortcode_name, array($this, "render_link_shortcode"));
		}
		
		function load_text_domain(){
			load_plugin_textdomain( 'ltec', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
		}
		
		/*
		* 	Function render_link_shortcode
		*
		*	@description: render the shortcodes for display in frontend
		* 	@param: $atts => array(id, text, target)
		*	@returns: html string
		*
		*/
		
		function render_link_shortcode($atts){
			
			// parse the attributes
			$id = isset($atts["id"]) ? intval($atts["id"]) : false;
			$text = isset($atts["text"]) ? $atts["text"] : false;
			$taxonomy = isset($atts["tax"]) ? $atts["tax"] : false;
			$title = isset($atts["title"]) ? $atts["title"] : false;
			$target = isset($atts["target"]) ? " target='{$atts['target']}'" : false;
			
			// remove eventual <a> tags from $text
			$text = $this->strip_single("a", $text);
			
			
			// initialize the link class
			$link_class = "internal-link";
			
			
			// if there is no ID, return only the text
			if( !$id ) 
				return $text;
			
			// if it is a taxonomy link
			if($taxonomy) {
				$link = get_term_link($id, $taxonomy);
				$link_class .= " archive-link {$taxonomy}-{$id}";
				
				// if there is no link (for example, term doesn't exist anymore)
				if( is_wp_error($link) ) 
					return $text;
				
				// If there is no title
				if(!$title) {
					$term = get_term($id, $taxonomy);
					$title = $term->name;
				}
				
				// if there is no text, default to the title
				if(!$text)
					$text = $title;
				
			} else {

				$post = get_post($id);

				// if the post doesn't exist
				if( !$post )
					return $text;


				// if the post is not published
				if( "publish" !== get_post_status( $post ) )
					return $text;


				$link = false;
				if( "attachment" === get_post_type( $post ) ) {
					$link = wp_get_attachment_url( $post->ID );
					$link_class .= " attachment-link";

				} else {
					// if it is a post link
					$link = get_permalink($post);
					$link_class .= " post-link";
				}

				
				// add post type and id to link class
				$post_type = get_post_type($id);
				if($post_type)
					$link_class .= " {$post_type}-{$id}";
				
				// if there is no link (for example, post doesn't exist anymore)
				if(!$link)
					return $text;
				
				// if there is no title
				if(!$title)
					$title = get_the_title($id);
					
				// if there is no text, default to the post title
				if(!$text)
					$text = $title;
			}
			
			$out = "<a class='{$link_class}' title='{$title}' href='{$link}' {$target}>{$text}</a>";
			return $out;
		}
		
		
		function strip_single($tag, $string) {
			$string=preg_replace('/<'.$tag.'[^>]*>/i', '', $string);
			$string=preg_replace('/<\/'.$tag.'>/i', '', $string);
			return $string;
		}
		
		/*
		* 	Function plugin_scripts
		*
		*	@description: overwrite and load the necessary scripts
		* 	@param: none
		*	@returns: nothing
		*
		*/
		
		function plugin_scripts(){
			
			// Don't do it if it was deactivated using the filter
			if( !$this->use_admin_script ) {
				return;
			}

			// deregister the default wordpress script
			wp_deregister_script("wplink");
			
			$script_location = "/js/ltec.wplink.js";
			$wp_version = (float) get_bloginfo("version");
			if($wp_version < 3.9) {
				$script_location = "/js/old/ltec.wplink.3.8.js";
			}
			
			// replace it with the plugins script version
			wp_enqueue_script("b09-wplink-script", $this->dir . $script_location, array('jquery'), false, true);
			wp_enqueue_style("b09-wplink-style", $this->dir . "/css/ltec.wplink.css");
			

			// localize the script
			$ltec_localized = array(
				'wpLinkL10n' => array(
					'title' => __('Insert/edit link', 'ltec'),
					'update' => __('Update', 'ltec'),
					'save' => __('Add Link', 'ltec'),
					'noTitle' => __('(no title)', 'ltec'),
					'noMatchesFound' => __('No matches found.', 'ltec'),
					'searchPostsLabel' => __('Posts', 'ltec'),
					'searchCategoriesLabel' => __('Taxonomies', 'ltec'),
					'searchAttachmentsLabel' => __('Attachments', 'ltec'),
					'shortcodeLabel' => __('Shortcode', 'ltec'),
					'saveShortcodeText' => __('Add Shortcode', 'ltec'),
					'titlePlaceholder' => __('Automatic, type here to customize...', 'ltec'),
					'searchIn' => __('Search in', 'ltec')
				),
				'ajaxAction' => 'b09-link-ajax',
				'useShortcode' => $this->use_shortcode ? 1 : 0,
				'shortcodeName' => $this->shortcode_name,
				
			);
			
			wp_localize_script("b09-wplink-script", "linkToExistingContent", $ltec_localized);

		}
		
		/*
		* 	Function ajax_search_posts
		*
		*	@description: The Ajax function for searching posts
		* 	@param: none
		*	@returns: dies with response
		*
		*/
		
		function ajax_search_posts(){
			
			// Parse the given arguments
			$args["pagenum"] = isset($_POST["page"]) ? absint( $_POST["page"] ) : 1;
			
			$args["s"] = isset($_POST["search"]) ? $_POST["search"] : false;
			
			$args["objectType"] = isset($_POST["objectType"]) ? $_POST["objectType"] : "posts";
			
			if( "taxonomies" === $args["objectType"] ) {
				// Get all registered public taxonomies
				$taxonomies = get_taxonomies( array( 'public' => true ), 'objects' );
				$tax_names = array_keys( $taxonomies );
				
				// overwrite the taxonomies with the taxonomies stored in the ltec options
				if(isset($this->options["taxonomies"]))
					$tax_names = $this->options["taxonomies"];
				
				// Apply the taxonomy filter
				$tax_names = apply_filters("link_to_existing_content_taxonomies", $tax_names);
				
				if(!is_array($tax_names) || !count($tax_names))
					die("false");
				
				
				$query = array(
					"hide_empty" => false,
				);
				
				// Add the search string to the query if any was given
				if ( isset( $args['s'] ) )
					$query['search'] = $args['s'];
				
				// offset doesn't work well with get_terms, so die if page is greater than one
				if($args["pagenum"] > 1)
					die("false");
				
				$terms = get_terms ($tax_names, $query);
				
				if ( !count($terms) )
					die("false");
				
				$results = array();
				
				foreach($terms as $term){
					
					$info = $taxonomies[$term->taxonomy]->labels->singular_name;
					
					$results[] = array(
						'ID' => $term->term_id,
						'title' => trim( esc_html( $term->name ) ),
						'permalink' => get_term_link( $term ),
						'info' => $info,
						'taxName' => $taxonomies[$term->taxonomy]->name
					);
					
				}
				die(json_encode($results));
				// End Taxonomies
			} else {
				
				$pts = array();
				$post_status = '';

				// If we are looking for Attachments
				if( "attachments" === $args["objectType"] ) {

					$pts = array(
						"attachment" => get_post_type_object( "attachment" )
					);
					$post_status = 'any';
					$pt_names = array( "attachment" );


				} else {

					// If we are looking for normal Post Types

					// Get all registered public post types
					$pts = get_post_types( array( 'public' => true ), 'objects' );
					unset($pts["attachment"]);	

					$post_status = 'published';

					$pt_names = array_keys( $pts );
					
					// overwrite the post types with the post types stored in the ltec options
					if( isset($this->options["post_types"]) )
						$pt_names = $this->options["post_types"];
					
					// Apply the post_types filter
					$pt_names = apply_filters("link_to_existing_content_post_types", $pt_names);
				}
				
				
				if(!is_array($pt_names) || !count($pt_names))
					die("false");
				

				// Build the default query parameters, with suppress_filters set to false for advanced searching capabilities
				$query = array(
					'post_type' => $pt_names,
					'suppress_filters' => false,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'post_status' => $post_status,
					'order' => 'DESC',
					'orderby' => 'post_date',
					'posts_per_page' => 20,
					'numberposts' => 20
				);
				
				// Add the search string to the query if any was given
				if ( isset( $args['s'] ) && $args['s'] !== false )
					$query['s'] = $args['s'];
				
				// Calculate the offset
				$query['offset'] = $args['pagenum'] > 1 ? $query['posts_per_page'] * ( $args['pagenum'] - 1 ) : 0;
				
				// Do main query.
				$get_posts = new WP_Query;
				$posts = $get_posts->query( $query );

				// Check if any posts were found.
				if ( ! $get_posts->post_count )
					die("false");
					
				
				// Build results.
				$results = array();
				foreach ( $posts as $post ) {

					$title = trim( esc_html( strip_tags( get_the_title( $post ) ) ) );
					$link = get_permalink( $post->ID );

					if ( 'post' == $post->post_type ) {
						
						$info = mysql2date( __( 'Y/m/d' ), $post->post_date );

					} if ( 'attachment' === $post->post_type ) {

						$info = get_post_mime_type($post->ID);
						$link = wp_get_attachment_url( $post->ID );
						$title = basename( $link );

					} else {

						$info = $pts[ $post->post_type ]->labels->singular_name;

					}
			
					$results[] = array(
						'ID' => $post->ID,
						'title' => $title,
						'permalink' => $link,
						'info' => $info,
					);
				}
			
				die (json_encode($results));
			}
			
			die("error false");
		}
		
		/*
		*	Function action_links
		*
		*	@description print the instructions link to the plugins screen
		*
		* @param      array      $data
		*	@return     array      $data (modified) 		
		*
		*/
		
		function action_links($data) {
			return array_merge(
				$data,
				array(
					sprintf(
						'<a href="%s" target="_blank">%s</a>',
						"http://wordpress.org/plugins/b09-link-to-existing-content/faq/",
						__('Instructions + FAQ', 'ltec')
					)
				)
			);
		}
		
		
	}
?>