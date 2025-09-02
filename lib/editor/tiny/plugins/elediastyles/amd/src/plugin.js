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
 * Tiny tiny_elediastyles for Moodle.
 *
 * @module      tiny_elediastyles
 * @copyright   2025 Alex Schander <alexander.schander@eledia.de>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
import { getTinyMCE } from 'editor_tiny/loader';
import { getPluginMetadata } from 'editor_tiny/utils';
import { component, pluginName } from './common';
import { register as registerOptions } from './options';
import { getSetup as getCommandSetup } from './commands';
import * as Configuration from './configuration';

// ====================
// Inject theme ALL CSS into the Tiny iframe
// ====================
/**
 * I look up the editor CSS loaded in the Tiny iframe (.../theme/styles.php/.../editor),
 * derive .../all from it, and append it as a <link rel="stylesheet"> to the iframe head,
 * so the full theme CSS (including Font Awesome) becomes available.
 * @param {TinyMCEEditor} editor
 */
const injectThemeAllCss = (editor) => {
    try {
        const doc = editor.getDoc();
        if (!doc || !doc.head) {
            return;
        }

        // Collect all stylesheet links inside the iframe.
        const links = Array.from(doc.querySelectorAll('link[rel="stylesheet"]'));

        // Find the link that ends with .../editor.
        const editorLink = links.find(l =>
            l && typeof l.href === 'string' &&
            /\/theme\/styles\.php\/[^/]+\/[^/]+\/editor$/.test(l.href)
        );

        if (!editorLink) {
            // eslint-disable-next-line no-console
            console.warn('[tiny_elediastyles] No editor stylesheet found in the iframe.');
            return;
        }

        // Derive /all from /editor.
        const allHref = editorLink.href.replace(/\/editor$/, '/all');

        // Skip if it's already present.
        const already = links.some(l => l && l.href === allHref);
        if (already) {
            return;
        }

        // Append a <link> for .../all.
        const link = doc.createElement('link');
        link.rel = 'stylesheet';
        link.href = allHref;
        doc.head.appendChild(link);

        // eslint-disable-next-line no-console
        console.log('[tiny_elediastyles] Injected theme ALL CSS into Tiny iframe:', allHref);
    } catch (e) {
        // eslint-disable-next-line no-console
        console.error('[tiny_elediastyles] injectThemeAllCss error:', e);
    }
};

// Setup the tiny_elediastyles plugin.
export default new Promise((resolve) => {
    Promise.all([
        getTinyMCE(),
        getPluginMetadata(component, pluginName),
        getCommandSetup(),
    ]).then(([tinyMCE, pluginMetadata, setupCommands]) => {
        tinyMCE.PluginManager.add(pluginName, (editor) => {
            registerOptions(editor);
            setupCommands(editor);

            // Inject ALL CSS once Tiny is initialized.
            editor.on('init', () => {
                injectThemeAllCss(editor);
            });

            return pluginMetadata;
        });
        resolve([pluginName, Configuration]);
    }).catch((error) => {
        window.console.error("Error during plugin setup:", error);
        // reject(error); // optional
        resolve([pluginName, Configuration]);
    });
});
