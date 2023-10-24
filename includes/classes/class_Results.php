<?

/******************************************************
 * Class Results
 *
 * Static Results Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_results.php
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
class Results extends dbBasic
{
    function Results()
    {
        $this->pkey = "result_id";
        $this->tbl = "_results";
    }

    //SELECT

    public function getAllHistory($cond)
    {
        global $dbconn;
        $sql = "SELECT a.*, u.total_user , e.name, e.slug, e.des, e.time_end, l.name as level_name, l.code ,s.name as skill_name 
				FROM $this->tbl AS a
				INNER JOIN _exam AS e ON a.exam_id = e.exam_id
                INNER JOIN _category AS c ON e.cat_id = c.cat_id
                INNER JOIN _level AS l ON c.level_id = l.level_id
                LEFT JOIN _skills AS s ON e.skill_id = s.skill_id
				,(SELECT COUNT(user_id) AS total_user FROM _users WHERE user_id IN (SELECT user_id FROM _results)) as u
				WHERE $cond";

        return $dbconn->GetAll($sql);
    }

    /**
     * Get list Results by ID or array ID
     *
     * @param number $id
     */
    function getListResultsById($id = 0)
    {
        $cond = "";
        if (is_numeric($id)) {
            $cond = "result_id=$id";
        } else
            if (is_array($id)) {
                $s = implode(',', $id);
                $cond = "result_id IN ($s)";
            } else
                if (strpos(',', $id) !== false) {
                    $cond = "result_id IN ($id)";
                }
        $cond .= " ORDER BY reg_date DESC";
        return $this->getAll($cond);
    }
    //INSERT
    //UPDATE
    //DELETE
    //OTHER
}

?>