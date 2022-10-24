<?php
/**
 * Plugin Name: Inoventyk Feature Addons
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

function INO_Addon() {

	// Define COnstanst
	

define( 'VERSION', '1.0.0' );
define( 'INO_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'INO_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
define( 'INO_BASENAME', plugin_basename( __FILE__ ) );
define( 'INO_ASSETS', INO_URL . '/assets/' );

	// Load plugin file
	require_once( INO_DIR. '/includes/ino-plugin.php' );

	// Run the plugin
	\INO_FEATURES\INO_Features::instance();

}
add_action( 'plugins_loaded', 'INO_Addon' );