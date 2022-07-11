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
 *
 * @package    mod_surveyplugin
 * @author     iskakova
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/csvlib.class.php');
require('parse_survey.php');
require('generate_questionnaire.php');
require('lib.php');

global $DB;
global $USER;
global $COURSE;

$lastrow = $DB->get_record_sql('SELECT * FROM mdl_surveyplugin ORDER BY id DESC LIMIT 1');
$survey_id_temp = $lastrow->survey_id;
echo $survey_id_temp;
$deadline = 0;
if ($timestamp = $lastrow->deadline){
    $deadline = date('d-m-Y', $timestamp);
}
$time = date('g:i a', $timestamp);

$filename = './survey_' . $survey_id_temp . '/page1.php';
//echo $lastrow->id;
$context = context_course::instance(2);
if (!has_capability('mod/surveyplugin:onlymanager', $context) && has_capability('mod/surveyplugin:onlystudent', $context)) {
    if (file_exists($filename)){
        redirect(new moodle_url('/mod/surveyplugin/survey_' . $survey_id_temp . '/page1.php'), 'The survey is available until ' . $deadline . ' ' . $time);
    } else {
        redirect(new moodle_url('/my'), 'The survey is not available yet');
    }
    // echo '<br></br>';
    // echo "Student";
    //redirect(new moodle_url('/my'), 'The survey will be available soon');    
}

$id = optional_param('id', 0, PARAM_INT);
// $course = $DB->get_record('course', array('id '=> '2'), '*', MUST_EXIST);
$PAGE->set_url('/mod/surveyplugin/view.php', array('id' => $id));
$PAGE->set_heading(format_string($COURSE->fullname));
$course_module = $DB->get_record('surveyplugin', array('course' => '2'), '*', MUST_EXIST);
$PAGE->set_title($course_module->name);
$PAGE->set_context(\context_system::instance($COURSE->id));
context_helper::preload_course($COURSE->id);
$context = context_course::instance($COURSE->id, MUST_EXIST);

