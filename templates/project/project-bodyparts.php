<?php

if (!defined('ABSPATH')) {
    exit;
}

function tattookunst_crm_render_project_bodyparts($selected_body_parts = [], $custom_body_part = '') {

    $groups = [
        'Kopf' => ['Kopf','Stirn','Gesicht','Auge links','Auge rechts','Ohr links','Ohr rechts','Hinter dem linken Ohr','Hinter dem rechten Ohr','Hals','Nacken'],
        'Oberkörper' => ['Frontpiece','Backpiece','Brust links','Brust rechts','Brust mittig','Zwischen den Brüsten','Bauch','Rippen links','Rippen rechts','Rücken','Rücken oben','Rücken Mitte','Wirbelsäule','Rücken unten','Steiß','Schulter links','Schulter rechts','Schulterblatt links','Schulterblatt rechts','Achsel links','Achsel rechts'],
        'Arme' => ['Arm Sleeve links','Arm Sleeve rechts','Linker Oberarm außen','Linker Oberarm innen','Linker Oberarm hinten','Rechter Oberarm außen','Rechter Oberarm innen','Rechter Oberarm hinten','Linker Unterarm außen','Linker Unterarm innen','Rechter Unterarm außen','Rechter Unterarm innen','Linkes Handgelenk','Rechtes Handgelenk','Linke Hand','Rechte Hand','Linke Finger','Rechte Finger'],
        'Beine' => ['Leg Sleeve links','Leg Sleeve rechts','Linke Hüfte','Rechte Hüfte','Linker Oberschenkel vorne','Linker Oberschenkel hinten','Rechter Oberschenkel vorne','Rechter Oberschenkel hinten','Linkes Knie','Rechtes Knie','Linke Kniekehle','Rechte Kniekehle','Linkes Schienbein','Rechtes Schienbein','Linke Wade','Rechte Wade','Linker Knöchel','Rechter Knöchel','Linker Fuß','Rechter Fuß','Linke Zehen','Rechte Zehen'],
        'Intimbereich' => ['Po links','Po rechts','Intimbereich'],
    ];

    ?>

    <h2>Körperstellen *</h2>

    <?php foreach ($groups as $group_name => $parts): ?>
        <h3><?php echo esc_html($group_name); ?></h3>

        <div style="display:grid;grid-template-columns:repeat(3,minmax(180px,1fr));gap:8px;margin-bottom:18px;">
            <?php foreach ($parts as $part): ?>
                <label>
                    <input type="checkbox"
                           name="body_parts[]"
                           value="<?php echo esc_attr($part); ?>"
                           <?php checked(in_array($part, $selected_body_parts, true)); ?>>
                    <?php echo esc_html($part); ?>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <h3>Sonstiges</h3>
    <p>
        <input type="text"
               name="body_parts_custom"
               class="regular-text"
               placeholder="Eigene Körperstelle"
               value="<?php echo esc_attr($custom_body_part); ?>">
    </p>

    <?php
}