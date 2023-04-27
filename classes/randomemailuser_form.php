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
 * Upload form for randomemail user.
 *
 * @package    local_randomemail
 * @author     Jigeeshu Vijayan <jigeeshumail@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die;
require_once($CFG->libdir . '/formslib.php');


class Randomemailuser_form extends moodleform {

    /**
     * Define the form.
     */

    public function definition() {
        $maxbytes = 100;
        $mform = $this->_form;
        $mform->addElement('html', '<div class="row"><div class="col-md-6"><a href="userlist.php" class="btn btn-primary">
        User Report</a></div>');
        $mform->addElement('html', '<div class="col-md-6"><a href="maillist.php" class="btn btn-primary">
        Mail Report</a></div></div>');

        $url = new moodle_url('example.csv');
        $link = html_writer::link($url, 'example.csv');
        $mform->addElement('static', 'examplecsv', get_string('examplecsv', 'local_randomemail'), $link);
        $mform->addHelpButton('examplecsv', 'examplecsv', 'tool_uploaduser');
        // Header.

        $mform->addElement('html', '<p>' . get_string('pluginname_help', 'local_randomemail') . '</p>');

        // Upload CSV.
        $mform->addElement('filepicker', 'userfile', get_string('uploadcsv', 'local_randomemail'), null,
        ['maxbytes' => $maxbytes, 'accepted_types' => ['text/csv']]);
        $mform->addRule('userfile', null, 'required');
        $buttonarray = array();
        $buttonarray[] = $mform->createElement('submit', 'send', get_string('upload', 'local_randomemail'));
        $buttonarray[] = $mform->createElement('cancel');
        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
        $mform->closeHeaderBefore('buttonar');
    }

    /**
     * Validate submitted form data, recipient in this case, and returns list of errors if it fails.
     *
     * @param      array  $data   The data fields submitted from the form.
     * @param      array  $files  Files submitted from the form (not used)
     *
     * @return     array  List of errors to be displayed on the form if validation fails.
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);
        return $errors;
    }
}
