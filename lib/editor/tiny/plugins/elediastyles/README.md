# eLeDia Styles for TinyMCE

Ein Plugin für den Moodle TinyMCE-Editor, das es Administratoren ermöglicht, zentrale CSS-Stilvorlagen zu definieren und bereitzustellen. Lehrende und andere Inhaltsersteller können diese vordefinierten Stile einfach über ein Dropdown-Menü in der Werkzeugleiste auf Texte anwenden.

Das Plugin unterstützt die Eingabe von SCSS, das automatisch zu CSS kompiliert wird, und bietet eine intuitive Benutzeroberfläche für eine nahtlose Inhaltserstellung.

## Features

* **Zentrale Stil-Verwaltung:** Definieren Sie alle Stilvorlagen direkt in den Moodle-Plugin-Einstellungen.
* **SCSS-Unterstützung:** Schreiben Sie modernes SCSS. Das Plugin kompiliert es automatisch zu CSS.
* **Live-Vorschau im Editor:** Die im Dropdown-Menü angezeigten Stile werden direkt mit den definierten CSS-Regeln formatiert, um eine visuelle Vorschau zu geben.
* **Flexible Block- und Inline-Stile:** Erstellen Sie Stile, die entweder als `<div>`-Container (für ganze Blöcke) oder als `<span>`-Elemente (für Textabschnitte) angewendet werden.
* **Intuitive Bedienung:**
    * **"Style löschen"-Funktion:** Entfernen Sie angewendete Stile mit einem Klick und kehren Sie zu einem normalen Absatz zurück.
    * **"Double Enter"-Logik:** Verlassen Sie einen `<div>`-Container einfach, indem Sie in einer leeren Zeile am Ende Enter drücken.
* **Konfigurierbare Oberfläche:** Entscheiden Sie per Einstellung, ob der "Style löschen"-Button als separater Button in der Werkzeugleiste oder als erster Eintrag im Dropdown-Menü angezeigt wird.
* **Einbindung externer Stylesheets:** Binden Sie eine oder mehrere externe CSS-Dateien direkt in den Editor ein, um z.B. Web-Schriftarten oder Icon-Bibliotheken zu laden.

## Installation

1.  Laden Sie das Plugin als ZIP-Datei herunter.
2.  Loggen Sie sich in Moodle als Administrator ein und navigieren Sie zu `Website-Administration > Plugins > Plugins installieren`.
3.  Laden Sie die ZIP-Datei hoch. Moodle wird das Plugin automatisch installieren.
4.  Alternativ können Sie den entpackten Ordner `elediastyles` in das Verzeichnis `/lib/editor/tiny/plugins/` Ihrer Moodle-Installation kopieren und anschließend die Installation unter `Website-Administration > Mitteilungen` abschließen.

## Konfiguration

Nach der Installation finden Sie die Einstellungen unter:
`Website-Administration > Plugins > Texteditoren > TinyMCE-Editor > eLeDia Styles`

### Schritt 1: Style-Definitionen (JSON)

Hier definieren Sie die Stile, die im Dropdown-Menü erscheinen sollen. Die Struktur ist ein JSON-Array von Objekten, wobei jedes Objekt einen Stil repräsentiert.

**Jedes Stil-Objekt hat drei Eigenschaften:**
* `title`: Der Name, der im Dropdown-Menü angezeigt wird (z.B. "Wichtiger Hinweis").
* `classes`: Die CSS-Klasse(n), die auf das HTML-Element angewendet werden (z.B. "as-hinweis-wichtig").
* `type`: Entweder `"block"` (erzeugt ein `<div>`-Element) oder `"inline"` (erzeugt ein `<span>`-Element).

**Beispiel:**
```json
[
    {
        "title": "Aufgabenbox",
        "classes": "as-aufgabe",
        "type": "block"
    },
    {
        "title": "Wichtiger Hinweis",
        "classes": "as-hinweis as-hinweis-wichtig",
        "type": "block"
    },
    {
        "title": "Code-Hervorhebung",
        "classes": "as-code",
        "type": "inline"
    }
]
```

---
### Schritt 2: CSS/SCSS-Definitionen

Fügen Sie hier das CSS oder SCSS für Ihre oben definierten Klassen ein. Das Plugin kompiliert diesen Code automatisch.

**Beispiel passend zum obigen JSON:**
```scss
/* Aufgabenbox */
.as-aufgabe {
    background-color: #f0f8ff;
    border-left: 5px solid #007bff;
    padding: 15px;
    margin-bottom: 20px;
}

/* Hinweisboxen */
.as-hinweis {
    padding: 10px;
    border-radius: 4px;

    &.as-hinweis-wichtig {
        background-color: #fff3cd;
        color: #856404;
    }
}

/* Inline-Code */
.as-code {
    background-color: #e9ecef;
    padding: 2px 4px;
    font-family: monospace;
    border-radius: 3px;
}
```

---
### Schritt 3: Kompiliertes CSS ins Theme kopieren

Nachdem Sie Ihre SCSS-Definitionen gespeichert haben, generiert das Plugin reines CSS. Dieses erscheint in einem Textfeld am Ende der Einstellungsseite.

**Dieser Schritt ist entscheidend:**
Kopieren Sie das **kompilierte CSS** und fügen Sie es in die entsprechenden CSS-Dateien Ihres Moodle-Themes ein (z.B. in das Feld "Zusätzliches CSS"). Nur so werden die Stile nicht nur im Editor, sondern auch auf der finalen Kursseite korrekt angezeigt.

### Weitere Einstellungen

* **"Style löschen"-Button separat anzeigen:** Legen Sie fest, ob die Funktion zum Löschen von Styles als eigener Button in der Werkzeugleiste oder als erster Eintrag im Dropdown-Menü erscheint.
* **Externe CSS laden:** Aktivieren Sie diese Option, um eine oder mehrere externe CSS-Dateien in den Editor zu laden. Geben Sie die vollständigen URLs (eine pro Zeile) in das dafür vorgesehene Textfeld ein.

## Verwendung im Editor

Nach der Konfiguration sehen Lehrende und andere Nutzer mit den entsprechenden Rechten in der TinyMCE-Werkzeugleiste ein neues Icon. Ein Klick darauf öffnet ein Dropdown-Menü mit den von Ihnen definierten Stilen.

Der Anwender kann nun Text markieren und einen Stil auswählen, um ihn anzuwenden.

## Lizenz

Dieses Plugin steht unter der [GNU GPL v3 oder höher](https://www.gnu.org/copyleft/gpl.html).

## Autor

**Alex Schander**
(alexander.schander@eledia.de)