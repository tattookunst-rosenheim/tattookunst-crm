# Tattookunst CRM – Piercing-Ablauf

## Status

Dieser Ablauf beschreibt den aktuell verbindlichen Piercing-Kundenprozess.

Der bestehende funktionierende Stand darf dabei nicht verändert werden. Neue Punkte werden nur Schritt für Schritt ergänzt und getestet.

## Start

Der Kunde wählt auf der Startseite:

- Piercing
- Piercing-Beratung

Für die direkte Piercing-Buchung öffnet sich der nachfolgende Ablauf.

## Schritt 1 – Piercing-Kategorie

Der Kunde wählt eine Kategorie.

Vorgesehene Kategorien:

- Ohr
- Gesicht
- Mund
- Nase
- Körper
- Intimbereich
- Dermal Anchor oder Microdermal
- Dehnung
- Schmuckwechsel
- Kontrolle

## Schritt 2 – Konkretes Piercing

Der Kunde wählt ein oder mehrere Piercings.

Je Auswahl werden angezeigt:

- Bezeichnung
- Körperstelle
- Preis
- gegebenenfalls Dauer
- Hinweise oder Voraussetzungen

Funktionen:

- Piercing hinzufügen
- mehrere Piercings auswählen
- Piercing wieder entfernen
- automatische Preiszusammenfassung
- automatische Berechnung der benötigten Dauer

## Schritt 3 – Termin

Der Kunde wählt:

- Datum
- Uhrzeit
- gegebenenfalls Mitarbeiter
- verfügbaren Zeitraum

Regeln:

- nur freie Termine anzeigen
- keine Doppelbuchungen
- Dauer abhängig von der Piercingauswahl
- mehrere Piercings verlängern die Terminzeit
- Sperrzeiten ausblenden
- deutsche Wochentage anzeigen
- nur freigegebene Termine für Kunden sichtbar machen

Noch nicht endgültig festgelegt:

- konkrete Öffnungstage
- feste Uhrzeitfenster
- genaue Vor- und Nachbereitungszeit
- Mitarbeiterwahl
- Reservierungsdauer

## Schritt 4 – Kundendaten

Erfasst werden:

- Vorname
- Nachname
- Geburtsdatum
- Geschlecht
  - männlich
  - weiblich
  - divers
- Straße und Hausnummer
- Postleitzahl
- Ort
- Telefonnummer
- E-Mail-Adresse

Das Geburtsdatum steuert automatisch den Minderjährigenbereich.

## Schritt 5 – Bilder

Der Kunde kann optional Bilder hochladen.

Beispiele:

- Körperstelle
- bestehendes Piercing
- Problemstelle
- gewünschte Platzierung
- Schmuck oder Referenz

Anforderungen:

- mehrere Bilder möglich
- Vorschau
- Bild entfernen
- erlaubte Dateitypen
- Größenbegrenzung
- Zuordnung zum Kunden und zur Buchung

## Schritt 6 – Gesundheitsfragebogen

Der Gesundheitsfragebogen kommt vor der Einverständniserklärung.

Mögliche Fragen:

- Allergien
- Medikamenteneinnahme
- Blutverdünner
- Diabetes
- Epilepsie
- Kreislaufprobleme
- Herz-Kreislauf-Erkrankungen
- Hauterkrankungen
- Infektionskrankheiten
- Immunschwäche
- Blutgerinnungsstörungen
- Schwangerschaft oder Stillzeit
- frühere Probleme mit Piercings
- sonstige wichtige gesundheitliche Hinweise

Bei einer Ja-Antwort öffnet sich ein Zusatzfeld.

Gespeichert werden:

- Antwort
- Zusatzangabe
- Zeitpunkt
- Zuordnung zum Kunden
- Zuordnung zur Buchung und zum Termin

## Schritt 7 – Einverständniserklärung

Die Einverständniserklärung enthält ausschließlich:

- Aufklärung über Risiken und Komplikationen
- rechtliche Einwilligung
- Zustimmung zur Durchführung
- Ort
- Datum
- Unterschrift

Nicht Bestandteil dieses Abschnitts:

- Gesundheitsfragebogen
- Pflegehinweise
- AGB
- Datenschutztext
- Vertragsparteien
- Projektabschnitt

## Schritt 8 – Kundenunterschrift

