<?php
/**
 * Plugin event observers definition.
 *
 * @package     tiny_elediastyles
 * @copyright   2025 Your Name <your.email@example.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname'   => '\core\event\course_module_viewed',
        'callback'    => '\tiny_elediastyles\observer::course_module_viewed',
    ],
];