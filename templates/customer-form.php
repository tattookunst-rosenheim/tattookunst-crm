<?php

if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

$table_name = $wpdb->prefix . 'tattookunst_customers';

$editing  = false;
$customer = null;
$errors   = [];

if (isset($_GET['edit_customer'])) {
    $customer_id = intval($_GET['edit_customer']);

    $customer = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE id = %d",
            $customer_id
        )
    );

    if ($customer) {
        $editing = true;
    }
}

if (isset($_POST['tattookunst_save_customer'])) {

    $firstname = trim(
        sanitize_text_field($_POST['customer_firstname'] ?? '')
    );

    $lastname = trim(
        sanitize_text_field($_POST['customer_lastname'] ?? '')
    );

    $gender = sanitize_text_field(
        $_POST['customer_gender'] ?? ''
    );

    $skin_type = sanitize_text_field(
        $_POST['customer_skin_type'] ?? ''
    );

    $phone = trim(
        sanitize_text_field($_POST['customer_phone'] ?? '')
    );

    $email = trim(
        sanitize_email($_POST['customer_email'] ?? '')
    );

    $birthday = trim(
        sanitize_text_field($_POST['customer_birthday'] ?? '')
    );

    $customer_source = sanitize_text_field(
        $_POST['customer_source'] ?? ''
    );

    if (
        $firstname === '' ||
        !preg_match('/^[\p{L}\s\-]+$/u', $firstname)
    ) {
        $errors[] = 'Bitte gib einen gültigen Vornamen ein.';
    }

    if (
        $lastname === '' ||
        !preg_match('/^[\p{L}\s\-]+$/u', $lastname)
    ) {
        $errors[] = 'Bitte gib einen gültigen Nachnamen ein.';
    }

    if (!in_array($gender, ['maennlich', 'weiblich', 'divers'], true)) {
        $errors[] = 'Bitte wähle ein Geschlecht aus.';
    }

    if (
        !in_array(
            $skin_type,
            ['typ_1', 'typ_2', 'typ_3', 'typ_4', 'typ_5', 'typ_6'],
            true
        )
    ) {
        $errors[] = 'Bitte wähle einen Hauttyp aus.';
    }

    if (
        $phone === '' ||
        !preg_match('/^[0-9+\s\/\-()]+$/', $phone)
    ) {
        $errors[] = 'Bitte gib eine gültige Handynummer ein.';
    }

    if ($email === '' || !is_email($email)) {
        $errors[] = 'Bitte gib eine gültige E-Mail-Adresse ein.';
    }

    if ($birthday === '') {
        $errors[] = 'Bitte gib ein Geburtsdatum ein.';
    } elseif (strtotime($birthday) > time()) {
        $errors[] = 'Das Geburtsdatum darf nicht in der Zukunft liegen.';
    }

    if (empty($errors)) {

        $data = [
            'name'            => trim($firstname . ' ' . $lastname),
            'gender'          => $gender,
            'skin_type'       => $skin_type,
            'phone'           => $phone,
            'email'           => $email,
            'birthday'        => $birthday,
            'whatsapp'        => isset($_POST['customer_whatsapp']) ? 1 : 0,
            'telegram'        => isset($_POST['customer_telegram']) ? 1 : 0,
            'customer_source' => $customer_source,
        ];

        if (!empty($_POST['customer_id'])) {

            $customer_id = intval($_POST['customer_id']);

            $wpdb->update(
                $table_name,
                $data,
                ['id' => $customer_id]
            );

            echo '<div class="notice notice-success"><p>Kunde wurde aktualisiert.</p></div>';

            $customer = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM $table_name WHERE id = %d",
                    $customer_id
                )
            );

            $editing = true;

        } else {

            $wpdb->insert($table_name, $data);

            $customer_id = intval($wpdb->insert_id);

            echo '<div class="notice notice-success"><p>Kunde wurde gespeichert.</p></div>';

            $customer = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM $table_name WHERE id = %d",
                    $customer_id
                )
            );

            $editing = true;
        }
    }
}

$firstname = '';
$lastname  = '';

if ($customer && !empty($customer->name)) {
    $name_parts = explode(' ', $customer->name, 2);

    $firstname = $name_parts[0] ?? '';
    $lastname  = $name_parts[1] ?? '';
}

$current_gender = $_POST['customer_gender']
    ?? ($customer->gender ?? '');

$current_skin_type = $_POST['customer_skin_type']
    ?? ($customer->skin_type ?? '');

$current_source = $_POST['customer_source']
    ?? ($customer->customer_source ?? '');

$current_whatsapp = isset($_POST['tattookunst_save_customer'])
    ? isset($_POST['customer_whatsapp'])
    : !empty($customer->whatsapp);

$current_telegram = isset($_POST['tattookunst_save_customer'])
    ? isset($_POST['customer_telegram'])
    : !empty($customer->telegram);
?>

