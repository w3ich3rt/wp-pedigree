<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.weichert.it
 * @since      1.0.0
 *
 * @package    Dog_Pedigree
 * @subpackage Dog_Pedigree/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dog_Pedigree
 * @subpackage Dog_Pedigree/includes
 * @author     Ullrich Weichert - w3ich3rt <ullrich@weichert.it>
 */
class Dog_Pedigree_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dog-pedigree',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
