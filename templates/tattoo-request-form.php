<?php
// TATTOOKUNST Anfrage-Modul Korrektur 2

if (!defined('ABSPATH')) {
    exit;
}

$request_errors  = $request_errors ?? [];
$request_success = $request_success ?? false;

$current_gender = $_POST['request_gender'] ?? '';
$current_project_type = $_POST['request_project_type'] ?? '';
$current_project_size = $_POST['request_project_size'] ?? '';
$current_style = $_POST['request_style'] ?? '';
$current_color_type = $_POST['request_color_type'] ?? '';
$current_timeframe = $_POST['request_desired_timeframe'] ?? '';
$current_source = $_POST['request_customer_source'] ?? '';
$logo_url = plugin_dir_url(__FILE__) . 'tattookunst-logo.png';

$selected_body_parts = isset($_POST['request_body_parts'])
    ? array_map(
        'sanitize_text_field',
        wp_unslash((array) $_POST['request_body_parts'])
    )
    : [];
?>

<style>
    .tattookunst-request-form {
        --tk-page: #ffffff;
        --tk-card: #ffffff;
        --tk-field: #ffffff;
        --tk-line: #d9d9d5;
        --tk-line-strong: #b9b9b4;
        --tk-text: #161616;
        --tk-muted: #6f6f6b;
        --tk-soft: #f7f7f7;
        --tk-button: #171717;
        --tk-success: #23673f;
        --tk-error: #a52d2d;

        max-width: 1040px;
        margin: 32px auto;
        padding: 28px;
        border: 1px solid #cfcfcb;
        border-radius: 16px;
        background: #ffffff;
        color: var(--tk-text);
        box-shadow: 0 18px 55px rgba(0, 0, 0, 0.08);
        box-sizing: border-box;
    }

    .tattookunst-request-form,
    .tattookunst-request-form * {
        box-sizing: border-box;
    }

    .tk-form-brand {
        display: flex;
        align-items: center;
        gap: 18px;
        margin: 0 0 26px;
        padding: 18px;
        border: 1px solid var(--tk-line);
        border-radius: 14px;
        background: var(--tk-card);
    }

    .tk-form-brand img {
        display: block;
        width: 92px;
        height: 92px;
        border-radius: 50%;
        object-fit: cover;
        flex: 0 0 auto;
    }

    .tk-form-brand-title {
        color: var(--tk-text);
        font-size: clamp(23px, 4vw, 32px);
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: 0.01em;
    }

    .tk-form-brand {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 0 28px;
    padding: 12px 0;
    border: 0;
    background: transparent;
}

