<?php

if (!defined('ABSPATH')) {
    exit;
}
?>

<style>
    .tk-booking {
        --tk-black: #171717;
        --tk-border: #dddddd;
        --tk-muted: #666666;
        max-width: 920px;
        margin: 30px auto;
        padding: 32px;
        background: #ffffff;
        border: 1px solid var(--tk-border);
        border-radius: 18px;
        box-sizing: border-box;
        color: var(--tk-black);
        font-family: inherit;
    }

    .tk-booking * {
        box-sizing: border-box;
    }

    .tk-booking h2 {
        margin: 0 0 28px;
        text-align: center;
        font-size: clamp(28px, 5vw, 42px);
        line-height: 1.15;
    }

    .tk-booking h3 {
        margin: 0 0 18px;
        font-size: 24px;
    }

    .tk-booking-step[hidden],
    .tk-piercing-list[hidden] {
        display: none !important;
    }

    .tk-booking-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .tk-booking-card,
    .tk-category-card,
    .tk-piercing-card {
        width: 100%;
        min-height: 92px;
        padding: 20px;
        border: 2px solid var(--tk-border);
        border-radius: 14px;
        background: #ffffff;
        color: var(--tk-black);
        text-align: left;
        cursor: pointer;
        transition: border-color .18s ease, transform .18s ease;
    }

    .tk-booking-card:hover,
    .tk-category-card:hover,
    .tk-piercing-card:hover,
    .tk-booking-card:focus-visible,
    .tk-category-card:focus-visible,
    .tk-piercing-card:focus-visible {
        border-color: var(--tk-black);
        transform: translateY(-2px);
        outline: none;
    }

    .tk-booking-card strong,
    .tk-category-card strong,
    .tk-piercing-card strong {
        display: block;
        font-size: 19px;
    }

    .tk-booking-card span,
    .tk-category-card span,
    .tk-piercing-card span {
        display: block;
        margin-top: 6px;
        color: var(--tk-muted);
        font-size: 15px;
    }

    .tk-category-list,
    .tk-piercing-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .tk-piercing-card.is-selected {
        border-color: var(--tk-black);
        background: #f7f7f7;
    }

    .tk-selection-summary {
        margin-top: 22px;
        padding: 20px;
        border: 1px solid var(--tk-border);
        border-radius: 14px;
        background: #f7f7f7;
    }

    .tk-selected-piercings {
        display: grid;
        gap: 10px;
        margin: 0 0 16px;
        padding: 0;
        list-style: none;
    }

    .tk-selected-piercing {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--tk-border);
    }

    .tk-selected-piercing:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .tk-selected-piercing-details strong,
    .tk-selected-piercing-details span {
        display: block;
    }

    .tk-selected-piercing-details span {
        margin-top: 3px;
        color: var(--tk-muted);
        font-size: 14px;
    }

    .tk-remove-piercing {
        flex: 0 0 auto;
        padding: 7px 10px;
        border: 1px solid var(--tk-black);
        border-radius: 8px;
        background: #ffffff;
        color: var(--tk-black);
        font: inherit;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
    }

    .tk-selection-total {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        padding-top: 14px;
        border-top: 2px solid var(--tk-black);
        font-size: 18px;
        font-weight: 700;
    }

    .tk-booking-actions {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-top: 24px;
    }

    .tk-button {
        min-height: 48px;
        padding: 12px 20px;
        border: 2px solid var(--tk-black);
        border-radius: 10px;
        background: var(--tk-black);
        color: #ffffff;
        font: inherit;
        font-weight: 700;
        cursor: pointer;
    }

    .tk-button-secondary {
        background: #ffffff;
        color: var(--tk-black);
    }

    .tk-button:disabled {
        opacity: .45;
        cursor: not-allowed;
    }

    .tk-appointment-days {
        display: grid;
        gap: 14px;
    }

    .tk-appointment-day {
        padding: 18px;
        border: 1px solid var(--tk-border);
        border-radius: 14px;
    }

    .tk-appointment-day h4 {
        margin: 0 0 12px;
        font-size: 18px;
    }

    .tk-slot-list {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
    }

    .tk-slot-button {
        min-height: 46px;
        padding: 10px;
        border: 2px solid var(--tk-border);
        border-radius: 10px;
        background: #ffffff;
        color: var(--tk-black);
        font: inherit;
        font-weight: 700;
        cursor: pointer;
    }

    .tk-slot-button:hover,
    .tk-slot-button:focus-visible,
    .tk-slot-button.is-selected {
        border-color: var(--tk-black);
        background: #f2f2f2;
        outline: none;
    }

    .tk-appointment-summary {
        margin-top: 18px;
        padding: 16px 18px;
        border-radius: 12px;
        background: #f7f7f7;
    }

    .tk-appointment-summary strong {
        display: block;
        margin-bottom: 4px;
    }

    .tk-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .tk-form-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .tk-form-field.tk-full-width {
        grid-column: 1 / -1;
    }

    .tk-form-field label {
        font-weight: 700;
    }

    .tk-form-field input {
        width: 100%;
        min-height: 50px;
        padding: 11px 13px;
        border: 2px solid var(--tk-border);
        border-radius: 10px;
        background: #ffffff;
        color: var(--tk-black);
        font: inherit;
    }

    .tk-form-field input:focus {
        border-color: var(--tk-black);
        outline: none;
    }

    .tk-birth-fields {
        display: grid;
        grid-template-columns: 72px 72px minmax(110px, 1fr);
        gap: 8px;
    }

    .tk-birth-fields input {
        text-align: center;
    }

    .tk-required-note {
        margin: -6px 0 20px;
        color: var(--tk-muted);
        font-size: 14px;
    }

    .tk-upload-box {
        padding: 22px;
        border: 2px dashed var(--tk-border);
        border-radius: 14px;
        background: #fafafa;
    }

    .tk-upload-box p {
        margin: 0 0 16px;
        color: var(--tk-muted);
        line-height: 1.55;
    }

    .tk-upload-input {
        display: block;
        width: 100%;
        padding: 12px;
        border: 1px solid var(--tk-border);
        border-radius: 10px;
        background: #ffffff;
        font: inherit;
    }

    .tk-upload-note {
        margin-top: 10px !important;
        font-size: 13px;
    }

    .tk-upload-previews {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-top: 18px;
    }

    .tk-upload-preview {
        position: relative;
        overflow: hidden;
        border: 1px solid var(--tk-border);
        border-radius: 12px;
        background: #ffffff;
    }

    .tk-upload-preview img {
        display: block;
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
    }

    .tk-upload-preview-info {
        padding: 9px 10px;
        font-size: 13px;
        overflow-wrap: anywhere;
    }

    .tk-remove-image {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 34px;
        height: 34px;
        border: 0;
        border-radius: 50%;
        background: rgba(23, 23, 23, .88);
        color: #ffffff;
        font: inherit;
        font-size: 20px;
        line-height: 1;
        cursor: pointer;
    }

    .tk-upload-error {
        margin: 12px 0 0;
        color: #a40000;
        font-weight: 700;
    }


    .tk-health-intro {
        margin: 0 0 22px;
        padding: 18px;
        border-radius: 12px;
        background: #f7f7f7;
        line-height: 1.6;
    }

    .tk-health-list {
        display: grid;
        gap: 16px;
    }

    .tk-health-question {
        padding: 20px;
        border: 1px solid var(--tk-border);
        border-radius: 14px;
    }

    .tk-health-question legend {
        width: 100%;
        margin-bottom: 14px;
        padding: 0;
        font-weight: 700;
        line-height: 1.45;
    }

    .tk-health-options {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .tk-health-option {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 44px;
        padding: 9px 14px;
        border: 2px solid var(--tk-border);
        border-radius: 10px;
        cursor: pointer;
    }

    .tk-health-option:has(input:checked) {
        border-color: var(--tk-black);
        background: #f2f2f2;
    }

    .tk-health-option input {
        margin: 0;
    }

    .tk-health-details {
        margin-top: 14px;
    }

    .tk-health-details label {
        display: block;
        margin-bottom: 7px;
        font-weight: 700;
    }

    .tk-health-details textarea {
        width: 100%;
        min-height: 110px;
        padding: 11px 13px;
        border: 2px solid var(--tk-border);
        border-radius: 10px;
        background: #ffffff;
        color: var(--tk-black);
        font: inherit;
        resize: vertical;
    }

    .tk-health-details textarea:focus {
        border-color: var(--tk-black);
        outline: none;
    }

    .tk-health-review-note {
        margin: 14px 0 0;
        padding: 14px 16px;
        border: 1px solid #b58a00;
        border-radius: 10px;
        background: #fff8db;
        line-height: 1.55;
    }

    .tk-placeholder {
        padding: 24px;
        border: 1px dashed #aaaaaa;
        border-radius: 14px;
        text-align: center;
    }

    @media (max-width: 650px) {
        .tk-booking {
            margin: 0;
            padding: 22px 15px 28px;
            border-left: 0;
            border-right: 0;
            border-radius: 0;
        }

        .tk-booking-grid,
        .tk-category-list,
        .tk-piercing-list,
        .tk-form-grid {
            grid-template-columns: 1fr;
        }

        .tk-form-field.tk-full-width {
            grid-column: auto;
        }

        .tk-slot-list {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .tk-upload-previews {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .tk-selection-summary dl {
            grid-template-columns: 1fr;
            gap: 4px;
        }

        .tk-selection-summary dd {
            margin-bottom: 10px;
        }
    }
</style>

<div class="tk-booking" id="tk-booking-app">
    <h2>Piercing &amp; Tattoo-Beratung</h2>

    <section class="tk-booking-step" data-step="start">
        <div class="tk-booking-grid">
            <button type="button" class="tk-booking-card" data-service="piercing">
                <strong>Piercing</strong>
                <span>Piercing auswählen und anschließend Termin buchen</span>
            </button>

            <button type="button" class="tk-booking-card" data-service="tattoo-consultation">
                <strong>Tattoo-Beratung</strong>
                <span>Beratungstermin für dein Tattoo-Projekt buchen</span>
            </button>
        </div>
    </section>

    <section class="tk-booking-step" data-step="categories" hidden>
        <h3>Piercing-Kategorie auswählen</h3>

        <div class="tk-category-list">
            <?php foreach ($piercing_categories as $category_key => $category): ?>
                <button
                    type="button"
                    class="tk-category-card"
                    data-category="<?php echo esc_attr($category_key); ?>"
                >
                    <strong><?php echo esc_html($category['label']); ?></strong>
                    <span><?php echo esc_html(count($category['items'])); ?> Auswahlmöglichkeiten</span>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="tk-booking-actions">
            <button type="button" class="tk-button tk-button-secondary" data-back="start">
                Zurück
            </button>
        </div>
    </section>

    <section class="tk-booking-step" data-step="piercings" hidden>
        <h3 id="tk-category-heading">Piercing auswählen</h3>

        <?php foreach ($piercing_categories as $category_key => $category): ?>
            <div class="tk-piercing-list" data-piercing-list="<?php echo esc_attr($category_key); ?>" hidden>
                <?php foreach ($category['items'] as $item): ?>
                    <button
                        type="button"
                        class="tk-piercing-card"
                        data-name="<?php echo esc_attr($item['name']); ?>"
                        data-category-label="<?php echo esc_attr($category['label']); ?>"
                        data-body-location="<?php echo esc_attr($category['body_location']); ?>"
                        data-price="<?php echo esc_attr($item['price']); ?>"
                    >
                        <strong><?php echo esc_html($item['name']); ?></strong>
                        <span><?php echo esc_html(number_format_i18n($item['price'], 0)); ?> €</span>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <div class="tk-selection-summary" id="tk-selection-summary" hidden>
            <h4>Ausgewählte Piercings</h4>
            <ul class="tk-selected-piercings" id="tk-selected-piercings"></ul>
            <div class="tk-selection-total">
                <span>Gesamtpreis</span>
                <span id="tk-summary-total">0 €</span>
            </div>
        </div>

        <div class="tk-booking-actions">
            <button type="button" class="tk-button tk-button-secondary" id="tk-add-another-piercing">
                Weiteres Piercing hinzufügen
            </button>

            <button type="button" class="tk-button" id="tk-next-appointment" disabled>
                Weiter zur Terminauswahl
            </button>
        </div>
    </section>

    <section class="tk-booking-step" data-step="tattoo-consultation" hidden>
        <div class="tk-placeholder">
            <h3>Tattoo-Beratung</h3>
            <p>Der Ablauf für die Tattoo-Beratung wird im nächsten Entwicklungsschritt ergänzt.</p>
        </div>

        <div class="tk-booking-actions">
            <button type="button" class="tk-button tk-button-secondary" data-back="start">
                Zurück
            </button>
        </div>
    </section>

    <section class="tk-booking-step" data-step="appointments" hidden>
        <h3>Termin auswählen</h3>
        <p>Wähle einen Termin von Dienstag bis Freitag zwischen 16:00 und 18:00 Uhr.</p>

        <div class="tk-appointment-days">
            <?php foreach ($appointment_days as $appointment_day): ?>
                <div class="tk-appointment-day">
                    <h4><?php echo esc_html($appointment_day['weekday'] . ', ' . $appointment_day['label']); ?></h4>

                    <div class="tk-slot-list">
                        <?php foreach ($appointment_day['slots'] as $slot): ?>
                            <button
                                type="button"
                                class="tk-slot-button"
                                data-slot-value="<?php echo esc_attr($slot['value']); ?>"
                                data-slot-label="<?php echo esc_attr($appointment_day['weekday'] . ', ' . $appointment_day['label'] . ' um ' . $slot['time'] . ' Uhr'); ?>"
                            >
                                <?php echo esc_html($slot['time']); ?> Uhr
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="tk-appointment-summary" id="tk-appointment-summary" hidden>
            <strong>Ausgewählter Termin</strong>
            <span id="tk-appointment-label">–</span>
        </div>

        <input type="hidden" id="tk-selected-appointment" value="">

        <div class="tk-booking-actions">
            <button type="button" class="tk-button tk-button-secondary" data-back="piercings">
                Zurück
            </button>

            <button type="button" class="tk-button" id="tk-next-customer" disabled>
                Weiter zu den Kundendaten
            </button>
        </div>
    </section>

    <section class="tk-booking-step" data-step="customer" hidden>
        <h3>Persönliche Daten</h3>
        <p class="tk-required-note">Alle mit * gekennzeichneten Felder sind Pflichtfelder.</p>

        <form id="tk-customer-form" novalidate>
            <div class="tk-form-grid">
                <div class="tk-form-field">
                    <label for="tk-first-name">Vorname *</label>
                    <input id="tk-first-name" name="first_name" type="text" autocomplete="given-name" required>
                </div>

                <div class="tk-form-field">
                    <label for="tk-last-name">Nachname *</label>
                    <input id="tk-last-name" name="last_name" type="text" autocomplete="family-name" required>
                </div>

                <div class="tk-form-field">
                    <label for="tk-birth-day">Geburtsdatum *</label>
                    <div class="tk-birth-fields" aria-label="Geburtsdatum">
                        <input id="tk-birth-day" name="birth_day" type="text" inputmode="numeric" autocomplete="bday-day" maxlength="2" pattern="[0-9]{1,2}" placeholder="TT" aria-label="Tag" required>
                        <input id="tk-birth-month" name="birth_month" type="text" inputmode="numeric" autocomplete="bday-month" maxlength="2" pattern="[0-9]{1,2}" placeholder="MM" aria-label="Monat" required>
                        <input id="tk-birth-year" name="birth_year" type="text" inputmode="numeric" autocomplete="bday-year" maxlength="4" pattern="[0-9]{4}" placeholder="JJJJ" aria-label="Jahr" required>
                    </div>
                    <input id="tk-birth-date" name="birth_date" type="hidden" value="">
                </div>

                <div class="tk-form-field">
                    <label for="tk-mobile">Mobilnummer *</label>
                    <input id="tk-mobile" name="mobile" type="tel" autocomplete="tel" inputmode="tel" required>
                </div>

                <div class="tk-form-field tk-full-width">
                    <label for="tk-email">E-Mail-Adresse *</label>
                    <input id="tk-email" name="email" type="email" autocomplete="email" inputmode="email" required>
                </div>
            </div>

            <div class="tk-form-field tk-full-width">
    <label for="tk-email-confirmation">E-Mail-Adresse wiederholen *</label>
    <input
        id="tk-email-confirmation"
        name="email_confirmation"
        type="email"
        autocomplete="email"
        inputmode="email"
        required
    >
</div>

            <div class="tk-booking-actions">
                <button type="button" class="tk-button tk-button-secondary" data-back="appointments">
                    Zurück
                </button>

                <button type="submit" class="tk-button">
                    Weiter zu den Bildern
                </button>
            </div>
        </form>
    </section>

    <section class="tk-booking-step" data-step="uploads" hidden>
        <h3>Bilder hochladen (optional)</h3>

        <div class="tk-upload-box">
            <p>Falls die zu piercende Stelle bereits Schmuck enthält oder du uns etwas zeigen möchtest, kannst du hier ein oder mehrere Bilder hochladen.</p>

            <input
                class="tk-upload-input"
                id="tk-image-upload"
                name="piercing_images[]"
                type="file"
                accept="image/jpeg,image/png,image/webp"
                multiple
            >

            <p class="tk-upload-note">Erlaubt sind JPG, PNG und WebP. Maximal 10 MB pro Bild.</p>
            <p class="tk-upload-error" id="tk-upload-error" hidden></p>

            <div class="tk-upload-previews" id="tk-upload-previews" hidden></div>
        </div>

        <div class="tk-booking-actions">
            <button type="button" class="tk-button tk-button-secondary" data-back="customer">
                Zurück
            </button>

            <button type="button" class="tk-button" id="tk-next-health">
                Weiter zu den Gesundheitsfragen
            </button>
        </div>
    </section>

    <section class="tk-booking-step" data-step="health" hidden>
        <h3>Gesundheitsfragen</h3>
        <p class="tk-health-intro">Bitte beantworte die folgenden Fragen wahrheitsgemäß. Sie dienen deiner Sicherheit und helfen uns, das Piercing verantwortungsvoll durchzuführen.</p>
        <p class="tk-required-note">Alle Ja/Nein-Fragen sind Pflichtfelder. Die zusätzlichen Beschreibungsfelder sind optional.</p>

        <form id="tk-health-form" novalidate>
            <div class="tk-health-list">
                <fieldset class="tk-health-question" data-health-question>
                    <legend>Nimmst du blutverdünnende Medikamente ein? *</legend>
                    <div class="tk-health-options">
                        <label class="tk-health-option">
                            <input type="radio" name="health_blood_thinners" value="yes" required>
                            <span>Ja</span>
                        </label>
                        <label class="tk-health-option">
                            <input type="radio" name="health_blood_thinners" value="no" required>
                            <span>Nein</span>
                        </label>
                    </div>
                    <div class="tk-health-details" hidden>
                        <label for="tk-health-blood_thinners">Bitte beschreibe das kurz (optional).</label>
                        <textarea id="tk-health-blood_thinners" name="health_blood_thinners_details"></textarea>
                    </div>
                </fieldset>

                <fieldset class="tk-health-question" data-health-question>
                    <legend>Bestehen Allergien? *</legend>
                    <div class="tk-health-options">
                        <label class="tk-health-option">
                            <input type="radio" name="health_allergies" value="yes" required>
                            <span>Ja</span>
                        </label>
                        <label class="tk-health-option">
                            <input type="radio" name="health_allergies" value="no" required>
                            <span>Nein</span>
                        </label>
                    </div>
                    <div class="tk-health-details" hidden>
                        <label for="tk-health-allergies">Bitte beschreibe das kurz (optional).</label>
                        <textarea id="tk-health-allergies" name="health_allergies_details"></textarea>
                    </div>
                </fieldset>

                <fieldset class="tk-health-question" data-health-question>
                    <legend>Besteht Diabetes? *</legend>
                    <div class="tk-health-options">
                        <label class="tk-health-option">
                            <input type="radio" name="health_diabetes" value="yes" required>
                            <span>Ja</span>
                        </label>
                        <label class="tk-health-option">
                            <input type="radio" name="health_diabetes" value="no" required>
                            <span>Nein</span>
                        </label>
                    </div>
                    <div class="tk-health-details" hidden>
                        <label for="tk-health-diabetes">Bitte beschreibe das kurz (optional).</label>
                        <textarea id="tk-health-diabetes" name="health_diabetes_details"></textarea>
                    </div>
                </fieldset>

                <fieldset class="tk-health-question" data-health-question>
                    <legend>Bestehen Infektionskrankheiten? *</legend>
                    <div class="tk-health-options">
                        <label class="tk-health-option">
                            <input type="radio" name="health_infectious_diseases" value="yes" required>
                            <span>Ja</span>
                        </label>
                        <label class="tk-health-option">
                            <input type="radio" name="health_infectious_diseases" value="no" required>
                            <span>Nein</span>
                        </label>
                    </div>
                    <div class="tk-health-details" hidden>
                        <label for="tk-health-infectious_diseases">Bitte beschreibe das kurz (optional).</label>
                        <textarea id="tk-health-infectious_diseases" name="health_infectious_diseases_details"></textarea>
                        <p class="tk-health-review-note"><strong>Hinweis:</strong> Deine Angaben werden vor dem Termin vom Studio geprüft. Je nach den gesundheitlichen Voraussetzungen kann eine Behandlung nur nach individueller Prüfung erfolgen oder abgelehnt werden.</p>
                    </div>
                </fieldset>

                <fieldset class="tk-health-question" data-health-question>
                    <legend>Besteht eine Blutgerinnungsstörung oder eine erhöhte Blutungsneigung? *</legend>
                    <div class="tk-health-options">
                        <label class="tk-health-option">
                            <input type="radio" name="health_blood_clotting" value="yes" required>
                            <span>Ja</span>
                        </label>
                        <label class="tk-health-option">
                            <input type="radio" name="health_blood_clotting" value="no" required>
                            <span>Nein</span>
                        </label>
                    </div>
                    <div class="tk-health-details" hidden>
                        <label for="tk-health-blood_clotting">Bitte beschreibe das kurz (optional).</label>
                        <textarea id="tk-health-blood_clotting" name="health_blood_clotting_details"></textarea>
                    </div>
                </fieldset>

                <fieldset class="tk-health-question" data-health-question>
                    <legend>Besteht Epilepsie oder kam es bereits zu epileptischen Anfällen? *</legend>
                    <div class="tk-health-options">
                        <label class="tk-health-option">
                            <input type="radio" name="health_epilepsy" value="yes" required>
                            <span>Ja</span>
                        </label>
                        <label class="tk-health-option">
                            <input type="radio" name="health_epilepsy" value="no" required>
                            <span>Nein</span>
                        </label>
                    </div>
                    <div class="tk-health-details" hidden>
                        <label for="tk-health-epilepsy">Bitte beschreibe das kurz (optional).</label>
                        <textarea id="tk-health-epilepsy" name="health_epilepsy_details"></textarea>
                    </div>
                </fieldset>

                <fieldset class="tk-health-question" data-health-question>
                    <legend>Besteht eine Schwangerschaft oder wird derzeit gestillt? *</legend>
                    <div class="tk-health-options">
                        <label class="tk-health-option">
                            <input type="radio" name="health_pregnancy_breastfeeding" value="yes" required>
                            <span>Ja</span>
                        </label>
                        <label class="tk-health-option">
                            <input type="radio" name="health_pregnancy_breastfeeding" value="no" required>
                            <span>Nein</span>
                        </label>
                    </div>
                    <div class="tk-health-details" hidden>
                        <label for="tk-health-pregnancy_breastfeeding">Bitte beschreibe das kurz (optional).</label>
                        <textarea id="tk-health-pregnancy_breastfeeding" name="health_pregnancy_breastfeeding_details"></textarea>
                    </div>
                </fieldset>

                <fieldset class="tk-health-question" data-health-question>
                    <legend>Gab es bei früheren Piercings Probleme? *</legend>
                    <div class="tk-health-options">
                        <label class="tk-health-option">
                            <input type="radio" name="health_previous_piercing_problems" value="yes" required>
                            <span>Ja</span>
                        </label>
                        <label class="tk-health-option">
                            <input type="radio" name="health_previous_piercing_problems" value="no" required>
                            <span>Nein</span>
                        </label>
                    </div>
                    <div class="tk-health-details" hidden>
                        <label for="tk-health-previous_piercing_problems">Bitte beschreibe das kurz (optional).</label>
                        <textarea id="tk-health-previous_piercing_problems" name="health_previous_piercing_problems_details"></textarea>
                    </div>
                </fieldset>

                <fieldset class="tk-health-question" data-health-question>
                    <legend>Bestehen sonstige gesundheitliche Hinweise, die für das Piercing wichtig sein könnten? *</legend>
                    <div class="tk-health-options">
                        <label class="tk-health-option">
                            <input type="radio" name="health_other_health_issues" value="yes" required>
                            <span>Ja</span>
                        </label>
                        <label class="tk-health-option">
                            <input type="radio" name="health_other_health_issues" value="no" required>
                            <span>Nein</span>
                        </label>
                    </div>
                    <div class="tk-health-details" hidden>
                        <label for="tk-health-other_health_issues">Bitte beschreibe das kurz (optional).</label>
                        <textarea id="tk-health-other_health_issues" name="health_other_health_issues_details"></textarea>
                    </div>
                </fieldset>
            </div>

            <div class="tk-booking-actions">
                <button type="button" class="tk-button tk-button-secondary" data-back="uploads">
                    Zurück
                </button>

                <button type="submit" class="tk-button">
                    Weiter zur Einverständniserklärung
                </button>
            </div>
        </form>
    </section>

    <section class="tk-booking-step" data-step="consent-placeholder" hidden>
        <div class="tk-placeholder">
            <h3>Einverständniserklärung</h3>
            <p>Die Einverständniserklärung wird im nächsten Entwicklungsschritt ergänzt.</p>
        </div>

        <div class="tk-booking-actions">
            <button type="button" class="tk-button tk-button-secondary" data-back="health">
                Zurück
            </button>
        </div>
    </section>
</div>

<script>
(function () {
    const app = document.getElementById('tk-booking-app');

    if (!app) {
        return;
    }

    const steps = app.querySelectorAll('[data-step]');
    const categoryHeading = app.querySelector('#tk-category-heading');
    const summary = app.querySelector('#tk-selection-summary');
    const selectedPiercingsList = app.querySelector('#tk-selected-piercings');
    const summaryTotal = app.querySelector('#tk-summary-total');
    const addAnotherPiercingButton = app.querySelector('#tk-add-another-piercing');
    const nextButton = app.querySelector('#tk-next-appointment');
    const selectedPiercings = [];
    let selectedPiercingId = 0;
    const nextCustomerButton = app.querySelector('#tk-next-customer');
    const appointmentSummary = app.querySelector('#tk-appointment-summary');
    const appointmentLabel = app.querySelector('#tk-appointment-label');
    const selectedAppointment = app.querySelector('#tk-selected-appointment');
    const customerForm = app.querySelector('#tk-customer-form');
    const birthDay = app.querySelector('#tk-birth-day');
    const birthMonth = app.querySelector('#tk-birth-month');
    const birthYear = app.querySelector('#tk-birth-year');
    const birthDate = app.querySelector('#tk-birth-date');
    const imageUpload = app.querySelector('#tk-image-upload');
    const uploadPreviews = app.querySelector('#tk-upload-previews');
    const uploadError = app.querySelector('#tk-upload-error');
    const nextHealthButton = app.querySelector('#tk-next-health');
    const healthForm = app.querySelector('#tk-health-form');
    const healthQuestions = app.querySelectorAll('[data-health-question]');
    const selectedImages = new DataTransfer();
    const allowedImageTypes = ['image/jpeg', 'image/png', 'image/webp'];
    const maxImageSize = 10 * 1024 * 1024;

    function showStep(stepName) {
        steps.forEach(function (step) {
            step.hidden = step.dataset.step !== stepName;
        });

        app.scrollIntoView({behavior: 'smooth', block: 'start'});
    }

    app.querySelectorAll('[data-service]').forEach(function (button) {
        button.addEventListener('click', function () {
            if (button.dataset.service === 'piercing') {
                showStep('categories');
            } else {
                showStep('tattoo-consultation');
            }
        });
    });

    app.querySelectorAll('[data-category]').forEach(function (button) {
        button.addEventListener('click', function () {
            const category = button.dataset.category;

            app.querySelectorAll('[data-piercing-list]').forEach(function (list) {
                list.hidden = list.dataset.piercingList !== category;
            });

            categoryHeading.textContent = button.querySelector('strong').textContent;
            updateSelectionSummary();
            showStep('piercings');
        });
    });

    function getPiercingKey(button) {
        return [
            button.dataset.categoryLabel,
            button.dataset.name,
            button.dataset.price
        ].join('|');
    }

    function updatePiercingCardStates() {
        const selectedKeys = new Set(
            selectedPiercings.map(function (piercing) {
                return piercing.key;
            })
        );

        app.querySelectorAll('.tk-piercing-card').forEach(function (card) {
            card.classList.toggle('is-selected', selectedKeys.has(getPiercingKey(card)));
        });
    }

    function updateSelectionSummary() {
        selectedPiercingsList.innerHTML = '';
        let total = 0;

        selectedPiercings.forEach(function (piercing) {
            total += piercing.price;

            const item = document.createElement('li');
            item.className = 'tk-selected-piercing';

            const details = document.createElement('div');
            details.className = 'tk-selected-piercing-details';

            const name = document.createElement('strong');
            name.textContent = piercing.name + ' – ' + piercing.price + ' €';

            const meta = document.createElement('span');
            meta.textContent = piercing.category + ' · ' + piercing.bodyLocation;

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'tk-remove-piercing';
            removeButton.textContent = 'Entfernen';
            removeButton.addEventListener('click', function () {
                const piercingIndex = selectedPiercings.findIndex(function (selectedPiercing) {
                    return selectedPiercing.id === piercing.id;
                });

                if (piercingIndex !== -1) {
                    selectedPiercings.splice(piercingIndex, 1);
                }

                updatePiercingCardStates();
                updateSelectionSummary();
            });

            details.appendChild(name);
            details.appendChild(meta);
            item.appendChild(details);
            item.appendChild(removeButton);
            selectedPiercingsList.appendChild(item);
        });

        summaryTotal.textContent = total + ' €';
        summary.hidden = selectedPiercings.length === 0;
        nextButton.disabled = selectedPiercings.length === 0;
    }

    app.querySelectorAll('.tk-piercing-card').forEach(function (button) {
        button.addEventListener('click', function () {
            selectedPiercingId += 1;

            selectedPiercings.push({
                id: selectedPiercingId,
                key: getPiercingKey(button),
                name: button.dataset.name,
                category: button.dataset.categoryLabel,
                bodyLocation: button.dataset.bodyLocation,
                price: Number(button.dataset.price)
            });

            updatePiercingCardStates();
            updateSelectionSummary();
        });
    });

    addAnotherPiercingButton.addEventListener('click', function () {
        showStep('categories');
    });

    app.querySelectorAll('[data-back]').forEach(function (button) {
        button.addEventListener('click', function () {
            showStep(button.dataset.back);
        });
    });

    nextButton.addEventListener('click', function () {
        if (!nextButton.disabled) {
            showStep('appointments');
        }
    });

    app.querySelectorAll('.tk-slot-button').forEach(function (button) {
        button.addEventListener('click', function () {
            app.querySelectorAll('.tk-slot-button').forEach(function (slotButton) {
                slotButton.classList.remove('is-selected');
            });

            button.classList.add('is-selected');
            selectedAppointment.value = button.dataset.slotValue;
            appointmentLabel.textContent = button.dataset.slotLabel;
            appointmentSummary.hidden = false;
            nextCustomerButton.disabled = false;
        });
    });

    nextCustomerButton.addEventListener('click', function () {
        if (!nextCustomerButton.disabled) {
            showStep('customer');
        }
    });

    function keepDigitsOnly(input, maxLength) {
        input.value = input.value.replace(/\D/g, '').slice(0, maxLength);
    }

    birthDay.addEventListener('input', function () {
        keepDigitsOnly(birthDay, 2);
        birthDay.setCustomValidity('');

        if (birthDay.value.length === 2) {
            birthMonth.focus();
            birthMonth.select();
        }
    });

    birthMonth.addEventListener('input', function () {
        keepDigitsOnly(birthMonth, 2);
        birthMonth.setCustomValidity('');

        if (birthMonth.value.length === 2) {
            birthYear.focus();
            birthYear.select();
        }
    });

    birthYear.addEventListener('input', function () {
        keepDigitsOnly(birthYear, 4);
        birthYear.setCustomValidity('');
    });

    birthMonth.addEventListener('keydown', function (event) {
        if (event.key === 'Backspace' && birthMonth.value === '') {
            birthDay.focus();
        }
    });

    birthYear.addEventListener('keydown', function (event) {
        if (event.key === 'Backspace' && birthYear.value === '') {
            birthMonth.focus();
        }
    });

    function validateBirthDate() {
        const day = Number(birthDay.value);
        const month = Number(birthMonth.value);
        const year = Number(birthYear.value);
        const today = new Date();
        const enteredDate = new Date(year, month - 1, day);

        birthDay.setCustomValidity('');
        birthMonth.setCustomValidity('');
        birthYear.setCustomValidity('');

        const isRealDate =
            birthDay.value.length >= 1 &&
            birthMonth.value.length >= 1 &&
            birthYear.value.length === 4 &&
            enteredDate.getFullYear() === year &&
            enteredDate.getMonth() === month - 1 &&
            enteredDate.getDate() === day;

        if (!isRealDate) {
            birthDay.setCustomValidity('Bitte gib ein gültiges Geburtsdatum ein.');
            birthDay.reportValidity();
            return false;
        }

        today.setHours(23, 59, 59, 999);
        if (enteredDate > today) {
            birthDay.setCustomValidity('Das Geburtsdatum darf nicht in der Zukunft liegen.');
            birthDay.reportValidity();
            return false;
        }

        birthDate.value = [
            String(year).padStart(4, '0'),
            String(month).padStart(2, '0'),
            String(day).padStart(2, '0')
        ].join('-');

        return true;
    }

    customerForm.addEventListener('submit', function (event) {
        event.preventDefault();

        if (!customerForm.checkValidity()) {
            customerForm.reportValidity();
            return;
        }

        if (!validateBirthDate()) {
            return;
        }

        showStep('uploads');
    });

    function showUploadError(message) {
        uploadError.textContent = message;
        uploadError.hidden = !message;
    }

    function fileKey(file) {
        return [file.name, file.size, file.lastModified].join('|');
    }

    function syncImageInput() {
        imageUpload.files = selectedImages.files;
    }

    function renderImagePreviews() {
        uploadPreviews.innerHTML = '';
        uploadPreviews.hidden = selectedImages.files.length === 0;

        Array.from(selectedImages.files).forEach(function (file, index) {
            const preview = document.createElement('div');
            preview.className = 'tk-upload-preview';

            const image = document.createElement('img');
            image.alt = 'Vorschau: ' + file.name;

            const reader = new FileReader();
            reader.addEventListener('load', function () {
                image.src = reader.result;
            });
            reader.readAsDataURL(file);

            const info = document.createElement('div');
            info.className = 'tk-upload-preview-info';
            info.textContent = file.name;

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'tk-remove-image';
            removeButton.setAttribute('aria-label', file.name + ' entfernen');
            removeButton.textContent = '×';
            removeButton.addEventListener('click', function () {
                const remainingFiles = Array.from(selectedImages.files).filter(function (_, fileIndex) {
                    return fileIndex !== index;
                });

                const replacement = new DataTransfer();
                remainingFiles.forEach(function (remainingFile) {
                    replacement.items.add(remainingFile);
                });

                selectedImages.items.clear();
                Array.from(replacement.files).forEach(function (remainingFile) {
                    selectedImages.items.add(remainingFile);
                });

                syncImageInput();
                renderImagePreviews();
            });

            preview.appendChild(image);
            preview.appendChild(removeButton);
            preview.appendChild(info);
            uploadPreviews.appendChild(preview);
        });
    }

    imageUpload.addEventListener('change', function () {
        showUploadError('');

        const existingKeys = new Set(
            Array.from(selectedImages.files).map(fileKey)
        );

        Array.from(imageUpload.files).forEach(function (file) {
            if (!allowedImageTypes.includes(file.type)) {
                showUploadError('Bitte lade nur JPG-, PNG- oder WebP-Bilder hoch.');
                return;
            }

            if (file.size > maxImageSize) {
                showUploadError('Das Bild „' + file.name + '“ ist größer als 10 MB.');
                return;
            }

            if (!existingKeys.has(fileKey(file))) {
                selectedImages.items.add(file);
                existingKeys.add(fileKey(file));
            }
        });

        syncImageInput();
        renderImagePreviews();
    });

    nextHealthButton.addEventListener('click', function () {
        showStep('health');
    });

    healthQuestions.forEach(function (question) {
        const radios = question.querySelectorAll('input[type="radio"]');
        const details = question.querySelector('.tk-health-details');
        const textarea = question.querySelector('textarea');

        radios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                const showDetails = radio.checked && radio.value === 'yes';

                details.hidden = !showDetails;
                textarea.required = false;

                if (!showDetails) {
                    textarea.value = '';
                    textarea.setCustomValidity('');
                }
            });
        });
    });

    healthForm.addEventListener('submit', function (event) {
        event.preventDefault();

        if (!healthForm.checkValidity()) {
            healthForm.reportValidity();
            return;
        }

        showStep('consent-placeholder');
    });
}());
</script>
