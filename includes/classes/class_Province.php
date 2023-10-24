<?
/******************************************************
 * Class Province
 *
 * Province Page Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:
 * Program ID                 :  class_Province.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  Banglcb
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	2014/02/10    	Banglcb          -  		-     -     -
 *
 ********************************************************/
class Province extends dbBasic{
	function Province(){
		$this->pkey = "province_id";
		$this->tbl = "_province";
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
	function getName($province_id, $lang_code="vn"){
		$arrOne = $this->getOne($province_id);
		if (is_array($arrOne) && $arrOne[$this->pkey]>0){
			$name = ($lang_code!="vn")? "name_".$lang_code : "name";
			return $arrOne[$name];
		}
		return "";
	}
	function getAllProvince(){
		return $this->getAll("is_online=1 ORDER BY order_no ASC, province_id");
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
	function export2jarray($has_district=1, $has_subdist=1, $has_street=1, $has_duan=1){
		global $dbconn;
		$clsDistrict = new District();
		$clsSubDist = new SubDist();
		$clsStreet = new Street();
		$clsDuan = new Duan();
		$arrProvince = $dbconn->GetAll("SELECT province_id, name, slug FROM ".$this->tbl." WHERE is_online=1 ORDER BY slug", false, 0);
		foreach ($arrProvince as $key => $val){
			$province_id = $val['province_id'];
			$arrDistrict = $dbconn->GetAll("SELECT district_id, pre, name FROM district WHERE province_id=$province_id ORDER BY order_no, slug");
			if (is_array($arrDistrict))
			foreach ($arrDistrict as $k => $v){
				$district_id = $v['district_id'];
				if ($has_subdist==1){
					$arrSubDist = $dbconn->GetAll("SELECT subdist_id, name FROM subdist WHERE district_id=$district_id ORDER BY order_no, slug");
					$arrDistrict[$k]['subdist'] = $arrSubDist;
				}
				if ($has_street==1){
					$arrStreet = $dbconn->GetAll("SELECT street_id, name FROM street WHERE district_id=$district_id ORDER BY slug");
					$arrDistrict[$k]['street'] = $arrStreet;
				}
				if ($has_duan==1){
					$arrDuan = $dbconn->GetAll("SELECT duan_id, name FROM duan WHERE district_id=$district_id ORDER BY slug");
					$arrDistrict[$k]['project'] = $arrDuan;
				}
			}
			if ($has_district==1)
				$arrProvince[$key]['district'] = $arrDistrict;
		}
		return $arrProvince;
		unset($clsDistrict, $clsSubDist, $clsStreet, $clsDuan);
	}
}
function makeListProvince($selectedid="", $cond="", $field_value="province_id"){
	global $dbconn, $_LANG_ID;
	$sql = "SELECT * FROM _province WHERE is_online=1";
	if ($cond!="") $sql.= " AND $cond";
	$sql.= " ORDER BY order_no, slug, province_id";
	$arrListProvince1 = $dbconn->GetAll($sql, false, 0);
	$html = "";
	if (is_array($arrListProvince1)){
		foreach ($arrListProvince1 as $k => $v){
			$selected = ($v[$field_value]==$selectedid)? "selected" : "";
			$value = $v[$field_value];
			$option = ($_LANG_ID!="vn")?  $v["name_".$_LANG_ID] : $v["name"];
			$html.= "<option value=\"$value\" $selected data-region='".$v['region_id']."' data-slug='".$v['slug']."' >".$option."</option>";			
		}
		return $html;
	}else{
		return "";
	}
}
function makeArrayListProvince(&$ret, $cond=""){
	global $dbconn, $_LANG_ID;
	$sql = "SELECT * FROM _province WHERE is_online=1";
	if ($cond!="") $sql.= " AND $cond";
	$sql.= " ORDER BY order_no, slug, province_id";
	$arrListProvince11 = $dbconn->GetAll($sql, false, 0);
	$html = "";
	if (is_array($arrListProvince11)){
		foreach ($arrListProvince11 as $k => $v){			
			$value = $v["province_id"];
			$option = ($_LANG_ID!="vn")?  $v["name_".$_LANG_ID] : $v["name"];
			$ret["$value"] = $option;			
		}
		unset($arrListProvince11);
		return "";
	}
	unset($arrListProvince11);
	return "";	
}

?>