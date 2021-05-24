<?php

/**
 *
 * @link              http://testwork.mariam
 * @since             1.0.0
 * @package           Cars_Listing
 *
 * @wordpress-plugin
 * Plugin Name:       Cars Listing
 * Plugin URI:        http://cars-listing.com
 * Description:       This is a Test Task Plugin for Mariam Garibov.
 * Version:           1.0.0
 * Author:            Sheraz Ahmed
 * Author URI:        http://testwork.mariama
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cars-listing
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'CARS_LISTING_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 */
function activate_cars_listing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cars-listing-activator.php';
	Cars_Listing_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_cars_listing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cars-listing-deactivator.php';
	Cars_Listing_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cars_listing' );
register_deactivation_hook( __FILE__, 'deactivate_cars_listing' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cars-listing.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_cars_listing() {

	$plugin = new Cars_Listing();
	$plugin->run();

}
run_cars_listing();