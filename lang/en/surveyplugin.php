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
 * English lang strings
 *
 * @package     mod_surveyplugin
 */
$string ['language'] = 'en';
$string ['modulename'] = 'Surveyplugin';
$string ['modulenameplural'] = 'Surveyplugins';
$string ['modulename_help'] = 'The groupformation plugin generates groups of students based on a questionnaire answers.';
$string ['beta_version'] = '';
$string ['groupformation:addinstance'] = 'Add groupformation';
$string ['groupformation:editsettings'] = 'Edit groupformation';
$string ['groupformation:onlymanager'] = 'groupformation: only manager';
$string ['groupformation:onlyread'] = 'groupformation: only read';
$string ['groupformation:onlystudent'] = 'groupformation: only student';
$string ['groupformation:readsettings'] = 'groupformation: read settings';
$string ['groupformation:submit'] = 'groupformation: submit';
$string ['groupformation:view'] = 'groupformation: view';
$string ['password_wrong'] = 'wrong password';
$string ['groupformationfieldset'] = 'Custom example fieldset';
$string ['groupformationname'] = 'Group formation';
$string ['groupformationname_help'] = 'ToolTip Group formation';
$string ['groupformation'] = 'Group formation';
$string ['pluginadministration'] = 'Administration: Group formation';
$string ['pluginname'] = 'Groupformation';
$string ['nogroupformation'] = 'No group formation';
$string ['groupnameexists'] = 'This group already exists.';
$string ['generategroups'] = 'Generation of groups';
$string ['namingschema'] = 'Naming scheme';
$string ['userpergroup'] = 'How many users in a group?';
$string ['notOpen'] = 'Submission is closed.';
$string ['continueTheForm'] = 'Continue';
$string ['completeTheForm'] = 'Complete questionnaire';
$string ['alreadySubmitted'] = 'Already submitted';
$string ['overview'] = 'Overview';
$string ['generategroups'] = "Generate groups";
$string ['edit_param'] = 'Edit';
$string ['editparam'] = 'Edit parameters';
$string ['nochangespossible'] = 'The questionnaire has been answered already.
You can only change the maximum number of members or maximum number of groups. Further changes will not be saved.';
$string ['availability_nochangespossible'] = 'The questionnaire has been answered already. You cannot change the start time anymore.';
$string ['scenario'] = 'Scenario';
$string ['scenarioLabel'] = '';
$string ['scenario_description'] = 'Please choose the most suitable scenario for the group formation.';
$string ['scenarioInfo'] = 'The three scenarios differ in the way how questionaaire items influence the group formation.
            For project teams it considers prior knowledge and traits of the group members to amend each other while motivation (level) and personal targets should be as similar as possible.
            For homework groups it optimizes each group to have the best possible prerequisites for collaborative learning.
            For presentation groups the main aspect is a mutual interest in the same selected (and assigend) topic to work on.';
$string ['groupformationsettings'] = 'Group formation settings';
$string ['scenario_projectteams'] = 'Project teams';
$string ['scenario_projectteams_description'] = 'Project teams work intensively together to finish a project (e.g. conduct a study, delivery of a report, etc.). Often, duties and tasks can be split among the team members. Consequently it is beneficial to have a mixture of amending comptencies in the team. Usually, such a collective work result is graded with a equal group mark for all members. Thus, groupformation aims for similar motivation and similar objectives (beside the prerequisites).';

$string ['scenario_homeworkgroups'] = 'Homework groups';
$string ['scenario_homeworkgroups_description'] = 'Homework groups complete (smaller) assignments in regular intervals (often weekly) as a preperation for examination. Even though the assigment tasks (often called exercises, practice, control questions or homework) are principally subdividable among group members, this is not intended as with the final examination each member will be graded individually and needs to be able to solve all tasks alone. Consequently, groupformation aims for diverse prior knowledge and diverse learning styles that benefit from each other.';
$string ['scenario_presentationgroups'] = 'Presentation groups';
$string ['scenario_presentationgroups_description'] = 'Presentation groups work together for a relatively short time period to finish a presentation (usually to be held in class). Often in the beginning a specific sub-task is assigned to (or selected by) each student, individually worked on, and in the end re-assembled to a complete presentation. Grading is usually done for the perforance of the whole group together. Therefore, groupformation aims primarily for mutual interest in the same topic.';
$string ['scenario_usage_header'] = 'Questionnaire-Usage';
$string ['scenario_usage_header_presentation'] = 'Students set preferences';
$string ['scenario_projectteams_short'] = 'Knowledge areas and motivation are heterogeneous; knowledge level, targeted goals, and team orientation are homogeneous; character traits are partially homogeneous, partially heterogeneous.';
$string ['scenario_homeworkgroups_short'] = 'Knowledge areas and targeted goals are heterogeneous; team orientation homogeneous.';
$string ['scenario_presentationgroups_short'] = 'Enables exclusively to order a list of topics by Drag&Drop. "first-come, first-served" procedure is avoided to allow a fairer topic distribution.';

$string ['time'] = 'Time';
$string ['topics'] = 'Topics';
$string ['topics_help'] = 'When using topics, knowledge questions are deactivated and the number of groups is fixed by the number of topics.';
$string ['topics_dummy'] = 'Topic';
$string ['knowledge_dummy'] = 'Example';
$string ['topics_description'] = 'I want to define topics';
$string ['topics_description_extended'] = 'Please list topics for the students to choose from. <strong>Then group formation optimizes using the topic selection preferences exclusively.</strong> All other questionnaire parts will be ignored.';
$string ['topics_question'] = 'Please sort the following topics regarding your personal interests and start with your favorite topic. Sort via drag and drop.';
$string ['topicchoice'] = 'Topic selection';
$string ['useOneLineForEachTopic'] = 'Use one line for each topic';

$string ['oneOfBin_help'] = 'Here you can specify a choice question and answer options, e.g What is your favorite subject?';
$string ['oneOfBinQuestion'] = 'I want to add a choice question';
$string ['oneOfBinAnswers'] = 'One-of-bin answers';
$string ['oneOfBinImportance'] = 'One-of-bin importance';
$string ['oneOfBinRelation'] = 'One-of-bin relation';
$string ['homogeneous'] = 'Homogeneous';
$string ['heterogeneous'] = 'Heterogeneous';
$string ['choose_oob_answers'] = 'Please enter a choice question (e.g. What is your favorite subject?):';
$string ['add_oob_question'] = 'Please add the choice question here!';
$string ['answers'] = 'Please specify answer options:';
$string ['importance'] = 'Importance:';
$string ['choose_oob_importance'] = 'Please specify the importance for the group formation algorithm (0 = not used; 10 = most important):';
$string ['relation'] = 'Influence:';
$string ['choose_oob_relation'] = 'Please select the influence type for the criterion:';
$string ['choose_answer'] = 'Please answer the following choice question:';
$string ['choose_answers'] = 'Please answer the following multiple choice question:';
$string ['no_oob_question'] = 'No choice question specified yet';
$string ['oob_selected_value'] = 'Selected value: ';
$string ['decide_multiselect'] = 'Decide between multi-select- and single choice-question (Standard: single choice)';
$string ['multiselect'] = 'Multi-select';
$string ['choose_type'] = 'Choose Type';