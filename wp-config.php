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
define( 'DB_NAME', 'wordpress_' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         ']`=?mHunyuz*NO]IsPi0Zn4Y_|eTgoSx97RR<:^o88MsM_pq:A7:dD5rT>:O_t:K' );
define( 'SECURE_AUTH_KEY',  '_tABH.PwL+Yy}n5{:HFHG,D3Gl2%bL*I^5rug9v@$Qq?cV@MjSvqK|MT-0F nab1' );
define( 'LOGGED_IN_KEY',    'Dro7Os#I[R4;{v%p1y&:W12D`w4qX<]D2qvV37jjld24J`G:.2.iE%^)wc]5IK6&' );
define( 'NONCE_KEY',        'TK*xVlw8Ua9+9GN*8a2>F04j r%Cw DYBR!<p]LHw4|6SDdN-G3`=;51%Bn(Q/*R' );
define( 'AUTH_SALT',        'P3hA<7+/I.3FL5MqwBY|W. QgTbqF3./?E,F[H6WBYGE~R7{5!{<qP_{3vSyYhCQ' );
define( 'SECURE_AUTH_SALT', 'z6m0:}$`o2P~D+Rilo&H;xYI|{Qv&a*z;4h57jAHi/=koo$y8tkDW%0E7@R(@xcP' );
define( 'LOGGED_IN_SALT',   'i+y&J3u;a{L,mJbYE#GAjE>t@5Ja/]Mu.!.u{#XJoT2tP|w;8-I<[FV]h`3E@}BF' );
define( 'NONCE_SALT',       '.Bqq`#YG m|bwM$H8c/Ym0 k/+:z>.x~Riyu].BSLa*3>;ZM4u9V/XIp3:|:E)jg' );

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
