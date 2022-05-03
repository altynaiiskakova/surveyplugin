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
 * Define all the backup steps that will be used by the backup_surveyplugin_activity_task
 *
 * @package     mod_surveyplugin
 * @category    backup
 */
defined('MOODLE_INTERNAL') || die;

/**
 * Define the complete surveyplugin structure for backup, with file and id annotations
 *
 * @package     mod_surveyplugin
 * @category    backup
 */
class backup_surveyplugin_activity_structure_step extends backup_activity_structure_step {

    /**
     * Defines the backup structure of the module
     *
     * @return backup_nested_element
     * @throws base_element_struct_exception
     * @throws base_step_exception
     */
    protected function define_structure() {
        // Define the root element describing the surveyplugin instance.
        $surveyplugin = new backup_nested_element('surveyplugin',
                array('id'),
                array(
                        'name',
                        'item',
                        'survey_id',
                        'item_id',
                        'item_answer_id'
                )
        );

        // Define data sources.
        $surveyplugin->set_source_table('surveyplugin_items', array('id' => backup::VAR_ACTIVITYID));
        // If we were referring to other tables, we would annotate the relation
        // with the element's annotate_ids() method.

        return $this->prepare_activity_structure($surveyplugin);
    }
}
