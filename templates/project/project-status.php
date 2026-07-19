<?php

if (!defined('ABSPATH')) {
    exit;
}

function tattookunst_crm_render_project_status($status = 'anfrage') {
    ?>

    <h2>Status</h2>

    <table class="form-table">
        <tr>
            <th>Projektstatus</th>
            <td>
                <select name="status">
                    <option value="anfrage" <?php selected($status, 'anfrage'); ?>>Anfrage</option>
                    <option value="rueckfrage_offen" <?php selected($status, 'rueckfrage_offen'); ?>>Rückfrage offen</option>
                    <option value="beratung" <?php selected($status, 'beratung'); ?>>Beratung</option>
                    <option value="termin_angeboten" <?php selected($status, 'termin_angeboten'); ?>>Termin angeboten</option>
                    <option value="termin_bestaetigt" <?php selected($status, 'termin_bestaetigt'); ?>>Termin bestätigt</option>
                    <option value="in_arbeit" <?php selected($status, 'in_arbeit'); ?>>In Arbeit</option>
                    <option value="abgeschlossen" <?php selected($status, 'abgeschlossen'); ?>>Abgeschlossen</option>
                    <option value="abgebrochen" <?php selected($status, 'abgebrochen'); ?>>Abgebrochen</option>
                </select>
            </td>
        </tr>
    </table>

    <?php
}