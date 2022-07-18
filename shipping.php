<?php
/**
 * Plugin Name: Shipping Method plugin
 * Description: Made for the customization of theme.
 * Version: 1.1.1.7
 * Author: Codup
 * Author URI: https://codup.co/
 * Text Domain: Shipping-Method-plugin
 * WC requires at least: 3.8.0
 * WC tested up to: 5.1.0
 *
 * @package Maintenance Mode plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'SM_PLUGIN_DIR' ) ) {
	define( 'SM_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'SM_PLUGIN_DIR_URL' ) ) {
	define( 'SM_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WDP_ABSPATH' ) ) {
	define( 'SM_ABSPATH', dirname( __FILE__ ) );
}

require SM_PLUGIN_DIR . '/includes/class-sm-loader.php';


