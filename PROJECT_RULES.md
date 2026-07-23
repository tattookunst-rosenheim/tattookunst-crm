# Tattookunst CRM – Projektregeln

## Grundregel

Der aktuell funktionierende Stand darf nicht durch neue Änderungen beschädigt werden.

Neue Funktionen werden immer getrennt, nachvollziehbar und testbar umgesetzt.

## Git- und Branch-Regeln

- `main` enthält nur getestete und funktionierende Stände.
- Auf `main` wird nicht direkt gearbeitet.
- Jede Änderung bekommt einen eigenen Branch.
- Ein Branch darf nur einen klar abgegrenzten Arbeitsauftrag enthalten.
- Änderungen werden erst nach erfolgreichem Test in `main` übernommen.
- Vor jedem Merge wird geprüft, welche Dateien verändert wurden.
- Unklare oder unerwartete Änderungen werden nicht übernommen.
- ZIP-Dateien sind nur noch Sicherungen, nicht die normale Arbeitsgrundlage.

## Arbeitsweise

- Immer nur einen Schritt gleichzeitig umsetzen.
- Keine zusätzlichen „Verbesserungen“ ohne ausdrückliche Absprache.
- Keine Umstrukturierung funktionierender Dateien ohne Notwendigkeit.
- Keine Designänderungen nebenbei.
- Keine Felder entfernen oder umbenennen, ohne die Folgen zu prüfen.
- Keine bestehenden Abläufe verkürzen, verschieben oder zusammenlegen, ohne Freigabe.
- Vor jeder Programmierung wird der genaue Ablauf besprochen.
- Alte Screenshots und frühere Ideen gelten nur als Notizen, solange sie nicht ausdrücklich bestätigt wurden.

## Schutz des funktionierenden Stands

Bei jeder neuen Änderung muss gelten:

1. Der bisherige Piercing-Ablauf startet weiterhin korrekt.
2. Die Navigation funktioniert weiterhin.
3. Vor- und Zurück-Schaltflächen funktionieren weiterhin.
4. Bereits vorhandene Felder bleiben erhalten.
5. Die Terminwahl bleibt funktionsfähig.
6. Die deutschen Wochentage bleiben korrekt.
7. Die Minderjährigenerkennung bleibt aktiv.
8. Unterschriftenfelder bleiben bedienbar.
9. Bilder und Formulardaten gehen nicht verloren.
10. Es entstehen keine PHP-, JavaScript- oder WordPress-Fehler.

## Testregel

Eine Änderung gilt erst als fertig, wenn:

- sie lokal getestet wurde
- der vollständige bisherige Ablauf erneut getestet wurde
- keine Fehlermeldung erscheint
- keine bestehende Funktion beschädigt wurde
- die neue Funktion genau wie besprochen arbeitet
- der Git-Status kontrolliert wurde
- nur die erwarteten Dateien verändert wurden

## Dokumentationsregel

Nach jeder abgeschlossenen Änderung werden mindestens aktualisiert:

- aktueller Projektstand
- betroffene Funktion
- neue oder geänderte Felder
- gespeicherte Daten
- Testschritte
- bekannte offene Punkte

## Sicherheitsregel

- Keine Zugangsdaten in Dateien speichern.
- Keine Passwörter oder Tokens in Screenshots zeigen.
- Keine Tokens in das Terminal als normalen Befehl einfügen.
- Keine sensiblen Kundendaten in GitHub hochladen.
- Keine echten Gesundheitsdaten zu Testzwecken verwenden.
- Keine echten Unterschriften in das Repository übernehmen.

## Datenregel

Kundendaten, Gesundheitsdaten, Dokumente und Unterschriften müssen nachvollziehbar zugeordnet werden.

Grundsätzlich gilt:

- Kunde eindeutig zuordnen
- Projekt oder Buchung zuordnen
- Termin zuordnen, wenn vorhanden
- Zeitstempel speichern
- Status speichern
- Änderungen nachvollziehbar halten

## Änderungsregel

Vor jeder technischen Umsetzung müssen diese Fragen beantwortet sein:

1. Was sieht der Kunde?
2. Was muss eingegeben oder ausgewählt werden?
3. Welche Felder sind Pflicht?
4. Welche Bedingungen ändern den Ablauf?
5. Was wird gespeichert?
6. Wo wird es gespeichert?
7. Welcher Status entsteht?
8. Was passiert bei Fehlern oder Abbruch?
9. Was darf nicht verändert werden?
10. Wie wird die Funktion getestet?

