# Piercing-Ablauf – aktueller Planungsstand

Diese Datei hält die gemeinsam festgelegten Anforderungen für den Piercing-Bereich fest.

Wichtig: Vor der Programmierung werden die einzelnen Punkte noch einmal am vorhandenen System geprüft. Bereits funktionierende Teile dürfen nicht unnötig verändert werden.

---

## 1. Grundsatz

Der bestehende Piercing-Ablauf funktioniert bereits weitgehend und soll erhalten bleiben.

Bereits vorhanden:

- Auswahl einer oder mehrerer Piercingarten
- Auswahl des Termins
- Kundendaten
- Bilder
- Gesundheitsfragebogen
- Einverständniserklärung
- digitale Kundenunterschrift
- Erkennung minderjähriger Kunden
- Daten und Unterschrift der erziehungsberechtigten Person
- Zurück-Navigation
- deutsche Wochentage
- Speicherung der Buchung
- Anzeige des Termins im Kalender

Piercing-Termine verwenden Zeitfenster von 20 Minuten.

---

## 2. Daten bei der Buchung

Wenn der Kunde am Ende auf „Termin buchen“ beziehungsweise „Absenden“ klickt, werden die Daten aus dem Kundenformular im CRM gespeichert.

Gespeichert werden insbesondere:

- Vorname
- Nachname
- Geburtsdatum
- Mobilnummer
- E-Mail-Adresse
- E-Mail-Adresse bestätigen
- bevorzugte Kontaktart
- bei Telegram zusätzlich der Telegram-Benutzername
- ausgewählte Piercingart oder mehrere Piercingarten
- Anzahl
- Preis
- Termin mit Datum und Uhrzeit
- hochgeladene Bilder
- Gesundheitsfragebogen
- Einverständniserklärung
- Kundenunterschrift
- bei Minderjährigen die Angaben und Unterschrift der erziehungsberechtigten Person
- Buchungsstatus

Eine Wohnadresse wird beim Piercing nicht benötigt.

Der erste Buchungsstatus lautet:

**Gebucht**

---

## 3. Kalenderanzeige

Im Kalender soll ein Piercing-Termin bewusst kurz und übersichtlich dargestellt werden.

Direkt sichtbar sind nur:

- Vorname und Nachname
- Piercingart oder mehrere Piercingarten

Beispiel:

**Anna Muster – Helix + Tragus**

Die Mobilnummer, E-Mail-Adresse, Gesundheitsdaten und Dokumente müssen nicht direkt im Kalender stehen.

Beim Anklicken des Termins öffnet sich die kompakte Termin- beziehungsweise Kundenansicht.

---

## 4. Kompakte Terminansicht

Beim Öffnen des Piercing-Termins werden zunächst nur folgende Informationen angezeigt:

- Vorname und Nachname
- Geburtsdatum
- Mobilnummer
- E-Mail-Adresse
- bevorzugte Kontaktart
- Piercingart oder mehrere Piercingarten
- Preis
- Datum und Uhrzeit
- hochgeladene Bilder

Von dort kann die vollständige Kundenakte geöffnet werden.

Gesundheitsdaten und rechtliche Unterlagen werden nicht sofort vollständig aufgeklappt.

Sie liegen in einem eigenen, separat aufrufbaren Bereich:

- Gesundheitsfragebogen
- Einverständniserklärung
- Kundenunterschrift
- bei Minderjährigen Angaben zur erziehungsberechtigten Person
- bei Minderjährigen Unterschrift der erziehungsberechtigten Person

Diese Unterlagen werden nur bei Bedarf geöffnet.

Da der Kunde die Buchung ohne die erforderlichen Angaben und Unterschriften nicht abschließen kann, entstehen daraus keine zusätzlichen offenen Aufgaben.

Beim Piercing werden keine AGB in diesen Ablauf aufgenommen.

---

## 5. Minderjährige Kunden

Das Alter wird automatisch anhand des Geburtsdatums und des Termindatums geprüft.

Ist der Kunde am Tag des Termins noch unter 18 Jahre alt, muss der Termin im Kalender sofort deutlich auffallen.

