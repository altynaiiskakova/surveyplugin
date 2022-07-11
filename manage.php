<?php
/**
 *
 * @package    mod_surveyplugin
 * @author     iskakova
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');

$PAGE->set_url(new moodle_url('/mod/surveyplugin/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Manage survey');

echo $OUTPUT->header();

//echo '<h1>hello</h1>';

echo $OUTPUT->footer();

