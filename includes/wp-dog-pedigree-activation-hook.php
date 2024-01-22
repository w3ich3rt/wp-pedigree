<?php

function wp_dog_pedigree_db_install() {
	global $wpdb;
	global $wp_dog_pedigree_db;
	$wp_dog_pedigree_db = '1.3.0';

	$table_name = $wpdb->prefix . 'dogpedigree';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		ID mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		owner tinytext NOT NULL,
		owner_contact tinytext,
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
		dog_title tinytext,
		dog_breed_conditions tinytext,
		dog_miss_tooth tinytext,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );
	update_option( 'wp_dog_pedigree_version', $wp_dog_pedigree_db );
	wp_dog_pedigree_update_tables_when_plugin_updating();

	add_option( 'wp_dog_pedigree_version', $wp_dog_pedigree_db );
}

function wp_dog_pedigree_update_tables_when_plugin_updating() {
	global $wpdb;
	$oldVersion = get_option( 'wp_dog_pedigree_version', '1.1.0' );
	$newVersion = '1.3.0';
	if ( $oldVersion < $newVersion ) {
		$table_name = $wpdb->prefix . 'dogpedigree';
		$charset_collate = $wpdb->get_charset_collate();
		$wpdb->query ("ALTER TABLE " . $table_name . " ADD dog_title tinytext");
		$wpdb->query ("ALTER TABLE " . $table_name . " ADD dog_breed_conditions tinytext");
		$wpdb->query ("ALTER TABLE " . $table_name . " ADD dog_miss_tooth tinytext");
		$wpdb->query ("ALTER TABLE " . $table_name . " ADD stud_dog bool");
		update_option( 'wp_dog_pedigree_version', $newVersion );
	}
	//TODO: Add missing tables
	// $newVersion = '1.4.0';
	// if ( $oldVersion < $newVersion ) {
	// 	$table_name = $wpdb->prefix . 'dogpedigree';
	// 	$charset_collate = $wpdb->get_charset_collate();
	// 	$wpdb->query ("ALTER TABLE " . $table_name . " ADD owner_contact tinytext");
	// 	update_option( 'wp_dog_pedigree_version', $newVersion );
	// }
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
	$example_mother = 'Sbi-Wang Ayumi';
	
	$table_name = $wpdb->prefix . 'dogpedigree';

	if($wpdb->get_results("SELECT * FROM $table_name WHERE name = '$example_dog'")) {
		return true;
	} else {
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
}
