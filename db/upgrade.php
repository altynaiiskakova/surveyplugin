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
 * Upgrade function for database changes
 *
 * @package     mod_surveyplugin
 * @author      Eduard Gallwas, Johannes Konert, Rene Roepke, Nora Wester, Ahmed Zukic
 * @copyright   2015 MoodlePeers
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die ();

/**
 * Execute surveyplugin upgrade from the given old version
 *
 * @param int $oldversion
 * @return bool
 * @throws ddl_exception
 * @throws ddl_field_missing_exception
 * @throws ddl_table_missing_exception
 * @throws dml_exception
 * @throws downgrade_exception
 * @throws upgrade_exception
 */
// function xmldb_surveyplugin_upgrade($oldversion) {
//     global $DB;
//     $dbman = $DB->get_manager(); // Loads ddl manager and xmldb classes.

//     if ($oldversion < 2015041701) {

//         $table = new xmldb_table ('surveyplugin');
//         $field = new xmldb_field ('szenario', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0', 'grade');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         $table = new xmldb_table ('surveyplugin');
//         $field = new xmldb_field ('knowledge', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0',
//                 'szenario');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         $table = new xmldb_table ('surveyplugin');
//         $field = new xmldb_field ('knowledgelines', XMLDB_TYPE_TEXT, 'medium', null, null, null, null, 'knowledge');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         $table = new xmldb_table ('surveyplugin');
//         $field = new xmldb_field ('topics', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0',
//                 'knowledgelines');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         $table = new xmldb_table ('surveyplugin');
//         $field = new xmldb_field ('topiclines', XMLDB_TYPE_TEXT, 'medium', null, null, null, null, 'topics');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         $table = new xmldb_table ('surveyplugin');
//         $field = new xmldb_field ('maxmembers', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0',
//                 'topiclines');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         $table = new xmldb_table ('surveyplugin');
//         $field = new xmldb_field ('maxgroups', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0',
//                 'maxmembers');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         $table = new xmldb_table ('surveyplugin');
//         $field = new xmldb_field ('evaluationmethod', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0',
//                 'maxgroups');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         upgrade_mod_savepoint(true, 2015041701, 'surveyplugin');
//     }

//     if ($oldversion < 2015041900) {

//         $table = new xmldb_table ('surveyplugin');
//         $field = new xmldb_field ('groupoption', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0',
//                 'topiclines');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         upgrade_mod_savepoint(true, 2015041900, 'surveyplugin');
//     }

//     if ($oldversion < 2015051300) {

//         $table = new xmldb_table ('surveyplugin');
//         $field = new xmldb_field ('maxpoints', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '100',
//                 'evaluationmethod');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         upgrade_mod_savepoint(true, 2015051300, 'surveyplugin');
//     }

//     if ($oldversion < 2015052802) {

//         $table = new xmldb_table ('surveyplugin');
//         $field = new xmldb_field ('groupname', XMLDB_TYPE_TEXT, 'medium', null, null, null, 'group', 'maxgroups');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         upgrade_mod_savepoint(true, 2015052802, 'surveyplugin');
//     }

//     if ($oldversion < 2015060100) {

//         $table = new xmldb_table ('surveyplugin_started');
//         $field = new xmldb_field ('timecompleted', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, '0', 'completed');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         $table = new xmldb_table ('surveyplugin_started');
//         $field = new xmldb_field ('groupid', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, null, null, null, 'timecompleted');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         upgrade_mod_savepoint(true, 2015060100, 'surveyplugin');
//     }

//     if ($oldversion < 2015060500) {

//         $table = new xmldb_table ('surveyplugin_logging');

//         $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);

//         $table->add_key('primary', XMLDB_KEY_PRIMARY, array(
//                 'id'));

//         if (!$dbman->table_exists($table)) {
//             $dbman->create_table($table);
//         }

//         upgrade_mod_savepoint(true, 2015060500, 'surveyplugin');
//     }

//     if ($oldversion < 2015060501) {
//         // Define field timestamp to be added to surveyplugin_logging.
//         $table = new xmldb_table ('surveyplugin_logging');
//         $field = new xmldb_field ('timestamp', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'id');

//         // Conditionally launch add field timestamp.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field userid to be added to surveyplugin_logging.
//         $table = new xmldb_table ('surveyplugin_logging');
//         $field = new xmldb_field ('userid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'timestamp');

//         // Conditionally launch add field userid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field surveypluginid to be added to surveyplugin_logging.
//         $table = new xmldb_table ('surveyplugin_logging');
//         $field = new xmldb_field ('surveypluginid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'userid');

//         // Conditionally launch add field surveypluginid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field message to be added to surveyplugin_logging.
//         $table = new xmldb_table ('surveyplugin_logging');
//         $field = new xmldb_field ('message', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'surveypluginid');

//         // Conditionally launch add field message.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015060501, 'surveyplugin');
//     }

//     if ($oldversion < 2015061700) {

//         // Define table surveyplugin_logging to be created.
//         $table = new xmldb_table ('surveyplugin_jobs');

//         // Adding fields to table surveyplugin_logging.
//         $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);

//         // Adding keys to table surveyplugin_logging.
//         $table->add_key('primary', XMLDB_KEY_PRIMARY, array(
//                 'id'));

//         // Conditionally launch create table for surveyplugin_logging.
//         if (!$dbman->table_exists($table)) {
//             $dbman->create_table($table);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015061700, 'surveyplugin');
//     }

//     if ($oldversion < 2015061801) {

//         // Define field surveypluginid to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('surveypluginid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'id');

//         // Conditionally launch add field surveypluginid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field waiting to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('waiting', XMLDB_TYPE_INTEGER, '1', null, null, null, '0', 'surveypluginid');

//         // Conditionally launch add field waiting.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field started to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('started', XMLDB_TYPE_INTEGER, '1', null, null, null, '0', 'waiting');

//         // Conditionally launch add field started.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field aborted to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('aborted', XMLDB_TYPE_INTEGER, '1', null, null, null, '0', 'started');

