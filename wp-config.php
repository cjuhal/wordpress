<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'nodalcultura');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
 define('AUTH_KEY',         'KD9Z9:0O>,+m}Z;;.tV%)dt>fLd=VuoZVepw(xY0G*I9n3((8Is~rV5n$|{4`*(g');
 define('SECURE_AUTH_KEY',  '?]OEm$m#PJ5=Zh+ES/4h-f+1iT+RK1;ip}AT#QSx6s5=i)/ghW1Hwpb2Ubw)^4(m');
 define('LOGGED_IN_KEY',    'PGI1zZN-lZbFV}D;=IH.Ob}.2!x?up^L.^5KmfE@Pvzyu{20edZRq}M@P%A8hi%`');
 define('NONCE_KEY',        '-/X,OT}.+^p3Aa.o&j{$.s;P??e;us,Xhp+>)dDP9O?|+>D{_?tl6u`,xx4ULnpk');
 define('AUTH_SALT',        'bJB[-rLrF]1b:y<pk$M;UyQg!XRL%OSsT|+}|*?=L*$oF1KY#qNAD,Nw$|jCf`A[');
 define('SECURE_AUTH_SALT', '{7^e@Cuf:+fh6`mo?egR-dj`<V`|vXf?D; ci|nnjttwQO$^wG$I.|&|)UwhF>I{');
 define('LOGGED_IN_SALT',   'R@H7a#Mch+wh1v,|=c,SA%tq~wi@C%EhrIa=%iqy-WF!Hk1=:1B<R#C+M_J6_:7a');
 define('NONCE_SALT',       '`~b`P;t!cD&x[BDi@duMJ_.A;:z4/kMzB8&wzz_@{)@L}A|Ci~Xae#+KS:c<>.Za');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
