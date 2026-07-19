<?php

if (!defined('ABSPATH')) {
    exit;
}

class TattooRequest {

    public static function init() {
        add_shortcode(
            'tattoo_request_form',
            [__CLASS__, 'render_form']
        );

        add_action(
            'init',
            [__CLASS__, 'handle_form']
        );
    }

    public static function render_form() {
        $request_errors = [];
        $request_success = (
            isset($_GET['tattoo_request']) &&
            $_GET['tattoo_request'] === 'success'
        );

        ob_start();

        $template = plugin_dir_path(__FILE__)
            . '../templates/tattoo-request-form.php';

        if (file_exists($template)) {
            include $template;
        } else {
            error_log('Template project-form.php nicht gefunden.');
        }

        return ob_get_clean();
    }

    public static function handle_form() {

        if (
            empty($_POST['tattookunst_request_action']) ||
            $_POST['tattookunst_request_action'] !== 'save_tattoo_request'
        ) {
            return;
        }

        if (
            empty($_POST['tattookunst_request_nonce']) ||
            !wp_verify_nonce(
                sanitize_text_field(
                    wp_unslash($_POST['tattookunst_request_nonce'])
                ),
                'tattookunst_save_tattoo_request'
            )
        ) {
            wp_die('Sicherheitsprüfung fehlgeschlagen.');
        }

        global $wpdb;

        $table = $wpdb->prefix . 'tattookunst_requests';

        $body_parts = [];

        if (
            isset($_POST['request_body_parts']) &&
            is_array($_POST['request_body_parts'])
        ) {
            $body_parts = array_map(
                'sanitize_text_field',
                wp_unslash($_POST['request_body_parts'])
            );
        }

        $birthday = sanitize_text_field(
    wp_unslash($_POST['request_birthday'] ?? '')
);

if (preg_match('/^(\d{2})\.(\d{2})\.(\d{4})$/', $birthday, $matches)) {
    $birthday = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
}

        $result = $wpdb->insert(
            $table,
            [
                'firstname' => sanitize_text_field(
                    wp_unslash($_POST['request_firstname'] ?? '')
                ),
                'lastname' => sanitize_text_field(
                    wp_unslash($_POST['request_lastname'] ?? '')
                ),
               'phone' => sanitize_text_field(
    wp_unslash($_POST['request_phone'] ?? '')
),
'contact_method' => sanitize_text_field(
    wp_unslash($_POST['request_contact_method'] ?? '')
),
'telegram_username' => sanitize_text_field(
    wp_unslash($_POST['request_telegram_username'] ?? '')
                ),
                'email' => sanitize_email(
                    wp_unslash($_POST['request_email'] ?? '')
                ),
                'birthday' => $birthday,
                'gender' => sanitize_text_field(
                    wp_unslash($_POST['request_gender'] ?? '')
                ),
                'tattoo_wish' => sanitize_textarea_field(
                    wp_unslash($_POST['request_tattoo_wish'] ?? '')
                ),
                'project_type' => sanitize_text_field(
                    wp_unslash($_POST['request_project_type'] ?? '')
                ),
                'project_type_custom' => sanitize_text_field(
                    wp_unslash($_POST['request_project_type_custom'] ?? '')
                ),
                'project_size' => sanitize_text_field(
                    wp_unslash($_POST['request_project_size'] ?? '')
                ),
                'style' => sanitize_text_field(
                    wp_unslash($_POST['request_style'] ?? '')
                ),
                'color_type' => sanitize_text_field(
                    wp_unslash($_POST['request_color_type'] ?? '')
                ),
                'body_parts' => implode(',', $body_parts),
                'body_parts_custom' => sanitize_text_field(
                    wp_unslash($_POST['request_body_parts_custom'] ?? '')
                ),
                'desired_timeframe' => sanitize_text_field(
    wp_unslash($_POST['request_desired_timeframe'] ?? '')
),
'desired_timeframe_note' => sanitize_text_field(
    wp_unslash($_POST['request_desired_timeframe_note'] ?? '')
),
'customer_source' => sanitize_text_field(
    wp_unslash($_POST['request_customer_source'] ?? '')
),
'customer_notes' => sanitize_textarea_field(
    wp_unslash($_POST['request_customer_notes'] ?? '')
),
'status' => 'neu',
'created_at' => current_time('mysql'),
'updated_at' => current_time('mysql'),
]
        );

        if ($result === false) {
            wp_die(
                'Die Anfrage konnte nicht gespeichert werden: '
                . esc_html($wpdb->last_error)
            );
        }
$request_id = (int) $wpdb->insert_id;

$reference_image_ids = [];

if (
    isset($_FILES['request_images']) &&
    !empty($_FILES['request_images']['name']) &&
    is_array($_FILES['request_images']['name'])
) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $image_count = min(
        count($_FILES['request_images']['name']),
        20
    );

    for ($i = 0; $i < $image_count; $i++) {
        if (
            empty($_FILES['request_images']['name'][$i]) ||
            (int) $_FILES['request_images']['error'][$i] !== UPLOAD_ERR_OK
        ) {
            continue;
        }

        if ((int) $_FILES['request_images']['size'][$i] > 10 * 1024 * 1024) {
            continue;
        }

        $_FILES['tattoo_request_single_image'] = [
            'name'     => $_FILES['request_images']['name'][$i],
            'type'     => $_FILES['request_images']['type'][$i],
            'tmp_name' => $_FILES['request_images']['tmp_name'][$i],
            'error'    => $_FILES['request_images']['error'][$i],
            'size'     => $_FILES['request_images']['size'][$i],
        ];

        $attachment_id = media_handle_upload(
            'tattoo_request_single_image',
            0
        );

        if (!is_wp_error($attachment_id)) {
            $reference_image_ids[] = (int) $attachment_id;
        }
    }

    unset($_FILES['tattoo_request_single_image']);
}

if (!empty($reference_image_ids)) {
    $wpdb->update(
        $table,
        [
            'reference_images' => wp_json_encode($reference_image_ids),
        ],
        [
            'id' => $request_id,
        ],
        [
            '%s',
        ],
        [
            '%d',
        ]
    );
}

$customer_email = sanitize_email(
    wp_unslash($_POST['request_email'] ?? '')
);

$customer_name = trim(
    sanitize_text_field(
        wp_unslash($_POST['request_firstname'] ?? '')
    ) . ' ' .
    sanitize_text_field(
        wp_unslash($_POST['request_lastname'] ?? '')
    )
);

$image_count = count($reference_image_ids);

$email_subject = 'Deine Tattoo-Anfrage ist eingegangen';

$email_message =
    "Hallo " . $customer_name . ",\n\n" .
    "vielen Dank für deine Tattoo-Anfrage.\n" .
    "Wir melden uns innerhalb der nächsten 1–2 Tage bei dir.\n\n" .

