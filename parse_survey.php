<?php
/**
 *
 * @package    mod_surveyplugin
 * @author     iskakova
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core\uuid;
define('CLI_SCRIPT', true);
/**
 * Parse an input file.
 *
 *
 * @param string  $inputfile
 */
function parse_inputfile($inputfile)
{
  /**
   * Get a config file to make sure that moodle is set up, it also allows to set
   * the global variables to use them without actually initializing them
   */
  require_once(__DIR__ . '/../../config.php');
  global $DB, $USER, $COURSE;

  //Survey processing, should get a user input actually --> TBD
  // $inputfile = 'survey.csv';
  //$inputfile = $CFG->tempdir . '/groupformation/survey.csv';
  //__DIR__ . '/../../../moodledata/temp/groupformation'

  // Open the file for reading
  if (($stream = fopen("{$inputfile}", "r")) !== FALSE) {    
    $survey_id = rand(1, 1000000); // Initialize a random number for survey_id, this will be one unique id for this survey
    // Each line in the file is converted into an individual array - $data
    // The items of the array are comma separated
    while (($data = fgetcsv($stream, 1000, ",")) !== FALSE) {
      // Handle header
      if ($data[1] == "h") {
        // Insert a new record for this survey into surveyplugin_surveys table    
        $recordtoinsert_survey = new stdClass();
        $recordtoinsert_survey->survey_id = $survey_id;
        $recordtoinsert_survey->course_id = $COURSE->id;
        $recordtoinsert_survey->created_date = date('F j, Y, g:i a');
        $recordtoinsert_survey->admin_id = $USER->id;
        $DB->insert_record('surveyplugin', $recordtoinsert_survey);
        // echo '------------------------inserting survey into surveyplugin_surveys---------------------------';
        // echo "\n";

        // Insert a new record for this header into surveyplugin_items table   
        $item_id = 'h' . rand(1, 10000000);   
        $recordtoinsert_item = new stdClass();
        $recordtoinsert_item->item_id = $item_id;
        $recordtoinsert_item->survey_id = $survey_id;
        $recordtoinsert_item->object_id = $data[0];   
        $recordtoinsert_item->element = $data[1];
        $recordtoinsert_item->option_type = 'NULL';
        $recordtoinsert_item->title = $data[2];
        $DB->insert_record('surveyplugin_items', $recordtoinsert_item);
        // echo '------------------------inserting header element into surveyplugin_items---------------------------';
        // echo "\n"; 
      }

      //Handle page 
      if ($data[1] == "p") {
        $item_id = 'p' . rand(1, 10000000); 
        $recordtoinsert_item = new stdClass();
        $recordtoinsert_item->item_id = $item_id;
        $recordtoinsert_item->survey_id = $survey_id;
        $recordtoinsert_item->object_id = $data[0];
        $recordtoinsert_item->element = $data[1];
        $recordtoinsert_item->option_type = $data[2];
        $recordtoinsert_item->title = $data[3];        
        $DB->insert_record('surveyplugin_items', $recordtoinsert_item);
        // echo '------------------------inserting page element into surveyplugin_items---------------------------';
        // echo "\n";
      }

      // Handle question
      if ($data[1] == "q") {
        $item_id = 'q' . rand(1, 10000000); 
        $recordtoinsert_item = new stdClass();
        $recordtoinsert_item->item_id = $item_id;
        $recordtoinsert_item->survey_id = $survey_id;
        $recordtoinsert_item->object_id = $data[0];
        $recordtoinsert_item->element = $data[1];
        $recordtoinsert_item->option_type = $data[2];
        $recordtoinsert_item->title = $data[3];
        $DB->insert_record('surveyplugin_items', $recordtoinsert_item);
        // echo '------------------------inserting question element into surveyplugin_items---------------------------';
        // echo "\n";

        //echo 'count($data): ' . count($data) . ' for ' . $recordtoinsert_item->object_id;
        for ($i = 4; $i < count($data); $i++){
          $item_answer_id = 'answer' . rand(1, 1000000);
          $recordtoinsert_item_answer= new stdClass();
          $recordtoinsert_item_answer->item_answer_id = $item_answer_id;
          $recordtoinsert_item_answer->item_id = $recordtoinsert_item->item_id;
          $recordtoinsert_item_answer->survey_id = $recordtoinsert_item->survey_id;
          $recordtoinsert_item_answer->text = $data[$i]; 
          $recordtoinsert_item_answer->value = $i - 3;
          $DB->insert_record('surveyplugin_item_answers', $recordtoinsert_item_answer);
          // echo '------------------------inserting item answer into surveyplugin_item_answers-----------------------';
          // echo "\n";
        }
      }

      // Handle block question
      if ($data[1] == "b") {
        $item_id = 'b' . rand(1, 10000000); 
        $recordtoinsert_item = new stdClass();
        $recordtoinsert_item->item_id = $item_id;
        $recordtoinsert_item->survey_id = $survey_id;
        $recordtoinsert_item->object_id = $data[0];
        $recordtoinsert_item->element = $data[1];
        $recordtoinsert_item->option_type = $data[2];
        $recordtoinsert_item->title = $data[3];
        $DB->insert_record('surveyplugin_items', $recordtoinsert_item);
        // echo '------------------------inserting block question element into surveyplugin_items---------------------------';
        // echo "\n";
      }
    }
    // Close the file
    fclose($stream);
    return $survey_id;
  } else {
    echo 'Cannot read the file';
    return false;
  }
}
