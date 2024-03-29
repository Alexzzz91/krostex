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
define('WP_CACHE', false); //Added by WP-Cache Manager
//define( 'WPCACHEHOME', '/var/www/Beton-wordpress/src/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
// define('WP_HOME','http://krostex-beton.ru');
// define('WP_SITEURL','http://krostex-beton.ru');
define('WP_HOME','http://localhost:9010');
define('WP_SITEURL','http://localhost:9010');

define('DB_NAME', 'beton');



/** MySQL database username */

define('DB_USER', 'root');



/** MySQL database password */

define('DB_PASSWORD', 'myreallyhardpass1337');



/** MySQL hostname */

define('DB_HOST', 'db');



/** Database Charset to use in creating database tables. */

define('DB_CHARSET', 'utf8');



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

define('AUTH_KEY',         '2c0f7024244c1d38f9d23625a4f354261a0271a9');

define('SECURE_AUTH_KEY',  'dd5ebdf3cc3c47f999710e23537f724faaac8898');

define('LOGGED_IN_KEY',    'f902e746a5aefd97dcb889b60f1025a77498fc30');

define('NONCE_KEY',        '08ebf6d853e35e588b898c8a5bf966b57c63e2a6');

define('AUTH_SALT',        'f12f076cd034415327044164cc2ec7fc3a590344');

define('SECURE_AUTH_SALT', 'f95bbe4ea3e6f75d3eb92f83656eaa0acf3aeea1');

define('LOGGED_IN_SALT',   '51238db6ed8d2b4fca6849c6677499051c2b6510');

define('NONCE_SALT',       '020aaf38b4387807fcddf329af12107048aeffba');



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

define('WP_DEBUG', true);



// If we're behind a proxy server and using HTTPS, we need to alert Wordpress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');

