<?php
// TATTOOKUNST Anfrage-Detail FINAL – nur Header, Motividee und Rückfrage angepasst

if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

$table = $wpdb->prefix . 'tattookunst_requests';

$request_id = isset($_GET['request_id'])
    ? intval($_GET['request_id'])
    : 0;

$allowed_statuses = [
    'neu',
    'rueckfrage',
    'buchungslink',
    'wartet_terminkaution',
    'abgelehnt',
];

if (
    isset($_POST['request_status']) &&
    isset($_POST['request_status_nonce']) &&
    wp_verify_nonce(
        sanitize_text_field(
            wp_unslash($_POST['request_status_nonce'])
        ),
        'save_request_status_' . $request_id
    )
) {
    $new_status = sanitize_text_field(
        wp_unslash($_POST['request_status'])
    );

    if (in_array($new_status, $allowed_statuses, true)) {
        $wpdb->update(
            $table,
            [
                'status'     => $new_status,
                'updated_at' => current_time('mysql'),
            ],
            [
                'id' => $request_id,
            ],
            [
                '%s',
                '%s',
            ],
            [
                '%d',
            ]
        );
    }
}

$request = $wpdb->get_row(
    $wpdb->prepare(
        "SELECT * FROM $table WHERE id = %d",
        $request_id
    )
);

if (!$request) {
    echo '<div class="notice notice-error"><p>Anfrage nicht gefunden.</p></div>';
    return;
}

$age = null;

if (!empty($request->birthday)) {
    try {
        $birth_date = new DateTime($request->birthday);
        $today = new DateTime(current_time('Y-m-d'));
        $age = $birth_date->diff($today)->y;
    } catch (Exception $e) {
        $age = null;
    }
}

$is_minor = $age !== null && $age < 18;

$project_type_labels = [
    'neues_tattoo'          => 'Neues Tattoo',
    'erweiterung'           => 'Erweiterung',
    'cover_up'              => 'Cover-up',
    'narben'                => 'Über Narben',
    'tattoo_fertigstellung' => 'Tattoo-Fertigstellung',
    'eigene'                => 'Andere Projektart',
];

$project_size_labels = [
    'klein'  => 'Klein',
    'mittel' => 'Mittel',
    'gross'  => 'Groß',
];

$style_labels = [
    'fineline'                  => 'Fine Line',
    'minimalistisch_patchwork'  => 'Minimalistisch / Patchwork',
    'dotwork_geometric_mandala' => 'Dotwork / Geometrisch / Mandala',
    'blackwork'                 => 'Blackwork',
    'black_grey_realismus'      => 'Black & Grey Realismus',
    'color_realismus'           => 'Color Realismus',
    'traditional'               => 'Traditional',
    'neo_traditional'           => 'Neo Traditional',
    'japanisch'                 => 'Japanisch',
    'maori_polynesisch'         => 'Maori / Polynesisch',
    'watercolor'                => 'Watercolor',
    'lettering'                 => 'Lettering',
    'ornamentik'                => 'Ornamentik',
    'chicano'                   => 'Chicano',
    'tribal'                    => 'Tribal',
    'sketch'                    => 'Sketch',
    'anime'                     => 'Anime',
    'bio_organic'               => 'Bio Organic',
    'eigener_stil'              => 'Anderer Stil',
];

$color_labels = [
    'black_grey'  => 'Black & Grey',
    'color'       => 'Color',
    'blackwork'   => 'Blackwork',
    'kombination' => 'Kombination',
];

$timeframe_labels = [
    'so_schnell_wie_moeglich' => 'So schnell wie möglich',
    'innerhalb_1_monat'        => 'Innerhalb eines Monats',
    'innerhalb_2_monaten'      => 'Innerhalb von zwei Monaten',
    'innerhalb_3_monaten'      => 'Innerhalb von drei Monaten',
    'dieses_jahr'              => 'Noch in diesem Jahr',
    'flexibel'                 => 'Zeitlich flexibel',
];

$body_part_labels = [
    'kopf'          => 'Kopf',
    'hals'          => 'Hals',
    'brust'         => 'Brust',
    'bauch'         => 'Bauch',
    'ruecken'       => 'Rücken',
    'schulter'      => 'Schulter',
    'oberarm'       => 'Oberarm',
    'unterarm'      => 'Unterarm',
    'hand'          => 'Hand',
    'finger'        => 'Finger',
    'huefte'        => 'Hüfte',
    'gesaess'       => 'Gesäß',
    'oberschenkel'  => 'Oberschenkel',
    'unterschenkel' => 'Unterschenkel',
    'knie'          => 'Knie',
    'fuss'          => 'Fuß',
    'andere'        => 'Andere Körperstelle',
];