Direkte Kalenderanzeige zum Beispiel:

**⚠ Minderjährig – Anna Muster – Helix**

Zusätzlich erhält der Termin eine auffällige farbliche Markierung.

Beim Öffnen des Termins erscheint nochmals deutlich:

**Minderjährige Person: Eine erziehungsberechtigte Person muss beim Termin anwesend sein und sich auf Aufforderung ausweisen können.**

Die Markierung erfolgt automatisch und muss nicht manuell gesetzt werden.

---

## 6. Neuer Piercing-Termin im CRM

Nach einer neuen Buchung erscheint im Startbereich des CRM ein deutlicher Hinweis:

**Neuer Piercing-Termin**

Beim Anklicken öffnet sich die zugehörige Buchung beziehungsweise Kundenakte.

Der Startbereich zeigt neue und offene Vorgänge, die Aufmerksamkeit benötigen.

---

## 7. Prüfen und bestätigen

Vor dem endgültigen Absenden erscheint eine übersichtliche Zusammenfassung.

Angezeigt werden:

- Vorname und Nachname
- Mobilnummer
- E-Mail-Adresse
- bevorzugte Kontaktart
- Piercingart beziehungsweise Piercingarten
- Anzahl
- Datum
- Uhrzeit
- Dauer
- Gesamtpreis

Der Kunde kann einzelne Angaben noch einmal ändern.

Der endgültige Button lautet:

**Verbindlich buchen**

Erst nach diesem Klick wird die Piercing-Buchung gespeichert, das passende Zeitfenster blockiert und die Bestätigungs-E-Mail verschickt.

---

## 8. Bestätigungsseite nach der Buchung

Nach erfolgreichem Absenden verschwindet das Buchungsformular.

Der Kunde sieht eine klare Bestätigungsseite mit einer Zusammenfassung seiner Buchung.

Angezeigt werden:

- Name
- Piercingart oder mehrere Piercingarten
- Anzahl
- Datum und Uhrzeit
- Gesamtpreis
- gewählte Kontaktart

Zusätzlich erscheint der Text:

**Vielen Dank für deine Terminbuchung.  
Dein Piercing-Termin wurde erfolgreich gebucht.  
Deine Terminbestätigung wird dir zusätzlich per E-Mail zugeschickt.  
In der E-Mail findest du außerdem die allgemeinen Pflegehinweise und meine Kontaktdaten.**

Außerdem erscheint der Hinweis:

**Gesundheitsfragebogen und Einverständniserklärung wurden erfolgreich übermittelt.**

Nicht angezeigt werden:

- vollständige Gesundheitsantworten
- vollständige Einverständniserklärung
- Unterschriften
- Angaben zur erziehungsberechtigten Person

Diese sensiblen Inhalte bleiben sicher im CRM gespeichert.

---

## 9. Bestätigungs-E-Mail

Die Buchungsbestätigung wird immer per E-Mail verschickt, unabhängig von der bevorzugten Kontaktart.

Betreff:

**Bestätigung deines Piercing-Termins**

Grundaufbau:

**Hallo [Vorname],**

vielen Dank für deine Buchung. Dein Piercing-Termin wurde erfolgreich eingetragen.

**Deine Buchung:**

Termin: [Datum] um [Uhrzeit]  
Piercing: [Piercingart beziehungsweise Piercingarten]  
Anzahl: [Anzahl]  
Gesamtpreis: [Preis]

Gesundheitsfragebogen und Einverständniserklärung wurden erfolgreich übermittelt.

Die allgemeinen Pflegehinweise findest du im PDF-Anhang dieser E-Mail.

Bei Fragen, Problemen oder Auffälligkeiten kannst du mich über WhatsApp kontaktieren.

[Termin verschieben]

[Termin absagen]

Viele Grüße  
Tattookunst Chris

Die E-Mail enthält zusätzlich:

- Studioadresse
- Kontaktdaten
- persönlichen Link zum Verschieben
- persönlichen Link zum Absagen

Nicht per E-Mail verschickt werden:

- Gesundheitsfragebogen
- Einverständniserklärung
- Unterschriften
- Angaben zur erziehungsberechtigten Person

