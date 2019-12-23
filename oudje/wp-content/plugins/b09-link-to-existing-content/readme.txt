=== B09 Link to Existing Content ===
Contributors: BASICS09
Tags: wplink, links, internal, suppress_filters, filter, shortcode, tinymce, wysiwyg, admin, developer
Requires at least: 4.2
Tested up to: 4.2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Improves the built in "Link to existing content" dialog. Provides filters, has optional shortcode support and improves searching.


== Description ==

= About this Plugin =
B09 Link to Existing Content is a small plugin that is ment to improve the wordpress "Link to existing content"-functionality.


* Default Behaviour is seamless, just continue using the Link PopUp as always
* New in version 1.5: Options Page to alter your personal settings
* Consider installing the plugin <a title='Search Everyting' href='http://wordpress.org/plugins/search-everything/'>Search Everything</a> for full control over the search results when using "Link to existing Content"
* Optional: Makes internal links more future-proof by using a shortcode with the post or taxonomy id. Just select the post you want to link to and click "Add Shortcode", and the shortcode gets pasted to your editor and automatically handled in your themes. This feature has to be activated by using a shortcode, as described below:
* Filters for this plugin:
 - Control if the shortcode functionality should be active or not: `link_to_existing_content_use_shortcode`
 - Control which post types should be searched: `link_to_existing_content_post_types`
 - Control which taxonomies should be searched: `link_to_existing_content_taxonomies`

= Filter API =
For more information about the usage of filters with this plugin, have a look at it's source code or the <a href='http://wordpress.org/plugins/b09-link-to-existing-content/faq/'>FAQ</a>. It is all documented there.

= A short Note =
This plugin is very young, so there might still be bugs somewhere in there. Before you give it a bad rating, help us to solve eventual issues by posting here to the support forum. That way, you will help the community much more than by just saying "it doesn't work, one star". Thanks.

= Votes =
If you think it works and you like the functionality, don't wait and rate it here! That way, it will stay alive.

== Installation ==

1. Upload the folder ‘b09-link-to-existing-content' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done. The plugin integrates seamlessly with the wordpress interface.
4. Use Filters to customize the plugins behaviour, see source code of for documentation
5. If you aren't comfortable with using filters, you can use the options page (since version 1.5) under "Settings › Link to existing content"
6. If you have custom fields in your post types, you should consider installing the plugin <a title='Search Everyting' href='http://wordpress.org/plugins/search-everything/'>Search Everything</a> and activate the option "Search every custom field".
7. Check out the <a href='http://wordpress.org/plugins/b09-link-to-existing-content/faq/'>FAQ</a> for more information.

== Frequently Asked Questions ==

= Q. How do I make the custom fields of my posts in the link popup searchable? =
A. Install the plugin <a title='Search Everyting' href='http://wordpress.org/plugins/search-everything/'>Search Everything</a> and activate the option "Search every custom field"

= Q. Do I really have to code the settings myself? =
A. Since Version 1.5, you don't have to anymore. There is a new options page available now under "Settings › Link to existing content"

= Q. How can I enable the shortcode functionality? =
A. By putting this code into your functions.php:
`
add_filter("link_to_existing_content_use_shortcode", "__return_true");
`
= Q. How can I control the post types that should be searched? =
A. By putting this code into your functions.php:
`
add_filter("link_to_existing_content_post_types", "my_link_to_existing_content_post_types");
function my_link_to_existing_content_post_types($post_types) {
    $post_types = array("post");
    return $post_types;
}
`
= Q. How can I control the taxonomies that should be searched? =
A. By putting this code into your functions.php:
`
add_filter("link_to_existing_content_taxonomies", "my_link_to_existing_content_taxonomies");
function my_link_to_existing_content_taxonomies($taxonomies){
	$taxonomies = array("category", "genre");
	return $taxonomies;
}
`
= Q. The plugin breaks my visual editor. Can I disable only the admin behaviour? =
A. Yes, you can! Put this in your functions.php:
`
add_filter("link_to_existing_content_use_admin_script", "__return_false");
`
= Q. Did anyone actually ask all those questions? =
A. No one did, but if he would, here would be the answers ;)



