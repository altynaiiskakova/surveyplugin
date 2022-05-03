<?php

/**
 *
 * @package    mod_surveyplugin
 * @author     iskakova
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
global $DB;
$survey_elements = $DB->get_records('local_items');

$PAGE->set_url(new moodle_url('/mod/surveyplugin/form.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Survey: ' . $survey_elements[1]->title);

//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");


class form extends moodleform
{
    //Add elements to form
    public function definition()
    {
        global $CFG;
        global $DB;
        $survey_elements = $DB->get_records('local_items');
        $mform = $this->_form; // Don't forget the underscore! 

        $j = 3;
        while ($survey_elements[$j]->element !== "p") {
            $choices = array();
            for ($i = 1; $i <= 10; $i++) {
                $tmp = "answer" . $i;
                if ($survey_elements[3]->$tmp !== 'NULL') {
                    $choices[$i - 1] = $survey_elements[$j]->$tmp;
                }
            }
            $mform->addElement('static', 'name', $survey_elements[$j]->title);
            for ($i = 0; $i < count($choices); $i++){
                $mform->addElement('checkbox', 'options', $choices[$i]);

            }
            $mform->setDefault('options', '0');
            $j++;
        }
        $this->add_action_buttons();
        $mform->addElement('text', 'answer', 'Answer text'); // Add elements to your form
        $mform->setType('answer', PARAM_NOTAGS);                    //Set type of element
        $mform->setDefault('answer', 'Please enter your answer');        //Default value

    }
    //Custom validation should be added here
    function validation($data, $files)
    {
        return array();
    }
}

// Display the form
// First we need to create a form definition
$mform = new form();

echo $OUTPUT->header();
echo 'Survey: ' . $survey_elements[1]->title . '<br/>'; // "h"
echo $survey_elements[2]->title . '<br/>' . '<br/>'; // "p"

$mform->display();

echo $OUTPUT->footer();
