<?php

if (!defined('ABSPATH')) {
    exit;
}

function tattookunst_crm_save_project_images($project_id, $images_table) {
    global $wpdb;

    if (empty($_FILES['reference_images']['name'][0])) {
        return;
    }

    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $existing_count = intval($wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $images_table WHERE project_id = %d",
        $project_id
    )));

    $allowed_types = ['image/jpeg', 'image/png', 'image/webp', 'image/heic', 'image/heif'];
    $max_file_size = 10 * 1024 * 1024;
    $uploaded_count = 0;

    foreach ($_FILES['reference_images']['name'] as $key => $filename) {
        if (empty($filename)) {
            continue;
        }

        if (($existing_count + $uploaded_count) >= 20) {
            echo '<div class="notice notice-error"><p>Maximal 20 Referenzbilder pro Projekt.</p></div>';
            break;
        }

        if (!in_array($_FILES['reference_images']['type'][$key], $allowed_types, true)) {
            echo '<div class="notice notice-error"><p>Bild "' . esc_html($filename) . '" hat ein nicht erlaubtes Format.</p></div>';
            continue;
        }

        if ($_FILES['reference_images']['size'][$key] > $max_file_size) {
            echo '<div class="notice notice-error"><p>Bild "' . esc_html($filename) . '" ist größer als 10 MB.</p></div>';
            continue;
        }

        $_FILES['single_reference_image'] = [
            'name' => $_FILES['reference_images']['name'][$key],
            'type' => $_FILES['reference_images']['type'][$key],
            'tmp_name' => $_FILES['reference_images']['tmp_name'][$key],
            'error' => $_FILES['reference_images']['error'][$key],
            'size' => $_FILES['reference_images']['size'][$key],
        ];

        $attachment_id = media_handle_upload('single_reference_image', 0);

        if (!is_wp_error($attachment_id)) {
            $wpdb->insert($images_table, [
                'project_id' => $project_id,
                'image_id'   => $attachment_id,
                'category'   => 'referenzbild',
            ]);

            $uploaded_count++;
        }
    }

    if ($uploaded_count > 0) {
        echo '<div class="notice notice-success"><p>' . intval($uploaded_count) . ' Bild(er) wurden hochgeladen.</p></div>';
    }
}