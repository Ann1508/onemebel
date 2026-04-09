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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'one_mebel_db' );

/** Database username */
define( 'DB_USER', 'root' );

define( 'DB_PASSWORD', '' );
define( 'DB_HOST', '127.0.1.30' );

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
define( 'AUTH_KEY',         '%(|>Qh? Tm=Ljg[m;{n3wB/JP#$<Z`wSP^I1X% Lr~UeQ*dAvoo%)#mge7)?q5u8' );
define( 'SECURE_AUTH_KEY',  '8X9aaZ{t~-EA]KFBMYMVpwI%cT_]SC%Ku!2rDO=%{l|oEV`j.jr%[;jlSh2Z@6Ru' );
define( 'LOGGED_IN_KEY',    '&tc{<yuwzZre_ #&Huc,[7<&%:bP|X6`Ml+;<MO%rA~=+K@J21SGXoLB[pUn&&<#' );
define( 'NONCE_KEY',        'VWjF}IOJ= 4EC(o.^h6tZG3T/<n! x?fOkui*d*x96av8u`z^Sy|M0x:-ouaSfKp' );
define( 'AUTH_SALT',        '>_I5o*6J]-~Y$z:2nu^P01Pq.nL[PvO<~O,GyRXW_cVh?fDpavsws/I{5<}vV[q~' );
define( 'SECURE_AUTH_SALT', 'carg1$tk?jS[km1;(EW;{~]OSa,I;5LWv>(Yn5JdQK$S6O/NCQ1AwHvRlum@+,1w' );
define( 'LOGGED_IN_SALT',   'Oo!Dlxc]W66f6wWwFs)@Me0B+tD+;fhHSdY?QC78G &=K%ML-s]s#@z@5Sfv0s.&' );
define( 'NONCE_SALT',       ':f[Mcwn}Bw/rfQesbXS3c[;CQ_p6Qup~KLXR|iOb;ofu[2`.6M[mvC|(~ucK<vO[' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );
// define('WP_DEBUG_DISPLAY', true);
// define('WP_DEBUG_LOG', true);

/* Add any custom values between this line and the "stop editing" line. */

define( 'WP_MEMORY_LIMIT', '1024M' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
