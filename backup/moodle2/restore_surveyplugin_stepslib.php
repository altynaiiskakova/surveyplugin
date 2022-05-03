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
 * Define all the restore steps that will be used by the restore_surveyplugin_activity_task
 *
 * @package     mod_surveyplugin
 * @category    backup
 */

if (!defined('MOODLE_INTERNAL')) {
    die ('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

/**
 * Class restore_surveyplugin_activity_structure_step
 *
 * @package     mod_surveyplugin
 * @category    backup
 */
class restore_surveyplugin_activity_structure_step extends restore_activity_structure_step {

    /**
     * Defines structure of path elements to be processed during the restore
     *
     * @return array of {@link restore_path_element}
     * @throws base_step_exception
     */
    protected function define_structure() {
        $paths = array();

        $paths[] = new restore_path_element('surveyplugin', '/activity/surveyplugin');

        // Return the paths wrapped into standard activity structure.
        return $this->prepare_activity_structure($paths);
    }

    /**
     * Process the given restore path element data
     *
     * @param array $data parsed element data
     * @throws base_step_exception
     * @throws dml_exception
     */
    protected function process_surveyplugin($data) {
        global $DB;
        $data = (object)$data;
        $data->course = $this->get_courseid();
        if (empty($data->timecreated)) {
            $data->timecreated = time();
        }
        if (empty($data->timemodified)) {
            $data->timemodified = time();
        }
        // Create the surveyplugin instance.
        $newitemid = $DB->insert_record('surveyplugin_items', $data);
        $this->apply_activity_instance($newitemid);
    }

    /**
     * Post-execution actions
     */
    protected function after_execute() {
        // Add surveyplugin related files, no need to match by itemname (just internally handled context).
        $this->add_related_files('mod_surveyplugin', 'intro', null);
    }
}
