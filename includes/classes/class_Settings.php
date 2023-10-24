<?
/******************************************************
 * Class Setting
 *
 * Setting Handling
 * 
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:  
 * Program ID                 :  class_Setting.php
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
class Settings extends dbBasic{
	function Settings(){
		$this->pkey = "setting_id";
		$this->tbl = "_settings";
	}
	//SELECT
	/**
	 * Get all setting variables
	 */
	function getAllSettings($lang_code="vn"){
		$arrConfig = array();
		$arrListSetting = $this->getAll("lang_code='$lang_code'");
		if (is_array($arrListSetting)){
			foreach ($arrListSetting as $key => $val){
				$svalue = $val['svalue'];
				if ($val['ftype']=="ftext"){
					$svalue = @explode(';', $svalue);
				}else
					if ($val['ftype']=="array"){
					$svalue = @unserialize($svalue);
				}
				$arrConfig[$val['skey']] = $svalue;
			}			
		}
		return $arrConfig;
	}
	/**
	 * Get value of $skey
	 * 
	 * @param unknown $skey
	 * @param string $lang_code
	 * @return Ambigous <>
	 */
	function getValue($skey, $lang_code='vn'){
		$res = dbBasic::getByCond("skey='$skey' AND lang_code='$lang_code'");
		return $res["svalue"];
	}
	//INSERT
	function insertValue($skey, $svalue, $lang_code='vn'){
		dbBasic::insertOne("skey, svalue, lang_code", "'$skey', '$svalue', '$lang_code'");
	}
	//UPDATE
	function setValue($skey, $svalue="", $lang_code='vn'){
		global $dbconn;
		$res = dbBasic::getByCond("skey='$skey' AND lang_code='$lang_code'");
		if (!is_array($res) || $res['skey']!=$skey){
			//dbBasic::insertOne("skey, svalue, lang_code", "'$skey', '$svalue', '$lang_code'");
			$res = dbBasic::getByCond("skey='$skey'");
			if (is_array($res) && $res[$this->pkey]>0){		
				$this->cloneOne($res[$this->pkey], array('svalue' => $svalue, 'lang_code' => $lang_code));
			}
		}else{
			dbBasic::updateByCond("skey='$skey' AND lang_code='$lang_code'", "svalue='$svalue'");
		}
	}
	//DELETE
	function delValue($skey, $lang_code='vn'){
		return dbBasic::deleteByCond("skey='$skey' AND lang_code='$lang_code'");
	}
}
?>