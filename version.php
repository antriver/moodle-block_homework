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
 * Homework diary version.
 *
 * @package    block_homework
 * @copyright  Anthony Kuske <www.anthonykuske.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/** @var stdClass $plugin */
$plugin->version = 2015110905; // The current plugin version (Date: YYYYMMDDXX)
$plugin->requires = 2013111800; // MOODLE_26_STABLE
$plugin->component = 'block_homework'; // Full name of the plugin (used for diagnostics).
