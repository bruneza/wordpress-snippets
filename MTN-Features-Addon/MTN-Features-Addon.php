<?php
/**
 * Plugin Name: MTN Feature Addons
 * Plugin URI: https://inoventyk.rw/
 * Description: Inoventyk Job application listing plugin.
 * Version:     1.0.0
 * Author: Bruce Mugwaneza
 * Author URI: https://inoventyk.rw/
 * Text Domain: mtn
 * 
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function MTN_Addon() {

	// Define COnstanst
	

define( 'VERSION', '1.0.0' );
define( 'MTN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'MTN_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
define( 'MTN_BASENAME', plugin_basename( __FILE__ ) );
define( 'MTN_ASSETS', MTN_URL . '/assets/' );

	// Load plugin file
	require_once( MTN_DIR. '/includes/mtn-plugin.php' );

	// Run the plugin
	\MTN_FEATURES\MTN_Features::instance();

}
add_action( 'plugins_loaded', 'MTN_Addon' );