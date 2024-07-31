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
define( 'DB_NAME', 'mmadmin' );

/** Database username */
define( 'DB_USER', 'mmadmin' );

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

define('AUTH_KEY',         'FwU<C8vdqja.SL~XE?O+4xi*%9R;h|/DY&@: [f{dl_Ula]YzHg2lE/JMU||0&g|');
define('SECURE_AUTH_KEY',  'MhfQM6FZA(zO}hC>O|ml~e{+-Jj3Xs?`dtgr0M&!Z+>>R #P{?K8-&C&=p[n[n7A');
define('LOGGED_IN_KEY',    'n]iD*~FY!J9Ew_v4Hc3fwTUu-!7cv} -zy@-C?ETovEA=/V5?8L#e|gzs!GpG?Jz');
define('NONCE_KEY',        '!?pv2OlKO=EzbEYv^t9>/g+;^4B=+vLB%h~8+}##>u&bBr4iBV8qb#CAOQS?9]qh');
define('AUTH_SALT',        '8vwV^F%?O,RMyewl)k7XF(-_<).ViWxb,zn*aY+mEZ/P~ o^CGcr*VU/~UxKIme)');
define('SECURE_AUTH_SALT', 'Bwl|p-e C*|&O`rP,*Bs/7nAT/M%D7T}S<+XCrk2_aiFzbUP?t3_U>>k~6njzB`P');
define('LOGGED_IN_SALT',   '+:9},]%:K&Ogg0xhr]#<}e^}HV~oa+&B56Ju||Z}GgQ+WSq.Bto+Ed,-8.nNx|a+');
define('NONCE_SALT',       '|~+(mgWP:V|A+v#:8O~YpvR^r+~y.8~!Qkh;fe[@&v^uw+eo*JA-z_+dbs4- oA=');
/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'mm_';

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
