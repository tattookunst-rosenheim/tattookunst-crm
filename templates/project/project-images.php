<?php

if (!defined('ABSPATH')) {
    exit;
}

function tattookunst_crm_render_project_images($project_id = 0) {

    global $wpdb;

    $images_table = $wpdb->prefix . 'tattookunst_project_images';

    ?>

    <tr>
        <th>Referenzbilder</th>
        <td>

            <input
                type="file"
                name="reference_images[]"
                multiple
                accept="image/*">

            <p class="description">
                Maximal 20 Bilder. Erlaubt: JPG, PNG, WEBP, HEIC.
            </p>

            <?php

            if ($project_id) {

                $images = $wpdb->get_results(
                    $wpdb->prepare(
                        "SELECT * FROM $images_table
                         WHERE project_id=%d
                         ORDER BY id ASC",
                        $project_id
                    )
                );

                if ($images) {

                    echo '<div style="display:flex;gap:15px;flex-wrap:wrap;margin-top:15px;">';

                    foreach ($images as $image) {

                        $thumb = wp_get_attachment_image_url($image->image_id, 'thumbnail');
                        $large = wp_get_attachment_image_url($image->image_id, 'large');

                        ?>

                        <div>

                            <a href="<?php echo esc_url($large); ?>" target="_blank">

                                <img
                                    src="<?php echo esc_url($thumb); ?>"
                                    style="width:120px;height:120px;object-fit:cover;border-radius:8px;">

                            </a>

                        </div>

                        <?php

                    }

                    echo '</div>';

                }

            }

            ?>

        </td>
    </tr>

    <?php
}