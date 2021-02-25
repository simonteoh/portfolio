<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'portfolio_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'nS/riRBXt~_aG8cz[#6Swh_G=TY`r`<cWrrPG![JwqD~}P/&!5jOC)occ~x:D6FY' );
define( 'SECURE_AUTH_KEY',  'xk1{ (e7I+VmUpw=0JnYP=grm80Z4`Baq:zkt-y}kNX%KC](4<vJ%~L*n0i#icZc' );
define( 'LOGGED_IN_KEY',    'cnAAAV$cumC+hbQ:WXauyQdcDNL?-lK2^G[ro[A~*}i}/0/sp9qL+_}k!6|V:h4I' );
define( 'NONCE_KEY',        '>?Q+=,zgTr9?LZx#o@)IMGWbKi/&C699:u AG[4.Qv .X5U?K-TSXigt=oX{Q>.L' );
define( 'AUTH_SALT',        '(j5qMn;Rq)0i-CY4BSl-]m;Ucv=S@ttc8h;H.=|Q2x|(fzrkyBVG*k3+JmFJ~gHO' );
define( 'SECURE_AUTH_SALT', 'fi4(C^jEy]t+1(%VI){&qF@[vAiUmW{9n$aDaL<VKP,cHN<&UQp2)XC!JhFEsg6.' );
define( 'LOGGED_IN_SALT',   'QPhW)2t+em;2OL}P|TiL2SfuV1 |dR4>kD/ji8+=unFY_Q$*v<-$U/?48sNA8U]D' );
define( 'NONCE_SALT',       '@M3%5lhIg<2)0va15=jG8+#>uh=8_DRIIX+sVJW.#{BifS&:^LX`Z+DrCKQj/Q{>' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

@ini_set('upload_max_size' , '256M');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
