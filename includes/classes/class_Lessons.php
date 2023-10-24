<?

//require_once DIR_INCLUDES . "/Vimeo/Autoloader.php";

/******************************************************
 * Class Lessons
 *
 * Post Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_Lessons.php
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
class Lessons extends DbBasic
{
    public function Lessons()
    {
        $this->pkey = "lesson_id";
        $this->tbl = "_lessons";
    }

    //SELECT
    public function getAllSimple($cond)
    {
        global $dbconn;
        $sql = "SELECT a.lesson_id, a.slug, a.lang_code, a.cat_id, a.name, a.image, a.reg_date, a.total_view ,a.is_trial,a.is_online, a.user_id, a.attachment, a.video_id,
						b.user_name, b.fullname, c.cat_id, c.name AS cat_name, c.slug AS cat_slug
				FROM $this->tbl AS a
				INNER JOIN _users AS b ON a.user_id = b.user_id
				INNER JOIN _category AS c ON a.cat_id = c.cat_id
				WHERE $cond";
        return $dbconn->GetAll($sql);
    }

    public function getAllSimple2($cond)
    {
        global $dbconn;
        $sql = "SELECT lesson_id, slug, lang_code, cat_id, name, image, reg_date, total_view, is_online, user_id
				FROM $this->tbl
				WHERE $cond";
        return $dbconn->GetAll($sql);
    }

    public function getOneSimple2($lesson_id)
    {
        global $dbconn;
        $sql = "SELECT lesson_id, slug, lang_code, cat_id, name, image, reg_date, price, total_view, is_online, user_id
				FROM $this->tbl
				WHERE lesson_id=$lesson_id";
        return $dbconn->GetRow($sql);
    }

    /**
     * Get lesson ID from name
     *
     * @param string $name
     * @return Ambigous <number, unknown>
     */
    public function getIdFromName($name = "")
    {
        global $dbconn;
        $slug = utf8_nosign_noblank($name);
        $sql = "SELECT lesson_id FROM _lessons WHERE name='$name' || slug='$slug'";
        $arr = $dbconn->GetRow($sql);
        return (is_array($arr) && $arr[$this->pkey] > 0) ? $arr[$this->pkey] : 0;
    }

    /**
     * Get List lesson by Best Seller
     *
     * @param number $cat_id
     * @param number $limit
     * @param number $start
     */
    public function getListBestSeller($cat_id = 0, $limit = 10, $start = 0)
    {
        $cond = "is_online=1";
        if ($cat_id > 0) {
            $cond .= " AND cat_id=$cat_id";
        }

        $cond .= " ORDER BY total_checkout DESC";
        $cond .= " LIMIT $start, $limit";
        return $this->getAllSimple2($cond);
    }

    /**
     * Get List lesson by New Arrival
     *
     * @param number $cat_id
     * @param number $limit
     * @param number $start
     */
    public function getListNewArrival($cat_id = 0, $limit = 10, $start = 0)
    {
        $cond = "is_online=1";
        if ($cat_id > 0) {
            $cond .= " AND cat_id=$cat_id";
        }

        $cond .= " ORDER BY reg_date DESC";
        $cond .= " LIMIT $start, $limit";
        return $this->getAllSimple2($cond);
    }

    /**
     * Get List lesson by Featured lessons
     *
     * @param number $cat_id
     * @param number $limit
     * @param number $start
     */
    public function getListFeatured($cat_id = 0, $limit = 10, $start = 0)
    {
        $cond = "is_online=1";
        if ($cat_id > 0) {
            $cond .= " AND cat_id=$cat_id";
        }

        $cond .= " ORDER BY total_view DESC";
        $cond .= " LIMIT $start, $limit";
        return $this->getAllSimple2($cond);
    }
    //INSERT
    function getCatHistory($user_id=0, $cat_id=0){
        global $core, $dbconn;
        $sql = "SELECT study_history_id, user_id, SUM(total_time) AS total_time, MIN(first_time) AS first_time, MAX(last_time) AS last_time 
                        FROM _study_history WHERE user_id=$user_id AND course_id=$cat_id";
        $row = $dbconn->GetRow($sql);
        return (is_array($row) && !empty($row))? $row : 0;
    }
    function getStudyHistory($user_id=0, $lesson_id=0){
        global $core, $dbconn;
        $sql = "SELECT * FROM _study_history WHERE user_id=$user_id AND lesson_id=$lesson_id";
        $row = $dbconn->GetRow($sql);
        return (is_array($row) && !empty($row))? $row : 0;
    }
    function checkExistsHistory($user_id=0, $lesson_id=0){
        global $core, $dbconn;
        $sql = "SELECT * FROM _study_history WHERE user_id=$user_id AND lesson_id=$lesson_id";
        $row = $dbconn->GetRow($sql);
        return (is_array($row) && !empty($row))? $row['study_history_id'] : 0;
    }
    function initStudyHistory($lesson_id=0){
        global $core, $dbconn;
        if ($lesson_id==0) return 0;        
        $lession = $this->getOne($lesson_id);
        $course_id = $lession['cat_id'];
        $user_id = $core->_USER['user_id'];
        $total_time = 0;
        $first_time = time();
        $last_time = time();

        $exists_id = $this->checkExistsHistory($user_id, $lesson_id);

        if ($exists_id==0){
            $fields = "user_id, course_id, lesson_id, total_time, first_time, last_time";
            $values = "$user_id, $course_id, $lesson_id, $total_time, $first_time, $last_time";
            $sql = "INSERT INTO _study_history($fields) VALUES($values)";
            $dbconn->Execute($sql);            
        }else{
            $sets = "last_time = $last_time";
            $sql = "UPDATE _study_history SET $sets WHERE  user_id=$user_id AND lesson_id=$lesson_id";
            $dbconn->Execute($sql);            
        }
    }
    function updateStudyHistory($lesson_id=0, $beginTime=0, $endTime=0){
        global $core, $dbconn;
        if ($lesson_id==0) return 0; 
        $user_id = $core->_USER['user_id'];

        //Luu vao bang _study_history_detail
        $fields = "user_id, lesson_id, begin_time, end_time";
        $values = "$user_id, $lesson_id, $beginTime, $endTime";
        $sql = "INSERT INTO _study_history_detail($fields) VALUES($values)";
        $dbconn->Execute($sql);

        //Luu vao bang _study_history_lession
        $total_time = $endTime - $beginTime;
        $sets = "total_time = total_time + $total_time";
        $sql = "UPDATE _study_history SET $sets WHERE  user_id=$user_id AND lesson_id=$lesson_id";
        $dbconn->Execute($sql);
    }

    function updateStudyPoint($lesson_id=0, $scores=0, $total_question=0, $result=""){
        global $core, $dbconn;
        if ($lesson_id==0) return 0; 
        $user_id = $core->_USER['user_id']; 
        
        //Luu vao bang _study_history_lession 
        $result = nl2br($result);
        $result = addslashes($result);
        $sets = "scores = $scores, total_question = $total_question, question_result = '$result'";
        $sql = "UPDATE _study_history SET $sets WHERE user_id=$user_id AND lesson_id=$lesson_id";
        $dbconn->Execute($sql);
    }

    // function updateResulQuestion($lesson_id=0, $question_result=0){
    //     global $core, $dbconn;
    //     if ($lesson_id==0) return 0; 
    //     $user_id = $core->_USER['user_id'];
        
    //     //Luu vao bang _study_history_lession        
    //     $sets = "question_result = $question_result";
    //     $sql = "UPDATE _study_history SET $sets WHERE user_id-$user_id AND lesson_id=$lesson_id";
    //     $dbconn->Execute($sql);
    // }

    //UPDATE
    /**
     * Increase total Views
     *
     * @param number $lesson_id
     * @return none
     */
    public function incView($lesson_id = 0)
    {
        return $this->updateOne($lesson_id, "total_view=total_view+1");
    }

    /**
     * Increase total checkout
     *
     * @param number $lesson_id
     * @return none
     */
    public function incCheckout($lesson_id = 0)
    {
        return $this->updateOne($lesson_id, "total_checkout=total_checkout+1");
    }

    /**
     * Increase total add cart
     *
     * @param number $lesson_id
     * @return none
     */
    public function incAddCart($lesson_id = 0)
    {
        return $this->updateOne($lesson_id, "total_addcart=total_addcart+1");
    }
    //DELETE

    // HA
    public function getSiblings($lesson)
    {
        global $_LANG_ID;

        return $this->getAll("parent_id = $lesson[parent_id] AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");
    }
}
