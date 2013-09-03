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


// heroku cleardb settings.

if (getenv("CLEARDB_DATABASE_URL")) {
	$cleardb_url=parse_url(getenv("CLEARDB_DATABASE_URL"));

	$cleardb_server = $cleardb_url["host"];
	$cleardb_username = $cleardb_url["user"];
	$cleardb_password = $cleardb_url["pass"];
	$cleardb_db = substr($cleardb_url["path"],1);	
} else {
	$cleardb_server = 'localhost';
	$cleardb_username = 'bitters';
	$cleardb_password = 'bottles';
	$cleardb_db = 'bitters2';	
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $cleardb_db);

/** MySQL database username */
define('DB_USER', $cleardb_username);

/** MySQL database password */
define('DB_PASSWORD', $cleardb_password);

/** MySQL hostname */
define('DB_HOST', $cleardb_server);

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
define('AUTH_KEY',         'YIf[E1DwQA z*.b)}[H:UX&ANCY41kRbtD9OP|4|<!W]wJ7Lilo06S&|]M0+KMz3');
define('SECURE_AUTH_KEY',  '644t{1(`:?b.~~X#MO/=$|M-QZzzizFx2>s{_79q6RWoSzx$j-z$As%K25_o%XS5');
define('LOGGED_IN_KEY',    'HdN{D~xQ-c:A(S.^A$25v/+%75tcu_+=/8)G] eyW#f:-:[)LjQEZ9+!%awZfCWB');
define('NONCE_KEY',        'o=q)#$M`qCB5,B=<,|3`_~M}-SeOsEQAXgUrRBO>-DhYs#uT7<NUPx~=)-hE!54v');
define('AUTH_SALT',        'G>f{`F*6w5=PdR}G8+HA.S~%[bm;f3}=+.N15{2]%{NX:!2DG1<Fec1@5||t0<(b');
define('SECURE_AUTH_SALT', 'Q#7AM]e+`/K:X1N6s~3uy;j-tyXu4;ZRF^;Ur%)rBWsiUGFYeUlr`%skbk/8t-dN');
define('LOGGED_IN_SALT',   '0_6__keg54]EIs=e-|?.?i{[E65Krc#3-@KtU:?#(evc(=)|+sCdX%#w`{;u}-(G');
define('NONCE_SALT',       '!MjQG,GYLr1}2n&rjc5jGehQ_VnArP]@f4;aQ@(,.=u%cdH]8rX.Y_Bq:MW]|gS0');

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
define('WPLANG', '');

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

