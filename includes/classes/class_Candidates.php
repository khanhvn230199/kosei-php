<?

/******************************************************
 * Class Level
 *
 * Static Level Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_Candidates.php
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
class Candidates extends dbBasic
{
    function Candidates()
    {
        $this->pkey = "id";
        $this->tbl = "_candidates";
    }

    function getAllSimple($cond = "")
    {
        global $dbconn;
        $sql = "SELECT a.*,b.user_name,b.email 
                FROM $this->tbl as a 
                INNER JOIN _users as b ON a.user_id = b.user_id ";
        if ($cond != "") {
            $sql .= "WHERE $cond ";
        }
        $sql .= "GROUP BY a.user_id";
        return $dbconn->GetAll($sql);
    }
}

?>