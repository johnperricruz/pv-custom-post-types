<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.johnperricruz.com
 * @since             1.0.0
 * @package           Pv_Post_Type
 *
 * @wordpress-plugin
 * Plugin Name:       Primeview Custom Post Types
 * Plugin URI:        https://www.primeview.com
 * Description:       This plugin is developed to maintain different custom post types.
 * Version:           1.0.0
 * Author:            John Perri Cruz
 * Author URI:        https://www.johnperricruz.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pv-post-type
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pv-post-type-activator.php
 */
function activate_pv_post_type() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pv-post-type-activator.php';
	Pv_Post_Type_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pv-post-type-deactivator.php
 */
function deactivate_pv_post_type() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pv-post-type-deactivator.php';
	Pv_Post_Type_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pv_post_type' );
register_deactivation_hook( __FILE__, 'deactivate_pv_post_type' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pv-post-type.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pv_post_type() {
	require_once('apis/PvPostTypeController.php');
	
	$plugin = new Pv_Post_Type();
	$plugin->run();
	
	$PvPostTypeController = new PvPostTypeController();
}
run_pv_post_type();