//         // Conditionally launch add field aborted.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field done to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('done', XMLDB_TYPE_INTEGER, '1', null, null, null, '0', 'aborted');

//         // Conditionally launch add field done.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field timecreated to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('timecreated', XMLDB_TYPE_INTEGER, '10', null, null, null, '0', 'done');

//         // Conditionally launch add field timecreated.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field timestarted to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('timestarted', XMLDB_TYPE_INTEGER, '10', null, null, null, '0', 'timecreated');

//         // Conditionally launch add field timestarted.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field timefinished to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('timefinished', XMLDB_TYPE_INTEGER, '10', null, null, null, '0', 'timestarted');

//         // Conditionally launch add field timefinished.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015061801, 'surveyplugin');
//     }

//     if ($oldversion < 2015061809) {

//         // Define field optionmax to be added to surveyplugin_motivation.
//         $table = new xmldb_table ('surveyplugin_motivation');
//         $field = new xmldb_field ('optionmax', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'position');

//         // Conditionally launch add field optionmax.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field id to be added to surveyplugin_team.
//         $table = new xmldb_table ('surveyplugin_team');
//         $field = new xmldb_field ('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);

//         // Conditionally launch add field id.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field optionmax to be added to surveyplugin_grade.
//         $table = new xmldb_table ('surveyplugin_grade');
//         $field = new xmldb_field ('optionmax', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'position');

//         // Conditionally launch add field optionmax.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field id to be added to surveyplugin_learning.
//         $table = new xmldb_table ('surveyplugin_learning');
//         $field = new xmldb_field ('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);

//         // Conditionally launch add field id.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field optionmax to be added to surveyplugin_character.
//         $table = new xmldb_table ('surveyplugin_character');
//         $field = new xmldb_field ('optionmax', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'position');

//         // Conditionally launch add field optionmax.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field id to be added to surveyplugin_general.
//         $table = new xmldb_table ('surveyplugin_general');
//         $field = new xmldb_field ('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);

//         // Conditionally launch add field id.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         $tablenames = array('srl', 'sellmo', 'self');

//         foreach ($tablenames as $tablename) {

//             // Define table surveyplugin_srl to be created.
//             $table = new xmldb_table ('surveyplugin_' . $tablename);

//             // Adding fields to table surveyplugin_srl.
//             $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
//             $table->add_field('type', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
//             $table->add_field('question', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
//             $table->add_field('options', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
//             $table->add_field('language', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
//             $table->add_field('position', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
//             $table->add_field('optionmax', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');

//             // Adding keys to table surveyplugin_srl.
//             $table->add_key('primary', XMLDB_KEY_PRIMARY, array(
//                     'id'));

//             // Conditionally launch create table for surveyplugin_srl.
//             if (!$dbman->table_exists($table)) {
//                 $dbman->create_table($table);
//             }
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015061809, 'surveyplugin');
//     }

//     if ($oldversion < 2015070100) {

//         // Define table surveyplugin_groups to be created.
//         $table = new xmldb_table ('surveyplugin_groups');

//         // Adding fields to table surveyplugin_groups.
//         $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
//         $table->add_field('surveyplugin', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
//         $table->add_field('groupid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
//         $table->add_field('groupname', XMLDB_TYPE_CHAR, '255', null, null, null, null);

//         // Adding keys to table surveyplugin_groups.
//         $table->add_key('primary', XMLDB_KEY_PRIMARY, array(
//                 'id'));
//         $table->add_key('surveyplugin', XMLDB_KEY_FOREIGN, array('surveyplugin'), 'surveyplugin', array('id'));

//         // Conditionally launch create table for surveyplugin_groups.
//         if (!$dbman->table_exists($table)) {
//             $dbman->create_table($table);
//         }
//         // Define table surveyplugin_group_users to be created.
//         $table = new xmldb_table ('surveyplugin_group_users');

//         // Adding fields to table surveyplugin_group_users.
//         $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
//         $table->add_field('surveyplugin', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
//         $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
//         $table->add_field('groupid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

//         // Adding keys to table surveyplugin_group_users.
//         $table->add_key('primary', XMLDB_KEY_PRIMARY, array(
//                 'id'));
//         $table->add_key('surveyplugin', XMLDB_KEY_FOREIGN, array('surveyplugin'), 'surveyplugin', array('id'));

//         // Conditionally launch create table for surveyplugin_group_users.
//         if (!$dbman->table_exists($table)) {
//             $dbman->create_table($table);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015070100, 'surveyplugin');
//     }

//     if ($oldversion < 2015070102) {

//         // Changing nullability of field groupid on table surveyplugin_groups to not null.
//         $table = new xmldb_table ('surveyplugin_groups');
//         $field = new xmldb_field ('groupid', XMLDB_TYPE_INTEGER, '10', null, null, null, '0', 'surveyplugin');

//         // Launch change of nullability for field groupid.
//         $dbman->change_field_notnull($table, $field);

//         // Rename field groupid on table surveyplugin_groups to NEWNAMEGOESHERE.
//         $table = new xmldb_table ('surveyplugin_groups');
//         $field = new xmldb_field ('groupid', XMLDB_TYPE_INTEGER, '10', null, null, null, '0', 'surveyplugin');

//         // Launch rename field groupid.
//         $dbman->rename_field($table, $field, 'moodlegroupid');

//         // Changing the default of field moodlegroupid on table surveyplugin_groups to drop it.
//         $table = new xmldb_table ('surveyplugin_groups');
//         $field = new xmldb_field ('moodlegroupid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'surveyplugin');

//         // Launch change of default for field moodlegroupid.
//         $dbman->change_field_default($table, $field);

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015070102, 'surveyplugin');
//     }

//     if ($oldversion < 2015070103) {

//         // Define field groupal to be added to surveyplugin_groups.
//         $table = new xmldb_table ('surveyplugin_groups');
//         $field = new xmldb_field ('groupal', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'groupname');

