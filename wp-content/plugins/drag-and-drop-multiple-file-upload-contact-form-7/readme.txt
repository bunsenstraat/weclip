=== Drag and Drop Multiple File Upload - Contact Form 7 ===
Donate link : http://codedropz.com/donation
Tags: drag and drop, contact form 7, ajax uploader, multiple file, upload, contact form 7 uploader
Requires at least: 3.0.1
Tested up to: 5.3.2
Stable tag: 1.3.2
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

**Drag and Drop Multiple File Uploader** is a simple, straightforward WordPress plugin extension for Contact Form7, which allows the user to upload multiple files using the **drag-and-drop** feature or the common browse-file of your webform.

Here's a little [DEMO](http://codedropz.com/contact).

### Features

* File Type Validation
* File Size Validation
* Ajax Uploader
* Limit number of files Upload.
* Limit files size for each field
* Can specify custom file types or extension
* Manage Text and Error message in admin settings
* Drag & Drop or Browse File - Multiple Upload
* Support Multiple Drag and Drop in One Form.
* Able to delete uploaded file before being sent
* Send files as email attachment or as a links.
* Support multiple languages
* Mobile Responsive
* Cool Progress Bar
* Compatible with any browser

### Premium Features

Checkout available features on **PRO version**.

* Image Preview - Show Thumbnail for images
* Auto Delete Files - After Form Submission
  - 1 hour, 4 hours, 8 hours or 1 day etc
* Zip Files ( Compressed File )
* Save Files To Media Library
* Change Upload Directory
  - Generated Name - timestamp
  - Random Folder
  - By User ( *must login* )
  - Custom Folder
* Send to email as individual attachment, zip archive or as a links
* Improved Security
* Optimized Code and Performance
* 1 Month Premium Support

