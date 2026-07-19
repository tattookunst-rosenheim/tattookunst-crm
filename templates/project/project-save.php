<?php

if (!defined('ABSPATH')) {
    exit;
}

function tattookunst_crm_prepare_project_data() {
    $style = sanitize_text_field($_POST['style'] ?? '');
    $style_custom = trim(sanitize_text_field($_POST['style_custom'] ?? ''));

    $final_style = ($style === 'eigener_stil')
        ? 'Eigener Stil: ' . $style_custom
        : $style;

        $color_type = sanitize_text_field($_POST['color_type'] ?? '');

    $body_parts = isset($_POST['body_parts'])
        ? array_map('sanitize_text_field', $_POST['body_parts'])
        : [];

    return [
        'customer_id'        => intval($_POST['customer_id'] ?? 0),
        'project_name'       => trim(sanitize_text_field($_POST['project_name'] ?? '')),
        'tattoo_wish'        => trim(sanitize_textarea_field($_POST['tattoo_wish'] ?? '')),
        'project_type'       => sanitize_text_field($_POST['project_type'] ?? ''),
        'project_type_custom'=> trim(sanitize_text_field($_POST['project_type_custom'] ?? '')),
        'project_size'       => sanitize_text_field($_POST['project_size'] ?? ''),
        'body_parts'         => $body_parts,
        'body_parts_custom'  => trim(sanitize_text_field($_POST['body_parts_custom'] ?? '')),
        'style'              => $style,
        'style_custom'       => $style_custom,
        'final_style'        => $final_style,
        'color_type' => $color_type,
        'skin_type' => sanitize_text_field($_POST['skin_type'] ?? ''),
        'preferred_artist'   => trim(sanitize_text_field($_POST['preferred_artist'] ?? 'Chris')),
        'desired_timeframe'  => sanitize_text_field($_POST['desired_timeframe'] ?? ''),
        'appointment_notes'  => trim(sanitize_textarea_field($_POST['appointment_notes'] ?? '')),
        'total_price'        => floatval($_POST['total_price'] ?? 0),
        'deposit'            => floatval($_POST['deposit'] ?? 0),
        'price_per_session'  => floatval($_POST['price_per_session'] ?? 0),
        'estimated_sessions' => intval($_POST['estimated_sessions'] ?? 0),
        'completed_sessions' => intval($_POST['completed_sessions'] ?? 0),
        'status'             => sanitize_text_field($_POST['status'] ?? 'anfrage'),
    ];
}

function tattookunst_crm_save_project($data, $projects_table) {
    global $wpdb;

    $db_data = [
        'customer_id'        => $data['customer_id'],
        'project_name'       => $data['project_name'],
        'tattoo_wish'        => $data['tattoo_wish'],
        'project_type'       => $data['project_type'],
        'project_type_custom'=> $data['project_type_custom'],
        'project_size'       => $data['project_size'],
        'body_parts'         => implode(', ', $data['body_parts']),
        'body_parts_custom'  => $data['body_parts_custom'],
        'style'              => $data['final_style'],
        'color_type' => $data['color_type'],
        'skin_type' => $data['skin_type'],
        'preferred_artist'   => $data['preferred_artist'],
        'desired_timeframe'  => $data['desired_timeframe'],
        'appointment_notes'  => $data['appointment_notes'],
        'total_price'        => $data['total_price'],
        'deposit'            => $data['deposit'],
        'price_per_session'  => $data['price_per_session'],
        'estimated_sessions' => $data['estimated_sessions'],
        'completed_sessions' => $data['completed_sessions'],
        'status'             => $data['status'],
    ];

    if (!empty($_POST['project_id'])) {
        $project_id = intval($_POST['project_id']);
        $wpdb->update($projects_table, $db_data, ['id' => $project_id]);
        echo '<div class="notice notice-success"><p>Projekt wurde aktualisiert.</p></div>';
        return $project_id;
    }

    $wpdb->insert($projects_table, $db_data);
    echo '<div class="notice notice-success"><p>Projekt wurde gespeichert.</p></div>';

    return intval($wpdb->insert_id);
}