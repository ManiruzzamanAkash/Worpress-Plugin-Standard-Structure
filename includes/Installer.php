<?php

namespace WeDevs\Academy;

/**
 * Installer Class
 */
class Installer {

    /**
     * Run Installer
     * 
     * Add version and create tables
     *
     * @return void
     */
    public function run (){
        $this->add_version();
        $this->create_tables();
    }

    /**
     * Add Version
     *
     * @return void
     */
    public function add_version(){
        $installed = get_option('wd_academy_installed');

        if ( ! $installed ) {
            update_option('wd_academy_installed', time());
        }

        update_option('wd_academy_version', WD_ACADEMY_VERSION);
    }

    public function create_tables()
    {
        global $wpdb;

        $charset_collet = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}ac_addresses` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(100) NOT NULL DEFAULT '',
            `address` varchar(150) DEFAULT NULL,
            `phone` varchar(15)  DEFAULT NULL,
            `created_by` bigint(20)  unsigned NOT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collet";

        if ( ! function_exists( 'dbDelta' )) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );
    }
}