<div class="wrap">

    <h1>
        <?php echo $editing ? '✏️ Kunde bearbeiten' : '➕ Neuer Kunde'; ?>
    </h1>

    <?php if (!empty($errors)): ?>
        <div class="notice notice-error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo esc_html($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="">

        <?php if ($editing && $customer): ?>
            <input
                type="hidden"
                name="customer_id"
                value="<?php echo intval($customer->id); ?>"
            >
        <?php endif; ?>

        <table class="form-table">

            <tr>
                <th>Vorname *</th>
                <td>
                    <input
                        type="text"
                        name="customer_firstname"
                        class="regular-text"
                        required
                        value="<?php
                            echo esc_attr(
                                $_POST['customer_firstname'] ?? $firstname
                            );
                        ?>"
                    >
                </td>
            </tr>

            <tr>
                <th>Nachname *</th>
                <td>
                    <input
                        type="text"
                        name="customer_lastname"
                        class="regular-text"
                        required
                        value="<?php
                            echo esc_attr(
                                $_POST['customer_lastname'] ?? $lastname
                            );
                        ?>"
                    >
                </td>
            </tr>

            <tr>
                <th>Geschlecht *</th>
                <td>
                    <label>
                        <input
                            type="radio"
                            name="customer_gender"
                            value="maennlich"
                            required
                            <?php checked($current_gender, 'maennlich'); ?>
                        >
                        Männlich
                    </label>

                    <br>

                    <label>
                        <input
                            type="radio"
                            name="customer_gender"
                            value="weiblich"
                            <?php checked($current_gender, 'weiblich'); ?>
                        >
                        Weiblich
                    </label>

                    <br>

                    <label>
                        <input
                            type="radio"
                            name="customer_gender"
                            value="divers"
                            <?php checked($current_gender, 'divers'); ?>
                        >
                        Divers
                    </label>
                </td>
            </tr>

 <tr>
                <th>Handynummer *</th>
                <td>
                    <input
                        type="text"
                        name="customer_phone"
                        class="regular-text"
                        required
                        value="<?php
                            echo esc_attr(
                                $_POST['customer_phone']
                                ?? ($customer->phone ?? '')
                            );
                        ?>"
                    >
                </td>
            </tr>

            <tr>
                <th>E-Mail *</th>
                <td>
                    <input
                        type="email"
                        name="customer_email"
                        class="regular-text"
                        required
                        value="<?php
                            echo esc_attr(
                                $_POST['customer_email']
                                ?? ($customer->email ?? '')
                            );
                        ?>"
                    >
                </td>
            </tr>

            <tr>
                <th>Geburtsdatum *</th>
                <td>
                    <input
                        type="date"
                        name="customer_birthday"
                        required
                        max="<?php echo esc_attr(current_time('Y-m-d')); ?>"
                        value="<?php
                            echo esc_attr(
                                $_POST['customer_birthday']
                                ?? ($customer->birthday ?? '')
                            );
                        ?>"
                    >
                </td>
            </tr>

            <tr>
                <th>WhatsApp vorhanden</th>
                <td>
                    <label>
                        <input
                            type="checkbox"
                            name="customer_whatsapp"
                            <?php checked($current_whatsapp); ?>
                        >
                        Ja
                    </label>
                </td>
            </tr>

            <tr>
                <th>Telegram vorhanden</th>
                <td>
                    <label>
                        <input
                            type="checkbox"
                            name="customer_telegram"
                            <?php checked($current_telegram); ?>
                        >
                        Ja
                    </label>
                </td>
            </tr>

            <tr>
                <th>Herkunft des Kunden</th>
                <td>
                    <select name="customer_source">
                        <option value="">Bitte auswählen</option>

                        <option
                            value="website"
                            <?php selected($current_source, 'website'); ?>
                        >
                            Website
                        </option>

                        <option
                            value="studio"
                            <?php selected($current_source, 'studio'); ?>
                        >
                            Im Studio
                        </option>

                        <option
                            value="empfehlung"
                            <?php selected($current_source, 'empfehlung'); ?>
                        >
                            Empfehlung
                        </option>

                        <option
                            value="instagram"
                            <?php selected($current_source, 'instagram'); ?>
                        >
                            Instagram
                        </option>

                        <option
                            value="facebook"
                            <?php selected($current_source, 'facebook'); ?>
                        >
                            Facebook
                        </option>

                        <option
                            value="tiktok"
                            <?php selected($current_source, 'tiktok'); ?>
                        >
                            TikTok
                        </option>

                        <option
                            value="google"
                            <?php selected($current_source, 'google'); ?>
                        >
                            Google
                        </option>

                        <option
                            value="gutschein"
                            <?php selected($current_source, 'gutschein'); ?>
                        >
                            Gutschein
                        </option>

                        <option
                            value="sonstiges"
                            <?php selected($current_source, 'sonstiges'); ?>
                        >
                            Sonstiges
                        </option>
                    </select>
                </td>
            </tr>

        </table>

        <p>
            <button
                type="submit"
                name="tattookunst_save_customer"
                class="button button-primary"
            >
                <?php
                    echo $editing
                        ? 'Kunde aktualisieren'
                        : 'Kunde speichern';
                ?>
            </button>

            <?php if ($editing && $customer): ?>
                <a
                    href="?page=tattookunst-crm-neues-projekt&customer_id=<?php echo intval($customer->id); ?>"
                    class="button button-secondary"
                >
                    + Neues Projekt für diesen Kunden
                </a>
            <?php endif; ?>

            <a
                href="?page=tattookunst-crm-kunden"
                class="button"
            >
                Zurück zur Kundenliste
            </a>
        </p>

    </form>

</div>