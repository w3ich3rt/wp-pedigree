<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.weichert.it
 * @since             1.0.0
 * @package           Dog_Pedigree
 *
 * @wordpress-plugin
 * Plugin Name:       Dog Pedigree
 * Plugin URI:        https://www.wazishen.de/wp-dog-pedigree
 * Description:       This is a plugin to create pedigree charts for animals or other things.
 * Version:           1.0.0
 * Author:            Ullrich Weichert - w3ich3rt
 * Author URI:        https://www.weichert.it/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dog-pedigree
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
define( 'DOG_PEDIGREE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dog-pedigree-activator.php
 */
function activate_dog_pedigree() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dog-pedigree-activator.php';
	Dog_Pedigree_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dog-pedigree-deactivator.php
 */
function deactivate_dog_pedigree() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dog-pedigree-deactivator.php';
	Dog_Pedigree_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dog_pedigree' );
register_deactivation_hook( __FILE__, 'deactivate_dog_pedigree' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dog-pedigree.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dog_pedigree() {

	$plugin = new Dog_Pedigree();
	$plugin->run();

}
run_dog_pedigree();
