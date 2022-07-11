/**
 * moodle-mod_surveyplugin JavaScript for saving student answers into Moodle DB.
 * https://github.com/moodlepeers/moodle-mod_groupformation
 *
 *
 * @author Altynai Iskakova
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 require(['jquery'], function($) {
    $(document).ready(function () {
        $("input[id^='id_question']").on('click', function (e) {
            console.log('CLICKED');
            
            //$('#id_question').addClass('clicked');
            //$("input[id^='id_question']").addClass('clicked');
        
            $(this).addClass('clicked');
            console.log($(this).val());       
        });

    });
});
