<?php

if (!defined('ABSPATH')) {
    exit;
}

class Tattookunst_CRM_Database {

    public static function create_tables() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $customers_table      = $wpdb->prefix . 'tattookunst_customers';
        $projects_table       = $wpdb->prefix . 'tattookunst_projects';
        $project_images_table = $wpdb->prefix . 'tattookunst_project_images';
        $requests_table = $wpdb->prefix . 'tattookunst_requests';

        $sql_customers = "CREATE TABLE $customers_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            gender varchar(20) DEFAULT '',
            skin_type varchar(20) DEFAULT '',
            phone varchar(100) DEFAULT '',
            email varchar(255) DEFAULT '',
            birthday date DEFAULT NULL,
            whatsapp tinyint(1) DEFAULT 0,
            telegram tinyint(1) DEFAULT 0,
            customer_source varchar(100) DEFAULT '',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";

        $sql_projects = "CREATE TABLE $projects_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            customer_id mediumint(9) NOT NULL,
            project_name varchar(255) DEFAULT '',
            tattoo_wish text NOT NULL,
            reference_images longtext DEFAULT NULL,
            project_type varchar(100) NOT NULL,
            project_type_custom varchar(255) DEFAULT '',
            project_size varchar(100) NOT NULL,
            body_parts text NOT NULL,
            body_parts_custom varchar(255) DEFAULT '',
            style varchar(255) DEFAULT '',
            color_type varchar(50) DEFAULT '',
            skin_type varchar(20) DEFAULT '',
            preferred_artist varchar(255) DEFAULT 'Chris',
            desired_timeframe varchar(100) DEFAULT '',
            appointment_notes text DEFAULT '',
            total_price decimal(10,2) DEFAULT 0,
            deposit decimal(10,2) DEFAULT 0,
            price_per_session decimal(10,2) DEFAULT 0,
            estimated_sessions int DEFAULT 0,
            completed_sessions int DEFAULT 0,
            status varchar(100) DEFAULT 'anfrage',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY customer_id (customer_id)
        ) $charset_collate;";

        $sql_project_images = "CREATE TABLE $project_images_table (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            project_id mediumint(9) NOT NULL,
            image_id bigint(20) NOT NULL,
            category varchar(100) DEFAULT 'referenzbild',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY project_id (project_id)
        ) $charset_collate;";

        $sql_requests = "CREATE TABLE $requests_table (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    customer_id mediumint(9) DEFAULT NULL,
    linked_project_id mediumint(9) DEFAULT NULL,

    firstname varchar(100) NOT NULL,
    lastname varchar(100) NOT NULL,
    phone varchar(100) NOT NULL,
    contact_method varchar(20) NOT NULL DEFAULT '',
telegram_username varchar(100) DEFAULT '',
    email varchar(255) NOT NULL,
    birthday date NOT NULL,
    gender varchar(20) DEFAULT '',

    tattoo_wish text NOT NULL,
    reference_images longtext DEFAULT NULL,
    project_type varchar(100) DEFAULT '',
    project_type_custom varchar(255) DEFAULT '',
    project_size varchar(100) DEFAULT '',
    style varchar(255) DEFAULT '',
    color_type varchar(50) DEFAULT '',
    body_parts text DEFAULT '',
    body_parts_custom varchar(255) DEFAULT '',
    desired_timeframe varchar(100) DEFAULT '',
    desired_timeframe_note varchar(255) DEFAULT '',
    customer_source varchar(100) DEFAULT '',
    customer_notes text DEFAULT '',

    internal_notes text DEFAULT '',
    total_price decimal(10,2) DEFAULT 0,
    deposit decimal(10,2) DEFAULT 0,
    price_per_session decimal(10,2) DEFAULT 0,
    estimated_sessions int DEFAULT 0,

    status varchar(100) DEFAULT 'neu',
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    KEY customer_id (customer_id),
    KEY linked_project_id (linked_project_id),
    KEY status (status)
) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        dbDelta($sql_customers);
        dbDelta($sql_projects);
        dbDelta($sql_project_images);
        dbDelta($sql_requests);
    }
}