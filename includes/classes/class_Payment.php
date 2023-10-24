<?

/******************************************************
 * Class Level
 *
 * Static Level Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_Payment.php
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
class Payment extends dbBasic
{
    function Payment()
    {
        $this->pkey = "payment_id";
        $this->tbl = "_payment";
    }

    //SELECT
    //INSERT
    //UPDATE
    //DELETE
    //OTHER
}

function makeArrayListPayment(&$ret)
{
    global $dbconn, $lang_code;
    $sql = "SELECT * FROM _payment WHERE is_online=1 AND lang_code = '$lang_code'";
    $sql .= " ORDER BY payment_id";
    $arrListPayment = $dbconn->GetAll($sql);
    if (is_array($arrListPayment)) {
        foreach ($arrListPayment as $k => $v) {
            $value = $v["payment_id"];
            $option = $v["name"];
            $ret["$value"] = $option;
        }
        unset($arrListPayment);
        return "";
    }
    unset($arrListPayment);
    return "";
}

?>