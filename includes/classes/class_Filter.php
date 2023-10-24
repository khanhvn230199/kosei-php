<?

/******************************************************
 * Class Filter
 *
 * Filter Handling
 *
 * Project Name               :  HSgaminggear.com
 * Package Name                    :
 * Program ID                 :  class_Filter.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  Banglcb
 * Version                    :  1.0
 * Creation Date              :  03/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        03/01/2018        Ducnh          -        -     -     -
 *
 ********************************************************/
class Filter extends DbBasic
{
    var $parents = array();

    function Filter()
    {
        $this->pkey = "filter_id";
        $this->tbl = "_filter";
    }

    //SELECT
    function getBySlug($slug = "")
    {
        global $lang_code;
        return $this->getByCond("slug='$slug' AND lang_code='$lang_code'");
    }

    function getSlug($pkey_id = 0)
    {
        $arr = $this->getOne($pkey_id, 0);
        return (is_array($arr) && $arr[$this->pkey] > 0) ? $arr['slug'] : '';
    }

    function getName($pkey_id = 0)
    {
        global $dbconn;
        if ($pkey_id == "" || $pkey_id == 0) return "";
        $sql = "SELECT name FROM " . $this->tbl . " WHERE " . $this->pkey . "=$pkey_id";
        $aCategory = $dbconn->GetRow($sql, false, 0);
        return $aCategory["name"];
    }

    function getIdFilterByCatId($cat_id)
    {
        $arrOneFilter = $this->getByCond("cat_id = $cat_id AND parent_id=0");
        if (is_array($arrOneFilter)) {
            return $arrOneFilter['filter_id'];
        } else {
            return 0;
        }
    }

    function get_parent_id($filter_id = 0)
    {
        if ($this->parents[$filter_id] > 0) return $this->parents[$filter_id];
        $arr = $this->getOne($filter_id, 0);
        return $arr['parent_id'];
    }

    function getCatName($filter_id)
    {
        global $dbconn;
        if ($filter_id == "" || $filter_id == 0) return "Danh mục";
        $aCatNews = $dbconn->GetRow("SELECT name FROM " . $this->tbl . " WHERE filter_id = '$filter_id'");
        return $aCatNews["name"];
    }

    function getList($ctype = 0, $parent_id = -1)
    {
        $cond = "ctype=$ctype AND is_online=1";
        if ($parent_id >= 0) $cond .= " AND parent_id=$parent_id ORDER BY order_no";
        return $this->getAll($cond);
    }

    function isExistsSlug($slug = "", $old_slug = "")
    {
        global $dbconn, $lang_code;
        $sql = "SELECT COUNT(filter_id) AS total_item 
						FROM " . $this->tbl . " 
						WHERE lang_code='$lang_code' AND slug!='$old_slug' AND (slug='$slug' OR slug REGEXP '^" . $slug . "[0-9]+$')";
        $aCategory = $dbconn->GetRow($sql);
        return (is_array($aCategory) && $aCategory['total_item'] > 0) ? $aCategory['total_item'] : 0;
    }

    function isParentChild($old_filter_id = 0, $old_parent_id = 0, $new_parent_id = 0)
    {
        if ($old_filter_id == $new_parent_id) return 1;
        if ($old_parent_id == $new_parent_id) return 0;
        if (!isset($this->parents[$old_filter_id])) {
            $this->getParentArray();
        }
        $ok = 0;
        $i = $new_parent_id;
        while ($this->parents[$i] != 0 && $ok == 0) {
            $ok = ($this->parents[$i] == $old_filter_id);
            $i = $this->parents[$i];
        }
        return $ok;
    }

    function getAllParentCatArr($filter_id = 0)
    {
        global $dbconn;
        $html = "";
        $list = array();
        $i = $filter_id;
        while ($this->parents[$i] > 0) {
            $arrCat = $this->getOneLink($this->parents[$i]);
            $list[] = $arrCat;
            $i = $this->parents[$i];
        }
        return array_reverse($list);
    }

    function getOneLink($filter_id)
    {
        $arrCat = $this->getOne($filter_id);
        $v = array();
        $v['title'] = $arrCat['name'];
        $v['href'] = url_category($arrCat);
        return $v;
    }

    function getParentArray()
    {
        global $dbconn, $lang_code;
        $sql = "SELECT filter_id, name, parent_id 
						FROM " . $this->tbl . " 
						WHERE is_online=1 AND lang_code='$lang_code' ORDER BY order_no, filter_id";
        $arrListFilter = $dbconn->GetAll($sql);
        $this->parents = array();
        if (is_array($arrListFilter)) {
            foreach ($arrListFilter as $k => $v) {
                $this->parents[$v['filter_id']] = $v['parent_id'];
            }
        }
        return $this->parents;
    }