.tk-form-brand img {
    display: block;
    width: 170px;
    height: 170px;
    border-radius: 50%;
    object-fit: cover;
}

    .tattookunst-request-form h2 {
        margin: 0 0 24px;
        color: var(--tk-text);
        font-size: clamp(30px, 5vw, 42px);
        line-height: 1.1;
        letter-spacing: -0.025em;
        text-align: center;
margin-top: 10px;
margin-bottom: 30px;
    }

    .tk-form-section {
        margin: 32px 0 18px;
        padding: 0 0 11px;
        border-bottom: 1px solid var(--tk-line-strong);
        color: var(--tk-text);
        font-size: 22px;
        font-weight: 800;
        letter-spacing: -0.01em;
    }

    .tattookunst-request-form h3,
    .tattookunst-request-form h4 {
        color: var(--tk-text);
    }

    .tattookunst-request-form-fields > p,
    .tattookunst-request-form fieldset,
    .tk-bodypart-section {
        margin: 0 0 22px;
    }

    .tattookunst-request-form label,
    .tattookunst-request-form legend {
        color: var(--tk-text);
        font-size: 16px;
        font-weight: 750;
        line-height: 1.4;
    }

    .tattookunst-request-form label[for] {
        display: block;
        margin: 0 0 8px;
    }

    .tattookunst-request-form input[type="text"],
    .tattookunst-request-form input[type="email"],
    .tattookunst-request-form input[type="tel"],
    .tattookunst-request-form input[type="date"],
    .tattookunst-request-form input[type="file"],
    .tattookunst-request-form select,
    .tattookunst-request-form textarea {
        display: block;
        width: 100%;
        min-height: 54px;
        padding: 13px 15px;
        border: 1px solid var(--tk-line-strong);
        border-radius: 8px;
        background: var(--tk-field);
        color: var(--tk-text);
        font: inherit;
        font-size: 17px;
        line-height: 1.4;
        outline: none;
        transition: border-color .18s ease, box-shadow .18s ease;
    }

    .tattookunst-request-form select {
        cursor: pointer;
    }

    .tattookunst-request-form textarea {
        min-height: 170px;
        resize: vertical;
    }

    #request_tattoo_wish {
        min-height: 250px;
    }

    #request_customer_notes {
        min-height: 130px;
    }

    .tattookunst-request-form input::placeholder,
    .tattookunst-request-form textarea::placeholder {
        color: #969691;
        opacity: 1;
    }

    .tattookunst-request-form input:focus,
    .tattookunst-request-form select:focus,
    .tattookunst-request-form textarea:focus {
        border-color: #222;
        box-shadow: 0 0 0 3px rgba(0,0,0,.09);
    }

    .tattookunst-request-form input[type="radio"],
    .tattookunst-request-form input[type="checkbox"] {
        width: 20px;
        height: 20px;
        margin: 0;
        accent-color: #171717;
        flex: 0 0 auto;
    }

    .tk-choice-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
        margin-top: 12px;
    }

    .tk-choice-grid label,
    .tk-bodypart-main label,
    .tk-bodypart-details label {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
        padding: 13px 14px;
        border: 1px solid var(--tk-line);
        border-radius: 8px;
        background: var(--tk-card);
        cursor: pointer;
        font-size: 15px;
        font-weight: 650;
        transition: border-color .18s ease, background .18s ease;
    }

    .tk-choice-grid label:hover,
    .tk-bodypart-main label:hover,
    .tk-bodypart-details label:hover {
        border-color: #8c8c87;
        background: #fafafa;
    }

    .tattookunst-request-form fieldset,
    .tk-bodypart-section,
    .tk-fixed-artist {
        padding: 20px;
        border: 1px solid #c9c9c5;
        border-radius: 12px;
        background: #ffffff;
    }

    .tattookunst-request-form legend {
        padding: 0 8px;
    }

    .tk-fixed-artist {
        margin-bottom: 22px;
    }

    .tk-fixed-artist-label {
        margin-bottom: 8px;
        color: var(--tk-text);
        font-size: 16px;
        font-weight: 750;
    }

    .tk-fixed-artist-value {
        min-height: 54px;
        display: flex;
        align-items: center;
        padding: 13px 15px;
        border: 1px solid var(--tk-line-strong);
        border-radius: 8px;
        background: #f7f7f5;
        color: var(--tk-text);
        font-size: 17px;
        font-weight: 700;
    }

    .tattookunst-request-form small,
    .tk-help,
    .tk-file-status {
        display: block;
        margin-top: 8px;
        color: var(--tk-muted);
        font-size: 14px;
        line-height: 1.5;
    }

    .tk-file-preview {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-top: 16px;
    }

    .tk-file-preview-card {
        overflow: hidden;
        border: 1px solid var(--tk-line);
        border-radius: 10px;
        background: var(--tk-card);
    }

    .tk-file-preview-card img {
        display: block;
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        background: var(--tk-soft);
    }

    .tk-file-preview-name {
        padding: 9px 10px;
        color: var(--tk-text);
        font-size: 13px;
        line-height: 1.35;
        overflow-wrap: anywhere;
    }

    .tattookunst-message,
    .tk-success-page {
        margin: 0;
        padding: 30px;
        border: 1px solid var(--tk-line);
        border-radius: 14px;
        background: var(--tk-card);
    }

    .tk-success-page {
        text-align: center;
    }

    .tk-success-page h2 {
        margin-bottom: 14px;
    }

    .tk-success-page p {
        max-width: 650px;
        margin: 0 auto 12px;
        color: var(--tk-muted);
        font-size: 17px;
        line-height: 1.65;
    }

    .tattookunst-message-error {
        border-color: #d8aaaa;
        color: var(--tk-error);
    }

    .tk-bodypart-section > p {
        margin: 0;
        color: var(--tk-muted);
        line-height: 1.55;
    }

    .tk-bodypart-main {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 10px;
        margin: 18px 0 22px;
    }

    .tk-bodypart-main label {
        justify-content: center;
        text-align: center;
    }

    .tk-bodypart-details {
        display: grid;
        grid-template-columns: repeat(3, minmax(180px, 1fr));
        gap: 10px;
        margin: 0 0 18px;
        padding: 18px;
        border: 1px solid var(--tk-line);
        border-radius: 10px;
        background: #ffffff;
    }

    .tk-bodypart-details h4 {
        grid-column: 1 / -1;
        margin: 0 0 6px;
        font-size: 18px;
    }

    .tk-submit-button {
        width: 100%;
        min-height: 56px;
        padding: 14px 22px;
        border: 1px solid #111;
        border-radius: 8px;
        background: var(--tk-button);
        color: #fff;
        font-size: 18px;
        font-weight: 800;
        cursor: pointer;
        transition: background .18s ease, transform .18s ease;
    }

    .tk-submit-button:hover {
        background: #303030;
        transform: translateY(-1px);
    }

    .tk-submit-button:disabled {
        cursor: wait;
        opacity: .65;
        transform: none;
    }

    @media (max-width: 820px) {
        .tattookunst-request-form {
            margin: 16px auto;
            padding: 22px;
        }

        .tk-bodypart-main {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .tk-bodypart-details {
            grid-template-columns: 1fr 1fr;
        }

        .tk-file-preview {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .tattookunst-request-form {
            margin: 0;
            padding: 16px 12px 22px;
            border-left: 0;
            border-right: 0;
            border-radius: 0;
        }

        .tk-form-brand {
            align-items: center;
            gap: 13px;
            padding: 14px;
        }

        .tk-form-brand img {
            width: 70px;
            height: 70px;
        }

        .tk-choice-grid,
        .tk-bodypart-main,
        .tk-bodypart-details,
        .tk-file-preview {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="tattookunst-request-form">

    <div class="tk-form-brand">
    <img
        src="<?php echo esc_url($logo_url); ?>"
        alt="TATTOOKUNST Chris"
    >
</div>

<?php if (!$request_success): ?>
    <h2>Tattoo-Anfrage</h2>
<?php endif; ?>

    <?php if ($request_success): ?>
        <div class="tk-success-page">
            <h2>Vielen Dank!</h2>
            <p>
                Deine Tattoo-Anfrage wurde erfolgreich übermittelt.
            </p>
            <p>
                Ich prüfe deine Angaben persönlich und melde mich in der Regel
                innerhalb der nächsten 1–2 Werktage bei dir.
            </p>
            <p>
                Viele Grüße<br>
                <strong>TATTOOKUNST Chris</strong><br>
                TATTOOKUNST Rosenheim
            </p>
        </div>

        <script>
            if (window.history.replaceState) {
                const url = new URL(window.location.href);
                url.searchParams.delete('tattoo_request');
                window.history.replaceState({}, document.title, url.toString());
            }
        </script>
    <?php else: ?>

    <?php if (!empty($request_errors)): ?>
        <div class="tattookunst-message tattookunst-message-error">
            <ul>
                <?php foreach ($request_errors as $error): ?>
                    <li><?php echo esc_html($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form
        method="post"
        action=""
        enctype="multipart/form-data"
        class="tattookunst-request-form-fields"
        id="tattookunst-request-form-fields"
    >

        <?php
        wp_nonce_field(
            'tattookunst_save_tattoo_request',
            'tattookunst_request_nonce'
        );
        ?>

        <input
            type="hidden"
            name="tattookunst_request_action"
            value="save_tattoo_request"
        >

        <div class="tk-form-section">Persönliche Daten</div>

        <p>
            <label for="request_firstname">Vorname *</label>
            <input
                type="text"
                id="request_firstname"
                name="request_firstname"
                required
                autocomplete="given-name"
                value="<?php echo esc_attr(
                    $_POST['request_firstname'] ?? ''
                ); ?>"
            >
        </p>

        <p>
            <label for="request_lastname">Nachname *</label>
            <input
                type="text"
                id="request_lastname"
                name="request_lastname"
                required
                autocomplete="family-name"
                value="<?php echo esc_attr(
                    $_POST['request_lastname'] ?? ''
                ); ?>"
            >
        </p>

        <p>
            <label for="request_phone">Handynummer *</label>
            <input
                type="tel"
                id="request_phone"
                name="request_phone"
                required
                autocomplete="tel"
                value="<?php echo esc_attr(
                    $_POST['request_phone'] ?? ''
                ); ?>"
            >
        </p>

        <fieldset>
            <legend>Bevorzugter Kontaktweg *</legend>

            <div class="tk-choice-grid">
                <label>
                    <input
                        type="radio"
                        name="request_contact_method"
                        value="whatsapp"
                        required
                        <?php checked(
                            $_POST['request_contact_method'] ?? '',
                            'whatsapp'
                        ); ?>
                    >
                    WhatsApp
                </label>

                <label>
                    <input
                        type="radio"
                        name="request_contact_method"
                        value="telegram"
                        required
                        <?php checked(
                            $_POST['request_contact_method'] ?? '',
                            'telegram'
                        ); ?>
                    >
                    Telegram
                </label>

                <label>
                    <input
                        type="radio"
                        name="request_contact_method"
                        value="email"
                        required
                        <?php checked(
                            $_POST['request_contact_method'] ?? '',
                            'email'
                        ); ?>
                    >
                    E-Mail
                </label>
            </div>
        </fieldset>

        <p id="telegram-username-field" style="display:none;">
            <label for="request_telegram_username">
                Telegram-Benutzername *
            </label>

            <input
                type="text"
                id="request_telegram_username"
                name="request_telegram_username"
                value="<?php echo esc_attr(
                    $_POST['request_telegram_username'] ?? ''
                ); ?>"
                placeholder="@benutzername"
            >
        </p>

        <p>
            <label for="request_email">E-Mail-Adresse *</label>
            <input
                type="email"
                id="request_email"
                name="request_email"
                required
                autocomplete="email"
                value="<?php echo esc_attr(
                    $_POST['request_email'] ?? ''
                ); ?>"
            >
        </p>

        <p>
            <label for="request_birthday">Geburtsdatum *</label>
            <input
                type="text"
                inputmode="numeric"
                placeholder="TT.MM.JJJJ"
                pattern="\d{2}\.\d{2}\.\d{4}"
                maxlength="10"
                id="request_birthday"
                name="request_birthday"
                required
                autocomplete="bday"
                value="<?php echo esc_attr(
                    $_POST['request_birthday'] ?? ''
                ); ?>"
            >
            <small>Bitte im Format TT.MM.JJJJ eingeben.</small>
        </p>

        <fieldset>
            <legend>Geschlecht *</legend>

            <div class="tk-choice-grid">
                <label>
                    <input
                        type="radio"
                        name="request_gender"
                        value="maennlich"
                        required
                        <?php checked($current_gender, 'maennlich'); ?>
                    >
                    Männlich
                </label>

                <label>
                    <input
                        type="radio"
                        name="request_gender"
                        value="weiblich"
                        <?php checked($current_gender, 'weiblich'); ?>
                    >
                    Weiblich
                </label>

                <label>
                    <input
                        type="radio"
                        name="request_gender"
                        value="divers"
                        <?php checked($current_gender, 'divers'); ?>
                    >
                    Divers
                </label>
            </div>
        </fieldset>

        <div class="tk-form-section">Tattoo-Details</div>

        <p>
            <label for="request_tattoo_wish">
                Motividee / Tattoo-Wunsch *
            </label>

            <textarea
                id="request_tattoo_wish"
                name="request_tattoo_wish"
                rows="10"
                required
                placeholder="Beschreibe deine Motividee möglichst genau."
            ><?php echo esc_textarea(
                $_POST['request_tattoo_wish'] ?? ''
            ); ?></textarea>
        </p>

        <p>
            <label for="request_images">Referenzbilder *</label>

            <input
                type="file"
                id="request_images"
                name="request_images[]"
                accept="image/jpeg,image/png,image/webp,image/heic,image/heif"
                multiple
                required
            >

            <small>
                Maximal 20 Bilder, höchstens 10 MB pro Bild.
            </small>

            <span class="tk-file-status" id="tk-file-status"></span>
            <div class="tk-file-preview" id="tk-file-preview"></div>
        </p>

        <p>
            <label for="request_project_type">Projektart *</label>

            <select
                id="request_project_type"
                name="request_project_type"
                required
            >
                <option value="">Bitte auswählen</option>
                <option
                    value="neues_tattoo"
                    <?php selected(
                        $current_project_type,
                        'neues_tattoo'
                    ); ?>
                >
                    Neues Tattoo
                </option>
                <option
                    value="erweiterung"
                    <?php selected(
                        $current_project_type,
                        'erweiterung'
                    ); ?>
                >
                    Erweiterung
                </option>
                <option
                    value="cover_up"
                    <?php selected(
                        $current_project_type,
                        'cover_up'
                    ); ?>
                >
                    Cover-up
                </option>
                <option
                    value="narben"
                    <?php selected(
                        $current_project_type,
                        'narben'
                    ); ?>
                >
                    Über Narben
                </option>
                <option
                    value="tattoo_fertigstellung"
                    <?php selected(
                        $current_project_type,
                        'tattoo_fertigstellung'
                    ); ?>
                >
                    Tattoo-Fertigstellung
                </option>
                <option
                    value="eigene"
                    <?php selected(
                        $current_project_type,
                        'eigene'
                    ); ?>
                >
                    Andere Projektart
                </option>
            </select>
        </p>

        <p>
            <label for="request_project_type_custom">
                Andere Projektart
            </label>
            <input
                type="text"
                id="request_project_type_custom"
                name="request_project_type_custom"
                value="<?php echo esc_attr(
                    $_POST['request_project_type_custom'] ?? ''
                ); ?>"
            >
        </p>

        <p>
            <label for="request_project_size">
                Ungefähre Projektgröße *
            </label>

            <select
                id="request_project_size"
                name="request_project_size"
                required
            >
                <option value="">Bitte auswählen</option>
                <option
                    value="klein"
                    <?php selected($current_project_size, 'klein'); ?>
                >
                    Klein
                </option>
                <option
                    value="mittel"
                    <?php selected($current_project_size, 'mittel'); ?>
                >
                    Mittel
                </option>
                <option
                    value="gross"
                    <?php selected($current_project_size, 'gross'); ?>
                >
                    Groß
                </option>
            </select>
        </p>

        <p>
            <label for="request_style">Stil *</label>

            <select
                id="request_style"
                name="request_style"
                required
            >
                <option value="">Bitte auswählen</option>
                <option value="fineline" <?php selected($current_style, 'fineline'); ?>>Fine Line</option>
                <option value="minimalistisch_patchwork" <?php selected($current_style, 'minimalistisch_patchwork'); ?>>Minimalistisch / Patchwork</option>
                <option value="dotwork_geometric_mandala" <?php selected($current_style, 'dotwork_geometric_mandala'); ?>>Dotwork / Geometrisch / Mandala</option>
                <option value="blackwork" <?php selected($current_style, 'blackwork'); ?>>Blackwork</option>
                <option value="black_grey_realismus" <?php selected($current_style, 'black_grey_realismus'); ?>>Black & Grey Realismus</option>
                <option value="color_realismus" <?php selected($current_style, 'color_realismus'); ?>>Color Realismus</option>
                <option value="traditional" <?php selected($current_style, 'traditional'); ?>>Traditional</option>
                <option value="neo_traditional" <?php selected($current_style, 'neo_traditional'); ?>>Neo Traditional</option>
                <option value="japanisch" <?php selected($current_style, 'japanisch'); ?>>Japanisch</option>
                <option value="maori_polynesisch" <?php selected($current_style, 'maori_polynesisch'); ?>>Maori / Polynesisch</option>
                <option value="watercolor" <?php selected($current_style, 'watercolor'); ?>>Watercolor</option>
                <option value="lettering" <?php selected($current_style, 'lettering'); ?>>Lettering</option>
                <option value="ornamentik" <?php selected($current_style, 'ornamentik'); ?>>Ornamentik</option>
                <option value="chicano" <?php selected($current_style, 'chicano'); ?>>Chicano</option>
                <option value="tribal" <?php selected($current_style, 'tribal'); ?>>Tribal</option>
                <option value="sketch" <?php selected($current_style, 'sketch'); ?>>Sketch</option>
                <option value="anime" <?php selected($current_style, 'anime'); ?>>Anime</option>
                <option value="bio_organic" <?php selected($current_style, 'bio_organic'); ?>>Bio Organic</option>
                <option value="eigener_stil" <?php selected($current_style, 'eigener_stil'); ?>>Anderer Stil</option>
            </select>
        </p>

        <p>
            <label for="request_style_custom">Anderer Stil</label>
            <input
                type="text"
                id="request_style_custom"
                name="request_style_custom"
                value="<?php echo esc_attr(
                    $_POST['request_style_custom'] ?? ''
                ); ?>"
            >
        </p>

        <p>
            <label for="request_color_type">Farbart *</label>

            <select
                id="request_color_type"
                name="request_color_type"
                required
            >
                <option value="">Bitte auswählen</option>
                <option value="black_grey" <?php selected($current_color_type, 'black_grey'); ?>>Black & Grey</option>
                <option value="color" <?php selected($current_color_type, 'color'); ?>>Color</option>
                <option value="blackwork" <?php selected($current_color_type, 'blackwork'); ?>>Blackwork</option>
                <option value="kombination" <?php selected($current_color_type, 'kombination'); ?>>Kombination</option>
            </select>
        </p>

        <div class="tk-form-section">Körperstelle &amp; Zeitraum</div>

        <div class="tk-bodypart-section">
            <h3>Körperstellen *</h3>

            <p>
                Wähle zuerst einen oder mehrere Körperbereiche aus.
                Danach öffnen sich die passenden genauen Körperstellen.
            </p>

            <div class="tk-bodypart-main">
                <label>
                    <input type="checkbox" class="tk-bodypart-toggle" value="kopf">
                    Kopf & Hals
                </label>
                <label>
                    <input type="checkbox" class="tk-bodypart-toggle" value="oberkoerper">
                    Oberkörper
                </label>
                <label>
                    <input type="checkbox" class="tk-bodypart-toggle" value="arme">
                    Arme & Hände
                </label>
                <label>
                    <input type="checkbox" class="tk-bodypart-toggle" value="beine">
                    Beine & Füße
                </label>
                <label>
                    <input type="checkbox" class="tk-bodypart-toggle" value="sonstiges">
                    Sonstiges
                </label>
            </div>

            <?php
            $bodypart_groups = [
                'kopf' => [
                    'title' => 'Kopf & Hals',
                    'parts' => [
                        'kopf_allgemein'    => 'Kopf allgemein',
                        'stirn'             => 'Stirn',
                        'gesicht'           => 'Gesicht',
                        'schlaefe_links'    => 'Schläfe links',
                        'schlaefe_rechts'   => 'Schläfe rechts',
                        'hinterkopf'        => 'Hinterkopf',
                        'ohr_links'         => 'Ohr links',
                        'ohr_rechts'        => 'Ohr rechts',
                        'hinter_ohr_links'  => 'Hinter dem linken Ohr',
                        'hinter_ohr_rechts' => 'Hinter dem rechten Ohr',
                        'hals_vorne'        => 'Hals vorne',
                        'hals_links'        => 'Hals links',
                        'hals_rechts'       => 'Hals rechts',
                        'nacken'            => 'Nacken',
                    ],
                ],
                'oberkoerper' => [
                    'title' => 'Oberkörper',
                    'parts' => [
                        'frontpiece'           => 'Frontpiece',
                        'backpiece'            => 'Backpiece',
                        'brust_links'          => 'Brust links',
                        'brust_rechts'         => 'Brust rechts',
                        'brust_mittig'         => 'Brust mittig',
                        'zwischen_bruesten'    => 'Zwischen den Brüsten',
                        'bauch'                => 'Bauch',
                        'rippen_links'         => 'Rippen links',
                        'rippen_rechts'        => 'Rippen rechts',
                        'ruecken_oben'         => 'Rücken oben',
                        'ruecken_mitte'        => 'Rücken Mitte',
                        'ruecken_unten'        => 'Rücken unten',
                        'wirbelsaeule'         => 'Wirbelsäule',
                        'steiss'               => 'Steiß',
                        'schulter_links'       => 'Schulter links',
                        'schulter_rechts'      => 'Schulter rechts',
                        'schulterblatt_links'  => 'Schulterblatt links',
                        'schulterblatt_rechts' => 'Schulterblatt rechts',
                        'achsel_links'         => 'Achsel links',
                        'achsel_rechts'        => 'Achsel rechts',
                        'huefte_links'         => 'Hüfte links',
                        'huefte_rechts'        => 'Hüfte rechts',
                        'gesaess_links'        => 'Gesäß links',
                        'gesaess_rechts'       => 'Gesäß rechts',
                    ],
                ],
                'arme' => [
                    'title' => 'Arme & Hände',
                    'parts' => [
                        'arm_links'             => 'Arm links',
                        'arm_rechts'            => 'Arm rechts',
                        'full_sleeve_links'     => 'Full Sleeve links',
                        'full_sleeve_rechts'    => 'Full Sleeve rechts',
                        'half_sleeve_links'     => 'Half Sleeve links',
                        'half_sleeve_rechts'    => 'Half Sleeve rechts',
                        'oberarm_links'         => 'Oberarm links',
                        'oberarm_rechts'        => 'Oberarm rechts',
                        'unterarm_links'        => 'Unterarm links',
                        'unterarm_rechts'       => 'Unterarm rechts',
                        'ellenbogen_links'      => 'Ellenbogen links',
                        'ellenbogen_rechts'     => 'Ellenbogen rechts',
                        'hand_links'            => 'Hand links',
                        'hand_rechts'           => 'Hand rechts',
                        'finger_links'          => 'Finger links',
                        'finger_rechts'         => 'Finger rechts',
                    ],
                ],
                'beine' => [
                    'title' => 'Beine & Füße',
                    'parts' => [
                        'bein_links'             => 'Bein links',
                        'bein_rechts'            => 'Bein rechts',
                        'leg_sleeve_links'       => 'Leg Sleeve links',
                        'leg_sleeve_rechts'      => 'Leg Sleeve rechts',
                        'oberschenkel_links'     => 'Oberschenkel links',
                        'oberschenkel_rechts'    => 'Oberschenkel rechts',
                        'knie_links'             => 'Knie links',
                        'knie_rechts'            => 'Knie rechts',
                        'unterschenkel_links'    => 'Unterschenkel links',
                        'unterschenkel_rechts'   => 'Unterschenkel rechts',
                        'wade_links'             => 'Wade links',
                        'wade_rechts'            => 'Wade rechts',
                        'knoechel_links'         => 'Knöchel links',
                        'knoechel_rechts'        => 'Knöchel rechts',
                        'fuss_links'             => 'Fuß links',
                        'fuss_rechts'            => 'Fuß rechts',
                    ],
                ],
                'sonstiges' => [
                    'title' => 'Sonstiges',
                    'parts' => [
                        'mehrere_koerperstellen' => 'Mehrere Körperstellen',
                        'noch_unsicher'           => 'Noch unsicher',
                        'andere'                  => 'Andere Körperstelle',
                    ],
                ],
            ];

            foreach ($bodypart_groups as $group_key => $group):
            ?>
                <div
                    class="tk-bodypart-details"
                    data-bodypart-group="<?php echo esc_attr($group_key); ?>"
                    style="display:none;"
                >
                    <h4><?php echo esc_html($group['title']); ?></h4>

                    <?php foreach ($group['parts'] as $value => $label): ?>
                        <label>
                            <input
                                type="checkbox"
                                name="request_body_parts[]"
                                value="<?php echo esc_attr($value); ?>"
                                <?php checked(
                                    in_array(
                                        $value,
                                        $selected_body_parts,
                                        true
                                    )
                                ); ?>
                            >
                            <?php echo esc_html($label); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <label for="request_body_parts_custom">
                Genaue Körperstelle / Ergänzung
            </label>

            <input
                type="text"
                id="request_body_parts_custom"
                name="request_body_parts_custom"
                value="<?php echo esc_attr(
                    $_POST['request_body_parts_custom'] ?? ''
                ); ?>"
            >
        </div>

        <div class="tk-fixed-artist">
            <div class="tk-fixed-artist-label">Bevorzugter Tätowierer</div>
            <div class="tk-fixed-artist-value">Chris</div>
            <input
                type="hidden"
                name="request_preferred_artist"
                value="Chris"
            >
        </div>

        <p>
            <label for="request_desired_timeframe">
                Gewünschter Zeitraum *
            </label>

            <select
                id="request_desired_timeframe"
                name="request_desired_timeframe"
                required
            >
                <option value="">Bitte auswählen</option>
                <option value="so_schnell_wie_moeglich" <?php selected($current_timeframe, 'so_schnell_wie_moeglich'); ?>>So schnell wie möglich</option>
                <option value="innerhalb_1_monat" <?php selected($current_timeframe, 'innerhalb_1_monat'); ?>>Innerhalb eines Monats</option>
                <option value="innerhalb_2_monaten" <?php selected($current_timeframe, 'innerhalb_2_monaten'); ?>>Innerhalb von zwei Monaten</option>
                <option value="innerhalb_3_monaten" <?php selected($current_timeframe, 'innerhalb_3_monaten'); ?>>Innerhalb von drei Monaten</option>
                <option value="dieses_jahr" <?php selected($current_timeframe, 'dieses_jahr'); ?>>Noch in diesem Jahr</option>
                <option value="flexibel" <?php selected($current_timeframe, 'flexibel'); ?>>Zeitlich flexibel</option>
            </select>
        </p>

        <p>
            <label for="request_desired_timeframe_note">
                Zeitraum oder Wunschtermin (optional)
            </label>

            <input
                type="text"
                id="request_desired_timeframe_note"
                name="request_desired_timeframe_note"
                placeholder="z. B. Urlaub vom 10.08. bis 24.08. oder ab September möglich"
                value="<?php echo esc_attr(
                    $_POST['request_desired_timeframe_note'] ?? ''
                ); ?>"
            >
        </p>

        <p>
            <label for="request_customer_source">
                Wie bist du auf uns aufmerksam geworden?
            </label>

            <select
                id="request_customer_source"
                name="request_customer_source"
            >
                <option value="">Bitte auswählen</option>
                <option value="website" <?php selected($current_source, 'website'); ?>>Website</option>
                <option value="google" <?php selected($current_source, 'google'); ?>>Google</option>
                <option value="instagram" <?php selected($current_source, 'instagram'); ?>>Instagram</option>
                <option value="facebook" <?php selected($current_source, 'facebook'); ?>>Facebook</option>
                <option value="tiktok" <?php selected($current_source, 'tiktok'); ?>>TikTok</option>
                <option value="empfehlung" <?php selected($current_source, 'empfehlung'); ?>>Empfehlung</option>
                <option value="studio" <?php selected($current_source, 'studio'); ?>>Studio / vorbeigekommen</option>
                <option value="gutschein" <?php selected($current_source, 'gutschein'); ?>>Gutschein</option>
                <option value="sonstiges" <?php selected($current_source, 'sonstiges'); ?>>Sonstiges</option>
            </select>
        </p>

        <p>
            <label for="request_customer_notes">
                Bemerkungen / weitere Wünsche
            </label>

            <textarea
                id="request_customer_notes"
                name="request_customer_notes"
                rows="6"
            ><?php echo esc_textarea(
                $_POST['request_customer_notes'] ?? ''
            ); ?></textarea>
        </p>

        <p>
            <button
                type="submit"
                name="tattookunst_submit_request"
                value="1"
                class="tk-submit-button"
                id="tk-submit-button"
            >
                Anfrage senden
            </button>
        </p>

    </form>

    <?php endif; ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const contactOptions = document.querySelectorAll(
        'input[name="request_contact_method"]'
    );
    const telegramField = document.getElementById(
        'telegram-username-field'
    );
    const telegramInput = document.getElementById(
        'request_telegram_username'
    );
    const toggles = document.querySelectorAll('.tk-bodypart-toggle');
    const detailGroups = document.querySelectorAll('.tk-bodypart-details');
    const birthdayInput = document.getElementById('request_birthday');
    const imageInput = document.getElementById('request_images');
    const fileStatus = document.getElementById('tk-file-status');
    const filePreview = document.getElementById('tk-file-preview');
    const form = document.getElementById('tattookunst-request-form-fields');
    const submitButton = document.getElementById('tk-submit-button');

    function updateTelegramField() {
        const selected = document.querySelector(
            'input[name="request_contact_method"]:checked'
        );
        const telegramSelected =
            selected && selected.value === 'telegram';

        telegramField.style.display =
            telegramSelected ? 'block' : 'none';

        telegramInput.required = telegramSelected;

        if (!telegramSelected) {
            telegramInput.value = '';
        }
    }

    function updateBodypartGroups() {
        toggles.forEach(function (toggle) {
            const group = document.querySelector(
                '[data-bodypart-group="' + toggle.value + '"]'
            );

            if (!group) {
                return;
            }

            group.style.display = toggle.checked ? 'grid' : 'none';
        });
    }

    contactOptions.forEach(function (option) {
        option.addEventListener('change', updateTelegramField);
    });

    toggles.forEach(function (toggle) {
        toggle.addEventListener('change', updateBodypartGroups);
    });

    detailGroups.forEach(function (group) {
        const checkedDetail = group.querySelector(
            'input[name="request_body_parts[]"]:checked'
        );

        if (checkedDetail) {
            const groupName = group.getAttribute('data-bodypart-group');
            const matchingToggle = document.querySelector(
                '.tk-bodypart-toggle[value="' + groupName + '"]'
            );

            if (matchingToggle) {
                matchingToggle.checked = true;
            }
        }
    });

    if (birthdayInput) {
        birthdayInput.addEventListener('input', function () {
            const digits = birthdayInput.value
                .replace(/\D/g, '')
                .slice(0, 8);

            let formatted = digits;

            if (digits.length > 2) {
                formatted =
                    digits.slice(0, 2) + '.' + digits.slice(2);
            }

            if (digits.length > 4) {
                formatted =
                    digits.slice(0, 2) + '.' +
                    digits.slice(2, 4) + '.' +
                    digits.slice(4);
            }

            birthdayInput.value = formatted;
        });
    }

    if (imageInput && fileStatus && filePreview) {
        imageInput.addEventListener('change', function () {
            const files = Array.from(imageInput.files);
            const count = files.length;

            filePreview.innerHTML = '';

            if (count === 0) {
                fileStatus.textContent = '';
                return;
            }

            fileStatus.textContent = count === 1
                ? '1 Bild ausgewählt'
                : count + ' Bilder ausgewählt';

            files.forEach(function (file) {
                const card = document.createElement('div');
                card.className = 'tk-file-preview-card';

                const image = document.createElement('img');
                image.alt = file.name;

                const name = document.createElement('div');
                name.className = 'tk-file-preview-name';
                name.textContent = file.name;

                card.appendChild(image);
                card.appendChild(name);
                filePreview.appendChild(card);

                const reader = new FileReader();
                reader.addEventListener('load', function () {
                    image.src = reader.result;
                });
                reader.readAsDataURL(file);
            });
        });
    }

    if (form && submitButton) {
        form.addEventListener('submit', function () {
            submitButton.disabled = true;
            submitButton.textContent =
                'Anfrage und Bilder werden gesendet …';
        });
    }

    updateTelegramField();
    updateBodypartGroups();
});
</script>
