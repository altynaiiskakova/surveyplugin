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
 * @var stdClass $plugin
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/gradelib.php');

/**
 * Saves a new instance of the surveyplugin into the database
 *
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will create a new instance and return the id number
 * of the new instance.
 *
 * @param stdClass $data
 * @param stdClass $mform
 * @return int new survey instance id
 */ function surveyplugin_add_instance($data, $mform)
{
    global $DB, $USER, $COURSE;
    $data->timecreated = time();
    $data->timemodified = time();
    $data->survey_id = $COURSE->id;
    $data->course_id = $COURSE->id;
    $data->created_date = date('F j, Y, g:i a');
    $data->admin_id = $USER->id;
    $id = $DB->insert_record('surveyplugin', $data);
    return $id;
}

/**
 * Removes an instance of the surveyplugin from the database
 *
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @param int $id Id of the module instance
 * @return boolean Success/Failure
 * @throws dml_exception
 */
function surveyplugin_delete_instance($survey_id)
{
    global $DB, $CFG;
    if (!$surveyplugin = $DB->get_record('surveyplugin', array(
        'survey_id' => $survey_id
    ))) {
        return false;
    }
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

    // $DB->delete_records('surveyplugin_answer_attempts', array(
    //     'survey_id' => $survey_id
    // ));
    // Delete current survey landing page
    // $current_filename = __DIR__ . '/' . $survey_id . '.php';
    // chmod($current_filename, 0777);
    // if (unlink($current_filename)) {
    //     echo 'The file ' . $current_filename . ' was deleted successfully!';
    //     \core\notification::success('The file ' . $current_filename . ' was deleted successfully!');
    // } else {
    //     echo 'There was a error deleting the file ' . $current_filename;
    //     \core\notification::error('There was a error deleting the file ' . $current_filename);
    //     echo '';
    //     echo 'DIR: ' . __DIR__;
    //     die;
    // }

    // Remove any dependent survey directory with survey pages
    $current_surveydir = __DIR__ . '/survey_' . $survey_id;
    chmod($current_surveydir, 0777);
    array_map('unlink', glob("$current_surveydir/*.*"));
    if (rmdir($current_surveydir)) {
        \core\notification::success('The directory ' . $current_surveydir . ' was removed successfully!');
    } else {
        echo 'There was a error deleting the directory ' . $current_surveydir;
        \core\notification::error('There was a error deleting the directory ' . $current_surveydir);
    }
    //redirect($CFG->wwwroot . '/mod/surveyplugin/' . $survey_id . '.php', 'You closed the survey');
    return true;
}
if (isset($_GET['survey_id'])) {
    surveyplugin_delete_instance($_GET['survey_id']);
}

/**
 * Send student answers to the API
 *
 * Given an ID of a current survey,
 * this function will send the relevant student answers to the API endpoint
 *
 * @param int $survey_id Id of the current survey
 * @return string HTML to output.
 * @throws dml_exception
 */
