<?php

if (!defined('ABSPATH')) {
    exit;
}

function tattookunst_crm_load_project($projects_table) {
    global $wpdb;

    if (!isset($_GET['edit_project'])) {
        return null;
    }

    $project_id = intval($_GET['edit_project']);

    return $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM $projects_table WHERE id = %d", $project_id)
    );
}