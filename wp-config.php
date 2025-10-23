<?php
# BEGIN WP Cache by 10Web
define( 'WP_CACHE', true );
define( 'TWO_PLUGIN_DIR_CACHE', '/home/u311029381/domains/aztraderss.com/public_html/wp-content/plugins/tenweb-speed-optimizer/' );
# END WP Cache by 10Web
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '' );

/** Database username */
define( 'DB_USER', '' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', '' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '!E wXE>k{a~H-c89)Jc(4`o)/[O?>IauFi5=YQ2o,XP[Py3i[vt<nYMXJBy!)4B*' );
define( 'SECURE_AUTH_KEY',   'BV_?7E@k[i&<$K(Li0Z&{;r1k5w[ef+t65dUit~jS}uI7S8sB)([YBfc!:5<R Qy' );
define( 'LOGGED_IN_KEY',     'Ux$-GMDiF(IPdwhPIz|QNcaBf( %=P^J_|R8aYU3x-(v0e#v3 >Hrx[%z=4`<VL^' );
define( 'NONCE_KEY',         '0)vT5`#93sI$>jc#j.7Yq%f=~,1&%-=Npp25JXBVwR{]DJ^<pTS,!,zNh2wqO.B,' );
define( 'AUTH_SALT',         'gUX::<Gef*A6g`>-*R0XgjcNEN8`mcL<$ieO;b0gI+3zPT/>I68 Phj[/E5QV{U[' );
define( 'SECURE_AUTH_SALT',  'kok.[bn>ATlKl;{kaVY>]cubtFBMJBI5j8j(;nO&}+tK9<|}!:IryR9RpQIl/F1d' );
define( 'LOGGED_IN_SALT',    'V13d3B%IG;n`3ha/J?!SFwuQ5A_g5xu*}-jP&6gR+ZT:9-zU0{lY=TD>$uuc]#Cg' );
define( 'NONCE_SALT',        'v9EYnH2w> 7rGKFy^Ab5pXEbKOEdxKR6[ET.JsOh _f}]jAJ3&?rVUEj#cSf[~tX' );
define( 'WP_CACHE_KEY_SALT', '@LE39TXS*=D]-f[a+:3L;|I*AEbXe7kVe}RLT?tAM:0h#S9-T[cZnuGJtz7!;!go' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', 'ca1d26320303bff38f2283a6233b5216' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
define( 'WP_MEMORY_LIMIT', '512M' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
