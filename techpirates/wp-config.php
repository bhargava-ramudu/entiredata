<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'techpirates' );

/** Database username */
define( 'DB_USER', 'techpirates' );

/** Database password */
define( 'DB_PASSWORD', 'fha6462kRY@#_sf78' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
/**define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );
*/

define('AUTH_KEY',         '%*jZj|MFIB)-X~,-!^YDhu[G1NmUJ(KP*tcv*JhEG=<poCk6W{)MP|*U4gV#5pNK');
define('SECURE_AUTH_KEY',  'C&H$=Yl!+a3XiX+|znwwNy2{VH@1-4-,+&FY56<xD+3|ujg_?1i#N ;Do3Pa9/x)');
define('LOGGED_IN_KEY',    'k-[Cz|E$i+W]3^ZwnxILJB1]q`MgP{Ki>hP Dt_L`[vA-+y[$_9#`z&w0=K)*rt{');
define('NONCE_KEY',        'H,=BIYFe+`N.o+UM-XTh:u,A#S:UC<aX|32$)dL0;jI]pt. Bg4uV^:w@h8Yf;HX');
define('AUTH_SALT',        'xnk&Eoy}|q%W>->q;rGyvc)*E<.yNt#G$)u@6}+d1umU_;wWS3@+TK*-~W`^@C+d');
define('SECURE_AUTH_SALT', '&@<W/sS[[Qiv-5~cYr+mvlugX?uFoF7<UV:x&2+-;oz*J+>k|T,#]Z>VnciU/ S+');
define('LOGGED_IN_SALT',   ';leid+jJ_x&<:R;3;C+wc}N_)vYzM`aaU{=GIo;S(6LAzP+cs0/h@Bizim$|sJ9Z');
define('NONCE_SALT',       '5~.5y&aiyW<@n-PAkASmoR=E)#1f37:vSz-c?+iMagG/:hu%YYPFq, TuLS:ts]H');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

define('FORCE_SSL_ADMIN', true);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