== Screenshots ==

1. Seamless integration with the wordpress UI. Control of the post types and taxonomies you want to be able to link to.

2. Shortcut functionality for internal links, so they don't break so easily in the future (server move, rewrite changes, …)

3. The options page for the plugin, introduced with version 1.5

4. An example of how a shortcode link to another post looks like

5. a taxonomy archive link in the frontend, automatically parsed by the plugin

6. a post-link in the frontend

7. The shortcode adds useful information about the post or taxonomy to the class of every link, so you can alter behaviour using css and javascript.



== Changelog ==

= 2.1.3 =
* FIX: <a href="https://wordpress.org/support/topic/shortcode-compatibility-with-wordpress-422?replies=1#post-7088353">Bug</a> that prevented the shortcode to be pasted to the tinymce textarea correctly. 

= 2.1.2 =
* FIX: Link to files and not to attachment pages also if shortcode is disabled
* FIX: Clear the shortcode field if the wplink-modal is being closed

= 2.1.1 =
* Fixed small nasty bug with link popup overlaying everything

= 2.1 =
* Various UI improvements with more transparent shortcode handling

= 2.0 =
* Added Functionality for linking to files, as requested here: <a href="https://wordpress.org/support/topic/adding-media-to-the-search?replies=1">https://wordpress.org/support/topic/adding-media-to-the-search?replies=1</a>. Just select "Attachments" in the "Search in" – Select Field.

= 1.9 =
* **WP 4.2 COMPATIBILITY**: You should not use the plugin on a lower version than 4.2 after this update.

= 1.8 =
* Introduced new filter to deactivate the admin script, in case you run into compatibility trouble

= 1.7.1 =
* Fixed CSS to adapt to new admin css in WP 3.9

= 1.7 =
* **WP 3.9 COMPATIBILITY**: Wordpress 3.9 made a major TinyMCE upgrade which is covered by this version of the plugin.

= 1.6 =
* **CAUTION**: after this update you have to **re-activate the plugin in the plugins panel**, because I decided to rename the main php file and wordpress will think the plugin was removed.

* The plugin now also loads empty taxonomies, so you can link to them before they get filled up
* The script files now load on all admin screens, so wherever there is a WYSIWYG-editor, you can also use the Link To Existing Content functionality.

= 1.5.3 =
* The script now also loads on the admin page "admin.php", not just the "post.php" pages. This makes it possible to also use the plugin on options pages with WYSIWYG-Editors

= 1.5.2 =
* The Shortcode now automatically adds useful information about the post or taxonomy to every link in the frontend. See Screenshot #7 for more information

= 1.5.1 =
* Fixed options form not updating if all options where disabled
* Made check for existing shortcodes in options page more fail-proof

= 1.5 =
* Added an options page for the non-developers out there. Filters still have a higher priority though, so you won't have to change anything, if you don't want to.

= 1.4.2 =
* Fixed Categories in the link popup loading infinitely

= 1.4.1 =
* Fixed Error in AJAX-Request if param "search" not being set
* Added plugin textdomain and german localization
* Added Settings / FAQ link to plugins overview page

= 1.4.0 = 
* Added Support for the screen "media.php"
* From now on, the shortcode functionality is disabled by default and has to be activated from the functions.php

= 1.3.0 =
* Now also works if the visual editor is disabled.

= 1.2.0 =
* Added Functionality for linking to taxonomies from the "Link to Existing Content" dialog

= 1.1.0 =
* The plugin uses the built-in admin-ajax functionality now
* The shortcode appears directly in the url field, so it doesn't suprise the user if it gets pasted to the editor
* Added custom css file

= 1.0.0 =
* Initial Release.


== Upgrade Notice ==

= 1.0.0 =
