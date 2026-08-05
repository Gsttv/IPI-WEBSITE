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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',          '<+YBTcw.Ng;Eao8I?BlC||pyE}96m|01j8=5PlM@hVuMXVYT=FG;*)4>e>BFwd{O' );
define( 'SECURE_AUTH_KEY',   '$_B:6*R}V*gDnr+S}^Q0%cGuO/n=< nF;J$?GRh#<h:^qLN&[+5VC?`9t(qeb|h*' );
define( 'LOGGED_IN_KEY',     't)J!7AUhn(S%`pUY?$-AGR$Di|XL4ogfq0 D`LGzOVf>Oiq`w;/c/ui !T~OGll,' );
define( 'NONCE_KEY',         'xCVm zhBmlKixjz:kl>,/:S<jo]$5JydYJJodqk}(a7qw{2U3DxK3z$P<$UMs@*W' );
define( 'AUTH_SALT',         'yCvep*HNBUI16 ZCWT,ggK#haDtC3G9t=V]hH/R cd.zsF*kh$ W*Wc(=d}jNMdc' );
define( 'SECURE_AUTH_SALT',  ']Gc.3m;A-|@Y1j[q:-UDm(m rn@l7)bTiQt*~oO26X)B6r}-(ER_FTxQ-}tm*8zW' );
define( 'LOGGED_IN_SALT',    'hl.2(*opkO&= zzNDxl7#==URwS!#7.vDU4x_YHKo4r2D7lRCqk>=hQwWQMY^2>,' );
define( 'NONCE_SALT',        'E2ntIN,|XT^U_l-1_=Ay0lL`-|*~Db3cQ{+gm}DKc:e$6NYR#qDV9)m,TtnGp|+W' );
define( 'WP_CACHE_KEY_SALT', 'WVE.X9ganbbm{Qf-+=@-@.NPyEJICyc8/FD*SP+2JsuTH*C!uQKW:OJji+8v>5^O' );


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

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