//         // Conditionally launch add field groupal.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field random to be added to surveyplugin_groups.
//         $table = new xmldb_table ('surveyplugin_groups');
//         $field = new xmldb_field ('random', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'groupal');

//         // Conditionally launch add field random.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field mrandom to be added to surveyplugin_groups.
//         $table = new xmldb_table ('surveyplugin_groups');
//         $field = new xmldb_field ('mrandom', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'random');

//         // Conditionally launch add field mrandom.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field created to be added to surveyplugin_groups.
//         $table = new xmldb_table ('surveyplugin_groups');
//         $field = new xmldb_field ('created', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'mrandom');

//         // Conditionally launch add field created.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015070103, 'surveyplugin');
//     }

//     if ($oldversion < 2015070600) {

//         // Define field performance_index to be added to surveyplugin_groups.
//         $table = new xmldb_table ('surveyplugin_groups');
//         $field = new xmldb_field ('performance_index', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'groupname');

//         // Conditionally launch add field performance_index.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015070600, 'surveyplugin');
//     }

//     if ($oldversion < 2015071600) {

//         // Changing nullability of field userid on table surveyplugin_logging to null.
//         $table = new xmldb_table ('surveyplugin_logging');
//         $field = new xmldb_field ('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'timestamp');

//         // Launch change of nullability for field userid.
//         $dbman->change_field_notnull($table, $field);

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015071600, 'surveyplugin');
//     }

//     if ($oldversion < 2015072000) {

//         // Define field matcher_used to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('matcher_used', XMLDB_TYPE_TEXT, null, null, null, null, null, 'timefinished');

//         // Conditionally launch add field matcher_used.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field count_groups to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('count_groups', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'matcher_used');

//         // Conditionally launch add field count_groups.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field performance_index to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('performance_index', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'count_groups');

//         // Conditionally launch add field performance_index.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_avg_variance to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('stats_avg_variance', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null,
//                 'performance_index');

//         // Conditionally launch add field stats_avg_variance.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_variance to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('stats_variance', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null,
//                 'stats_avg_variance');

//         // Conditionally launch add field stats_variance.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_n to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('stats_n', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'stats_variance');

//         // Conditionally launch add field stats_n.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_avg to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('stats_avg', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'stats_n');

//         // Conditionally launch add field stats_avg.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_st_dev to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('stats_st_dev', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'stats_avg');

//         // Conditionally launch add field stats_st_dev.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_norm_st_dev to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('stats_norm_st_dev', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'stats_st_dev');

//         // Conditionally launch add field stats_norm_st_dev.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_performance_index to be added to surveyplugin_jobs.
//         $table = new xmldb_table ('surveyplugin_jobs');
//         $field = new xmldb_field ('stats_performance_index', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null,
//                 'stats_norm_st_dev');

//         // Conditionally launch add field stats_performance_index.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015072000, 'surveyplugin');
//     }

//     if ($oldversion < 2015072200) {

//         // Changing nullability of field surveypluginid on table surveyplugin_logging to not null.
//         $table = new xmldb_table('surveyplugin_logging');
//         $field = new xmldb_field('surveypluginid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'userid');

//         // Launch change of nullability for field surveypluginid.
//         $dbman->change_field_notnull($table, $field);

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015072200, 'surveyplugin');
//     }

//     if ($oldversion < 2015072201) {

//         // Changing type of field timestamp on table surveyplugin_logging to number.
//         $table = new xmldb_table('surveyplugin_logging');
//         $field = new xmldb_field('timestamp', XMLDB_TYPE_NUMBER, '20, 8', null, XMLDB_NOTNULL, null, null, 'id');

//         // Launch change of type for field timestamp.
//         $dbman->change_field_type($table, $field);

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015072201, 'surveyplugin');
//     }

//     if ($oldversion < 2015081300) {

//         // Define field answer_count to be added to surveyplugin_started.
//         $table = new xmldb_table('surveyplugin_started');
//         $field = new xmldb_field('answer_count', XMLDB_TYPE_INTEGER, '20', null, null, null, '0', 'groupid');

//         // Conditionally launch add field answer_count.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015081300, 'surveyplugin');
//     }

//     if ($oldversion < 2015092600) {

//         // Define field onlyactivestudents to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('onlyactivestudents', XMLDB_TYPE_INTEGER, '1', null, null, null, null, 'maxpoints');

//         // Conditionally launch add field onlyactivestudents.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field emailnotifications to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('emailnotifications', XMLDB_TYPE_INTEGER, '1', null, null, null, null,
//                 'onlyactivestudents');

//         // Conditionally launch add field emailnotifications.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015092600, 'surveyplugin');
//     }

//     if ($oldversion < 2015100100) {

//         // Define field started_by to be added to surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('started_by', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'done');

//         // Conditionally launch add field started_by.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015100100, 'surveyplugin');
//     }

//     if ($oldversion < 2015100300) {

//         // Define table surveyplugin_grade to be created.
//         $tablepoints = new xmldb_table('surveyplugin_points');

//         // Adding fields to table surveyplugin_grade.
//         $tablepoints->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
//         $tablepoints->add_field('type', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
//         $tablepoints->add_field('question', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
//         $tablepoints->add_field('options', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
//         $tablepoints->add_field('language', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
//         $tablepoints->add_field('position', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
//         $tablepoints->add_field('optionmax', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');

//         // Adding keys to table surveyplugin_grade.
//         $tablepoints->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

//         // Conditionally launch create table for surveyplugin_grade.
//         if (!$dbman->table_exists($tablepoints)) {
//             $dbman->create_table($tablepoints);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015100300, 'surveyplugin');
//     }

//     if ($oldversion < 2015100301) {

//         // Define field questionid to be added to surveyplugin_team.
//         $table = new xmldb_table('surveyplugin_team');
//         $field = new xmldb_field('questionid', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'id');

//         // Conditionally launch add field questionid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field questionid to be added to surveyplugin_team.
//         $table = new xmldb_table('surveyplugin_motivation');
//         $field = new xmldb_field('questionid', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'id');

