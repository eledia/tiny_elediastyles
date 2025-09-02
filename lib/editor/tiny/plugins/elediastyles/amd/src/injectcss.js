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

define(['core/ajax'], function(Ajax) {
    return {
        /**
         * Initialize the CSS injection
         * @return {void}
         */
        init: function() {
            // Use Moodle's Ajax API to fetch the CSS
            Ajax.call([{
                methodname: 'tiny_elediastyles_get_css',
                args: {},
                done: function(data) {
                    if (data && data.css) {
                        // Create and inject the style element
                        const styleEl = document.createElement('style');
                        styleEl.innerHTML = data.css;
                        document.head.appendChild(styleEl);
                        window.console.log('TinyMCE elediaStyles CSS injected successfully');
                    }
                },
                fail: function(error) {
                    window.console.error('Failed to load TinyMCE elediaStyles CSS:', error);
                }
            }]);
        }
    };
});