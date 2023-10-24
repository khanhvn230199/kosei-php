<?

/******************************************************
 * Class Category
 *
 * Category Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_Category.php
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
class Category extends DbBasic
{
    public $parents = array();

    public function Category()
    {
        $this->pkey = "cat_id";
        $this->tbl = "_category";
    }

    //SELECT

    public function getOneSimple($product_id)
    {
        global $dbconn;
        $sql = "SELECT a.*,p.title, p.discount_type, p.discount_value, p.start_date, p.end_date, p.is_start
				FROM $this->tbl	AS a
				LEFT JOIN _promotion AS p ON a.cat_id = p.course_id
				WHERE a.cat_id=$product_id";
        return $dbconn->GetRow($sql);
    }

    /**
     * Get random promotion course
     * @return mixed
     */
    public function getOnePromotion()
    {
        global $dbconn;
        $now = time();
        $sql = "SELECT c.*, l.name as level_name, l.code, p.title, p.des as promotion_des, p.discount_type, p.discount_value, p.start_date, p.end_date, p.is_start
				FROM $this->tbl	AS c
				INNER JOIN _promotion AS p ON c.cat_id = p.course_id
				INNER JOIN _level AS l ON c.level_id = l.level_id
				WHERE p.is_start = 1 AND c.is_online = 1 AND l.is_online = 1 AND p.start_date <= $now AND p.end_date >= $now
				ORDER BY rand()";
        return $dbconn->GetRow($sql);
    }

    /**
     * Get list category by ID or array ID
     *
     * @param number $id
     */
    public function getListCateById($id)
    {
        $cond = "";
        if (is_numeric($id)) {
            $cond = "cat_id=$id";
        } else
        if (is_array($id)) {
            $s = implode(',', $id);
            $cond = "cat_id IN ($s)";
        } else
        if (strpos(',', $id) !== false) {
            $cond = "cat_id IN ($id)";
        }
        $cond .= " ORDER BY order_no";
        return $this->getAll($cond);
    }

    /**
     * Get category by slug
     *
     * @param string $slug
     * @return Ambigous <number, unknown>
     */
    public function getBySlug($slug = "")
    {
        global $lang_code;
        return $this->getByCond("slug='$slug' AND lang_code='$lang_code'");
    }

    /**
     * Get slug by Pkey ID
     *
     * @param number $pkey_id
     * @return string
     */
    public function getSlug($pkey_id = 0)
    {
        $arr = $this->getOne($pkey_id, 0);
        return (is_array($arr) && $arr[$this->pkey] > 0) ? $arr['slug'] : '';
    }

    /**
     * Get name by Pkey ID
     *
     * @param number $pkey_id
     * @return string|unknown
     */
    public function getName($pkey_id = 0)
    {
        global $dbconn;
        if ($pkey_id == "" || $pkey_id == 0) {
            return "";
        }

        $sql = "SELECT name FROM " . $this->tbl . " WHERE " . $this->pkey . "=$pkey_id";
        $aCategory = $dbconn->GetRow($sql, false, 0);
        return $aCategory["name"];
    }

    /**
     * Get Parent_ID
     *
     * @param number $cat_id
     * @return multitype:|Ambigous <>
     */
    public function get_parent_id($cat_id = 0)
    {
        if ($this->parents[$cat_id] > 0) {
            return $this->parents[$cat_id];
        }

        $arr = $this->getOne($cat_id, 0);
        return $arr['parent_id'];
    }

    /**
     * Get list of category by ctype and parent_id
     *
     * @param number $ctype
     * @param unknown $parent_id
     * @return Ambigous <number, unknown>
     */
    public function getList($ctype = 0, $parent_id = -1)
    {
        $cond = "ctype=$ctype AND is_online=1";
        if ($parent_id >= 0) {
            $cond .= " AND parent_id=$parent_id ORDER BY order_no";
        }

        return $this->getAll($cond);
    }

    public function getRootCat($cat_id = 0)
    {
        $parent_id = $this->parents[$cat_id];
        if ($parent_id == 0) {
            return $cat_id;
        }

        return $this->getRootCat($parent_id);
    }

    /**
     * Check slug is exists or not?
     *
     * @param string $slug
     * @param string $old_slug
     * @return Ambigous <number, unknown>
     */
    public function isExistsSlug($slug = "", $old_slug = "")
    {
        global $dbconn, $lang_code;
        $sql = "SELECT COUNT(cat_id) AS total_item
						FROM " . $this->tbl . "
						WHERE lang_code='$lang_code' AND slug!='$old_slug' AND (slug='$slug' OR slug REGEXP '^" . $slug . "[0-9]+$')";
        $aCategory = $dbconn->GetRow($sql);
        return (is_array($aCategory) && $aCategory['total_item'] > 0) ? $aCategory['total_item'] : 0;
    }

    /**
     * Check 2 cat_id is parent and child?
     *
     * @param number $old_cat_id
     * @param number $old_parent_id
     * @param number $new_parent_id
     * @return number|Ambigous <number, boolean>
     */
    public function isParentChild($old_cat_id = 0, $old_parent_id = 0, $new_parent_id = 0)
    {
        if ($old_cat_id == $new_parent_id) {
            return 1;
        }

        if ($old_parent_id == $new_parent_id) {
            return 0;
        }

        if (!isset($this->parents[$old_cat_id])) {
            $this->getParentArray();
        }
        $ok = 0;
        $i = $new_parent_id;
        while ($this->parents[$i] != 0 && $ok == 0) {
            $ok = ($this->parents[$i] == $old_cat_id);
            $i = $this->parents[$i];
        }
        return $ok;
    }

    public function getParentArray()
    {
        global $dbconn, $lang_code;
        $sql = "SELECT cat_id, name, parent_id
						FROM " . $this->tbl . "
						WHERE is_online=1 AND lang_code='$lang_code' ORDER BY order_no, cat_id";
        $arrListCategory1 = $dbconn->GetAll($sql);
        $this->parents = array();
        if (is_array($arrListCategory1)) {
            foreach ($arrListCategory1 as $k => $v) {
                $this->parents[$v['cat_id']] = $v['parent_id'];
            }
        }
        return $this->parents;
    }

    public function getAllCatStr($cat_id = 0)
    {
        global $dbconn;
        $html = "";
        $ok = 0;
        foreach ($this->parents as $k => $v) {
            if ($v == $cat_id) {
                $html .= $k . ",";
                $html .= $this->getAllCatStr($k);
            }
        }

        return $html;
    }

    public function parent_cat($arrListCart, $cat_id = 0)
    {
        $listParent = "";
        foreach ($arrListCart as $key => $item) {
            if ((int) $item['parent_id'] == (int) $cat_id) {
                $listParent .= $item['cat_id'] . ",";
                unset($arrListCart[$key]);
                $listParent .= $this->parent_cat($arrListCart, $item['cat_id']);
            }
        }
        return substr($listParent, 0, -1);
    }

    public function getAllCatArr($cat_id = 0, $cond = "")
    {
        global $dbconn;
        global $core, $lang_code;
        $sql = "SELECT *
						FROM " . $this->tbl . "
						WHERE lang_code='$lang_code' AND is_online=1 AND parent_id='$cat_id'";
        if ($cond != "") {
            $sql .= " AND $cond";
        }

        $sql .= " ORDER BY order_no, cat_id";
        $arrListCategory1 = $dbconn->GetAll($sql);
        $arr = array();
        if (is_array($arrListCategory1) && isset($arrListCategory1[0]['cat_id'])) {
            foreach ($arrListCategory1 as $k => $v) {
                $v['subcat'] = $this->getAllCatArr($v["cat_id"]);
                $arr[$k] = $v;
            }
            return $arr;
        } else {
            return 0;
        }
    }

    //Begin added 14/04/2014
    public function getCatTree($cat_id = 0, $cond = "")
    {
        global $dbconn;
        global $core, $lang_code;
        $sql = "SELECT cat_id, name, slug, lang_code, is_online, parent_id, order_no
						FROM " . $this->tbl . "
						WHERE lang_code='$lang_code' AND is_online=1 AND parent_id='$cat_id'";
        if ($cond != "") {
            $sql .= " AND $cond";
        }

        $sql .= " ORDER BY order_no, cat_id";
        $arrListCategory1 = $dbconn->GetAll($sql);
        $arr = array();
        if (is_array($arrListCategory1) && isset($arrListCategory1[0]['cat_id'])) {
            foreach ($arrListCategory1 as $k => $v) {
                $v['subcat'] = $this->getAllCatArr($v["cat_id"]);
                $arr[$k] = $v;
            }
            return $arr;
        } else {
            return 0;
        }
    }

    //End added 14/04/2014
    public function getCatPathAdmin($cat_id = 0, $tail = "", $delimiter = '&nbsp;&rarr;&nbsp;', $level = 0)
    { //
        $arrCur = $this->getOne($cat_id);
        $tail = ($tail != "") ? "&" . $tail : "";
        if (is_array($arrCur)) {
            $cur_name = ($level == 0) ? '<b>' . $arrCur['name'] . '</b>' : $arrCur['name'];
            $html = "<a href='?mod=category&cat_id=" . $arrCur['cat_id'] . $tail . "'>" . $delimiter . $cur_name . "</a>";
        }
        if ($arrCur['parent_id'] > 0) {
            $html = $this->getCatPathAdmin($arrCur['parent_id'], $tail, $delimiter, $level + 1) . $html;
        } else {
            $html = "<a href='?mod=category'>Root</a>" . $html;
        }
        return $html;
    }

    public function getSQLConditionCatId($cat_id = 0)
    {
        global $lang_code;
        $arr = $this->getAll("parent_id=$cat_id AND lang_code='$lang_code'");
        $cond = "";
        if (is_array($arr) && $arr[0]['cat_id'] > 0) {
            foreach ($arr as $key => $val) {
                $cond .= ($cond == "") ? "cat_id=" . $val['cat_id'] : " OR cat_id=" . $val['cat_id'];
            }
            $cond .= ($cond == "") ? "cat_id=$cat_id" : " OR cat_id=$cat_id";
        } else {
            $cond = "cat_id=" . $cat_id;
        }
        return $cond;
    }

    /**
     * Get Subcat of a Category $cat_id
     *
     * $getsub = 1 : get list news of subcat, 0 is else
     *
     * @param number $cat_id
     * @param number $getsub
     * @return array
     */
    public function getSubCatNews($cat_id = 0, $getsub = 1)
    {
        global $lang_code;
        $clsArticles = new Articles();
        $arrSubCat = $this->getAll("parent_id=$cat_id AND is_online=1 ORDER BY order_no ASC");
        if (is_array($arrSubCat)) {
            if ($getsub == 1) {
                foreach ($arrSubCat as $key => $val) {
                    $listnews = $clsArticles->getAllSimple2("cat_id=" . $val['cat_id'] . " AND lang_code='$lang_code' AND is_online=1 ORDER BY reg_date DESC");
                    $arrSubCat[$key]['listnews'] = $listnews;
                }
            }
        } else {
            $arrSubCat = array();
        }
        return $arrSubCat;
    }
    //INSERT
    //UPDATE
    //DELETE
    //OTHER
    public function getAllMenuLink($cat_id = 0, $mtype = 'horizon1', $is_megamenu = 0)
    {
        global $lang_code, $clsRewrite;
        $clsArticles = new Articles();
        $arrListCatNews1 = $this->getAll("is_online=1 AND parent_id='$cat_id' ORDER BY order_no, name");
        $arr = array();
        if (is_array($arrListCatNews1) && isset($arrListCatNews1[0]['cat_id'])) {
            foreach ($arrListCatNews1 as $k => $v) {
                $v1 = array();
                $v1['cat_id'] = $v['cat_id'];
                $v1['title'] = $v['name'];
                $v1['slug'] = $v['slug'];
                $v1['href'] = $clsRewrite->url_category($v);
                $v1['ttype'] = 'category';
                if ($is_megamenu == 2) {
                    $listnews = $clsArticles->getAllSimple2("cat_id=" . $v['cat_id'] . " AND lang_code='$lang_code' AND is_online=1");
                    $v1['listnews'] = $listnews;
                }
                $v1['children'] = $this->getAllMenuLink($v['cat_id'], $mtype, $is_megamenu);
                $arr[$k] = $v1;
            }
        }
        return $arr;
    }

    //export slug to array(cat_id => slug)
    public function exportArraySlug()
    {
        global $dbconn, $lang_code;
        $sql = "SELECT cat_id, name, slug FROM " . $this->tbl . " WHERE is_online=1";
        $arrListCategory1 = $dbconn->GetAll($sql);
        $arr = array();
        if (is_array($arrListCategory1)) {
            foreach ($arrListCategory1 as $k => $v) {
                $arr[$v['cat_id']] = $v['slug'];
            }
        }
        return $arr;
    }

    //fix Snake bug
    public function fixSnake()
    {
        $this->updateByCond("cat_id=parent_id", "parent_id=0");
    }

    //write to category.config.php
    public function writeConfig()
    {
        $arrListCate = $this->getAll();
        $fout = DIR_CACHE . "/category.config.php";
        $content = "<?\n";
        $content .= '$_CAT_SLUG = array(' . "\n";
        if (is_array($arrListCate)) {
            foreach ($arrListCate as $key => $val) {
                if ($val['slug'] != "") {
                    $content .= "\t\t'" . $val['slug'] . "' => " . $val['ctype'] . ",\n";
                }
            }

        }
        $content .= ");\n";
        $content .= "?>";
        file_put_contents($fout, $content);
    }

    public function export2array($cond = "")
    {
        $arr1 = $this->getAll($cond);
        $arr = array();
        foreach ($arr1 as $key => $val) {
            $arr[$val[$this->pkey]] = $val['name'];
        }
        return $arr;
    }
}