    function getAllCatStr($filter_id = 0)
    {
        global $dbconn;
        $html = "";
        $ok = 0;
        foreach ($this->parents as $k => $v)
            if ($v == $filter_id) {
                $html .= $k . ",";
                $html .= $this->getAllCatStr($k);
            }
        return $html;
    }

    function getAllCatArr($filter_id = 0, $cond = "")
    {
        global $dbconn;
        global $core, $lang_code;
        $sql = "SELECT * 
						FROM " . $this->tbl . " 
						WHERE lang_code='$lang_code' AND is_online=1 AND parent_id='$filter_id'";
        if ($cond != "") $sql .= " AND $cond";
        $sql .= " ORDER BY order_no, filter_id";
        $arrListFilter = $dbconn->GetAll($sql);
        $arr = array();
        if (is_array($arrListFilter) && isset($arrListFilter[0]['filter_id'])) {
            foreach ($arrListFilter as $k => $v) {
                $v['subcat'] = $this->getAllCatArr($v["filter_id"]);
                $arr[$k] = $v;
            }
            return $arr;
        } else {
            return 0;
        }
    }

    //Begin added 14/04/2014
    function getCatTree($filter_id = 0, $cond = "")
    {
        global $dbconn;
        global $core, $lang_code;
        $sql = "SELECT * FROM $this->tbl WHERE lang_code='$lang_code' AND is_online=1 AND parent_id='$filter_id'";
        if ($cond != "") $sql .= " AND $cond";
        $sql .= " ORDER BY order_no, filter_id";
        $arrListFilter = $dbconn->GetAll($sql);
        $arr = array();
        if (is_array($arrListFilter) && isset($arrListFilter[0]['filter_id'])) {
            foreach ($arrListFilter as $k => $v) {
                $v['subcat'] = $this->getAllCatArr($v["filter_id"]);
                $arr[$k] = $v;
            }
            return $arr;
        } else {
            return 0;
        }
    }

    //End added 14/04/2014
    function getCatPathAdmin($filter_id = 0, $tail = "", $delimiter = '&nbsp;&rarr;&nbsp;', $level = 0)
    {        //
        $arrCur = $this->getOne($filter_id);
        $tail = ($tail != "") ? "&" . $tail : "";
        if (is_array($arrCur)) {
            $cur_name = ($level == 0) ? '<b>' . $arrCur['name'] . '</b>' : $arrCur['name'];
            $html = "<a href='?mod=filter&filter_id=" . $arrCur['filter_id'] . $tail . "'>" . $delimiter . $cur_name . "</a>";
        }
        if ($arrCur['parent_id'] > 0) {
            $html = $this->getCatPathAdmin($arrCur['parent_id'], $tail, $delimiter, $level + 1) . $html;
        } else {
            $html = "<a href='?mod=filter'>Root</a>" . $html;
        }
        return $html;
    }

    function getSQLConditionCatId($filter_id = 0)
    {
        global $lang_code;
        $arr = $this->getAll("parent_id=$filter_id AND lang_code='$lang_code'");
        $cond = "";
        if (is_array($arr) && $arr[0]['filter_id'] > 0) {
            foreach ($arr as $key => $val) {
                $cond .= ($cond == "") ? "filter_id=" . $val['filter_id'] : " OR filter_id=" . $val['filter_id'];
            }
            $cond .= ($cond == "") ? "filter_id=$filter_id" : " OR filter_id=$filter_id";
        } else {
            $cond = "filter_id=" . $filter_id;
        }
        return $cond;
    }

    function getSubCatNews($filter_id = 0)
    {
        global $lang_code;
        $clsNews = new News();
        $arrSubCat = $this->getAll("parent_id=$filter_id");
        if (is_array($arrSubCat))
            foreach ($arrSubCat as $key => $val) {
                $listnews = $clsNews->getAllSimple2("filter_id=" . $val['filter_id'] . " AND lang_code='$lang_code' AND is_online=1");
                $arrSubCat[$key]['listnews'] = $listnews;
            }
        return $arrSubCat;
    }

