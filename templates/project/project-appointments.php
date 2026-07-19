<?php

if (!defined('ABSPATH')) {
    exit;
}

function tattookunst_crm_render_project_appointments($preferred_artist = 'Chris', $desired_timeframe = '', $appointment_notes = '') {
    ?>

    <h2>Terminwünsche</h2>

    <table class="form-table">
        <tr>
            <th>Bevorzugter Tätowierer</th>
            <td>
                <input type="text"
                       name="preferred_artist"
                       class="regular-text"
                       value="<?php echo esc_attr($preferred_artist ?: 'Chris'); ?>">
            </td>
        </tr>

        <tr>
            <th>Gewünschter Zeitraum</th>
            <td>
                <select name="desired_timeframe">
                    <option value="">Bitte auswählen</option>
                    <option value="sofort" <?php selected($desired_timeframe, 'sofort'); ?>>So schnell wie möglich</option>
                    <option value="1_monat" <?php selected($desired_timeframe, '1_monat'); ?>>Innerhalb 1 Monat</option>
                    <option value="3_monate" <?php selected($desired_timeframe, '3_monate'); ?>>Innerhalb 3 Monaten</option>
                    <option value="6_monate" <?php selected($desired_timeframe, '6_monate'); ?>>Innerhalb 6 Monaten</option>
                    <option value="1_jahr" <?php selected($desired_timeframe, '1_jahr'); ?>>Innerhalb 1 Jahres</option>
                    <option value="kein_zeitdruck" <?php selected($desired_timeframe, 'kein_zeitdruck'); ?>>Kein Zeitdruck</option>
                </select>
            </td>
        </tr>

        <tr>
            <th>Weitere Terminwünsche</th>
            <td>
                <textarea name="appointment_notes" rows="5" cols="70"><?php echo esc_textarea($appointment_notes); ?></textarea>
            </td>
        </tr>
    </table>

    <?php
}