---

## 10. Pflegehinweise

Es gibt eine allgemeine Pflegeanleitung für alle Piercings.

Die Pflegehinweise werden als feste PDF-Datei automatisch an jede Piercing-Bestätigungs-E-Mail angehängt.

Die PDF wird nicht für jeden Kunden neu erstellt.

Sie muss nicht zusätzlich in jeder Kundenakte gespeichert werden.

Es gibt keinen eigenen CRM-Vermerk „Pflegehinweise versendet“, da die PDF immer Bestandteil der Bestätigungs-E-Mail ist.

Im CRM wird nur gespeichert, ob die Bestätigungs-E-Mail erfolgreich versendet wurde oder fehlgeschlagen ist.

---

## 11. Fehler beim Versand der Bestätigungs-E-Mail

Kann die Piercing-Bestätigungs-E-Mail nicht versendet werden, erscheint im Startbereich des CRM eine offene Aufgabe:

**Piercing-Bestätigung nicht versendet**

Angezeigt werden:

- Name des Kunden
- Termin
- Piercingart
- technisch erkennbarer Fehlergrund
- Button „Erneut senden“
- Button „Kundendaten öffnen“

Die Aufgabe bleibt sichtbar, bis:

- die E-Mail erfolgreich versendet wurde,
- die Aufgabe bewusst als erledigt markiert wurde,
- oder der Eintrag ausdrücklich gelöscht wurde.

---

## 12. Bevorzugte Kontaktart

Beim Piercing wird dieselbe bereits funktionierende Kontaktlogik wie beim Tattoo verwendet.

Auswahlmöglichkeiten:

- E-Mail
- WhatsApp
- Telegram

Bei Telegram erscheint zusätzlich das Feld:

**Telegram-Benutzername**

Die Kontaktart wird verwendet für:

- die 48-Stunden-Terminerinnerung
- spätere Kontaktaufnahme

Die Buchungsbestätigung mit Pflege-PDF wird weiterhin immer per E-Mail versendet.

---

## 13. 48-Stunden-Terminerinnerung

48 Stunden vor dem Piercing-Termin wird automatisch eine kurze Erinnerung über die bevorzugte Kontaktart versendet.

Mögliche Versandarten:

- E-Mail
- WhatsApp
- Telegram

Für alle drei Versandarten wird derselbe Text verwendet:

**Hallo [Vorname],  
ich möchte dich kurz daran erinnern, dass du am [Datum] um [Uhrzeit] bei Tattookunst Chris einen Piercing-Termin hast.  
Ich freue mich auf dich!**

Die Erinnerung enthält:

- keine Buttons
- keine Links zum Verschieben
- keinen Link zum Absagen
- keine zusätzlichen Hinweise

Die Links zum Verschieben und Absagen hat der Kunde bereits mit der ursprünglichen Bestätigungs-E-Mail erhalten.

Kann eine reine Terminerinnerung nicht zugestellt werden, wird dafür keine zusätzliche offene Aufgabe im CRM erzeugt.

---

## 14. Termin verschieben

Der Kunde kann seinen Piercing-Termin über den persönlichen Link aus der Bestätigungs-E-Mail selbst verschieben.

Regeln:

- selbstständiges Online-Verschieben bis 24 Stunden vor dem Termin
- danach Kontaktaufnahme über WhatsApp
- intern kann Chris den Termin jederzeit verschieben
- nur tatsächlich freie 20-Minuten-Zeitfenster werden angeboten
- der bisherige Termin wird erst freigegeben, wenn der neue Termin erfolgreich bestätigt wurde
- der Kalender wird automatisch aktualisiert
- nach erfolgreichem Verschieben wird eine neue Bestätigung verschickt
- im CRM wird der Vorgang als verschobener Piercing-Termin erkennbar

---

## 15. Termin absagen

Der Kunde kann seinen Piercing-Termin über den persönlichen Link jederzeit absagen.

Auch weniger als 24 Stunden vor dem Termin bleibt die Absage möglich.

Eine kurzfristige Absage ist besser, als wenn der Termin weiterhin blockiert bleibt.

