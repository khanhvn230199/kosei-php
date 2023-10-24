<?

/******************************************************
 * Class Stage
 *
 * Static Stage Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_Stage.php
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
class Stage extends dbBasic
{
    function Stage()
    {
        $this->pkey = "stage_id";
        $this->tbl = "_stage";
    }
    //SELECT

    /**
     * Get Stage by slug
     *
     * @param string $slug
     * @return Ambigous <number, unknown>
     */
    function getBySlug($slug = "")
    {
        global $lang_code;
        return $this->getByCond("slug='$slug' AND lang_code='$lang_code'");
    }

    /**
     * Get list Stage by ID or array ID
     *
     * @param number $id
     */
    function getListStageById($id = 0)
    {
        $cond = "";
        if (is_numeric($id)) {
            $cond = "stage_id=$id";
        } else
            if (is_array($id)) {
                $s = implode(',', $id);
                $cond = "stage_id IN ($s)";
            } else
                if (strpos(',', $id) !== false) {
                    $cond = "stage_id IN ($id)";
                }
        $cond .= " ORDER BY order_no";
        return $this->getAll($cond);
    }
    //INSERT
    //UPDATE
    //DELETE
    //OTHER
}

function makeArrayListStage($parent_id = 0, $level = 0, $maxlevel = 5, &$ret, $cond = "", $short = 0)
{
    if ($level == $maxlevel) return "";
    global $dbconn, $lang_code;
    $sql = "SELECT a.*,c.name as course_name FROM _stage AS a INNER JOIN _category as c ON a.cat_id = c.cat_id WHERE a.is_online=1 AND a.lang_code = '$lang_code' AND a.parent_id=$parent_id";
    if ($cond != "") $sql .= " AND $cond";
    $sql .= " ORDER BY a.order_no, a.stage_id";
    $arrListStage = $dbconn->GetAll($sql);
    if (is_array($arrListStage)) {
        foreach ($arrListStage as $k => $v) {
            $value = $v["stage_id"];
            $option = ($short == 1) ? $v["name"] . " &lt;" . $v["course_name"] . "&gt;" : $v["name"];
            $ret["$value"] = str_repeat("&brvbar;--- ", $level) . $option;
            makeArrayListStage($v["stage_id"], $level + 1, $maxlevel, $ret, $cond, $short);
        }
        unset($arrListStage);
        return "";
    }
    unset($arrListStage);
    return "";
}

?>