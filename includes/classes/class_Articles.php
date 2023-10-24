<?

/******************************************************
 * Class Articles (Post)
 *
 * Post Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_Articles.php
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
class Articles extends DbBasic
{
    function Articles()
    {
        $this->pkey = "article_id";
        $this->tbl = "_articles";
    }

    //SELECT
    function getAllSimple($cond)
    {
        global $dbconn;
        $sql = "SELECT a.article_id, a.slug, a.lang_code, a.cat_id, a.title, a.sapo, a.image, a.reg_date, a.view_num, a.is_online,a.facebook,a.instagram,a.twitter, a.is_hot, a.is_verify, a.user_id, a.venue,					
						b.user_name, b.fullname, b.user_group_id, c.cat_id, c.name AS cat_name, c.slug AS cat_slug
				FROM $this->tbl AS a
				INNER JOIN _users AS b ON a.user_id = b.user_id
				INNER JOIN _category AS c ON a.cat_id = c.cat_id
				WHERE $cond";
        return $dbconn->GetAll($sql);
    }

    function getAllSimple2($cond)
    {
        global $dbconn;
        $sql = "SELECT article_id, slug, lang_code, cat_id, title, sapo, image, reg_date, view_num, is_online, is_hot, is_verify, user_id
				FROM $this->tbl	
				WHERE $cond";
        return $dbconn->GetAll($sql);
    }
    //Lấy 1 tin mới nhất

    /**
     * Get one latest article
     *
     * @param string $cat_id_str
     * @return Ambigous <number, unknown>
     */
    function getRandomImage($cat_id_str = "")
    {
        global $core, $lang_code;
        $cond = "is_verify=1 AND is_online=1 AND lang_code='$lang_code' AND image!=''";
        if ($cat_id_str != "") $cond .= " AND cat_id in ($cat_id_str)";
        $cond .= " ORDER BY RAND()";
        return $this->getByCond($cond);
    }
    /**
     * Get one latest article
     *
     * @param string $cat_id_str
     * @return Ambigous <number, unknown>
     */
    function getHottest($cat_id_str = "", $start=0)
    {
    	global $core, $lang_code;
    	$cond = "a.is_verify=1 AND a.is_online=1 AND a.lang_code='$lang_code'";
    	if ($cat_id_str != "") $cond .= " AND a.cat_id in ($cat_id_str)";
    	$cond .= " ORDER BY a.is_hot DESC, a.reg_date DESC LIMIT $start, 1";
    	$cond = str_replace('a.', '', $cond);
    	return $this->getByCond($cond);
    }
    /**
     * Get one latest event
     *
     * @param string $cat_id_str
     * @return Ambigous <number, unknown>
     */
    function getHottestEvent($cat_id_str = "", $start=0)
    {
    	global $core, $lang_code;
    	$today0H = getIntToday0H();
    	$cond = "a.is_verify=1 AND a.is_online=1 AND a.lang_code='$lang_code'";
    	$cond.= " AND a.reg_date>=$today0H";
    	if ($cat_id_str != "") $cond .= " AND a.cat_id in ($cat_id_str)";
    	$cond .= " ORDER BY a.is_hot DESC, a.reg_date ASC LIMIT $start, 1";
    	$cond = str_replace('a.', '', $cond);
    	return $this->getByCond($cond);
    }
    /**
     * Get one latest article
     *
     * @param string $cat_id_str
     * @return Ambigous <number, unknown>
     */
    function getLastest($cat_id_str = "", $start=0)
    {
        global $core, $lang_code;
        $cond = "a.is_verify=1 AND a.is_online=1 AND a.lang_code='$lang_code'";
        if ($cat_id_str != "") $cond .= " AND a.cat_id in ($cat_id_str)";
        $cond .= " ORDER BY a.reg_date DESC LIMIT $start, 1";
        $cond = str_replace('a.', '', $cond);
        return $this->getByCond($cond);
    }
    /**
     * Get one latest event
     *
     * @param string $cat_id_str
     * @return Ambigous <number, unknown>
     */
    function getLastestEvent($cat_id_str = "", $start=0)
    {
    	global $core, $lang_code;
    	$today0H = getIntToday0H();
    	$cond = "a.is_verify=1 AND a.is_online=1 AND a.lang_code='$lang_code'";
    	$cond.= " AND a.reg_date>=$today0H";
    	if ($cat_id_str != "") $cond .= " AND a.cat_id in ($cat_id_str)";
    	$cond .= " ORDER BY a.reg_date ASC LIMIT $start, 1";
    	$cond = str_replace('a.', '', $cond);
    	return $this->getByCond($cond);
    }
    //Lấy list tin mới nhất

    /**
     * Get list latest Articles
     *
     * @param string $cat_id_str
     * @param number $limit
     * @param number $start
     * @param string $acond
     */
    function getListLastest($cat_id_str = "", $limit = 5, $start = 0, $acond = "")
    {//get optimizer SQL
        global $core, $lang_code, $dbconn;
        $cond = "a.is_verify=1 AND a.is_online=1 AND a.lang_code='$lang_code'";
        if ($acond != "") $cond .= " AND ($acond)";
        if ($cat_id_str != "") {
            $cond .= (strpos($cat_id_str, ',') !== false) ? " AND a.cat_id in ($cat_id_str)" : " AND a.cat_id=$cat_id_str";
        }
        $cond .= " ORDER BY a.reg_date DESC LIMIT $start, $limit";
        return $this->getAllSimple($cond);
    }
    //Lấy list tin phổ biến / nhiều người đọc nhất

    /**
     * Get list popular Articles
     *
     * @param string $cat_id_str
     * @param number $limit
     */
    function getListPopular($cat_id_str = "", $limit = 5, $start = 0, $acond = "")
    {
        global $core, $lang_code, $dbconn;
        $cond = "a.is_verify=1 AND a.is_online=1 AND a.lang_code='$lang_code'";
        if ($acond != "") $cond .= " AND ($acond)";
        if ($cat_id_str != "") {
            $cond .= (strpos($cat_id_str, ',') !== false) ? " AND a.cat_id in ($cat_id_str)" : " AND a.cat_id=$cat_id_str";
        }
        $cond .= " ORDER BY a.view_num DESC, a.reg_date DESC LIMIT $start, $limit";
        return $this->getAllSimple($cond);
    }
    //Lấy list tin HOT / nổi bật

    /**
     * Get list Hot Articles
     *
     * @param string $cat_id_str
     * @param number $limit
     * @param number $start
     */
    function getListHot($cat_id_str = "", $limit = 5, $start = 0)
    {
        global $core, $lang_code, $dbconn;
        $cond = "a.is_verify=1 AND a.is_online=1 AND a.lang_code='$lang_code'";
        if ($cat_id_str != "") {
            $cond .= (strpos($cat_id_str, ',') !== false) ? " AND a.cat_id in ($cat_id_str)" : " AND a.cat_id=$cat_id_str";
        }
        $cond .= " ORDER BY a.is_hot DESC, a.view_num DESC, a.reg_date DESC LIMIT $start, $limit";
        return $this->getAllSimple($cond);
    }
    //Lấy list tin HOT / nổi bật và được chọn đưa ra trang chủ

    /**
     * Get list articles marked by Hot and Home
     *
     * @param string $cat_id_str
     * @param number $limit
     */
    function getListTopHome($cat_id_str = "", $limit = 5)
    {
        global $core, $lang_code, $dbconn;
        $cond = "a.is_verify=1 AND a.is_online=1 AND a.at_home=1 AND a.is_hot=1 AND a.lang_code='$lang_code'";
        if ($cat_id_str != "") {
            $cond .= (strpos($cat_id_str, ',') !== false) ? " AND a.cat_id in ($cat_id_str)" : " AND a.cat_id=$cat_id_str";
        }
        $cond .= " ORDER BY a.reg_date DESC LIMIT 0, $limit";
        return $this->getAllSimple($cond);
    }
    //Lấy danh sách tin khác

    /**
     * Get list other articles in an article page
     *
     * @param number $article_id
     * @param number $limit
     */
    function getListOther($article_id = 0, $limit = 5)
    {
        global $lang_code;
        $cond = "a.is_verify=1 AND a.is_online=1 AND a.article_id<>$article_id  AND a.lang_code='$lang_code'";
        $cond .= " ORDER BY a.reg_date DESC LIMIT 0, $limit";
        return $this->getAllSimple($cond);
    }

    /**
     * Get list events in distance
     *
     * @param number $from_date
     * @param number $to_date
     */
    function getListEvents($from_date = 0, $to_date = 0)
    {
        $cond = "(from_date > $from_date AND from_date < $to_date) OR (to_date > $from_date AND to_date < $to_date) ORDER BY from_date ASC";
        return $this->getAllSimple2($cond);
    }

    /**
     * Get list events in distance for Calendar
     *
     * @param number $from_date
     * @param number $to_date
     */
    function getListCalendarEvents($from_date = 0, $to_date = 0)
    {
        $cond = "(from_date > $from_date AND from_date < $to_date) OR (to_date > $from_date AND to_date < $to_date) ORDER BY from_date ASC";
        $arr = $this->getAllSimple2($cond);
        $arrListEvents = array();
        if (is_array($arr)) {
            foreach ($arr as $key => $val) {
                $from_date = $val['from_date'];
                $to_date = $val['to_date'];
                $i = $from_date;
                while ($i < $to_date) {
                    $d = intval(date("d", $i));
                    $m = intval(date("m", $i));
                    $arrListEvents[$m . '_' . $d][] = $val;
                    $i = $i + 24 * 60 * 60;
                }
            }
        }
        return $arrListEvents;
    }
    //INSERT
    //UPDATE
    //Cập nhật lượt xem cho tin $article_id
    function incView($article_id = 0)
    {
        return $this->updateOne($article_id, "view_num=view_num+1");
    }
    //DELETE
}

?>