//         // Conditionally launch add field questionid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field questionid to be added to surveyplugin_team.
//         $table = new xmldb_table('surveyplugin_grade');
//         $field = new xmldb_field('questionid', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'id');

//         // Conditionally launch add field questionid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field questionid to be added to surveyplugin_team.
//         $table = new xmldb_table('surveyplugin_general');
//         $field = new xmldb_field('questionid', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'id');

//         // Conditionally launch add field questionid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field questionid to be added to surveyplugin_team.
//         $table = new xmldb_table('surveyplugin_character');
//         $field = new xmldb_field('questionid', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'id');

//         // Conditionally launch add field questionid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field questionid to be added to surveyplugin_team.
//         $table = new xmldb_table('surveyplugin_learning');
//         $field = new xmldb_field('questionid', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'id');

//         // Conditionally launch add field questionid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field questionid to be added to surveyplugin_team.
//         $table = new xmldb_table('surveyplugin_points');
//         $field = new xmldb_field('questionid', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'id');

//         // Conditionally launch add field questionid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field questionid to be added to surveyplugin_team.
//         $table = new xmldb_table('surveyplugin_self');
//         $field = new xmldb_field('questionid', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'id');

//         // Conditionally launch add field questionid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field questionid to be added to surveyplugin_team.
//         $table = new xmldb_table('surveyplugin_srl');
//         $field = new xmldb_field('questionid', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'id');

//         // Conditionally launch add field questionid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field questionid to be added to surveyplugin_team.
//         $table = new xmldb_table('surveyplugin_sellmo');
//         $field = new xmldb_field('questionid', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'id');

//         // Conditionally launch add field questionid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015100301, 'surveyplugin');
//     }

//     if ($oldversion < 2015100303) {

//         global $DB;

//         $tables = array('team', 'motivation', 'character', 'general', 'grade', 'learning', 'points', 'self', 'sellmo', 'srl');

//         foreach ($tables as $table) {
//             $records = $DB->get_records('surveyplugin_' . $table);

//             foreach ($records as $record) {
//                 $record->questionid = $record->position;
//                 $DB->update_record('surveyplugin_' . $table, $record);
//             }
//         }
//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015100303, 'surveyplugin');
//     }

//     if ($oldversion < 2015102400) {

//         // Define field answers_ready to be added to surveyplugin_started.
//         $table = new xmldb_table('surveyplugin_started');
//         $field = new xmldb_field('answers_ready', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'answer_count');

//         // Conditionally launch add field answers_ready.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field answers_url to be added to surveyplugin_started.
//         $table = new xmldb_table('surveyplugin_started');
//         $field = new xmldb_field('answers_url', XMLDB_TYPE_TEXT, null, null, null, null, null, 'answers_ready');

//         // Conditionally launch add field answers_url.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015102400, 'surveyplugin');
//     }

//     if ($oldversion < 2015110900) {

//         // Define field topic_id to be added to surveyplugin_groups.
//         $table = new xmldb_table('surveyplugin_groups');
//         $field = new xmldb_field('topic_id', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'created');

//         // Conditionally launch add field topic_id.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field topic_name to be added to surveyplugin_groups.
//         $table = new xmldb_table('surveyplugin_groups');
//         $field = new xmldb_field('topic_name', XMLDB_TYPE_TEXT, null, null, null, null, null, 'topic_id');

//         // Conditionally launch add field topic_name.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015110900, 'surveyplugin');
//     }

//     if ($oldversion < 2015111000) {

//         // Define field group_size to be added to surveyplugin_groups.
//         $table = new xmldb_table('surveyplugin_groups');
//         $field = new xmldb_field('group_size', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'groupname');

//         // Conditionally launch add field group_size.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         global $DB;

//         $records = $DB->get_records('surveyplugin_groups');

//         foreach ($records as $record) {
//             $count = $DB->count_records('surveyplugin_group_users', array('groupid' => $record->id));
//             $record->group_size = $count;
//             $DB->update_record('surveyplugin_groups', $record);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015111000, 'surveyplugin');
//     }

//     if ($oldversion < 2015111200) {

//         // Define field groupingid to be added to surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('groupingid', XMLDB_TYPE_INTEGER, '20', null, null, null, null,
//                 'surveypluginid');

//         // Conditionally launch add field groupingid.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015111200, 'surveyplugin');
//     }

//     if ($oldversion < 2015111400) {

//         // Define field timestamp to be added to surveyplugin_answer.
//         $table = new xmldb_table('surveyplugin_answer');
//         $field = new xmldb_field('timestamp', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'answer');

//         // Conditionally launch add field timestamp.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015111400, 'surveyplugin');
//     }

//     if ($oldversion < 2015112100) {

//         // Rename field szenario on table surveyplugin_q_settings to archived.
//         $table = new xmldb_table('surveyplugin_q_settings');
//         $field = new xmldb_field('szenario', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'surveyplugin');

//         // Launch rename field szenario.
//         $dbman->rename_field($table, $field, 'archived');

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2015112100, 'surveyplugin');
//     }

//     if ($oldversion < 2016030400) {

//         // Define field consent to be added to surveyplugin_started.
//         $table = new xmldb_table('surveyplugin_started');
//         $field = new xmldb_field('consent', XMLDB_TYPE_INTEGER, '1', null, null, null, '0', 'answers_url');

//         // Conditionally launch add field consent.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016030400, 'surveyplugin');
//     }

//     if ($oldversion < 2016071300) {

//         // Define field participantcode to be added to surveyplugin_started.
//         $table = new xmldb_table('surveyplugin_started');
//         $field = new xmldb_field('participantcode', XMLDB_TYPE_TEXT, null, null, null, null, null, 'consent');

//         // Conditionally launch add field participantcode.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016071300, 'surveyplugin');
//     }

//     if ($oldversion < 2016071800) {

//         // Define field group_key to be added to surveyplugin_groups.
//         $table = new xmldb_table('surveyplugin_groups');
//         $field = new xmldb_field('group_key', XMLDB_TYPE_CHAR, 255, null, null, null, null, 'topic_name');