    "Deine Angaben:\n\n" .

    "Projektart: " .
    sanitize_text_field(
        wp_unslash($_POST['request_project_type'] ?? '')
    ) . "\n" .

    "Projektgröße: " .
    sanitize_text_field(
        wp_unslash($_POST['request_project_size'] ?? '')
    ) . "\n" .

    "Stil: " .
    sanitize_text_field(
        wp_unslash($_POST['request_style'] ?? '')
    ) . "\n" .

    "Farbart: " .
    sanitize_text_field(
        wp_unslash($_POST['request_color_type'] ?? '')
    ) . "\n" .

    "Körperstellen: " .
    implode(', ', $body_parts) . "\n" .

    "Gewünschter Zeitraum: " .
    sanitize_text_field(
        wp_unslash($_POST['request_desired_timeframe'] ?? '')
    ) . "\n" .

    "Zeitraum / Wunschtermin: " .
    sanitize_text_field(
        wp_unslash($_POST['request_desired_timeframe_note'] ?? '')
    ) . "\n\n" .

    "Motividee / Tattoo-Wunsch:\n" .
    sanitize_textarea_field(
        wp_unslash($_POST['request_tattoo_wish'] ?? '')
    ) . "\n\n" .

    "Bemerkungen:\n" .
    sanitize_textarea_field(
        wp_unslash($_POST['request_customer_notes'] ?? '')
    ) . "\n\n" .

    "Referenzbilder erhalten: " . $image_count . "\n\n" .

    "Viele Grüße\n" .
    "Tattookunst Rosenheim";

if (is_email($customer_email)) {
    wp_mail(
        $customer_email,
        $email_subject,
        $email_message
    );
}

        $redirect_url = add_query_arg(
            'tattoo_request',
            'success',
            wp_get_referer()
        );

        wp_safe_redirect($redirect_url);
        exit;
    }
}