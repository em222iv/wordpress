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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'alarmstreet');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'D{1#LpSj[_45oavFanbYw.T0%(>^]HemoX:mKXN:LJ+rs~md*Z+8ZR8#*!^fh$vo');
define('SECURE_AUTH_KEY',  'j.g(m?:_mN 9*,+`s!m@(ud-zQcz~GLM+F>lX[o^/.q%}9n_Ue[at$SSkB6Hl-T5');
define('LOGGED_IN_KEY',    'Hz^myh$=;?pSG|+$FQ7>Te^u !<vzT)r<|<r,eWL>mztAh #*5{k0orOj_T7ZKaR');
define('NONCE_KEY',        'a<Z11M%{X+tbE Tbq-L$}7<QJ^_f(5ELE[o :FouM>A-;B.Q#$LTF=OhY+mhC(yu');
define('AUTH_SALT',        'Vr/pz]u_8(nmsk)^,!=suS<nu2{J_Gp=+{Wv_*$qx)Zd:631 F[Re`wTt:aUE5>i');
define('SECURE_AUTH_SALT', 'OU=Q!1}$i?cX%NC+#92z^<qXUG*7Kdj _(Zo0*^0S9SkFPQSH_7RH>Sno5gaA+&l');
define('LOGGED_IN_SALT',   '[V>+M_>tv8XlZpkdH^1xC-j=w>wGnp308}wys=tYBEEBmZhcWo,N(@Ng=~MdG_9H');
define('NONCE_SALT',       '=~i#/a|p<vXy+dj[;~|[(@(<-0%+[)F^ FZAYSi&|b_q$;[zp-V4c+B#D_49$:;v');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
