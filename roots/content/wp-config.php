<?php
// ===================================================
// Load database info and local development parameters
// ===================================================

//https://api.wordpress.org/secret-key/1.1/salt
if (!file_exists( dirname( __FILE__ ) . '/wp-salt.php') ) {
	exit('wp-salt.php file not found');
}

if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	define( 'WP_LOCAL_DEV', true );
	include( dirname( __FILE__ ) . '/local-config.php' );
} else {
	define( 'WP_LOCAL_DEV', false );
}

require_once(dirname( __FILE__ ) . '/wp-db-config.php');

// ========================
// Custom Content Directory
// ========================
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', dirname(__FILE__) . '/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
$siteurl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
define( 'WP_CONTENT_URL', $siteurl . '/content/wp-content' );

define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );

define('WP_SITEURL', $siteurl . '/content/wp'); // WordPress override for site url - qa/test conflict
define('WP_HOME', $siteurl . '/content'); // WordPress override of home

// ================================================
// You almost certainly do not want to change these
// ================================================
if (!defined('DB_CHARSET')) define( 'DB_CHARSET', 'utf8' );
if (!defined('DB_COLLATE')) define( 'DB_COLLATE', '' );

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );

// ===========
// Hide errors
// ===========
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );

// =================================================================
// Debug mode
// Debugging? Enable these. Can also enable them in local-config.php
// =================================================================
// define( 'SAVEQUERIES', true );
// define( 'WP_DEBUG', true );

// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) ) {
	$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );
}

// ===========================================================================================
// This can be used to programatically set the stage when deploying (e.g. production, staging)
// ===========================================================================================
define( 'WP_STAGE', '%%WP_STAGE%%' );
define( 'STAGING_DOMAIN', '%%WP_STAGING_DOMAIN%%' ); // Does magic in WP Stack to handle staging domain rewriting

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
require_once( ABSPATH . 'wp-settings.php' );
