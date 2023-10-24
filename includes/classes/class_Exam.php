<?

/******************************************************
 * Class Exam
 *
 * Static Exam Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_exam.php
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
class Exam extends dbBasic
{
    function Exam()
    {
        $this->pkey = "exam_id";
        $this->tbl = "_exam";
    }
    //SELECT

    /**
     * Get list Exam by ID or array ID
     *
     * @param number $id
     */
    function getListExamById($id = 0)
    {
        $cond = "";
        if (is_numeric($id)) {
            $cond = "exam_id=$id";
        } else
            if (is_array($id)) {
                $s = implode(',', $id);
                $cond = "exam_id IN ($s)";
            } else
                if (strpos(',', $id) !== false) {
                    $cond = "exam_id IN ($id)";
                }
        $cond .= " ORDER BY order_no";
        return $this->getAll($cond);
    }

    function getOneSimple($exam_id){
        global $dbconn;
        $sql = "SELECT a.*,c.image as course_image,c.name as course_name,c.level_id ,l.name as level_name, l.code ,s.name as skill_name 
                FROM $this->tbl AS a 
                INNER JOIN _category AS c ON a.cat_id = c.cat_id 
                INNER JOIN _level AS l ON c.level_id = l.level_id
                LEFT JOIN _skills AS s ON a.skill_id = s.skill_id
				WHERE a.exam_id = $exam_id";
        return $dbconn->GetRow($sql);
    }

    function getAllSimple($cond = "")
    {
        global $dbconn;
        $sql = "SELECT a.*, u.total_user, c.image as course_image,c.name as course_name,c.level_id ,l.name as level_name, l.code ,s.name as skill_name 
                FROM $this->tbl AS a 
                INNER JOIN _category AS c ON a.cat_id = c.cat_id 
                INNER JOIN _level AS l ON c.level_id = l.level_id
                LEFT JOIN _skills AS s ON a.skill_id = s.skill_id
				,(SELECT COUNT(user_id) AS total_user FROM _users WHERE user_id IN (SELECT user_id FROM _results)) as u
				WHERE $cond";
        return $dbconn->GetAll($sql);
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
        $sql = "SELECT COUNT(exam_id) AS total_item 
                FROM " . $this->tbl . " 
                WHERE lang_code='$lang_code' AND slug!='$old_slug' AND (slug='$slug' OR slug REGEXP '^" . $slug . "[0-9]+$')";
        $aExam = $dbconn->GetRow($sql);
        return (is_array($aExam) && $aExam['total_item'] > 0) ? $aExam['total_item'] : 0;
    }
}

function makeArrayListExam(&$ret, $short = 0)
{
    global $dbconn, $lang_code;
    $sql = "SELECT a.*,c.name as course_name FROM _exam AS a INNER JOIN _category as c ON a.cat_id = c.cat_id WHERE a.is_online=1 AND a.lang_code = '$lang_code'";
    $sql .= " ORDER BY a.order_no, a.exam_id";
    $arrListExam = $dbconn->GetAll($sql);
    if (is_array($arrListExam)) {
        foreach ($arrListExam as $k => $v) {
            $value = $v["exam_id"];
            $option = ($short == 1) ? $v["name"] . " &lt;" . $v["course_name"] . "&gt;" : $v["name"];
            $ret["$value"] = $option;
        }
        unset($arrListExam);
        return "";
    }
    unset($arrListExam);
    return "";
}

?>