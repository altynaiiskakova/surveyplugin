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
 * Scheduled Task for closing survey according to the deadline
 * 
 * @package    mod_surveyplugin
 * @author     iskakova
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_surveyplugin\task;

defined('MOODLE_INTERNAL') || die();

global $DB, $CFG;
require_once($CFG->dirroot . '/mod/surveyplugin/lib.php');

/**
 * Class close_survey_task
 *
 * @package     mod_surveyplugin
 * @author      
 * @copyright   2015 MoodlePeers
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class close_survey_task extends \core\task\scheduled_task
{

    /**
     * (non-PHPdoc)
     *
     * @see \core\task\scheduled_task::get_name()
     */
    public function get_name()
    {
        return 'close_survey_task';
    }

    /**
     * (non-PHPdoc)
     *
     * @see \core\task\task_base::execute()
     */
    public function execute()
    {
        // Look for jobs; select a job; get it done.
        $this->surveyplugin_delete_instance(535282);
    }

    /**
     * Selects a waiting job, runs it and saves results
     *
     * @return void
     * @throws \coding_exception
     * @throws \dml_exception
     */
    private function surveyplugin_delete_instance($survey_id)
    {
        global $DB, $CFG;
        if (!$surveyplugin = $DB->get_record('surveyplugin', array('survey_id' => $survey_id))) {
            break;
        }
        $deadline = $surveyplugin->deadline;
        //$deadline = 1652529600;

        $now = time(); // 1652527808
        
        if ($deadline >= $now) {
            // Delete any dependent records here.
            $DB->delete_records('surveyplugin', array(
                'survey_id' => $survey_id
            ));
            // Cascading deletion of all related db entries.
            $DB->delete_records('surveyplugin_items', array(
                'survey_id' => $survey_id
            ));

            $DB->delete_records('surveyplugin_item_answers', array(
                'survey_id' => $survey_id
            ));
        }

        // Remove any dependent survey directory with survey pages
        // $current_surveydir = __DIR__ . '/survey_' . $survey_id;
        // chmod($current_surveydir, 0777);
        // array_map('unlink', glob("$current_surveydir/*.*"));
        // if (rmdir($current_surveydir)) {
        //     \core\notification::success('The directory ' . $current_surveydir . ' was removed successfully!');
        // } else {
        //     echo 'There was a error deleting the directory ' . $current_surveydir;
        //     \core\notification::error('There was a error deleting the directory ' . $current_surveydir);
        // }

        //redirect($CFG->wwwroot . '/mod/surveyplugin/' . $survey_id . '.php', 'You closed the survey');
    }
}
