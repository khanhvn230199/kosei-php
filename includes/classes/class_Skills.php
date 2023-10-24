<?

/******************************************************
 * Class Skills
 *
 * Static Skills Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_Skills.php
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
class Skills extends dbBasic
{
    function Skills()
    {
        $this->pkey = "skill_id";
        $this->tbl = "_skills";
    }
    //SELECT

    /**
     * Get Skills by slug
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
     * Get list Skills by ID or array ID
     *
     * @param number $id
     */
    function getListSkillsById($id = 0)
    {
        $cond = "";
        if (is_numeric($id)) {
            $cond = "skill_id=$id";
        } else
            if (is_array($id)) {
                $s = implode(',', $id);
                $cond = "skill_id IN ($s)";
            } else
                if (strpos(',', $id) !== false) {
                    $cond = "skill_id IN ($id)";
                }
        $cond .= " ORDER BY order_no";
        return $this->getAll($cond);
    }
    //INSERT
    //UPDATE
    //DELETE
    //OTHER
}

function makeArrayListSkills(&$ret)
{
    global $dbconn, $lang_code;
    $sql = "SELECT * FROM _skills WHERE is_online=1 AND lang_code = '$lang_code'";
    $sql .= " ORDER BY order_no, skill_id";
    $arrListSkills = $dbconn->GetAll($sql);
    if (is_array($arrListSkills)) {
        foreach ($arrListSkills as $k => $v) {
            $value = $v["skill_id"];
            $option = $v["name"];
            $ret["$value"] = $option;
        }
        unset($arrListSkills);
        return "";
    }
    unset($arrListSkills);
    return "";
}


?>