Zuerst unterschreibt die zu piercende Person.

Funktionen:

- Unterschrift mit Finger
- Tablet-Stift
- Maus
- Unterschrift löschen
- Pflichtfeld
- Speicherung als Bild oder Base64-Daten
- Weitergehen ohne Unterschrift nicht möglich

## Schritt 9 – Minderjährigenbereich

Der Bereich erscheint automatisch, wenn die zu piercende Person unter 18 Jahre alt ist.

Verbindliche Reihenfolge:

1. Kundenunterschrift
2. gelber Hinweis
3. Daten der erziehungsberechtigten Person
4. Verhältnis auswählen
5. Unterschrift der erziehungsberechtigten Person

Gelber Hinweis:

Eine erziehungsberechtigte Person muss am Tag des Piercingtermins persönlich anwesend sein.

Eine allein zu Hause ausgefüllte Erklärung reicht nicht aus.

Daten:

- Vor- und Nachname der erziehungsberechtigten Person
- Verhältnis zur minderjährigen Person

Auswahlfeld:

- Mutter
- Vater
- sonstige sorgeberechtigte Person

Die zweite Unterschrift ist ein Pflichtfeld.

Ohne vollständige Angaben und zweite Unterschrift darf nicht fortgefahren werden.

## Schritt 10 – Zusammenfassung

Vor dem Absenden sieht der Kunde:

- gewählte Piercings
- Einzelpreise
- Gesamtpreis
- Termin
- Kundendaten
- Geburtsdatum und Alter
- Geschlecht
- Bilder
- Gesundheitsangaben
- Einwilligung
- Kundenunterschrift

Bei Minderjährigen zusätzlich:

- Name der erziehungsberechtigten Person
- Verhältnis
- zweite Unterschrift
- Anwesenheitshinweis

Der Kunde kann zurückgehen und Angaben ändern.

## Schritt 11 – Speicherung im CRM

Nach der Bestätigung werden gespeichert:

- Kunde oder Zuordnung zu bestehendem Kunden
- Piercingprojekt oder Buchung
- ausgewählte Piercings
- Preise
- Termin
- Bilder
- Gesundheitsfragebogen
- Einverständniserklärung
- Kundenunterschrift
- Minderjährigenangaben
- Unterschrift der erziehungsberechtigten Person
- Ort und Datum
- Bearbeitungsstatus
- Zeitstempel

Doppelte Kunden sollen möglichst vermieden werden.

Prüfmerkmale können sein:

- E-Mail-Adresse
- Telefonnummer
- Name und Geburtsdatum

## Schritt 12 – Bestätigung

Nach erfolgreichem Abschluss verschwindet das Formular.

Der Kunde erhält eine eindeutige Bestätigung mit:

- Termin
- Uhrzeit
- Studioadresse
- gebuchter Leistung
- wichtigen Hinweisen
- Minderjährigenhinweis
- Kontaktmöglichkeit bei Fragen oder Änderungen

Später zusätzlich per E-Mail.

## Schritt 13 – Pflegehinweise

Pflegehinweise erscheinen erst nach erfolgreichem Abschluss.

Sie gehören nicht in die Einverständniserklärung.

Mögliche Inhalte:

- Reinigung
- Pflege
- Verhalten während der Heilung
- was vermieden werden soll
- normale Heilungserscheinungen
- Warnzeichen
- Kontakt zum Studio
- Kontrolltermin
- Schmuckwechsel
- piercingabhängige Hinweise

## Bestehender getesteter Stand

Bereits vorhanden beziehungsweise getestet:

- Piercingauswahl
- Terminwahl
- Kundendaten
- Bilder
- Gesundheitsfragebogen
- Einverständniserklärung
- Kundenunterschrift
- Minderjährigenerkennung
- gelber Minderjährigenhinweis
- zweite Unterschrift
- deutsche Wochentage
- Zurück-Navigation grundsätzlich eingebaut

## Nächste technische Schritte

1. Reihenfolge der Unterschriften endgültig sauber setzen
2. Verhältnis-Auswahl vollständig integrieren
3. Zusammenfassungsseite erstellen
4. vollständige CRM-Speicherung umsetzen
5. Pflegehinweise nach Abschluss anzeigen
6. Bestätigungsseite ergänzen
7. E-Mail-Funktion später vorbereiten