$status_labels = [
    'neu'                  => 'Neu',
    'rueckfrage'           => 'Rückfrage läuft',
    'buchungslink'         => 'Buchungsentwurf',
    'wartet_terminkaution' => 'Wartet auf Terminkaution',
    'abgelehnt'            => 'Abgelehnt',
];

$status_classes = [
    'neu'                  => 'tk-status-neu',
    'rueckfrage'           => 'tk-status-rueckfrage',
    'buchungslink'         => 'tk-status-buchungslink',
    'wartet_terminkaution' => 'tk-status-kaution',
    'abgelehnt'            => 'tk-status-abgelehnt',
];

$body_parts = [];

if (!empty($request->body_parts)) {
    foreach (explode(',', $request->body_parts) as $body_part) {
        $body_part = trim($body_part);

        if ($body_part !== '') {
            $body_part_label = $body_part_labels[$body_part]
                ?? str_replace('_', ' ', $body_part);

            $body_parts[] = ucfirst($body_part_label);
        }
    }
}

$project_type = $project_type_labels[$request->project_type]
    ?? $request->project_type;

if (
    $request->project_type === 'eigene' &&
    !empty($request->project_type_custom)
) {
    $project_type = $request->project_type_custom;
}

$project_size = $project_size_labels[$request->project_size]
    ?? $request->project_size;

$style = $style_labels[$request->style]
    ?? ucfirst(str_replace('_', ' ', $request->style));

$color_type = $color_labels[$request->color_type]
    ?? $request->color_type;

$desired_timeframe = $timeframe_labels[$request->desired_timeframe]
    ?? $request->desired_timeframe;

$current_status_label = $status_labels[$request->status]
    ?? $request->status;

$current_status_class = $status_classes[$request->status]
    ?? 'tk-status-neu';

$logo_url = plugin_dir_url(__FILE__) . 'tattookunst-logo.png';
?>

