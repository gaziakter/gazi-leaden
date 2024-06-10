<?php
if (!defined('ABSPATH')) {
    exit;
}

class GaziLeaden_DB {
    public static function create_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'gazi_leaden';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            whatsapp varchar(15) NOT NULL,
            website varchar(255) NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function insert_data($data) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'gazi_leaden';
        $wpdb->insert($table_name, $data);
    }

    public static function get_data() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'gazi_leaden';
        return $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    }
}
?>
