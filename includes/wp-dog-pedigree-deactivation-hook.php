<?php
global $wp_dog_pedigree_db;
$wp_dog_pedigree_db = '1.0.0';

function wp_dog_pedigree_deinstall() {
	global $wpdb;
	global $wp_dog_pedigree_db;
	$tables = array(
		$wpdb->prefix . 'dogpedigree_dogs',
		$wpdb->prefix . 'dogpedigree_owners',
		$wpdb->prefix . 'dogpedigree_titles'
	);
	foreach ( $tables as $table ) {
		$wpdb->query( "DROP TABLE IF EXISTS $table" );
	}
}