<?

/******************************************************
 * Class Level
 *
 * Static Level Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_Trialtest.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  Banglcb
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        2014/02/10        Banglcb          -        -     -     -
 *
 ********************************************************/
class TrialTest extends dbBasic
{
    function TrialTest()
    {
        $this->pkey = "tt_id";
        $this->tbl = "_trial_test";
    }

    //SELECT
    //INSERT
    //UPDATE
    //DELETE
    //OTHER

    /**
     * Check slug is exists or not?
     *
     * @param string $slug
     * @param string $old_slug
     * @return Ambigous <number, unknown>
     */

    function isExistsSlug($slug = "", $old_slug = "")
    {
        global $dbconn, $lang_code;
        $sql = "SELECT COUNT(tt_id) AS total_item 
                FROM " . $this->tbl . " 
                WHERE lang_code='$lang_code' AND slug!='$old_slug' AND (slug='$slug' OR slug REGEXP '^" . $slug . "[0-9]+$')";
        $aTest = $dbconn->GetRow($sql);
        return (is_array($aTest) && $aTest['total_item'] > 0) ? $aTest['total_item'] : 0;
    }
}

function makeArrayListTrialTest(&$ret, $cond = "")
{
    global $dbconn, $lang_code;
    $sql = "SELECT * FROM _trial_test WHERE is_online=1 AND lang_code = '$lang_code'";
    if ($cond != "") {
        $sql .= " AND $cond";
    }
    $sql .= " ORDER BY tt_id";
    $arrListTrialTest = $dbconn->GetAll($sql);
    if (is_array($arrListTrialTest)) {
        foreach ($arrListTrialTest as $k => $v) {
            $value = $v["tt_id"];
            $option = $v["name"];
            $ret["$value"] = $option;
        }
        unset($arrListTrialTest);
        return "";
    }
    unset($arrListTrialTest);
    return "";
}

?>