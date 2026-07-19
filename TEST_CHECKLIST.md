# Tattookunst CRM – Testcheckliste

## Grundregel

Eine Änderung gilt erst als fertig, wenn die neue Funktion geprüft wurde und der bisherige funktionierende Ablauf weiterhin vollständig funktioniert.

## Vor jedem Test

- richtigen Branch kontrollieren
- sicherstellen, dass nicht auf `main` gearbeitet wird
- Git-Status prüfen
- nur erwartete Dateien verändert
- lokale WordPress-Testumgebung starten
- Plugin aktiviert
- Browser neu laden
- gegebenenfalls Cache leeren
- keine echten Kundendaten verwenden

## Technischer Grundcheck

- keine PHP-Fehlermeldung
- keine JavaScript-Fehlermeldung
- keine leere weiße Seite
- keine beschädigte Darstellung
- keine fehlenden Styles
- keine fehlenden Buttons
- keine unerwarteten Weiterleitungen
- WordPress-Backend weiterhin erreichbar
- Plugin-Menü weiterhin erreichbar

## Start und Navigation

- Startseite öffnet korrekt
- Piercing-Ablauf lässt sich starten
- richtige Schritte werden angezeigt
- Weiter-Buttons funktionieren
- Zurück-Buttons funktionieren
- beim Zurückgehen bleiben Eingaben erhalten
- kein Schritt wird übersprungen
- kein Schritt erscheint doppelt
- Seitenanfang wird beim Schrittwechsel sinnvoll angezeigt

## Piercingauswahl

- Kategorien werden korrekt angezeigt
- Piercings lassen sich auswählen
- mehrere Piercings lassen sich auswählen
- Auswahl lässt sich entfernen
- Preise werden korrekt angezeigt
- Gesamtpreis wird korrekt berechnet
- Dauer wird korrekt berücksichtigt
- Zusammenfassung der Auswahl stimmt

## Terminwahl

- deutsche Wochentage werden angezeigt
- nur freie Termine werden angezeigt
- gesperrte Zeiten sind nicht auswählbar
- keine Doppelbuchung möglich
- Termin kann ausgewählt werden
- ausgewählter Termin bleibt beim Zurückgehen erhalten
- ohne Termin kein unzulässiges Weitergehen
- Datum und Uhrzeit werden korrekt zusammengefasst

## Kundendaten

- Vorname Pflichtfeld
- Nachname Pflichtfeld
- Geburtsdatum Pflichtfeld
- Straße und Hausnummer funktionieren
- Postleitzahl funktioniert
- Ort funktioniert
- Telefonnummer funktioniert
- E-Mail-Adresse wird geprüft
- Geschlecht wird korrekt gespeichert
- fehlerhafte Eingaben werden verständlich angezeigt
- korrekte Eingaben bleiben beim Zurückgehen erhalten

## Minderjährigenerkennung

- Alter wird aus dem Geburtsdatum korrekt berechnet
- unter 18 Jahren erscheint der Minderjährigenbereich
- ab 18 Jahren bleibt der Minderjährigenbereich verborgen
- Grenzfall am 18. Geburtstag funktioniert korrekt
- gelber Hinweis erscheint an der richtigen Stelle

## Bilder

- Bild kann hochgeladen werden
- mehrere Bilder können hochgeladen werden
- Vorschau wird angezeigt
- Bild kann entfernt werden
- nicht erlaubte Dateitypen werden abgelehnt
- zu große Dateien werden behandelt
- Bilder bleiben beim Zurückgehen erhalten
- Bilder werden korrekt zugeordnet

## Gesundheitsfragebogen

- alle Fragen werden angezeigt
- Ja-/Nein-Auswahl funktioniert
- bei Ja erscheint das Zusatzfeld
- bei Nein bleibt das Zusatzfeld verborgen
- Pflichtangaben werden geprüft
- Antworten bleiben beim Zurückgehen erhalten
- Gesundheitsfragebogen kommt vor der Einverständniserklärung

## Einverständniserklärung

- enthält nur die vorgesehenen Inhalte
- keine Gesundheitsfragen enthalten
- keine Pflegehinweise enthalten
- keine AGB enthalten
- kein Datenschutztext enthalten
- Ort wird korrekt angezeigt oder erfasst
- Datum wird korrekt angezeigt oder erfasst