//         // Conditionally launch add field group_key.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016071800, 'surveyplugin');
//     }

//     if ($oldversion < 2016071801) {

//         // Define table surveyplugin_stats to be created.
//         $table = new xmldb_table('surveyplugin_stats');

//         // Adding fields to table surveyplugin_stats.
//         $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
//         $table->add_field('surveypluginid', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, null);
//         $table->add_field('group_key', XMLDB_TYPE_CHAR, 255, null, null, null, null);

//         // Adding keys to table surveyplugin_stats.
//         $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

//         // Conditionally launch create table for surveyplugin_stats.
//         if (!$dbman->table_exists($table)) {
//             $dbman->create_table($table);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016071801, 'surveyplugin');
//     }

//     if ($oldversion < 2016071802) {

//         $tablename = 'surveyplugin_stats';
//         // Define field matcher_used to be added to surveyplugin_jobs.
//         $table = new xmldb_table ($tablename);
//         $field = new xmldb_field ('matcher_used', XMLDB_TYPE_TEXT, null, null, null, null, null, 'group_key');

//         // Conditionally launch add field matcher_used.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field count_groups to be added to surveyplugin_stats.
//         $table = new xmldb_table ($tablename);
//         $field = new xmldb_field ('count_groups', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'matcher_used');

//         // Conditionally launch add field count_groups.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field performance_index to be added to surveyplugin_jobs.
//         $table = new xmldb_table ($tablename);
//         $field = new xmldb_field ('performance_index', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'count_groups');

//         // Conditionally launch add field performance_index.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_avg_variance to be added to surveyplugin_jobs.
//         $table = new xmldb_table ($tablename);
//         $field = new xmldb_field ('stats_avg_variance', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null,
//                 'performance_index');

//         // Conditionally launch add field stats_avg_variance.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_variance to be added to surveyplugin_jobs.
//         $table = new xmldb_table ($tablename);
//         $field = new xmldb_field ('stats_variance', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null,
//                 'stats_avg_variance');

//         // Conditionally launch add field stats_variance.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_n to be added to surveyplugin_jobs.
//         $table = new xmldb_table ($tablename);
//         $field = new xmldb_field ('stats_n', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'stats_variance');

//         // Conditionally launch add field stats_n.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_avg to be added to surveyplugin_jobs.
//         $table = new xmldb_table ($tablename);
//         $field = new xmldb_field ('stats_avg', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'stats_n');

//         // Conditionally launch add field stats_avg.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_st_dev to be added to surveyplugin_jobs.
//         $table = new xmldb_table ($tablename);
//         $field = new xmldb_field ('stats_st_dev', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'stats_avg');

//         // Conditionally launch add field stats_st_dev.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_norm_st_dev to be added to surveyplugin_jobs.
//         $table = new xmldb_table ($tablename);
//         $field = new xmldb_field ('stats_norm_st_dev', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'stats_st_dev');

//         // Conditionally launch add field stats_norm_st_dev.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field stats_performance_index to be added to surveyplugin_jobs.
//         $table = new xmldb_table ($tablename);
//         $field = new xmldb_field ('stats_performance_index', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null,
//                 'stats_norm_st_dev');

//         // Conditionally launch add field stats_performance_index.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016071802, 'surveyplugin');
//     }

//     if ($oldversion < 2016071901) {

//         // Changing type of field version on table surveyplugin_q_version to int.
//         $table = new xmldb_table('surveyplugin_q_version');
//         $field = new xmldb_field('version', XMLDB_TYPE_INTEGER, '12', null, XMLDB_NOTNULL, null, '0', 'category');

//         // Launch change of type for field version.
//         $dbman->change_field_type($table, $field);

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016071901, 'surveyplugin');
//     }

//     if ($oldversion < 2016071903) {

//         // Define table surveyplugin_question to be created.
//         $table = new xmldb_table('surveyplugin_question');

//         // Adding fields to table surveyplugin_question.
//         $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
//         $table->add_field('category', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
//         $table->add_field('questionid', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, null);
//         $table->add_field('type', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
//         $table->add_field('question', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
//         $table->add_field('options', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
//         $table->add_field('language', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
//         $table->add_field('position', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
//         $table->add_field('optionmax', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
//         $table->add_field('version', XMLDB_TYPE_INTEGER, '12', null, XMLDB_NOTNULL, null, null);

//         // Adding keys to table surveyplugin_question.
//         $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

//         // Conditionally launch create table for surveyplugin_question.
//         if (!$dbman->table_exists($table)) {
//             $dbman->create_table($table);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016071903, 'surveyplugin');
//     }

//     if ($oldversion < 2016072100) {

//         // Define field version to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('version', XMLDB_TYPE_INTEGER, '12', null, null, null, null, 'emailnotifications');

//         // Conditionally launch add field version.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016072100, 'surveyplugin');
//     }

//     if ($oldversion < 2016090700) {
//         // Define field count_groups to be added to surveyplugin_jobs and surveyplugin_stats.
//         $tablename = 'surveyplugin_jobs';
//         $table = new xmldb_table ($tablename);
//         $field = new xmldb_field ('count_groups', XMLDB_TYPE_INTEGER, '20', null, null, null, null, 'matcher_used');

