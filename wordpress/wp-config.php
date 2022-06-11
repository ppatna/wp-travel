<?php
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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp' );

/** Database username */
define( 'DB_USER', 'wp' );

/** Database password */
define( 'DB_PASSWORD', 'secret' );

/** Database hostname */
define( 'DB_HOST', 'mysql' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '.#6LuNZ7WqhebV!~}xpfC$[)xW=R)j/ :53X97w( nfk`^Bw>0W/4~T6G/tKBLn3' );
define( 'SECURE_AUTH_KEY',  'p8*f1bhuWq+;W>NUfvxeh@oH|s;78$g.>)IJK+5oY)BIk1OD4#B>|9IbvZV?,@0;' );
define( 'LOGGED_IN_KEY',    '.,HctEQ9xsR(Yp0DwgVHc7dt~lUbF.K%Qvzr+Fo-R@ML>,^hXBINzK#ot,pmBhVd' );
define( 'NONCE_KEY',        'R/=OrSKW)Mcefh,.aSo7?kZ3wPd,qR!fu&:$+GGL4X[w53]<.8sY&a?(g~ +msr#' );
define( 'AUTH_SALT',        'P~:t?)[-<{2J~za]SYTNM,Q`!R02xOKUY!t7&ojlkhog{XQ*f{M>Wt{L_V;;dZy|' );
define( 'SECURE_AUTH_SALT', 'o6FhhuHM^o[yh9K/U9]@pW.$[;nwO#x!)qUbpj/pJFs}MV%3{v@:?P4l<a|n*W{B' );
define( 'LOGGED_IN_SALT',   'Z[. 8i5%[:y26dqwC3$7S2`K82z3k<xuYt~jjRY`2^SvaXs{D`hXxU/k.~4y!iXS' );
define( 'NONCE_SALT',       'EXK,wPnz,~~W]M41nO`XPQvreT?i/1=H&d4{ja,7M>DcfjG+8ffP}B0#coeWbMQr' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
