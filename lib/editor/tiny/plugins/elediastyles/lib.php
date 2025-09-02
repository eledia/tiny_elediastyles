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
 * using the logic for the scss compiler here
 *
 * @package     tiny_elediastyles
 * @category    string
 * @copyright   2025 Alex Schander <alexander.schander@eledia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Compiles SCSS string to CSS string.
 *
 * @param string $scss_code The SCSS code to compile.
 * @return string|false The compiled CSS or false on error.
 * @throws \Exception re-throws exception from the compiler.
 */
function tiny_elediastyles_compile_scss($scss_code){
    if (!class_exists('\ScssPhp\ScssPhp\Compiler')) {
        throw new \moodle_exception('scsscompilerunavailable', 'tiny_elediastyles');
    }

    try {
        $compiler = new \ScssPhp\ScssPhp\Compiler();
        $compiled_css = $compiler->compileString($scss_code)->getCss();
        return $compiled_css;
    } catch (\Exception $e) {
        throw $e;
    }
}

/**
 * Callback function executed when the 'csslist' setting is updated.
 * It fetches the saved SCSS, compiles it, and saves the compiled CSS.
 *
 * @param mixed $data The data passed from the admin_setting object (may not be the direct value).
 * WE WILL IGNORE THIS and fetch the value directly.
 * @param admin_setting $setting The admin setting object itself.
 * @return bool True on success.
 */
function tiny_elediastyles_process_settings_update($data, $setting = null){ // Parameter adjusted, but $data is ignored
    global $CFG;
    $scss_compiler_path = $CFG->dirroot . '/lib/editor/tiny/plugins/elediastyles/vendor/scssphp/scss.inc.php';
    if (!file_exists($scss_compiler_path)) {
        \core\notification::error(get_string('scsscompilernotfound', 'tiny_elediastyles'));
        return false;
    }
    require_once($scss_compiler_path);

    // Get the just saved value from the 'csslist'-Config 
    $scss_code_from_settings = get_config('tiny_elediastyles', 'csslist');

    if ($scss_code_from_settings === null) {
        \core\notification::error('SCSS konnte nicht kompiliert werden. Bitte prüfen Sie den Code.');
        $scss_code_from_settings = ''; // Fallback on empty string
    }
    $compiled_css = tiny_elediastyles_compile_scss($scss_code_from_settings);

    if ($compiled_css !== false) {
        set_config('compiled_css', $compiled_css, 'tiny_elediastyles');
        \core\notification::success('SCSS erfolgreich kompiliert und gespeichert.');
    } else {
        set_config('compiled_css', '', 'tiny_elediastyles');
        \core\notification::error(get_string('scsscompileerror','tiny_elediastyles'));
    }
    theme_reset_all_caches();
    return true;
}


/*
 * This function is currently NOT required, as we are ignoring theme-independent
 * CSS injection for the time being. It can be commented out or removed.
 *
*/
function tiny_elediastyles_extend_page($PAGE){
    // fetching CSS per AJAX
    $PAGE->requires->js_call_amd('tiny_elediastyles/injectcss', 'init', []);
}
