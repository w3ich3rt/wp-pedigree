<?php

function wp_dog_pedigree_db_install() {
	global $wpdb;
	global $wp_dog_pedigree_db;
	$wp_dog_pedigree_db = '1.0.0';

	$pedigree_table_dog = $wpdb->prefix . 'dogpedigree_dogs';
	$pedigree_table_owner = $wpdb->prefix . 'dogpedigree_owners';
	$pedigree_table_title = $wpdb->prefix . 'dogpedigree_titles';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql_dog_table = "CREATE TABLE IF NOT EXISTS $pedigree_table_dog (
		ID mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		owner int,
		breeder tinytext,
		gender bool NOT NULL,
		color tinytext NOT NULL,
		HD_value tinytext,
		fur_type bool NOT NULL,
		champion bool NOT NULL,
		multi bool NOT NULL,
		stud_dog bool NOT NULL,
		father tinytext,
		mother tinytext,
		dog_breed_conditions tinytext,
		dog_miss_tooth tinytext,
		birthday date,
		deathday date,
		studbook_nr tinytext,
		shoulder_height tinyint,
		PRIMARY KEY  (id),
		CONSTRAINT fk_owner FOREIGN KEY (owner) REFERENCES $pedigree_table_owner(ID)
	) $charset_collate;";

	$sql_owner_table = "CREATE TABLE IF NOT EXISTS $pedigree_table_owner (
		ID mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		street tinytext,
		zip tinytext,
		city tinytext,
		country tinytext,
		phone tinytext,
		mobile tinytext,
		email tinytext,
		website tinytext,
		PRIMARY KEY (ID)
	) $charset_collate;";

	$sql_title_table = "CREATE TABLE IF NOT EXISTS $pedigree_table_title (
		ID mediumint(9) NOT NULL AUTO_INCREMENT,
		title tinytext NOT NULL,
		dogname tinytext,
		PRIMARY KEY (ID),
		CONSTRAINT fk_dog FOREIGN KEY (dogname) REFERENCES $pedigree_table_dog(name)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	$wpdb->query( $sql_owner_table );
	$wpdb->query( $sql_dog_table );
	$wpdb->query( $sql_title_table );
	update_option( 'wp_dog_pedigree_version', $wp_dog_pedigree_db );
	wp_dog_pedigree_update_tables_when_plugin_updating();

	add_option( 'wp_dog_pedigree_version', $wp_dog_pedigree_db );
}

function wp_dog_pedigree_update_tables_when_plugin_updating() {
	global $wpdb;
	$oldVersion = get_option( 'wp_dog_pedigree_version', '1.0.0' );
	$newVersion = '0.0.0';
	if ( $oldVersion < $newVersion ) {
		$pedigree_table_dog = $wpdb->prefix . 'dogpedigree_dogs';
		$pedigree_table_owner = $wpdb->prefix . 'dogpedigree_owners';
		$charset_collate = $wpdb->get_charset_collate();
		update_option( 'wp_dog_pedigree_version', $newVersion );
	} else {
		sprintf (__('wp_dog_pedigree_update_sql_message','wp-dog-pedigree'));
	}
}

function wp_dog_pedigree_data() {
	global $wpdb;
	
	// $example_dog = 'WaziSheN Asuka';
	// $example_owner = 'Ubbo Fischer';
	// $example_breeder = 'Claudia Weichert';
	// $example_gender = '1';
	// $example_color = 'Black';
	// $example_HD_value = 'A1';
	// $example_fur_type = '1';
	// $example_champion = '0';
	// $example_multi = '0';
	// $example_father = 'Hary-Ming North Black King';
	// $example_mother = 'Sbi-Wang Ayumi';
	
	// $pedigree_table_dog = $wpdb->prefix . 'dogpedigree_dogs';
	// $pedigree_table_owner = $wpdb->prefix . 'dogpedigree_owners';

	// if($wpdb->get_results("SELECT * FROM $pedigree_table_dog WHERE name = '$example_dog'")) {
	// 	return true;
	// } else {
	// 	$wpdb->insert(
	// 		$pedigree_table_dog,
	// 		array(
	// 			'name' => $example_dog,
	// 			'owner' => $example_owner,
	// 			'breeder' => $example_breeder,
	// 			'gender' => $example_gender,
	// 			'color' => $example_color,
	// 			'HD_value' => $example_HD_value,
	// 			'fur_type' => $example_fur_type,
	// 			'champion' => $example_champion,
	// 			'multi' => $example_multi,
	// 			'father' => $example_father,
	// 			'mother' => $example_mother
	// 		)
	// 	);
	// }
}
