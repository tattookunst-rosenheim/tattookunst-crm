<?php

if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

$projects_table  = $wpdb->prefix . 'tattookunst_projects';
$customers_table = $wpdb->prefix . 'tattookunst_customers';
$images_table    = $wpdb->prefix . 'tattookunst_project_images';

require_once __DIR__ . '/project/project-load.php';
require_once __DIR__ . '/project/project-validation.php';
require_once __DIR__ . '/project/project-save.php';
require_once __DIR__ . '/project/project-images-save.php';

require_once __DIR__ . '/project/project-style.php';
require_once __DIR__ . '/project/project-images.php';
require_once __DIR__ . '/project/project-bodyparts.php';
require_once __DIR__ . '/project/project-appointments.php';
require_once __DIR__ . '/project/project-pricing.php';
require_once __DIR__ . '/project/project-status.php';

$project = tattookunst_crm_load_project($projects_table);
$editing = $project ? true : false;
$errors = [];

if (isset($_POST['save_project'])) {
    $data = tattookunst_crm_prepare_project_data();
    $errors = tattookunst_crm_validate_project($data);

    if (empty($errors)) {
        $project_id = tattookunst_crm_save_project($data, $projects_table);
        tattookunst_crm_save_project_images($project_id, $images_table);

        $project = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM $projects_table WHERE id = %d", $project_id)
        );

        $editing = true;
    }
}

$customers = $wpdb->get_results("SELECT id, name FROM $customers_table ORDER BY name ASC");

$selected_body_parts = [];
if ($project && !empty($project->body_parts)) {
    $selected_body_parts = array_map('trim', explode(',', $project->body_parts));
}

?>

