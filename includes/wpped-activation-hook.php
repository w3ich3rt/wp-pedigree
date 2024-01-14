function wpped_create_db() {

    global $wpdb;
    $version = get_option( 'wpped_plugin_version', '0.0.2' );
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'wpped_dogs';

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        views smallint(5) NOT NULL,
        clicks smallint(5) NOT NULL,
        UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

function wpped_delete_db() {

global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$table_name = $wpdb->prefix . 'my_analysis';

$sql = "DROP TABLE $table_name;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}
