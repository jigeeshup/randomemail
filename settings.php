<?php
// This file is part of randomemail plugin for Moodle - http://moodle.org/
//
// randomemail is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// randomemail is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Settings for randomemail
 *
 * @package    local_randomemail
 * @author     Jigeeshu Vijayan <jigeeshumail@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    if ($CFG->branch >= 32) { // Moodle 3.2 and later.
        $section = 'users';
    } else { // Up to and including Moodle 3.1.x .
        $section = 'server';
    }
    $ADMIN->add($section, new admin_externalpage('local_randomemail',
            get_string('pluginnav', 'local_randomemail'),
            new moodle_url('/local/randomemail/')
    ));
}