## Kundenunterschrift

- Unterschrift mit Maus funktioniert
- Unterschrift mit Finger funktioniert
- Unterschrift mit Stift funktioniert
- Unterschrift kann gelöscht werden
- leere Unterschrift wird nicht akzeptiert
- Weitergehen ohne Unterschrift nicht möglich
- gespeicherte Unterschrift wird korrekt angezeigt

## Minderjährigenbereich

- erscheint nur bei Minderjährigen
- Kundenunterschrift kommt zuerst
- gelber Hinweis kommt danach
- Name der erziehungsberechtigten Person ist Pflicht
- Verhältnis-Auswahl ist Pflicht
- Mutter auswählbar
- Vater auswählbar
- sonstige sorgeberechtigte Person auswählbar
- zweite Unterschrift ist Pflicht
- zweite Unterschrift kann gelöscht und neu gesetzt werden
- ohne vollständige Angaben kein Weitergehen

## Zusammenfassung

- gewählte Piercings stimmen
- Einzelpreise stimmen
- Gesamtpreis stimmt
- Termin stimmt
- Kundendaten stimmen
- Alter stimmt
- Geschlecht stimmt
- Bilder werden angezeigt
- Gesundheitsangaben stimmen
- Einwilligung ist erkennbar
- Kundenunterschrift wird angezeigt
- Minderjährigenangaben werden angezeigt
- zweite Unterschrift wird angezeigt
- Zurückgehen und Ändern funktioniert
- Änderungen erscheinen danach korrekt in der Zusammenfassung

## CRM-Speicherung

- Kunde wird neu angelegt oder korrekt zugeordnet
- kein unnötiger doppelter Kunde
- Piercingbuchung wird gespeichert
- Piercingauswahl wird gespeichert
- Termin wird gespeichert
- Preise werden gespeichert
- Bilder werden gespeichert
- Gesundheitsfragebogen wird gespeichert
- Einverständniserklärung wird gespeichert
- Kundenunterschrift wird gespeichert
- Minderjährigenangaben werden gespeichert
- zweite Unterschrift wird gespeichert
- Status wird gespeichert
- Zeitstempel wird gespeichert
- Zuordnungen zu Kunde und Buchung stimmen

## Abschlussseite

- Formular verschwindet nach erfolgreichem Absenden
- Erfolgsmeldung erscheint
- Termin wird angezeigt
- Uhrzeit wird angezeigt
- Leistung wird angezeigt
- Studioadresse wird angezeigt
- Kontaktmöglichkeit wird angezeigt
- Minderjährigenhinweis erscheint bei Bedarf
- kein doppeltes Absenden möglich

## Pflegehinweise

- erscheinen erst nach erfolgreichem Abschluss
- erscheinen nicht in der Einverständniserklärung
- enthalten die richtigen Inhalte
- können abhängig vom Piercing angepasst werden
- Kontaktmöglichkeit ist enthalten
- Warnzeichen sind verständlich beschrieben

## Regressionstest nach jeder Änderung

Nach jeder neuen Funktion zusätzlich den kompletten bisherigen Ablauf erneut prüfen:

1. Piercing auswählen
2. Termin auswählen
3. Kundendaten eingeben
4. Bilder testen
5. Gesundheitsfragen beantworten
6. Einverständniserklärung prüfen
7. Kundenunterschrift setzen
8. Minderjährigenfall testen
9. Erwachsenenfall testen
10. Zurück-Navigation testen
11. Zusammenfassung prüfen
12. Speicherung prüfen
13. Abschluss prüfen

## Git-Prüfung vor dem Push

- `git status` geprüft
- richtiger Branch aktiv
- keine unerwarteten Dateien verändert
- keine Zugangsdaten enthalten
- keine Testbilder mit echten Personen enthalten
- keine echten Kundendaten enthalten
- Commit-Nachricht beschreibt die Änderung
- Push nur auf den Arbeitsbranch

## Freigabe für main

Eine Änderung darf erst in `main` übernommen werden, wenn:

- alle relevanten Punkte getestet sind
- keine bestehende Funktion beschädigt wurde
- nur erwartete Dateien verändert wurden
- das Ergebnis fachlich bestätigt wurde
- der Arbeitsbranch sauber ist
- ein Rückweg zum vorherigen Stand möglich ist