<div class="wrap">
    <h1><?php echo $editing ? '✏️ Projekt bearbeiten' : '➕ Neues Projekt'; ?></h1>

    <?php if (!empty($errors)): ?>
        <div class="notice notice-error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo esc_html($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="" enctype="multipart/form-data">

        <?php if ($editing && $project): ?>
            <input type="hidden" name="project_id" value="<?php echo intval($project->id); ?>">
        <?php endif; ?>

        <h2>Projekt</h2>

        <table class="form-table">

            <tr>
    <th>Kunde *</th>
    <td>
        <?php
        $current_customer_id = $_POST['customer_id']
            ?? ($project->customer_id ?? ($_GET['customer_id'] ?? ''));
        ?>

        <select name="customer_id" required>
            <option value="">Bitte auswählen</option>

            <?php foreach ($customers as $customer): ?>
                <option
                    value="<?php echo intval($customer->id); ?>"
                    <?php selected($current_customer_id, $customer->id); ?>
                >
                    <?php echo esc_html($customer->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </td>
</tr>

            <tr>
                <th>Interner Projektname</th>
                <td>
                    <input type="text"
                           name="project_name"
                           class="regular-text"
                           value="<?php echo esc_attr($_POST['project_name'] ?? ($project->project_name ?? '')); ?>">
                </td>
            </tr>

            <tr>
                <th>Motividee / Tattoo-Wunsch *</th>
                <td>
                    <textarea name="tattoo_wish" rows="6" cols="70" required><?php echo esc_textarea($_POST['tattoo_wish'] ?? ($project->tattoo_wish ?? '')); ?></textarea>
                </td>
            </tr>

            <?php tattookunst_crm_render_project_images($project->id ?? 0); ?>

            <tr>
                <th>Projektart *</th>
                <td>
                    <?php $type = $_POST['project_type'] ?? ($project->project_type ?? ''); ?>

                    <select name="project_type" required>
                        <option value="">Bitte auswählen</option>
                        <option value="neues_tattoo" <?php selected($type, 'neues_tattoo'); ?>>Neues Tattoo</option>
                        <option value="erweiterung" <?php selected($type, 'erweiterung'); ?>>Erweiterung</option>
                        <option value="cover_up" <?php selected($type, 'cover_up'); ?>>Cover-up</option>
                        <option value="narben" <?php selected($type, 'narben'); ?>>Über Narben</option>
                        <option value="tattoo_fertigstellung" <?php selected($type, 'tattoo_fertigstellung'); ?>>Tattoo-Fertigstellung</option>
                        <option value="eigene" <?php selected($type, 'eigene'); ?>>Eigene Projektart</option>
                    </select>

                    <p>
                        <input type="text"
                               name="project_type_custom"
                               class="regular-text"
                               placeholder="Eigene Projektart"
                               value="<?php echo esc_attr($_POST['project_type_custom'] ?? ($project->project_type_custom ?? '')); ?>">
                    </p>
                </td>
            </tr>

            <tr>
                <th>Projektgröße *</th>
                <td>
                    <?php $size = $_POST['project_size'] ?? ($project->project_size ?? ''); ?>

                    <select name="project_size" required>
                        <option value="">Bitte auswählen</option>
                        <option value="klein" <?php selected($size, 'klein'); ?>>Klein</option>
                        <option value="mittel" <?php selected($size, 'mittel'); ?>>Mittel</option>
                        <option value="gross" <?php selected($size, 'gross'); ?>>Groß</option>
                        <option value="arm_sleeve_links" <?php selected($size, 'arm_sleeve_links'); ?>>Arm Sleeve links</option>
                        <option value="arm_sleeve_rechts" <?php selected($size, 'arm_sleeve_rechts'); ?>>Arm Sleeve rechts</option>
                        <option value="leg_sleeve_links" <?php selected($size, 'leg_sleeve_links'); ?>>Leg Sleeve links</option>
                        <option value="leg_sleeve_rechts" <?php selected($size, 'leg_sleeve_rechts'); ?>>Leg Sleeve rechts</option>
                        <option value="chestpiece" <?php selected($size, 'chestpiece'); ?>>Chestpiece</option>
                        <option value="backpiece" <?php selected($size, 'backpiece'); ?>>Backpiece</option>
                        <option value="frontpiece" <?php selected($size, 'frontpiece'); ?>>Frontpiece</option>
                        <option value="bodysuit" <?php selected($size, 'bodysuit'); ?>>Bodysuit</option>
                    </select>
                </td>
            </tr>

            <?php
tattookunst_crm_render_project_style(
    $_POST['style'] ?? ($project->style ?? ''),
    $_POST['color_type'] ?? ($project->color_type ?? ''),
    $_POST['skin_type'] ?? ($project->skin_type ?? '')
);
?>

        </table>

        <?php
        tattookunst_crm_render_project_bodyparts(
            $_POST['body_parts'] ?? $selected_body_parts,
            $_POST['body_parts_custom'] ?? ($project->body_parts_custom ?? '')
        );

        tattookunst_crm_render_project_appointments(
            $_POST['preferred_artist'] ?? ($project->preferred_artist ?? 'Chris'),
            $_POST['desired_timeframe'] ?? ($project->desired_timeframe ?? ''),
            $_POST['appointment_notes'] ?? ($project->appointment_notes ?? '')
        );

        tattookunst_crm_render_project_pricing(
            $_POST['total_price'] ?? ($project->total_price ?? ''),
            $_POST['deposit'] ?? ($project->deposit ?? ''),
            $_POST['price_per_session'] ?? ($project->price_per_session ?? ''),
            $_POST['estimated_sessions'] ?? ($project->estimated_sessions ?? ''),
            $_POST['completed_sessions'] ?? ($project->completed_sessions ?? '')
        );

        tattookunst_crm_render_project_status(
            $_POST['status'] ?? ($project->status ?? 'anfrage')
        );
        ?>

        <p>
            <button type="submit" name="save_project" class="button button-primary">
                <?php echo $editing ? 'Projekt aktualisieren' : 'Projekt speichern'; ?>
            </button>

            <a href="?page=tattookunst-crm-projekte" class="button">
                Zurück zur Projektliste
            </a>
        </p>

    </form>
</div>