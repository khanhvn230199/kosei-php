<?
/******************************************************
 * Class DataSource
 *
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  clsDataSource.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name          Chng  Req   No    Remarks
 * 1.0           20/01/2018        banglcb          -          -     -     -
 *
 ********************************************************/
class DataSource
{
    public $table = "";
    public $cond = "";
    public $query = "";
    public $queryc = "";
    public $fields = array();
    public function DataSource()
    {
        //nothing
    }
    //function
    public function setDbTable($_table, $_cond = "")
    {
        $this->table = $_table;
        $this->cond = $_cond;
    }
    //function
    public function setDbQuery($_query, $_queryc)
    {
        $this->query = $_query;
        $this->queryc = $_queryc;
    }
    //function
    public function addField($field)
    {
        array_push($this->fields, $field);
    }
    //function
    public function addFieldString($fieldStr = "")
    {
        if (strpos($fieldStr, ",") !== false) {
            $arr = explode(',', $fieldStr);
            if (is_array($arr)) {
                foreach ($arr as $key => $val) {
                    array_push($this->fields, trim($val));
                }
            }

        }
    }
    //function
    public function getFieldStr()
    {
        if (is_array($this->fields)) {
            $str = "";
            foreach ($this->fields as $v) {
                $str .= ($str == "") ? "$v" : ", $v";
            }
        }
        return $str;
    }
    //function
    public function getTotalRows()
    {
        global $dbconn, $_EX_TABLE;
        if ($this->table != "") {
            $where = ($this->cond != "") ? " WHERE $this->cond" : "";
            $sql = "SELECT count(*) as totalRows FROM $this->table $where";
            $res = $dbconn->GetRow($sql);
            if ($res['totalRows'] == "" && $res['totalRows'] == null) {
                return 0;
            }

            return $res['totalRows'];
        } else
        if ($this->query != "") {
            $res = $dbconn->GetRow($this->queryc);

            if ($res['totalRows'] != "" && $res['totalRows'] != null) {
                return $res['totalRows'];
            }

            if ($res[0] != "" && $res[0] != null) {
                return $res[0];
            }

            return 0;
        }
    }
    //function
    public function getDataGrid($orderby = "", $start = "", $limit = "")
    {
        global $dbconn, $_EX_TABLE;
        if ($this->table != "") {
            $fieldStr = $this->getFieldStr();
            $where = ($this->cond != "") ? " WHERE $this->cond" : "";
            $orderby = ($orderby != "") ? "ORDER BY $orderby" : "";
            $limit = ($limit != "") ? "LIMIT $start, $limit" : "";
            $sql = "SELECT $fieldStr FROM $this->table $where $orderby $limit";
            $rs = $dbconn->Execute($sql);
            $arrObj = array();
            if ($rs) {
                while ($obj = $rs->FetchNextObject(false)) {
                    $obj1 = new ADOFetchObj;
                    foreach ($obj as $key => $val) {
                        $obj1->$key = $val;
                    }
                    array_push($arrObj, $obj1);
                }
            }
            //print_r($arrObj);
            return $arrObj;
        } else
        if ($this->query != "") {
            $orderby = ($orderby != "") ? "ORDER BY $orderby" : "";
            $limit = ($limit != "") ? "LIMIT $start, $limit" : "";
            $rs = $dbconn->Execute($this->query . " $orderby $limit");
            $arrObj = array();
            if ($rs) {
                while ($obj = $rs->FetchNextObject(false)) {
                    $obj1 = new ADOFetchObj;
                    foreach ($obj as $key => $val) {
                        $obj1->$key = $val;
                    }
                    array_push($arrObj, $obj1);
                }
            }
            return $arrObj;
        }
        return 0;
    }
}
