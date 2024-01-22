<?php
global $wp_dog_pedigree_db;
$wp_dog_pedigree_db = '1.0.0';

function wp_dog_pedigree_deinstall() {
	global $wpdb;
	global $wp_dog_pedigree_db;

	$table_name = $wpdb->prefix . 'dogpedigree';
	
	$charset_collate = $wpdb->get_charset_collate();

	$wpdb->query( "DROP TABLE IF EXISTS " . $table_name );
}