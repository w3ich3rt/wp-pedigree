<?php
    /**
     * Plugin Name
     *
     * @package           WP Pedigree
     * @author            Ullrich Weichert - w3ich3rt
     * @copyright         2024 - Weichert.IT
     * @license           GPL-3.0-or-later
     *
     * @wordpress-plugin
     * Plugin Name:       WP Pedigree
     * Plugin URI:        https://www.wazishen.com/wp-pedigree
     * Description:       This is a plugin to create pedigree charts for animals or other things.
     * Version:           0.0.2
     * Requires at least: 5.2
     * Requires PHP:      7.2
     * Author:            Ullrich Weichert - w3ich3rt
     * Author URI:        https://www.weichert.it/
     * Text Domain:       wp-pedigree
     * License:           GPL v3 or later
     * Domain Path:       /languages
     * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
     * Update URI:        https://www.wazishen.com/wp-pedigree
     **/

    // Include mfp-functions.php, use require_once to stop the script if mfp-functions.php is not found
    require_once plugin_dir_path(__FILE__) . 'includes/wpped-functions.php';
