(function () {
    'use strict';

    function initConsentStep() {
        const app = document.getElementById('tk-booking-app');

        if (!app || app.dataset.consentInitialized === 'true') {
            return;
        }

        const step = app.querySelector('[data-step="consent-placeholder"]');

        if (!step) {
            return;
        }

        app.dataset.consentInitialized = 'true';
        const style = document.createElement('style');
        style.textContent = `
            .tk-consent-intro {
                margin: 0 0 20px;
                padding: 18px;
                border-radius: 12px;
                background: #f7f7f7;
                line-height: 1.6;
            }

            .tk-consent-document {
                max-height: 520px;
                overflow-y: auto;
                padding: 22px;
                border: 1px solid var(--tk-border);
                border-radius: 14px;
                background: #fff;
                line-height: 1.65;
                overscroll-behavior: contain;
            }

            .tk-consent-document h4 {
                margin: 24px 0 8px;
                font-size: 19px;
            }

            .tk-consent-document h4:first-child {
                margin-top: 0;
            }

            .tk-consent-document p {
                margin: 0 0 12px;
            }

            .tk-consent-document ul {
                margin: 8px 0 16px;
                padding-left: 22px;
            }

            .tk-consent-document li {
                margin-bottom: 8px;
            }

            .tk-consent-checks {
                display: grid;
                gap: 12px;
                margin-top: 18px;
            }

            .tk-consent-check {
                display: flex;
                align-items: flex-start;
                gap: 11px;
                padding: 16px;
                border: 2px solid var(--tk-border);
                border-radius: 12px;
                line-height: 1.55;
                cursor: pointer;
            }

            .tk-consent-check:has(input:checked) {
                border-color: var(--tk-black);
                background: #f7f7f7;
            }

            .tk-consent-check input {
                flex: 0 0 auto;
                width: 20px;
                height: 20px;
                margin: 2px 0 0;
            }

            .tk-signature-block {
                margin-top: 22px;
                padding: 20px;
                border: 1px solid var(--tk-border);
                border-radius: 14px;
            }

            .tk-signature-block h4 {
                margin: 0 0 6px;
                font-size: 19px;
            }

            .tk-signature-note {
                margin: 0 0 14px;
                color: var(--tk-muted);
                font-size: 14px;
            }

            .tk-signature-canvas-wrap {
                position: relative;
                width: 100%;
                min-height: 190px;
                overflow: hidden;
                border: 2px solid var(--tk-border);
                border-radius: 12px;
                background: #fff;
                touch-action: none;
            }

            .tk-signature-canvas {
                display: block;
                width: 100%;
                height: 190px;
                cursor: crosshair;
                touch-action: none;
            }

            .tk-signature-line {
                position: absolute;
                left: 8%;
                right: 8%;
                bottom: 38px;
                border-top: 1px solid #999;
                pointer-events: none;
            }

            .tk-signature-caption {
                position: absolute;
                left: 8%;
                bottom: 12px;
                color: var(--tk-muted);
                font-size: 12px;
                pointer-events: none;
            }

            .tk-signature-actions {
                display: flex;
                justify-content: flex-end;
                margin-top: 10px;
            }

            .tk-signature-clear {
                padding: 8px 12px;
                border: 1px solid var(--tk-black);
                border-radius: 8px;
                background: #fff;
                color: var(--tk-black);
                font: inherit;
                font-weight: 700;
                cursor: pointer;
            }

            .tk-minor-notice {
                margin-top: 22px;
                padding: 18px;
                border: 2px solid #d5a900;
                border-radius: 14px;
                background: #fff7c7;
                color: #3b3100;
                line-height: 1.6;
            }

            .tk-minor-notice strong {
                display: block;
                margin-bottom: 7px;
                font-size: 18px;
            }

            .tk-guardian-block {
                margin-top: 18px;
                padding: 20px;
                border: 1px solid var(--tk-border);
                border-radius: 14px;
                background: #fafafa;
            }

            .tk-guardian-block h4 {
                margin: 0 0 14px;
                font-size: 19px;
            }

            .tk-guardian-fields {
                display: grid;
                grid-template-columns: 2fr 1fr;
                gap: 14px;
                margin-bottom: 16px;
            }

            .tk-guardian-fields label {
                display: grid;
                gap: 7px;
                font-weight: 700;
            }

            .tk-guardian-fields input,
            .tk-guardian-fields select {
                width: 100%;
                min-height: 46px;
                padding: 10px 12px;
                border: 1px solid var(--tk-border);
                border-radius: 9px;
                background: #fff;
                color: inherit;
                font: inherit;
            }

            .tk-guardian-consent {
                margin-bottom: 18px;
            }

            .tk-consent-meta {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 14px;
                margin-top: 18px;
            }

            .tk-consent-meta div {
                padding: 14px 16px;
                border-radius: 10px;
                background: #f7f7f7;
            }

            .tk-consent-meta strong,
            .tk-consent-meta span {
                display: block;
            }

            .tk-consent-meta span {
                margin-top: 4px;
            }

            .tk-consent-error {
                margin: 16px 0 0;
                padding: 13px 15px;
                border: 1px solid #a40000;
                border-radius: 10px;
                background: #fff2f2;
                color: #a40000;
                font-weight: 700;
            }

            .tk-consent-success {
                margin-top: 18px;
                padding: 16px;
                border: 1px solid #407a43;
                border-radius: 10px;
                background: #f0faef;
                line-height: 1.55;
            }

            @media (max-width: 650px) {
                .tk-consent-document {
                    max-height: 460px;
                    padding: 17px;
                }

                .tk-consent-meta,
                .tk-guardian-fields {
                    grid-template-columns: 1fr;
                }
            }
        `;
        document.head.appendChild(style);

        step.innerHTML = `
            <h3>Einverständniserklärung</h3>
            <p class="tk-consent-intro">
                Bitte lies die Aufklärung vollständig durch. Die Gesundheitsfragen wurden bereits im vorherigen Schritt erfasst.
                Pflegehinweise, AGB und Datenschutz sind nicht Bestandteil dieser Einverständniserklärung.
            </p>

            <form id="tk-consent-form" novalidate>
                <div class="tk-consent-document" tabindex="0" aria-label="Aufklärung, Risiken und Einwilligung">
                    <h4>Aufklärung über den Piercingvorgang</h4>
                    <p>
                        Bei einem Piercing handelt es sich um einen schmerzhaften Vorgang, bei dem der Körper verletzt wird.
                        Nach §§ 223 ff. StGB handelt es sich damit um eine Körperverletzung, für die eine schriftliche
                        Einwilligung gemäß § 228 StGB benötigt wird.
                    </p>
                    <p>
                        Schmerzreduzierende Maßnahmen wie Vereisen oder Betäubungscreme sind nur bedingt einsetzbar,
                        da sie die Beschaffenheit des Gewebes so stark verändern können, dass das Piercing unter Umständen
                        nicht mehr fachgerecht angebracht werden kann.
                    </p>

                    <h4>Mitwirkungspflichten</h4>
                    <p>
                        Es ist unerlässlich, dass alle für das Piercing relevanten Angaben zum Gesundheitszustand vollständig
                        und wahrheitsgemäß gemacht werden. Bei möglichen Risiken oder Unklarheiten sollte vorab ärztlicher Rat
                        eingeholt werden.
                    </p>

                    <h4>Vor dem Piercing</h4>
                    <p>
                        Am Tag des Piercings darf die zu piercende Person nicht unter Alkohol-, Drogen- oder einem die
                        Wahrnehmungs- oder Entscheidungsfähigkeit beeinträchtigenden Medikamenteneinfluss stehen.
                        Andernfalls kann das Piercing nicht durchgeführt werden.
                    </p>

                    <h4>Allgemeine Risiken und Nebenwirkungen</h4>
                    <p>
                        Trotz größter Sorgfalt sowie erprobter Techniken und Arbeitsmaterialien kann es während oder nach
                        dem Eingriff zu Nebenwirkungen oder Komplikationen kommen. Dazu gehören insbesondere:
                    </p>
                    <ul>
                        <li>Nachblutung, Rötung, Schwellung, Spannungs- und Druckgefühl</li>
                        <li>Erwärmung und Schmerzen</li>
                        <li>Kreislaufreaktionen bis zur Bewusstlosigkeit</li>
                        <li>Allergische Reaktionen</li>
                        <li>Entzündungen, Infektionen, eitrige Infektionen und Abszesse</li>
                        <li>Blutergüsse und in seltenen Fällen Blutvergiftung</li>
                        <li>Nekrosen, Herauswachsen des Schmucks und Granulome</li>
                        <li>Lymphknoten- oder Gefäßentzündungen</li>
                        <li>Verletzungen von Blutgefäßen oder Nervenenden</li>
                        <li>Knorpelschäden, Gewebeschäden und dauerhafte Narbenbildung</li>
                        <li>Keloid- oder Fistelbildung</li>
                        <li>Sprachstörungen, Zahn- oder Zahnfleischschäden bei Piercings im Mundbereich</li>
                        <li>Taubheitsgefühle oder Einschränkungen der natürlichen Funktion der Körperstelle</li>
                        <li>Abstoßungsreaktionen des Körpers</li>
                        <li>Thrombosen, Embolien oder neurologische Ausfälle</li>
                    </ul>

                    <h4>Ergänzende Risiken bei Dehnungen</h4>
                    <ul>
                        <li>Veränderungen körpereigener Funktionen</li>
                        <li>Geruchsbildung</li>
                        <li>Herauswachsen des Schmucks</li>
                    </ul>

                    <h4>Ergänzende Risiken bei Single-Point-Piercings</h4>
                    <p>
                        Bei Dermal Anchors oder Microdermals sind Schmuckentfernung und Aufsatzwechsel in der Regel nur
                        im Studio möglich. Löst sich der Aufsatz vor der Verheilung, besteht die seltene Gefahr, dass die
                        Trägerplatte im Gewebe wandert und chirurgisch entfernt werden muss.
                    </p>

                    <h4>Infektionsrisiko auch nach der Abheilung</h4>
                    <p>
                        Durch das Piercing besteht ein erhöhtes Infektionsrisiko durch das Eindringen von Fremdkeimen sowie
                        durch körpereigene Keime. Dieses Risiko kann minimiert, aber nicht vollständig ausgeschlossen werden.
                        Auch nach der Abheilung können mechanische Belastungen zu Reizungen und Entzündungen führen.
                    </p>

                    <h4>Einwilligung</h4>
                    <p>Mit der Unterschrift wird bestätigt:</p>
                    <ul>
                        <li>
                            Ich wurde über Nebenwirkungen, potenzielle Risiken und Komplikationen informiert,
                            habe diese Informationen verstanden und konnte Fragen stellen.
                        </li>
                        <li>
                            Die Angaben zu meinem Gesundheitszustand sind wahrheitsgemäß und vollständig.
                        </li>
                        <li>
                            Ich kann die Positionierung vor der Durchführung in Augenschein nehmen und noch Änderungswünsche äußern.
                            Mit der Durchführung bestätige ich, dass die Positionierung meinem Wunsch entspricht.
                        </li>
                        <li>
                            Ich willige unter Berücksichtigung aller Angaben in die Durchführung des gewünschten Piercings
                            gemäß § 228 StGB ein.
                        </li>
                        <li id="tk-age-consent-text">Ich habe das 18. Lebensjahr vollendet.</li>
                        <li>
                            Ich habe keine Substanzen eingenommen, die meine Wahrnehmung, meinen freien Willen oder mein
                            Urteilsvermögen einschränken.
                        </li>
                        <li>Die zu piercende Stelle weist kein Narbengewebe unter zwölf Monaten oder Keloidnarben auf.</li>
                        <li>Ich habe mich in den letzten zwölf Monaten keiner Strahlentherapie unterzogen.</li>
                        <li>Ich bin ausgeschlafen und habe ausreichend gegessen und getrunken.</li>
                    </ul>
                </div>

                <div class="tk-consent-checks">
                    <label class="tk-consent-check">
                        <input type="checkbox" id="tk-consent-informed" name="consent_informed" value="1" required>
                        <span>
                            Ich wurde über das geplante Piercing, den Piercingvorgang sowie mögliche Risiken und
                            Nebenwirkungen informiert. Ich konnte Fragen stellen, habe keine weiteren Fragen und fühle
                            mich ausreichend aufgeklärt. *
                        </span>
                    </label>

                    <label class="tk-consent-check">
                        <input type="checkbox" id="tk-consent-injury" name="consent_bodily_injury" value="1" required>
                        <span>
                            Ich habe die Aufklärung zur Einverständniserklärung gelesen und verstanden. Ich willige nach
                            angemessener Bedenkzeit in das gewünschte Piercing und die damit verbundene Körperverletzung
                            gemäß § 228 StGB ein. Meine Angaben erfolgten nach bestem Wissen und Gewissen. *
                        </span>
                    </label>
                </div>

                <div class="tk-signature-block">
                    <h4>Digitale Unterschrift *</h4>
                    <p class="tk-signature-note">
                        Bitte unterschreibe mit Finger, Stift oder Maus im Feld.
                    </p>

                    <div class="tk-signature-canvas-wrap">
                        <canvas
                            class="tk-signature-canvas"
                            id="tk-signature-canvas"
                            aria-label="Unterschriftsfeld"
                            tabindex="0"
                        ></canvas>
                        <div class="tk-signature-line"></div>
                        <div class="tk-signature-caption">Unterschrift Kunde</div>
                    </div>

                    <div class="tk-signature-actions">
                        <button type="button" class="tk-signature-clear" id="tk-signature-clear">
                            Unterschrift löschen
                        </button>
                    </div>

                    <input type="hidden" id="tk-signature-data" name="signature_data" value="">
                </div>

                <div id="tk-minor-section" hidden>
                    <div class="tk-minor-notice" role="alert">
                        <strong>⚠️ Wichtiger Hinweis für Minderjährige</strong>
                        Bei minderjährigen Kunden muss ein Erziehungsberechtigter am Tag des Piercing-Termins persönlich anwesend sein.
                        Eine vorab unterschriebene Einverständniserklärung allein reicht nicht aus. Das Piercing kann nur durchgeführt
                        werden, wenn der Erziehungsberechtigte beim Termin anwesend ist und sich auf Verlangen mit einem gültigen
                        Ausweisdokument ausweisen kann.
                    </div>

                    <div class="tk-guardian-block">
                        <h4>Einverständniserklärung des Erziehungsberechtigten</h4>

                        <div class="tk-guardian-fields">
                            <label>
                                Vor- und Nachname des Erziehungsberechtigten *
                                <input type="text" id="tk-guardian-name" name="guardian_name" autocomplete="name">
                            </label>
                            <label>
                                Beziehung *
                                <select id="tk-guardian-relation" name="guardian_relation">
                                    <option value="">Bitte auswählen</option>
                                    <option value="Mutter">Mutter</option>
                                    <option value="Vater">Vater</option>
                                    <option value="Erziehungsberechtigter">Erziehungsberechtigter</option>
                                </select>
                            </label>
                        </div>

                        <label class="tk-consent-check tk-guardian-consent">
                            <input type="checkbox" id="tk-guardian-consent" name="guardian_consent" value="1">
                            <span>
                                Ich bestätige, dass ich erziehungsberechtigt bin, persönlich beim Piercing-Termin anwesend sein werde
                                und in die Durchführung des ausgewählten Piercings bei der minderjährigen Person einwillige. *
                            </span>
                        </label>

                        <div class="tk-signature-block">
                            <h4>Digitale Unterschrift des Erziehungsberechtigten *</h4>
                            <p class="tk-signature-note">Bitte mit Finger, Stift oder Maus im Feld unterschreiben.</p>
                            <div class="tk-signature-canvas-wrap">
                                <canvas class="tk-signature-canvas" id="tk-guardian-signature-canvas" aria-label="Unterschriftsfeld des Erziehungsberechtigten" tabindex="0"></canvas>
                                <div class="tk-signature-line"></div>
                                <div class="tk-signature-caption">Unterschrift Erziehungsberechtigter</div>
                            </div>
                            <div class="tk-signature-actions">
                                <button type="button" class="tk-signature-clear" id="tk-guardian-signature-clear">Unterschrift löschen</button>
                            </div>
                            <input type="hidden" id="tk-guardian-signature-data" name="guardian_signature_data" value="">
                        </div>
                    </div>
                </div>

                <div class="tk-consent-meta">
                    <div>
                        <strong>Datum</strong>
                        <span id="tk-consent-date"></span>
                        <input type="hidden" id="tk-consent-date-value" name="consent_date" value="">
                    </div>
                    <div>
                        <strong>Ort</strong>
                        <span>Rosenheim</span>
                        <input type="hidden" name="consent_city" value="Rosenheim">
                    </div>
                </div>

                <p class="tk-consent-error" id="tk-consent-error" hidden></p>
                <div class="tk-consent-success" id="tk-consent-success" hidden>
                    <strong>Einverständniserklärung vollständig.</strong><br>
                    Die Daten und die Unterschrift sind für den nächsten Schritt vorbereitet.
                </div>

                <div class="tk-booking-actions">
                    <button type="button" class="tk-button tk-button-secondary" data-back="health">
                        Zurück
                    </button>

                    <button type="submit" class="tk-button">
                        Weiter zur Zusammenfassung
                    </button>
                </div>
            </form>
        `;

        const consentForm = step.querySelector('#tk-consent-form');
        const canvas = step.querySelector('#tk-signature-canvas');
        const clearButton = step.querySelector('#tk-signature-clear');
        const signatureData = step.querySelector('#tk-signature-data');
        const errorBox = step.querySelector('#tk-consent-error');
        const successBox = step.querySelector('#tk-consent-success');
        const dateLabel = step.querySelector('#tk-consent-date');
        const dateValue = step.querySelector('#tk-consent-date-value');
        const minorSection = step.querySelector('#tk-minor-section');
        const ageConsentText = step.querySelector('#tk-age-consent-text');
        const guardianName = step.querySelector('#tk-guardian-name');
        const guardianRelation = step.querySelector('#tk-guardian-relation');
        const guardianConsent = step.querySelector('#tk-guardian-consent');
        const guardianCanvas = step.querySelector('#tk-guardian-signature-canvas');
        const guardianClearButton = step.querySelector('#tk-guardian-signature-clear');
        const guardianSignatureData = step.querySelector('#tk-guardian-signature-data');
        const birthDateInput = app.querySelector('#tk-birth-date');

        function setDate() {
            const now = new Date();
            dateLabel.textContent = new Intl.DateTimeFormat('de-DE').format(now);
            dateValue.value = [
                now.getFullYear(),
                String(now.getMonth() + 1).padStart(2, '0'),
                String(now.getDate()).padStart(2, '0')
            ].join('-');
        }

        function createSignaturePad(targetCanvas, clearControl, dataInput) {
            const context = targetCanvas.getContext('2d');
            let drawing = false;
            let hasSignature = false;
            let lastPoint = null;
            let savedImage = '';

            function configureContext() {
                context.lineWidth = 2.4;
                context.lineCap = 'round';
                context.lineJoin = 'round';
                context.strokeStyle = '#171717';
            }

            function resize() {
                const rect = targetCanvas.getBoundingClientRect();
                if (rect.width < 10 || rect.height < 10) {
                    return;
                }

                const snapshot = hasSignature ? targetCanvas.toDataURL('image/png') : savedImage;
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                targetCanvas.width = Math.round(rect.width * ratio);
                targetCanvas.height = Math.round(190 * ratio);
                context.setTransform(ratio, 0, 0, ratio, 0, 0);
                configureContext();

                if (snapshot) {
                    const image = new Image();
                    image.onload = function () {
                        context.drawImage(image, 0, 0, rect.width, 190);
                        savedImage = targetCanvas.toDataURL('image/png');
                        dataInput.value = savedImage;
                    };
                    image.src = snapshot;
                }
            }

            function pointFromEvent(event) {
                const rect = targetCanvas.getBoundingClientRect();
                const source = event.touches && event.touches[0] ? event.touches[0] : event;
                return {x: source.clientX - rect.left, y: source.clientY - rect.top};
            }

            function begin(event) {
                if (event.button !== undefined && event.button !== 0) {
                    return;
                }
                event.preventDefault();
                resize();
                drawing = true;
                lastPoint = pointFromEvent(event);
                context.beginPath();
                context.arc(lastPoint.x, lastPoint.y, 1.2, 0, Math.PI * 2);
                context.fillStyle = '#171717';
                context.fill();
                hasSignature = true;
                if (event.pointerId !== undefined && targetCanvas.setPointerCapture) {
                    targetCanvas.setPointerCapture(event.pointerId);
                }
            }

            function move(event) {
                if (!drawing) return;
                event.preventDefault();
                const point = pointFromEvent(event);
                context.beginPath();
                context.moveTo(lastPoint.x, lastPoint.y);
                context.lineTo(point.x, point.y);
                context.stroke();
                lastPoint = point;
                hasSignature = true;
            }

            function finish(event) {
                if (!drawing) return;
                event.preventDefault();
                drawing = false;
                lastPoint = null;
                savedImage = targetCanvas.toDataURL('image/png');
                dataInput.value = savedImage;
                if (event.pointerId !== undefined && targetCanvas.hasPointerCapture && targetCanvas.hasPointerCapture(event.pointerId)) {
                    targetCanvas.releasePointerCapture(event.pointerId);
                }
            }

            function clear() {
                context.clearRect(0, 0, targetCanvas.width, targetCanvas.height);
                hasSignature = false;
                savedImage = '';
                dataInput.value = '';
                errorBox.hidden = true;
                successBox.hidden = true;
            }

            if (window.PointerEvent) {
                targetCanvas.addEventListener('pointerdown', begin, {passive: false});
                targetCanvas.addEventListener('pointermove', move, {passive: false});
                targetCanvas.addEventListener('pointerup', finish, {passive: false});
                targetCanvas.addEventListener('pointercancel', finish, {passive: false});
                targetCanvas.addEventListener('pointerleave', function (event) {
                    if (drawing && (!event.buttons || event.pointerType === 'touch')) finish(event);
                }, {passive: false});
            } else {
                targetCanvas.addEventListener('mousedown', begin);
                targetCanvas.addEventListener('mousemove', move);
                window.addEventListener('mouseup', finish);
                targetCanvas.addEventListener('touchstart', begin, {passive: false});
                targetCanvas.addEventListener('touchmove', move, {passive: false});
                targetCanvas.addEventListener('touchend', finish, {passive: false});
            }

            clearControl.addEventListener('click', clear);
            return {
                resize: resize,
                clear: clear,
                hasSignature: function () { return hasSignature && Boolean(dataInput.value); },
                data: function () { return dataInput.value; }
            };
        }

        const customerPad = createSignaturePad(canvas, clearButton, signatureData);
        const guardianPad = createSignaturePad(guardianCanvas, guardianClearButton, guardianSignatureData);

        function calculateAge(dateString) {
            if (!/^\d{4}-\d{2}-\d{2}$/.test(dateString || '')) return null;
            const parts = dateString.split('-').map(Number);
            const birth = new Date(parts[0], parts[1] - 1, parts[2]);
            if (Number.isNaN(birth.getTime())) return null;
            const today = new Date();
            let age = today.getFullYear() - birth.getFullYear();
            const beforeBirthday = today.getMonth() < birth.getMonth() ||
                (today.getMonth() === birth.getMonth() && today.getDate() < birth.getDate());
            if (beforeBirthday) age -= 1;
            return age;
        }

        function updateMinorState() {
            const age = calculateAge(birthDateInput ? birthDateInput.value : '');
            const isMinor = age !== null && age < 18;
            minorSection.hidden = !isMinor;
            guardianName.required = isMinor;
            guardianRelation.required = isMinor;
            guardianConsent.required = isMinor;
            ageConsentText.textContent = isMinor
                ? 'Ich bin minderjährig. Die Einwilligung erfolgt zusätzlich durch meinen Erziehungsberechtigten.'
                : 'Ich habe das 18. Lebensjahr vollendet.';
            if (!isMinor) guardianPad.clear();
            window.requestAnimationFrame(function () {
                customerPad.resize();
                if (isMinor) guardianPad.resize();
            });
            return isMinor;
        }

        const visibilityObserver = new MutationObserver(function () {
            if (!step.hidden) {
                updateMinorState();
                window.requestAnimationFrame(function () {
                    customerPad.resize();
                    if (!minorSection.hidden) guardianPad.resize();
                });
            }
        });
        visibilityObserver.observe(step, {attributes: true, attributeFilter: ['hidden']});

        if (window.ResizeObserver) {
            const resizeObserver = new ResizeObserver(function () {
                if (!step.hidden) {
                    customerPad.resize();
                    if (!minorSection.hidden) guardianPad.resize();
                }
            });
            resizeObserver.observe(step);
        }

        window.addEventListener('resize', function () {
            if (!step.hidden) {
                window.requestAnimationFrame(function () {
                    customerPad.resize();
                    if (!minorSection.hidden) guardianPad.resize();
                });
            }
        });

        consentForm.addEventListener('submit', function (event) {
            event.preventDefault();
            errorBox.hidden = true;
            successBox.hidden = true;
            const isMinor = updateMinorState();

            if (!consentForm.checkValidity()) {
                consentForm.reportValidity();
                return;
            }

            if (!customerPad.hasSignature()) {
                errorBox.textContent = 'Bitte unterschreibe im Unterschriftsfeld.';
                errorBox.hidden = false;
                canvas.focus();
                return;
            }

            if (isMinor && !guardianPad.hasSignature()) {
                errorBox.textContent = 'Bitte ergänze die Unterschrift des Erziehungsberechtigten.';
                errorBox.hidden = false;
                guardianCanvas.focus();
                return;
            }

            successBox.hidden = false;
            app.dispatchEvent(new CustomEvent('tattookunst:consent-complete', {
                detail: {
                    informed: true,
                    bodilyInjuryConsent: true,
                    signatureData: customerPad.data(),
                    consentDate: dateValue.value,
                    consentCity: 'Rosenheim',
                    isMinor: isMinor,
                    guardianName: isMinor ? guardianName.value.trim() : '',
                    guardianRelation: isMinor ? guardianRelation.value : '',
                    guardianConsent: isMinor,
                    guardianSignatureData: isMinor ? guardianPad.data() : ''
                }
            }));
        });

        setDate();
        updateMinorState();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initConsentStep);
    } else {
        initConsentStep();
    }
}());
