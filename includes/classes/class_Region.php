<?
class Region extends dbBasic{
	function Region(){
		$this->pkey = "region_id";
		$this->tbl = "_region";
	}	
	//SELECT
	function getSlug($pkey_id=0){
		$arr = $this->getOne($pkey_id, 0);
		return (is_array($arr) && $arr[$this->pkey]>0)? $arr['slug'] : '';
	}
	function getFromSlug($slug=""){
		$arr = $this->getByCond("slug='$slug'", 0);
		return (is_array($arr) && $arr[$this->pkey]>0)? $arr : '';
	}
	function getName($region_id){
		$arrOne = $this->getOne($region_id);
		return $arrOne['name'];
	}
	function getAllRegion(){
		return $this->getAll("is_online=1 ORDER BY order_no ASC, region_id");
	}
	//INSERT
	//UPDATE
	//DELETE
	//EXPORT	
}
function makeListRegion($selectedid="", $cond="", $field_value="region_id"){
	global $dbconn, $_LANG_ID;
	$sql = "SELECT *FROM _region WHERE is_online=1";
	if ($cond!="") $sql.= " AND $cond";
	$sql.= " ORDER BY order_no, slug, region_id";
	$arrListRegion1 = $dbconn->GetAll($sql, false, 0);
	$html = "";
	if (is_array($arrListRegion1)){
		foreach ($arrListRegion1 as $k => $v){
			$selected = ($v[$field_value]==$selectedid)? "selected" : "";
			$value = $v[$field_value];
			$option = ($_LANG_ID!="vn")?  $v["name_".$_LANG_ID] : $v["name"];
			$html.= "<option value=\"$value\" $selected>".$option."</option>";			
		}
		return $html;
	}else{
		return "";
	}
}
function makeArrayListRegion(&$ret, $cond=""){
	global $dbconn, $_LANG_ID;
	$sql = "SELECT * FROM _region WHERE is_online=1";
	if ($cond!="") $sql.= " AND $cond";
	$sql.= " ORDER BY order_no, slug, region_id";
	$arrListRegion11 = $dbconn->GetAll($sql, false, 0);
	$html = "";
	if (is_array($arrListRegion11)){
		foreach ($arrListRegion11 as $k => $v){			
			$value = $v["region_id"];
			$option = ($_LANG_ID!="vn")?  $v["name_".$_LANG_ID] : $v["name"];
			$ret["$value"] = $option;			
		}
		unset($arrListRegion11);
		return "";
	}
	unset($arrListRegion11);
	return "";	
}

?>