<?
class Adver extends dbBasic{
	function Adver(){
		$this->pkey = "adver_id";
		$this->tbl = "_adver";
	}
	function getByPosition($position="R1", $mod_sub_act="", $cond1=""){
		$cond = "is_online='1' AND position='$position'";
		if ($mod_sub_act!=""){
			$cond.= " AND (mod_sub_act='$mod_sub_act' OR mod_sub_act='All')";
		}
		if( $cond1!="" ) $cond.= " AND ".$cond1;
		$now = time();
		$cond.= " AND ( start_date<=$now AND end_date>=$now )";
		$cond.= " ORDER BY order_no";
		$arr = $this->getAll($cond);
		return $arr;
	}

    function getByPositionNonTime($position="R1", $mod_sub_act="", $cond1=""){
        global $lang_code;
        $cond = "is_online='1' AND position='$position' AND lang_code = '$lang_code'";
        if ($mod_sub_act!=""){
            $cond.= " AND (mod_sub_act='$mod_sub_act' OR mod_sub_act='All')";
        }
        if( $cond1!="" ) $cond.= " AND ".$cond1;
        $cond.= " ORDER BY order_no";
        $arr = $this->getAll($cond);
        return $arr;
    }
}
?>