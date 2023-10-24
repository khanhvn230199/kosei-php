<?
class District extends dbBasic{
	function District(){
		$this->pkey = "district_id";
		$this->tbl = "_district";
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
	function getSlugPre($pkey_id=0, &$pre){
		$arr = $this->getOne($pkey_id, 0);
		$ret = $pre = "";
		if (is_array($arr) && $arr[$this->pkey]>0){
			$pre = $arr['pre'];
			$ret = $arr['slug'];
		}
		return $ret;
	}
	function getName($district_id, $lang_code="vn"){
		$arrOne = $this->getOne($district_id);
		if (is_array($arrOne) && $arrOne[$this->pkey]>0){
			$name = ($lang_code!="vn")? "name_".$lang_code : "name";
			return $arrOne[$name];
		}
		return "";
	}
	//INSERT
	//UPDATE
	//DELETE
	//EXPORT
	function export2array($lang_code="vn"){
		global $_LANG_ID;
		if ($lang_code=="" && isset($_LANG_ID) && $_LANG_ID!="") $lang_code = $_LANG_ID;
		$arr1 = $this->getAll();
		$arr = array();
		$name = ($lang_code!="vn")? "name_".$lang_code : "name";
		foreach ($arr1 as $key => $val){
			$arr[$val[$this->pkey]]= $val[$name];
		}
		return $arr;
	}
}
function makeListDistrict($selectedid="", $cond="", $field_value="district_id"){
	global $dbconn, $_LANG_ID;
	$sql = "SELECT * FROM _district ";
	if ($cond!="") $sql.= " WHERE $cond";
	$sql.= " ORDER BY order_no, slug, district_id";
	$arrListDistrict1 = $dbconn->GetAll($sql, false, 0);
	$html = "";
	if (is_array($arrListDistrict1)){
		foreach ($arrListDistrict1 as $k => $v){
			$selected = ($v[$field_value]==$selectedid)? "selected" : "";
			$value = $v[$field_value];
			$option = ($_LANG_ID!="vn")?  $v["name_".$_LANG_ID] : $v["name"];
			$internal = $v['internal'];
			$html.= "<option value=\"$value\" $selected data-internal='$internal' data-province='".$v['province_id']."'>".$option."</option>";			
		}
		return $html;
	}else{
		return "";
	}
}
function makeArrayListDistrict(&$ret, $cond=""){
	global $dbconn, $_LANG_ID;
	$sql = "SELECT * FROM _district ";
	if ($cond!="") $sql.= " WHERE $cond";
	$sql.= " ORDER BY order_no, slug, district_id";
	$arrListDistrict11 = $dbconn->GetAll($sql, false, 0);
	$html = "";
	if (is_array($arrListDistrict11)){
		foreach ($arrListDistrict11 as $k => $v){			
			$value = $v["district_id"];
			$option = ($_LANG_ID!="vn")?  $v["name_".$_LANG_ID] : $v["name"];
			$ret["$value"] = $option;			
		}
		unset($arrListDistrict11);
		return "";
	}
	unset($arrListDistrict11);
	return "";	
}

?>