//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         } else {
//             $dbman->change_field_type($table, $field, $continue = true, $feedback = true);
//         }
//         // Same now for stats.
//         $tablename = 'surveyplugin_stats';
//         $table = new xmldb_table ($tablename);
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         } else {
//             $dbman->change_field_type($table, $field, $continue = true, $feedback = true);
//         }
//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016090700, 'surveyplugin');
//     }

//     if ($oldversion < 2016092400) {

//         // Define table surveyplugin_team to be dropped.
//         $table = new xmldb_table('surveyplugin_team');

//         // Conditionally launch drop table for surveyplugin_team.
//         if ($dbman->table_exists($table)) {
//             $dbman->drop_table($table);
//         }

//         // Define table surveyplugin_motivation to be dropped.
//         $table = new xmldb_table('surveyplugin_motivation');

//         // Conditionally launch drop table for surveyplugin_motivation.
//         if ($dbman->table_exists($table)) {
//             $dbman->drop_table($table);
//         }

//         // Define table surveyplugin_grade to be dropped.
//         $table = new xmldb_table('surveyplugin_grade');

//         // Conditionally launch drop table for surveyplugin_grade.
//         if ($dbman->table_exists($table)) {
//             $dbman->drop_table($table);
//         }

//         // Define table surveyplugin_points to be dropped.
//         $table = new xmldb_table('surveyplugin_points');

//         // Conditionally launch drop table for surveyplugin_points.
//         if ($dbman->table_exists($table)) {
//             $dbman->drop_table($table);
//         }

//         // Define table surveyplugin_learning to be dropped.
//         $table = new xmldb_table('surveyplugin_learning');

//         // Conditionally launch drop table for surveyplugin_learning.
//         if ($dbman->table_exists($table)) {
//             $dbman->drop_table($table);
//         }

//         // Define table surveyplugin_character to be dropped.
//         $table = new xmldb_table('surveyplugin_character');

//         // Conditionally launch drop table for surveyplugin_character.
//         if ($dbman->table_exists($table)) {
//             $dbman->drop_table($table);
//         }

//         // Define table surveyplugin_general to be dropped.
//         $table = new xmldb_table('surveyplugin_general');

//         // Conditionally launch drop table for surveyplugin_general.
//         if ($dbman->table_exists($table)) {
//             $dbman->drop_table($table);
//         }

//         // Define table surveyplugin_srl to be dropped.
//         $table = new xmldb_table('surveyplugin_srl');

//         // Conditionally launch drop table for surveyplugin_srl.
//         if ($dbman->table_exists($table)) {
//             $dbman->drop_table($table);
//         }

//         // Define table surveyplugin_self to be dropped.
//         $table = new xmldb_table('surveyplugin_self');

//         // Conditionally launch drop table for surveyplugin_self.
//         if ($dbman->table_exists($table)) {
//             $dbman->drop_table($table);
//         }

//         // Define table surveyplugin_sellmo to be dropped.
//         $table = new xmldb_table('surveyplugin_sellmo');

//         // Conditionally launch drop table for surveyplugin_sellmo.
//         if ($dbman->table_exists($table)) {
//             $dbman->drop_table($table);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016092400, 'surveyplugin');
//     }

//     if ($oldversion < 2016092401) {

//         // Define table surveyplugin_user_values to be created.
//         $table = new xmldb_table('surveyplugin_user_values');

//         // Adding fields to table surveyplugin_user_values.
//         $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
//         $table->add_field('surveypluginid', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, null);
//         $table->add_field('userid', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, null);
//         $table->add_field('criterion', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
//         $table->add_field('label', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
//         $table->add_field('dimension', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, '0');
//         $table->add_field('value', XMLDB_TYPE_NUMBER, '20, 8', null, XMLDB_NOTNULL, null, null);

//         // Adding keys to table surveyplugin_user_values.
//         $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

//         // Conditionally launch create table for surveyplugin_user_values.
//         if (!$dbman->table_exists($table)) {
//             $dbman->create_table($table);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016092401, 'surveyplugin');
//     }

//     if ($oldversion < 2016092600) {

//         // Changing type of field criterion on table surveyplugin_user_values to char.
//         $table = new xmldb_table('surveyplugin_user_values');
//         $field = new xmldb_field('criterion', XMLDB_TYPE_CHAR, '40', null, XMLDB_NOTNULL, null, null, 'userid');

//         // Launch change of type for field criterion.
//         $dbman->change_field_type($table, $field);

//         // Changing type of field label on table surveyplugin_user_values to char.
//         $table = new xmldb_table('surveyplugin_user_values');
//         $field = new xmldb_field('label', XMLDB_TYPE_CHAR, '40', null, XMLDB_NOTNULL, null, null, 'criterion');

//         // Launch change of type for field label.
//         $dbman->change_field_type($table, $field);

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2016092600, 'surveyplugin');
//     }

//     if ($oldversion < 2017041300) {

//         // Define field matcher_used to be dropped from surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('matcher_used');

//         // Conditionally launch drop field matcher_used.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // Define field count_groups to be dropped from surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('count_groups');

//         // Conditionally launch drop field count_groups.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // Define field performance_index to be dropped from surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('performance_index');

//         // Conditionally launch drop field performance_index.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // Define field stats_avg_variance to be dropped from surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('stats_avg_variance');

//         // Conditionally launch drop field stats_variance.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }
//         // Define field stats_variance to be dropped from surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('stats_variance');

//         // Conditionally launch drop field stats_variance.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // Define field stats_n to be dropped from surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('stats_n');

//         // Conditionally launch drop field stats_n.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // Define field stats_avg to be dropped from surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('stats_avg');

//         // Conditionally launch drop field stats_avg.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // Define field stats_st_dev to be dropped from surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('stats_st_dev');

//         // Conditionally launch drop field stats_st_dev.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // Define field stats_norm_st_dev to be dropped from surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('stats_norm_st_dev');

//         // Conditionally launch drop field stats_norm_st_dev.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // Define field stats_performance_index to be dropped from surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('stats_performance_index');

//         // Conditionally launch drop field stats_performance_index.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2017041300, 'surveyplugin');
//     }

//     if ($oldversion < 2017041301) {

//         // Define field groups_generated to be added to surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('groups_generated', XMLDB_TYPE_INTEGER, '1', null, null, null, '0', 'done');

//         // Conditionally launch add field groups_generated.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field groups_adopted to be added to surveyplugin_jobs.
//         $table = new xmldb_table('surveyplugin_jobs');
//         $field = new xmldb_field('groups_adopted', XMLDB_TYPE_INTEGER, '1', null, null, null, '0', 'groups_generated');

