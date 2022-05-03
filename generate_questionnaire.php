<?php

/**
 *
 * @package    mod_surveyplugin
 * @author     iskakova
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);

/**
 * Generate a new moodle survey
 *
 * @return bool
 */
function generate_moodle_survey($input_survey_id){
    require_once(__DIR__ . '/../../config.php');
    global $DB;
    $survey_elements = $DB->get_records('surveyplugin_items');
    $survey_id_check = $DB->get_record('surveyplugin_items', array('survey_id'=>$input_survey_id));
    $survey_id_check_in_surveyplugin_surveys = $DB->get_record('surveyplugin', array('survey_id'=>$input_survey_id));

    if (!$survey_elements || !$survey_id_check || !$survey_id_check_in_surveyplugin_surveys) {
        \core\notification::add('Table surveyplugin is empty. No survey to create', 'error');
        return false;
    }

    $page_number = 1;
    $dir = 'survey_' . $input_survey_id;
    mkdir($dir, 0777, true);  

    $page_count = 0;
    $survey_firstrecord = $DB->get_record('surveyplugin_items', array('survey_id'=>$input_survey_id)); // the first record that matches the condition
    $i = $survey_firstrecord->id;
    $start = $survey_firstrecord->id;
    $start_saved = $survey_firstrecord->id;
    while($survey_elements[$i]->survey_id == $input_survey_id){
        if ($survey_elements[$i]->element == "p") {
            $page_count++;
        }
        $i++;
    }

    $string0 = "<?php
            /**
             *
             * @package    mod_surveyplugin
             * @author     iskakova
             * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
             */
            
            require_once(__DIR__ . '/../../../config.php');
            \$PAGE->set_url(new moodle_url('/mod/surveyplugin/form.php'));
            \$PAGE->set_context(\context_system::instance());
            \$PAGE->set_title('Survey: ' . \"{$survey_elements[$start]->title}\");
            global \$DB, \$USER;
            \$survey_elements = \$DB->get_records('surveyplugin_items');
            \$survey_id = '$input_survey_id';
    ";

    $start = $survey_firstrecord->id + 1;
    while ($survey_elements[$start]->survey_id == $input_survey_id){
        //echo "i at start: " . $i . " ";
        //echo " element: " . $survey_elements[$i]->element . " ";
        if ($survey_elements[$start]->element == "p") {        
            $start++;
            $m = $start;
            while ($survey_elements[$start]->element !== "p" && $survey_elements[$start]->survey_id == $input_survey_id) {               
                $questionnaireFile = __DIR__ . '/survey_' . $input_survey_id . '/page' . $page_number . ".php";                  
                $next_page = $page_number + 1;
                $file_stream = fopen($questionnaireFile, 'w');
                if (!$file_stream){
                    \core\notification::add('Unable to open a file', 'error');
                    return false;
                }
                $string1 = "
            require_once(\"\$CFG->libdir/formslib.php\");
            class form extends moodleform
            {
                //Add elements to form
                public function definition()
                {
                    global \$CFG, \$DB;
                    \$survey_id = '$input_survey_id';
                    \$survey_elements = \$DB->get_records('surveyplugin_items');
                    \$item_answers = \$DB->get_records('surveyplugin_item_answers');
                    \$mform = \$this->_form; // Don't forget the underscore! 

                    \$j = {$m};
            
                    while (\$survey_elements[\$j]->element !== \"p\" && \$survey_elements[\$j]->survey_id == \$survey_id ) {

                        while (\$survey_elements[\$j]->option_type == \"t\"){
                            \$mform->addElement('text', 'answer' . \$j, \$survey_elements[\$j]->title); 
                            \$mform->setType('answer', PARAM_NOTAGS);                   
                            \$mform->setDefault('answer', 'Please enter your answer');
                            \$j++;
                        }
                        if (\$survey_elements[\$j]->element == \"p\"){
                            break;
                        }
                        
                        \$current_question = 'question:' . \$j;

                        if (\$survey_elements[\$j]->option_type == 's') {
                            \$choices = array(); // array to store answer options
                            \$current_item_answers = \$DB->get_record('surveyplugin_item_answers', array('item_id'=>\$survey_elements[\$j]->item_id));
                            if (\$current_item_answers){
                                \$current_item_id = \$survey_elements[\$j]->item_id;
                            }
                            
                            \$choices_size = 0;
                            while(\$current_item_answers->item_id == \$survey_elements[\$j]->item_id){
                                \$choices[\$choices_size] = \$current_item_answers->text; 
                                \$next_id = \$current_item_answers->id + 1;
                                \$current_item_answers = \$DB->get_record('surveyplugin_item_answers', array('id'=>\$next_id));
                                \$choices_size ++;
                            }

                            \$checkboxarray = array();
                            for (\$k = 0; \$k < count(\$choices); \$k++) {
                                \$value = \$k + 1; // for example: value from 1(trifft überhaupt nicht zu ) to 5(trifft voll und ganz zu)
                                \$checkboxarray[] = &\$mform->createElement('radio', \$current_question, '', \$choices[\$k], \$value);
                            }
                            \$mform->addGroup(\$checkboxarray, \$current_question, \$survey_elements[\$j]->title, '', false);
                            \$mform->addGroupRule(\$current_question, get_string('required'), 'required');
                        }

                        if (\$survey_elements[\$j]->option_type == 'm') {
                            \$choices = array(); // array to store answer options
                            \$current_item_answers = \$DB->get_record('surveyplugin_item_answers', array('item_id'=>\$survey_elements[\$j]->item_id));
                            if (\$current_item_answers){
                                \$current_item_id = \$survey_elements[\$j]->item_id;
                            }                            
                            \$choices_size = 0;
                            while(\$current_item_answers->item_id == \$survey_elements[\$j]->item_id){
                                \$choices[\$choices_size] = \$current_item_answers->text; 
                                \$next_id = \$current_item_answers->id + 1;
                                \$current_item_answers = \$DB->get_record('surveyplugin_item_answers', array('id'=>\$next_id));
                                \$choices_size ++;
                            }
                            \$checkboxarray = array();                
                            for (\$k = 0; \$k < count(\$choices); \$k++) {
                                \$element_name = 'question:' . \$j . '->choice:' . \$k; // unique element name for each answer option
                                \$checkboxarray[] = &\$mform->createElement('advcheckbox', \$element_name, \$choices[\$k]);
                            }
                            \$mform->addGroup(\$checkboxarray, \$current_question, \$survey_elements[\$j]->title, '', false);
                            \$mform->addGroupRule(\$current_question, get_string('required'), 'required');
                        }
                        \$j++;
                    }            
                    \$this->add_action_buttons(true, 'Next');
            
                }
                //Custom validation should be added here
                function validation(\$data, \$files){
                    return array();
                }
            }
            
            \$mform = new form();
            //Form processing and displaying is done here
            if (\$mform->is_cancelled()) {
                //redirect(\$CFG->wwwroot . '/mod/surveyplugin/manage.php', 'You cancelled the survey');
                redirect(new moodle_url('/my'), 'You cancelled the survey');
            } else if (\$fromform = \$mform->get_data()) {
                // Insert the data into the database table
                \$j = {$m};
                while ( \$survey_elements[\$j]->element !== \"p\" && \$survey_elements[\$j]->survey_id == \$survey_id ){
                    if (\$survey_elements[\$j]->element === 'q'){
                        while (\$survey_elements[\$j]->option_type == \"t\") {
                            \$question = \$survey_elements[\$j]->object_id . ': ' . \$survey_elements[\$j]->title;
                            if (\$fromform->{\"answer\" . \$j} !== NULL){
                                \$answer = \$fromform->{\"answer\" . \$j};                                
                            }
                            \$recordtoinsert_attempt = new stdClass();
                            \$recordtoinsert_attempt->user_id = \$USER->id;
                            \$recordtoinsert_attempt->survey_id = \$survey_id;
                            \$recordtoinsert_attempt->item_id = \$survey_elements[\$j]->item_id; 
                            \$recordtoinsert_attempt->question_text = \$question;
                            \$recordtoinsert_attempt->answer_text = \$answer;                      
                            \$recordtoinsert_attempt->item_answer_id = '';  
                            \$recordtoinsert_attempt->date_started = date('F j, Y, g:i a');                      
                            \$recordtoinsert_attempt->date_answered = date('F j, Y, g:i a');
                            \$DB->insert_record('surveyplugin_answer_attempts', \$recordtoinsert_attempt);
                            if (\$survey_elements[\$j+1]->element !== \"p\"){
                                \$j++;
                            } else {
                                break;
                            } 
                        }
                        if (\$survey_elements[\$j]->option_type == \"s\") {
                            if (\$fromform->{'question:' . \$j} !== NULL) {
                                \$answer_number = \$fromform->{'question:' . \$j};
                                \$item_answer_record = \$DB->get_record('surveyplugin_item_answers', array('item_id' => \$survey_elements[\$j]->item_id, 'value' => \$answer_number));
                                \$answer_text = (\$item_answer_record->text !== '') ? \$item_answer_record->text : \$item_answer_record->value;
                                \$question = \$survey_elements[\$j]->object_id . ': ' . \$survey_elements[\$j]->title;                            
                                \$recordtoinsert_attempt = new stdClass();                          
                                \$recordtoinsert_attempt->user_id = \$USER->id;
                                \$recordtoinsert_attempt->survey_id = \$survey_id;
                                \$recordtoinsert_attempt->item_id = \$survey_elements[\$j]->item_id; 
                                \$recordtoinsert_attempt->question_text = \$question;
                                \$recordtoinsert_attempt->answer_text = \$answer_text;                           
                                \$recordtoinsert_attempt->item_answer_id = \$item_answer_record->item_answer_id;  
                                \$recordtoinsert_attempt->date_started = date('F j, Y, g:i a');                      
                                \$recordtoinsert_attempt->date_answered = date('F j, Y, g:i a');
                                \$DB->insert_record('surveyplugin_answer_attempts', \$recordtoinsert_attempt);
                            } 
                        }

                        if (\$survey_elements[\$j]->option_type == 'm') {
                            \$current_item_answers = \$DB->get_record('surveyplugin_item_answers', array('item_id' => \$survey_elements[\$j]->item_id));
                            \$choices_count = 0;
                            while (\$current_item_answers->item_id == \$survey_elements[\$j]->item_id) {            
                                \$next_id = \$current_item_answers->id + 1;
                                \$current_item_answers = \$DB->get_record('surveyplugin_item_answers', array('id' => \$next_id));
                                \$choices_count++;
                            }                            
                            for (\$k = 0; \$k < \$choices_count; \$k++){
                                if (\$fromform->{'question:' . \$j . '->choice:' . \$k} == 1) {
                                    \$question = \$survey_elements[\$j]->object_id . ': ' . \$survey_elements[\$j]->title;
                                    \$k_for_answer = \$k + 1;
                                    \$item_answer_record= \$DB->get_record('surveyplugin_item_answers', array('item_id' => \$survey_elements[\$j]->item_id, 'value' => \$k_for_answer));                                   
                                    \$answer_text = (\$item_answer_record->text !== '') ? \$item_answer_record->text : \$item_answer_record->value;
                                    \$recordtoinsert_attempt = new stdClass();
                                    \$recordtoinsert_attempt->user_id = \$USER->id;
                                    \$recordtoinsert_attempt->survey_id = \$survey_id;
                                    \$recordtoinsert_attempt->item_id = \$survey_elements[\$j]->item_id; 
                                    \$recordtoinsert_attempt->question_text = \$question;
                                    \$recordtoinsert_attempt->answer_text = \$answer_text;                       
                                    \$recordtoinsert_attempt->item_answer_id = \$item_answer_record->item_answer_id; 
                                    \$recordtoinsert_attempt->date_started = date('F j, Y, g:i a');                      
                                    \$recordtoinsert_attempt->date_answered = date('F j, Y, g:i a');
                                    \$DB->insert_record('surveyplugin_answer_attempts', \$recordtoinsert_attempt);
                                }
                            }                
                        }                      
                    }
                    \$j++;
                }
                if ($next_page > $page_count){
                    redirect(new moodle_url('/my'), 'Survey has been submitted');
                }
                redirect(new moodle_url('/mod/surveyplugin/survey_' . '{$input_survey_id}' . '/page' . {$next_page} . '.php'));             
            }
            \$PAGE->set_heading('Survey: ' . \$survey_elements[$start_saved]->title);
            
            echo \$OUTPUT->header();
            //echo 'Survey: ' . \$survey_elements[$start_saved]->title . '<br/>'; 
            echo \$survey_elements[{$m} - 1]->title . '<br/>' . '<br/>'; 
            
            \$mform->display();
            //echo \$OUTPUT->continue_button(new moodle_url('/mod/surveyplugin/survey_' . {$input_survey_id} . '/page' . {$next_page} . '.php'));
            
            echo \$OUTPUT->footer();
                ";
                $start++;
            }
            fwrite($file_stream, $string0);
            fwrite($file_stream, $string1);

            // file_put_contents($questionnaireFile, $string0);
            // file_put_contents($questionnaireFile, $string1, FILE_APPEND | LOCK_EX);
            $page_number++;
        }
    }
    return true;
}
