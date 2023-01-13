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
define( 'DB_NAME', 'dmfisdb1' );

/** Database username */
define( 'DB_USER', 'Dmfi-It-1' );

/** Database password */
define( 'DB_PASSWORD', '{Dmfi-it#2022web};' );

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
define( 'AUTH_KEY',         'SoI0{7BPq~V94 98.dDj]&CH[[B+hJ8U.&wm*B.*X7YW$yzV*fSLz#eVoE*-m6O.' );
define( 'SECURE_AUTH_KEY',  '#_coZK4i6&i8K>dfX5<[/:)a9Kk.?F[>KX:mON9_ #trU:%h>ou{Zu5@ UwCEgq=' );
define( 'LOGGED_IN_KEY',    'mN/LcXA[h_H@$zr{u.JZ`SeA=RdXE7tCk(WxC~@HqXOD 6y+?P[#lqH4,7Vs7iXQ' );
define( 'NONCE_KEY',        'j06->;45[1Z~J69PHSRM:VQ7sk- 80zZ]IXvqw {sW/GV3@W==6ltazTXgEvig`:' );
define( 'AUTH_SALT',        'jp/=B{{}jkJeyixGbvWph<$(yw QSc}XH|p_V8W)%(k-3&xEW*p_ y:0]i{BFakT' );
define( 'SECURE_AUTH_SALT', 'p]1,Y+&|:^3oyX1PD84+R//[uOKW=Pc/LM^3JNxLPfp<*6b7ZG^DD$=n8GleGoTB' );
define( 'LOGGED_IN_SALT',   '|]ce)IPu%}s3aNad9<t8%)K<n)%6$HV|R/@t%ot=Y-<2rRC{drBhB2YLIp%frW-:' );
define( 'NONCE_SALT',       'C>J!m[Vxv H$7Ljimc^fT}Ek8J[ynQ?!9e29Z;HJ]m< Qk_qJ?d{keusEFONU_pY' );

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
