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
        $appointments_table = $wpdb->prefix . 'tattookunst_appointments';
$piercing_bookings_table = $wpdb->prefix . 'tattookunst_piercing_bookings';
$documents_table = $wpdb->prefix . 'tattookunst_documents';

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

$sql_appointments = "CREATE TABLE $appointments_table (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    customer_id mediumint(9) NOT NULL,
    booking_type varchar(50) NOT NULL,
    booking_id mediumint(9) DEFAULT NULL,
    title varchar(255) DEFAULT '',
    start_datetime datetime NOT NULL,
    end_datetime datetime NOT NULL,
    status varchar(50) DEFAULT 'gebucht',
    booking_source varchar(50) DEFAULT '',
    internal_notes text DEFAULT '',
    is_minor tinyint(1) DEFAULT 0,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY customer_id (customer_id),
    KEY booking_id (booking_id),
    KEY start_datetime (start_datetime),
    KEY status (status)
) $charset_collate;";

$sql_piercing_bookings = "CREATE TABLE $piercing_bookings_table (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    customer_id mediumint(9) NOT NULL,
    appointment_id mediumint(9) DEFAULT NULL,
    piercing_types longtext NOT NULL,
    piercing_count int NOT NULL DEFAULT 1,
    total_price decimal(10,2) DEFAULT 0,
    duration_minutes int NOT NULL DEFAULT 20,
    contact_method varchar(20) DEFAULT 'email',
    telegram_username varchar(100) DEFAULT '',
    image_ids longtext DEFAULT NULL,
    booking_status varchar(50) DEFAULT 'gebucht',
    review_status varchar(50) DEFAULT 'keine_anfrage',
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY customer_id (customer_id),
    KEY appointment_id (appointment_id),
    KEY booking_status (booking_status)
) $charset_collate;";

$sql_documents = "CREATE TABLE $documents_table (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    customer_id mediumint(9) NOT NULL,
    booking_type varchar(50) NOT NULL,
    booking_id mediumint(9) NOT NULL,
    document_type varchar(100) NOT NULL,
    document_data longtext DEFAULT NULL,
    version_number int NOT NULL DEFAULT 1,
    is_current tinyint(1) DEFAULT 1,
    signed_at datetime DEFAULT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY customer_id (customer_id),
    KEY booking_id (booking_id),
    KEY document_type (document_type),
    KEY is_current (is_current)
) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        dbDelta($sql_customers);
        dbDelta($sql_projects);
        dbDelta($sql_project_images);
        dbDelta($sql_requests);
        dbDelta($sql_appointments);
dbDelta($sql_piercing_bookings);
dbDelta($sql_documents);
    }
}