Unterschieden werden können:

- rechtzeitig abgesagt
- kurzfristig abgesagt
- nicht erschienen

Es wird nicht automatisch etwas berechnet oder in Rechnung gestellt.

Bei einer Absage:

- wird das 20-Minuten-Zeitfenster wieder freigegeben
- erhält der Termin den Status „Abgesagt“
- erscheint im CRM ein Hinweis auf die Absage
- erhält der Kunde eine kurze Absagebestätigung

Erscheint ein Kunde nicht, kann Chris den Termin intern als:

**Nicht erschienen**

markieren.

---

## 16. Kalender und Geräte

Das Tattookunst-CRM erhält einen vollständig eigenen, geschützten Kalender.

Es gibt:

- keine Google-Kalender-Anbindung
- keine Apple-Kalender-Anbindung
- keine externe Synchronisierung
- keine Weitergabe von Kundendaten an externe Kalenderdienste

Der Kalender bleibt vollständig im Tattookunst-CRM.

Das CRM muss auf folgenden Geräten vollständig bedienbar sein:

- Mac
- iPad
- iPhone

Auf jedem Gerät müssen Termine:

- angezeigt
- geöffnet
- angelegt
- bearbeitet
- verschoben
- abgesagt
- als erledigt markiert
- als nicht erschienen markiert

werden können.

Änderungen werden zentral im CRM gespeichert und sind anschließend auf allen Geräten sichtbar.

### Erste Kalender-Version für Piercing

Für Piercing-Termine gilt:

- Termine nur Dienstag bis Freitag
- buchbare Zeit von 16:00 bis 18:00 Uhr
- feste 20-Minuten-Zeitfenster
- erster Termin um 16:00 Uhr
- letzter möglicher Terminbeginn um 17:40 Uhr
- im Kalender sichtbar: Vorname, Nachname und Piercingart beziehungsweise Piercingarten
- Beispiel: „Anna Muster – Helix + Tragus“
- beim Anklicken öffnet sich die Terminansicht
- von dort kann die vollständige Kundenakte geöffnet werden
- Minderjährige werden automatisch auffällig markiert
- Termine können intern verschoben oder abgesagt werden

### Dauer abhängig von der Anzahl der Piercings

- 1 bis 4 Piercings: 20 Minuten
- ab 5 Piercings: 40 Minuten
- bei 40 Minuten müssen zwei direkt aufeinanderfolgende 20-Minuten-Zeitfenster frei sein
- letzter möglicher Beginn für einen 40-Minuten-Termin ist 17:20 Uhr
- bei 40 Minuten werden beide Zeitfenster im Kalender blockiert

Der Kalender ist passwortgeschützt und unterliegt der automatischen Sperre des CRM.

## 17. Interne Zahlungsangaben

Die Zahlungsangaben sind nur für Chris im CRM sichtbar.

Beim Piercing soll mindestens festgehalten werden können:

Zahlungsstatus:

- offen
- bezahlt

Zahlungsart:

- bar
- Karte
- Kreditkarte
- sonstige

Zusätzlich kann der gezahlte Betrag hinterlegt werden.

Der Kunde wählt die Zahlungsart nicht bei der Online-Buchung aus. Chris trägt sie intern ein.

Beim Tattoo wird die Zahlungsverwaltung später ausführlicher behandelt, da dort Anzahlungen, mehrere Sitzungen und Teilzahlungen möglich sind.

---

## 18. Bewertungsanfrage

Die Bewertungsfunktion wird gemeinsam für Tattoo und Piercing verwendet.

Es gibt keine getrennten Texte und keine doppelte Funktion.

Die Bewertungsanfrage wird nicht automatisch versendet.

Chris entscheidet selbst, ob und wann sie verschickt wird.

Dafür gibt es einen Button:

**Bewertungsanfrage senden**

Verwendeter Text:

**Vielen Dank, dass du dir kurz Zeit nimmst! 🙏  
Wenn du mit deinem Tattoo oder Piercing zufrieden warst, würde ich mich riesig über eine kurze Google-Bewertung freuen.  
Damit hilfst du nicht nur mir, sondern auch anderen bei der Suche nach einem passenden Tattoo- oder Piercingstudio.  
Vielen lieben Dank für deine Unterstützung! 🙌  
Chris – TATTOOKUNST CHRIS**

