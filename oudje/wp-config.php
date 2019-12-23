<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '62999clipper');

/** MySQL database username */
define('DB_USER', '62999clipper');

/** MySQL database password */
define('DB_PASSWORD', 'asght28FS8v');

/** MySQL hostname */
define('DB_HOST', 'sql4.pcextreme.nl');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         's3of_5LA-yB[^<IRM!9@I4P)@ot4X8&M~z1QBo/q71tRE~Gw@0wM=H.dk z>@)X=');
define('SECURE_AUTH_KEY',  'Hy-?VvCJv:#04mr*Ce>po.;b|Bip6vriPYkKP@f7LQ#Hi`Q.9mYNQq8vvjB7LP=Z');
define('LOGGED_IN_KEY',    '_^;O=,&(ccJbaE8<kMXUGWT.BEG;|=WQ`Ki~F[*!- >5Mkpy; zo?gKZ=F[E m+B');
define('NONCE_KEY',        'i?l@hZ@2zrP#louf^V435fRm8iAl6pgu[8O)Ot[~pH8JpX1)Rdw_7V` | `zNwD*');
define('AUTH_SALT',        '$8Rr1{h=U9<1pf2zIka?;30)X}8GH[l_?U~mAu07|>z)>=7AN=;cm|]@Xm=^sfRg');
define('SECURE_AUTH_SALT', 'r[im2XH!=[*`LQ&^_gygF=tpTlg0~gnDT-z8!G@.7ec{I};%G%?B3|HKEr!-+[$a');
define('LOGGED_IN_SALT',   'q?b)1N!l&MR;k00.kGz1Vd0jsP:Vpd :UfvIy{;Z+ uk[gN@#5)KeNe#M4~RPPfH');
define('NONCE_SALT',       'bUZ%+`APJ!?vZ=/S(aI98f+c,eJ)>LI1bfWbaUIQWE~E)*;9^;LCESK{XuF+Y[.9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'nl_NL');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_MEMORY_LIMIT', '100M');

define('ADMIN_COOKIE_PATH', '/');
define('COOKIE_DOMAIN', '');
define('COOKIEPATH', '');
define('SITECOOKIEPATH', '');



/*
 // Enable WP_DEBUG mode
define( 'WP_DEBUG', true );

// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );

// Disable display of errors and warnings 
define( 'WP_DEBUG_DISPLAY', true );
@ini_set( 'display_errors', 1 );
*/

