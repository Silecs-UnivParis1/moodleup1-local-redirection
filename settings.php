<?php
/**
 * Settings and links
 *
 * @package    local_redirection
 * @copyright  2016-2020 Silecs {@link http://www.silecs.info/societe}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$ADMIN->add('reports', 
            new admin_externalpage(
                'local_redirection_viewreport',
                "UP1 Redirections d'URL (url fixes)",
                "$CFG->wwwroot/local/redirection/viewreport.php",
                'local/redirection:viewreport'
                )
        );

// no report settings
$settings = null;