// ----------------------------------------------
function debug_to_console($data){
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
// ----------------------------------------------

//admin_externalpage_setup('tooluploadsurvey'); // This causes section error!
$importid = optional_param('importid', '', PARAM_INT);
debug_to_console('importid: ' . $importid);
$cir = new csv_import_reader($importid, 'uploadcourse');
$previewrows = optional_param('previewrows', 10, PARAM_INT);
debug_to_console('previewrows: ' . $previewrows);
$context = context_system::instance();
debug_to_console('context->id: ' . $context->id);
$returnurl = new moodle_url('/mod/surveyplugin/view.php');
$mform1 = new tool_uploadcourse_step1_form();
$checker = 0;
global $DB;
//$surveyinstances= $DB->get_records('surveyplugin');

// if (isset($_GET['id'])) {
//     $test_id = $_GET['id'];
// }
// echo $test_id;

echo $OUTPUT->header();
// echo $OUTPUT->heading_with_help(get_string('uploadcourses', 'tool_uploadcourse'), 'uploadcourses', 'tool_uploadcourse');
echo $OUTPUT->heading_with_help('Upload survey', 'uploadsurveys', 'tool_uploadcourse'); // The header with upload survey title and help information

$mform1->display();

if ($mform1->is_cancelled()) {
    redirect($returnurl, 'You cancelled the survey upload');
} else if ($content = $mform1->get_file_content('surveyfile')) {
    //\core\notification::info('Please wait, this will take couple of seconds');
    $filename = 'survey.csv';
    make_temp_directory('surveyplugin');
    $imported_file = $CFG->tempdir . '/surveyplugin/' . $filename;
    $mform1->save_file('surveyfile', $imported_file, true);
    $survey_file = __DIR__ . '/../../../moodledata/temp/surveyplugin/' . $filename;
    $survey_id = parse_inputfile($survey_file);
    chmod(__DIR__, 0777);
    if ($survey_id) {
        $generate_survey_check = generate_moodle_survey(strval($survey_id));
        //echo $OUTPUT->continue_button(new moodle_url('/mod/surveyplugin/page1.php'));
        if ($generate_survey_check) {
            $header_record = $DB->get_record('surveyplugin_items', array('survey_id' => $survey_id, 'element' => 'h'));
            $survey_title = $header_record->title;
            //echo $survey_title;
            //echo $OUTPUT->single_button(new moodle_url('/mod/surveyplugin/survey_' . $survey_id . '/page1.php'), $survey_title);
            $string = "
            <?php
            /**
             *
             * @package    mod_surveyplugin
             * @author     iskakova
             * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
             */
            
            require_once(__DIR__ . '/../../config.php');
            require('lib.php');
            require_once(\$CFG->dirroot . '/mod/surveyplugin/classes/forms/deadline_form.php');
            \$PAGE->set_url('/mod/surveyplugin/$survey_id.php');
            \$PAGE->set_heading(format_string('$COURSE->fullname'));
            \$course_module = \$DB->get_record('surveyplugin', array('course '=> '2'), '*', MUST_EXIST);
            \$PAGE->set_title('\$course_module->name');
            \$PAGE->set_context(\context_system::instance($COURSE->id));
            context_helper::preload_course($COURSE->id);
            \$context = context_course::instance($COURSE->id, MUST_EXIST);

            \$PAGE->set_context(\context_system::instance());
            \$PAGE->set_title('Survey: ' . \"{$survey_title}\");
            global \$DB;
            global \$USER;
            \$survey_id = {$survey_id};
            echo \$OUTPUT->header();
            echo '<br></br>';
            echo '<br></br>';
            echo \$OUTPUT->heading_with_help('Survey: ' . '{$survey_title}', 'uploadsurveys', 'tool_uploadcourse'); 
            echo '<br></br>';
            echo \$OUTPUT->single_button(new moodle_url('/mod/surveyplugin/survey_' . \$survey_id . '/page1.php'), 'View survey');
            echo '&nbsp';
            echo '&nbsp';
            echo \"<a href='{\$survey_id}.php?survey_id=\${survey_id}'><input type='button' class='btn btn-primary' value='Close survey'/></a>\";
            echo '<br></br>';
            echo '<br></br>';

            \$mform = new mod_surveyplugin_deadline_form();
            if (\$mform->is_cancelled()) {
                redirect(new moodle_url('/my'), 'You cancelled the survey');
            } else if (\$fromform = \$mform->get_data()) {
                \$deadline = 0;
                if (\$fromform->{'deadline'} !== NULL) {
                 \$deadline = \$fromform->{'deadline'};
                }
                \$currentsurvey = \$DB->get_record('surveyplugin', array('survey_id' => $survey_id));
                \$currentsurvey->deadline = \$deadline;
                \$DB->update_record('surveyplugin', \$currentsurvey);
                // var_dump(\$currentsurvey);
                // die;
            }
            \$mform->display();            
            
            echo \$OUTPUT->single_button(new moodle_url('/mod/surveyplugin/survey_' . \$survey_id . '/page1.php'), 'Start survey');            
            echo '<br></br>';
            echo 'If you wish to send the data, please close the survey first and then proceed by clicking the following button: ';
            echo '<br></br>';
            echo \"<a href='{\$survey_id}.php?_id=\${survey_id}&send=true'><input type='button' class='btn btn-primary' value='Send data for group formation'/></a>\";
            echo '<br></br>';
            ?>
            <?php if (isset(\$_GET['_id']) && \$_GET['send'] == true) { ?>
                <?php \$response = send_data_to_api(\$_GET['_id'], \$_GET['send']) ?> 
                <?php echo \$OUTPUT->heading_with_help('Generated groups: ', '') ?> 
                <?php echo \$response ?> 
            <?php } ?>
            <?php
            echo \$OUTPUT->footer();
            ";
            $file = __DIR__ . "/" . $survey_id . ".php"; // This is a student view
            $file_stream = fopen($file, 'w');
            fwrite($file_stream, $string);
            echo $OUTPUT->single_button(new moodle_url('/mod/surveyplugin/' . $survey_id . '.php'), 'Go to the survey admin page');
        } else {
            redirect($returnurl);
            core\notification::add('The survey could not be generated, please check your csv file', 'error');
        }
    }
}

echo $OUTPUT->footer();
