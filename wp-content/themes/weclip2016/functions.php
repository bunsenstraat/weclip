<?php

setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN);
if ( SITECOOKIEPATH != COOKIEPATH ) setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN);

// Verwijder bende uit de <head>
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
}
add_action('init', 'removeHeadLinks');

// Add RSS links to <head> section
automatic_feed_links();

// Thumbnails 
add_theme_support('post-thumbnails');

// Voeg custom size thumbnails toe
// add_image_size( 'header', 1980, 809, true ); // Formaat Header

// Verwijder afmetingen van thumbnails
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
	
// Excerpts op pages
add_post_type_support( 'page', 'excerpt' );

// WP menu erin vouwen
register_nav_menus( array(
	'primary' => __( 'primary', 'Hoofdmenu' ),
	'footer2' => __( 'footer2', 'Footer Menu')
));


// Voeg category nicenames toe in de body and post class
function category_id_class($classes) {
    global $post;
    foreach((get_the_category($post->ID)) as $category)
            $classes[] = $category->category_nicename;
            return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');


// Register Sidebar
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<section>',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}


if( !is_admin() ) {
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"), false, '1.10.2', true);
	wp_enqueue_script('jquery');
}

// Resultat Custom scripts

function load_styles_scripts() {
    if( !is_admin()) {
		wp_enqueue_script( 'global', get_template_directory_uri() . '/js/global.js', array('jquery'), '', true );
		wp_enqueue_script( 'tools', get_template_directory_uri() . '/js/jquery.tools.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'tabs', get_template_directory_uri() . '/js/jquery-ilc-tabs.js', array('jquery'), '', true );
		wp_enqueue_script( 'scrolltabs', get_template_directory_uri() . '/js/scrolltabs.js', array('jquery'), '', true );
		wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '', true );
	}
  if ( is_page('25') && !is_admin()) {
		wp_enqueue_style( 'order', get_template_directory_uri() . '/functions/order.css',false,'','all');
		wp_enqueue_script( 'ui', get_template_directory_uri() . '/js/jquery-ui-1.10.3.custom.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'weclip_order', get_template_directory_uri() . '/js/weclip_order.js', array('jquery'), '', true );
	  
  }
	
	
}
add_action( 'wp_enqueue_scripts', 'load_styles_scripts' );

// Geef editor toegang tot menu's
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );

// Zelf bepalen hoe lang een excerpt is. Gebruik echo get_excerpt(300);
function get_excerpt($limit, $source = null){
    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt;
    return $excerpt;
}

// Add new fields
function modify_contact_methods($profile_fields) {

	$profile_fields['_company'] = 'Bedrijfsnaam';
	$profile_fields['_street'] = 'Adres';
	$profile_fields['_postcode'] = 'Postcode';
	$profile_fields['_place'] = 'Plaats';
	$profile_fields['_cno'] = 'Telefoonnummer';
	$profile_fields['_kvkno'] = 'KVK Nummer';

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

/////ACF Options page toevoegen

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

/* Voeg even en oneven classes toe aan de posts
function oddeven_post_class ( $classes ) {
   global $current_class;
   $classes[] = $current_class;
   $current_class = ($current_class == 'odd') ? 'even' : 'odd';
   return $classes;
}


add_filter ( 'post_class' , 'oddeven_post_class' );
global $current_class;
$current_class = 'odd';
*/






