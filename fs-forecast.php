<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.franckysolo-productions.com/
 * @since             1.0.0
 * @package           Fs_Forecast
 *
 * @wordpress-plugin
 * Plugin Name:       Weather Forecast 1.0
 * Plugin URI:        http://github.com/franckysolo/fs-forecast
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            MATHERAT Franck - franckysolo
 * Author URI:        http://www.franckysolo-productions.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fs-forecast
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-fs-forecast-activator.php
 */
function activate_fs_forecast() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fs-forecast-activator.php';
	Fs_Forecast_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-fs-forecast-deactivator.php
 */
function deactivate_fs_forecast() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fs-forecast-deactivator.php';
	Fs_Forecast_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_fs_forecast' );
register_deactivation_hook( __FILE__, 'deactivate_fs_forecast' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-fs-forecast.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_fs_forecast() {

	$plugin = new Fs_Forecast();
	$plugin->run();

}
run_fs_forecast();