**⭐ Jetzt bewerten:**  
https://g.page/r/CT3J5K58Nh3YEBE/review

Mögliche Statusangaben:

- Noch keine Bewertungsanfrage
- Bewertungsanfrage versendet
- Bewertung erhalten
- Keine weitere Anfrage

Wenn der Kunde noch nicht bewertet hat, kann die Bewertungsanfrage später erneut manuell verschickt werden.

Wenn eine Bewertung eingegangen ist, setzt Chris den Status manuell auf:

**Bewertung erhalten**

Das Versanddatum kann im Hintergrund gespeichert werden, muss aber in der normalen Ansicht nicht hervorgehoben werden.

---

## 19. Vollständige Löschbarkeit

Im gesamten CRM müssen alle Daten gezielt und dauerhaft löschbar sein.

Dies gilt für Tattoo und Piercing.

Löschbar sein müssen unter anderem:

- einzelne Versandprotokolle
- fehlgeschlagene Versandaufgaben
- Termine
- Piercing-Buchungen
- Tattoo-Anfragen
- Tattoo-Terminbuchungen
- Projekte
- Bilder
- Dokumente
- Gesundheitsfragebögen
- Einverständniserklärungen
- Unterschriften
- Zahlungseinträge
- Notizen
- komplette Kundenakten
- sämtliche mit einem Kunden verbundenen Daten

Dabei wird unterschieden:

### Einzelnen Eintrag löschen

Nur der ausgewählte Eintrag wird gelöscht, ohne automatisch den gesamten Kunden oder die Buchung zu löschen.

### Buchung oder Projekt löschen

Die ausgewählte Buchung oder das ausgewählte Projekt wird vollständig gelöscht.

Der Kunde kann bestehen bleiben, wenn noch andere Vorgänge vorhanden sind.

### Kunden vollständig löschen

Auf ausdrücklichen Wunsch werden der Kunde und sämtliche damit verbundenen Daten vollständig gelöscht.

Vor jeder endgültigen Löschung erscheint eine klare Sicherheitsabfrage.

Nach einer bestätigten vollständigen Löschung darf keine versteckte Kopie im normalen CRM zurückbleiben.

---

## 20. Zugangsschutz des gesamten CRM

Das gesamte Tattookunst-CRM wird durch einen persönlichen Zugang geschützt.

Festgelegt sind:

- Passwortabfrage beim Öffnen des CRM
- automatische Sperre nach 15 Minuten Inaktivität
- erneute Passwortabfrage nach der Sperre
- sichtbarer Button „CRM sperren“
- vollständige Abmeldung
- getrennte geschützte Sitzung auf Mac, iPad und iPhone
- keine automatische Einstellung „den ganzen Tag offen“
- spätere Möglichkeit einer Zwei-Faktor-Anmeldung

Nur Chris soll Zugriff auf die vollständigen Kundendaten, Gesundheitsinformationen, Dokumente und Unterschriften haben.

---

## 21. Noch vor der Umsetzung zu prüfen

Vor Änderungen am Code wird geprüft:

- welche beschriebenen Funktionen bereits vollständig vorhanden sind
- welche Daten aktuell bereits gespeichert werden
- welche Funktionen nur ergänzt werden müssen
- wie die vorhandene Tattoo-Kontaktfunktion sauber für Piercing wiederverwendet wird
- wie der E-Mail-Versand aktuell technisch aufgebaut ist
- wie die Pflege-PDF angehängt wird
- wie sichere persönliche Links zum Verschieben und Absagen umgesetzt werden
- wie die automatische 48-Stunden-Erinnerung technisch ausgelöst wird
- wie die auffällige Minderjährigen-Markierung im Kalender umgesetzt wird
- wie die zentrale Kalenderbedienung auf Mac, iPad und iPhone gewährleistet wird

Es wird nichts unnötig neu gebaut, wenn eine funktionierende Lösung bereits vorhanden ist.