<style>
    .tk-request-wrap {
        max-width: 1200px;
        color: #171717;
    }

    .tk-request-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin: 20px 0;
        padding: 18px 20px;
        border: 1px solid #dcdcda;
        border-radius: 12px;
        background: #fff;
    }

    .tk-request-header h1 {
        margin: 0;
        color: #171717;
        font-size: 32px;
        line-height: 1.2;
        font-weight: 700;
    }


    .tk-status {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 999px;
        font-weight: 700;
        font-size: 13px;
    }

    .tk-status-neu { background: #e8eef7; color: #234d78; }
    .tk-status-rueckfrage { background: #f5eed8; color: #735d15; }
    .tk-status-buchungslink { background: #e5f0f2; color: #245b63; }
    .tk-status-kaution { background: #f6e8dc; color: #754719; }
    .tk-status-abgelehnt { background: #f4dddd; color: #862f2f; }

    .tk-minor-warning {
        margin: 0 0 20px;
        padding: 12px 16px;
        border-left: 4px solid #252525;
        background: #f1f1ef;
        color: #242424;
        font-weight: 700;
        border-radius: 5px;
    }

    .tk-request-grid {
        display: grid;
        grid-template-columns: minmax(320px, 1fr) minmax(0, 1.5fr);
        gap: 20px;
        align-items: start;
    }

    .tk-card {
        min-width: 0;
        margin-bottom: 20px;
        padding: 22px;
        border: 1px solid #dcdcda;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 8px 26px rgba(0,0,0,.04);
    }

    .tk-card h2 {
        margin: 0 0 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e5e5e2;
        color: #171717;
    }

    .tk-data-row {
        display: grid;
        grid-template-columns: minmax(150px, 170px) minmax(0, 1fr);
        gap: 18px;
        padding: 11px 0;
        border-bottom: 1px solid #efefec;
    }

    .tk-data-row:last-child {
        border-bottom: 0;
    }

    .tk-data-label {
        color: #303030;
        font-weight: 750;
    }

    .tk-data-value {
        min-width: 0;
        color: #252525;
        overflow-wrap: anywhere;
    }

    .tk-motif-section {
        width: 100%;
        margin: 0 0 24px;
        padding: 0;
        border: 0;
        border-radius: 0;
        background: transparent;
    }

    .tk-motif-section h3 {
        margin: 0 0 10px;
        padding: 0;
        border: 0;
        color: #171717;
        font-size: 19px;
    }

    .tk-motif-section-text {
        color: #252525;
        font-size: 16px;
        line-height: 1.6;
        text-align: left;
        white-space: normal;
        overflow-wrap: anywhere;
    }


    .tk-reference-images {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .tk-reference-images img {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border-radius: 8px;
    }

    .tk-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .tk-action-form {
        display: inline-block;
        margin: 0;
    }

    .tk-action-button {
        min-height: 42px !important;
        padding: 0 16px !important;
        font-weight: 700 !important;
    }

    .tk-button-question {
        background: #dba617 !important;
        border-color: #b98c13 !important;
        color: #1d2327 !important;
    }

    .tk-button-booking {
        background: #171717 !important;
        border-color: #171717 !important;
        color: #fff !important;
    }

    .tk-button-reject {
        background: #a73535 !important;
        border-color: #a73535 !important;
        color: #fff !important;
    }

    @media (max-width: 900px) {
        .tk-request-grid {
            grid-template-columns: 1fr;
        }

        .tk-data-row {
            grid-template-columns: 1fr;
            gap: 4px;
        }

        .tk-request-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

<div class="wrap tk-request-wrap">

    <div class="tk-request-header">
        <h1>
            <?php
            echo esc_html(
                trim($request->firstname . ' ' . $request->lastname)
            );
            ?>
        </h1>

        <span class="tk-status <?php echo esc_attr($current_status_class); ?>">
            <?php echo esc_html($current_status_label); ?>
        </span>
    </div>

    <?php if ($is_minor): ?>
        <div class="tk-minor-warning">
            ⚠ Minderjährig – <?php echo esc_html($age); ?> Jahre
        </div>
    <?php endif; ?>

    <div class="tk-request-grid">

        <div>

            <div class="tk-card">
                <h2>Kundendaten</h2>

                <div class="tk-data-row">
                    <div class="tk-data-label">Vorname</div>
                    <div class="tk-data-value">
                        <?php echo esc_html($request->firstname); ?>
                    </div>
                </div>

                <div class="tk-data-row">
                    <div class="tk-data-label">Nachname</div>
                    <div class="tk-data-value">
                        <?php echo esc_html($request->lastname); ?>
                    </div>
                </div>

                <div class="tk-data-row">
                    <div class="tk-data-label">Telefon</div>
                    <div class="tk-data-value">
                        <a href="tel:<?php echo esc_attr($request->phone); ?>">
                            <?php echo esc_html($request->phone); ?>
                        </a>
                    </div>
                </div>

                <div class="tk-data-row">
                    <div class="tk-data-label">E-Mail</div>
                    <div class="tk-data-value">
                        <a href="mailto:<?php echo esc_attr($request->email); ?>">
                            <?php echo esc_html($request->email); ?>
                        </a>
                    </div>
                </div>

                <div class="tk-data-row">
                    <div class="tk-data-label">Bevorzugter Kontaktweg</div>
                    <div class="tk-data-value">
                        <?php
                        $contact_method = $request->contact_method ?? '';

                        if ($contact_method === 'whatsapp') {
                            echo '<a href="https://wa.me/' .
                                esc_attr(
                                    preg_replace('/\D+/', '', $request->phone)
                                ) .
                                '" target="_blank" rel="noopener">' .
                                'WhatsApp öffnen</a>';
                        } elseif ($contact_method === 'telegram') {
                            $telegram_username =
                                $request->telegram_username ?? '';

                            if (!empty($telegram_username)) {
                                $telegram_username =
                                    ltrim($telegram_username, '@');

                                echo '<a href="https://t.me/' .
                                    esc_attr($telegram_username) .
                                    '" target="_blank" rel="noopener">@' .
                                    esc_html($telegram_username) .
                                    '</a>';
                            } else {
                                echo '–';
                            }
                        } elseif ($contact_method === 'email') {
                            echo '<a href="mailto:' .
                                esc_attr($request->email) .
                                '">' .
                                esc_html($request->email) .
                                '</a>';
                        } else {
                            echo '–';
                        }
                        ?>
                    </div>
                </div>

                <div class="tk-data-row">
                    <div class="tk-data-label">Geburtsdatum</div>
                    <div class="tk-data-value">
                        <?php if (!empty($request->birthday)): ?>
                            <?php
                            echo esc_html(
                                mysql2date('d.m.Y', $request->birthday)
                            );
                            ?>
                            <?php if ($age !== null): ?>
                                · <?php echo esc_html($age); ?> Jahre
                            <?php endif; ?>
                        <?php else: ?>
                            –
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="tk-card">
                <h2>Interne Bearbeitung</h2>

                <div class="tk-actions">

                    <form method="post" class="tk-action-form">
                        <?php
                        wp_nonce_field(
                            'save_request_status_' . $request_id,
                            'request_status_nonce'
                        );
                        ?>

                        <input
                            type="hidden"
                            name="request_status"
                            value="rueckfrage"
                        >

                        <button
                            type="submit"
                            class="button tk-action-button tk-button-question"
                        >
                            Rückfrage
                        </button>
                    </form>

                    <form method="post" class="tk-action-form">
                        <?php
                        wp_nonce_field(
                            'save_request_status_' . $request_id,
                            'request_status_nonce'
                        );
                        ?>

                        <input
                            type="hidden"
                            name="request_status"
                            value="buchungslink"
                        >

                        <button
                            type="submit"
                            class="button tk-action-button tk-button-booking"
                        >
                            Buchungsentwurf erstellen
                        </button>
                    </form>

                    <form method="post" class="tk-action-form">
                        <?php
                        wp_nonce_field(
                            'save_request_status_' . $request_id,
                            'request_status_nonce'
                        );
                        ?>

                        <input
                            type="hidden"
                            name="request_status"
                            value="abgelehnt"
                        >

                        <button
                            type="submit"
                            class="button tk-action-button tk-button-reject"
                        >
                            Anfrage ablehnen
                        </button>
                    </form>

                </div>
            </div>

        </div>

        <div class="tk-card">
            <h2>Tattoo-Anfrage</h2>

            <section class="tk-motif-section">
                <h3>Motividee</h3>
                <div class="tk-motif-section-text"><?php
                    echo nl2br(esc_html($request->tattoo_wish));
                ?></div>
            </section>

            <div class="tk-data-row">
                <div class="tk-data-label">Referenzbilder</div>

                <div class="tk-data-value">
                    <?php
                    $reference_image_ids = [];

                    if (!empty($request->reference_images)) {
                        $decoded_images = json_decode(
                            $request->reference_images,
                            true
                        );

                        if (is_array($decoded_images)) {
                            $reference_image_ids = array_map(
                                'intval',
                                $decoded_images
                            );
                        }
                    }

                    if (!empty($reference_image_ids)) {
                        echo '<div class="tk-reference-images">';

                        foreach ($reference_image_ids as $attachment_id) {
                            $image_url = wp_get_attachment_url($attachment_id);

                            if (!$image_url) {
                                continue;
                            }

                            echo '<a href="' . esc_url($image_url) .
                                '" target="_blank" rel="noopener">';

                            echo wp_get_attachment_image(
                                $attachment_id,
                                'medium'
                            );

                            echo '</a>';
                        }

                        echo '</div>';
                    } else {
                        echo 'Noch keine Referenzbilder gespeichert.';
                    }
                    ?>
                </div>
            </div>

            <div class="tk-data-row">
                <div class="tk-data-label">Projektart</div>
                <div class="tk-data-value">
                    <?php echo esc_html($project_type); ?>
                </div>
            </div>

            <div class="tk-data-row">
                <div class="tk-data-label">Projektgröße</div>
                <div class="tk-data-value">
                    <?php echo esc_html($project_size); ?>
                </div>
            </div>

            <div class="tk-data-row">
                <div class="tk-data-label">Stil</div>
                <div class="tk-data-value">
                    <?php echo esc_html($style); ?>
                </div>
            </div>

            <div class="tk-data-row">
                <div class="tk-data-label">Farbart</div>
                <div class="tk-data-value">
                    <?php echo esc_html($color_type); ?>
                </div>
            </div>

            <div class="tk-data-row">
                <div class="tk-data-label">Körperstelle</div>
                <div class="tk-data-value">
                    <?php
                    echo !empty($body_parts)
                        ? esc_html(implode(', ', $body_parts))
                        : '–';
                    ?>

                    <?php if (!empty($request->body_parts_custom)): ?>
                        <br>
                        <?php echo esc_html($request->body_parts_custom); ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="tk-data-row">
                <div class="tk-data-label">Wunschzeitraum</div>
                <div class="tk-data-value">
                    <?php echo esc_html($desired_timeframe); ?>
                </div>
            </div>

            <div class="tk-data-row">
                <div class="tk-data-label">Zeitraum / Wunschtermin</div>
                <div class="tk-data-value">
                    <?php
                    echo !empty($request->desired_timeframe_note)
                        ? esc_html($request->desired_timeframe_note)
                        : '–';
                    ?>
                </div>
            </div>

            <div class="tk-data-row">
                <div class="tk-data-label">Bemerkungen</div>
                <div class="tk-data-value tk-motif">
                    <?php
                    echo !empty($request->customer_notes)
                        ? nl2br(esc_html($request->customer_notes))
                        : '–';
                    ?>
                </div>
            </div>
        </div>

    </div>

    <p>
        <a
            href="?page=tattookunst-crm-requests"
            class="button"
        >
            Zurück zu Tattoo-Anfragen
        </a>
    </p>

</div>
