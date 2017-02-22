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
define('DB_NAME', 'online_shop');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '5D$Z*WzHi:f[KtwFEG_a-E!u0[osFJAVRZe@jFnU%RlvDz+)maabUF=m|Mi-=G24');
define('SECURE_AUTH_KEY',  'pHq5|:nHz* iFg_93N{_U#i3}D?v[D}34-s3 nr[8CSw]Z1*P%Br~,])z};<>[lc');
define('LOGGED_IN_KEY',    'YC46rtE[Z5uL.*@XZ8[j[>:9At2t# We8>[s0zWV5k{tQy3JTw7{(U}6%ZU[HKPP');
define('NONCE_KEY',        '}oAq:C6v )97p6ft4:%[PSz|g#jBfSc%{oDs9Jed -(^*mC#*9X[.B$H_;MBoQ7M');
define('AUTH_SALT',        'd1vB$NkTZ1g:&?Xi{1r.BQ~ld5RGG-we~{wB-8^=<hq3~]A^U0NXuCwABNLod~.c');
define('SECURE_AUTH_SALT', '#6~nra{d.8rv4b#` ?@|g&bzh^QB+/*X!M0Pnd>T/&h4j+syrN%2#j{}}9 bV)81');
define('LOGGED_IN_SALT',   '_!ng7AWJrTdoh9@_>qs9&<|16/}Hy`SE{v7y~EqeRXk{mTtnd l|f-fvA1:T4h5H');
define('NONCE_SALT',       'A,Qs=|)#fBtdhXVJ>?PNlurLJ4y-[x)pDWB*,Ug{L}|N)e#$e)x:p?4,%d~=u-8j');

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
