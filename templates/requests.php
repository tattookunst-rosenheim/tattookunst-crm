<?php

if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

$requests_table = $wpdb->prefix . 'tattookunst_requests';

$requests = $wpdb->get_results(
    "SELECT * FROM $requests_table ORDER BY created_at DESC"
);

function tattookunst_crm_request_age($birthday) {
    if (empty($birthday)) {
        return null;
    }

    try {
        $birth_date = new DateTime($birthday);
        $today = new DateTime(current_time('Y-m-d'));

        return $birth_date->diff($today)->y;
    } catch (Exception $e) {
        return null;
    }
}

function tattookunst_crm_request_status_label($status) {
    $labels = [
        'neu'                  => 'Neu',
        'rueckfrage'           => 'Rückfrage läuft',
        'buchungslink'         => 'Buchungslink gesendet',
        'wartet_terminkaution' => 'Wartet auf Terminkaution',
        'projekt_erstellt'     => 'In Projekt übernommen',
        'abgelehnt'            => 'Abgelehnt',
    ];

    return $labels[$status] ?? ucfirst($status);
}
?>

<div class="wrap">

    <h1>Tattoo-Anfragen</h1>

    <?php if (empty($requests)): ?>

        <div class="notice notice-info inline">
            <p>Noch keine Tattoo-Anfragen vorhanden.</p>
        </div>

    <?php else: ?>

        <table class="widefat fixed striped">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Telefon</th>
                    <th>Alter</th>
                    <th>Motiv</th>
                    <th>Eingang</th>
                    <th>Status</th>
                    <th>Aktion</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($requests as $request): ?>

                    <?php
                    $age = tattookunst_crm_request_age($request->birthday);
                    $is_minor = $age !== null && $age < 18;

                    $motif_preview = wp_trim_words(
                        wp_strip_all_tags($request->tattoo_wish),
                        12,
                        ' …'
                    );
                    ?>

                    <tr>

                        <td>
                            <strong>
                                <?php echo esc_html(
                                    trim($request->firstname . ' ' . $request->lastname)
                                ); ?>
                            </strong>

                            <?php if ($is_minor): ?>
                                <br>
                                <span
                                    style="
                                        display:inline-block;
                                        margin-top:5px;
                                        padding:3px 7px;
                                        border-radius:4px;
                                        background:#fff3cd;
                                        color:#664d03;
                                        font-weight:600;
                                    "
                                >
                                    ⚠ Minderjährig
                                </span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php echo esc_html($request->phone); ?>
                        </td>

                        <td>
                            <?php
                            echo $age !== null
                                ? esc_html($age . ' Jahre')
                                : '–';
                            ?>
                        </td>

                        <td>
                            <?php echo esc_html($motif_preview); ?>
                        </td>

                        <td>
                            <?php
                            echo esc_html(
                                mysql2date(
                                    'd.m.Y H:i',
                                    $request->created_at
                                )
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo esc_html(
                                tattookunst_crm_request_status_label($request->status)
                            );
                            ?>
                        </td>

                        <td>
                            <a
                                class="button"
                                href="<?php
                                    echo esc_url(
                                        admin_url(
                                            'admin.php?page=tattookunst-crm-request-edit&request_id='
                                            . intval($request->id)
                                        )
                                    );
                                ?>"
                            >
                                Öffnen
                            </a>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</div>