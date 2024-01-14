<?php
global $wp_dog_pedigree_db;
$wp_dog_pedigree_db = '1.0.0';

function wp_dog_pedigree_db_install() {
	global $wpdb;
	global $wp_dog_pedigree_db;

	$table_name = $wpdb->prefix . 'dogpedigree_dogs';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		ID mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		owner tinytext NOT NULL,
		breeder tinytext,
		gender bool NOT NULL,
		color tinytext NOT NULL,
		HD_value tinytext,
		fur_type bool NOT NULL,
		champion bool NOT NULL,
		multi bool NOT NULL,
		father tinytext,
		mother tinytext,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	//add_option( 'wp_dog_pedigree_db', $wp_dog_pedigree_db );
}

function wp_dog_pedigree_data() {
	global $wpdb;
	
	$example_dog = 'WaziSheN Asuka';
	$example_owner = 'Ubbo Fischer';
	$example_breeder = 'Claudia Weichert';
	$example_gender = '1';
	$example_color = 'Black';
	$example_HD_value = 'A1';
	$example_fur_type = '1';
	$example_champion = '0';
	$example_multi = '0';
	$example_father = 'Hary-Ming North Black King';
	$example_mother = 'Sbi-Wang Asuka';
	
	$table_name = $wpdb->prefix . 'wp_dogpedigree_dogs';
	
	$wpdb->insert(
		$table_name,
		array(
			'name' => $example_dog,
			'owner' => $example_owner,
			'breeder' => $example_breeder,
			'gender' => $example_gender,
			'color' => $example_color,
			'HD_value' => $example_HD_value,
			'fur_type' => $example_fur_type,
			'champion' => $example_champion,
			'multi' => $example_multi,
			'father' => $example_father,
			'mother' => $example_mother
		)
	);
}
