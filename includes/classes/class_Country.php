<?
class Country extends dbBasic{
	function Country(){
		$this->pkey = "country_id";
		$this->tbl = "_country";
	}	
	//SELECT	
	function getAllCountry(){
		return $this->getAll("is_online=1 ORDER BY order_no ASC, name");
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
function makeListCountry($selectedid="", $cond="", $field_value="country_id"){
	global $dbconn, $_LANG_ID;
	$sql = "SELECT * FROM _country WHERE is_online=1";
	if ($cond!="") $sql.= " AND $cond";
	$sql.= " ORDER BY order_no ASC, name_en ASC";
	$arrListCountry1 = $dbconn->GetAll($sql);
	$html = "";
	if (is_array($arrListCountry1)){
		foreach ($arrListCountry1 as $k => $v){
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
function makeArrayListCountry(&$ret, $cond=""){
	global $dbconn, $_LANG_ID;	
	$sql = "SELECT * FROM _country WHERE is_online=1";
	if ($cond!="") $sql.= " AND $cond";
	$sql.= " ORDER BY order_no, name_en ASC";
	$arrListCountry11 = $dbconn->GetAll($sql);
	$html = "";
	if (is_array($arrListCountry11)){
		foreach ($arrListCountry11 as $k => $v){			
			$value = $v["country_id"];
			$option = ($_LANG_ID!="vn")?  $v["name_".$_LANG_ID] : $v["name"];
			$ret["$value"] = $option;			
		}
		unset($arrListCountry11);
		return "";
	}
	unset($arrListCountry11);
	return "";	
}
?>