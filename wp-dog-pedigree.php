<?php
    /**
     * Plugin Name
     *
     * @package           Dog_Pedigree
     * @author            Ullrich Weichert - w3ich3rt
     * @copyright         2024 - Weichert.IT
     * @license           GPL-3.0-or-later
     *
     * @wordpress-plugin
     * Plugin Name:       Dog Pedigree
     * Plugin URI:        https://www.wazishen.com/wp-dog-pedigree
     * Description:       This is a plugin to create pedigree charts for animals or other things.
     * Version:           0.20.1
     * Tested up to:      6.4.3
     * Requires at least: 5.2
     * Requires PHP:      7.2
     * Author:            Ullrich Weichert - w3ich3rt
     * Author URI:        https://www.weichert.it/
     * Text Domain:       wp-dog-pedigree
     * License:           GPL v3 or later
     * Domain Path:       /languages
     * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
     * Update URI:        https://www.wazishen.com/wp-pedigree
     **/

    // If this file is called directly, abort.
    if ( ! defined( 'WPINC' ) ) {
        die;
    }

    define( 'WP_DOG_PEDIGREE_VERSION', '0.20.1' );

    /**
    * Load internationalization files
    **/
    add_action('init','wp_dog_pedigree_load_language');
    function wp_dog_pedigree_load_language() {
            load_plugin_textdomain('wp-dog-pedigree', false, dirname(plugin_basename( __FILE__ ) ) . '/languages');
    }


    require_once plugin_dir_path(__FILE__) . 'includes/wp-dog-pedigree-functions.php';

    /**
    * Create Database for the dog pedigrees.
    **/
    register_activation_hook( __FILE__, 'wp_dog_pedigree_db_install' );
    register_activation_hook( __FILE__, 'wp_dog_pedigree_data' );

    /**
    * Remove Database for the dog pedigrees when deinstall.
    **/
    register_deactivation_hook( __FILE__, 'wp_dog_pedigree_deinstall' );