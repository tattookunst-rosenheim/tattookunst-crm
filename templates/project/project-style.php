<?php

if (!defined('ABSPATH')) {
    exit;
}

function tattookunst_crm_render_project_style(
    $style = '',
    $color_type = '',
    $skin_type = ''
) {
    $custom_style = '';

    if (strpos($style, 'Eigener Stil: ') === 0) {
        $custom_style = str_replace('Eigener Stil: ', '', $style);
        $style = 'eigener_stil';
    }
    ?>

    <tr>
        <th>Stil *</th>
        <td>
            <select name="style" required>
                <option value="">Bitte auswählen</option>
                <option value="fineline" <?php selected($style, 'fineline'); ?>>Fineline</option>
                <option value="minimalistisch_patchwork" <?php selected($style, 'minimalistisch_patchwork'); ?>>Minimalistisch / Patchwork</option>
                <option value="dotwork_geometric_mandala" <?php selected($style, 'dotwork_geometric_mandala'); ?>>Dotwork / Geometric / Mandala</option>
                <option value="blackwork" <?php selected($style, 'blackwork'); ?>>Blackwork</option>
                <option value="black_grey_realismus" <?php selected($style, 'black_grey_realismus'); ?>>Black & Grey Realismus</option>
                <option value="color_realismus" <?php selected($style, 'color_realismus'); ?>>Color Realismus</option>
                <option value="traditional" <?php selected($style, 'traditional'); ?>>Traditional</option>
                <option value="neo_traditional" <?php selected($style, 'neo_traditional'); ?>>Neo Traditional</option>
                <option value="chicano" <?php selected($style, 'chicano'); ?>>Chicano</option>
                <option value="lettering" <?php selected($style, 'lettering'); ?>>Lettering</option>
                <option value="ornamentik" <?php selected($style, 'ornamentik'); ?>>Ornamentik</option>
                <option value="cover_up_stil" <?php selected($style, 'cover_up_stil'); ?>>Cover-up</option>
                <option value="eigener_stil" <?php selected($style, 'eigener_stil'); ?>>Eigener Stil</option>
            </select>

            <p>
                <input
                    type="text"
                    name="style_custom"
                    class="regular-text"
                    placeholder="Eigenen Stil eingeben"
                    value="<?php echo esc_attr($custom_style); ?>"
                >
            </p>
        </td>
    </tr>

    <tr>
        <th>Farbart *</th>
        <td>
            <select name="color_type" required>
                <option value="">Bitte auswählen</option>
                <option value="black_grey" <?php selected($color_type, 'black_grey'); ?>>Black & Grey</option>
                <option value="color" <?php selected($color_type, 'color'); ?>>Color</option>
                <option value="blackwork" <?php selected($color_type, 'blackwork'); ?>>Blackwork</option>
                <option value="kombination" <?php selected($color_type, 'kombination'); ?>>Kombination</option>
            </select>
        </td>
    </tr>

    <tr>
    <th>Hauttyp</th>
    <td>

        <select name="skin_type">
            <option value="">Bitte auswählen</option>
            <option value="1" <?php selected($skin_type, '1'); ?>>Typ I – sehr helle Haut</option>
            <option value="2" <?php selected($skin_type, '2'); ?>>Typ II – helle Haut</option>
            <option value="3" <?php selected($skin_type, '3'); ?>>Typ III – mittlere Haut</option>
            <option value="4" <?php selected($skin_type, '4'); ?>>Typ IV – oliv</option>
            <option value="5" <?php selected($skin_type, '5'); ?>>Typ V – dunkle Haut</option>
            <option value="6" <?php selected($skin_type, '6'); ?>>Typ VI – sehr dunkle Haut</option>
        </select>
    </td>
</tr>

    <?php
}