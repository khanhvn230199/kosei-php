<?

/******************************************************
 * Class Level
 *
 * Static Level Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_Test.php
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
class Test extends dbBasic
{
    function Test()
    {
        $this->pkey = "test_id";
        $this->tbl = "_test";
    }

    //SELECT

    function getOneSimple($cond = "")
    {
        global $dbconn;
        $sql = "SELECT a.*,l.name as level_name, l.code
                FROM $this->tbl AS a 
                INNER JOIN _level AS l ON a.level_id = l.level_id
				WHERE $cond";
        return $dbconn->GetRow($sql);
    }

    function getAllSimple($cond = "")
    {
        global $dbconn;
        $sql = "SELECT a.*, u.total_user, e.duration, l.name as level_name, l.code
                FROM $this->tbl AS a 
                INNER JOIN _level AS l ON a.level_id = l.level_id
				,(SELECT COUNT(user_id) AS total_user FROM _users WHERE user_id IN (SELECT user_id FROM _candidates)) as u
				,(SELECT SUM(time_end) AS duration FROM _exam WHERE test_id IN (SELECT test_id FROM _exam)) as e
				WHERE $cond";
        return $dbconn->GetAll($sql);
    }

    /**
     * Get list Level by ID or array ID
     *
     * @param number $id
     */
    function getListTestById($id = 0)
    {
        $cond = "";
        if (is_numeric($id)) {
            $cond = "test_id=$id";
        } else
            if (is_array($id)) {
                $s = implode(',', $id);
                $cond = "test_id IN ($s)";
            } else
                if (strpos(',', $id) !== false) {
                    $cond = "test_id IN ($id)";
                }
        $cond .= " ORDER BY order_no";
        return $this->getAll($cond);
    }
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
        $sql = "SELECT COUNT(test_id) AS total_item 
                FROM " . $this->tbl . " 
                WHERE lang_code='$lang_code' AND slug!='$old_slug' AND (slug='$slug' OR slug REGEXP '^" . $slug . "[0-9]+$')";
        $aTest = $dbconn->GetRow($sql);
        return (is_array($aTest) && $aTest['total_item'] > 0) ? $aTest['total_item'] : 0;
    }
}

function makeArrayListTest(&$ret)
{
    global $dbconn, $lang_code;
    $sql = "SELECT * FROM _test WHERE is_online=1 AND lang_code = '$lang_code'";
    $sql .= " ORDER BY order_no, test_id";
    $arrListLevel = $dbconn->GetAll($sql);
    if (is_array($arrListLevel)) {
        foreach ($arrListLevel as $k => $v) {
            $value = $v["test_id"];
            $option = $v["name"];
            $ret["$value"] = $option;
        }
        unset($arrListLevel);
        return "";
    }
    unset($arrListLevel);
    return "";
}

?>