function makeListCategory($cat_id = 0, $selectedid = "", $level = 0, $maxlevel = 5, $cond = "")
{
    if ($level == $maxlevel) {
        return "";
    }

    global $dbconn, $lang_code;
    $sql = "SELECT cat_id, name FROM _category WHERE parent_id='$cat_id' AND lang_code='$lang_code'";
    if ($cond != "") {
        $sql .= " AND $cond";
    }

    $sql .= "  ORDER BY order_no ASC, slug ASC, cat_id DESC";
    $arrListCategory1 = $dbconn->GetAll($sql);
    $html = "";
    if (is_array($arrListCategory1)) {
        foreach ($arrListCategory1 as $k => $v) {
            $selected = ($v["cat_id"] == $selectedid) ? "selected" : "";
            $value = $v["cat_id"];
            $option = $v["name"];
            $html .= "<option value=\"$value\" $selected>" . str_repeat("&brvbar;--- ", $level) . $option . "</option>";
            $html .= makeListCategory($v["cat_id"], $selectedid, $level + 1, $maxlevel, $cond);
        }
        return $html;
    } else {
        return "";
    }
}

function makeArrayListCategory($cat_id = 0, $level = 0, $maxlevel = 5, &$ret, $cond = "")
{
    if ($level == $maxlevel) {
        return "";
    }

    global $dbconn, $lang_code;
    $sql = "SELECT cat_id, name, template FROM _category WHERE parent_id='$cat_id' AND lang_code='$lang_code'";
    if ($cond != "") {
        $sql .= " AND $cond";
    }

    $sql .= "  ORDER BY order_no ASC, slug ASC, cat_id DESC";
    $arrListCategory11 = $dbconn->GetAll($sql);
    $html = "";
    if (is_array($arrListCategory11)) {
        foreach ($arrListCategory11 as $k => $v) {
            $value = $v["cat_id"];
            $option = $v["name"];
            $ret["$value"] = str_repeat("&brvbar;--- ", $level) . $option;
            makeArrayListCategory($v["cat_id"], $level + 1, $maxlevel, $ret, $cond);
        }
        unset($arrListCategory11);
        return "";
    }
    unset($arrListCategory11);
    return "";
}

function makeArrayListCategory2($cat_id = 0, $level = 0, $maxlevel = 5, &$ret, $cond = "")
{
    if ($level == $maxlevel) {
        return "";
    }

    global $dbconn, $lang_code, $arrTemplateOption;
    $sql = "SELECT cat_id, name, template FROM _category WHERE parent_id='$cat_id' AND lang_code='$lang_code'";
    if ($cond != "") {
        $sql .= " AND $cond";
    }

    $sql .= "  ORDER BY order_no ASC, slug ASC, cat_id DESC";
    $arrListCategory11 = $dbconn->GetAll($sql);
    $html = "";
    if (is_array($arrListCategory11)) {
        foreach ($arrListCategory11 as $k => $v) {
            $value = $v["cat_id"];
            $option = $v["name"] . " (Loại: " . $arrTemplateOption[CTYPE_BV][$v['template']] . ")";
            $ret["$value"] = str_repeat("&brvbar;--- ", $level) . $option;
            makeArrayListCategory($v["cat_id"], $level + 1, $maxlevel, $ret, $cond);
        }
        unset($arrListCategory11);
        return "";
    }
    unset($arrListCategory11);
    return "";
}
