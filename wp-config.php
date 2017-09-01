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
define('DB_NAME', 'ebisu');

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
define('AUTH_KEY',         'JRm,^5twi7Z^-*;8S%OV?`l3inigY2/Y`EMP7,hWqt1I%Yj^)ZR,+bCUd&&/7XAP');
define('SECURE_AUTH_KEY',  '(S4A_`7-UmK(ma~W*^]Zt-^j}lgGRDyF81V_c/#xagiWeix^,PQ >)Nt&e?,mW$z');
define('LOGGED_IN_KEY',    '-B9Ds@_rB%^snUCnh|m~]nYk.`KenQ6WdcX$[ azDVeSgwuzJU~9bXE0jHAlcg.*');
define('NONCE_KEY',        'dey&i)X*v&pj([&jes:(To7^@Y7<qTJmna1vK{DetPV|NOTs=LR5@k<nrcjAT ;V');
define('AUTH_SALT',        '?~]wqcVOc->=#Y-y1A8l$b5v1X^]wS%>nm[cGW<A,:GMxmLH$y~a&j3>$],R]#l/');
define('SECURE_AUTH_SALT', '}qrQOgA1M=U8>0D^}?Es$7(IluxQk.2spRO4f,=/#apicUDh85X@y|},+k={YKJ)');
define('LOGGED_IN_SALT',   '@U2K}O-Ilwamah@234wdH0ys:Y`,b_)ePAdvJ5,TfIHj;y:C_ecvY<wftdjFCNb=');
define('NONCE_SALT',       'X*>m_^LXR)pODL/-VofGB{1BbE:r`=IOZku2(.gW.i}W4GSZbxsVT@!T_Ca[EdX]');

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


ini_set('max_execution_time', 300);