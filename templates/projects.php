<?php

if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

$projects_table = $wpdb->prefix . 'tattookunst_projects';
$customers_table = $wpdb->prefix . 'tattookunst_customers';

$projects = $wpdb->get_results("
    SELECT p.*, c.name AS customer_name
    FROM $projects_table p
    LEFT JOIN $customers_table c ON p.customer_id = c.id
    ORDER BY p.id DESC
");
?>

<div class="wrap">
    <h1>Projekte</h1>

    <a href="?page=tattookunst-crm-neues-projekt" class="button button-primary">
        + Neues Projekt
    </a>

    <br><br>

    <table class="widefat striped">
        <thead>
            <tr>
                <th>Projekt</th>
                <th>Kunde</th>
                <th>Typ</th>
                <th>Größe</th>
                <th>Körperstelle</th>
                <th>Status</th>
                <th>Preis</th>
                <th>Sitzungen</th>
                <th>Aktionen</th>
            </tr>
        </thead>

        <tbody>
        <?php if ($projects): ?>
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?php echo esc_html($project->project_name); ?></td>
                    <td><?php echo esc_html($project->customer_name); ?></td>
                    <td><?php echo esc_html($project->project_type); ?></td>
                    <td><?php echo esc_html($project->project_size); ?></td>
                    <td><?php echo esc_html($project->body_parts); ?></td>
                    <td><?php echo esc_html($project->status); ?></td>
                    <td><?php echo esc_html($project->total_price); ?> €</td>
                    <td><?php echo esc_html($project->completed_sessions); ?> / <?php echo esc_html($project->estimated_sessions); ?></td>
                    <td>
                        <a class="button" href="?page=tattookunst-crm-neues-projekt&edit_project=<?php echo intval($project->id); ?>">
                            Bearbeiten
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">Noch keine Projekte vorhanden.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>