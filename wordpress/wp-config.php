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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'labb-2' );

/** Database username */
define( 'DB_USER', 'medie-admin' );

/** Database password */
define( 'DB_PASSWORD', 'medie-admin' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'NM&bd@*=@{>/)Z;POJoct=t?plYQRT1~:Rtp/hJFDRH(3%:{.:C|(oSB[,2LRgIR' );
define( 'SECURE_AUTH_KEY',  'S[Dh,EiHS|=!]=JidiT8R>M#nO{n`5~O)SqyF.TP2?V|t] OToI<`i#*$W&<7F2h' );
define( 'LOGGED_IN_KEY',    'JLi#*8_5NX{&VA1oX9cP[;@L[.N]:zuHtbrvDEmseq),fW|0&o.i;aj!a~D@ILb#' );
define( 'NONCE_KEY',        'zYav><c99)u+Spl*=aCt/GN4Fk!x*H3m4#%DTMw|8SNC@4ofB)oo`[qPqvK#gx@?' );
define( 'AUTH_SALT',        '=NEjn*VWh7q97MW<odI!_Tkqc,yJmZ@]b_[/nnaB*g20}@XNPbU]9V{P)+u)2n>|' );
define( 'SECURE_AUTH_SALT', '}HJmFkB],kua7nQ8`qGSn)h1|%+r}/8tygpJ?mQ;FUu[>^ZjHXB2IMgQohgvd$}h' );
define( 'LOGGED_IN_SALT',   '`|A,;g/4l+|1#&im4XN%!R3;D)#8$Ppjl,PCc4)mQ5ZwO_-0k#[bS_uHb4|0A~`*' );
define( 'NONCE_SALT',       's%.KZHTTxy%Ux]ao*)BLnZP%0z^421l.n*)))[GR8rWKV2|WPA<ILQQUR>=#AQ?g' );

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