//         // Conditionally launch add field groups_adopted.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2017041301, 'surveyplugin');
//     }

//     if ($oldversion < 2017060400) {

//         // Define table surveyplugin_scenario to be created.
//         $table = new xmldb_table('surveyplugin_scenario');

//         // Adding fields to table surveyplugin_scenario.
//         $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
//         $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
//         $table->add_field('version', XMLDB_TYPE_INTEGER, '12', null, XMLDB_NOTNULL, null, null);

//         // Adding keys to table surveyplugin_scenario.
//         $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

//         // Conditionally launch create table for surveyplugin_scenario.
//         if (!$dbman->table_exists($table)) {
//             $dbman->create_table($table);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2017060400, 'surveyplugin');
//     }

//     if ($oldversion < 2017060401) {

//         // Define table surveyplugin_scenario_cats to be created.
//         $table = new xmldb_table('surveyplugin_scenario_cats');

//         // Adding fields to table surveyplugin_scenario_cats.
//         $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
//         $table->add_field('scenario', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, null);
//         $table->add_field('category', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, null);

//         // Adding keys to table surveyplugin_scenario_cats.
//         $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

//         // Conditionally launch create table for surveyplugin_scenario_cats.
//         if (!$dbman->table_exists($table)) {
//             $dbman->create_table($table);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2017060401, 'surveyplugin');
//     }

//     if ($oldversion < 2017071100) {

//         // Define field allanswersrequired to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('allanswersrequired', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'version');

//         // Conditionally launch add field allanswersrequired.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2017071100, 'surveyplugin');
//     }

//     if ($oldversion < 2017081500) {

//         // Define field assigned_id to be added to surveyplugin_scenario.
//         $table = new xmldb_table('surveyplugin_scenario');
//         $field = new xmldb_field('assigned_id', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'version');

//         // Conditionally launch add field assigned_id.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2017081500, 'surveyplugin');
//     }

//     if ($oldversion < 2017081503) {

//         // Define field filtered to be added to surveyplugin_started.
//         $table = new xmldb_table('surveyplugin_started');
//         $field = new xmldb_field('filtered', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'participantcode');

//         // Conditionally launch add field filtered.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2017081503, 'surveyplugin');
//     }

//     if ($oldversion < 2017121401) {

//         // Changing type of field onlyactivestudents on table surveyplugin to int.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('onlyactivestudents', XMLDB_TYPE_INTEGER, '1', null, null, null, null, 'maxpoints');

//         // Launch change of type for field onlyactivestudents.
//         $dbman->change_field_type($table, $field);

//         // Changing type of field emailnotifications on table surveyplugin to int.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('emailnotifications', XMLDB_TYPE_INTEGER, '1', null, null, null, null, 'onlyactivestudents');

//         // Launch change of type for field emailnotifications.
//         $dbman->change_field_type($table, $field);

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2017121401, 'surveyplugin');
//     }

//     if ($oldversion < 2018042101) {

//         // Define field archived to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('archived', XMLDB_TYPE_INTEGER, '1', null, null, null, null, 'allanswersrequired');

//         // Conditionally launch add field archived.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field knowledgevalues to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('knowledgevalues', XMLDB_TYPE_TEXT, null, null, null, null, null, 'knowledgelines');

//         // Conditionally launch add field knowledgevalues.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field topicvalues to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('topicvalues', XMLDB_TYPE_TEXT, null, null, null, null, null, 'topiclines');

//         // Conditionally launch add field topicvalues.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018042101, 'surveyplugin');
//     }

//     if ($oldversion < 2018042102) {

//         // Define field knowledgenumber to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('knowledgenumber', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'knowledgevalues');

//         // Conditionally launch add field knowledgenumber.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field topicnumber to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('topicnumber', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'topicvalues');

//         // Conditionally launch add field topicnumber.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018042102, 'surveyplugin');
//     }

//     if ($oldversion < 2018051000) {

//         // Define field answers_ready to be dropped from surveyplugin_started.
//         $table = new xmldb_table('surveyplugin_started');
//         $field = new xmldb_field('answers_ready');

//         // Conditionally launch drop field answers_ready.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018051000, 'surveyplugin');
//     }

//     if ($oldversion < 2018051001) {

//         // Define field answers_url to be dropped from surveyplugin_started.
//         $table = new xmldb_table('surveyplugin_started');
//         $field = new xmldb_field('answers_url');

//         // Conditionally launch drop field answers_url.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018051001, 'surveyplugin');
//     }

//     if ($oldversion < 2018061701) {

//         // Define field state to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('state', XMLDB_TYPE_INTEGER, '3', null, XMLDB_NOTNULL, null, '0', 'archived');

//         // Conditionally launch add field state.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018061701, 'surveyplugin');
//     }

//     if ($oldversion < 2018061702) {

//         // Define table surveyplugin_started to be renamed to surveyplugin_users.
//         $table = new xmldb_table('surveyplugin_started');

//         // Launch rename table for surveyplugin_started.
//         $dbman->rename_table($table, 'surveyplugin_users');

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018061702, 'surveyplugin');
//     }

//     if ($oldversion < 2018061703) {

//         // Define table surveyplugin_answer to be renamed to surveyplugin_answers.
//         $table = new xmldb_table('surveyplugin_answer');

//         // Launch rename table for surveyplugin_answer.
//         $dbman->rename_table($table, 'surveyplugin_answers');

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018061703, 'surveyplugin');
//     }

//     if ($oldversion < 2018061704) {

//         // Define table surveyplugin_question to be renamed to NEWNAMEGOESHERE.
//         $table = new xmldb_table('surveyplugin_question');

//         // Launch rename table for surveyplugin_question.
//         $dbman->rename_table($table, 'surveyplugin_questions');

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018061704, 'surveyplugin');
//     }

//     if ($oldversion < 2018061705) {

//         // Define table surveyplugin_q_settings to be dropped.
//         $table = new xmldb_table('surveyplugin_q_settings');

