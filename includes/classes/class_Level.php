<?

/******************************************************
 * Class Level
 *
 * Static Level Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_level.php
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
class Level extends dbBasic
{
    function Level()
    {
        $this->pkey = "level_id";
        $this->tbl = "_level";
    }
    //SELECT

    /**
     * Get list Level by ID or array ID
     *
     * @param number $id
     */
    function getListLevelById($id = 0)
    {
        $cond = "";
        if (is_numeric($id)) {
            $cond = "level_id=$id";
        } else
            if (is_array($id)) {
                $s = implode(',', $id);
                $cond = "level_id IN ($s)";
            } else
                if (strpos(',', $id) !== false) {
                    $cond = "level_id IN ($id)";
                }
        $cond .= " ORDER BY order_no";
        return $this->getAll($cond);
    }
    //INSERT
    //UPDATE
    //DELETE
    //OTHER
}

function makeArrayListLevel(&$ret)
{
    global $dbconn, $lang_code;
    $sql = "SELECT * FROM _level WHERE is_online=1 AND lang_code = '$lang_code'";
    $sql .= " ORDER BY order_no, level_id";
    $arrListLevel = $dbconn->GetAll($sql);
    if (is_array($arrListLevel)) {
        foreach ($arrListLevel as $k => $v) {
            $value = $v["level_id"];
            $option = $v["name"];
            $ret["$value"] = $option;
        }
        unset($arrListLevel);
        return "";
    }
    unset($arrListLevel);
    return "";
}

function makeListLevel($selectedid = "", $cond = "")
{
    global $dbconn, $lang_code;
    $clsTrialTest = new TrialTest();
    $now = time();
    $arrOneTrialTesst = $clsTrialTest->getByCond("start_date<=$now AND end_date>=$now AND lang_code='$lang_code' ORDER BY reg_date ASC LIMIT 1");
    if (!is_array($arrOneTrialTesst) || count($arrOneTrialTesst) == 0) {
        $arrOneTrialTesst = $clsTrialTest->getByCond("start_date>=$now AND lang_code='$lang_code' ORDER BY reg_date ASC LIMIT 1");
    }
    $sql = "SELECT level_id, name FROM _level WHERE lang_code='$lang_code' AND level_id IN (SELECT level_id FROM _test WHERE tt_id = $arrOneTrialTesst[tt_id] AND lang_code='$lang_code' AND is_online=1)";
    if ($cond != "") $sql .= " AND $cond";
    $sql .= "  ORDER BY order_no, name ASC";
    $arrListLevel = $dbconn->GetAll($sql);
    $html = "";
    if (is_array($arrListLevel)) {
        foreach ($arrListLevel as $k => $v) {
            $selected = ($v["level_id"] == $selectedid) ? "selected" : "";
            $value = $v["level_id"];
            $option = $v["name"];
            $html .= "<option value=\"$value\" $selected>$option</option>";
        }
        return $html;
    } else {
        return "";
    }
}


?>