## Priorität

Stabilität geht vor Geschwindigkeit.

Eine kleinere saubere Änderung ist besser als eine große Änderung, die mehrere funktionierende Bereiche gleichzeitig betrifft.

## Terminänderungen

Änderungen an einem Termin werden nicht sofort automatisch übernommen.

Erst nach dem Klick auf:

**Änderung speichern**

wird der neue Stand verbindlich gespeichert.

Das gilt insbesondere für:

- Datum
- Startzeit
- Endzeit
- Status
- interne Notizen
- Zuordnung zum Kunden
- Zuordnung zur Buchung oder zum Projekt

---

## Vollständiges Löschen eines Kunden

Beim vollständigen Löschen eines Kunden muss eine deutliche Sicherheitsabfrage erscheinen.

Dabei muss klar genannt werden, dass auch alle verbundenen Daten gelöscht werden, insbesondere:

- Anfragen
- Tattoo-Projekte
- Piercing-Buchungen
- Termine
- Bilder
- Dokumente
- Gesundheitsfragebögen
- Einverständniserklärungen
- Unterschriften
- Zahlungen
- Notizen
- Versandprotokolle

Die vollständige Löschung darf erst nach einer zweiten ausdrücklichen Bestätigung ausgeführt werden.

Einzelne Termine, Projekte, Buchungen, Dokumente und andere Einträge bleiben weiterhin auch separat löschbar.

---

## Tattoo-Walk-in

Das CRM erhält einen eigenen schnellen Bereich:

**Tattoo-Walk-in**

Dieser Ablauf ist für spontane kleine Tattoos direkt im Studio gedacht.

Er soll kurz und schnell ausfüllbar sein.

Mindestens enthalten:

- Vorname und Nachname
- Geburtsdatum
- Mobilnummer oder E-Mail, soweit gewünscht
- kurze Bezeichnung des Tattoos
- Körperstelle
- Preis
- Datum
- Startzeit
- Endzeit
- Bestätigung der Volljährigkeit
- kurze Einverständniserklärung
- Unterschrift
- bei Minderjährigen die erforderlichen Angaben und Unterschrift der erziehungsberechtigten Person

Nach dem Abschluss wird der Walk-in als Kunde beziehungsweise Vorgang gespeichert und im CRM-Kalender eingetragen.

Die genauen rechtlichen Texte werden nicht neu formuliert, sondern später aus den vorhandenen rechtlich geprüften Unterlagen übernommen.

## Geschützte Dokumentenablage

Für jeden gespeicherten Vorgang gibt es einen geschützten Bereich:

**Dokumente**

Dort werden getrennt gespeichert:

- Gesundheitsfragebogen
- Einverständniserklärung
- Kundenunterschrift
- bei Minderjährigen die Angaben zur erziehungsberechtigten Person
- bei Minderjährigen die Unterschrift der erziehungsberechtigten Person
- später weitere rechtliche Unterlagen

Jedes Dokument wird eindeutig zugeordnet zu:

- dem Kunden
- Tattoo oder Piercing
- dem konkreten Projekt beziehungsweise der Buchung

In der normalen Kundenansicht wird zunächst nur angezeigt, welche Dokumente vorhanden sind.

Beispiel:

- Gesundheitsfragebogen – vorhanden
- Einverständniserklärung – vorhanden
- Kundenunterschrift – vorhanden
- Erziehungsberechtigte Person – nicht erforderlich

Der vollständige Inhalt wird erst beim gezielten Öffnen angezeigt.

### Unterschriebene Dokumente

Ein bereits unterschriebener Gesundheitsfragebogen oder eine bereits unterschriebene Einverständniserklärung darf nicht nachträglich verändert werden.

Muss etwas korrigiert werden, wird eine neue Version erstellt und erneut unterschrieben.

Die ursprüngliche Version bleibt erhalten, bis sie ausdrücklich gelöscht wird.

In der Kundenakte muss klar erkennbar sein, welche Version aktuell ist.

Alle Dokumente und einzelnen Versionen bleiben gezielt löschbar.

Beim vollständigen Löschen eines Kunden werden auch alle zugehörigen Dokumente und Versionen vollständig gelöscht.