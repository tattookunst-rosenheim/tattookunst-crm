<?php
global $wpdb;

$table_name = $wpdb->prefix . 'tattookunst_customers';

if (isset($_GET['delete_customer'])) {
    $wpdb->delete($table_name, ['id' => intval($_GET['delete_customer'])]);
    echo '<div class="notice notice-success"><p>Kunde wurde gelöscht.</p></div>';
}

$customers = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");
?>

<div class="wrap">
    <h1>Kundenverwaltung</h1>

    <a href="?page=tattookunst-crm-neuer-kunde" class="button button-primary">
        + Neuer Kunde
    </a>

    <br><br>

    <table class="widefat striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Handynummer</th>
                <th>E-Mail</th>
                <th>WhatsApp</th>
                <th>Telegram</th>
                <th>Herkunft</th>
                <th>Geburtsdatum</th>
                <th>Aktionen</th>
            </tr>
        </thead>

        <tbody>
        <?php if ($customers): ?>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo esc_html($customer->name); ?></td>
                    <td><?php echo esc_html($customer->phone); ?></td>
                    <td><?php echo esc_html($customer->email); ?></td>
                    <td><?php echo !empty($customer->whatsapp) ? 'Ja' : 'Nein'; ?></td>
                    <td><?php echo !empty($customer->telegram) ? 'Ja' : 'Nein'; ?></td>
                    <td><?php echo esc_html($customer->customer_source); ?></td>
                    <td><?php echo esc_html($customer->birthday); ?></td>
                    <td>
                        <a class="button" href="?page=tattookunst-crm-neuer-kunde&edit_customer=<?php echo intval($customer->id); ?>">
                            Bearbeiten
                        </a>

                        <a class="button"
                           href="?page=tattookunst-crm-kunden&delete_customer=<?php echo intval($customer->id); ?>"
                           onclick="return confirm('Kunden wirklich löschen?');">
                            Löschen
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Noch keine Kunden vorhanden.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>