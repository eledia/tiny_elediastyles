<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     tiny_elediastyles
 * @category    string
 * @copyright   2025 Alex Schander <alexander.schander@eledia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['button_showStyles'] = 'Stile anzeigen';
$string['menuitem_startstyles'] = 'CSS-Header anzeigen';
$string['pluginname'] = 'eLeDia Styles';
$string['privacy:metadata'] = 'eLeDia Styles speichert keine personenbezogenen Daten.';
$string['styleslist'] = 'Style-Definitionen (JSON)';
$string['styleslist_desc'] = 'JSON mit "styles" (Liste aus label/class/type) und "css"-Klassen für die Darstellung.';
$string['csslist'] = 'CSS-Definitionen';
$string['csslist_desc'] = 'Fügen Sie den CSS-Code wie üblich in dieses Textfeld ein.';
$string['settings'] = 'eLeDia Styles – Editor-Einstellungen';
$string['settings_desc'] = 'Konfigurieren Sie das eLeDia-Styles-Plugin für TinyMCE.';
$string['allowedroles'] = 'Zugelassene Rollen';
$string['allowedroles_desc'] = 'Wählen Sie aus, welche Rollen das eLeDia-Styles-Plugin verwenden dürfen.';
$string['compiled_css_heading'] = 'Kompiliertes CSS (zum Kopieren ins Theme)';
$string['compiled_css_empty'] = 'Noch kein CSS kompiliert. Bitte SCSS eingeben und speichern.';
$string['copy_css'] = 'Alles kopieren';
$string['copied_to_clipboard'] = 'CSS-Code in die Zwischenablage kopiert!';
$string['button_clearStyles'] = 'Style löschen';
$string['showclearbutton'] = '"Style löschen"-Button separat anzeigen';
$string['showclearbutton_desc'] = 'Standardmäßig befindet sich die Funktion "Style löschen" im Dropdown-Menü. Wenn diese Option aktiviert wird, wird sie stattdessen als separater Button in der Werkzeugleiste angezeigt.';
$string['useexternalcss'] = 'Externe CSS laden (Tiny)';
$string['useexternalcss_desc'] = 'Wenn aktiviert, wird die unten angegebene CSS-URL im Tiny-Editor eingebunden.';
$string['externalcssurl'] = 'Externe CSS-URL (Tiny)';
$string['externalcssurl_desc'] = 'Öffentliche HTTPS-URL zu einer CSS-Datei, die im Tiny-Editor-iFrame geladen werden soll.';
$string['scssscompilerror'] = 'SCSS konnte nicht kompiliert werden. Bitte prüfen Sie den Code.';
$string['scsscompilesuccess'] = 'SCSS wurde erfolgreich kompiliert und gespeichert.';
$string['scsscompilernotfound'] = 'SCSS-Compiler-Bibliothek nicht gefunden.';