<?php
/**
 * @package    local_redirection
 * @copyright  2016-2020 Silecs {@link http://www.silecs.info/societe}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
use \local_redirection\reporting;

require(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');

require_login();

/* @var $PAGE moodle_page */
global $PAGE, $OUTPUT;

$PAGE->set_context(context_system::instance());
$PAGE->set_url("{$CFG->wwwroot}/local/redirection/viewreport.php");
$PAGE->set_pagelayout('report');

$titre = 'Redirections - rapport';
$PAGE->set_title($titre); // tab title
$PAGE->set_heading($titre); // titre haut de page
$PAGE->navbar->add('Stats redirections');

echo $OUTPUT->header();

$headers = ['Nombre', 'Url fixe', 'Cours', 'ID cours'];

$table = new html_table();
$table->head = $headers;
$table->data = reporting::get_duplicates();
printf("<h3>Doublons (%d)</h3>\n", count($table->data));
echo html_writer::table($table);

$table = new html_table();
$table->head = $headers;
$table->data = reporting::get_deleted_targets();
printf("<h3>Cours cibles supprimés (%d)</h3>\n", count($table->data));
echo html_writer::table($table);

$table = new html_table();
$table->head = $headers;
$table->data = reporting::get_list();
printf("<h3>Redirections normales (%d)</h3>\n", count($table->data));
echo html_writer::table($table);

echo $OUTPUT->footer();