//         // Conditionally launch drop table for surveyplugin_q_settings.
//         if ($dbman->table_exists($table)) {
//             $dbman->drop_table($table);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018061705, 'surveyplugin');
//     }

//     if ($oldversion < 2018061706) {

//         // Define field state to be added to surveyplugin_users.
//         $table = new xmldb_table('surveyplugin_users');
//         $field = new xmldb_field('state', XMLDB_TYPE_INTEGER, '3', null, XMLDB_NOTNULL, null, '0', 'filtered');

//         // Conditionally launch add field state.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018061706, 'surveyplugin');
//     }

//     if ($oldversion < 2018072100) {

//         // Rename field stats_avg_variance on table surveyplugin_stats to avg_variance.
//         $table = new xmldb_table('surveyplugin_stats');
//         $field = new xmldb_field('stats_avg_variance', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'performance_index');

//         // Launch rename field stats_avg_variance.
//         $dbman->rename_field($table, $field, 'avg_variance');

//         // Rename field stats_variance on table surveyplugin_stats to variance.
//         $table = new xmldb_table('surveyplugin_stats');
//         $field = new xmldb_field('stats_variance', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'stats_avg_variance');

//         // Launch rename field stats_variance.
//         $dbman->rename_field($table, $field, 'variance');

//         // Rename field stats_n on table surveyplugin_stats to n.
//         $table = new xmldb_table('surveyplugin_stats');
//         $field = new xmldb_field('stats_n', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'stats_variance');

//         // Launch rename field stats_n.
//         $dbman->rename_field($table, $field, 'n');

//         // Rename field stats_avg on table surveyplugin_stats to avg.
//         $table = new xmldb_table('surveyplugin_stats');
//         $field = new xmldb_field('stats_avg', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'stats_n');

//         // Launch rename field stats_avg.
//         $dbman->rename_field($table, $field, 'avg');

//         // Rename field stats_st_dev on table surveyplugin_stats to st_dev.
//         $table = new xmldb_table('surveyplugin_stats');
//         $field = new xmldb_field('stats_st_dev', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'stats_avg');

//         // Launch rename field stats_st_dev.
//         $dbman->rename_field($table, $field, 'st_dev');

//         // Rename field stats_norm_st_dev on table surveyplugin_stats to norm_st_dev.
//         $table = new xmldb_table('surveyplugin_stats');
//         $field = new xmldb_field('stats_norm_st_dev', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'stats_st_dev');

//         // Launch rename field stats_norm_st_dev.
//         $dbman->rename_field($table, $field, 'norm_st_dev');

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018072100, 'surveyplugin');
//     }

//     if ($oldversion < 2018072101) {

//         // Define field stats_performance_index to be dropped from surveyplugin_stats.
//         $table = new xmldb_table('surveyplugin_stats');
//         $field = new xmldb_field('stats_performance_index');

//         // Conditionally launch drop field stats_performance_index.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018072101, 'surveyplugin');
//     }

//     if ($oldversion < 2018072102) {

//         // Define field n to be dropped from surveyplugin_stats.
//         $table = new xmldb_table('surveyplugin_stats');
//         $field = new xmldb_field('n');

//         // Conditionally launch drop field n.
//         if ($dbman->field_exists($table, $field)) {
//             $dbman->drop_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018072102, 'surveyplugin');
//     }

//     if ($oldversion < 2018120500) {

//         // Define field binquestion to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('binquestion', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'szenario');

//         // Conditionally launch add field binquestion.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field binquestiontext to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('binquestiontext', XMLDB_TYPE_CHAR, '1000', null, null, null, null, 'binquestion');

//         // Conditionally launch add field binquestiontext.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field binquestionlines to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('binquestionlines', XMLDB_TYPE_TEXT, null, null, null, null, null, 'binquestiontext');

//         // Conditionally launch add field binquestionlines.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field binquestionvalues to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('binquestionvalues', XMLDB_TYPE_TEXT, null, null, null, null, null, 'binquestionlines');

//         // Conditionally launch add field binquestionvalues.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field binquestionnumber to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('binquestionnumber', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'binquestionvalues');

//         // Conditionally launch add field binquestionnumber.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field binquestionimportance to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('binquestionimportance', XMLDB_TYPE_NUMBER, '20, 8', null, null, null, null, 'binquestionnumber');

//         // Conditionally launch add field binquestionimportance.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // Define field binquestionrelation to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('binquestionrelation', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'binquestionimportance');

//         // Conditionally launch add field binquestionrelation.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2018120500, 'surveyplugin');
//     }

//     if ($oldversion < 2019031400) {

//         // Define field binquestionmultiselect to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('binquestionmultiselect', XMLDB_TYPE_INTEGER, '1', null, null, null, null, 'binquestionrelation');

//         // Conditionally launch add field binquestionmultiselect.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2019031400, 'surveyplugin');
//     }

//     if ($oldversion < 2019060600) {

//         // Define field binvalue to be added to surveyplugin_user_values.
//         $table = new xmldb_table('surveyplugin_user_values');
//         $field = new xmldb_field('binvalue', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'value');

//         // Conditionally launch add field binvalue.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2019060600, 'surveyplugin');
//     }

//     if ($oldversion < 2019070900) {

//         // Define field tracked to be added to surveyplugin_users.
//         $table = new xmldb_table('surveyplugin_users');
//         $field = new xmldb_field('tracked', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '1', 'state');

//         // Conditionally launch add field tracked.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2019070900, 'surveyplugin');
//     }

//     if ($oldversion < 2019071000) {

//         // Define field tracked to be added to surveyplugin.
//         $table = new xmldb_table('surveyplugin');
//         $field = new xmldb_field('tracked', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '1', 'state');

//         // Conditionally launch add field tracked.
//         if (!$dbman->field_exists($table, $field)) {
//             $dbman->add_field($table, $field);
//         }

//         // surveyplugin savepoint reached.
//         upgrade_mod_savepoint(true, 2019071000, 'surveyplugin');
//     }
//     return true;
// }