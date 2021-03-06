<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Homework block admin settings
 *
 * @var object $CFG
 * @var moodle_database $DB
 *
 * @package    block_homework_diary
 * @copyright  Anthony Kuske <www.anthonykuske.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Smooth scrolling
 */
$settings->add(
    new admin_setting_configcheckbox(
        'block_homework_diary/smooth_scroll',
        get_string('settings_smooth_scroll_name', 'block_homework_diary'),
        get_string('settings_smooth_scroll_desc', 'block_homework_diary'),
        1
    )
);

// Category to show courses from.
// Load all categories to show in the list.
$categories = $DB->get_records('course_categories', null, 'name', 'id, name');
$categorylist = array(
    0 => '[All Categories]'
);
foreach ($categories as $category) {
    $categorylist[$category->id] = $category->name;
}

$settings->add(
    new admin_setting_configselect(
        'block_homework_diary/course_category',
        get_string('settings_course_category_name', 'block_homework_diary'),
        get_string('settings_course_category_desc', 'block_homework_diary'),
        0,
        $categorylist
    )
);

// Get all system-level cohorts.
$cohorts = $DB->get_records('cohort', ['contextid' => context_system::instance()->id], 'name', 'id, name, idnumber');
$cohortlist = array(
    0 => '[Not Set]'
);
foreach ($cohorts as $cohort) {
    $cohortlist[$cohort->id] = $cohort->name;
    if ($cohort->idnumber) {
        $cohortlist[$cohort->id] .= ' (' . s($cohort->idnumber) . ')';
    }
}

// Student.
$settings->add(
    new admin_setting_configselect(
        'block_homework_diary/student_cohort',
        get_string('settings_student_cohort_name', 'block_homework_diary'),
        get_string('settings_student_cohort_desc', 'block_homework_diary'),
        0,
        $cohortlist
    )
);

// Teacher.
$settings->add(
    new admin_setting_configselect(
        'block_homework_diary/teacher_cohort',
        get_string('settings_teacher_cohort_name', 'block_homework_diary'),
        get_string('settings_teacher_cohort_desc', 'block_homework_diary'),
        0,
        $cohortlist
    )
);

// Parent.
$settings->add(
    new admin_setting_configselect(
        'block_homework_diary/parent_cohort',
        get_string('settings_parent_cohort_name', 'block_homework_diary'),
        get_string('settings_parent_cohort_desc', 'block_homework_diary'),
        0,
        $cohortlist
    )
);

// Secretary.
$settings->add(
    new admin_setting_configselect(
        'block_homework_diary/secretary_cohort',
        get_string('settings_secretary_cohort_name', 'block_homework_diary'),
        get_string('settings_secretary_cohort_desc', 'block_homework_diary'),
        0,
        $cohortlist
    )
);

// Additonal HTML.
$settings->add(
    new admin_setting_heading(
        'block_homework_diary/additional_html_heading',
        get_string('settings_additional_html_heading_name', 'block_homework_diary'),
        get_string('settings_additional_html_heading_desc', 'block_homework_diary')
    ));

$settings->add(
    new admin_setting_confightmleditor(
        'block_homework_diary/additional_html_top',
        get_string('settings_additional_html_top_name', 'block_homework_diary'),
        get_string('settings_additional_html_top_desc', 'block_homework_diary'),
        '',
        PARAM_RAW
    )
);

$settings->add(
    new admin_setting_confightmleditor(
        'block_homework_diary/additional_html_bottom',
        get_string('settings_additional_html_bottom_name', 'block_homework_diary'),
        get_string('settings_additional_html_bottom_desc', 'block_homework_diary'),
        '',
        PARAM_RAW
    )
);
