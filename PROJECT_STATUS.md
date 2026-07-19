# Tattookunst CRM – Projektstatus

## Verbindlicher Ausgangsstand

Der aktuell funktionierende Stand liegt im GitHub-Repository:

`tattookunst-rosenheim/tattookunst-crm`

Der Hauptbranch `main` steht auf dem funktionierenden Commit:

`b4a4034 – Zurück-Button und deutsche Wochentage korrigiert`

Dieser Stand darf nicht ungeprüft verändert werden.

## Arbeitsweise ab jetzt

- Keine ZIP-Dateien mehr als normale Arbeitsgrundlage
- Keine direkten Änderungen auf `main`
- Jede neue Funktion bekommt einen eigenen Branch
- Immer nur einen klar abgegrenzten Punkt bearbeiten
- Bestehende funktionierende Abläufe nicht nebenbei verändern
- Erst lokal testen
- Danach Änderungen prüfen
- Erst nach erfolgreichem Test in `main` übernehmen

## Aktueller Entwicklungsstand

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

## Nächste konkrete Schritte

1. Reihenfolge der Unterschriften endgültig sauber setzen
2. Auswahlfeld für Erziehungsberechtigte ergänzen:
   - Mutter
   - Vater
   - sonstige sorgeberechtigte Person
3. Zusammenfassungsseite erstellen
4. vollständige Speicherung im CRM umsetzen
5. Pflegehinweise erst nach Abschluss anzeigen
6. Bestätigungsseite ergänzen
7. spätere E-Mail-Funktion vorbereiten

## Wichtige feste Regeln

- Gesundheitsfragebogen kommt vor der Einverständniserklärung
- Die Einverständniserklärung enthält keine Anamnese
- Die Einverständniserklärung enthält keine Pflegehinweise
- Die Einverständniserklärung enthält keine AGB
- Die Einverständniserklärung enthält keinen Datenschutztext
- Zuerst unterschreibt die zu piercende Person
- Bei Minderjährigen folgen danach Hinweis, Daten der erziehungsberechtigten Person, Verhältnis und zweite Pflichtunterschrift
- Ohne Pflichtunterschriften darf nicht fortgefahren werden
- Pflegehinweise erscheinen erst nach Abschluss der Buchung
- Kunden sollen nicht unnötig doppelt angelegt werden
- Bilder, Dokumente, Termine und Notizen müssen einem Kunden und möglichst einem Projekt zugeordnet sein

## Noch nicht endgültig festgelegt

Diese Punkte werden später einzeln besprochen:

- genaue Zahlungsabwicklung
- Höhe und Fälligkeit von Anzahlungen
- genaue E-Mail-Texte
- Reservierungsfristen
- endgültige Terminregeln
- Benutzerrechte
- Statistik
- Automatisierungen
- Bewertungserinnerungen
- Nachstechen
- weitere Statusmodelle

## Ziel

Das Repository ist ab jetzt das feste Projektgedächtnis.

Der Chat dient zur Planung und Abstimmung, aber alle verbindlichen Entscheidungen und Arbeitsstände werden im Repository dokumentiert.