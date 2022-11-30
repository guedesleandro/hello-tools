<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.helloagdigital.com
 * @since             1.0.0
 * @package           Hello_Tools
 *
 * @wordpress-plugin
 * Plugin Name:       Hello Utilily & Security
 * Plugin URI:        https://www.helloagdigital.com/tools
 * Description:       Recursos adicionais para o correto funcionamento do site e proteção
 * Version:           1.0.0
 * Author:            hello. agência digital
 * Author URI:        https://www.helloagdigital.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hello-tools
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'HELLO_TOOLS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hello-tools-activator.php
 */
function activate_hello_tools() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hello-tools-activator.php';
	Hello_Tools_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hello-tools-deactivator.php
 */
function deactivate_hello_tools() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hello-tools-deactivator.php';
	Hello_Tools_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hello_tools' );
register_deactivation_hook( __FILE__, 'deactivate_hello_tools' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-hello-tools.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hello_tools() {

	$plugin = new Hello_Tools();
	$plugin->run();

	if( ! class_exists( 'Hello_Tools_Updater' ) ){
		include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
	}
	
	$updater = new Hello_Tools_Updater( __FILE__ );
	$updater->set_username( 'guedesleandro' );
	$updater->set_repository( 'hello-tools' );

}
run_hello_tools();
