<?php
namespace tiny_elediastyles;

use core\event\course_module_viewed;
use function \tiny_elediastyles_extend_page;


defined('MOODLE_INTERNAL') || die();

class observer {
	/**
     * Observer function triggered when a course module is viewed.
     *
     * @param \core\event\course_module_viewed $event The event data.
     * @return void
     */
    public static function course_module_viewed(\core\event\course_module_viewed $event) {
        global $PAGE, $CFG;
		require_once($CFG->dirroot . '/lib/editor/tiny/plugins/elediastyles/lib.php');
        tiny_elediastyles_extend_page($PAGE);
    }
}
