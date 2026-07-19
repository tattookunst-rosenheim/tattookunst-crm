<?php

if (!defined('ABSPATH')) {
    exit;
}

function tattookunst_crm_render_project_pricing(
    $total_price = '',
    $deposit = '',
    $price_per_session = '',
    $estimated_sessions = '',
    $completed_sessions = ''
) {
?>

<h2>Kosten & Sitzungen</h2>

<table class="form-table">

<tr>
    <th>Gesamtpreis (€)</th>
    <td>
        <input type="number"
               step="0.01"
               min="0"
               name="total_price"
               class="regular-text"
               value="<?php echo esc_attr($total_price); ?>">
    </td>
</tr>

<tr>
    <th>Anzahlung (€)</th>
    <td>
        <input type="number"
               step="0.01"
               min="0"
               name="deposit"
               class="regular-text"
               value="<?php echo esc_attr($deposit); ?>">
    </td>
</tr>

<tr>
    <th>Preis pro Sitzung (€)</th>
    <td>
        <input type="number"
               step="0.01"
               min="0"
               name="price_per_session"
               class="regular-text"
               value="<?php echo esc_attr($price_per_session); ?>">
    </td>
</tr>

<tr>
    <th>Geplante Sitzungen</th>
    <td>
        <input type="number"
               min="1"
               name="estimated_sessions"
               class="small-text"
               value="<?php echo esc_attr($estimated_sessions); ?>">
    </td>
</tr>

<tr>
    <th>Bereits durchgeführt</th>
    <td>
        <input type="number"
               min="0"
               name="completed_sessions"
               class="small-text"
               value="<?php echo esc_attr($completed_sessions); ?>">
    </td>
</tr>

</table>

<?php
}