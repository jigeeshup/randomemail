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
 * Library functions for randomemail
 *
 * @package    local_randomemail
 * @author     Jigeeshu Vijayan <jigeeshumail@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Creates a user object
 *
 * @param text firstname of user.
 * @param text lastname of user.
 * @param text email of user.
 *
 * @return object the newly created user object.
 */
function getuser($firstname, $lastname, $email) {
    $user = new StdClass();
    $user->email = $email;
    $user->firstname = $firstname;
    $user->lastname = $lastname;
    $user->maildisplay = true;
    $user->mailformat = 1;
    $user->id = -99;
    $user->firstnamephonetic = "";
    $user->lastnamephoneticc = "";
    $user->middlenamec = "";
    $user->alternatenamec = "";
    return  $user;
}

/**
 * Send random email to a user
 *
 * @param int user id.
 *
 * @return send mail status.
 */
function sendemail($uid) {
    global $DB;
    $touser = $DB->get_record('randomemail_user', ['id' => $uid]);
    $touser = getuser($touser->firstname , $touser->lastname , $touser->email);
    $fromuser = getuser('jigeeshu', 'vijayan', 'jigeeshumail@gmail.com');
    $subject = "Welcome to Random Mail plugin-".date("h:i:s d-M-Y ");
    $messagetext = '';
    $messagehtml = 'Dear '.$touser->firstname.' '.$touser->lastname.',<br>
    Welcome  to random mail system<br>
    Take care!<br>Thank you';
    $result = email_to_user($touser, $fromuser, $subject, $messagetext, $messagehtml, '', '', true);
    return $result;
}

/**
 * save mail send status
 *
 * @param int user id.
 *
 * @return
 */
function savestatus($uid) {
    global $DB;
    $mailstatus = new stdClass();
    $mailstatus->userid = $uid;
    $mailstatus->mail_sendon = time();
    return $DB->insert_record('randomemail_status', $mailstatus);
}
