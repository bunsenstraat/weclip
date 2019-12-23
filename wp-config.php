<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '62999wclp20192');


/** MySQL database username */
define('DB_USER', '62999wclp20192');


/** MySQL database password */
define('DB_PASSWORD', 'D7s*64^TSeAD3');


/** MySQL hostname */
define('DB_HOST', 'sql8.pcextreme.nl');


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');


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
define('AUTH_KEY',         ' B&]-HX=fd=Z FA)jglQd~rf1T/@Xg[58GiLv-,x$6(@d[/gfJ+dI$YoX81L|CMj');

define('SECURE_AUTH_KEY',  '}SDY0H==1>OuquJ=:iQdY=m?B5=yFS8N,`8@}G K0=b,:Q$wvR3hhPUGS]6O1Q}|');

define('LOGGED_IN_KEY',    'KV89Z@!NPEGVHjBF_8qulbkdEX7fa3ZPB=m?hUokt-rT^G V^)@u+`AY[~uHeTWD');

define('NONCE_KEY',        '.?N4B?|!=#l.Us{Z *dcC~$O>4_^&fsm:6X35/lCvz_H!EbXMku)^At{{uz+=VU}');

define('AUTH_SALT',        'J(Er?FJ:SJpF3#n0@@2gC=qLg[YEp_,bW8$~-51|!5+3%fu).+&X!VqU}Y6@r58w');

define('SECURE_AUTH_SALT', 'GlP4-;9_`]02[w+.mM]Q==;v(?{)Tv`Qu3BC^O=Bi^kX*Qzyt@}0%[anXIbvSliC');

define('LOGGED_IN_SALT',   '`-&+#0`*7<y5K p`Ff(U}a!u2WG|%,`dK0-wxo(dp$LA!7=tTl3b&y@ [2 FNhn8');

define('NONCE_SALT',       '<8^,,u{|_X,lIH}7Q+{*HPPF/dV[9cxfQn8]Ab|WA9z*G(~Gw7rA@ncrlF-6!vne');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wclp19_';


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
