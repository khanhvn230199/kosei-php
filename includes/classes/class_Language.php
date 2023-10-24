<?
/******************************************************
 * Class Language
 *
 * Language Handling
 * 
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:  
 * Program ID                 :  class_Language.php
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
class Language extends DbBasic{
	function Language(){
		$this->pkey = "lang_id";
		$this->tbl = "_language";
	}
	//SELECT
	function getName($lang_code='vn'){
		$arr = $this->getByCond("lang_code='$lang_code'");
		return $arr['name'];
	}
	//INSERT
	//UPDATE
	//DELETE
}
function makeListLang($selectedid=""){
	global $dbconn;
	$sql = "SELECT * FROM _language WHERE is_online=1";
	$arrListLang1 = $dbconn->GetAll($sql);
	$html = "";
	if (is_array($arrListLang1)){
		foreach ($arrListLang1 as $k => $v){
			$value = $v["lang_code"];
			$option = $v["name"];
			$selected = ($value==$selectedid)? "selected" : "";
			$html.= "<option value=\"$value\" $selected>".$option."</option>";
		}
		return $html;
	}else{
		return "";
	}
}
function makeArrayListLang(&$ret){
	global $dbconn;
	$sql = "SELECT * FROM _language WHERE is_online=1";
	$arrListLang1 = $dbconn->GetAll($sql);
	$html = "";
	if (is_array($arrListLang1)){
		foreach ($arrListLang1 as $k => $v){			
			$value = $v["lang_code"];
			$option = $v["name"];
			$ret["$value"] = $option;
		}
		return "";
	}else{
		return "";
	}
}

?>