You can get [PRO Version here](https://www.codedropz.com/purchase-plugin/)!

### Other Plugin You May Like

* [Drag & Drop Multiple File Upload - WPForms](https://www.codedropz.com/drag-drop-file-uploader-wpforms/) 
An extension for **WPForms** - Transform your simple file upload into beautiful **"Drag & Drop Multiple File Upload"**.

== Frequently Asked Questions ==

= How can I send feedback or get help with a bug? =

For any bug reports go to <a href="https://wordpress.org/support/plugin/drag-and-drop-multiple-file-upload-contact-form-7">Support</a> page.

= How can I limit file size? =

To limit file size in `multiple file upload` field generator under Contact Form 7, there's a field `File size limit (bytes)`. Please take note it should be `Bytes` you may use any converter just Google (MB to Bytes converter) default of this plugin is 5MB(5242880 Bytes).

= How can I limit the number of files in my Upload? =

You can limit the number of files in your file upload by adding this parameter `max-file:3` to your shortcode :

Example: [mfile upload-file-344 max-file:3] - this option will limit the user to upload only 3 files.

= How can I Add or Limit file types =

You can add or change file types in cf7 Form-tag Generator Options by adding `jpeg|png|jpg|gif` in `Acceptable file types field`.

Example : [mfile upload-file-433 filetypes:jpeg|png|jpg|gif]

= How can I change text in Drag and Drop Uploading area? =

You can change text `Drag & Drop Files Here or Browse Files` text in Wordpress Admin menu under `Contact` > `Drag & Drop Upload`.

= How can I change email attachment as links? =

Go to WP Admin `Contact->Drag & Drop Upload` settings then check "Send Attachment as links?" option.

To manage mail template, go to Contact Forms edit specific form and Select `Mail` tab. In Message Body add generated code from mfile. ( Example Below )

Message Body : [your-message]

File Links 1 : [upload-file-754]

File Links2 : [upload-file-755]

Note : No need to add in `File Attachments` field.

== Installation ==

To install this plugin see below:

1. Upload the plugin files to the `/wp-content/plugins/drag-and-drop-multiple-file-upload-contact-form-7.zip` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== Screenshots ==

1. Generate Upload Field - Admin
2. Form Field Settings - Admin
3. Uploader Settings - Admin
4. Email Attachment- Gmail
5. Email Attachment As links - Gmail
6. Multiple Drag and Drop Fields - Front

== Changelog ==

= 1.3.2 =
* Fixed - Sanitized Admin Option Fields - For Security Reason
* Added - Filter for `wpcf7_posted_data` from CF7 to get the full link of the file.

= 1.3.1 =
* Fixed - Browser Compatibility ( Error Uploading files in Edge, Safari and Internet Explorer )
* Improved - Removed error text if there are muliple error ( File upload validation )

= 1.3.0 =
* Fixed - Multiple Drag & Drop fields in one form ( Validation Issues - Max File not working correctly )
* Added - Added "deleted..." status when removing file.
  - So that the user know that file deletion is in progress...
* Fixed - Responsive issues on Mobile < 767px screen.
* Added - Added '/wpcf7-files' directory inside '/wp_dndcf7_uploads' to temporary store files instead of relying contact form 7.
* Added - Auto delete files inside '/wpcf7-files' dir 1 hour(3200 seconds) after submission.
  - It was a problem with contact form 7 before that files only last 60 seconds and it will automatically deleted.
* Improved - Optimized and Improved Php Code & Javascript structure and functionalities. ( removed redundant code, removed spaces, etc )
* Added - Links going to Pro Version.

= 1.2.6.0 =
* Fixed - Allow to upload file with the same filename.
* Fixed - Can't upload image after delecting (https://wordpress.org/support/topic/cant-upload-image-after-deleting-it/)
* Fixed - Max-file issue (https://wordpress.org/support/topic/max-file-issue/)
* Added - a note message when file reached the max-file Limit ( "To inform user that some of the files are not uploaded" ).
* Added - Better Ajax deletion ( Remove files from the server - Only if `Send As Attachment` is checked )
* Optimized - Form send loading time has been optimized ( Improved loading time for large attachment )
* Fixed - Bug reported by @palychwp " `remove file still send sends with the form` (https://wordpress.org/support/topic/file-uploading-is-working-incorrect/)
* Added - Validate File/Attachment first before the upload start ("some says it's frustating :)")
  - (PHP or Server side validation still there for security and better validation)
* Improved file counting via `LocalStorage` instead of Global variable.

= 1.2.5.0 =
* Fixed - Please Update to 1.2.5.0 to fixed disable button issue.

= 1.2.5 =
* Fixed - Improved ( Disable button while upload is on progress )
* Fixes - Validate file size limit before uploading the file ( https://wordpress.org/support/topic/file-uploading-is-working-incorrect/ )

= 1.2.4 =
* Added - Support WPML using .po and .mo files
* Added - Added to support multilingual ( using Poedit )
* Fixed - Prevent attachment from sending to Mail(2) if field attachment is not set. (https://wordpress.org/support/topic/problem-with-2th-mail-attachment-2/)
* Added - Disable 'submit' button while upload is on progress...

= 1.2.3 =
* Added - Multiple Drag and Drop fields in a form
* Added - Options in admin for error message
* Added - Option that allow user to send attachment as links
* Added - Added new folder name `wp_dndcf7_uploads` to separate files from wpcf7_uploads ( When option 'Send Attachment as links?' is check ).

= 1.2.2 =
* Add - Create admin settings where you can manage or change text in your uploading area. It's under 'contacts' > 'Drag and Drop'.
* New - Empty or Clear attachment file when Contact Form successfully send.
* Fixes - Fixed remove item bugs when file is greater than file limit.
* Fixes - Changed 'icon-moon' fonts to avoid conflict with the other themes.
* New - Added text domain for language translations.

= 1.2.2 =
* Issue - fixed bug when file is not required(*).
* Issue - fixed error on 'wpcf7_mail_components' components hooks when there's no file.

= 1.2.1 =
* Issue - fixed bug when file is not required(*).
* Issue - fixed error on 'wpcf7_mail_components' components hooks when there's no file.

= 1.2 =
- Add admin option to limit the number of files. (Maximum File Upload Limit)

= 1.1 =
- This version fixes on user drop validation.
- Optimized Javascript File

= 1.0 =
* Initial Release

== Upgrade Notice ==

= 1.2.3 =
This version fixed minor issues/bugs and add multiple drag and drop fields in a form.

= 1.2.1 =
This version fixed minor issues and bugs.

= 1.2.2 =
Added some usefull features.

= 1.2.4 =
Added new features and fixes.

== Donations ==

Would you like to support the advancement of this plugin? [Donate](http://codedropz.com/donation)