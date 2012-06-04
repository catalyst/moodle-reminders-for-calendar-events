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

require_once($CFG->dirroot . '/local/reminders/reminder.class.php');

/**
 * Class to specify the reminder message object for site (global) events.
 *
 * @package    local
 * @subpackage reminders
 * @copyright  2012 Isuru Madushanka Weerarathna
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class user_reminder extends reminder {
    
    private $user;
    
    public function __construct($user, $event, $notificationstyle = 1) {
        parent::__construct($event, $notificationstyle);
        $this->user = $user;
    }
    
    public function get_message_html() {
        $htmlmail = $this->get_html_header().'\n';
        $htmlmail .= '<body id=\"email\">\n<div>\n';
        $htmlmail .= '<table cellspacing="0" cellpadding="8" border="0" summary="" style="'.$this->bodycssstyle.'">';
        $htmlmail .= '<tr><td><h3 style="'.$this->titlestyle.'">'.$this->get_message_title().'</h3></td></tr>';
        $htmlmail .= '<tr><td>When</td><td>'.$this->format_event_time_duration().'</td></tr>';
        $htmlmail .= '<tr><td>User</td><td>'.$this->user->firstname.' '.$this->user->lastname.'</td></tr>';
        $htmlmail .= '<tr><td>Description</td><td>'.$event->description.'</td></tr>';
        $htmlmail .= $this->get_html_footer();
        $htmlmail .= '</table>\n</body>\n</html>';
        
        return $htmlmail;
    }
    
    public function get_message_plaintext() {
        
    }

    protected function get_message_provider() {
        return 'reminders_user';
    }

    public function get_message_title() {
        return $this->user->firstname . ' ' . $this->user->lastname . ' : ' . $this->event->name;
    }
}