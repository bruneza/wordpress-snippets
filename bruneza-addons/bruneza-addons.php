<?php
/**
 * Plugin Name: BRUNEZA Addons
 * Plugin URI: https://bruneza.online/
 * Description: Additional Features to make the website more Amazing with less plugins.
 * Version:     1.0.0
 * Author: Bruce Mugwaneza
 * Author URI: https://bruneza.online/
 * Text Domain: bruneza
 * 
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function BRU_Addon() {

	// Define COnstanst
	

define( 'VERSION', '1.0.0' );
define( 'BRU_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'BRU_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
define( 'BRU_BASENAME', plugin_basename( __FILE__ ) );
define( 'BRU_ASSETS', BRU_URL . '/assets/' );

	// Load plugin file
	require_once( BRU_DIR. '/includes/plugin.php' );

	// Run the plugin
	\BRU_Addons\Features::instance();

}
add_action( 'plugins_loaded', 'BRU_Addon' );
