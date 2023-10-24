<?

/******************************************************
 * Class History
 *
 * Static History Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_history.php
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
class History extends dbBasic
{
    function History()
    {
        $this->pkey = "history_id";
        $this->tbl = "_history";
    }
    //SELECT

    //SELECT

    /**
     * Get list History by ID or array ID
     *
     * @param number $id
     */
    function getListHistoryById($id = 0)
    {
        $cond = "";
        if (is_numeric($id)) {
            $cond = "history_id=$id";
        } else
            if (is_array($id)) {
                $s = implode(',', $id);
                $cond = "history_id IN ($s)";
            } else
                if (strpos(',', $id) !== false) {
                    $cond = "history_id IN ($id)";
                }
        $cond .= " ORDER BY order_no";
        return $this->getAll($cond);
    }
    //INSERT
    //UPDATE
    //DELETE
    //OTHER
}

?>