function send_data_to_api($survey_id, $send)
{
    global $DB, $CFG;
    if ($answers = $DB->get_record('surveyplugin_answer_attempts', array(
        'survey_id' => $survey_id
    ))) {
        // echo $answers->id;
        // echo '<br></br>';
        // echo $answers->user_id;
        // echo '<br></br>';
        // echo $answers->survey_id;
        // echo '<br></br>';
        // echo $answers->item_id;
        // echo '<br></br>';
        // echo $answers->question_text;
        // echo '<br></br>';
        // echo $answers->item_answer_id;
        // echo '<br></br>';
        // echo $answers->date_started;
        // echo '<br></br>';
        // echo $answers->date_answered;
        // echo '<br></br>';
        //die;
    } else {
        return false;
    }

    $students_file = __DIR__ . "/" . 'students_' . $survey_id . '.csv';
    $file_stream_students = fopen($students_file, 'w');
    fwrite($file_stream_students, 'id');
    fwrite($file_stream_students, "\n");

    $features_file = __DIR__ . "/" . 'features_' . $survey_id . '.csv';
    $file_stream_features = fopen($features_file, 'w');
    fwrite($file_stream_features, 'att1,att2');
    fwrite($file_stream_features, "\n");

    $answers_sum = 0;
    $questions_count = 0;
    $lastrow = $DB->get_record_sql('SELECT * FROM mdl_surveyplugin_answer_attempts ORDER BY id DESC LIMIT 1');
    //echo $lastrow->id;

    $current_id = $answers->id;
    while ($answers->survey_id == $survey_id && $current_id != $lastrow->id) {
        $current_student_id = $answers->user_id;
        fwrite($file_stream_students, $current_student_id);
        while ($answers->user_id == $current_student_id && $current_id != $lastrow->id) {
            $questions_count++;
            $answers = $DB->get_record('surveyplugin_answer_attempts', array('id' => $current_id));
            //$answers_average += $answers->answer_text;
            $answers_sum += 3;
            fwrite($file_stream_features,  $answers->question_text);
            fwrite($file_stream_features, ',');
            fwrite($file_stream_features,  $answers->answer_text);
            fwrite($file_stream_features, "\n");
            $current_id++;
        }
    }
    // echo 'Count of questions: ' . $questions_count;
    // echo 'AVARAGE: ' . $answers_sum / $questions_count;
    // echo '<br></br>';

    /**
     * Make a CURL request
     */
    //"curl -X POST 'http://127.0.0.1:8000/dummy?students_per_group=3' -H 'accept: */*' -H 'Content-Type: multipart/form-data' -F 'students=@students.csv;type=text/csv' -F 'features=@features.csv;type=text/csv'";

    // Check for the successful response
    // Save the response and return it
    $target_url = 'http://127.0.0.1:8000/dummy?students_per_group=3';

    // Create a CURLFile object
    $st_file = new CURLFile('/home/altynai/Desktop/API/bt-altynai-iskakova-group-formation-support-in-moodle-plugin-development/grouping_api/students.csv', 'text/csv');
    $ft_file = new CURLFile('/home/altynai/Desktop/API/bt-altynai-iskakova-group-formation-support-in-moodle-plugin-development/grouping_api/features.csv', 'text/csv');

    $post = array(
        'students' => $st_file,
        'features' => $ft_file
    );

    $headers = array(
        'accept: */*',
        "Content-Type:multipart/form-data",
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $target_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_VERBOSE, true);
    $result = curl_exec($ch);
    $result_array = json_decode($result, true);
    curl_close($ch);

    // Group students into arrays
    $groups = array();
    if (is_array($result_array)) {
        foreach ($result_array as &$value) {

            if (!array_key_exists($value["group"], $groups) && !in_array($value["id"], $groups[$value["group"]])) {
                $groups[$value["group"]] = array($value["id"]);
            } else if (array_key_exists($value["group"], $groups) && !in_array($value["id"], $groups[$value["group"]])) {
                array_push($groups[$value["group"]], $value["id"]);
                // echo 'adding more students to same group';
                // echo '<br></br>';
                // var_dump($groups);

            } else if (!array_key_exists($value["group"], $groups)) {
                $groups[$value["group"]] = array($value["id"]);
            }
        }
        unset($value);
    }

    // Print groups with their students
    $generated_groups = '<br></br>';
    foreach (array_keys($groups) as &$key) {
        //echo $value["id"];
        $tmp = "<pre>" . 'Group #' . $key . ': ' ;
        foreach($groups[$key] as &$student){
            $tmp .= $student . ' ';
        }
        //$tmp = "<pre>" . 'student ' . $value["id"] . ': ' . $value["group"] . "\t" . "</pre><br>";
        $generated_groups .= $tmp . "</pre><br>";
    }
    unset($value);
    //echo $generated_groups;
    //die;

    /**
     * Delete all student answers records here (?)
     */
    // $DB->delete_records('surveyplugin_answer_attempts', array(
    //     'survey_id' => $survey_id
    // ));

    return $generated_groups;
}
// if (isset($_GET['send'])) {
//     send_data_to_api($_GET['_id'], $_GET['send']);
// }
