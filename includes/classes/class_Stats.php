<?

/******************************************************
 * Class Statstics
 *
 * Statstics Page Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_Stats.php
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
class Stats extends dbBasic
{
    function Stats()
    {
        $this->tbl = '_stats';
        $this->pkey = 'stats_id';
    }
    //SELECT

    /**
     * Get statstic
     *
     * @return Ambigous <number, unknown>
     */
    function getStats()
    {
        global $core;
        $clsUsers = new Users();
        $arr = $this->getOne(1);
        //$arr['total_members'] = $clsUsers->countItem("user_group_id=2 AND is_active=1");
        $arr['total_online'] = $core->_SESS->countItem();
        if ($arr['max_online_number'] < $arr['total_online']) {
            $this->updateOne($arr['stats_id'], "max_online_number='" . $arr['total_online'] . "', max_online_day='$max_online_day'");
        }
        return $arr;
    }
    //INSERT
    //UPDATE
    function incVisitor()
    {
        $this->updateOne(1, "total_visitor = total_visitor +1");
    }

    function updateMaxOnline($total_online = 0)
    {
        $arrOneStats = $this->getOne(1);
        $max_online_day = time();
        if ($arrOneStats['max_online_number'] < $total_online) {
            $this->updateOne($arrOneStats['stats_id'], "max_online_number='$total_online', max_online_day='$max_online_day'");
        }
    }
    //DELETE
}
?>