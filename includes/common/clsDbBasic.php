<?
/******************************************************
 * Class DbBasic
 *
 * Daatabase Handling
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  clsDbBasic.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name          Chng  Req   No    Remarks
 * 1.0           20/01/2018        Tuanta          -          -     -     -
 *
 ********************************************************/
class DbBasic
{
    public $pkey = "";
    public $tbl = "";
    public $arrCond = array();
    public $arrOperator = array();
    public $arrError = array();
    public $hasError = 0;
    public $objName = "ObjTable";
    public function DbBasic()
    {
        //nothing
    }
    //Set debug mode On/Off
    public function SetDebug($debug = true)
    {
        global $dbconn;
        $dbconn->debug = $debug;
    }
    //set condition $cond + $operator(AND, OR)
    public function SetCond($cond, $operator = "")
    {
        array_push($this->arrCond, $cond);
        //if ($operator!=""){
        array_push($this->arrOperator, $operator);
        //}
    }
    //get contition string
    public function GetCond()
    {
        $condStr = "";
//        echo "<pre>";
        //        print_r($this->arrOperator);
        //        echo "</pre>";
        if (is_array($this->arrCond)) {
            foreach ($this->arrCond as $key => $val) {
                $condStr .= " $val " . $this->arrOperator[$key];
            }
        }
        return $condStr;
    }
    //empty condition
    public function EmptyCond()
    {
        $this->arrCond = array();
        $this->arrOperator = array();
    }
    //Select One
    public function SelectOne($_pkey = "")
    {
        global $dbconn;
        //get condition
        $cond = $this->getCond();
        if ($cond == "") {
            $pkey = $this->pkey;
            $pkeyvalue = $_pkey;
            $cond = ($pkeyvalue != "") ? "" . $pkey . "='" . $pkeyvalue . "'" : "";
        }
        if ($cond != "") {
            $where .= " WHERE $cond";
        }
        $sql = "SELECT * FROM " . $this->tbl . " $where";
        $rs = $dbconn->Execute($sql);
        $obj = new $this->objName;
        if ($rs) {
            $arr = $rs->FetchRow(); //get a row
            if (is_array($arr)) {
                foreach ($arr as $key => $val) {
                    $obj->set($key, $val);
                }
            }
        }
        return $obj;
    }
    //Select All
    public function SelectAll($orderby = "", $start = 0, $limit = 0)
    {
        global $dbconn;
        //get condition
        $cond = $this->getCond();
        $where = ($cond != "") ? " WHERE $cond" : "";
        $orderby = ($orderby != "") ? "ORDER BY $orderby" : "";
        $limit = ($limit != "") ? "LIMIT $start, $limit" : "";
        $sql = "SELECT * FROM " . $this->tbl . " $where $orderby $limit";
        $rs = $dbconn->Execute($sql);
        $arrObj = array();
        if ($rs) {
            while ($arr = $rs->FetchRow()) {
                $obj = new $this->objName;
                foreach ($arr as $key => $val) {
                    $obj->set($key, $val);
                }
                array_push($arrObj, $obj);
            }
        }
        return $arrObj;
    }
    //Insert obj
    public function Insert($objTable)
    {
        global $dbconn;
        $class_vars = get_class_vars(get_class($objTable));
        $fields = $values = "";
        //foreach ($class_vars as $name => $value) {
        foreach ($objTable->arrSet as $key => $name) {
            $fields .= ($fields == "") ? $name : "," . $name;
            $values .= ($values == "") ? "'" . $objTable->$name . "'" : ",'" . $objTable->$name . "'";
        }
        $sql = "INSERT INTO " . $this->tbl . "($fields) VALUES($values)";
        if (!$dbconn->Execute($sql)) {
            trigger_error("Cannot run SQL: `$sql`", E_USER_ERROR);
            return 0;
        }
        return 1;
    }
    //Update obj
    public function Update($objTable)
    {
        global $dbconn;
        $class_vars = get_class_vars(get_class($objTable));
        $set = "";
        //foreach ($class_vars as $name => $value)
        foreach ($objTable->arrSet as $key => $name) {
            $set .= ($set == "") ? "$name = '" . $objTable->$name . "'" : ", $name = '" . $objTable->$name . "'";
        }
        //get condition
        $cond = $this->GetCond();
        if ($cond == "") {
            $pkey = $this->pkey;
            $pkeyvalue = $this->$pkey;
            $cond = ($pkeyvalue != "") ? "" . $pkey . "='" . $pkeyvalue . "'" : "";
        }
        if ($cond != "") {
            $where .= " WHERE $cond";
        }
        $sql = "UPDATE " . $this->tbl . " SET $set $where";
        if (!$dbconn->Execute($sql)) {
            trigger_error("Cannot run SQL: `$sql`", E_USER_ERROR);
            return 0;
        }
        return 1;
    }
    //Delete obj
    public function Delete()
    {
        global $dbconn;
        //get condition
        $cond = $this->GetCond();
        if ($cond != "") {
            $where .= " WHERE $cond";
        }
        $sql = "DELETE FROM " . $this->tbl . " $where";
        if (!$dbconn->Execute($sql)) {
            trigger_error("Cannot run SQL: `$sql", E_USER_ERROR);
            return 0;
        }
        return 1;
    }
    //Count Item
    public function Count($cond = "")
    {
        global $dbconn;

        //get condition
        $cond = $this->GetCond();
        if ($cond != "") {
            $where .= " WHERE $cond";
        }
        $sql = "SELECT COUNT(*) AS total FROM " . $this->tbl . " $where";
        $res = $dbconn->GetRow($sql);
        if ($res['total'] == "" || $res['total'] == null) {
            return 0;
        }

        return $res['total'];
    }
    public function Max($field, $cond = "")
    {
        global $dbconn;

        //get condition
        $cond = $this->GetCond();
        if ($cond != "") {
            $where .= " WHERE $cond";
        }
        $sql = "SELECT MAX($field) AS total FROM " . $this->tbl . $where;
        $res = $dbconn->GetRow($sql);
        if ($res['total'] == "" || $res['total'] == null) {
            return 1;
        }

        return ($res['total'] + 1);
    }
    public function Min($field, $cond = "")
    {
        global $dbconn;
        //get condition
        $cond = $this->GetCond();
        if ($cond != "") {
            $where .= " WHERE $cond";
        }
        $sql = "SELECT MIN($field) AS total FROM " . $this->tbl . $where;
        $res = $dbconn->GetRow($sql);
        if ($res['total'] == "" || $res['total'] == null) {
            return 1;
        }

        return ($res['total'] + 1);
    }
    public function Sum($field, $cond = "")
    {
        global $dbconn;

        //get condition
        $cond = $this->GetCond();
        if ($cond != "") {
            $where .= " WHERE $cond";
        }
        $sql = "SELECT SUM($field) AS total FROM " . $this->tbl . $where;
        $res = $dbconn->GetRow($sql);
        if ($res['total'] == "" || $res['total'] == null) {
            return 0;
        }

        return $res['total'];
    }
    //Execute a sql
    public function ExecSql($sql)
    {
        global $dbconn;
        return $dbconn->Execute($sql);
    }
    //=======================================
    //Integrate with old version
    //=======================================
    public function getAll($cond = "")
    {
        global $dbconn;
        $where = "";
        if ($cond != "") {
            $where .= " WHERE $cond";
        }
        $sql = "SELECT * FROM " . $this->tbl . " $where";
        $res = $dbconn->GetAll($sql, false);
        if (is_array($res) && count($res) > 0) {
            return $res;
        } else {
            return 0;
        }
    }
    public function getOne($_pkey = "")
    {
        global $dbconn;
        $sql = "SELECT * FROM " . $this->tbl . " WHERE " . $this->pkey . "='$_pkey'";
        $res = $dbconn->GetRow($sql, false);
        if (is_array($res) && count($res) > 0) {
            return $res;
        } else {
            return 0;
        }
    }
    public function getByCond($cond = "")
    {
        global $dbconn;
        $where = "";
        if ($cond != "") {
            $where .= " WHERE $cond";
        }
        $sql = "SELECT * FROM " . $this->tbl . " $where";
        $res = $dbconn->GetRow($sql, false);
        if (is_array($res) && count($res) > 0) {
            return $res;
        } else {
            return 0;
        }
    }
    //Clone
    public function cloneOne($id = 0)
    {
        global $dbconn;
        $arr = $this->getOne($id);
        $fields = "";
        $values = "";
        if (is_array($arr)) {
            foreach ($arr as $k => $v) {
                if ($k != $this->pkey) {
                    $fields .= ($fields == "") ? "$k" : ", $k";
                    $values .= ($values == "") ? "'$v'" : ", '$v'";
                }
            }
        }

        $sql = "INSERT INTO " . $this->tbl . "($fields) VALUES($values)";
        $dbconn->Execute($sql);
        return 1;
    }
    //Insert
    public function insertOne($fields = "", $values = "")
    {
        global $dbconn;
        if (is_array($fields) && count($fields) != count($values)) {
            return 0;
        }

        $sql = "INSERT INTO " . $this->tbl . "($fields) VALUES($values)";
        if (!$dbconn->Execute($sql)) {
            return 0;
        }

        return 1;
    }
    //Update
    public function updateOne($_pkey = "", $set = "")
    {
        global $dbconn;
        if ($set == "") {
            return;
        }

        $sql = "UPDATE " . $this->tbl . " SET $set WHERE " . $this->pkey . "='$_pkey'";
        $dbconn->Execute($sql);
        return 1;
    }
    //Update by condition
    public function updateByCond($cond = "", $set = "")
    {
        global $dbconn;
        $where = "";
        if ($cond != "") {
            $where .= " WHERE $cond";
        }
        $sql = "UPDATE " . $this->tbl . " SET $set $where";
        $dbconn->Execute($sql);
        return 1;
    }
    //Delete
    public function deleteOne($_pkey = "")
    {
        global $dbconn;
        $sql = "DELETE FROM " . $this->tbl . " WHERE " . $this->pkey . "='$_pkey'";
        $dbconn->Execute($sql);
        return 1;
    }
    public function deleteByCond($cond = "")
    {
        global $dbconn;
        $where = "";
        if ($cond != "") {
            $where .= " WHERE $cond";
        }
        $sql = "DELETE FROM " . $this->tbl . " $where";
        $dbconn->Execute($sql);
        return 1;
    }
    public function countItem($cond = "")
    {
        global $dbconn;
        $sql = "SELECT COUNT(*) AS totalitem FROM " . $this->tbl;
        if ($cond != "") {
            $sql .= "  WHERE $cond";
        }
        $res = $dbconn->GetRow($sql, false);
        if ($res['totalitem'] == "" || $res['totalitem'] == null) {
            return 0;
        }

        return $res['totalitem'];
    }
    public function maxItem($field, $cond = "")
    {
        global $dbconn;
        $sql = "SELECT MAX($field) AS total FROM " . $this->tbl;
        if ($cond != "") {
            $sql .= " WHERE $cond";
        }

        $res = $dbconn->GetRow($sql, false);
        if ($res['total'] == "" || $res['total'] == null) {
            return 1;
        }

        return ($res['total'] + 1);
    }
    public function sumItem($field, $cond = "")
    {
        global $dbconn;
        $sql = "SELECT SUM($field) AS total FROM " . $this->tbl;
        if ($cond != "") {
            $sql .= " WHERE $cond";
        }

        $res = $dbconn->GetRow($sql, false);
        if ($res['total'] == "" || $res['total'] == null) {
            return 0;
        }

        return $res['total'];
    }
    public function getByField($_pkey, $field)
    {
        global $dbconn;
        $sql = "SELECT $field FROM " . $this->tbl . " WHERE " . $this->pkey . "='$_pkey'";
        $res = $dbconn->GetRow($sql, false);
        if (count($res) > 0) {
            return $res[$field];
        } else {
            return 0;
        }
    }
    public function getByFieldByCond($cond, $field)
    {
        global $dbconn;
        $sql = "SELECT $field FROM " . $this->tbl . " WHERE $cond";

        $res = $dbconn->GetRow($sql, false);
        if (count($res) > 0) {
            return $res[$field];
        } else {
            return 0;
        }
    }
    public function makeSelectHtml($selectName = "", $fieldvalue = "", $fieldoption = "", $cond = "", $selectedvalue = "", $tag = true)
    {
        $arrSelect = $this->getAll($cond);
        $html = "";
        if ($selectName == "") {
            $selectName = $fieldvalue;
        }

        if ($tag == true) {
            $html .= "<select name=\"$selectName\"  id=\"$selectName\">";
        }
        if (is_array($arrSelect)) {
            foreach ($arrSelect as $k => $v) {
                if (is_array($selectedvalue)) {
                    $selected = (in_array($v[$fieldvalue], $selectedvalue)) ? "selected" : "";
                } else {
                    $selected = ($v[$fieldvalue] == $selectedvalue) ? "selected" : "";
                }
                $value = $v[$fieldvalue];
                $option = $v[$fieldoption];
                $html .= "<option value=\"$value\" $selected>" . $option . "</option>";
            }
        }
        if ($tag == true) {
            $html .= "</select>";
        }
        return $html;
    }

    // HA
    public function getByIdOrSLug($exit = 0)
    {
        $id = GET($this->pkey);

        if ($id) {
            $obj = $this->getOne($id);
        }

        if (!is_array($obj)) {
            $obj = $this->getBySlug(GET('slug'));
        }

        if (!is_array($obj) && $exit) {
            showErrorFatalBox("notfound");
            exit();
        }

        return $obj;
    }
}

/**
 *  Table Handling
 *  @author        : Tran Anh Tuan
 *  @date        : 25/11/2006
 *  @version        : 1.0.0
 */
class ObjTable
{
    public $arrSet = array();
    //init class
    public function ObjTable()
    {
        //nothing
    }
    //set value to field
    public function set($field, $value)
    {
        $this->$field = $value;
        array_push($this->arrSet, $field);
    }
    //get value from a field
    public function get($field)
    {
        return $this->$field;
    }
}
