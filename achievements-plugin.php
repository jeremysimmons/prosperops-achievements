<?php
/**
 * Plugin Name:       ProsperOps Achievement Tracking Plugin
 * Plugin URI:        http://prosperops.com/
 * Description:       Achievements and Shortcodes for displaying company achievements 
 * Version:           1.0
 * Author:            Jeremy Simmons
 * Author URI:        http://jeremysimmons.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       POA
 *
 * @package           POA
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define global constants.
 *
 * @since 1.0.0
 */
// Plugin version.
if ( ! defined( 'POA_VERSION' ) ) {
	define( 'POA_VERSION', '2.0.0' );
}

if ( ! defined( 'POA_NAME' ) ) {
	define( 'POA_NAME', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );
}

if ( ! defined( 'POA_DIR' ) ) {
	define( 'POA_DIR', WP_PLUGIN_DIR . '/' . POA_NAME );
}

if ( ! defined( 'POA_URL' ) ) {
	define( 'POA_URL', WP_PLUGIN_URL . '/' . POA_NAME );
}

/**
 * achievement shortcode.
 *
 * @since 1.0.0
 */
require_once( POA_DIR . '/shortcode-achievement.php' );

/**
 * admin options.
 *
 * @since 1.0.0
 */
require_once( POA_DIR . '/admin-options.php' );
