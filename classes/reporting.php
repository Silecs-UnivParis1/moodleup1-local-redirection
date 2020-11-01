<?php
/**
 * @package    local_redirection
 * @copyright  2016-2020 Silecs {@link http://www.silecs.info/societe}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_redirection;

/**
 * Methods used to synchronize the cohorts upon the webservices
 * normally, to be used by a scheduled task on a daily basis
 */
class reporting
{
    private $verbose = 0;

    /**
     *
     */
    function __construct()
    {
        //$this->verbose = $verbose;
    }


    /**
     * liste des supports et des cours normaux
     * @global moodle_database $DB
     * @return array(array(string)) : table rows
     */
    public static function get_list() {
        global $CFG, $DB;
        $res = [];
        $sql = "SELECT c.shortname AS crsname, cd.instanceid AS crsid, cd.charvalue "
              . "FROM {customfield_data} cd "
              . "JOIN {customfield_field} cf ON (cd.fieldid = cf.id) "
              . "JOIN {course} c ON (c.id = cd.instanceid) "
              . "WHERE cf.shortname = 'up1urlfixe' AND cd.charvalue != ''  ORDER BY cd.charvalue ";
        $records = $DB->get_records_sql($sql);

        foreach ($records as $record) {
            $urlredirection = $CFG->wwwroot . '/fixe/' . $record->charvalue;
            $urlcourse = new \moodle_url('/course/view.php', ['id' => $record->crsid]);
            $res[] = [
                $record->charvalue,
                \html_writer::link($urlredirection, $urlredirection),
                \html_writer::link($urlcourse, $record->crsname),
            ];
        }
        return $res;
    }

    /**
     * liste des doublons (support fixe utilisé plus d'une fois)
     * @global moodle_database $DB
     * @return array(array(string)) : table rows
     */
    public static function get_duplicates() {
        global $DB;
        $res = [];
        $sql = "SELECT COUNT(DISTINCT cd.id) AS cnt, GROUP_CONCAT(c.shortname) AS names, GROUP_CONCAT(cd.instanceid) AS crsid, cd.charvalue "
              . "FROM {customfield_data} cd "
              . "JOIN {customfield_field} cf ON (cd.fieldid = cf.id) "
              . "JOIN {course} c ON (c.id = cd.instanceid) "
              . "WHERE cf.shortname = 'up1urlfixe' AND cd.charvalue != '' "
              . "GROUP BY cd.charvalue HAVING cnt > 1";
        $doublons = $DB->get_records_sql($sql);

        foreach ($doublons as $doublon) {
            $res[] = [
                $doublon->cnt,
                $doublon->charvalue,
                $doublon->names,
                $doublon->crsid,
            ];
        }
        return $res;
    }


    /**
     * liste des liens ciblant des cours supprimés
     * @global moodle_database $DB
     * @return array(array(string)) : table rows
     */
    public static function get_deleted_targets() {
        global $DB;
        $res = [];
        $sql = "SELECT c.shortname AS name, cd.instanceid AS crsid, cd.charvalue "
              . "FROM {customfield_data} cd "
              . "JOIN {customfield_field} cf ON (cd.fieldid = cf.id) "
              . "LEFT JOIN {course} c ON (c.id = cd.instanceid) "
              . "WHERE cf.shortname = 'up1urlfixe' AND c.id IS NULL";
        $supprimes = $DB->get_records_sql($sql);

        foreach ($supprimes as $supprime) {
            $res[] = [
                $supprime->charvalue,
                $supprime->name,
                $supprime->crsid,
            ];
        }
        return $res;
    }
}