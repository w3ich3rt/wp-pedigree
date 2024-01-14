<?php
global $wp_dog_pedigree_db;
$wp_dog_pedigree_db = '1.0';

function wp_dog_pedigree_install() {
	global $wpdb;
	global $wp_dog_pedigree_db;

	$table_name = $wpdb->prefix . 'wpdogpedigree_dogs';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "DROP TABLE IF EXISTS $table_name;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	add_option( 'wp_dog_pedigree_db', $wp_dog_pedigree_db );
}