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
 * Index for randomemail
 *
 * @package    local_randomemail
 * @author     Jigeeshu Vijayan <jigeeshumail@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


// Include config.php.
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');

global $DB;
// Ensure only administrators have access.
$homeurl = new moodle_url('/');
require_login();
if (!is_siteadmin()) {
    redirect($homeurl, "This feature is only available for site administrators.", 5);
}

$pluginname = 'randomemail';
$title = get_string('pluginname', 'local_' . $pluginname);
$heading = get_string('heading', 'local_' . $pluginname);
$url = new moodle_url('/local/' . $pluginname . '/');
if ($CFG->branch >= 25) { // Moodle 2.5+.
    $context = context_system::instance();
} else {
    $context = get_system_context();
}

$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);

$users = $DB->get_records('randomemail_user');
echo $OUTPUT->header();
$maillink = $CFG->wwwroot."/local/randomemail/sendmail.php";
$templatecontext = (object)[
  'users' => array_values($users),
  'mail_link' => $maillink,
  'head' => get_string('user_report', 'local_randomemail'),
  'sendmailtext' => get_string('sendmail', 'local_randomemail')
];

echo $OUTPUT->render_from_template('local_randomemail/user_list', $templatecontext);

echo $OUTPUT->footer();
