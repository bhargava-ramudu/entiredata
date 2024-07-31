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
define( 'DB_NAME', 'tplearning' );

/** Database username */
define( 'DB_USER', 'tplearning' );

/** Database password */
define( 'DB_PASSWORD', 'Slkg@_8263ahkldf' );

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
/**
define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );
*/



define('AUTH_KEY',         '~9)vTFtA(o|yj^_3M>T pvZ1h`=6p{VqYp!nyi9!M%AQwWD5iIYxeA?ethzq&;mO');
define('SECURE_AUTH_KEY',  'Nsk-wiBu,i|astBb?;r>8_pP^puEq(mG`A|Q0*ofr;5rl<CaQm[f_%asl<~PfsY|');
define('LOGGED_IN_KEY',    'sDb[%tui+@0+6?!~_}LVwr4D]Du4._m:>A9h6^Xr2%R<aK=Y(A:|D:Thy,*LM6l{');
define('NONCE_KEY',        'c0bG>4gi:T$zeJC1y>^H%EcS8WyfT( -~7=tVj0+}Dz#t!c8Krc - =(E&$qNYrl');
define('AUTH_SALT',        'FoYisqC&}e= qPP!J.c>BrXB{O$dcvuxA~!I+?tV|p$R{7.V`WU(]sMRQ~?r~0mG');
define('SECURE_AUTH_SALT', '1UHHIbuss6m<WR$q3a8z;m2*-dMI~<:;6g,mV-KT@[hW46GgS#XyB=rc|  IeFpx');
define('LOGGED_IN_SALT',   'N@+F/Y=ccKl-,XW#b_D [03=:%CNtG>V`B7;O_=/C@V8%r8)I]<;(fJO*,f<USM)');
define('NONCE_SALT',       'U;#u&X(oc0-vW8*K 3`+jP%2]-hT{xnpvLt#+`wmh+KTG8B>T6?Yc^4#u_X+~V01');
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