    function checkHasSubcat($filter_id = 0)
    {//Kiểm tra xem cat_id hiện tại có nhóm con hay không?
        global $lang_code;
        $arrSubCat = $this->getAll("parent_id=$filter_id");
        if (is_array($arrSubCat)) {
            return 1;
        } else {
            return 0;
        }
    }
    //INSERT
    //UPDATE
    //DELETE
    //OTHER
    function getAllMenuLink($filter_id = 0)
    {
        global $lang_code;
        $arrListFilter11 = $this->getAll("is_online=1 AND parent_id='$filter_id' AND lang_code='$lang_code' ORDER BY order_no, name");
        $arr = array();
        if (is_array($arrListFilter11) && isset($arrListFilter11[0]['filter_id'])) {
            foreach ($arrListFilter11 as $k => $v) {
                $v1 = array();
                $v1['filter_id'] = $v['filter_id'];
                $v1['title'] = $v['name'];
                $v1['trademark_id'] = $v['trademark_id'];
                $v1['value'] = $v['value'];
                $v1['slug'] = $v['slug'];
//                $v1['image'] = $v['image'];
//                $v1['href'] = url_category($v);
                $v1['trademark'] = $v['is_trademark'];;
                $v1['subfiler'] = $this->getAllMenuLink($v['filter_id']);
                $arr[$k] = $v1;
            }
        }
        return $arr;
    }

    function getAllMenuLink2($filter_id = 0, $ctype = 0)
    {
        global $lang_code;
        $clsProduct = new Product();
        $arrListCatProduct1 = $this->getAll("is_online=1 AND ctype ='$ctype' AND parent_id='$filter_id' ORDER BY order_no, name");
        $arr = array();
        if (is_array($arrListCatProduct1) && isset($arrListCatProduct1[0]['filter_id'])) {
            foreach ($arrListCatProduct1 as $k => $v) {
                $v1 = array();
                $v1['filter_id'] = $v['filter_id'];
                $v1['title'] = $v['name'];
                $v1['image'] = $v['image'];
                $v1['href'] = url_category($v);
                $v1['total_item'] = $clsProduct->getTotalProductForCat($v[filter_id]);
                $v1['subcat'] = $this->getAllMenuLink2($v['filter_id'], $ctype);
                $arr[$k] = $v1;
            }
        }
        return $arr;
    }

    //export slug to array(filter_id => slug)
    function exportArraySlug()
    {
        global $dbconn, $lang_code;
        $sql = "SELECT filter_id, name, slug FROM " . $this->tbl . " WHERE is_online=1";
        $arrListFilter = $dbconn->GetAll($sql);
        $arr = array();
        if (is_array($arrListFilter)) {
            foreach ($arrListFilter as $k => $v) {
                $arr[$v['filter_id']] = $v['slug'];
            }
        }
        return $arr;
    }

    //fix Snake bug
    function fixSnake()
    {
        $this->updateByCond("filter_id=parent_id", "parent_id=0");
    }

    function export2array($cond = "")
    {
        $arr1 = $this->getAll($cond);
        $arr = array();
        foreach ($arr1 as $key => $val) {
            $arr[$val[$this->pkey]] = $val['name'];
        }
        return $arr;
    }
}

function makeListFilter($filter_id = 0, $selectedid = "", $level = 0, $maxlevel = 5, $cond = "")
{
    if ($level == $maxlevel) return "";
    global $dbconn, $lang_code;
    $sql = "SELECT filter_id, name FROM _filter WHERE parent_id='$filter_id' AND lang_code='$lang_code'";
    if ($cond != "") $sql .= " AND $cond";
    $arrListFilter = $dbconn->GetAll($sql);
    $html = "";
    if (is_array($arrListFilter)) {
        foreach ($arrListFilter as $k => $v) {
            $selected = ($v["filter_id"] == $selectedid) ? "selected" : "";
            $value = $v["filter_id"];
            $option = $v["name"];
            $html .= "<option value=\"$value\" $selected>" . str_repeat("&brvbar;--- ", $level) . $option . "</option>";
            $html .= makeListFilter($v["filter_id"], $selectedid, $level + 1, $maxlevel, $cond);
        }
        return $html;
    } else {
        return "";
    }
}

function makeArrayListFilter($filter_id = 0, $level = 0, $maxlevel = 5, &$ret, $cond = "")
{
    if ($level == $maxlevel) return "";
    global $dbconn, $lang_code;
    $sql = "SELECT filter_id, name FROM _filter WHERE parent_id='$filter_id' AND lang_code='$lang_code'";
    if ($cond != "") $sql .= " AND $cond";
    $arrListFilter = $dbconn->GetAll($sql);
    $html = "";
    if (is_array($arrListFilter)) {
        foreach ($arrListFilter as $k => $v) {
            $value = $v["filter_id"];
            $option = $v["name"];
            $ret["$value"] = str_repeat("&brvbar;--- ", $level) . $option;
            makeArrayListFilter($v["filter_id"], $level + 1, $maxlevel, $ret, $cond);
        }
        unset($arrListFilter);
        return "";
    }
    unset($arrListFilter);
    return "";
}

?>