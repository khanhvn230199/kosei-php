<?
/******************************************************
 * Class ProductFilter
 *
 * ProductFilter Handling
 *
 * Project Name               :  HSgaminggear.com
 * Package Name                    :
 * Program ID                 :  class_ProductFilter.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  Banglcb
 * Version                    :  1.0
 * Creation Date              :  03/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name          Chng  Req   No    Remarks
 * 1.0           03/01/2018        Ducnh          -          -     -     -
 *
 ********************************************************/
class ProductFilter extends dbBasic
{
    public function ProductFilter()
    {
        $this->pkey = "id";
        $this->tbl = "_product_filter";
    }
    //SELECT
    public function getArrayProductId($cond = '1=1')
    {
        global $dbconn;
        $sql = "SELECT DISTINCT product_id FROM $this->tbl
				WHERE $cond";
        $arr = $dbconn->GetAll($sql);
        $arrProductId = array();
        if (is_array($arr)) {
            foreach ($arr as $k => $v) {
                $arrProductId[] = $v['product_id'];
            }
        }
        return $arrProductId;
    }
    //INSERT
    //UPDATE
    //DELETE

}
