<?php
/**
 * @package    local_redirection
 * @copyright  2016-2020 Silecs {@link http://www.silecs.info/societe}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$plugin->version   = 2020103100;        // The current plugin version (Date: YYYYMMDDXX)
$plugin->requires  = 2020060900;        // Requires this Moodle version
$plugin->component = 'local_redirection'; // Full name of the plugin (used for diagnostics)

$plugin->dependencies = array(
    'local_up1_metadata' => 2020100300,
);
